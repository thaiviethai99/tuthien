<?php

namespace App\Http\Controllers;

use App\Classes\Permission;
use App\SMSHistory;
use App\SMSInbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{

    /**
     * ReportsController constructor.
     */
    public function __construct(){
        $this->middleware('admin');
    }

    //======================================================================
    // smsHistory Function Start Here
    //======================================================================
    public function smsHistory(){
        $self = 'sms-history';
        if (Auth::user()->username !== 'admin') {
            $get_perm = Permission::permitted($self);

            if ($get_perm == 'access denied') {
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important' => true
                ]);
            }
        }

        $sms_history=SMSHistory::orderBy('updated_at','desc')->get();
        return view('admin.sms-history',compact('sms_history'));
    }

    //======================================================================
    // smsViewInbox Function Start Here
    //======================================================================
    public function smsViewInbox($id){

        $self = 'sms-history';
        if (Auth::user()->username !== 'admin') {
            $get_perm = Permission::permitted($self);

            if ($get_perm == 'access denied') {
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important' => true
                ]);
            }
        }


        $inbox_info=SMSHistory::find($id);

        if ($inbox_info){
            $sms_inbox=SMSInbox::where('msg_id',$id)->get();
            return view('admin.sms-inbox',compact('sms_inbox','inbox_info'));
        }else{
            return redirect('sms/history')->with([
                'message' => language_data('SMS Not Found'),
                'message_important' => true
            ]);
        }

    }


    //======================================================================
    // deleteSMS Function Start Here
    //======================================================================
    public function deleteSMS($id){

        $self = 'sms-history';
        if (Auth::user()->username !== 'admin') {
            $get_perm = Permission::permitted($self);

            if ($get_perm == 'access denied') {
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important' => true
                ]);
            }
        }


        $inbox_info=SMSHistory::find($id);

        if ($inbox_info){
            SMSInbox::where('msg_id',$id)->delete();
            $inbox_info->delete();

            return redirect('sms/history')->with([
                'message' => language_data('SMS info deleted successfully')
            ]);

        }else{
            return redirect('sms/history')->with([
                'message' => language_data('SMS Not Found'),
                'message_important' => true
            ]);
        }

    }



}
