<?php

namespace App\Http\Controllers;

use App\InvoiceItems;
use App\Invoices;
use App\Models\Orders;
use App\Models\PayooConnect;
use App\Models\PayooResult;
use App\PaymentGateways;
use App\SMSPricePlan;
use Cartalyst\Stripe\Exception\StripeException;
use Cartalyst\Stripe\Stripe;
use GuzzleHttp\Client as ClientHttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Slydepay\Exception\ProcessPaymentException;
use Slydepay\Order\Order;
use Slydepay\Order\OrderItem;
use Slydepay\Order\OrderItems;
use Slydepay\Slydepay;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaymentController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //======================================================================
    // payInvoice Function Start Here
    //======================================================================
    public function payInvoice(Request $request)
    {
        $cmd = Input::get('cmd');
        if ($request->gateway == '') {
            return redirect('user/invoices/view/' . $cmd)->with([
                'message'           => language_data('Payment gateway required'),
                'message_important' => true,
            ]);
        }

        $gateway       = Input::get('gateway');
        $gat_info      = PaymentGateways::where('settings', $gateway)->first();
        $invoice_items = InvoiceItems::where('inv_id', $cmd)->get();
        $invoice       = Invoices::find($cmd);

        if ($gateway == 'paypal') {
            $config = [
                'mode'           => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
                'sandbox'        => [
                    'username' => $gat_info->value, // Api Username
                    'password' => $gat_info->password, // Api Password
                    'secret'   => $gat_info->extra_value, // This refers to api signature
                ],
                'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
                'notify_url'     => '', // Change this accordingly for your application.
                'locale'         => app_config('Country'), // Change this accordingly for your application.
                'currency'       => app_config('Currency'), // Change this accordingly for your application.
            ];

            $provider = new ExpressCheckout();

            $provider->setApiCredentials($config);
            $options = [
                'BRANDNAME' => app_config('AppName'),
                'LOGOIMG'   => asset(app_config('AppLogo')),
            ];
            $provider->addOptions($options);

            $data          = [];
            $data['items'] = [];
            foreach ($invoice_items as $i) {
                array_push($data['items'], [
                    'name'  => $i->item,
                    'price' => $i->total,
                    'qty'   => 1,
                ]);
            }

            $data['invoice_id']          = $cmd;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url']          = url('/user/invoice/success/' . $cmd);
            $data['cancel_url']          = url('/user/invoice/cancel/' . $cmd);

            $total = 0;
            foreach ($data['items'] as $item) {
                $total += $item['price'] * $item['qty'];
            }

            $data['total'] = $total;

            $response = $provider->setExpressCheckout($data);

            return redirect($response['paypal_link']);

        }

        if ($gateway == 'payu') {

            $signature = "$gat_info->extra_value~$gat_info->value~invoiceId$invoice->id~$invoice->total~" . app_config('Currency');
            $signature = md5($signature);

            $order = array(
                'merchantId'      => $gat_info->value,
                'ApiKey'          => $gat_info->extra_value,
                'referenceCode'   => 'invoiceId' . $invoice->id,
                'description'     => 'Invoice No#' . $invoice->id,
                'amount'          => $invoice->total,
                'tax'             => '0',
                'taxReturnBase'   => '0',
                'currency'        => app_config('Currency'),
                'buyerEmail'      => Auth::guard('client')->user()->email,
                'test'            => '0',
                'signature'       => $signature,
                'confirmationUrl' => url('/user/invoice/success/' . $cmd),
                'responseUrl'     => url('/user/invoice/cancel/' . $cmd),
            );
            ?>

            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>Please wait while you're redirected</title>
                <style type="text/css">
                    #redirect {
                        background: #f1f1f1;
                        font-family: Helvetica, Arial, sans-serif
                    }

                    #redirect-container {
                        width: 410px;
                        margin: 130px auto 0;
                        background: #fff;
                        border: 1px solid #b5b5b5;
                        -moz-border-radius: 5px;
                        -webkit-border-radius: 5px;
                        border-radius: 5px;
                        text-align: center
                    }

                    #redirect-container h1 {
                        font-size: 22px;
                        color: #5f5f5f;
                        font-weight: normal;
                        margin: 22px 0 26px 0;
                        padding: 0
                    }

                    #redirect-container p {
                        font-size: 13px;
                        color: #454545;
                        margin: 0 0 12px 0;
                        padding: 0
                    }

                    #redirect-container img {
                        margin: 0 0 35px 0;
                        padding: 0
                    }

                    .ajaxLoader {
                        margin: 80px 153px
                    }
                </style>
                <script type="text/javascript">
                    function timedText() {
                        setTimeout('msg1()', 2000);
                        setTimeout('msg2()', 4000);
                        setTimeout('document.MetaRefreshForm.submit()', 4000);
                    }
                    function msg1() {
                        document.getElementById('redirect-message').firstChild.nodeValue = "Preparing Data...";
                    }
                    function msg2() {
                        document.getElementById('redirect-message').firstChild.nodeValue = "Redirecting...";
                    }
                </script>
            </head>
            <?php echo "<body onLoad=\"document.forms['gw'].submit();\">\n"; ?>
            <div id="redirect-container">
                <h1>Please wait while you&rsquo;re redirected</h1>
                <p class="redirect-message" id="redirect-message">Loading Data...</p>
                <script type="text/javascript">timedText()</script>
            </div>
            <form method="post" action="https://gateway.payulatam.com/ppp-web-gateway" name="gw">
                <?php
