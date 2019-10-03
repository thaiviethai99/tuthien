@extends('client')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
	{!! Html::script("assets/ckeditor/ckeditor.js") !!}
	<style type="text/css">
  .form-control:disabled {
    background: #f8f8f8;
    color: black;
}
</style>
@endsection
<?php
  $cateIdEdit = Request::route('cateIdEdit');
?>

@section('content')
    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">
              <?php
              $sql="select * from group_contact where id='".$contact->group_contact_id."'";
              $result=DB::selectOne($sql);
              echo $result->name;
              ?>
            </h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">{{$result->name}}</h3>
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal" action="{{ url('client/post-reply')}}" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Họ Tên:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="name" name="name" 
                                  value="{{ $contact->name }}" 
                                  placeholder="Nhập tên">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Email:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="email" name="email" 
                                  value="{{ $contact->email }}" 
                                  placeholder="Nhập email">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Mobile:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="mobile" name="mobile" 
                                  value="{{ $contact->mobile }}" 
                                  placeholder="Nhập mobile">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Ngày tạo:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="created_date" name="created_date" 
                                  value="{{date('d-m-Y',strtotime($contact->created_date))}}" disabled="disabled" 
                                  placeholder="Nhập ngày tạo">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Nhóm:</label>
                                <div class="col-sm-10"> 
                                    <select class="selectpicker form-control" name="groupContactId" data-live-search="true">
                                    <option value="">Chọn danh mục</option>
                                    @foreach($groupContact as $item)
                                      <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Trạng thái:</label>
                                <div class="col-sm-10"> 
                                    <select class="status_contact form-control" name="status_contact" data-live-search="true">
                                      <option value="0">Chưa xử lý</option>
                                      <option value="1">Đã phản hồi</option>
                                    </select>
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="control-label col-sm-2">Tiêu đề:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="subject" name="subject" 
                                  value="{{ $contact->subject }}"  
                                  placeholder="Nhập tiêu đề">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Nội dung:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="content">{{$contact->content}}</textarea>
                                    <?php 
                                      if($cateIdEdit){

                                      ?>
                                         <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'content', {
                                        height: '150px',
                                        enterMode: CKEDITOR.ENTER_BR,
                                        entities:false,
                                        basicEntities:false,
                                        htmlEncodeOutput:false,
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
                                        height: '150px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        entities:false,
                                        basicEntities:false,
                                        htmlEncodeOutput:false,
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
                                <label class="control-label col-sm-2">Trả lời:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="reply_content">{{$contact->reply_content}}</textarea>
                                    <?php 
                                      if($cateIdEdit){

                                      ?>
                                         <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'reply_content', {
                                        height: '300px',
                                        enterMode: CKEDITOR.ENTER_BR, 
                                        entities:false,
                                        basicEntities:false,
                                        htmlEncodeOutput:false,
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
                                       CKEDITOR.replace( 'reply_content', {
                                        height: '300px',
                                        enterMode: CKEDITOR.ENTER_BR,
                                        entities:false,
                                        basicEntities:false,
                                        htmlEncodeOutput:false,
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
                                <div class="col-sm-offset-2 col-sm-10">
                                  <input type="hidden" name="cateIdEdit" id="cateIdEdit"/>
                                  <input type="hidden" name="contactId" value="{{$contact->id}}">
                                  @if($typePermisson==1)
                                    <button type="submit" class="btn btn-success">Trả lời</button>
                                  @endif
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
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
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          //$(this).parents(".control-group").remove();
          //$(this).parents(".control-group").parent().find('.classFileName').remove()
          $(this).parents(".control-group").prev().remove();
          $(this).parents(".control-group").remove();
      });
      <?php
        
        if($cateIdEdit){
      ?>
      $('.selectpicker').selectpicker();
      $('.selectpicker').selectpicker('val',{{$cateIdEdit}});
      $('#cateIdEdit').val({{$cateIdEdit}});

      <?php }else{?>
        $('.selectpicker').selectpicker();
        $('.selectpicker').selectpicker('val',{{$contact->group_contact_id}});
      <?php }?>
      $('.status_contact').selectpicker();
      $('.status_contact').selectpicker('val',{{$contact->status_contact}});
    });   
    </script>
@endsection
