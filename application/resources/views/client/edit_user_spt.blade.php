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
              Sửa người dùng
            </h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title"></h3>
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal" action="{{ url('client/post-edit-user-spt')}}" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Họ Tên:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="name" name="name" 
                                  value="{{$client->name}}" 
                                  placeholder="Nhập tên">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Email:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="email" name="email" 
                                  value="{{$client->email}}" 
                                  placeholder="Nhập email">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Mobile:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="mobile" name="mobile" 
                                  value="{{$client->mobile}}" 
                                  placeholder="Nhập mobile">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Phòng:</label>
                                <div class="col-sm-10"> 
                                    <select class="selectpicker form-control" name="roomId" data-live-search="true">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    if($cateIdEdit){
                                      $cate=DB::selectOne('select * from room c where c.id='.$cateIdEdit);
                                          
                                    ?>
                                      <option value="<?php echo $cate->id?>"><?php echo $cate->name ?></option>
                                    <?php }else{?>
                                    @foreach($rooms as $item)
                                      <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                  <?php }?>
                                </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Mật khẩu:</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" id="password" name="password" 
                                  value="{{old('password')}}" 
                                  placeholder="Nhập password">
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="control-label col-sm-2">Nhận email hệ thống:</label>
                                <div class="col-sm-10">
                                  <input type="checkbox" value="1" name="is_send_email" 
                                  @if($client->is_send_email==1) 
                                    checked
                                  @endif>
                                </div>
                              </div>
							  <div class="form-group">
                                <label class="control-label col-sm-2">Duyệt bài viết:</label>
                                <div class="col-sm-10">
                                  <input type="checkbox" value="1" name="is_approval_new" 
                                  @if($client->is_approval_new==1) 
                                    checked
                                  @endif>
                                </div>
                              </div>
                              <div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <input type="hidden" name="user_spt_id" id="user_spt_id" value="{{$client->id}}"/>
                                  <input type="hidden" name="cateIdEdit" id="cateIdEdit" value="
                                  <?php 
                                      if($cateIdEdit){
                                        echo $cate->id;
                                      }
                                  ?>"/>
                                  <button type="submit" class="btn btn-default">Submit</button>
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
      $('.selectpicker').selectpicker();
      $('.selectpicker').selectpicker('val',{{$client->room_id}});
      });
    </script>
@endsection
