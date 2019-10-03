<?php

namespace App\Http\Controllers;

use App\Client;
use App\Models\Orders;
use App\PaymentGateways;
use DB;
use GuzzleHttp\Client as ClientHttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPayController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('client');
    }

    public function permissionErrorClient()
    {
        return view('client.permission-error-client');
    }

    //======================================================================
    // allPays Function Start Here
    //======================================================================
    public function allPays(Request $request)
    {
        //get ma tt by thanh toan id
        $userId = Auth::guard('client')->user()->id;
        $client = Client::where('groupid', 4)->find($userId);
        if ($client) {
            $thanhToanId       = $client->thanhtoan_id;
            $donviId           = $client->donvi_id;
            $khachhangId       = $client->khachhang_id;
            $sql               = "";
            $arrThanhToan      = [];
            $listOrderIdSearch = [];
            $is_search         = false;
            if ($request->has('ma_tt')) {
                $sql .= "and o.ma_tt='" . $request->ma_tt . "'";
                $is_search = true;
            }
            //$sql='';
            if ($request->has('createdDate')) {
                $sql .= "and DATE_FORMAT(o.created_at,'%Y-%m-%d')='" . date('Y-m-d', strtotime($request->createdDate)) . "'";
                $is_search = true;
            }

            if ($request->has('money')) {
                $is_search = true;
                $sql .= " and o.tien_no='" . $request->money . "'";
            }

            if ($request->has('status') && $request->status > 0) {
                $sql .= " and o.status_id='" . $request->status . "'";
                $is_search = true;
            }

            if ($is_search == false) {
                $orders      = Orders::all();
                $listOrderId = [];
                foreach ($orders as $key => $item) {
                    $listOrderId[] = $item->thanhtoan_id;
                }
                $listOrderId = implode(',', $listOrderId);
                $sql         = "select * from css_spt.db_thanhtoan t where t.khachhang_id='" . $khachhangId . "' and t.donvi_id='" . $donviId . "' and t.thanhtoan_id in (" . $listOrderId . ")";
            }
            if ($is_search == true) {
                $sql                      = "select * from sys_orders o where 1=1 and user_id ='" . $userId . "'" . $sql;
                $orders                   = DB::select($sql);
                $listOrderIdSearchImplode = 0;
                foreach ($orders as $key => $item) {
                    $listOrderIdSearch[] = $item->thanhtoan_id;
                }
                if (count($listOrderIdSearch) > 0) {
                    $listOrderIdSearch        = array_unique($listOrderIdSearch);
                    $listOrderIdSearchImplode = implode(',', $listOrderIdSearch);
                }
                $sql = "select * from css_spt.db_thanhtoan t where t.khachhang_id='" . $khachhangId . "' and t.donvi_id='" . $donviId . "' and t.thanhtoan_id in (" . $listOrderIdSearchImplode . ")";
                //echo $sql;die;
            }
            $dataThanhToan = DB::connection('oracleThanhToan')->select($sql);
            DB::disconnect('oracleThanhToan');
            //print_r($dataThanhToan);die;
            $orderConnection = DB::connection('oracleOrder');
            if (count($dataThanhToan) > 0) {

                foreach ($dataThanhToan as $item) {
                    $orders  = Orders::where('thanhtoan_id', $item->thanhtoan_id)->first();
                    $client3 = new ClientHttp(['headers' => ['content-type' => 'application/json', 'Accept' => 'application/json']]);

                    $response         = $client3->get($this->urlHostPayment . '/getInvoice/' . $item->ma_tt);
                    $result           = $response->getBody()->getContents();
                    $data             = json_decode($result);
                    $tienNo           = $orders->tien_no;
                    $statusCode       = $data->statusCode;
                    $message = $data->message;
                    $status           = "Chưa thanh toán";
                    $isShowPaidButton = 1;
                    $created_at       = '';
                    $statusId         = $orders->status_id;
                    $created_at       = date('d-m-Y H:i:s', strtotime($orders->created_at));
                    switch ($statusId) {
                        case 1: //cap nhat status = 1 khi thanh toan thanh cong
                            $status           = "Đã thanh toán,đang chờ admin duyệt";
                            $isShowPaidButton = 0;
                            break;
                        case 2: //cap nhat status = 1 khi thanh toan thanh cong
                            $status           = "Admin đã duyệt";
                            $isShowPaidButton = 0;
                            break;
                        case 3: //cap nhat status = 1 khi thanh toan thanh cong
                            $status           = "Admin đã hủy";
                            $isShowPaidButton = 0;
                            break;
                    }
                    $id       = mt_rand(100000, 999999);
                    $custcode = $item->ma_tt;
                    $custname = $item->ten_tt;
                    $custaddr = $item->diachi_tt;
                    $idnum    = ''; //cmnd
                    $amount   = $tienNo;
                    $bills    = '1;2';
                    $code     = $custcode . $amount . $bills . $id . '20568123456';
                    $checksum = hash('sha256', $code);
                    /*$link='https://sandbox.paybill.com.vn/?m=collpay&cmd=pay&pnc=20568&custcode=C0123652&custname=NguyenVanA&custaddr=DongKhoi&idnum=022233333&amount='.$item['tienNo'].'&bills=1;2&infoex=amount::10000;20000&txid='.$id.'&area=1&desc=NapTienVaoTaiKhoan&checksum='.$checksum;*/
                    $link = 'https://sandbox.paybill.com.vn/?m=collpay&cmd=pay&pnc=20568&custcode=' . $custcode . '&custname=' . $custname . '&custaddr=' . $custaddr . '&amount=' . $amount . '&bills=' . $bills . '&txid=' . $id . '&area=1&desc=NapTienVaoTaiKhoan&checksum=' . $checksum;
                    if ($statusCode==0 || $statusCode==-1 || $statusCode==-2 || $statusCode == -5) {
                        $arrThanhToan[] = [
                            'ma_tt'            => $item->ma_tt,
                            'ten_tt'           => $item->ten_tt,
                            'diachi_tt'        => $item->diachi_tt,
                            'tienNo'           => $tienNo,
                            'status'           => $status,
                            'statusCode'       => $statusCode,
                            'isShowPaidButton' => $isShowPaidButton,
                            'linkPayoo'        => $link,
                            'created_at'       => $created_at,
                            'message'=>$message
                        ];
                    }

                    // print_r($arrThanhToan);
                    // die;
                }
                DB::disconnect('oracleOrder');
            }

            /*$client        = client_info(Auth::guard('client')->user()->id);
            $thueBaoClient = new ClientHttp(['headers' => ['content-type' => 'application/json', 'Accept' => 'application/json']]);
            $response      = $thueBaoClient->get($this->urlHostApi . '/getThueBao/' . $khachhangId . '/' . $donviId);

            $result  = $response->getBody()->getContents();
            $thuebao = json_decode($result);
            $thuebao = $thuebao->data;
            //print_r($thuebao);*/
            $payment_gateways = PaymentGateways::where('status', 'Active')->get();
            return view('client.all-pays', compact('arrThanhToan', 'client', 'payment_gateways'));
        } else {
            return redirect('permission-error-client')->with([
                'message'           => 'Client không tồn tại',
                'message_important' => true,
            ]);
        }
    }



    public function allNotPays(Request $request)
    {
        //get ma tt by thanh toan id
        $userId = Auth::guard('client')->user()->id;
        $client = Client::where('groupid', 4)->find($userId);
        if ($client) {
            $thanhToanId = $client->thanhtoan_id;
            $donviId     = $client->donvi_id;
            $khachhangId = $client->khachhang_id;
            $sql         = '';
            if ($request->has('ma_tt')) {
                $sql .= "and t.ma_tt='" . $request->ma_tt . "'";
                $is_search = true;
            }
            //$sql='';
            if ($request->has('createdDate')) {
                $sql .= "and TO_CHAR(t.ngay_cn,'YYYY-MM-DD')='" . date('Y-m-d', strtotime($request->createdDate)) . "'";
                $is_search = true;
            }

            $is_search_money = false;

            if ($request->has('money')) {
                $is_search_money = true;
                //$sql .= " and o.tien_no='" . $request->money . "'";
            }
            $orders      = Orders::all();
            $listOrderId = [];
            foreach ($orders as $key => $item) {
                $listOrderId[] = $item->thanhtoan_id;
            }
            if (count($listOrderId) > 0) {
                $listOrderId   = implode(',', $listOrderId);
                $sql           = "select * from css_spt.db_thanhtoan t where t.khachhang_id='" . $khachhangId . "' and t.donvi_id='" . $donviId . "'  and t.thanhtoan_id not in (" . $listOrderId . ")" . $sql;
                $dataThanhToan = DB::connection('oracleThanhToan')->select($sql);
                //print_r($dataThanhToan);die;
                DB::disconnect('oracleThanhToan');
                //echo count($dataThanhToan);die;
                $arrThanhToan = [];
                //DB::disconnect('oracleOrder');
                //die;
                if (count($dataThanhToan) > 0) {
                    if ($is_search_money == true) {
                        foreach ($dataThanhToan as $item) {
                            $client3 = new ClientHttp(['headers' => ['content-type' => 'application/json', 'Accept' => 'application/json']]);

                            $response         = $client3->get($this->urlHostPayment . '/getInvoice/' . $item->ma_tt);
                            $result           = $response->getBody()->getContents();
                            $data             = json_decode($result);
                            $tienNo           = $data->data->vTongTien;
                            $statusCode       = $data->statusCode;
                            $message = $data->message;
                            $status           = "Chưa thanh toán";
                            $isShowPaidButton = 1;
                            $id               = mt_rand(100000, 999999);
                            $custcode         = $item->ma_tt;
                            $custname         = $item->ten_tt;
                            $custaddr         = $item->diachi_tt;
                            $idnum            = ''; //cmnd
                            $amount           = $tienNo;
                            $bills            = '1;2';
                            $code             = $custcode . $amount . $bills . $id . '20568123456';
                            $checksum         = hash('sha256', $code);
                            /*$link='https://sandbox.paybill.com.vn/?m=collpay&cmd=pay&pnc=20568&custcode=C0123652&custname=NguyenVanA&custaddr=DongKhoi&idnum=022233333&amount='.$item['tienNo'].'&bills=1;2&infoex=amount::10000;20000&txid='.$id.'&area=1&desc=NapTienVaoTaiKhoan&checksum='.$checksum;*/
                            $link = 'https://sandbox.paybill.com.vn/?m=collpay&cmd=pay&pnc=20568&custcode=' . $custcode . '&custname=' . $custname . '&custaddr=' . $custaddr . '&amount=' . $amount . '&bills=' . $bills . '&txid=' . $id . '&area=1&desc=NapTienVaoTaiKhoan&checksum=' . $checksum;
                            if ($tienNo == $request->money && $tienNo>0) {
                                $arrThanhToan[] = [
                                    'ma_tt'            => $item->ma_tt,
                                    'ten_tt'           => $item->ten_tt,
                                    'diachi_tt'        => $item->diachi_tt,
                                    'tienNo'           => $tienNo,
                                    'status'           => $status,
                                    'statusCode'       => $statusCode,
                                    'isShowPaidButton' => $isShowPaidButton,
                                    'linkPayoo'        => $link,
                                    'ngay_cn'          => date('d-m-Y H:i:s', strtotime($item->ngay_cn)),
                                    'message' => $message
                                ];
                            }

                        }
                    }
                    if ($is_search_money == false) {
                        foreach ($dataThanhToan as $item) {
                            $client3 = new ClientHttp(['headers' => ['content-type' => 'application/json', 'Accept' => 'application/json']]);

                            $response         = $client3->get($this->urlHostPayment . '/getInvoice/' . $item->ma_tt);
                            $result           = $response->getBody()->getContents();
                            $data             = json_decode($result);
                            $tienNo           = $data->data->vTongTien;
                            $statusCode       = $data->statusCode;
                            $message = $data->message;
                            $status           = "Chưa thanh toán";
                            $isShowPaidButton = 1;
                            $id               = mt_rand(100000, 999999);
                            $custcode         = $item->ma_tt;
                            $custname         = $item->ten_tt;
                            $custaddr         = $item->diachi_tt;
                            $idnum            = ''; //cmnd
                            $amount           = $tienNo;
                            $bills            = '1;2';
                            $code             = $custcode . $amount . $bills . $id . '20568123456';
                            $checksum         = hash('sha256', $code);
                            /*$link='https://sandbox.paybill.com.vn/?m=collpay&cmd=pay&pnc=20568&custcode=C0123652&custname=NguyenVanA&custaddr=DongKhoi&idnum=022233333&amount='.$item['tienNo'].'&bills=1;2&infoex=amount::10000;20000&txid='.$id.'&area=1&desc=NapTienVaoTaiKhoan&checksum='.$checksum;*/
                            $link = 'https://sandbox.paybill.com.vn/?m=collpay&cmd=pay&pnc=20568&custcode=' . $custcode . '&custname=' . $custname . '&custaddr=' . $custaddr . '&amount=' . $amount . '&bills=' . $bills . '&txid=' . $id . '&area=1&desc=NapTienVaoTaiKhoan&checksum=' . $checksum;
                            if ($tienNo > 0 && $statusCode==0) {
                                $arrThanhToan[] = [
                                    'ma_tt'            => $item->ma_tt,
                                    'ten_tt'           => $item->ten_tt,
                                    'diachi_tt'        => $item->diachi_tt,
                                    'tienNo'           => $tienNo,
                                    'status'           => $status,
                                    'statusCode'       => $statusCode,
                                    'isShowPaidButton' => $isShowPaidButton,
                                    'linkPayoo'        => $link,
                                    'ngay_cn'          => date('d-m-Y H:i:s', strtotime($item->ngay_cn)),
                                    'message' => $message
                                ];
                            }

                        }
                    }

                }
            }
            $payment_gateways = PaymentGateways::where('status', 'Active')->get();
            return view('client.all-not-pays', compact('arrThanhToan', 'client', 'payment_gateways'));
        } else {
            return redirect('permission-error-client')->with([
                'message'           => 'Client không tồn tại',
                'message_important' => true,
            ]);
        }
    }

    public function test()
    {
        $clientInvoice = new ClientHttp(['headers' => ['content-type' => 'application/json', 'Accept' => 'application/json']]);
        $response      = $clientInvoice->get($this->urlHostPayment . '/getInvoice/00162924');
        $result        = $response->getBody()->getContents();
        $dataOrder     = json_decode($result);
        $data          = $dataOrder->data;
        $vResponseCode = $data->vResponseCode;
        $vTransID      = $data->vTransID;
        $maTT          = $data->vAccountNumber;
        $amount        = $data->vTongTien;
        if ($dataOrder->statusCode == '0') {
            //post order
            $clientPaid = new ClientHttp(['headers' => ['content-type' => 'application/json', 'Accept' => 'application/json']]);
            $response   = $clientPaid->get($this->urlHostPayment . '/doPayment/' . $vTransID . '/' . $maTT . '/' . $amount);
            $result     = $response->getBody()->getContents();
            $dataPay    = json_decode($result);
            if ($dataPay->statusCode == '0') {
                //echo $dataPay->message;
                return redirect('user/pays/all')->with([
                    'message' => 'Thanh toán thành công',
                ]);
            } else {
                return redirect('user/pays/all')->with([
                    'message'           => $dataOrder->message,
                    'message_important' => true,
                ]);
            }
        } else {
            return redirect('user/pays/all')->with([
                'message'           => $dataOrder->message,
                'message_important' => true,
            ]);
        }
        die;
    }

}
