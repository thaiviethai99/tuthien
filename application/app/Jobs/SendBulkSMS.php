<?php

namespace App\Jobs;

use Aloha\Twilio\Twilio;
use App\Classes\SmsGateway;
use App\Client;
use App\SMSHistory;
use App\SMSInbox;
use Elibom\APIClient\ElibomClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Plivo\RestAPI;
use Auth;
use DB;
class SendBulkSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cl_phone;
    protected $user_id;
    protected $gateway;
    protected $sender_id;
    protected $message;
    protected $msgcount;
    protected $cg_info;
    protected $api_key;
    protected $get_sms_status;
    public $tries = 2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $cl_phone, $gateway, $sender_id, $message, $msgcount, $cg_info = '', $api_key = '')
    {
        $this->cl_phone  = $cl_phone;
        $this->gateway   = $gateway;
        $this->sender_id = $sender_id;
        $this->message   = $message;
        $this->msgcount  = $msgcount;
        $this->cg_info   = $cg_info;
        $this->api_key   = $api_key;
        $this->user_id   = $user_id;

    }

    private function make_stop_dup_id()
    {
        return 0;
    }

    private function make_post_body($post_fields)
    {
        $stop_dup_id = $this->make_stop_dup_id();
        if ($stop_dup_id > 0) {
            $post_fields['stop_dup_id'] = $this->make_stop_dup_id();
        }
        $post_body = '';
        foreach ($post_fields as $key => $value) {
            $post_body .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $post_body = rtrim($post_body, '&');

        return $post_body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $gateway_url       = $this->gateway->api_link;
        $gateway_name      = $this->gateway->name;
        $gateway_user_name = $this->gateway->username;
        $gateway_password  = $this->gateway->password;
        $gateway_extra     = $this->gateway->api_id;

        $client_ip = request()->ip();

        if ($this->gateway->custom == 'Yes') {
            $get_sms_status = 'Schedule sms not supported in custom gateway';
        }

        if ($this->gateway->custom == 'Yes' && $this->cg_info != '') {

            $send_custom_data = array();
            $username_param   = $this->cg_info->username_param;
            $username_value   = $this->cg_info->username_value;

            $send_custom_data[$username_param] = $username_value;

            if ($this->cg_info->password_status == 'yes') {
                $password_param = $this->cg_info->password_param;
                $password_value = $this->cg_info->password_value;

                $send_custom_data[$password_param] = $password_value;
            }

            if ($this->cg_info->action_status == 'yes') {
                $action_param = $this->cg_info->action_param;
                $action_value = $this->cg_info->action_value;

                $send_custom_data[$action_param] = $action_value;
            }

            if ($this->cg_info->source_status == 'yes') {
                $source_param = $this->cg_info->source_param;
                $source_value = $this->cg_info->source_value;

                $send_custom_data[$source_param] = $source_value;
            }

            $destination_param                    = $this->cg_info->destination_param;
            $send_custom_data[$destination_param] = $this->cl_phone;

            $message_param                    = $this->cg_info->message_param;
            $send_custom_data[$message_param] = $this->message;

            if ($this->cg_info->route_status == 'yes') {
                $route_param = $this->cg_info->route_param;
                $route_value = $this->cg_info->route_value;

                $send_custom_data[$route_param] = $route_value;
            }

            if ($this->cg_info->language_status == 'yes') {
                $language_param = $this->cg_info->language_param;
                $language_value = $this->cg_info->language_value;

                $send_custom_data[$language_param] = $language_value;
            }

            if ($this->cg_info->custom_one_status == 'yes') {
                $custom_one_param = $this->cg_info->custom_one_param;
                $custom_one_value = $this->cg_info->custom_one_value;

                $send_custom_data[$custom_one_param] = $custom_one_value;
            }

            if ($this->cg_info->custom_two_status == 'yes') {
                $custom_two_param = $this->cg_info->custom_two_param;
                $custom_two_value = $this->cg_info->custom_two_value;

                $send_custom_data[$custom_two_param] = $custom_two_value;
            }

            if ($this->cg_info->custom_three_status == 'yes') {
                $custom_three_param = $this->cg_info->custom_three_param;
                $custom_three_value = $this->cg_info->custom_three_value;

                $send_custom_data[$custom_three_param] = $custom_three_value;
            }

            $get_post_data = $this->make_post_body($send_custom_data);

            try {
                $sms_sent_to_user = $gateway_url . "?" . $get_post_data;
                $get_sms_status   = file_get_contents($sms_sent_to_user);

            } catch (\Exception $e) {
                $get_sms_status = $e->getMessage();
            }
        } else {
            switch ($gateway_name) {
                case 'Twilio':

                    try {
                        $twilio         = new Twilio($gateway_user_name, $gateway_password, $this->sender_id);
                        $get_response   = $twilio->message($this->cl_phone, $this->message);
                        $get_sms_status = 'Success|' . $get_response->sid;
                    } catch (\Exception $e) {
                        $get_sms_status = $e->getMessage();
                    }
                    break;

                case 'Clickatell':

                    $clphone = $this->cl_phone;
                    $clphone = sprintf("%+d", $clphone);

                    $gateway_url = rtrim($gateway_url, '/');
                    $gateway_url = $gateway_url . '/messages';

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $gateway_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"content\": \"$this->message\", \"to\": [\"$clphone\"], \"from\": \"$this->sender_id\"}");
                    curl_setopt($ch, CURLOPT_POST, 1);

                    $headers   = array();
                    $headers[] = "Content-Type: application/json";
                    $headers[] = "Accept: application/json";
                    $headers[] = "Authorization: $gateway_extra";
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        $get_sms_status = curl_error($ch);
                    }
                    curl_close($ch);

                    $decoded_response = json_decode($result, true);

                    if (array_key_exists('error', $decoded_response)) {
                        if ($decoded_response['error'] == null) {
                            foreach ($decoded_response['messages'] as $message) {
                                $get_sms_status = 'Success|' . $message['apiMessageId'];
                            }
                        } else {
                            $get_sms_status = $decoded_response['error'];
                        }
                    }
                    break;

                case 'SMSKaufen':

                    $sender_id = urlencode($this->sender_id);
                    $message   = urlencode($this->message);

                    $sms_sent_to_user = $gateway_url . "?type=4" . "&id=$gateway_user_name" . "&apikey=$gateway_password" . "&empfaenger=$this->cl_phone" . "&absender=$sender_id" . "&text=$message";

                    $get_sms_status = file_get_contents($sms_sent_to_user);

                    $get_sms_status = str_replace("100", "Success", $get_sms_status);
                    $get_sms_status = str_replace("101", "Success", $get_sms_status);
                    $get_sms_status = str_replace("111", "What IP blocked", $get_sms_status);
                    $get_sms_status = str_replace("112", "Incorrect login data", $get_sms_status);
                    $get_sms_status = str_replace("120", "Sender field is empty", $get_sms_status);
                    $get_sms_status = str_replace("121", "Gateway field is empty", $get_sms_status);
                    $get_sms_status = str_replace("122", "Text is empty", $get_sms_status);
                    $get_sms_status = str_replace("123", "Recipient field is empty", $get_sms_status);
                    $get_sms_status = str_replace("129", "Wrong sender", $get_sms_status);
                    $get_sms_status = str_replace("130", "Gateway Error", $get_sms_status);
                    $get_sms_status = str_replace("131", "Wrong number", $get_sms_status);
                    $get_sms_status = str_replace("132", "Mobile phone is off", $get_sms_status);
                    $get_sms_status = str_replace("133", "Query not possible", $get_sms_status);
                    $get_sms_status = str_replace("134", "Number invalid", $get_sms_status);
                    $get_sms_status = str_replace("140", "No credit", $get_sms_status);
                    $get_sms_status = str_replace("150", "SMS blocked", $get_sms_status);
                    $get_sms_status = str_replace("170", "Date wrong", $get_sms_status);
                    $get_sms_status = str_replace("171", "Date too old", $get_sms_status);
                    $get_sms_status = str_replace("172", "Too many numbers", $get_sms_status);
                    $get_sms_status = str_replace("173", "Format wrong", $get_sms_status);
                    $get_sms_status = str_replace(",", " ", $get_sms_status);
                    break;

                case 'Route SMS':

                    $sender_id = urlencode($this->sender_id);
                    $message   = urlencode($this->message);
                    $sms_url   = rtrim($gateway_url, '/');

                    try {
                        $sms_sent_to_user = "$sms_url" . "/bulksms/bulksms?type=0" . "&username=$gateway_user_name" . "&password=$gateway_password" . "&destination=$this->cl_phone" . "&source=$sender_id" . "&message=$message" . "&dlr=0";

                        $get_sms_status = file_get_contents($sms_sent_to_user);
                        $get_sms_status = str_replace("1701", "Success", $get_sms_status);
                        $get_sms_status = str_replace("1702", "Invalid URL", $get_sms_status);
                        $get_sms_status = str_replace("1703", "Invalid User or Password", $get_sms_status);
                        $get_sms_status = str_replace("1704", "Invalid Type", $get_sms_status);
                        $get_sms_status = str_replace("1705", "Invalid SMS", $get_sms_status);
                        $get_sms_status = str_replace("1706", "Invalid receiver", $get_sms_status);
                        $get_sms_status = str_replace("1707", "Invalid sender", $get_sms_status);
                        $get_sms_status = str_replace("1709", "User Validation Failed", $get_sms_status);
                        $get_sms_status = str_replace("1710", "Internal Error", $get_sms_status);
                        $get_sms_status = str_replace("1715", "Response Timeout", $get_sms_status);
                        $get_sms_status = str_replace("1025", "Insufficient Credit", $get_sms_status);
                        $get_sms_status = str_replace(",", " ", $get_sms_status);

                    } catch (\Exception $e) {
                        $get_sms_status = $e->getMessage();
                    }

                    break;

                case 'SMSGlobal':

                    $clphone   = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone   = str_replace('+', '', $clphone);
                    $sender_id = urlencode($this->sender_id);
                    $message   = urlencode($this->message);

                    $sms_sent_to_user = $gateway_url . "?action=sendsms" . "&user=$gateway_user_name" . "&password=$gateway_password" . "&from=$sender_id" . "&to=$clphone" . "&text=$message" . "&api=1";

                    $get_sms_status = file_get_contents($sms_sent_to_user);
                    $get_sms_status = preg_replace("/[^0-9]/", '', $get_sms_status);

                    $get_sms_status = str_replace("88", "Not enough credits", $get_sms_status);
                    $get_sms_status = str_replace("99", "Unknown error", $get_sms_status);
                    $get_sms_status = str_replace("100", "Incorrect username/password", $get_sms_status);
                    $get_sms_status = str_replace("300", "Missing MSISDN", $get_sms_status);
                    $get_sms_status = str_replace("750", "Invalid MSISDN", $get_sms_status);

                    break;

                case 'Nexmo':

                    $clphone = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone = str_replace('+', '', $clphone);

                    $url = $gateway_url . '?' . http_build_query(
                        [
                            'api_key'    => $gateway_user_name,
                            'api_secret' => $gateway_password,
                            'to'         => $clphone,
                            'from'       => $this->sender_id,
                            'text'       => $this->message,
                        ]
                    );

                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);

                    $decoded_response = json_decode($response, true);

                    foreach ($decoded_response['messages'] as $message) {
                        if ($message['status'] == 0) {
                            $get_sms_status = 'Success|' . $message['message-id'];
                        } else {
                            $get_sms_status = $message['error-text'];
                        }
                    }

                    break;

                case 'Kapow':

                    $posturl = $gateway_url . "?username=$gateway_user_name" . "&password=$gateway_password" . "&mobile=$this->cl_phone" . "&sms=$this->message";

                    if ($this - $this->sender_id != '') {
                        $posturl .= '&from_id=' . urlencode($this->sender_id);
                    }

                    $handle = fopen($posturl, 'r');
                    if ($handle) {
                        $response = stream_get_contents($handle);

                        if (strstr($response, 'OK')) {
                            $get_sms_status = "Success";
                        }
                        if ($response == 'USERPASS') {
                            $get_sms_status = "Your credentials are incorrect";
                        }

                        if ($response == 'ERROR') {
                            $get_sms_status = "Error";
                        }
                        if ($response == 'NOCREDIT') {
                            $get_sms_status = "You have no credits remaining";
                        }
                    } else {
                        $get_sms_status = 'Unable to open URL';
                    }

                    break;

                case 'Zang':

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://api.zang.io/v2/Accounts/{$gateway_user_name}/SMS/Messages.json");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "To=$this->cl_phone&From=$this->sender_id&Body=$this->message");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_USERPWD, "{$gateway_user_name}" . ":" . "{$gateway_password}");

                    $headers   = array();
                    $headers[] = "Content-Type: application/x-www-form-urlencoded";
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        $get_sms_status = curl_error($ch);
                    }
                    curl_close($ch);

                    $decoded_response = json_decode($result, true);
                    if (array_key_exists('message', $decoded_response)) {
                        $get_sms_status = $decoded_response['message'];
                    } elseif (array_key_exists('sid', $decoded_response)) {
                        $get_sms_status = 'Success|' . $decoded_response['sid'];
                    } else {
                        $get_sms_status = 'Api info not correct';
                    }

                    break;

                case 'InfoBip':

                    $api_key = base64_encode($gateway_user_name . ':' . $gateway_password);

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL            => $gateway_url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING       => "",
                        CURLOPT_MAXREDIRS      => 10,
                        CURLOPT_TIMEOUT        => 30,
                        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST  => "POST",
                        CURLOPT_POSTFIELDS     => "{ \"from\":\"$this->sender_id\", \"to\":\"$this->cl_phone\", \"text\":\"$this->message\" }",
                        CURLOPT_HTTPHEADER     => array(
                            "accept: application/json",
                            "authorization: Basic $api_key",
                            "content-type: application/json",
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err      = curl_error($curl);

                    curl_close($curl);

                    $get_data = json_decode($response, true);

                    if (is_array($get_data)) {
                        if (array_key_exists('messages', $get_data)) {
                            foreach ($get_data['messages'] as $msg) {
                                $get_sms_status = 'Success|' . $msg['messageId'];
                            }
                        } elseif (array_key_exists('requestError', $get_data)) {
                            foreach ($get_data['requestError'] as $msg) {
                                $get_sms_status = $msg['text'];
                            }
                        } else {
                            $get_sms_status = 'Unknown error';
                        }
                    } else {
                        $get_sms_status = 'Unknown error';
                    }

                    if ($err) {
                        $get_sms_status = $err;
                    }

                    break;

                case 'RANNH':
                    $clphone   = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone   = str_replace('+', '', $clphone);
                    $sender_id = urlencode($this->sender_id);

                    $sms_sent_to_user = $gateway_url . "?user=$gateway_user_name" . "&password=$gateway_password" . "&numbers=$clphone" . "&sender=$sender_id" . "&message=" . urlencode($this->message) . "&lang=en";

                    $get_sms_status = file_get_contents($sms_sent_to_user);

                    if ($get_sms_status == '1') {
                        $get_sms_status = 'Success';
                    } elseif ($get_sms_status == '0') {
                        $get_sms_status = 'Transmission error';
                    } else {
                    }

                    break;

                case 'Bulk SMS':

                    $clphone   = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone   = str_replace('+', '', $clphone);
                    $sender_id = urlencode($this->sender_id);
                    $url       = $gateway_url . "/eapi/submission/send_sms/2/2.0?username=$gateway_user_name" . "&password=$gateway_password" . "&msisdn=$clphone" . "&message=" . urlencode($this->message);

                    $ret = file_get_contents($url);

                    $send = explode("|", $ret);

                    if ($send[0] == '0') {
                        $get_sms_status = 'In progress';
                    } elseif ($send[0] == '1') {
                        $get_sms_status = 'Scheduled ';
                    } elseif ($send[0] == '22') {
                        $get_sms_status = 'Internal fatal error ';
                    } elseif ($send[0] == '23') {
                        $get_sms_status = 'Authentication failure';
                    } elseif ($send[0] == '24') {
                        $get_sms_status = 'Data validation failed';
                    } elseif ($send[0] == '25') {
                        $get_sms_status = 'You do not have sufficient credits';
                    } elseif ($send[0] == '26') {
                        $get_sms_status = 'Upstream credits not available';
                    } elseif ($send[0] == '27') {
                        $get_sms_status = 'You have exceeded your daily quota';
                    } elseif ($send[0] == '28') {
                        $get_sms_status = 'Upstream quota exceeded';
                    } elseif ($send[0] == '40') {
                        $get_sms_status = 'Temporarily unavailable';
                    } elseif ($send[0] == '201') {
                        $get_sms_status = 'Maximum batch size exceeded';
                    } elseif ($send[0] == '200') {
                        $get_sms_status = 'Success';
                    } else {
                        $get_sms_status = 'Failed';
                    }

                    break;

                /*Verson 1.1*/

                case 'Plivo':

                    $clphone   = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone   = str_replace('+', '', $clphone);
                    $sender_id = urlencode($this->sender_id);

                    $plivo  = new RestAPI($gateway_user_name, $gateway_password);
                    $params = array(
                        'src'  => $sender_id,
                        'dst'  => $clphone,
                        'text' => $this->message,
                    );

                    $response = $plivo->send_message($params);

                    if (array_key_exists('status', $response)) {
                        if ($response['status'] == 202) {
                            $get_sms_status = 'Success|' . $response['response']['message_uuid'][0];
                        } else {
                            $get_sms_status = $response['response'];
                        }
                    } else {
                        $get_sms_status = 'Failed';
                    }

                    break;

                case 'SMSIndiaHub':

                    $clphone = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $message = urlencode($this->message);

                    $ch = curl_init("$gateway_url?user=" . $gateway_user_name . "&password=" . $gateway_password . "&msisdn=" . $clphone . "&sid=" . $this->sender_id . "&msg=" . $message . "&fl=0");
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);

                    $response       = json_decode($output);
                    $get_sms_status = $response->ErrorMessage;

                    break;

                case 'Text Local':

                    $sender  = urlencode($this->sender_id);
                    $message = rawurlencode($this->message);

                    $data = array('username' => $gateway_user_name, 'hash' => $gateway_password, 'numbers' => $this->cl_phone, "sender" => $sender, "message" => $message, "unicode" => true);

                    // Send the POST request with cURL
                    $ch = curl_init($gateway_url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);

                    $get_data = json_decode($response, true);

                    if (array_key_exists('status', $get_data)) {
                        if ($get_data['status'] == 'failure') {
                            foreach ($get_data['errors'] as $err) {
                                $get_sms_status = $err['message'];
                            }
                        } else {
                            $get_sms_status = 'Success';
                        }

                    } else {
                        $get_sms_status = 'failed';
                    }

                    break;

                case 'Top10sms':
                    $clphone   = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone   = str_replace('+', '', $clphone);
                    $sender_id = urlencode($this->sender_id);

                    $sms_sent_to_user = $gateway_url . "?action=compose" . "&username=$gateway_user_name" . "&api_key=$gateway_password" . "&to=$clphone" . "&sender=$sender_id" . "&message=" . urlencode($this->message) . "&unicode=1";

                    $get_sms_status = file_get_contents($sms_sent_to_user);
                    $get_sms_status = trim(substr($get_sms_status, 0, strpos($get_sms_status, ":")));

                    break;

                case 'msg91':

                    $clphone   = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone   = str_replace('+', '', $clphone);
                    $sender_id = urlencode($this->sender_id);
                    $message   = urlencode($this->message);

                    //Define route
                    $route = "default";

                    //Prepare you post parameters
                    $postData = array(
                        'authkey'  => $gateway_password,
                        'mobiles'  => $clphone,
                        'message'  => $message,
                        'sender'   => $sender_id,
                        'route'    => $route,
                        'response' => 'json',
                        'unicode'  => '1',
                    );

                    // init the resource
                    $ch = curl_init();
                    curl_setopt_array($ch, array(
                        CURLOPT_URL            => $gateway_url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST           => true,
                        CURLOPT_POSTFIELDS     => $postData,
                        //,CURLOPT_FOLLOWLOCATION => true
                    ));

                    //Ignore SSL certificate verification
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                    //get response
                    $output = curl_exec($ch);

                    //Print error if any
                    if (curl_errno($ch)) {
                        $get_sms_status = curl_error($ch);
                    }

                    curl_close($ch);
                    $get_data = json_decode($output, true);
                    if (array_key_exists('message', $get_data)) {
                        $get_sms_status = $get_data['message'];
                    } else {
                        $get_sms_status = 'failed';
                    }

                    break;

                case 'ShreeWeb':

                    $clphone   = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone   = str_replace('+', '', $clphone);
                    $sender_id = urlencode($this->sender_id);
                    $message   = urlencode($this->message);

                    $ch = curl_init("$gateway_url?username=" . $gateway_user_name . "&password=" . $gateway_password . "&mobile=" . $clphone . "&sender=" . $sender_id . "&message=" . $message . "&type=TEXT");
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);

                    $output = trim($output);

                    if ($output != '') {
                        if (strpos($output, 'SUBMIT_SUCCESS') !== false) {
                            $get_sms_status = 'Success';
                        } elseif ($output == 'ERR_PARAMETER') {
                            $get_sms_status = 'Invalid  parameter';
                        } elseif ($output == 'ERR_MOBILE') {
                            $get_sms_status = 'Invalid  Phone Number';
                        } elseif ($output == 'ERR_SENDER') {
                            $get_sms_status = 'Invalid  Sender';
                        } elseif ($output == 'ERR_MESSAGE_TYPE') {
                            $get_sms_status = 'Invalid  Message Type';
                        } elseif ($output == 'ERR_MESSAGE') {
                            $get_sms_status = 'Invalid  Message';
                        } elseif ($output == 'ERR_SPAM') {
                            $get_sms_status = 'Spam  Message';
                        } elseif ($output == 'ERR_DLR') {
                            $get_sms_status = 'Dlr requisition is invalid.';
                        } elseif ($output == 'ERR_USERNAME') {
                            $get_sms_status = 'Invalid Username';
                        } elseif ($output == 'ERR_PASSWORD') {
                            $get_sms_status = 'Invalid Password';
                        } elseif ($output == 'ERR_LOGIN') {
                            $get_sms_status = 'Invalid Login Access';
                        } elseif ($output == 'ERR_CREDIT') {
                            $get_sms_status = 'Insufficient Balance';
                        } elseif ($output == 'ERR_DATETIME') {
                            $get_sms_status = 'Invalid Time format';
                        } elseif ($output == 'ERR_GMT') {
                            $get_sms_status = 'Invalid GMT';
                        } elseif ($output == 'ERR_ROUTING') {
                            $get_sms_status = 'Invalid Routing';
                        } elseif ($output == 'ERR_INTERNAL') {
                            $get_sms_status = 'Server Down For Maintenance';
                        } else {
                            $get_sms_status = 'Unknown Error';
                        }
                    } else {
                        $get_sms_status = 'Unknown Error';
                    }

                    break;

                case 'SmsGatewayMe':

                    include_once app_path('Classes/smsGateway.php');

                    $sms_info = new SmsGateway($gateway_user_name, $gateway_password);
                    $response = $sms_info->sendMessageToNumber($this->cl_phone, $this->message, $gateway_extra);

                    $get_sms_status = '';
                    if (is_array($response)) {
                        if (array_key_exists('response', $response)) {
                            if ($response['response']['success']) {
                                $get_sms_status = 'Success';
                            } else {
                                foreach ($response['response']['errors'] as $key => $value) {
                                    $get_sms_status .= ' ' . $value;
                                }
                            }
                        }
                    } else {
                        $get_sms_status = 'Unknown Error';
                    }

                    $get_sms_status = trim($get_sms_status);

                    break;

                case 'Elibom':
                    require_once app_path('libraray/elibom/src/elibom_client.php');
                    $elbom = new ElibomClient($gateway_user_name, $gateway_password);
                    try {
                        $get_sms_status = 'Success|' . $elbom->sendMessage($this->cl_phone, $this->message);
                    } catch (\Exception $e) {
                        $get_sms_status = $e->getMessage();
                    }
                    break;

                case 'Hablame':
                    $clphone = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone = str_replace('+', '', $clphone);
                    $data    = array(
                        'cliente' => $gateway_user_name, //Numero de cliente
                        'api'     => $gateway_password, //Clave API suministrada
                        'numero'  => $clphone, //numero o numeros telefonicos a enviar el SMS (separados por una coma ,)
                        'sms'     => $this->message, //Mensaje de texto a enviar
                    );

                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data),
                        ),
                    );
                    $context = stream_context_create($options);
                    $result  = json_decode((file_get_contents($gateway_url, false, $context)), true);

                    if (is_array($result) && array_key_exists('resultado', $result)) {
                        if ($result["resultado"] === 0) {
                            $get_sms_status = 'Success';
                        } else {
                            $get_sms_status = $result['resultado_t'];
                        }
                    } else {
                        $get_sms_status = 'ha ocurrido un error';
                    }

                    break;

                case 'Wavecell':

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, "https://api.wavecell.com/sms/v1/$gateway_extra/single");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"source\":\"$this->sender_id\", \"destination\":\"$this->cl_phone\", \"text\":\"$this->message\", \"encoding\":\"AUTO\" }");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_USERPWD, "$gateway_user_name" . ":" . "$gateway_password");

                    $headers   = array();
                    $headers[] = "Content-Type: application/json";
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        echo 'Error:' . curl_error($ch);
                    }
                    curl_close($ch);
                    $get_data = json_decode($result, true);
                    if (is_array($get_data) && array_key_exists('umid', $get_data)) {
                        $get_sms_status = 'Success|' . $get_data['umid'];
                    } else {
                        $get_sms_status = 'Failed';
                    }
                    break;

                case 'SIPTraffic':
                    $clphone   = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone   = str_replace('+', '', $clphone);
                    $sender_id = $this->sender_id;

                    $sms_sent_to_user = $gateway_url . "/myaccount/sendsms.php?username=$gateway_user_name" . "&password=$gateway_password" . "&to=$clphone" . "&from=$sender_id" . "&text=" . urlencode($this->message);

                    $get_sms_status = file_get_contents($sms_sent_to_user);
                    $get_sms_status = trim($get_sms_status);
                    $result         = explode(' ', $get_sms_status);

                    if (is_array($result)) {
                        if (array_key_exists('2', $result) && $result['2'] == 'success') {
                            $get_sms_status = 'Success';
                        } else {
                            $get_sms_status = $result['3'];
                        }
                    } else {
                        $get_sms_status = 'Unknown error';
                    }

                    break;

                case 'SMSMKT':
                    $clphone = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone = str_replace('+', '', $clphone);
                    $message = urlencode($this->message);

                    $Parameter = "User=$gateway_user_name&Password=$gateway_password&Msnlist=$clphone&Msg=$message&Sender=$this->sender_id";
                    $ch        = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $gateway_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $Parameter);

                    $response = curl_exec($ch);
                    curl_close($ch);

                    $response = explode(',', $response);
                    $status   = explode('=', $response[0])[1];

                    if ($status == '0') {
                        $get_sms_status = 'Success';
                    } else {

                        $details        = explode('=', $response['1']);
                        $get_sms_status = $details['1'];
                    }
                    break;

                case 'MLat':

                    $clphone = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone = str_replace('+', '', $clphone);
                    // mensajes a enviar
                    $texts = array($this->message);

                    // números correspondientes pilas formato regexp ^04(12|16|26|14|24)\d{7}$
                    $recipients = array($clphone);

                    try {

                        $mlat = new \SoapClient($gateway_url . '?wsdl',
                            array('location' => 'https://m-lat.net/axis2/services/SMSServiceWS?wsdl'));
                        $credential     = array('user' => $gateway_user_name, 'password' => $gateway_password);
                        $get_sms_status = $mlat->sendManyTextSMS(array('credential' => $credential, 'text' => $texts, 'recipients' => $recipients));
                    } catch (\Exception $ex) {
                        $get_sms_status = $ex->getMessage();
                    }
                    break;

                case 'NRSGateway':
                    $clphone          = str_replace(" ", "", $this->cl_phone); #Remove any whitespace
                    $clphone          = str_replace('+', '', $clphone);
                    $sender_id        = $this->sender_id;
                    $message          = urlencode($this->message);
                    $gateway_password = urlencode($gateway_password);

                    $sms_sent_to_user = $gateway_url . "?username=$gateway_user_name" . "&password=$gateway_password" . "&to=$clphone" . "&from=$sender_id" . "&text=" . urlencode($this->message) . "&coding=0&dlr-mask=8";

                    $response = file_get_contents($sms_sent_to_user);
                    $result   = explode(':', trim($response));

                    if (is_array($result)) {
                        if (array_key_exists('1', $result) && $result['0'] == '0') {
                            $get_sms_status = 'Success';
                        } else {
                            $get_sms_status = trim($result['1']);
                        }
                    } else {
                        $get_sms_status = 'Unknown error';
                    }

                    break;

                case 'Asterisk':
                    Artisan::call('ami:dongle:sms', [
                        'number'  => $this->cl_phone,
                        'message' => $this->message,
                        'device'  => env('SC_DEVICE'),
                    ]);

                    $get_sms_status = Artisan::output();

                    if (strpos($get_sms_status, 'queued') !== false) {
                        $get_sms_status = 'Success';
                    }

                    break;
                case 'spt':
                    $USERNAME       = $gateway_user_name;
                    $PASSWORD       = $gateway_password;
                    $BRANDNAME      = $this->sender_id;
                    $MESSAGE        = $this->message;
                    $TYPE           = 1;
                    $PHONE          = $this->cl_phone;
                    $IDREQ          = substr(number_format(time() * rand(), 0, '', ''), 0, 10);
                    $client         = new \SoapClient($gateway_url);
                    $result         = $client->send(array("USERNAME" => $USERNAME, "PASSWORD" => $PASSWORD, "BRANDNAME" => $BRANDNAME, "MESSAGE" => $MESSAGE, "TYPE" => $TYPE, "PHONE" => $PHONE, "IDREQ" => $IDREQ));
                    $response       = $result->return;
                    $status_code    = (int) $response->result;
                    $status_message = $response->detail;
                    //insert table sms
                    //$userId = Auth::id();
                    $userId=$this->user_id;
                    //get status sms id
                    $sql    = "SELECT * FROM status_sms s WHERE s.error_code='" . $status_code . "'";
                    $result = DB::selectOne($sql);
                    if ($result) {
                        $status_sms_id     = $result->id;
                        $status_message_vn = $result->description_vn;
                    } else {
                        //insert table status_sms
                        //DB::getPdo()->lastInsertId();
                        $sql = "insert into status_sms(error_code,description_en,description_vn,group_code) values('" . $status_code . "','" . $status_message . "','" . $status_message . "',-1)";
                        DB::insert($sql);
                        $insertId          = DB::getPdo()->lastInsertId();
                        $status_sms_id     = $insertId;
                        $status_message_vn = $status_message;
                    }
                    //print_r($result);

                    if ($status_code == 0) {
                        $status = 1;
                    } else {
                        $status = 2;
                    }

                    $id_file = 'single_' . date('d_m_Y_H_m_s');
                    $sql     = "INSERT INTO sms(mobile,message,status,status_code,status_message,id_file,id_send,created_date,user_id,status_sms_id) VALUES('" . $PHONE . "','" . $MESSAGE . "','" . $status . "','" . $status_code . "','" . $status_message . "','" . $id_file . "','" . $IDREQ . "',now(),'" . $userId . "','" . $status_sms_id . "')";
                    $result  = DB::insert($sql);
                    if ($status_code == 0) {
                        $get_sms_status="Success";
                    } else {
                        $get_sms_status=$status_message_vn;
                    }
                    break;
                case 'default':
                    $get_sms_status = 'Gateway not found';
                    break;

            }

        }

        $check = SMSHistory::where('receiver', $this->cl_phone)->first();

        if ($check) {
            SMSInbox::create([
                'msg_id'       => $check->id,
                'amount'       => $this->msgcount,
                'original_msg' => $this->message,
                'encrypt_msg'  => base64_encode($this->message),
                'status'       => $get_sms_status,
                'ip'           => $client_ip,
                'send_by'      => 'sender',
            ]);

            $sms_history = SMSHistory::find($check->id);
            $sms_history->touch(); //update date

        } else {
            $sms_info = SMSHistory::create([
                'userid'      => $this->user_id,
                'sender'      => $this->sender_id,
                'receiver'    => $this->cl_phone,
                'api_key'     => $this->api_key,
                'use_gateway' => $gateway_name,
            ]);

            $sms_id = $sms_info->id;

            SMSInbox::create([
                'msg_id'       => $sms_id,
                'amount'       => $this->msgcount,
                'original_msg' => $this->message,
                'encrypt_msg'  => base64_encode($this->message),
                'status'       => $get_sms_status,
                'ip'           => $client_ip,
                'send_by'      => 'sender',
            ]);
        }

        if ($this->user_id != '0') {
            $client = Client::find($this->user_id);

        }

        $this->get_sms_status = $get_sms_status;

    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->get_sms_status;
    }
}