foreach ($order as $name => $value) {
                echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
            }
            ?>
            </form>
            </body>
            </html>
            <?php
}

        if ($gateway == 'stripe') {

            $stripe_amount = $invoice->total * 100;
            return view('client.stripe', compact('gat_info', 'stripe_amount', 'cmd'));

        }

        if ($gateway == 'slydepay') {

            require_once app_path('libraray/vendor/autoload.php');

            $slydepay   = new Slydepay($gat_info->value, $gat_info->extra_value);
            $orderItems = new OrderItems([
                new OrderItem($invoice->id, "Invoice NO# $invoice->id", $invoice->total, 1),
            ]);
            $shippingCost = 0;
            $tax          = 0;
            $order_id     = _raid(5);

            $order = Order::createWithId($orderItems, $order_id, $shippingCost, $tax, $invoice->id);

            try {
                $response = $slydepay->processPaymentOrder($order);
                return redirect($response->redirectUrl());
            } catch (ProcessPaymentException $e) {
                return redirect('user/invoices/view/' . $invoice->id)->with([
                    'message'           => $e->getMessage(),
                    'message_important' => true,
                ]);
            }
        }

        if ($gateway == 'manualpayment') {
            $details = $gat_info->value;

            return view('client.bank-details', compact('details'));
        }
    }

    //======================================================================
    // cancelledInvoice Function Start Here
    //======================================================================
    public function cancelledInvoice($id = '')
    {
        return redirect('user/invoices/view/' . $id)->with([
            'message' => language_data('Cancelled the Payment'),
        ]);
    }

    //======================================================================
    // successInvoice Function Start Here
    //======================================================================
    public function successInvoice($id)
    {
        $invoice = Invoices::find($id);

        if ($invoice) {
            $invoice->status = 'Paid';
            $invoice->save();
            return redirect('user/invoices/view/' . $id)->with([
                'message' => language_data('Invoice paid successfully'),
            ]);
        } else {
            return redirect('user/invoices/all')->with([
                'message' => language_data('Invoice paid successfully'),
            ]);
        }
    }

    //======================================================================
    // payWithStripe Function Start Here
    //======================================================================
    public function payWithStripe(Request $request)
    {

        $cmd      = Input::get('cmd');
        $invoice  = Invoices::find($cmd);
        $gat_info = PaymentGateways::where('settings', 'stripe')->first();
        $stripe   = Stripe::make($gat_info->extra_value, '2016-07-06');
        $email    = client_info($invoice->cl_id)->email;

        try {
            $customer = $stripe->customers()->create([
                'email' => $email,
            ]);

            $customer_id = $customer['id'];

            $stripe->charges()->create([
                'customer'      => $customer_id,
                'currency'      => app_config('Currency'),
                'amount'        => $invoice->total,
                'receipt_email' => $email,
            ]);
            $invoice->status = 'Paid';
            $invoice->save();

            return redirect('user/invoices/view/' . $cmd)->with([
                'message' => language_data('Invoice paid successfully'),
            ]);

        } catch (StripeException $e) {
            return redirect('user/invoices/view/' . $cmd)->with([
                'message'           => $e->getMessage(),
                'message_important' => true,
            ]);
        }
    }

    //======================================================================
    // purchaseSMSPlanPost Function Start Here
    //======================================================================
    public function purchaseSMSPlanPost(Request $request)
    {

        $cmd = Input::get('cmd');
        if ($request->gateway == '') {
            return redirect('user/sms/sms-plan-feature/' . $cmd)->with([
                'message'           => language_data('Payment gateway required'),
                'message_important' => true,
            ]);
        }

        $gateway  = Input::get('gateway');
        $gat_info = PaymentGateways::where('settings', $gateway)->first();
        $sms_plan = SMSPricePlan::find($cmd);

        if ($gateway == 'paypal') {
            $config = [
                'mode'           => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
                'sandbox'        => [
                    'username' => $gat_info->value, // Api Username
                    'password' => $gat_info->password, // Api Password
                    'secret'   => $gat_info->extra_value, // This refers to api signature
                ],
                'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
                'notify_url'     => '', // Change this accordingly for your application.
                'locale'         => app_config('Country'), // Change this accordingly for your application.
                'currency'       => app_config('Currency'), // Change this accordingly for your application.
            ];

            $provider = new ExpressCheckout();

            $provider->setApiCredentials($config);
            $options = [
                'BRANDNAME' => app_config('AppName'),
                'LOGOIMG'   => asset(app_config('AppLogo')),
            ];
            $provider->addOptions($options);

            $data          = [];
            $data['items'] = [];

            array_push($data['items'], [
                'name'  => $sms_plan->plan_name,
                'price' => $sms_plan->price,
                'qty'   => 1,
            ]);

            $data['invoice_id']          = $cmd;
            $data['invoice_description'] = "Purchase Plan {$sms_plan->plan_name}";
            $data['return_url']          = url('/user/sms/purchase-plan/success/' . $cmd);
            $data['cancel_url']          = url('/user/sms/purchase-plan/cancel/' . $cmd);

            $data['total'] = $sms_plan->price;

            $response = $provider->setExpressCheckout($data);

            return redirect($response['paypal_link']);

        }

        if ($gateway == 'payu') {

            $signature = "$gat_info->extra_value~$gat_info->value~smsplan$sms_plan->id~$sms_plan->price~" . app_config('Currency');
            $signature = md5($signature);

            $order = array(
                'merchantId'      => $gat_info->value,
                'ApiKey'          => $gat_info->extra_value,
                'referenceCode'   => 'smsplan' . $sms_plan->id,
                'description'     => 'Purchase ' . $sms_plan->plan_name . ' Plan',
                'amount'          => $sms_plan->price,
                'tax'             => '0',
                'taxReturnBase'   => '0',
                'currency'        => app_config('Currency'),
                'buyerEmail'      => Auth::guard('client')->user()->email,
                'test'            => '0',
                'signature'       => $signature,
                'confirmationUrl' => url('/user/sms/purchase-plan/success/' . $cmd),
                'responseUrl'     => url('/user/sms/purchase-plan/cancel/' . $cmd),
            );
            ?>

            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>Please wait while you're redirected</title>
                <style type="text/css">
                    #redirect {
                        background: #f1f1f1;
                        font-family: Helvetica, Arial, sans-serif
                    }

                    #redirect-container {
                        width: 410px;
                        margin: 130px auto 0;
                        background: #fff;
                        border: 1px solid #b5b5b5;
                        -moz-border-radius: 5px;
                        -webkit-border-radius: 5px;
                        border-radius: 5px;
                        text-align: center
                    }

                    #redirect-container h1 {
                        font-size: 22px;
                        color: #5f5f5f;
                        font-weight: normal;
                        margin: 22px 0 26px 0;
                        padding: 0
                    }

                    #redirect-container p {
                        font-size: 13px;
                        color: #454545;
                        margin: 0 0 12px 0;
                        padding: 0
                    }

                    #redirect-container img {
                        margin: 0 0 35px 0;
                        padding: 0
                    }

                    .ajaxLoader {
                        margin: 80px 153px
                    }
                </style>
                <script type="text/javascript">
                    function timedText() {
                        setTimeout('msg1()', 2000);
                        setTimeout('msg2()', 4000);
                        setTimeout('document.MetaRefreshForm.submit()', 4000);
                    }
                    function msg1() {
                        document.getElementById('redirect-message').firstChild.nodeValue = "Preparing Data...";
                    }
                    function msg2() {
                        document.getElementById('redirect-message').firstChild.nodeValue = "Redirecting...";
                    }
                </script>
            </head>
            <?php echo "<body onLoad=\"document.forms['gw'].submit();\">\n"; ?>
            <div id="redirect-container">
                <h1>Please wait while you&rsquo;re redirected</h1>
                <p class="redirect-message" id="redirect-message">Loading Data...</p>
                <script type="text/javascript">timedText()</script>
            </div>
            <form method="post" action="https://gateway.payulatam.com/ppp-web-gateway" name="gw">
                <?php
