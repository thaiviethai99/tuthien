<?php

namespace App\Http\Controllers;

use App\EmailTemplates;
use App\Models\Contact;
use App\Models\GroupContact;
use Auth;
use Illuminate\Http\Request;
use DB;
class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('client');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function listContact()
    {
        /* $conf     = EmailTemplates::where('tplname', '=', 'Client Contact Reply Viet Nam')->first();
        $template = $conf->message;
        $subject  = $conf->subject;

        $data = array(
        'name' => 'name',
        'subject'=>'subject',
        'content'=>'content',
        'reply_content'=>'reply content'
        );

        $message      = _render($template, $data);
        $mail_subject = _render($subject, $data);
        $body         = $message;
        $mail         = new \PHPMailer();

        $host          = 'smtp.spt.vn';
        $smtp_username = 'haitv1@spt.vn';
        $stmp_password = '12819888';
        $port          = 587;
        $secure        = 'tls';

        $mail = new \PHPMailer();

        try {
        $mail->isSMTP();
        $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true,
        ),
        ); // Set mailer to use SMTP
        $mail->Host       = $host; // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = $smtp_username; // SMTP username
        $mail->Password   = $stmp_password; // SMTP password
        $mail->SMTPSecure = $secure; // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = $port;
        $mail->CharSet    = "utf-8";

        $mail->setFrom('haitv1@spt.vn', 'thái việt hải');
        $mail->addAddress('haitv1@spt.vn', 'name'); // Add a recipient
        $mail->isHTML(true); // Set email format to HTML

        $mail->Subject = $mail_subject;
        $mail->Body = $body;

        if (!$mail->send()) {

        echo 'that bai';
        } else {

        echo 'thanh cong';
        }
        } catch (\phpmailerException $e) {
        echo $e->getMessage();
        }

        die;*/
        $client_id = Auth::guard('client')->user()->id;
        //$contacts     = Contact::where('is_delete', 0)->orderBy('id', 'desc')->get();
        //$groupContact = GroupContact::all();
        $count1       = Contact::where('group_contact_id', 1)->where('is_delete', 0)->get()->count();
        $count2       = Contact::where('group_contact_id', 2)->where('is_delete', 0)->get()->count();
        $count3       = Contact::where('group_contact_id', 3)->where('is_delete', 0)->get()->count();
        $count4       = Contact::where('group_contact_id', 4)->where('is_delete', 0)->get()->count();
        $count5       = Contact::where('group_contact_id', 5)->where('is_delete', 0)->get()->count();
        $count6       = Contact::where('group_contact_id', 6)->where('is_delete', 0)->get()->count();
        $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" . $client_id . "' and g.name='khách hàng'";
        $result        = DB::selectOne($sql);
        $typePermisson = $result->type_perm;
        return view('client.contact', compact('count1', 'count2', 'count3', 'count4', 'count5','count6','client_id','typePermisson'));
    }

    public function getReplyContact(Request $request)
    {
        $id           = $request->id;
        $client_id = Auth::guard('client')->user()->id;
        $contact      = Contact::where('id', $id)->first();
        $groupContact = GroupContact::all();
        $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" . $client_id . "' and g.name='khách hàng'";
        $result        = DB::selectOne($sql);
        $typePermisson = $result->type_perm;
        return view('client.get_reply_contact', compact('contact', 'groupContact','typePermisson'));
    }

    public function postReply(Request $request)
    {
        $cateIdEdit = $request->cateIdEdit;
        $contactId  = $request->contactId;
        $contact    = Contact::find($contactId);
        /*$messages  = array(
        'reply_content.required' => 'Chưa nhập trả lời',

        );
        $v = \Validator::make($request->all(), [
        'reply_content' => 'required',
        ], $messages);

        if ($v->fails()) {
        return redirect('client/get-reply-contact/' . $contactId)->withErrors($v->errors())->withInput();
        }*/
        $contact->name             = $request->name;
        $contact->email            = $request->email;
        $contact->mobile           = $request->mobile;
        $contact->group_contact_id = $request->groupContactId;
        $contact->status_contact   = $request->status_contact;
        $contact->subject          = $request->subject;
        $contact->content          = $request->content;
        $contact->user_id          = Auth::guard('client')->user()->id;
        $contact->update();
        if ($request->has('reply_content')) {
            $contact                 = Contact::find($contactId);
            $contact->reply_content  = $request->reply_content;
            $contact->status_contact = 1;
            $contact->reply_date     = date('Y-m-d');
            $contact->user_id        = Auth::guard('client')->user()->id;
            $contact->update();
            //send email after create
            $conf     = EmailTemplates::where('tplname', '=', 'Client Contact Reply Viet Nam')->first();
            $template = $conf->message;
            $subject  = $conf->subject;

            $data = array(
                'name'          => $request->name,
                'subject'       => $request->subject,
                'content'       => $request->content,
                'reply_content' => $request->reply_content,
            );

            $message      = _render($template, $data);
            $mail_subject = _render($subject, $data);
            $body         = $message;
            $mail         = new \PHPMailer();

            $host          = env('MAIL_HOST');
            $smtp_username = env('MAIL_USERNAME');
            $stmp_password = env('MAIL_PASSWORD');
            $port          = env('MAIL_PORT');
            $secure        = env('MAIL_ENCRYPTION');

            $mail = new \PHPMailer();

            try {
                $mail->isSMTP();
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true,
                    ),
                ); // Set mailer to use SMTP
                $mail->Host       = $host; // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true; // Enable SMTP authentication
                $mail->Username   = $smtp_username; // SMTP username
                $mail->Password   = $stmp_password; // SMTP password
                $mail->SMTPSecure = $secure; // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = $port;
                $mail->CharSet    = "utf-8";

                $mail->setFrom('haitv1@spt.vn', 'thái việt hải');
                $mail->addAddress($request->email, $request->name); // Add a recipient
                $mail->isHTML(true); // Set email format to HTML

                $mail->Subject = $mail_subject;
                $mail->Body    = $body;

                if (!$mail->send()) {
                    if ($cateIdEdit > 0) {
                        $urlRedirect = 'client/show-contact-by-catetory/' . $cateIdEdit;
                        return redirect($urlRedirect)->with([
                            'message' => 'Gửi mail thất bại',
                        ]);
                    } else {
                        return redirect('client/list-contact')->with([
                            'message' => 'Gửi mail thất bại',
                        ]);
                    }
                }
            } catch (\phpmailerException $e) {
                if ($cateIdEdit > 0) {
                    $urlRedirect = 'client/show-contact-by-catetory/' . $cateIdEdit;
                    return redirect($urlRedirect)->with([
                        'message' => $e->getMessage(),
                    ]);
                } else {
                    return redirect('client/list-contact')->with([
                        'message' => $e->getMessage(),
                    ]);
                }
            }
            if ($cateIdEdit > 0) {
                $urlRedirect = 'client/show-contact-by-catetory/' . $cateIdEdit;
                return redirect($urlRedirect)->with([
                    'message' => 'Trả lời liên hệ thành công',
                ]);
            } else {
                return redirect('client/list-contact')->with([
                    'message' => 'Trả lời liên hệ thành công',
                ]);
            }

        }

        if ($cateIdEdit > 0) {
            $urlRedirect = 'client/show-contact-by-catetory/' . $cateIdEdit;
            return redirect($urlRedirect)->with([
                'message' => 'Sửa liên hệ thành công',
            ]);
        } else {
            return redirect('client/list-contact')->with([
                'message' => 'Sửa liên hệ thành công',
            ]);
        }

    }

    public function showInsertContact(Request $request)
    {
        $groupContact = GroupContact::all();
         $client_id = Auth::guard('client')->user()->id;
        return view('client.create-new-contact', compact('groupContact','client_id'));
    }

    public function insertContact(Request $request)
    {
        $cateIdInsert = $request->cateIdInsert;

        $messages = array(
            'name.required'           => 'Chưa nhập họ tên',
            'email.required'          => 'Chưa nhập email',
            'mobile.required'         => 'Chưa nhập số điện thoại',
            'groupContactId.required' => 'Chưa chọn nhóm',
            'subject.required'        => 'Chưa nhập tiêu đề',
            'content.required'        => 'Chưa nhập nội dung',

        );
        $v = \Validator::make($request->all(), [
            'name'           => 'required',
            'email'          => 'required',
            'mobile'         => 'required',
            'groupContactId' => 'required',
            'subject'        => 'required',
            'content'        => 'required',
        ], $messages);

        if ($v->fails()) {
            if ($cateIdInsert > 0) {
                return redirect('client/showInsertContact/' . $cateIdInsert)->withErrors($v->errors())->withInput();
            } else {
                return redirect('client/showInsertContact/')->withErrors($v->errors())->withInput();
            }

        }

        $contact                   = new Contact();
        $contact->name             = $request->name;
        $contact->email            = $request->email;
        $contact->mobile           = $request->mobile;
        $contact->group_contact_id = $request->groupContactId;
        $contact->status_contact   = $request->status_contact;
        $contact->subject          = $request->subject;
        $contact->content          = $request->content;
        $contact->created_date     = date('Y-m-d');
        $contact->user_id          = Auth::guard('client')->user()->id;
        $contact->save();

        if ($cateIdInsert > 0) {
            $urlRedirect = 'client/show-contact-by-catetory/' . $cateIdInsert;
            return redirect($urlRedirect)->with([
                'message' => 'Thêm liên hệ thành công',
            ]);
        } else {
            return redirect('client/list-contact')->with([
                'message' => 'Thêm liên hệ thành công',
            ]);
        }
    }

    public function showContactByCate(Request $request)
    {
        $cateId   = $request->cateIdSub;
        $contacts = Contact::where('group_contact_id', $cateId)->where('is_delete', 0)->orderBy('id', 'DESC')->get();
        $client_id= Auth::guard('client')->user()->id;
        $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" . $client_id . "' and g.name='khách hàng'";
        $result        = DB::selectOne($sql);
        $typePermisson = $result->type_perm;
        return view('client.showcontactbycate', compact('contacts','typePermisson'));
    }

    public function deleteContact(Request $request)
    {
        $contact            = Contact::find($request->id);
        $contact->is_delete = 1;
        $contact->save();
        return redirect('client/list-contact')->with([
            'message' => 'Xóa liên hệ thành công',
        ]);
    }

    public function deleteContactInCate(Request $request)
    {
        $contact            = Contact::find($request->id);
        $contact->is_delete = 1;
        $contact->save();
        $cateId = $request->cateId;
        return redirect('client/show-contact-by-catetory/' . $cateId)->with([
            'message' => 'Xóa liên hệ thành công',
        ]);
    }

}
