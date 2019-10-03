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
  $cateIdInsert = Request::route('cateIdInsert');
?>

@section('content')
    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">
              <?php
              /*$sql="select * from group_contact where id='".$contact->group_contact_id."'";
              $result=DB::selectOne($sql);
              echo $result->name;*/
              ?>
            </h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">Thêm liên hệ</h3>
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal" action="{{ url('client/insertContact')}}" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Họ Tên:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="name" name="name" 
                                  value="{{old('name')}}" 
                                  placeholder="Nhập tên">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Email:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="email" name="email" 
                                  value="{{old('email')}}" 
                                  placeholder="Nhập email">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Mobile:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="mobile" name="mobile" 
                                  value="{{old('mobile')}}" 
                                  placeholder="Nhập mobile">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Nhóm:</label>
                                <div class="col-sm-10"> 
                                    <select class="selectpicker form-control" name="groupContactId" data-live-search="true">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    if($cateIdInsert){
                                      $cate=DB::selectOne('select * from group_contact c where c.id='.$cateIdInsert);
                                          
                                    ?>
                                      <option value="<?php echo $cate->id?>"><?php echo $cate->name ?></option>
                                    <?php }else{?>
                                      <?php
                                        $sql="SELECT cate.id,g.name,cate.name,r.client_id,p.group_role_perm_id
                                        FROM group_role g,group_role_user r,group_role_perm p,group_contact cate
                                        WHERE 
                                         g.id=r.group_role_id AND r.id=p.group_role_user_id AND p.group_role_perm_id=cate.id 
                                         AND r.client_id='".$client_id."' AND g.name='khách hàng'";
                                         $groupContact=DB::select($sql);
                                    ?>
                                    @foreach($groupContact as $item)
                                    <?php
                                        $listIdCate[]=$item->id;
                                    ?>
                                    @endforeach
                                    <?php
                                    $contacts=\App\Models\groupContact::whereIn('id',$listIdCate)->orderBy('id', 'DESC')->get();
                                ?>
                                    @foreach($contacts as $item)
                                      <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                  <?php }?>
                                </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Trạng thái:</label>
                                <div class="col-sm-10"> 
                                    <select class="status_contact form-control" name="status_contact" data-live-search="true">
                                      <option value="0" selected="selected">Chưa xử lý</option>
                                      <option value="1">Đã phản hồi</option>
                                    </select>
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="control-label col-sm-2">Tiêu đề:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="subject" name="subject" 
                                  value=""  
                                  placeholder="Nhập tiêu đề">
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
                              <!-- <div class="form-group">
                                <label class="control-label col-sm-2">Trả lời:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="reply_content">{{old('reply_content')}}</textarea>
                                    <?php 
                                      if($cateIdInsert){

                                      ?>
                                         <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        //var message = CKEDITOR.instances.messageArea.getData();
                                       CKEDITOR.replace( 'reply_content', {
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
                                       CKEDITOR.replace( 'reply_content', {
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
                              </div> -->
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <input type="hidden" name="cateIdInsert" id="cateIdInsert"/>
                                  <button type="submit" class="btn btn-success">Thêm</button>
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
        
        if($cateIdInsert){
      ?>
      $('.selectpicker').selectpicker();
      $('.selectpicker').selectpicker('val',{{$cateIdInsert}});
      $('#cateIdInsert').val({{$cateIdInsert}});

      <?php }else{?>
        $('.selectpicker').selectpicker();
        $('.selectpicker').selectpicker('val',{{old('groupContactId')}});
      <?php }?>
      $('.status_contact').selectpicker();
      $('.status_contact').selectpicker('val',{{old('status_contact')}});
    });   
    </script>
@endsection
