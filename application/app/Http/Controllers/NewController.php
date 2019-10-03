<?php

namespace App\Http\Controllers;

use App\EmailTemplates;
use App\Models\Category;
use App\Models\NewFile;
use App\Models\NewFileEn;
use App\Models\News;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewController extends Controller
{
    public function __construct()
    {
        $this->middleware('client');
    }

    public function dashboard()
    {
        return view('spt.dashboard');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageCategory()
    {
        $categories    = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title', 'id')->all();
        return view('client.categoryTreeview', compact('categories', 'allCategories'));
    }

    public function website()
    {
        $categories    = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title', 'id')->all();
        $news          = News::where('is_delete', 0)->orderBy('id', 'DESC')->get();
        $client_id     = Auth::guard('client')->user()->id;
        $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" . $client_id . "' and g.name='website'";
        $result        = DB::selectOne($sql);
        $typePermisson = $result->type_perm;
        return view('client.website', compact('categories', 'allCategories', 'news', 'client_id', 'typePermisson'));
    }

    public function showInsertNew(Request $request)
    {
        $allCategories = Category::all();
        $data          = [];
        foreach ($allCategories as $key => $item) {
            $data[] = ['id' => $item->id, 'name' => $item->title, 'parent_id' => $item->parent_id, 'top' => $item->top];
        }
        $client_id = Auth::guard('client')->user()->id;
        return view('client.create-new-new', compact('data', 'client_id'));
    }

    public function insertNew(Request $request)
    {
        //unlink($upload_dir.$edit_row['userPic']);

        $messages = array(
            'title.required'   => 'Chưa nhập tiêu đề tiếng việt',
            'cate_id.required' => 'Chưa chọn danh mục tiếng việt',
            //'content.required'=>'Chưa nhập nội dung tiếng việt'
        );
        $v = \Validator::make($request->all(), [
            'title'   => 'required',
            'cate_id' => 'required',
            //'content'=>'required'
        ], $messages);

        if ($v->fails()) {
            return redirect('client/showInsertNew')->withErrors($v->errors())->withInput();
        }
        $img = null;
        if ($request->hasfile('img')) {
            $file        = $request->img;
            $name        = $file->getClientOriginalName();
            $typeFile    = $file->getClientOriginalExtension();
            $unique_name = md5($name . time()) . '.' . $typeFile;
            $file->move(public_path() . '/assets/img', $unique_name);
            $img = $unique_name;
        }
        $news               = new News();
        $news->title        = $request->title;
        $news->content      = $request->content;
        $news->cate_id      = $request->cate_id;
        $news->img          = $img;
        $news->created_date = date('Y-m-d');
        $news->user_id      = Auth::guard('client')->user()->id;
        if ($request->has('is_approval')) {
            $news->is_approval = $request->is_approval;
        }
        if ($request->has('is_home')) {
            $news->is_home = $request->is_home;
        }
        if ($request->has('summary')) {
            $news->summary = $request->summary;
        }
        if ($request->has('is_active')) {
            $news->is_active = $request->is_active;
        }
        //$dateCreate         = str_replace("/", "-", $request->created_date);
        //$news->created_date = date('Y-m-d', strtotime($dateCreate));
        $news->created_date = date('Y-m-d');
        if ($request->has('title_en')) {
            $news->title_en = $request->title_en;
            if ($request->has('is_approval_en')) {
                $news->is_approval = $request->is_approval_en;
            }
            if ($request->has('is_home_en')) {
                $news->is_home = $request->is_home_en;
            }

            if ($request->has('is_active_en')) {
                $news->is_active_en = $request->is_active_en;
            }

            if ($request->has('summary_en')) {
                $news->summary_en = $request->summary_en;
            }
            $news->content_en = $request->content_en;
        }
        $news->save();
        $idInsertNew = $news->id;
        if ($request->hasfile('fileNameUpload')) {
            $i             = 0;
            $listTitleFile = $request->titleFile;
            foreach ($request->file('fileNameUpload') as $file) {
                //echo 'Đường dẫn tạm: ' . $file->getRealPath();
                //echo 'Kích cỡ file: ' . $file->getSize();
                //echo 'Kiểu files: ' . $file->getMimeType();
                $name     = $file->getClientOriginalName();
                $typeFile = $file->getClientOriginalExtension();
                //$unique_name = md5($name . time()) . '.' . $typeFile;
                $unique_name = time() . '_' . $name;
                $file->move(public_path() . '/assets/files', $unique_name);
                //$dataFile[] = $unique_name;
                $newFile               = new NewFile();
                $newFile->new_id       = $news->id;
                $newFile->title        = $listTitleFile[$i];
                $newFile->file_name    = $unique_name;
                $newFile->created_date = date('Y-m-d');
                $newFile->user_id      = Auth::guard('client')->user()->id;
                $newFile->save();
                $i++;
            }
        }

        if ($request->hasfile('fileNameUploadEn')) {
            $i               = 0;
            $listTitleFileEn = $request->titleFileEn;
            foreach ($request->file('fileNameUploadEn') as $file) {
                //echo 'Đường dẫn tạm: ' . $file->getRealPath();
                //echo 'Kích cỡ file: ' . $file->getSize();
                //echo 'Kiểu files: ' . $file->getMimeType();
                $name     = $file->getClientOriginalName();
                $typeFile = $file->getClientOriginalExtension();
                //$unique_name = md5($name . time()) . '.' . $typeFile;
                $unique_name = time() . '_' . $name;
                $file->move(public_path() . '/assets/files', $unique_name);
                //$dataFile[] = $unique_name;
                $newFile               = new NewFileEn();
                $newFile->new_id       = $news->id;
                $newFile->title        = $listTitleFileEn[$i];
                $newFile->file_name    = $unique_name;
                $newFile->created_date = date('Y-m-d');
                $newFile->user_id      = Auth::guard('client')->user()->id;
                $newFile->save();
                $i++;
            }
        }
        $cateIdInsert = $request->cateIdInsert;
        //send email
        $conf     = EmailTemplates::where('tplname', '=', 'Approved new')->first();
        $template = $conf->message;
        $subject  = $conf->subject;
        $cate     = Category::find($request->cate_id);
        $cateName = $cate->title;
        $title_en = '';
        if ($request->has('title_en')) {
            $title_en = $request->title_en;
        }
        $linkVn = url('/') . '/client/edit-new/' . $idInsertNew;
        $linkVn = "<a href='" . $linkVn . "' target='_blank'>" . $request->title . "</a>";
        $data   = array(
            'title'     => $request->title,
            'titleLink' => $linkVn,
            'title_en'  => $title_en,
            'name'      => Auth::guard('client')->user()->name,
            'email'     => Auth::guard('client')->user()->email,
            'cateName'  => $cateName,
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

            $mail->setFrom('haitv1@spt.vn', 'spt.vn');
            $mail->addAddress('bientapweb@spt.vn', 'Biên tập web'); // Add a recipient
            /*if ($cate->id == 14) {
            $mail->addAddress('haidaica99999@gmail.com', 'test send email new');
            }*/
            $mail->isHTML(true); // Set email format to HTML

            $mail->Subject = $mail_subject;
            $mail->Body    = $body;

            if (!$mail->send()) {
                if ($cateIdInsert > 0) {
                    $urlRedirect = 'client/show-new-by-catetory/' . $cateIdInsert;
                    return redirect($urlRedirect)->with([
                        'message' => 'Gửi mail thất bại',
                    ]);
                } else {
                    return redirect('client/website')->with([
                        'message' => 'Gửi mail thất bại',
                    ]);
                }
            }
        } catch (\phpmailerException $e) {
            if ($cateIdInsert > 0) {
                $urlRedirect = 'client/show-new-by-catetory/' . $cateIdInsert;
                return redirect($urlRedirect)->with([
                    'message' => $e->getMessage(),
                ]);
            } else {
                return redirect('client/website')->with([
                    'message' => $e->getMessage(),
                ]);
            }
        }
        if ($cateIdInsert > 0) {
            $urlRedirect = 'client/show-new-by-catetory/' . $cateIdInsert;
            return redirect($urlRedirect)->with([
                'message' => 'Thêm tin mới thành công',
            ]);
        } else {
            return redirect('client/website')->with([
                'message' => 'Thêm tin mới thành công',
            ]);
        }

    }

    public function showEditNew(Request $request)
    {
        $client_id     = Auth::guard('client')->user()->id;
        $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" . $client_id . "' and g.name='website'";
        $result        = DB::selectOne($sql);
        $typePermisson = $result->type_perm;
        $allCategories = Category::all();
        $data          = [];
        foreach ($allCategories as $key => $item) {
            $data[] = ['id' => $item->id, 'name' => $item->title, 'parent_id' => $item->parent_id, 'top' => $item->top];
        }
        $newId     = $request->id;
        $newDetail = News::find($newId);
        //$fileList  = json_decode($newDetail->attach_file);
        $fileList   = NewFile::where('new_id', $newId)->get();
        $fileListEn = NewFileEn::where('new_id', $newId)->get();
        return view('client.edit-new-new', compact('data', 'newDetail', 'fileList', 'fileListEn', 'typePermisson', 'client_id'));
    }

    public function editNew(Request $request)
    {
        $cateIdEdit = $request->cateIdEdit;

        $messages = array(
            'title.required'   => 'Chưa nhập tiêu đề tiếng việt',
            'cate_id.required' => 'Chưa chọn danh mục tiếng việt',
            //'content.required'=>'Chưa nhập nội dung tiếng việt'
        );
        $v = \Validator::make($request->all(), [
            'title'   => 'required',
            'cate_id' => 'required',
            //'content'=>'required'
        ], $messages);

        if ($v->fails()) {
            //client/edit-new/{id}/{cateIdEdit?}
            return redirect('client/edit-new/' . $request->new_id . '/' . $cateIdEdit)->withErrors($v->errors())->withInput();
        }

        if ($request->hasfile('img')) {
            $new     = News::find($request->new_id);
            $imgName = $new->img;
            if (!empty($imgName)) {
                $file = $request->img;
                //$name        = $file->getClientOriginalName();
                //$typeFile    = $file->getClientOriginalExtension();
                //$unique_name = md5($name . time()) . '.' . $typeFile;
                $file->move(public_path() . '/assets/img', $imgName);
            } else {
                $file        = $request->img;
                $name        = $file->getClientOriginalName();
                $typeFile    = $file->getClientOriginalExtension();
                $unique_name = time() . '_' . $name;
                $file->move(public_path() . '/assets/img', $unique_name);
                $new->img = $unique_name;
                $new->save();
            }

        }
        //delete
        if ($request->has('listFileNameDelete')) {
            $listFileNameDelete = $request->listFileNameDelete;
            $pos                = strpos($request->listFileNameDelete, ',');
            if ($pos === false) {
                NewFile::where('id', $listFileNameDelete)->delete();
            } else {
                $listFileNameDelete = explode(',', $request->listFileNameDelete);
                foreach ($listFileNameDelete as $key => $item) {
                    NewFile::where('id', $item)->delete();
                }

            }

        }

        //delete english
        if ($request->has('listFileNameDeleteEn')) {
            $listFileNameDeleteEn = $request->listFileNameDeleteEn;
            $pos                  = strpos($request->listFileNameDelete, ',');
            if ($pos === false) {
                NewFileEn::where('id', $listFileNameDeleteEn)->delete();
            } else {
                $listFileNameDeleteEn = explode(',', $request->listFileNameDeleteEn);
                foreach ($listFileNameDeleteEn as $key => $item) {
                    NewFileEn::where('id', $item)->delete();
                }

            }

        }

        if ($request->has('listTitleUpdate')) {
            $listFile        = NewFile::where('new_id', $request->new_id)->get();
            $listTitleUpdate = $request->listTitleUpdate;
            $listTitleUpdate = json_decode($listTitleUpdate);
            foreach ($listTitleUpdate as $key => $item) {
                $dataKey[] = $item->id;
            }

            foreach ($listFile as $key => $item) {
                if (in_array($item->id, $dataKey)) {
                    foreach ($request->titleFileOld as $key1 => $title) {
                        if ($key1 == $key) {
                            $newFile        = NewFile::find($item->id);
                            $newFile->title = $title;
                            $newFile->save();
                        }
                    }
                }
            }
        }

        if ($request->has('listTitleUpdateEn')) {
            $listFile          = NewFileEn::where('new_id', $request->new_id)->get();
            $listTitleUpdateEn = $request->listTitleUpdateEn;
            $listTitleUpdateEn = json_decode($listTitleUpdateEn);
            foreach ($listTitleUpdateEn as $key => $item) {
                $dataKey[] = $item->id;
            }

            foreach ($listFile as $key => $item) {
                if (in_array($item->id, $dataKey)) {
                    foreach ($request->titleFileOldEn as $key1 => $title) {
                        if ($key1 == $key) {
                            $newFile        = NewFileEn::find($item->id);
                            $newFile->title = $title;
                            $newFile->save();
                        }
                    }
                }
            }
        }

        if ($request->has('listFileNameUpdate')) {
            //$new                = News::find($request->new_id);
            $listFile           = NewFile::where('new_id', $request->new_id)->get();
            $listFileNameUpdate = $request->listFileNameUpdate;
            $listFileNameUpdate = json_decode($listFileNameUpdate);
            foreach ($listFileNameUpdate as $key => $item) {
                $dataKey[]  = $item->id;
                $dataName[] = $item->name;
            }
            foreach ($listFile as $key => $item) {
                if (in_array($item->id, $dataKey)) {
                    //get key
                    foreach ($request->file('filenameold') as $key1 => $file) {
                        if ($key1 == $key) {
                            //echo 'Đường dẫn tạm: ' . $file->getRealPath();
                            //echo 'Kích cỡ file: ' . $file->getSize();
                            //echo 'Kiểu files: ' . $file->getMimeType();
                            $name     = $file->getClientOriginalName();
                            $typeFile = $file->getClientOriginalExtension();
                            //$unique_name = md5($name . time()) . '.' . $typeFile;
                            $unique_name = time() . '_' . $name;
                            $file->move(public_path() . '/assets/files', $unique_name);
                            //$dataFileOld[]  = $name;
                            //$listFile[$key] = $name;
                            $newFile            = NewFile::find($item->id);
                            $newFile->file_name = $unique_name;
                            $newFile->save();
                        }

                    }
                }
            }

        }

        if ($request->has('listFileNameUpdateEn')) {
            //$new                = News::find($request->new_id);
            $listFile             = NewFileEn::where('new_id', $request->new_id)->get();
            $listFileNameUpdateEn = $request->listFileNameUpdateEn;
            $listFileNameUpdateEn = json_decode($listFileNameUpdateEn);
            foreach ($listFileNameUpdateEn as $key => $item) {
                $dataKey[]  = $item->id;
                $dataName[] = $item->name;
            }
            foreach ($listFile as $key => $item) {
                if (in_array($item->id, $dataKey)) {
                    //get key
                    foreach ($request->file('filenameoldEn') as $key1 => $file) {
                        if ($key1 == $key) {
                            //echo 'Đường dẫn tạm: ' . $file->getRealPath();
                            //echo 'Kích cỡ file: ' . $file->getSize();
                            //echo 'Kiểu files: ' . $file->getMimeType();
                            $name     = $file->getClientOriginalName();
                            $typeFile = $file->getClientOriginalExtension();
                            //$unique_name = md5($name . time()) . '.' . $typeFile;
                            $unique_name = time() . '_' . $name;
                            $file->move(public_path() . '/assets/files', $unique_name);
                            //$dataFileOld[]  = $name;
                            //$listFile[$key] = $name;
                            $newFile            = NewFileEn::find($item->id);
                            $newFile->file_name = $unique_name;
                            $newFile->save();
                        }

                    }
                }
            }

        }

        if ($request->hasfile('filenamenew')) {
            $i            = 0;
            $titleFileNew = $request->titleFileNew;
            foreach ($request->file('filenamenew') as $file) {
                //echo 'Đường dẫn tạm: ' . $file->getRealPath();
                //echo 'Kích cỡ file: ' . $file->getSize();
                //echo 'Kiểu files: ' . $file->getMimeType();
                $name     = $file->getClientOriginalName();
                $typeFile = $file->getClientOriginalExtension();
                //$unique_name = md5($name . time()) . '.' . $typeFile;
                $unique_name = time() . '_' . $name;
                $file->move(public_path() . '/assets/files', $unique_name);
                //$dataFile[] = $unique_name;
                $newFile               = new NewFile();
                $newFile->new_id       = $request->new_id;
                $newFile->title        = $titleFileNew[$i];
                $newFile->file_name    = $unique_name;
                $newFile->created_date = date('Y-m-d');
                $newFile->user_id      = Auth::guard('client')->user()->id;
                $newFile->save();
                $i++;
            }
        }

        if ($request->hasfile('filenamenewen')) {
            $i              = 0;
            $titleFileNewEn = $request->titleFileNewEn;
            foreach ($request->file('filenamenewen') as $file) {
                //echo 'Đường dẫn tạm: ' . $file->getRealPath();
                //echo 'Kích cỡ file: ' . $file->getSize();
                //echo 'Kiểu files: ' . $file->getMimeType();
                $name     = $file->getClientOriginalName();
                $typeFile = $file->getClientOriginalExtension();
                //$unique_name = md5($name . time()) . '.' . $typeFile;
                $unique_name = time() . '_' . $name;
                $file->move(public_path() . '/assets/files', $unique_name);
                //$dataFile[] = $unique_name;
                $newFile               = new NewFileEn();
                $newFile->new_id       = $request->new_id;
                $newFile->title        = $titleFileNewEn[$i];
                $newFile->file_name    = $unique_name;
                $newFile->created_date = date('Y-m-d');
                $newFile->user_id      = Auth::guard('client')->user()->id;
                $newFile->save();
                $i++;
            }
        }

        //$is_approval = 0;
        $is_home = 0;
        if ($request->has('is_home')) {
            $is_home = 1;
        }
        //update
        $new               = News::find($request->new_id);
        $new->title        = $request->title;
        $new->cate_id      = $request->cate_id;
        $new->summary      = $request->summary;
        $new->content      = $request->content;
        $new->created_date = date('Y-m-d', strtotime($request->created_date));
        $new->updated_date = date('Y-m-d');
        $new->is_home      = $is_home;
        if (Auth::guard('client')->user()->id == 19) {
            $is_approval = 0;
            if ($request->has('is_approval')) {
                $is_approval = 1;
            }
            $new->is_approval = $is_approval;
        }

        $new->is_active = $request->is_active;
        if ($request->has('title_en')) {
            $is_approval_en = 0;
            $is_home_en     = 0;
            if ($request->has('is_approval_en')) {
                $is_approval_en = 1;
            }
            $is_approval_en = 1;
            if ($request->has('is_home_en')) {
                $is_home_en = 1;
            }
            $new->title_en       = $request->title_en;
            $new->summary_en     = $request->summary_en;
            $new->content_en     = $request->content_en;
            $new->is_home_en     = $is_home_en;
            $new->is_approval_en = $is_approval_en;
            $new->is_active_en   = $request->is_active_en;
            //send email
            $conf     = EmailTemplates::where('tplname', '=', 'Approved new english')->first();
            $template = $conf->message;
            $subject  = $conf->subject;
            $cate     = Category::find($request->cate_id);
            $cateName = $cate->title;
            $title_en = '';
            if ($request->has('title_en')) {
                $title_en = $request->title_en;
            }
            $linkEn = url('/') . '/client/edit-new/' . $request->new_id;
            $linkEn = "<a href='" . $linkEn . "' target='_blank'>" . $request->title_en . "</a>";
            $data   = array(
                'title'     => $request->title,
                'title_en'  => $title_en,
                'titleLink' => $linkEn,
                'name'      => Auth::guard('client')->user()->name,
                'email'     => Auth::guard('client')->user()->email,
                'cateName'  => $cateName,
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

                $mail->setFrom('haitv1@spt.vn', 'spt.vn');
                $mail->addAddress('bientapweb@spt.vn', 'Biên tập web'); // Add a recipient
                /*if ($cate->id == 14) {
                $mail->addAddress('haidaica99999@gmail.com', 'test send email new');
                }*/
                $mail->isHTML(true); // Set email format to HTML

                $mail->Subject = $mail_subject;
                $mail->Body    = $body;

                if (!$mail->send()) {
                    if ($cateIdEdit > 0) {
                        $urlRedirect = 'client/show-new-by-catetory/' . $cateIdEdit;
                        return redirect($urlRedirect)->with([
                            'message' => 'Gửi mail thất bại',
                        ]);
                    } else {
                        return redirect('client/website')->with([
                            'message' => 'Gửi mail thất bại',
                        ]);
                    }
                }
            } catch (\phpmailerException $e) {
                if ($cateIdEdit > 0) {
                    $urlRedirect = 'client/show-new-by-catetory/' . $cateIdEdit;
                    return redirect($urlRedirect)->with([
                        'message' => $e->getMessage(),
                    ]);
                } else {
                    return redirect('client/website')->with([
                        'message' => $e->getMessage(),
                    ]);
                }
            }

        }
        $new->save();
        if (Auth::guard('client')->user()->id != 19) {
            $conf     = EmailTemplates::where('tplname', '=', 'Approved edit new')->first();
            $template = $conf->message;
            $subject  = $conf->subject;
            $cate     = Category::find($request->cate_id);
            $cateName = $cate->title;
            $title_en = '';
            if ($request->has('title_en')) {
                $title_en = $request->title_en;
            }
            $linkVn = url('/') . '/client/edit-new/' . $request->new_id;
            $linkVn = "<a href='" . $linkVn . "' target='_blank'>" . $request->title . "</a>";
            $data   = array(
                'title'     => $request->title,
                'titleLink' => $linkVn,
                'title_en'  => $title_en,
                'name'      => Auth::guard('client')->user()->name,
                'email'     => Auth::guard('client')->user()->email,
                'cateName'  => $cateName,
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

                $mail->setFrom('haitv1@spt.vn', 'spt.vn');
                $mail->addAddress('bientapweb@spt.vn', 'Biên tập web'); // Add a recipient
                /*if ($cate->id == 14) {
                $mail->addAddress('haidaica99999@gmail.com', 'test send email new');
                $mail->addAddress('khkd@spt.vn','P.KHKD');
                }*/
                $mail->isHTML(true); // Set email format to HTML

                $mail->Subject = $mail_subject;
                $mail->Body    = $body;

                if (!$mail->send()) {
                    if ($cateIdEdit > 0) {
                        $urlRedirect = 'client/show-new-by-catetory/' . $cateIdEdit;
                        return redirect($urlRedirect)->with([
                            'message' => 'Gửi mail thất bại',
                        ]);
                    } else {
                        return redirect('client/website')->with([
                            'message' => 'Gửi mail thất bại',
                        ]);
                    }
                }
            } catch (\phpmailerException $e) {
                if ($cateIdEdit > 0) {
                        $urlRedirect = 'client/show-new-by-catetory/' . $cateIdEdit;
                        return redirect($urlRedirect)->with([
                            'message' => $e->getMessage(),
                        ]);
                    } else {
                        return redirect('client/website')->with([
                            'message' => $e->getMessage(),
                        ]);
                    }
            }
        }

        if ($cateIdEdit > 0) {
            $urlRedirect = 'client/show-new-by-catetory/' . $cateIdEdit;
            return redirect($urlRedirect)->with([
                'message' => 'Sửa tin thành công',
            ]);
        } else {
            return redirect('client/website')->with([
                'message' => 'Sửa tin thành công',
            ]);
        }
    }

    public function deleteNew(Request $request)
    {
        $new            = News::find($request->id);
        $new->is_delete = 1;
        $new->save();
        return redirect('client/website')->with([
            'message' => 'Xóa tin tức thành công',
        ]);
    }

    public function deleteNewInCate(Request $request)
    {
        $new            = News::find($request->id);
        $new->is_delete = 1;
        $new->save();
        $cateId = $request->cateId;
        return redirect('client/show-new-by-catetory/' . $cateId)->with([
            'message' => 'Xóa tin tức thành công',
        ]);
    }

    public function showNewByCate(Request $request)
    {
        $cateId        = $request->cateIdSub;
        $news          = News::where('cate_id', $cateId)->where('is_delete', 0)->orderBy('id', 'DESC')->get();
        $client_id     = Auth::guard('client')->user()->id;
        $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" . $client_id . "' and g.name='website'";
        $result        = DB::selectOne($sql);
        $typePermisson = $result->type_perm;
        return view('client.shownewbycate', compact('news', 'typePermisson'));
    }

    public function showEditApproval(Request $request)
    {
        $client_id     = Auth::guard('client')->user()->id;
        $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" . $client_id . "' and g.name='website'";
        $result        = DB::selectOne($sql);
        $typePermisson = $result->type_perm;
        $allCategories = Category::all();
        $newId         = $request->id;
        $newDetail     = News::find($newId);
        //$fileList  = json_decode($newDetail->attach_file);
        $fileList = NewFile::where('new_id', $newId)->get();
        return view('client.show_edit_approval', compact('newDetail', 'fileList', 'typePermisson'));
    }

    public function editNewApproval(Request $request)
    {
        $newId = $request->new_id;
        $new   = News::find($newId);
        if ($request->has('is_approval')) {
            $new->is_approval = 1;
        } else {
            $new->is_approval = 0;
        }

        $new->save();
        $cateIdEdit = $request->cateIdEdit;
        if ($cateIdEdit > 0) {
            $urlRedirect = 'client/show-new-by-catetory/' . $cateIdEdit;
            return redirect($urlRedirect)->with([
                'message' => 'Duyệt bài thành công',
            ]);
        } else {
            return redirect('client/website')->with([
                'message' => 'Duyệt bài thành công',
            ]);
        }
    }

    public function viewDetail(Request $request)
    {
        $client_id     = Auth::guard('client')->user()->id;
        $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" . $client_id . "' and g.name='website'";
        $result        = DB::selectOne($sql);
        $typePermisson = $result->type_perm;
        $allCategories = Category::all();
        $newId         = $request->id;
        $newDetail     = News::find($newId);
        //$fileList  = json_decode($newDetail->attach_file);
        $fileList = NewFile::where('new_id', $newId)->get();
        return view('client.xem_new', compact('newDetail', 'fileList', 'typePermisson'));
    }

}
