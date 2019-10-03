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
  $cateIdEdit = Request::route('cateIdEdit');
?>
@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">Cập nhật</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                  <form class="form-horizontal" action="{{ url('client/editNew')}}" method="POST" enctype="multipart/form-data">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">Cập nhật tiếng việt</h3>
                            <div class="pull-right"><button type="submit" class="btn btn-success">Sửa</button></div>
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
                                  <input type="text" class="form-control" id="title" name="title" value="{{$newDetail->title}}" placeholder="Nhập tiêu đề">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Ngày tạo:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="created_date" name="created_date" value="{{date('d-m-Y',strtotime($newDetail->created_date))}}" placeholder="Nhập tiêu đề">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Danh mục:</label>
                                <div class="col-sm-10"> 
                                    <select class="selectpicker form-control" id="cate_id" name="cate_id" data-live-search="true">
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
                                    if($cateIdEdit){
                                      $cate=DB::selectOne('select * from categories c where c.id='.$cateIdEdit);
                                          
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
                                          @if(!empty($newDetail->img))
                                          <img src="{{URL::asset('assets/img/'.$newDetail->img)}}">
                                          @else
                                            <img src="{{URL::asset('assets/img/no-image.jpg')}}">
                                          @endif
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
                                    <label><input type="checkbox" name="is_approval" id="is_approval" value="1" @if($newDetail->is_approval==1) checked @endif @if(Auth::guard('client')->user()->id!=19) disabled @endif></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Bài trang chủ:</label>
                                <div class="col-sm-10">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="is_home" id="is_home" value="1" @if($newDetail->is_home==1) checked @endif></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Kích hoạt:</label>
                                <div class="col-sm-10"> 
                                    <select class="selectIsActive form-control" name="is_active" data-live-search="true">
                                      <option value="0">No</option>
                                      <option value="1">Yes</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Mô tả:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="summary">{{$newDetail->summary}}</textarea>
                                    <?php 
                                      if($cateIdEdit){

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
                                         filebrowserBrowseUrl : '../../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../../assets/ckfinder/ckfinder.html?type=Images'
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
                                         filebrowserBrowseUrl : '../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../assets/ckfinder/ckfinder.html?type=Images'
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
                                    <textarea class="form-control" name="content">{{$newDetail->content}}</textarea>
                                    <?php 
                                      if($cateIdEdit){

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
                                         filebrowserBrowseUrl : '../../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../../assets/ckfinder/ckfinder.html?type=Images'
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
                                         filebrowserBrowseUrl : '../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                   <?php
                                    }
                                   ?>
                                </div>
                              </div>
                                
                              
                              
                        
                      </div>
                       <div class="tab-pane" id="uploadNewVn">
                          <?php $i=0;?>
                                @foreach($fileList as $key => $item)
                                <div class="form-group">
                                <label class="control-label col-sm-2">File:{{$i++}}</label>
                                <div class="col-sm-10">
                                  <div>{{$item->file_name}}</div>
                                  <div class="col-sm-6">
                                     <input type="text" class="form-control titleFileOld"  data-id="{{$item->id}}" data-titleold="{{$item->title}}" name="titleFileOld[]" 
                                  value="{{$item->title}}"
                                  placeholder="Nhập tên file">
                                  </div>
                                  <div class="input-group control-group" >
                                      <input type="file" name="filenameold[]" data-id="{{$item->id}}" data-namefileupdate="{{$item->title}}" class="form-control inputFileOld" onchange="validate_fileupload(this);">
                                      <div class="input-group-btn"> 
                                        <button class="btn btn-danger btn-remove-edit-old" type="button"  data-id="{{$item->id}}" data-namefile="{{$item->title}}"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                      </div>
                                    </div>
                                </div>
                                </div>
                                @endforeach
                              <div class="form-group">
                                <label class="control-label col-sm-2">Upload file:</label>
                                <div class="col-sm-10"> 
                                  <div class="col-sm-4 increment" style="margin-top: 10px;">
                                     <!--<input type="text" class="form-control" id="" name="titleFileNew[]" 
                                  value=""
                                  placeholder="Nhập tên file">-->
                  <button class="btn btn-success btn-uploadFile" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                  </div>
                                    <!--<div class="input-group control-group " >
                                      <input type="file" name="filenamenew[]" class="form-control">
                                      <div class="input-group-btn"> 
                                        <button class="btn btn-success btn-uploadFile" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                      </div>
                                    </div>-->
                                    <div class="clone hide">
                                      <div class="col-sm-6 classFileName">
                                        <input type="text" class="form-control" id="" name="titleFileNew[]" 
                                        value=""
                                        placeholder="Nhập tên file" style="margin-top:10px">
                                        </div>
                                      <div class="control-group input-group" style="margin-top:10px">
                                        <input type="file" name="filenamenew[]" class="form-control">
                                        <div class="input-group-btn"> 
                                          <button class="btn btn-danger btn-remove-new-edit" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                      </div>
                      <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <input type="hidden" name="new_id" id="new_id" value="{{$newDetail->id}}"/>
                                  <input type="hidden" name="listFileNameDelete" id="listFileNameDelete" />
                                  <input type="hidden" name="listFileNameUpdate" id="listFileNameUpdate" />
                                   <input type="hidden" name="listTitleUpdate" id="listTitleUpdate" />
                                  <input type="hidden" name="cateIdEdit" id="cateIdEdit" value="
                                  <?php 
                                      if($cateIdEdit){
                                        echo $cate->id;
                                      }
                                  ?>"/>
                                  @if($typePermisson==1)
                                    <button type="submit" class="btn btn-success">Sửa</button>
                                  @endif
                                </div>
                              </div>
                    </div>
                        </div>
                    </div>
                    <div class="panel">
                      

                        <div class="panel-heading">
                            <h3 class="panel-title">Cập nhật tiếng Anh</h3>
                            <div class="pull-right"><button type="submit" class="btn btn-success">Sửa</button></div>
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
                                  <input type="text" class="form-control" id="title_en" name="title_en" value="{{$newDetail->title_en}}" placeholder="Nhập tiêu đề">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Duyệt:</label>
                                <div class="col-sm-10">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="is_approval_en" id="is_approval_en" value="1" @if($newDetail->is_approval_en==1) checked @endif @if(Auth::guard('client')->user()->id!=19) disabled @endif></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Bài trang chủ:</label>
                                <div class="col-sm-10">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="is_home_en" id="is_home_en" value="1" @if($newDetail->is_home_en==1) checked @endif></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Kích hoạt:</label>
                                <div class="col-sm-10"> 
                                    <select class="selectIsActiveEn form-control" name="is_active_en" data-live-search="true">
                                      <option value="0">No</option>
                                      <option value="1">Yes</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Mô tả:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="summary_en">{{$newDetail->summary_en}}</textarea>
                                    <?php 
                                      if($cateIdEdit){

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
                                         filebrowserBrowseUrl : '../../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../../assets/ckfinder/ckfinder.html?type=Images'
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
                                         filebrowserBrowseUrl : '../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../assets/ckfinder/ckfinder.html?type=Images'
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
                                    <textarea class="form-control" name="content_en">{{$newDetail->content_en}}</textarea>
                                    <?php 
                                      if($cateIdEdit){

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
                                         filebrowserBrowseUrl : '../../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../../assets/ckfinder/ckfinder.html?type=Images'
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
                                         filebrowserBrowseUrl : '../../assets/ckfinder/ckfinder.html',
                         
                                         filebrowserImageBrowseUrl : '../../assets/ckfinder/ckfinder.html?type=Images'
                                        });

                                </script>
                                   <?php
                                    }
                                   ?>
                                </div>
                              </div>
                                
                              
                              
                        
                      </div>
                       <div class="tab-pane" id="uploadNewEn">
                        <?php $i=0;?>
                                @foreach($fileListEn as $key => $item)
                                <div class="form-group">
                                <label class="control-label col-sm-2">File:{{$i++}}</label>
                                <div class="col-sm-10">
                                  <div>{{$item->file_name}}</div>
                                  <div class="col-sm-6">
                                     <input type="text" class="form-control titleFileOldEn"  data-id="{{$item->id}}" data-titleold="{{$item->title}}" name="titleFileOldEn[]" 
                                  value="{{$item->title}}"
                                  placeholder="Nhập tên file">
                                  </div>
                                  <div class="input-group control-group" >
                                      <input type="file" name="filenameoldEn[]" data-id="{{$item->id}}" data-namefileupdate="{{$item->title}}" class="form-control inputFileOld" onchange="validate_fileupload_en(this);">
                                      <div class="input-group-btn"> 
                                        <button class="btn btn-danger btn-remove-edit-old-en" type="button"  data-id="{{$item->id}}" data-namefile="{{$item->title}}"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                      </div>
                                    </div>
                                </div>
                                </div>
                                @endforeach
                              <div class="form-group">
                                <label class="control-label col-sm-2">Upload file:</label>
                                <div class="col-sm-10"> 
                                  <div class="col-sm-4 incrementEn" style="margin-top: 10px;">
                                     <!--<input type="text" class="form-control" id="" name="titleFileNew[]" 
                                  value=""
                                  placeholder="Nhập tên file">-->
                  <button class="btn btn-success btn-uploadFileEn" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                  </div>
                                    <!--<div class="input-group control-group " >
                                      <input type="file" name="filenamenew[]" class="form-control">
                                      <div class="input-group-btn"> 
                                        <button class="btn btn-success btn-uploadFile" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                      </div>
                                    </div>-->
                                    <div class="cloneEn hide">
                                      <div class="col-sm-6 classFileName">
                                        <input type="text" class="form-control" id="" name="titleFileNewEn[]" 
                                        value=""
                                        placeholder="Nhập tên file" style="margin-top:10px">
                                        </div>
                                      <div class="control-group input-group" style="margin-top:10px">
                                        <input type="file" name="filenamenewen[]" class="form-control">
                                        <div class="input-group-btn"> 
                                          <button class="btn btn-danger btn-remove-new-edit btnButtonEn" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                      </div>
                      <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <input type="hidden" name="new_id" id="new_id" value="{{$newDetail->id}}"/>
                                  <input type="hidden" name="listFileNameDeleteEn" id="listFileNameDeleteEn" />
                                  <input type="hidden" name="listFileNameUpdateEn" id="listFileNameUpdateEn" />
                                   <input type="hidden" name="listTitleUpdateEn" id="listTitleUpdateEn" />
                                  @if($typePermisson==1)
                                    <button type="submit" class="btn btn-success">Sửa</button>
                                  @endif
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
       $('#created_date').datetimepicker({
                format: 'DD-MM-YYYY',
                keepOpen: false,
            });
      arrayNameFileDelete=[];
      $(".btn-uploadFile").click(function(){ 
          var html = $(".clone").html();
          $(".increment").before(html);
      });

      $("body").on("click",".btn-remove-new-edit",function(){ 
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

      $('.titleFileOld').on('keyup',function() {
          var idTitleOld = $(this).data('id');
          var titleold = $(this).data('titleold');
          var valueTitleFileOld=$(this).val();
          if($('#listTitleUpdate').val().length>0){
            var listTitleUpdate  = JSON.parse($('#listTitleUpdate').val());
          }else {
            var listTitleUpdate  = [];
          }

          //listTitleUpdate.push({id:idTitleOld});
          var search = false;

            if(listTitleUpdate.length>0){

                listTitleUpdate.forEach(function(obj,index) { 
                //alert(obj.id); 
                if(obj.id==idTitleOld){
                  listTitleUpdate[index].name=valueTitleFileOld
                  search = true;
                  }
                });
            }
            
            if(search==false){
              listTitleUpdate.push({id:idTitleOld,name:titleold});
            }
          $('#listTitleUpdate').val(JSON.stringify(listTitleUpdate));
        });

       $("body").on("click",".btn-remove-edit-old",function(){
          arrayNameFileDelete.push($(this).data('id'));
          var arr = arrayNameFileDelete.join();
          $('#listFileNameDelete').val(arr);
          $(this).parents(".form-group").remove();
          //return;
          //remove list update id
          if($('#listFileNameUpdate').val().length>0){
            var deleteUpdateList = JSON.parse($('#listFileNameUpdate').val());
            var deleteId = $(this).data('id');
            if(deleteUpdateList.length>0){
             deleteUpdateList.forEach(function(obj,index) { 
                //alert(obj.id); 
                if(obj.id==deleteId){
                  delete deleteUpdateList[index]
                }
              });
              /*for(var i = 0; i < deleteUpdateList.length; i++) {
                var obj = deleteUpdateList[i];
                alert(obj.id);
                if(obj.id==deleteId){
                  delete deleteUpdateList[deleteId]
                }
              }*/
              //console.log(deleteUpdateList);
              deleteUpdateList = deleteUpdateList.filter(function(x) { return x !== null }); 
              $('#listFileNameUpdate').val(JSON.stringify(deleteUpdateList));
              if($('#listFileNameUpdate').val().length==2){
                $('#listFileNameUpdate').val("");
              }
          }
          }

          if($('#listTitleUpdate').val().length>0){
            var listTitleUpdate = JSON.parse($('#listTitleUpdate').val());
            var deleteId = $(this).data('id');
            if(listTitleUpdate.length>0){
             listTitleUpdate.forEach(function(obj,index) { 
                //alert(obj.id); 
                if(obj.id==deleteId){
                  delete listTitleUpdate[index]
                }
              });
              /*for(var i = 0; i < deleteUpdateList.length; i++) {
                var obj = deleteUpdateList[i];
                alert(obj.id);
                if(obj.id==deleteId){
                  delete deleteUpdateList[deleteId]
                }
              }*/
              //console.log(deleteUpdateList);
              listTitleUpdate = listTitleUpdate.filter(function(x) { return x !== null }); 
              $('#listTitleUpdate').val(JSON.stringify(listTitleUpdate));
              if($('#listTitleUpdate').val().length==2){
                $('#listTitleUpdate').val("");
              }
          }
          }
          
          return false;
      });
      
      

    });   
    </script>
    <script>
     $(document).ready(function() {
      arrayNameFileDeleteEn=[];
      $('.titleFileOldEn').on('keyup',function() {
          var idTitleOld = $(this).data('id');
          var titleold = $(this).data('titleold');
          var valueTitleFileOld=$(this).val();
          if($('#listTitleUpdateEn').val().length>0){
            var listTitleUpdateEn  = JSON.parse($('#listTitleUpdateEn').val());
          }else {
            var listTitleUpdateEn  = [];
          }

          //listTitleUpdate.push({id:idTitleOld});
          var search = false;

            if(listTitleUpdateEn.length>0){

                listTitleUpdateEn.forEach(function(obj,index) { 
                //alert(obj.id); 
                if(obj.id==idTitleOld){
                  listTitleUpdateEn[index].name=valueTitleFileOld
                  search = true;
                  }
                });
            }
            
            if(search==false){
              listTitleUpdateEn.push({id:idTitleOld,name:titleold});
            }
          $('#listTitleUpdateEn').val(JSON.stringify(listTitleUpdateEn));
        });

       $("body").on("click",".btn-remove-edit-old-en",function(){
          arrayNameFileDeleteEn.push($(this).data('id'));
          var arr = arrayNameFileDeleteEn.join();
          $('#listFileNameDeleteEn').val(arr);
          $(this).parents(".form-group").remove();
          //return;
          //remove list update id
          if($('#listFileNameUpdateEn').val().length>0){
            var deleteUpdateListEn = JSON.parse($('#listFileNameUpdateEn').val());
            var deleteId = $(this).data('id');
            if(deleteUpdateListEn.length>0){
             deleteUpdateListEn.forEach(function(obj,index) { 
                //alert(obj.id); 
                if(obj.id==deleteId){
                  delete deleteUpdateListEn[index]
                }
              });
              /*for(var i = 0; i < deleteUpdateList.length; i++) {
                var obj = deleteUpdateList[i];
                alert(obj.id);
                if(obj.id==deleteId){
                  delete deleteUpdateList[deleteId]
                }
              }*/
              //console.log(deleteUpdateList);
              deleteUpdateListEn = deleteUpdateListEn.filter(function(x) { return x !== null }); 
              $('#listFileNameUpdateEn').val(JSON.stringify(deleteUpdateListEn));
              if($('#listFileNameUpdateEn').val().length==2){
                $('#listFileNameUpdateEn').val("");
              }
          }
          }

          if($('#listTitleUpdateEn').val().length>0){
            var listTitleUpdateEn = JSON.parse($('#listTitleUpdateEn').val());
            var deleteId = $(this).data('id');
            if(listTitleUpdateEn.length>0){
             listTitleUpdateEn.forEach(function(obj,index) { 
                //alert(obj.id); 
                if(obj.id==deleteId){
                  delete listTitleUpdateEn[index]
                }
              });
              /*for(var i = 0; i < deleteUpdateList.length; i++) {
                var obj = deleteUpdateList[i];
                alert(obj.id);
                if(obj.id==deleteId){
                  delete deleteUpdateList[deleteId]
                }
              }*/
              //console.log(deleteUpdateList);
              listTitleUpdateEn = listTitleUpdateEn.filter(function(x) { return x !== null }); 
              $('#listTitleUpdateEn').val(JSON.stringify(listTitleUpdateEn));
              if($('#listTitleUpdateEn').val().length==2){
                $('#listTitleUpdateEn').val("");
              }
          }
          }
          
          return false;
      });
      
      

    });   
    </script>
    <script>
      $('.selectpicker').selectpicker();
      $('.selectpicker').selectpicker('val',{{$newDetail->cate_id}});
      $('.selectIsActive').selectpicker();
      $('.selectIsActive').selectpicker('val',{{$newDetail->is_active}});
      $('.selectIsActiveEn').selectpicker();
      $('.selectIsActiveEn').selectpicker('val',{{$newDetail->is_active_en}});
    </script>
    <script>
      //var valid = false;
      var arrayNameUpdate=[];
      
      function validate_fileupload(input_element)
      {
          //var el = document.getElementById("feedback");
          //var fileName = input_element.value;
          //arrayNameUpdate.push($(input_element).data('namefileupdate'))
          //console.log( JSON.stringify(arrayNameUpdate) );
          // var arr = arrayNameUpdate.join();
          if($('#listFileNameUpdate').val().length>0){
            var listFileNameUpdate  = JSON.parse($('#listFileNameUpdate').val());
          }else {
            var listFileNameUpdate  = [];
          }

          
          var fileName = input_element.value;
          // console.log('type of ' + typeof fileName);
          // console.log('length' + fileName.length);
          // return;
          if(fileName.length>0){
            var idNameUpdate = $(input_element).data('id');
            var namefileupdate = $(input_element).data('namefileupdate');
            var search = false;

            if(listFileNameUpdate.length>0){
                // var filename = fileName.replace(/^.*[\\\/]/, '');
                // filename = filename.split(':');
                // filename = filename[1];
                // var title = $(input_element).val();
                listFileNameUpdate.forEach(function(obj,index) { 
                //alert(obj.id); 
                if(obj.id==idNameUpdate){
                  //alert('bang nhau'+ idNameUpdate)
                  //alert('index' + index )
                  //alert('name file ' + namefileupdate)
                  listFileNameUpdate[index].name=namefileupdate
                  search = true;
                  }
                });
            }
            
            if(search==false){
              //alert('push vao day'+idNameUpdate)
              listFileNameUpdate.push({id:idNameUpdate,name:namefileupdate});
            }
            //console.log('array list listFileNameUpdate')
            //console.log(listFileNameUpdate);
            $('#listFileNameUpdate').val(JSON.stringify(listFileNameUpdate));
          }
          
          

          return;
          /*var allowed_extensions = new Array("jpg","png","gif");
          var file_extension = fileName.split('.').pop(); 
          for(var i = 0; i < allowed_extensions.length; i++)
          {
              if(allowed_extensions[i]==file_extension)
              {
                  valid = true; // valid file extension
                  el.innerHTML = "";
                  return;
              }
          }
          el.innerHTML="Invalid file";
          valid = false;*/
      }

      function validate_fileupload_en(input_element)
      {
          //var el = document.getElementById("feedback");
          //var fileName = input_element.value;
          //arrayNameUpdate.push($(input_element).data('namefileupdate'))
          //console.log( JSON.stringify(arrayNameUpdate) );
          // var arr = arrayNameUpdate.join();
          if($('#listFileNameUpdateEn').val().length>0){
            var listFileNameUpdateEn  = JSON.parse($('#listFileNameUpdateEn').val());
          }else {
            var listFileNameUpdateEn  = [];
          }

          
          var fileName = input_element.value;
          // console.log('type of ' + typeof fileName);
          // console.log('length' + fileName.length);
          // return;
          if(fileName.length>0){
            var idNameUpdate = $(input_element).data('id');
            var namefileupdate = $(input_element).data('namefileupdate');
            var search = false;

            if(listFileNameUpdateEn.length>0){
                // var filename = fileName.replace(/^.*[\\\/]/, '');
                // filename = filename.split(':');
                // filename = filename[1];
                // var title = $(input_element).val();
                listFileNameUpdateEn.forEach(function(obj,index) { 
                //alert(obj.id); 
                if(obj.id==idNameUpdate){
                  //alert('bang nhau'+ idNameUpdate)
                  //alert('index' + index )
                  //alert('name file ' + namefileupdate)
                  listFileNameUpdateEn[index].name=namefileupdate
                  search = true;
                  }
                });
            }
            
            if(search==false){
              //alert('push vao day'+idNameUpdate)
              listFileNameUpdateEn.push({id:idNameUpdate,name:namefileupdate});
            }
            //console.log('array list listFileNameUpdate')
            //console.log(listFileNameUpdate);
            $('#listFileNameUpdateEn').val(JSON.stringify(listFileNameUpdateEn));
          }
          
          

          return;
          /*var allowed_extensions = new Array("jpg","png","gif");
          var file_extension = fileName.split('.').pop(); 
          for(var i = 0; i < allowed_extensions.length; i++)
          {
              if(allowed_extensions[i]==file_extension)
              {
                  valid = true; // valid file extension
                  el.innerHTML = "";
                  return;
              }
          }
          el.innerHTML="Invalid file";
          valid = false;*/
      }
      
</script>
@endsection

