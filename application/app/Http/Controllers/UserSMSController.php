<?php

namespace App\Http\Controllers;

use App\Classes\PhoneNumber;
use App\Client;
use App\ClientGroups;
use App\CustomSMSGateways;
use App\ImportPhoneNumber;
use App\IntCountryCodes;
use App\Jobs\SendBulkSMS;
use App\PaymentGateways;
use App\ScheduleSMS;
use App\SenderIdManage;
use App\SMSGateways;
use App\SMSHistory;
use App\SMSInbox;
use App\SMSPlanFeature;
use App\SMSPricePlan;
use App\StoreBulkSMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class UserSMSController extends Controller
{
    public function __construct()
    {
        $this->middleware('client');
    }

    //======================================================================
    // senderIdManagement Function Start Here
    //======================================================================
    public function senderIdManagement()
    {

        $all_sender_id = SenderIdManage::all();

        $all_ids = [];
        foreach ($all_sender_id as $sid) {
            if (in_array(Auth::guard('client')->user()->id, json_decode($sid->cl_id))) {
                array_push($all_ids, $sid->id);
            }
        }
        $sender_id = SenderIdManage::whereIn('id', $all_ids)->get();

        return view('client.sender-id-management', compact('sender_id'));
    }

    //======================================================================
    // postSenderID Function Start Here
    //======================================================================
    public function postSenderID(Request $request)
    {
        if ($request->sender_id == '') {
            return redirect('user/sms/sender-id-management')->with([
                'message' => language_data('Sender ID required'),
                'message_important' => true
            ]);
        }

        $client_id = (string)Auth::guard('client')->user()->id;
        $client_id = (array)$client_id;
        $client_id = json_encode($client_id);

        $sender_id = new  SenderIdManage();
        $sender_id->sender_id = $request->sender_id;
        $sender_id->cl_id = $client_id;
        $sender_id->status = 'pending';
        $sender_id->save();

        return redirect('user/sms/sender-id-management')->with([
            'message' => language_data('Request send successfully')
        ]);
    }


    //======================================================================
    // sendSingleSMS Function Start Here
    //======================================================================
    public function sendSingleSMS()
    {
        return view('client.send-single-sms');
    }


    //======================================================================
    // postSingleSMS Function Start Here
    //======================================================================
    public function postSingleSMS(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'phone_number' => 'required', 'message' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/send-single-sms')->withErrors($v->errors());
        }

        $client = Client::find(Auth::guard('client')->user()->id);

        if ($client == '') {
            return redirect('user/sms/send-single-sms')->with([
                'message' => language_data('Client info not found'),
                'message_important' => true
            ]);
        }

        $gateway = SMSGateways::find($client->sms_gateway);
        if ($gateway->status != 'Active') {
            return redirect('user/sms/send-single-sms')->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;
        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);
        $sender_id = $request->sender_id;

        $phone = str_replace('+', '', $request->phone_number);
        $c_phone = PhoneNumber::get_code($phone);

        $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();

        if ($sms_cost) {
            $total_cost = $sms_cost->tariff * $msgcount;

            if ($total_cost == 0) {
                return redirect('user/sms/send-single-sms')->with([
                    'message' => language_data('You do not have enough sms balance'),
                    'message_important' => true
                ]);
            }

            if ($total_cost > $client->sms_limit) {
                return redirect('user/sms/send-single-sms')->with([
                    'message' => language_data('You do not have enough sms balance'),
                    'message_important' => true
                ]);
            }
        } else {
            return redirect('user/sms/send-single-sms')->with([
                'message' => language_data('Phone Number Coverage are not active'),
                'message_important' => true
            ]);
        }

        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/send-single-sms')->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $this->dispatch(new SendBulkSMS($client->id, $request->phone_number, $gateway, $sender_id, $message, $msgcount, $cg_info));

        $remain_sms = $client->sms_limit - $total_cost;
        $client->sms_limit = $remain_sms;
        $client->save();

        return redirect('user/sms/send-single-sms')->with([
            'message' => language_data('Please check sms history')
        ]);
    }



    //======================================================================
    // sendBulkSMS Function Start Here
    //======================================================================
    public function sendBulkSMS()
    {

        $client_group = ClientGroups::where('created_by', Auth::guard('client')->user()->id)->get();
        return view('client.send-bulk-sms', compact('client_group'));
    }

    //======================================================================
    // postSendBulkSMS Function Start Here
    //======================================================================
    public function postSendBulkSMS(Request $request)
    {

        $v = \Validator::make($request->all(), [
            'client_group' => 'required', 'message' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/send-sms')->withErrors($v->errors());
        }

        $client = Client::find(Auth::guard('client')->user()->id);
        $sms_count = $client->sms_limit;
        $sender_id = $request->sender_id;

        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/send-single-sms')->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $gateway = SMSGateways::find($client->sms_gateway);

        if ($gateway->status != 'Active') {
            return redirect('user/sms/send-sms')->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;


        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);


        $get_cost = 0;
        $get_inactive_coverage = [];
        $all_clients = Client::where('groupid', $request->client_group)->get();

        if ($all_clients->count() <= 0) {
            return redirect('user/sms/send-sms')->with([
                'message' => language_data('Client Group is empty'),
                'message_important' => true
            ]);
        }

        foreach ($all_clients as $c) {
            $phone = str_replace('+', '', $c->phone);
            $c_phone = PhoneNumber::get_code($phone);

            $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();
            if ($sms_cost) {
                $sms_charge = $sms_cost->tariff;
                $get_cost += $sms_charge;
            } else {
                array_push($get_inactive_coverage, 'found');
            }
        }

        if (in_array('found', $get_inactive_coverage)) {
            return redirect('user/sms/send-sms')->with([
                'message' => language_data('Phone Number Coverage are not active'),
                'message_important' => true
            ]);
        }


        $total_cost = $get_cost * $msgcount;

        if ($total_cost == 0) {
            return redirect('user/sms/send-sms')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        if ($total_cost > $sms_count) {
            return redirect('user/sms/send-sms')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        Client::where('groupid', $request->client_group)->chunk(30, function ($clients) use ($gateway, $message, $sender_id, $msgcount, $cg_info, $sms_count) {
            foreach ($clients as $i => $c) {
                $this->dispatch(new SendBulkSMS(Auth::guard('client')->user()->id, $c->phone, $gateway, $sender_id, $message, $msgcount, $cg_info));
            }
        });

        $remain_sms = $sms_count - $total_cost;
        $client->sms_limit = $remain_sms;
        $client->save();

        return redirect('user/sms/send-sms')->with([
            'message' => language_data('SMS added in queue and will deliver one by one')
        ]);
    }



    //======================================================================
    // sendSingleScheduleSMS Function Start Here
    //======================================================================
    public function sendSingleScheduleSMS()
    {
        return view('client.send-single-schedule-sms');
    }


    //======================================================================
    // postSingleScheduleSMS Function Start Here
    //======================================================================
    public function postSingleScheduleSMS(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'phone_number' => 'required', 'message' => 'required', 'schedule_time' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/send-single-schedule-sms')->withErrors($v->errors());
        }

        $client = Client::find(Auth::guard('client')->user()->id);

        if ($client == '') {
            return redirect('user/sms/send-single-schedule-sms')->with([
                'message' => language_data('Client info not found'),
                'message_important' => true
            ]);
        }

        $gateway = SMSGateways::find($client->sms_gateway);
        if ($gateway->status != 'Active') {
            return redirect('user/sms/send-single-schedule-sms')->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;
        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);
        $sender_id = $request->sender_id;

        $phone = str_replace('+', '', $request->phone_number);
        $c_phone = PhoneNumber::get_code($phone);

        $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();

        if ($sms_cost) {
            $total_cost = $sms_cost->tariff * $msgcount;

            if ($total_cost == 0) {
                return redirect('user/sms/send-single-schedule-sms')->with([
                    'message' => language_data('You do not have enough sms balance'),
                    'message_important' => true
                ]);
            }

            if ($total_cost > $client->sms_limit) {
                return redirect('user/sms/send-single-schedule-sms')->with([
                    'message' => language_data('You do not have enough sms balance'),
                    'message_important' => true
                ]);
            }
        } else {
            return redirect('user/sms/send-single-schedule-sms')->with([
                'message' => language_data('Phone Number Coverage are not active'),
                'message_important' => true
            ]);
        }


        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/send-single-schedule-sms')->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $schedule_time = date('Y-m-d H:i:s', strtotime($request->schedule_time));

        ScheduleSMS::create([
            'userid' => $client->id,
            'sender' => $sender_id,
            'receiver' => $request->phone_number,
            'amount' => $msgcount,
            'original_msg' => $message,
            'encrypt_msg' => base64_encode($message),
            'submit_time' => $schedule_time,
            'ip' => request()->ip(),
            'use_gateway' => $gateway->id
        ]);

        $remain_sms = $client->sms_limit - $total_cost;
        $client->sms_limit = $remain_sms;
        $client->save();

        return redirect('user/sms/send-single-schedule-sms')->with([
            'message' => language_data('SMS are scheduled. Deliver in correct time')
        ]);

    }

    //======================================================================
    // purchaseSMSPlan Function Start Here
    //======================================================================
    public function purchaseSMSPlan()
    {
        $price_plan = SMSPricePlan::where('status', 'Active')->get();
        return view('client.sms-price-plan', compact('price_plan'));
    }

    //======================================================================
    // smsPlanFeature Function Start Here
    //======================================================================
    public function smsPlanFeature($id)
    {
        $sms_plan = SMSPricePlan::where('status', 'Active')->find($id);

        if ($sms_plan) {
            $plan_feature = SMSPlanFeature::where('pid', $id)->get();
            $payment_gateways = PaymentGateways::where('status', 'Active')->get();
            return view('client.sms-plan-feature', compact('sms_plan', 'plan_feature', 'payment_gateways'));
        } else {
            return redirect('user/sms/purchase-sms-plan')->with([
                'message' => language_data('SMS plan not found'),
                'message_important' => true
            ]);
        }
    }

    //======================================================================
    // sendSMSFromFile Function Start Here
    //======================================================================
    public function sendSMSFromFile()
    {
        return view('client.send-sms-file');
    }

    //======================================================================
    // downloadSampleSMSFile Function Start Here
    //======================================================================
    public function downloadSampleSMSFile()
    {
        return response()->download('assets/test_file/sms.csv');
    }

    //======================================================================
    // postSMSFromFile Function Start Here
    //======================================================================
    public function postSMSFromFile(Request $request)
    {

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/sms/send-sms-file')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'import_numbers' => 'required', 'message' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/send-sms-file')->withErrors($v->errors());
        }

        $client = Client::find(Auth::guard('client')->user()->id);
        $sms_count = $client->sms_limit;
        $sender_id = $request->sender_id;

        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/send-single-sms')->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $gateway = SMSGateways::find($client->sms_gateway);

        if ($gateway->status != 'Active') {
            return redirect('user/sms/send-sms-file')->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;


        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);


        $file_extension = Input::file('import_numbers')->getClientOriginalExtension();

        $supportedExt = array('csv', 'xls', 'xlsx');

        if (!in_array_r($file_extension, $supportedExt)) {
            return redirect('user/sms/send-sms-file')->with([
                'message' => language_data('Insert Valid Excel or CSV file'),
                'message_important' => true
            ]);
        }

        $results = Excel::load($request->import_numbers)->get();


        $get_cost = 0;
        $get_inactive_coverage = [];

        if ($results->count() <= 0) {
            return redirect('user/sms/send-sms-file')->with([
                'message' => language_data('Client Group is empty'),
                'message_important' => true
            ]);
        }

        foreach ($results as $c) {
            $phone = str_replace('+', '', $c->phone_number);
            $c_phone = PhoneNumber::get_code($phone);

            $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();

            if ($sms_cost) {
                $sms_charge = $sms_cost->tariff;
                $get_cost += $sms_charge;
            } else {
                array_push($get_inactive_coverage, 'found');
            }
        }

        if (in_array('found', $get_inactive_coverage)) {
            return redirect('user/sms/send-sms-file')->with([
                'message' => language_data('Phone Number Coverage are not active'),
                'message_important' => true
            ]);
        }

        $total_cost = $get_cost * $msgcount;

        if ($total_cost == 0) {
            return redirect('user/sms/send-sms-file')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        if ($total_cost > $sms_count) {
            return redirect('user/sms/send-sms-file')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        foreach ($results->chunk(30) as $clients) {
            foreach ($clients as $i => $c) {
                $this->dispatch(new SendBulkSMS(Auth::guard('client')->user()->id, $c->phone_number, $gateway, $sender_id, $message, $msgcount, $cg_info));

            }
        }

        $remain_sms = $sms_count - $total_cost;
        $client->sms_limit = $remain_sms;
        $client->save();


        return redirect('user/sms/send-sms-file')->with([
            'message' => language_data('SMS added in queue and will deliver one by one')
        ]);

    }

    //======================================================================
    // sendScheduleSMS Function Start Here
    //======================================================================
    public function sendScheduleSMS()
    {
        $client_group = ClientGroups::where('status', 'Yes')->where('created_by', Auth::guard('client')->user()->id)->get();
        $gateways = SMSGateways::where('status', 'Active')->where('schedule', 'Yes')->find(Auth::guard('client')->user()->sms_gateway);

        if ($gateways == '') {
            return redirect('dashboard')->with([
                'message' => language_data('Schedule feature not supported'),
            ]);
        }

        return view('client.send-schedule-sms', compact('client_group', 'gateways'));
    }


    //======================================================================
    // postScheduleSMS Function Start Here
    //======================================================================
    public function postScheduleSMS(Request $request)
    {

        $v = \Validator::make($request->all(), [
            'client_group' => 'required', 'message' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/send-schedule-sms')->withErrors($v->errors());
        }

        $client = Client::find(Auth::guard('client')->user()->id);
        $sms_count = $client->sms_limit;
        $sender_id = $request->sender_id;

        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/send-single-sms')->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $gateway = SMSGateways::find($client->sms_gateway);

        if ($gateway->status != 'Active') {
            return redirect('user/sms/send-schedule-sms')->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;

        $schedule_time = date('Y-m-d H:i:s', strtotime($request->schedule_time));

        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);


        $get_cost = 0;
        $get_inactive_coverage = [];
        $all_clients = Client::where('groupid', $request->client_group)->get();

        if ($all_clients->count() <= 0) {
            return redirect('user/sms/send-schedule-sms')->with([
                'message' => language_data('Client Group is empty'),
                'message_important' => true
            ]);
        }

        foreach ($all_clients as $c) {
            $phone = str_replace('+', '', $c->phone);
            $c_phone = PhoneNumber::get_code($phone);

            $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();

            if ($sms_cost) {
                $sms_charge = $sms_cost->tariff;
                $get_cost += $sms_charge;
            } else {
                array_push($get_inactive_coverage, 'found');
            }
        }

        if (in_array('found', $get_inactive_coverage)) {
            return redirect('user/sms/send-schedule-sms')->with([
                'message' => language_data('Phone Number Coverage are not active'),
                'message_important' => true
            ]);
        }

        $total_cost = $get_cost * $msgcount;


        if ($total_cost == 0) {
            return redirect('user/sms/send-schedule-sms')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        if ($total_cost > $sms_count) {
            return redirect('user/sms/send-schedule-sms')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        Client::where('groupid', $request->client_group)->chunk(30, function ($clients) use ($message, $sender_id, $msgcount, $schedule_time) {
            foreach ($clients as $c) {

                ScheduleSMS::create([
                    'userid' => Auth::guard('client')->user()->id,
                    'sender' => $sender_id,
                    'receiver' => $c->phone,
                    'amount' => $msgcount,
                    'original_msg' => $message,
                    'encrypt_msg' => base64_encode($message),
                    'submit_time' => $schedule_time,
                    'ip' => request()->ip(),
                    'use_gateway' => Auth::guard('client')->user()->sms_gateway
                ]);

            }
        });

        $remain_sms = $sms_count - $total_cost;
        $client->sms_limit = $remain_sms;
        $client->save();

        return redirect('user/sms/send-schedule-sms')->with([
            'message' => language_data('SMS are scheduled. Deliver in correct time')
        ]);
    }

    //======================================================================
    // sendScheduleSMSFromFile Function Start Here
    //======================================================================
    public function sendScheduleSMSFromFile()
    {

        $gateways = SMSGateways::where('status', 'Active')->where('schedule', 'Yes')->find(Auth::guard('client')->user()->sms_gateway);

        if ($gateways == '') {
            return redirect('dashboard')->with([
                'message' => language_data('Schedule feature not supported'),
            ]);
        }


        return view('client.send-schedule-sms-file', compact('gateways'));
    }


    //======================================================================
    // postScheduleSMSFromFile Function Start Here
    //======================================================================
    public function postScheduleSMSFromFile(Request $request)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/sms/send-schedule-sms-file')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'import_numbers' => 'required', 'message' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/send-schedule-sms-file')->withErrors($v->errors());
        }

        $client = Client::find(Auth::guard('client')->user()->id);
        $sms_count = $client->sms_limit;
        $sender_id = $request->sender_id;

        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/send-single-sms')->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $gateway = SMSGateways::find($client->sms_gateway);

        if ($gateway->status != 'Active') {
            return redirect('user/sms/send-schedule-sms-file')->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;


        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);


        $file_extension = Input::file('import_numbers')->getClientOriginalExtension();

        $supportedExt = array('csv', 'xls', 'xlsx');

        if (!in_array_r($file_extension, $supportedExt)) {
            return redirect('user/sms/send-schedule-sms-file')->with([
                'message' => language_data('Insert Valid Excel or CSV file'),
                'message_important' => true
            ]);
        }

        $results = Excel::load($request->import_numbers)->get();

        if ($results->count() <= 0) {
            return redirect('user/sms/send-schedule-sms-file')->with([
                'message' => language_data('Client Group is empty'),
                'message_important' => true
            ]);
        }

        $get_cost = 0;
        $get_inactive_coverage = [];


        foreach ($results as $c) {
            $phone = str_replace('+', '', $c->phone_number);
            $c_phone = PhoneNumber::get_code($phone);

            $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();

            if ($sms_cost) {
                $sms_charge = $sms_cost->tariff;
                $get_cost += $sms_charge;
            } else {
                array_push($get_inactive_coverage, 'found');
            }
        }

        if (in_array('found', $get_inactive_coverage)) {
            return redirect('user/sms/send-schedule-sms-file')->with([
                'message' => language_data('Phone Number Coverage are not active'),
                'message_important' => true
            ]);
        }

        $total_cost = $get_cost * $msgcount;


        if ($total_cost == 0) {
            return redirect('user/sms/send-schedule-sms-file')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        if ($total_cost > $sms_count) {
            return redirect('user/sms/send-schedule-sms-file')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        $schedule_time = date('Y-m-d H:i:s', strtotime($request->schedule_time));

        foreach ($results as $r) {

            ScheduleSMS::create([
                'userid' => Auth::guard('client')->user()->id,
                'sender' => $sender_id,
                'receiver' => $r->phone_number,
                'amount' => $msgcount,
                'original_msg' => $message,
                'encrypt_msg' => base64_encode($message),
                'submit_time' => $schedule_time,
                'ip' => request()->ip(),
                'use_gateway' => Auth::guard('client')->user()->sms_gateway
            ]);
        }

        $remain_sms = $sms_count - $total_cost;
        $client->sms_limit = $remain_sms;
        $client->save();


        return redirect('user/sms/send-schedule-sms-file')->with([
            'message' => language_data('SMS are scheduled. Deliver in correct time')
        ]);

    }

    //======================================================================
    // smsHistory Function Start Here
    //======================================================================
    public function smsHistory()
    {

        $sms_history = SMSHistory::orderBy('updated_at', 'desc')->where('userid', Auth::guard('client')->user()->id)->get();
        return view('client.sms-history', compact('sms_history'));
    }


    //======================================================================
    // smsViewInbox Function Start Here
    //======================================================================
    public function smsViewInbox($id)
    {

        $inbox_info = SMSHistory::where('userid', Auth::guard('client')->user()->id)->find($id);

        if ($inbox_info) {
            $sms_inbox = SMSInbox::where('msg_id', $id)->get();
            return view('client.sms-inbox', compact('sms_inbox', 'inbox_info'));
        } else {
            return redirect('user/sms/history')->with([
                'message' => language_data('SMS Not Found'),
                'message_important' => true
            ]);
        }

    }


    //======================================================================
    // deleteSMS Function Start Here
    //======================================================================
    public function deleteSMS($id)
    {

        $inbox_info = SMSHistory::where('userid', Auth::guard('client')->user()->id)->find($id);

        if ($inbox_info) {
            SMSInbox::where('msg_id', $id)->delete();
            $inbox_info->delete();

            return redirect('user/sms/history')->with([
                'message' => language_data('SMS info deleted successfully')
            ]);
        } else {
            return redirect('sms/history')->with([
                'message' => language_data('SMS Not Found'),
                'message_important' => true
            ]);
        }

    }



    //======================================================================
    // apiInfo Function Start Here
    //======================================================================
    public function apiInfo()
    {
        return view('client.sms-api-info');
    }

    //======================================================================
    // updateApiInfo Function Start Here
    //======================================================================
    public function updateApiInfo(Request $request)
    {

        $v = \Validator::make($request->all(), [
            'api_key' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms-api/info')->withErrors($v->errors());
        }

        if ($request->api_key != '') {
            Client::where('id', Auth::guard('client')->user()->id)->where('api_access', 'Yes')->update(['api_key' => $request->api_key]);
        }


        return redirect('user/sms-api/info')->with([
            'message' => language_data('API information updated successfully')
        ]);

    }


    /*Version 1.1*/


    //======================================================================
    // updateScheduleSMS Function Start Here
    //======================================================================
    public function updateScheduleSMS()
    {
        $sms_history = ScheduleSMS::where('userid', Auth::guard('client')->user()->id)->get();
        return view('client.update-schedule-sms', compact('sms_history'));
    }



    //======================================================================
    // manageUpdateScheduleSMS Function Start Here
    //======================================================================
    public function manageUpdateScheduleSMS($id)
    {
        $sh = ScheduleSMS::find($id);

        if ($sh) {
            return view('client.manage-update-schedule-sms', compact('sh'));
        } else {
            return redirect('user/sms/update-schedule-sms')->with([
                'message' => language_data('Please try again'),
                'message_important' => true
            ]);
        }
    }


    //======================================================================
    // postUpdateScheduleSMS Function Start Here
    //======================================================================
    public function postUpdateScheduleSMS(Request $request)
    {

        $cmd = $request->cmd;

        $v = \Validator::make($request->all(), [
            'phone_number' => 'required', 'message' => 'required', 'schedule_time' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/manage-update-schedule-sms/' . $cmd)->withErrors($v->errors());
        }

        $client = Client::find(Auth::guard('client')->user()->id);

        if ($client == '') {
            return redirect('user/sms/manage-update-schedule-sms/' . $cmd)->with([
                'message' => language_data('Client info not found'),
                'message_important' => true
            ]);
        }

        $gateway = SMSGateways::find($client->sms_gateway);
        if ($gateway->status != 'Active') {
            return redirect('user/sms/manage-update-schedule-sms/' . $cmd)->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;
        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);
        $sender_id = $request->sender_id;

        $phone = str_replace('+', '', $request->phone_number);
        $c_phone = PhoneNumber::get_code($phone);

        $sms_info = ScheduleSMS::find($cmd);

        $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();

        if ($sms_cost) {
            $total_cost = ($sms_cost->tariff * $msgcount);
            if ($total_cost == 0) {
                return redirect('user/sms/manage-update-schedule-sms/' . $cmd)->with([
                    'message' => language_data('You do not have enough sms balance'),
                    'message_important' => true
                ]);
            }

            $total_cost -= $sms_info->amount;

            if ($total_cost > $client->sms_limit) {
                return redirect('user/sms/manage-update-schedule-sms/' . $cmd)->with([
                    'message' => language_data('You do not have enough sms balance'),
                    'message_important' => true
                ]);
            }
        } else {
            return redirect('user/sms/manage-update-schedule-sms/' . $cmd)->with([
                'message' => language_data('Phone Number Coverage are not active'),
                'message_important' => true
            ]);
        }


        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/manage-update-schedule-sms/' . $cmd)->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $schedule_time = date('Y-m-d H:i:s', strtotime($request->schedule_time));

        ScheduleSMS::where('id', $request->cmd)->update([
            'sender' => $sender_id,
            'receiver' => $request->phone_number,
            'amount' => $msgcount,
            'original_msg' => $message,
            'submit_time' => $schedule_time,
        ]);

        $remain_sms = $client->sms_limit - $total_cost;
        $client->sms_limit = $remain_sms;
        $client->save();

        return redirect('user/sms/update-schedule-sms')->with([
            'message' => language_data('SMS are scheduled. Deliver in correct time')
        ]);

    }

    //======================================================================
    // deleteScheduleSMS Function Start Here
    //======================================================================
    public function deleteScheduleSMS($id)
    {

        $sh = ScheduleSMS::find($id);
        if ($sh) {
            $client = Client::find($sh->userid);
            $client->sms_limit += $sh->amount;
            $client->save();

            $sh->delete();
            return redirect('user/sms/update-schedule-sms')->with([
                'message' => language_data('SMS info deleted successfully')
            ]);
        } else {
            return redirect('user/sms/update-schedule-sms')->with([
                'message' => language_data('Please try again'),
                'message_important' => true
            ]);
        }
    }

    //======================================================================
    // Version 1.2
    //======================================================================

    //======================================================================
    // sendBulkBirthdaySMS Function Start Here
    //======================================================================
    public function sendBulkBirthdaySMS()
    {
        return view('client.send-bulk-birthday-sms');
    }

    //======================================================================
    // downloadBirthdaySMSFile Function Start Here
    //======================================================================
    public function downloadBirthdaySMSFile()
    {
        return response()->download('assets/test_file/birthday-sms.csv');
    }

    //======================================================================
    // postBirthdaySMS Function Start Here
    //======================================================================
    public function postBirthdaySMS(Request $request)
    {

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/sms/send-bulk-birthday-sms')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'import_numbers' => 'required', 'message' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/send-bulk-birthday-sms')->withErrors($v->errors());
        }


        $client = Client::find(Auth::guard('client')->user()->id);
        $sms_count = $client->sms_limit;
        $sender_id = $request->sender_id;

        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/send-bulk-birthday-sms')->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $gateway = SMSGateways::find($client->sms_gateway);

        if ($gateway->status != 'Active') {
            return redirect('user/sms/send-bulk-birthday-sms')->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;


        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);

        $file_extension = Input::file('import_numbers')->getClientOriginalExtension();
        $supportedExt = array('csv', 'xls', 'xlsx');

        if (!in_array_r($file_extension, $supportedExt)) {
            return redirect('user/sms/send-bulk-birthday-sms')->with([
                'message' => language_data('Insert Valid Excel or CSV file'),
                'message_important' => true
            ]);
        }

        $results = Excel::load($request->import_numbers)->get();

        if ($results->count() <= 0) {
            return redirect('user/sms/send-bulk-birthday-sms')->with([
                'message' => language_data('Client Group is empty'),
                'message_important' => true
            ]);
        }

        $get_cost = 0;
        $get_inactive_coverage = [];

        foreach ($results as $c) {
            $phone = str_replace('+', '', $c->phone_number);
            $c_phone = PhoneNumber::get_code($phone);

            $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();

            if ($sms_cost) {
                $sms_charge = $sms_cost->tariff;
                $get_cost += $sms_charge;
            } else {
                array_push($get_inactive_coverage, 'found');
            }
        }

        if (in_array('found', $get_inactive_coverage)) {
            return redirect('user/sms/send-bulk-birthday-sms')->with([
                'message' => language_data('Phone Number Coverage are not active'),
                'message_important' => true
            ]);
        }

        $total_cost = $get_cost * $msgcount;

        if ($total_cost == 0) {
            return redirect('user/sms/send-bulk-birthday-sms')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        if ($total_cost > $sms_count) {
            return redirect('user/sms/send-bulk-birthday-sms')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        foreach ($results as $r) {

            if ($r->birthday != '') {
                $schedule_time = date('Y-m-d H:i:s', strtotime($r->birthday));

                ScheduleSMS::create([
                    'userid' => Auth::guard('client')->user()->id,
                    'sender' => $sender_id,
                    'receiver' => $r->phone_number,
                    'amount' => $msgcount,
                    'original_msg' => $message,
                    'encrypt_msg' => base64_encode($message),
                    'submit_time' => $schedule_time,
                    'ip' => request()->ip(),
                    'use_gateway' => Auth::guard('client')->user()->sms_gateway
                ]);
            }
        }

        $remain_sms = $sms_count - $total_cost;
        $client->sms_limit = $remain_sms;
        $client->save();

        return redirect('user/sms/send-bulk-birthday-sms')->with([
            'message' => language_data('SMS are scheduled. Deliver in correct time')
        ]);

    }


    //======================================================================
    // sendBulkSMSRemainder Function Start Here
    //======================================================================
    public function sendBulkSMSRemainder()
    {
        return view('client.send-bulk-remainder-sms');
    }

    //======================================================================
    // downloadRemainderSMSFile Function Start Here
    //======================================================================
    public function downloadRemainderSMSFile()
    {
        return response()->download('assets/test_file/remainder-sms.csv');
    }


    //======================================================================
    // postRemainderSMS Function Start Here
    //======================================================================
    public function postRemainderSMS(Request $request)
    {

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/sms/send-bulk-sms-remainder')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'import_numbers' => 'required', 'message' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/send-bulk-sms-remainder')->withErrors($v->errors());
        }

        $client = Client::find(Auth::guard('client')->user()->id);
        $sms_count = $client->sms_limit;
        $sender_id = $request->sender_id;

        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/send-bulk-sms-remainder')->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $gateway = SMSGateways::find($client->sms_gateway);

        if ($gateway->status != 'Active') {
            return redirect('user/sms/send-bulk-sms-remainder')->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;
        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);

        $file_extension = Input::file('import_numbers')->getClientOriginalExtension();
        $supportedExt = array('csv', 'xls', 'xlsx');

        if (!in_array_r($file_extension, $supportedExt)) {
            return redirect('user/sms/send-bulk-sms-remainder')->with([
                'message' => language_data('Insert Valid Excel or CSV file'),
                'message_important' => true
            ]);
        }

        $results = Excel::load($request->import_numbers)->get();

        if ($results->count() <= 0) {
            return redirect('user/sms/send-bulk-sms-remainder')->with([
                'message' => language_data('Client Group is empty'),
                'message_important' => true
            ]);
        }

        $get_cost = 0;
        $get_inactive_coverage = [];

        foreach ($results as $c) {
            $phone = str_replace('+', '', $c->phone_number);
            $c_phone = PhoneNumber::get_code($phone);

            $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();

            if ($sms_cost) {
                $sms_charge = $sms_cost->tariff;
                $get_cost += $sms_charge;
            } else {
                array_push($get_inactive_coverage, 'found');
            }
        }

        if (in_array('found', $get_inactive_coverage)) {
            return redirect('user/sms/send-bulk-sms-remainder')->with([
                'message' => language_data('Phone Number Coverage are not active'),
                'message_important' => true
            ]);
        }

        $total_cost = $get_cost * $msgcount;

        if ($total_cost == 0) {
            return redirect('user/sms/send-bulk-sms-remainder')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        if ($total_cost > $sms_count) {
            return redirect('user/sms/send-bulk-sms-remainder')->with([
                'message' => language_data('You do not have enough sms balance'),
                'message_important' => true
            ]);
        }

        foreach ($results as $r) {

            if ($r->remainder_date != '') {
                $schedule_time = date('Y-m-d H:i:s', strtotime($r->remainder_date));

                ScheduleSMS::create([
                    'userid' => Auth::guard('client')->user()->id,
                    'sender' => $sender_id,
                    'receiver' => $r->phone_number,
                    'amount' => $msgcount,
                    'original_msg' => $message,
                    'encrypt_msg' => base64_encode($message),
                    'submit_time' => $schedule_time,
                    'ip' => request()->ip(),
                    'use_gateway' => Auth::guard('client')->user()->sms_gateway
                ]);
            }
        }

        $remain_sms = $sms_count - $total_cost;
        $client->sms_limit = $remain_sms;
        $client->save();

        return redirect('user/sms/send-bulk-sms-remainder')->with([
            'message' => language_data('SMS are scheduled. Deliver in correct time')
        ]);
    }



    /*Verson 1.2*/

    //======================================================================
    // importPhoneNumber Function Start Here
    //======================================================================
    public function importPhoneNumber()
    {
        $clientGroups = ImportPhoneNumber::where('user_id', Auth::guard('client')->user()->id)->get();
        return view('client.import-phone-number', compact('clientGroups'));
    }

    //======================================================================
    // postImportPhoneNumber Function Start Here
    //======================================================================
    public function postImportPhoneNumber(Request $request)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/sms/import-phone-number')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'import_numbers' => 'required', 'group_name' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/import-phone-number')->withErrors($v->errors());
        }

        $file_extension = Input::file('import_numbers')->getClientOriginalExtension();

        $supportedExt = array('csv', 'xls', 'xlsx');

        if (!in_array_r($file_extension, $supportedExt)) {
            return redirect('user/sms/import-phone-number')->with([
                'message' => language_data('Insert Valid Excel or CSV file'),
                'message_important' => true
            ]);
        }

        $results = Excel::load($request->import_numbers)->get()->toArray();
        $results = json_encode($results);

        ImportPhoneNumber::create([
            'user_id' => Auth::guard('client')->user()->id,
            'group_name' => $request->group_name,
            'numbers' => $results
        ]);

        return redirect('user/sms/import-phone-number')->with([
            'message' => 'Phone number imported successfully'
        ]);

    }

    //======================================================================
    // deleteImportPhoneNumber Function Start Here
    //======================================================================
    public function deleteImportPhoneNumber($id)
    {

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/sms/import-phone-number')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $clientGroup = ImportPhoneNumber::find($id);

        if ($clientGroup) {

            $clientGroup->delete();

            return redirect('user/sms/import-phone-number')->with([
                'message' => language_data('Client group deleted successfully')
            ]);

        } else {
            return redirect('user/sms/import-phone-number')->with([
                'message' => language_data('Client Group not found'),
                'message_important' => true
            ]);
        }
    }

    //======================================================================
    // sendSMSByPhoneNumber Function Start Here
    //======================================================================
    public function sendSMSByPhoneNumber()
    {
        $client_group = ImportPhoneNumber::where('user_id', Auth::guard('client')->user()->id)->get();
        return view('client.send-sms-by-phone-number', compact('client_group'));

    }

    //======================================================================
    // postSendSMSByPhoneNumber Function Start Here
    //======================================================================
    public function postSendSMSByPhoneNumber(Request $request)
    {

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/sms/send-sms-phone-number')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }


        $v = \Validator::make($request->all(), [
            'client_group' => 'required', 'message' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/sms/send-sms-phone-number')->withErrors($v->errors());
        }

        $client = Client::find(Auth::guard('client')->user()->id);
        $sms_count = $client->sms_limit;
        $sender_id = $request->sender_id;

        if ($sender_id != '' && app_config('sender_id_verification') == '1') {
            $all_sender_id = SenderIdManage::all();
            $all_ids = [];

            foreach ($all_sender_id as $sid) {
                $client_array = json_decode($sid->cl_id);

                if (in_array('0', $client_array)) {
                    array_push($all_ids, $sender_id);
                } elseif (in_array(Auth::guard('client')->user()->id, $client_array)) {
                    array_push($all_ids, $sid->sender_id);
                }
            }
            $all_ids = array_unique($all_ids);

            if (!in_array($sender_id, $all_ids)) {
                return redirect('user/sms/send-sms-phone-number')->with([
                    'message' => language_data('This Sender ID have Blocked By Administrator'),
                    'message_important' => true
                ]);
            }
        }

        $gateway = SMSGateways::find($client->sms_gateway);

        if ($gateway->status != 'Active') {
            return redirect('user/sms/send-sms-phone-number')->with([
                'message' => language_data('SMS gateway not active.Contact with Provider'),
                'message_important' => true
            ]);
        }

        if ($gateway->custom == 'Yes') {
            $cg_info = CustomSMSGateways::where('gateway_id', $client->sms_gateway)->first();
        } else {
            $cg_info = '';
        }

        $message = $request->message;
        $msgcount = strlen($message);
        $msgcount = $msgcount / 160;
        $msgcount = ceil($msgcount);

        $get_numbers = ImportPhoneNumber::find($request->client_group);

        if ($get_numbers) {
            $results = json_decode($get_numbers->numbers);
            if (count($results) <= 0) {
                return redirect('user/sms/send-sms-phone-number')->with([
                    'message' => language_data('Client Group is empty'),
                    'message_important' => true
                ]);
            }

            $get_cost = 0;
            $get_inactive_coverage = [];


            foreach ($results as $c) {
                $phone = str_replace('+', '', $c->phone_number);
                $c_phone = PhoneNumber::get_code($phone);

                $sms_cost = IntCountryCodes::where('country_code', $c_phone)->where('active', '1')->first();

                if ($sms_cost) {
                    $sms_charge = $sms_cost->tariff;
                    $get_cost += $sms_charge;
                } else {
                    array_push($get_inactive_coverage, 'found');
                }
            }

            if (in_array('found', $get_inactive_coverage)) {
                return redirect('user/sms/send-sms-phone-number')->with([
                    'message' => language_data('Phone Number Coverage are not active'),
                    'message_important' => true
                ]);
            }

            $total_cost = $get_cost * $msgcount;

            if ($total_cost == 0) {
                return redirect('user/sms/send-sms-phone-number')->with([
                    'message' => language_data('You do not have enough sms balance'),
                    'message_important' => true
                ]);
            }

            if ($total_cost > $sms_count) {
                return redirect('user/sms/send-sms-phone-number')->with([
                    'message' => language_data('You do not have enough sms balance'),
                    'message_important' => true
                ]);
            }

            StoreBulkSMS::create([
                'userid' => Auth::guard('client')->user()->id,
                'sender' => $sender_id,
                'receiver' => $get_numbers->numbers,
                'amount' => $msgcount,
                'message' => $message,
                'status' => 0,
                'use_gateway' => $gateway->id
            ]);

            $remain_sms = $sms_count - $total_cost;
            $client->sms_limit = $remain_sms;
            $client->save();

            return redirect('user/sms/send-sms-phone-number')->with([
                'message' => language_data('SMS added in queue and will deliver one by one')
            ]);

        } else {
            return redirect('user/sms/send-sms-phone-number')->with([
                'message' => language_data('Client Group not found'),
                'message_important' => true
            ]);
        }
    }
}
