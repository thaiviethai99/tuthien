@extends('client')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
	{!! Html::script("assets/ckeditor/ckeditor.js") !!}
	<style type="text/css">
   .tabMargin{
    margin-top: 10px;
   } 
  </style>
@endsection
<?php
  $cateIdInsert = Request::route('cateIdInsert');
?>

@section('content')
    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">Tạo tin mới</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                   <form class="form-horizontal" action="{{ url('client/insertNew')}}" method="POST" enctype="multipart/form-data">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">Tạo tin mới Tiếng Việt</h3>
                             <div class="pull-right"><button type="submit" class="btn btn-success">Thêm</button></div>
                        </div>

                        <div class="panel-body">
                           <ul class="nav nav-tabs">
                        <li class="active"><a href="#contentNewVn" data-toggle="tab">Nội dung</a></li>
                        <li><a href="#uploadNewVn" data-toggle="tab">Upload File</a></li>
                    </ul>
                    <div class="tab-content tabMargin">
                        <div class="tab-pane active" id="contentNewVn">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Tiêu đề:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="title" name="title" 
                                  value="{{ old('title') }}"
                                  placeholder="Nhập tiêu đề">
                                </div>
                              </div>
                             <!--  <div class="form-group">
                                <label class="control-label col-sm-2">Ngày tạo:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="created_date" name="created_date" 
                                  value="{{ old('created_date') }}"
                                  placeholder="Nhập ngày tạo">
                                </div>
                              </div> -->
                              <div class="form-group">
                                <label class="control-label col-sm-2">Danh mục:</label>
                                <div class="col-sm-10"> 
                                    <select class="selectpicker form-control" name="cate_id" data-live-search="true">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                        $sql="SELECT DISTINCT(cate.parent_id)
                                                FROM group_role g,group_role_user r,group_role_perm p,categories cate
                                                WHERE 
                                                g.id=r.group_role_id 
                                                AND r.id=p.group_role_user_id 
                                                and p.group_role_perm_id=cate.id
                                                AND r.client_id='".$client_id."' AND g.name='website'
                                                AND r.full_permission=0
                                                order by parent_id asc";
                                        $parentMenu=DB::select($sql);
                                    ?>
                              <?php
                                            $sql="SELECT cate.id,cate.parent_id,g.name,cate.title,r.client_id,p.group_role_perm_id
                                                FROM group_role g,group_role_user r,group_role_perm p,categories cate
                                                WHERE 
                                                g.id=r.group_role_id 
                                                AND r.id=p.group_role_user_id 
                                                and p.group_role_perm_id=cate.id
                                                AND r.client_id='".$client_id."' AND g.name='website'
                                                order by parent_id asc";
                                            $childMenu=DB::select($sql);
                                        ?>
                              <?php
                                //print_r($parentMenu);
                                $listIdParent=[];
                                $listIdChild=[];
                                foreach ($parentMenu as $item) {
                                  $listIdParent[]=$item->parent_id;
                                  foreach ($childMenu as $item1) {
                                    if($item1->parent_id==$item->parent_id)
                                      $listIdChild[]=$item1->id;
                                }
                                }
                                $arrayIdPer=array_unique(array_merge($listIdParent,$listIdChild));
                              ?>
                                    <?php
                                    if($cateIdInsert){
                                      $cate=DB::selectOne('select * from categories c where c.id='.$cateIdInsert);
                                          
                                    ?>
                                      <option value="<?php echo $cate->id?>"><?php echo $cate->title ?></option>
                                    <?php
                                      }else{
                                      ?>
                                      <?php
                                      recursive($data, 0, 0, $result);
                                     if($parentMenu){
                                    foreach ($result as $key => $val) {
                                        $numRepeat = $val['level'];
                                        $char = '';
                                        if ($numRepeat > 0) {
                                            $char .= str_repeat('---', $numRepeat);
                                        }
                                        if($val['id']!=1 && in_array($val['id'],$arrayIdPer)){
                                        ?>
                                        <option @if($val['top']==1) style="color:red" @endif value="<?php echo $val['id'];?>"><?php echo $char . ' ' . $val['name']; ?></option>
                                    <?php }}
                                    }else{?>
                                      <?php 
                                      foreach ($result as $key => $val) {
                                        $numRepeat = $val['level'];
                                        $char = '';
                                        if ($numRepeat > 0) {
                                            $char .= str_repeat('---', $numRepeat);
                                        }
                                        if($val['id']!=1){
                                        ?>
                                        <option @if($val['top']==1) style="color:red" @endif value="<?php echo $val['id'];?>"><?php echo $char . ' ' . $val['name']; ?></option>
                                    <?php }}?>
                                      <?php }}?>
                                      
                                </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Hình đại diện:</label>
                                <div class="col-sm-10">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
                                          <img src="{{URL::asset('assets/img/no-image.jpg')}}"/>
                                        </div>
                                        <div>
                                            <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                            <input type="file" name="img"/></span>
                                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Duyệt:</label>
                                <div class="col-sm-10">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="is_approval" value="1" @if(Auth::guard('client')->user()->id!=19) disabled @endif></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Bài trang chủ:</label>
                                <div class="col-sm-10">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="is_home" value="1"></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Kích hoạt:</label>
                                <div class="col-sm-10"> 
                                    <select class="selectIsActive form-control" name="is_active" data-live-search="true">
                                      <option value="0">No</option>
                                      <option value="1" selected="selected">Yes</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Mô tả:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="summary">{{old('summary')}}</textarea>
                                    <?php 
                                      if($cateIdInsert){

                                      ?>
                                         <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'summary', {
                                        height: '150px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        toolbar:    
                                            [
                                                [,'Preview','Templates'],
                                                           ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                                           ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                           '/',
                                                           ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                           ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                                           ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                           ['BidiLtr', 'BidiRtl' ],
                                                           ['Link','Unlink','Anchor'],
                                                           ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                                           '/',
                                                           ['Styles','Format','Font','FontSize'],
                                                           ['TextColor','BGColor'],
                                                           ['Maximize','ShowBlocks','Syntaxhighlight']
                                         ],
                                         //filebrowserWindowWidth  : 300,
                                         //filebrowserWindowHeight : 300,
                                         filebrowserBrowseUrl : '../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                      <?php }else{
                                  ?>
                                  <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'summary', {
                                        height: '150px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        toolbar:    
                                            [
                                                [,'Preview','Templates'],
                                                           ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                                           ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                           '/',
                                                           ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                           ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                                           ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                           ['BidiLtr', 'BidiRtl' ],
                                                           ['Link','Unlink','Anchor'],
                                                           ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                                           '/',
                                                           ['Styles','Format','Font','FontSize'],
                                                           ['TextColor','BGColor'],
                                                           ['Maximize','ShowBlocks','Syntaxhighlight']
                                         ],
                                         //filebrowserWindowWidth  : 300,
                                         //filebrowserWindowHeight : 300,
                                         filebrowserBrowseUrl : '../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                   <?php
                                    }
                                   ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Nội dung:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="content">{{old('content')}}</textarea>
                                    <?php 
                                      if($cateIdInsert){

                                      ?>
                                         <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'content', {
                                        height: '300px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        toolbar:    
                                            [
                                                [,'Preview','Templates'],
                                                           ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                                           ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                           '/',
                                                           ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                           ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                                           ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                           ['BidiLtr', 'BidiRtl' ],
                                                           ['Link','Unlink','Anchor'],
                                                           ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                                           '/',
                                                           ['Styles','Format','Font','FontSize'],
                                                           ['TextColor','BGColor'],
                                                           ['Maximize','ShowBlocks','Syntaxhighlight']
                                         ],
                                         //filebrowserWindowWidth  : 300,
                                         //filebrowserWindowHeight : 300,
                                         filebrowserBrowseUrl : '../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                      <?php }else{
                                  ?>
                                  <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'content', {
                                        height: '300px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        toolbar:    
                                            [
                                                [,'Preview','Templates'],
                                                           ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                                           ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                           '/',
                                                           ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                           ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                                           ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                           ['BidiLtr', 'BidiRtl' ],
                                                           ['Link','Unlink','Anchor'],
                                                           ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                                           '/',
                                                           ['Styles','Format','Font','FontSize'],
                                                           ['TextColor','BGColor'],
                                                           ['Maximize','ShowBlocks','Syntaxhighlight']
                                         ],
                                         //filebrowserWindowWidth  : 300,
                                         //filebrowserWindowHeight : 300,
                                         filebrowserBrowseUrl : '../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                   <?php
                                    }
                                   ?>
                                </div>
                              </div>
                              
                              
                             
                        </div>
                        <div class="tab-pane" id="uploadNewVn">
                          <div class="form-group">
                                <label class="control-label col-sm-2">Upload file:</label>
                                <div class="col-sm-10"> 
                                  <div class="col-sm-4 increment" style="margin-top: 10px;">
                                     <!-- <input type="text" class="form-control" id="" name="titleFile[]" 
                                  value=""
                                  placeholder="Nhập tên file" style="margin-top:10px"> -->
                                  <button class="btn btn-success btn-uploadFile" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                  </div>
                                    <!-- <div class="input-group control-group" style="margin-top:10px">
                                      <input type="file" name="fileNameUpload[]" class="form-control">
                                      <div class="input-group-btn"> 
                                        <button class="btn btn-success btn-uploadFile" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                      </div>
                                    </div> -->
                                    <div class="clone hide">
                                      <div class="col-sm-6 classFileName">
                                     <input type="text" class="form-control" id="" name="titleFile[]" 
                                        value=""
                                        placeholder="Nhập tên file" style="margin-top:10px">
                                        </div>
                                      <div class="control-group input-group" style="margin-top:10px">
                                        <input type="file" name="fileNameUpload[]" class="form-control">
                                        <div class="input-group-btn"> 
                                          <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                         <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <input type="hidden" name="cateIdInsert" id="cateIdInsert"/>
                                  <button type="submit" class="btn btn-success">Thêm</button>
                                </div>
                              </div>
                    </div>
                        </div>
                    </div>
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">Tạo tin mới tiếng Anh</h3>
                            <div class="pull-right"><button type="submit" class="btn btn-success">Thêm</button></div>
                        </div>

                        <div class="panel-body">
                           <ul class="nav nav-tabs">
                        <li class="active"><a href="#contentNewEn" data-toggle="tab">Nội dung</a></li>
                        <li><a href="#uploadNewEn" data-toggle="tab">Upload File</a></li>
                    </ul>
                    <div class="tab-content tabMargin">
                        <div class="tab-pane active" id="contentNewEn">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Tiêu đề:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="title_en" name="title_en" 
                                  value="{{ old('title_en') }}"
                                  placeholder="Nhập tiêu đề">
                                </div>
                              </div>
                             <!--  <div class="form-group">
                                <label class="control-label col-sm-2">Ngày tạo:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="created_date" name="created_date" 
                                  value="{{ old('created_date') }}"
                                  placeholder="Nhập ngày tạo">
                                </div>
                              </div> -->
                              <div class="form-group">
                                <label class="control-label col-sm-2">Duyệt:</label>
                                <div class="col-sm-10">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="is_approval_en" value="1" @if(Auth::guard('client')->user()->id!=19) disabled @endif></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Bài trang chủ:</label>
                                <div class="col-sm-10">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="is_home_en" value="1"></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Kích hoạt:</label>
                                <div class="col-sm-10"> 
                                    <select class="selectIsActiveEn form-control" name="is_active_en" data-live-search="true">
                                      <option value="0">No</option>
                                      <option value="1" selected="selected">Yes</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Mô tả:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="summary_en">{{old('summary_en')}}</textarea>
                                    <?php 
                                      if($cateIdInsert){

                                      ?>
                                         <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'summary_en', {
                                        height: '150px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        toolbar:    
                                            [
                                                [,'Preview','Templates'],
                                                           ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                                           ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                           '/',
                                                           ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                           ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                                           ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                           ['BidiLtr', 'BidiRtl' ],
                                                           ['Link','Unlink','Anchor'],
                                                           ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                                           '/',
                                                           ['Styles','Format','Font','FontSize'],
                                                           ['TextColor','BGColor'],
                                                           ['Maximize','ShowBlocks','Syntaxhighlight']
                                         ],
                                         //filebrowserWindowWidth  : 300,
                                         //filebrowserWindowHeight : 300,
                                         filebrowserBrowseUrl : '../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                      <?php }else{
                                  ?>
                                  <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'summary_en', {
                                        height: '150px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        toolbar:    
                                            [
                                                [,'Preview','Templates'],
                                                           ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                                           ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                           '/',
                                                           ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                           ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                                           ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                           ['BidiLtr', 'BidiRtl' ],
                                                           ['Link','Unlink','Anchor'],
                                                           ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                                           '/',
                                                           ['Styles','Format','Font','FontSize'],
                                                           ['TextColor','BGColor'],
                                                           ['Maximize','ShowBlocks','Syntaxhighlight']
                                         ],
                                         //filebrowserWindowWidth  : 300,
                                         //filebrowserWindowHeight : 300,
                                         filebrowserBrowseUrl : '../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                   <?php
                                    }
                                   ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Nội dung:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="content_en">{{old('content_en')}}</textarea>
                                    <?php 
                                      if($cateIdInsert){

                                      ?>
                                         <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'content_en', {
                                        height: '300px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        toolbar:    
                                            [
                                                [,'Preview','Templates'],
                                                           ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                                           ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                           '/',
                                                           ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                           ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                                           ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                           ['BidiLtr', 'BidiRtl' ],
                                                           ['Link','Unlink','Anchor'],
                                                           ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                                           '/',
                                                           ['Styles','Format','Font','FontSize'],
                                                           ['TextColor','BGColor'],
                                                           ['Maximize','ShowBlocks','Syntaxhighlight']
                                         ],
                                         //filebrowserWindowWidth  : 300,
                                         //filebrowserWindowHeight : 300,
                                         filebrowserBrowseUrl : '../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                      <?php }else{
                                  ?>
                                  <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'content_en', {
                                        height: '300px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        toolbar:    
                                            [
                                                [,'Preview','Templates'],
                                                           ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
                                                           ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                           '/',
                                                           ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                           ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                                           ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                           ['BidiLtr', 'BidiRtl' ],
                                                           ['Link','Unlink','Anchor'],
                                                           ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                                                           '/',
                                                           ['Styles','Format','Font','FontSize'],
                                                           ['TextColor','BGColor'],
                                                           ['Maximize','ShowBlocks','Syntaxhighlight']
                                         ],
                                         //filebrowserWindowWidth  : 300,
                                         //filebrowserWindowHeight : 300,
                                         filebrowserBrowseUrl : '../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                   <?php
                                    }
                                   ?>
                                </div>
                              </div>
                              
                              
                             
                        </div>
                        <div class="tab-pane" id="uploadNewEn">
                          <div class="form-group">
                                <label class="control-label col-sm-2">Upload file:</label>
                                <div class="col-sm-10"> 
                                  <div class="col-sm-4 incrementEn" style="margin-top: 10px;">
                                     <!-- <input type="text" class="form-control" id="" name="titleFile[]" 
                                  value=""
                                  placeholder="Nhập tên file" style="margin-top:10px"> -->
                                  <button class="btn btn-success btn-uploadFileEn" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                  </div>
                                    <!-- <div class="input-group control-group" style="margin-top:10px">
                                      <input type="file" name="fileNameUpload[]" class="form-control">
                                      <div class="input-group-btn"> 
                                        <button class="btn btn-success btn-uploadFile" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                      </div>
                                    </div> -->
                                    <div class="cloneEn hide">
                                      <div class="col-sm-6 classFileName">
                                     <input type="text" class="form-control" id="" name="titleFileEn[]" 
                                        value=""
                                        placeholder="Nhập tên file" style="margin-top:10px">
                                        </div>
                                      <div class="control-group input-group" style="margin-top:10px">
                                        <input type="file" name="fileNameUploadEn[]" class="form-control">
                                        <div class="input-group-btn"> 
                                          <button class="btn btn-danger btnButtonEn" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                         <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-success">Thêm</button>
                                </div>
                              </div>
                    </div>
                        </div>
                    </div>
                  </form>
                </div>

            </div>

        </div>
    </section>

@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
	<script>
     $(document).ready(function() {

      $(".btn-uploadFile").click(function(){ 
          var html = $(".clone").html();
          $(".increment").before(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          //$(this).parents(".control-group").remove();
          //$(this).parents(".control-group").parent().find('.classFileName').remove()
          $(this).parents(".control-group").prev().remove();
          $(this).parents(".control-group").remove();
      });

      $(".btn-uploadFileEn").click(function(){ 
          var html = $(".cloneEn").html();
          $(".incrementEn").before(html);
      });

      $("body").on("click",".btnButtonEn",function(){ 
          //$(this).parents(".control-group").remove();
          //$(this).parents(".control-group").parent().find('.classFileName').remove()
          $(this).parents(".control-group").prev().remove();
          $(this).parents(".control-group").remove();
      });
      <?php
        
        if($cateIdInsert){
      ?>
      $('.selectpicker').selectpicker();
      $('.selectpicker').selectpicker('val',{{$cateIdInsert}});
      $('#cateIdInsert').val({{$cateIdInsert}});

      <?php }else{?>
        $('.selectpicker').selectpicker();
        $('.selectpicker').selectpicker('val',{{old('cate_id')}});
      <?php }?>
      $('.selectIsActive').selectpicker();
      $('.selectIsActive').selectpicker('val',{{old('is_active')}});
       $('.selectIsActiveEn').selectpicker();
      $('.selectIsActiveEn').selectpicker('val',{{old('is_active_en')}});
    });   
    </script>
@endsection
