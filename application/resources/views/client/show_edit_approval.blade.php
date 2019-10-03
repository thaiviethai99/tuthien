@extends('client')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
	{!! Html::script("assets/ckeditor/ckeditor.js") !!}
	<style>
   .view{
    margin-top: 5px;
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
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">Cập nhật</h3>
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal" action="{{ url('client/editNewApproval')}}" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label class="control-label col-sm-2">Tiêu đề:</label>
                                <div class="col-sm-10 view">
                                  {{$newDetail->title}}
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Danh mục:</label>
                                <div class="col-sm-10 view"> 
                                    <?php
                                      $cate=DB::selectOne('select * from categories c where c.id='.$newDetail->cate_id);
                                      echo $cate->title;
                                    ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Hình đại diện:</label>
                                <div class="col-sm-10 view">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
                                          @if(!empty($newDetail->img))
                                          <img src="{{URL::asset('assets/img/'.$newDetail->img)}}">
                                          @else
                                            <img src="{{URL::asset('assets/img/no-image.jpg')}}">
                                          @endif
                                        </div>
                                       
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Duyệt:</label>
                                <div class="col-sm-10 view">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="is_approval" id="is_approval" value="1" @if($newDetail->is_approval==1) checked @endif></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Bài trang chủ:</label>
                                <div class="col-sm-10 view">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="is_home" id="is_home" disabled="disabled" value="1" @if($newDetail->is_home==1) checked @endif></label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Kích hoạt:</label>
                                <div class="col-sm-10 view"> 
                                    <?php
                                      echo ($newDetail->is_active==1)?'Yes':'No';
                                    ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Mô tả:</label>
                                <div class="col-sm-10 view">
                                   {{$newDetail->summary}}
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-2">Nội dung:</label>
                                <div class="col-sm-10 view">
                                  {!! $newDetail->content !!}
                                </div>
                              </div>
                                <?php $i=0;?>
                                @foreach($fileList as $key => $item)
                                <div class="form-group">
                                <label class="control-label col-sm-2">File:{{$i++}}</label>
                                <div class="col-sm-10">
                                  <div class="col-sm-4">
                                     {{$item->title}}
                                  </div>
                                  <div class="input-group control-group" >
                                      {{$item->file_name}}
                                    </div>
                                </div>
                                </div>
                                @endforeach
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
                                    <button type="submit" class="btn btn-default">Submit</button>
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
      arrayNameFileDelete=[];
      $(".btn-uploadFile").click(function(){ 
          var html = $(".clone").html();
          $(".increment").before(html);
      });

      $("body").on("click",".btn-remove-new-edit",function(){ 
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
              $('#listTitleUpdate').val(JSON.stringify(deleteUpdateList));
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
      $('.selectpicker').selectpicker();
      $('.selectpicker').selectpicker('val',{{$newDetail->cate_id}});
      $('.selectIsActive').selectpicker();
      $('.selectIsActive').selectpicker('val',{{$newDetail->is_active}});
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

      
</script>
@endsection

