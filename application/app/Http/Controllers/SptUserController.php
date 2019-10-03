<?php

namespace App\Http\Controllers;

use App\Client;
use App\Models\Room;
use Auth;
use DB;
use Illuminate\Http\Request;

class SptUserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('client');
    }

    public function listUser()
    {
        $clients = Client::where('is_delete', 0)->orderBy('id', 'desc')->get();
        $rooms   = Room::all();
        return view('client.list_user_spt', compact('clients', 'rooms'));
    }

    public function showInsertUserSpt(Request $request)
    {
        $rooms = Room::all();
        return view('client.create-new-user-spt', compact('rooms'));
    }

    public function postInsertUser(Request $request)
    {

        $cateIdInsert = $request->cateIdInsert;

        $messages = array(
            'name.required'     => 'Chưa nhập họ tên',
            'email.required'    => 'Chưa nhập email',
            'mobile.required'   => 'Chưa nhập số điện thoại',
            'roomId.required'   => 'Chưa chọn phòng',
            'password.required' => 'Chưa nhập mật khẩu',

        );
        $v = \Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required',
            'mobile'   => 'required',
            'roomId'   => 'required',
            'password' => 'required',
        ], $messages);

        if ($v->fails()) {
            if ($cateIdInsert > 0) {
                return redirect('client/showInsertUserSpt/' . $cateIdInsert)->withErrors($v->errors())->withInput();
            } else {
                return redirect('client/showInsertUserSpt/')->withErrors($v->errors())->withInput();
            }

        }

        $client           = new Client();
        $client->name     = $request->name;
        $client->email    = $request->email;
        $client->mobile   = $request->mobile;
        $client->room_id  = $request->roomId;
        $client->password = bcrypt($request->password);
        $client->status   = 'Active';
        if ($request->has('is_send_email')) {
            $client->is_send_email = 1;
        }

        if ($request->has('is_approval_new')) {
            $client->is_approval_new = 1;
        }

        $client->datecreated = date('Y-m-d');
        $client->save();
        if ($cateIdInsert > 0) {
            $urlRedirect = 'client/show-user-spt-by-catetory/' . $cateIdInsert;
            return redirect($urlRedirect)->with([
                'message' => 'Thêm user thành công',
            ]);
        } else {
            return redirect('client/list-user-spt')->with([
                'message' => 'Thêm user thành công',
            ]);
        }
    }

    public function showEditUserSpt(Request $request)
    {
        $client = Client::find($request->id);
        $rooms  = Room::all();
        return view('client.edit_user_spt', compact('client', 'rooms'));
    }

    public function editUserSpt(Request $request)
    {
        $client          = Client::find($request->user_spt_id);
        $client->name    = $request->name;
        $client->email   = $request->email;
        $client->mobile  = $request->mobile;
        $client->room_id = $request->roomId;
        if ($request->has('password')) {
            $client->password = bcrypt($request->password);
        }

        if ($request->has('is_send_email')) {
            $client->is_send_email = 1;
        }else{
            $client->is_send_email = 0;
        }

        if ($request->has('is_approval_new')) {
            $client->is_approval_new = 1;
        }else{
            $client->is_approval_new = 0;
        }



        $client->updated_at = date('Y-m-d');
        $client->user_id    = Auth::guard('client')->user()->id;
        $client->update();
        $cateIdEdit = $request->cateIdEdit;
        if ($cateIdEdit > 0) {
            $urlRedirect = 'client/show-user-spt-by-catetory/' . $cateIdEdit;
            return redirect($urlRedirect)->with([
                'message' => 'Sửa user thành công',
            ]);
        } else {
            return redirect('client/list-user-spt')->with([
                'message' => 'Sửa user thành công',
            ]);
        }
    }

    public function deleteUserSpt(Request $request)
    {
        $client            = Client::find($request->id);
        $client->is_delete = 1;
        $client->save();
        return redirect('client/list-user-spt')->with([
            'message' => 'Xóa user thành công',
        ]);
    }

    public function showUserSptByCate(Request $request)
    {
        $cateId  = $request->cateIdSub;
        $clients = Client::where('room_id', $cateId)->where('is_delete', 0)->orderBy('id', 'DESC')->get();
        return view('client.show_user_spt_by_cate', compact('clients'));
    }

    public function deleteUserSptInCate(Request $request)
    {
        $client            = Client::find($request->id);
        $client->is_delete = 1;
        $client->save();
        $cateId = $request->cateId;
        return redirect('client/show-user-spt-by-catetory/' . $cateId)->with([
            'message' => 'Xóa user thành công',
        ]);
    }

    public function listPermission(Request $request)
    {
        $userId             = $request->userId;
        $client = Client::find($userId);
        $userEmail=$client->email;
        $sql                = "select * from group_role_user where client_id='" . $userId . "' and group_role_id=1";
        $groupRoleWebsite   = DB::selectOne($sql);
        $sql                = "select * from group_role_user where client_id='" . $userId . "' and group_role_id=2";
        $groupRoleKhachHang = DB::selectOne($sql);
        //list permission website
        $sql = "select g.name,r.id,r.full_permission,r.client_id,p.group_role_perm_id from group_role g,group_role_user r,group_role_perm p where g.id=r.group_role_id
        and r.id=p.group_role_user_id and r.client_id='" . $userId . "' and g.name='website'";
        $listPerWebsite  = DB::select($sql);
        $arrayPerWebsite = [];
        foreach ($listPerWebsite as $key => $item) {
            $arrayPerWebsite[] = $item->group_role_perm_id;
            $isFullPermission=$item->full_permission;
        }
        //list permission contact
        $sql = "select g.name,r.id,r.client_id,p.group_role_perm_id from group_role g,group_role_user r,group_role_perm p where g.id=r.group_role_id
        and r.id=p.group_role_user_id and r.client_id='" . $userId . "' and g.name='khách hàng'";
        $listPerContact  = DB::select($sql);
        $arrayPerContact = [];
        foreach ($listPerContact as $key => $item) {
            $arrayPerContact[] = $item->group_role_perm_id;
        }
        return view('client.list_permission', compact('userId', 'groupRoleWebsite', 'groupRoleKhachHang', 'arrayPerWebsite',
            'arrayPerContact','isFullPermission','userEmail'));
    }

    public function postListPermission(Request $request)
    {
        $groupRoleId        = $request->group_role_id;
        $lisPerWebsite      = $request->lisPerWebsite;
        //$group_role_id_type = $request->group_role_id_type;
        $listPerContact     = $request->listPerContact;
        $clientId           = $request->userId;
        $userId             = Auth::guard('client')->user()->id;
        $sql                = "delete from  group_role_user where client_id='" . $clientId . "'";
        DB::delete($sql);
        $sql = "delete from  group_role_perm where client_id='" . $clientId . "'";
        DB::delete($sql);
        //insert group role id
        foreach ($groupRoleId as $key => $item) {
            if($item==1){
                if($request->has('checkRoot'))
                    $checkRoot=1;
                else
                    $checkRoot=0;
                $type_perm=$request->group_role_id_type_website;
            }
            if($item==2){
                $checkRoot=0;
                $type_perm=$request->group_role_id_type_kh;
            }
            $sql = "INSERT INTO group_role_user(group_role_id,client_id,user_id,type_perm,full_permission,created_date)
                VALUES('" . $item . "','" . $clientId . "','" . $userId . "','" . $type_perm. "','".$checkRoot."',now()) ";
            DB::insert($sql);
            $idInsert = DB::getPdo()->lastInsertId();
            //insert permission website
            if ($item == 1) {
                foreach ($lisPerWebsite as $item1) {
                    $sql = "INSERT INTO group_role_perm(group_role_user_id,group_role_perm_id,user_id,client_id,created_date)
                    VALUES('" . $idInsert . "','" . $item1 . "','" . $userId . "','" . $clientId . "',now()) ";
                    DB::insert($sql);
                }
            }
            if ($item == 2) {
                foreach ($listPerContact as $item2) {
                    $sql = "INSERT INTO group_role_perm(group_role_user_id,group_role_perm_id,user_id,client_id,created_date)
                    VALUES('" . $idInsert . "','" . $item2 . "','" . $userId . "','" . $clientId . "',now()) ";
                    DB::insert($sql);
                }
            }

        }
        return redirect('client/show-list-permission/' . $clientId)->with([
            'message' => 'Phân quyền thành công',
        ]);
    }
}