foreach ($order as $name => $value) {
                echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
            }
            ?>
            </form>
            </body>
            </html>
            <?php
}

        if ($gateway == 'stripe') {
            $plan_name     = $sms_plan->plan_name;
            $stripe_amount = $sms_plan->price * 100;
            return view('client.stripe', compact('gat_info', 'stripe_amount', 'cmd', 'plan_name'));

        }

        if ($gateway == 'slydepay') {

            require_once app_path('libraray/vendor/autoload.php');

            $slydepay   = new Slydepay($gat_info->value, $gat_info->extra_value);
            $orderItems = new OrderItems([
                new OrderItem($invoice->id, "Invoice NO# $invoice->id", $invoice->total, 1),
            ]);
            $shippingCost = 0;
            $tax          = 0;
            $order_id     = _raid(5);

            $order = Order::createWithId($orderItems, $order_id, $shippingCost, $tax, $invoice->id);

            try {
                $response = $slydepay->processPaymentOrder($order);
                return redirect($response->redirectUrl());
            } catch (ProcessPaymentException $e) {
                return redirect('user/sms/sms-plan-feature/' . $cmd)->with([
                    'message'           => $e->getMessage(),
                    'message_important' => true,
                ]);
            }
        }

        if ($gateway == 'manualpayment') {
            $details = $gat_info->value;
            return view('client.bank-details', compact('details'));
        }
    }

    //======================================================================
    // cancelledInvoice Function Start Here
    //======================================================================
    public function cancelledPurchase($id = '')
    {
        return redirect('user/sms/sms-plan-feature/' . $id)->with([
            'message' => language_data('Cancelled the Payment'),
        ]);
    }

    //======================================================================
    // successInvoice Function Start Here
    //======================================================================
    public function successPurchase($id)
    {
        if ($id) {
            return redirect('user/sms/sms-plan-feature/' . $id)->with([
                'message' => language_data('Purchase successfully.Wait for administrator response'),
            ]);
        } else {
            return redirect('user/sms/purchase-sms-plan')->with([
                'message' => language_data('Purchase successfully.Wait for administrator response'),
            ]);
        }
    }

    //======================================================================
    // purchaseWithStripe Function Start Here
    //======================================================================
    public function purchaseWithStripe(Request $request)
    {

        $cmd      = Input::get('cmd');
        $sms_plan = SMSPricePlan::find($cmd);
        $gat_info = PaymentGateways::where('settings', 'stripe')->first();
        $stripe   = Stripe::make($gat_info->extra_value, '2016-07-06');
        $email    = Auth::guard('client')->user()->email;

        try {
            $customer = $stripe->customers()->create([
                'email' => $email,
            ]);

            $customer_id = $customer['id'];

            $stripe->charges()->create([
                'customer'      => $customer_id,
                'currency'      => app_config('Currency'),
                'amount'        => $sms_plan->price,
                'receipt_email' => $email,
            ]);

            return redirect('user/sms/sms-plan-feature/' . $cmd)->with([
                'message' => language_data('Purchase successfully.Wait for administrator response'),
            ]);

        } catch (StripeException $e) {
            return redirect('user/sms/sms-plan-feature/' . $cmd)->with([
                'message'           => $e->getMessage(),
                'message_important' => true,
            ]);
        }
    }

    //======================================================================
    // slydepayReceiveCallback Function Start Here
    //======================================================================
    public function slydepayReceiveCallback()
    {
        return redirect('dashboard')->with([
            'message' => language_data('Purchase successfully.Wait for administrator response'),
        ]);
    }

    public function purchaseOrderClient(Request $request)
    {
        $payooLink = $request->payooLink;
        $gateway   = $request->gateway;
        $clientId  = Auth::guard('client')->user()->id;
        $thanhToanId = $request->thanhtoanid;
        $parseLink = parse_url($payooLink);
        $queryLink = $parseLink['query'];
        parse_str($queryLink, $get_array);
        if ($gateway == 'manualpayment') {
            //chuyen khoan ngan hang
            return view('client.bank-details-order');
        } else if ($gateway == 'payoo') {
            // payoo
            // insert table when ma thanh toan not exist
            $orders = Orders::where('ma_tt', $request->matt)->first();
            if (!$orders) {
                $orders             = new Orders();
                $orders->ma_tt      = $request->matt;
                $orders->ten_tt     = $request->tentt;
                $orders->dia_chi_tt = $request->diachitt;
                $orders->tien_no    = $request->tienno;
                $orders->cl_id      = $clientId;
                $orders->link       = $payooLink;
                $orders->save();
                $orderId = $orders->id;
                //insert table payoo_connect
                $payooConnect           = new PayooConnect();
                $payooConnect->order_id = $orderId;
                $payooConnect->m        = $get_array['m'];
                $payooConnect->cmd      = $get_array['cmd'];
                $payooConnect->pnc      = $get_array['pnc'];
                $payooConnect->custcode = $get_array['custcode'];
                $payooConnect->custname = $get_array['custname'];
                $payooConnect->custaddr = $get_array['custaddr'];
                $payooConnect->idnum    = isset($get_array['idnum']) ? $get_array['idnum'] : '';
                $payooConnect->amount   = $get_array['amount'];
                $payooConnect->bills    = isset($get_array['bills']) ? $get_array['bills'] : '';
                $payooConnect->infoex   = isset($get_array['infoex']) ? $get_array['infoex'] : '';
                $payooConnect->txid     = $get_array['txid'];
                $payooConnect->area     = $get_array['area'];
                $payooConnect->desc     = $get_array['desc'];
                $payooConnect->bankcode = isset($get_array['bankcode']) ? $get_array['bankcode'] : '';
                $payooConnect->checksum = $get_array['checksum'];
                $payooConnect->save();
            } else {
                $payooConnect           = PayooConnect::where('order_id', $orders->id)->first();
                $payooConnect->m        = $get_array['m'];
                $payooConnect->cmd      = $get_array['cmd'];
                $payooConnect->pnc      = $get_array['pnc'];
                $payooConnect->custcode = $get_array['custcode'];
                $payooConnect->custname = $get_array['custname'];
                $payooConnect->custaddr = $get_array['custaddr'];
                $payooConnect->idnum    = isset($get_array['idnum']) ? $get_array['idnum'] : '';
                $payooConnect->amount   = $get_array['amount'];
                $payooConnect->bills    = isset($get_array['bills']) ? $get_array['bills'] : '';
                $payooConnect->infoex   = isset($get_array['infoex']) ? $get_array['infoex'] : '';
                $payooConnect->txid     = $get_array['txid'];
                $payooConnect->area     = $get_array['area'];
                $payooConnect->desc     = $get_array['desc'];
                $payooConnect->bankcode = isset($get_array['bankcode']) ? $get_array['bankcode'] : '';
                $payooConnect->checksum = $get_array['checksum'];
                $payooConnect->save();
                //update order
                $orders->created_at = time();
                $orders->updated_at = time();
                $orders->cl_id      = $clientId;
                $orders->link       = $payooLink;
                $orders->save();
            }

            //return redirect($payooLink);
            //echo $payooLink;die;
            $testLink = "http://localhost/baocuoc/user/order/purchase-order-client-response?";
            $testLink.="rescode=1&txid=20160&custcode=".$get_array['custcode'];
            $testLink.="&amount=".$get_array['amount']."&checksum=2223F64AC54F3B6D5C0F50BABB151DCA87298C9BFB5B39A515889EA82C2AA441";
            //return redirect($testLink);
            return redirect($payooLink);
        }
    }

    public function purchaseOrderClientResponse(Request $request)
    {
        $rescode  = Input::get('rescode');
        $txid     = Input::get('txid');
        $custcode = Input::get('custcode'); //ma thanh toan
        $amount   = Input::get('amount');
        $checksum = Input::get('checksum');
        $orders   = Orders::where('ma_tt', $custcode)->first();
        if ($orders) {
            $orderId = $orders->id;
            //insert table payoo_result
            $payooResult           = new PayooResult();
            $payooResult->order_id = $orderId;
            $payooResult->rescode  = $rescode;
            $payooResult->txid     = $txid;
            $payooResult->custcode = $custcode;
            $payooResult->amount   = $amount;
            $payooResult->checksum = $checksum;
            $payooResult->save();
            //update status id table order
            if ($rescode == 1 || $rescode == 2) {
                $orders->status_id = 1;
                $orders->save();
                //gach no
                $clientInvoice = new ClientHttp(['headers' => ['content-type' => 'application/json', 'Accept' => 'application/json']]);
                $response      = $clientInvoice->get($this->urlHostPayment . '/getInvoice/' . $custcode);
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
                        /*$orders   = Orders::where('ma_tt', $custcode)->first();
                        $orders->status_id =2;
                        $orders->save();*/
                        return redirect('user/pays/all')->with([
                            'message' => 'Thanh toán thành công',
                        ]);
                    } else {
                        return redirect('user/pays/all')->with([
                            'message'           => $dataPay->message,
                            'message_important' => true,
                        ]);
                    }
                } else {
                    return redirect('user/pays/all')->with([
                        'message'           => $dataOrder->message,
                        'message_important' => true,
                    ]);
                }
            }
        } else {
            return redirect('user/pays/all')->with([
                'message'           => 'Không tìm thấy mã thanh toán',
                'message_important' => true,
            ]);
        }

    }

}
