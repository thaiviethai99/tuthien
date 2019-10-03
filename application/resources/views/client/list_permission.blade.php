@extends('client')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
    <style>
     .data-table th{
    white-space: nowrap;
}

.data-table td{
  white-space: nowrap;
}
.table tbody tr td {
    font-size:12px;
}

.permission{
    margin-left: 20px;
}
.permissionChild{
    margin-left: 40px;
}

.table tbody tr td{
    padding:10px;
}
   </style>
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">
               Phân quyền|{{$userEmail}}
            </h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">
                <form role="form" method="post" action="{{url('client/post-list-permission')}}">
                    <input type="hidden" name="userId" id="userId" value="{{$userId}}">
                <div class="col-lg-5">
                    <div class="panel">
                        <div class="panel-heading">
                             <div class="row" style="margin:0px">
                                <h3 class="panel-title pull-left">Danh sách nhóm</h3>
                             </div>

                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <tr>
                                    <td>
                                        <input type="checkbox" name="group_role_id[]" value="1" @if($groupRoleWebsite) checked @endif>
                                    </td>
                                    <td id="tdWebsite">
                                        <a href="#">Website</a>
                                    </td>
                                    <td>
                                        <select name="group_role_id_type_website" id="selectWebsite">
                                            <option value="0">Đọc</option>
                                            <option value="1">Đọc và ghi</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr >
                                    <td>
                                        <input type="checkbox" name="group_role_id[]" value="2" @if($groupRoleKhachHang) checked @endif>
                                    </td>
                                    <td id="tdKhachHang">
                                        <a href="#">Khách hàng</a>
                                    </td>
                                    <td>
                                        <select name="group_role_id_type_kh" id="selectKhachHang">
                                            <option value="0">Đọc</option>
                                            <option value="1">Đọc và ghi</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-7" id="showPerWebsite" style="display: none">
                    <div class="panel">
                        <div class="panel-heading">
                             <div class="row" style="margin:0px">
                                <h3 class="panel-title pull-left">Danh sách quyền</h3>
                                <button class="btn btn-success pull-right"><i class="fa fa-plus"></i> Cập nhật </button>
                             </div>

                        </div>
                        <div class="panel-body p-none">
                            <div class="col-md-12">
                                
                                 <div class="checkbox">
                                   <label>
                                     <input type="checkbox" value="1" name="checkRoot" id="checkRoot"
                                     @if(!empty($isFullPermission) && $isFullPermission==1)
                                        checked
                                     @endif
                                     > Root
                                   </label>
                                 </div>
                                   <?php
                                    $listPermission=DB::select('select * from categories where top=1');
                                   ?>
                                   @foreach($listPermission as $item)
                                    <div class="checkbox permission">
                                       <label>
                                         <input type="checkbox" value="{{$item->id}}" name="lisPerWebsite[]" class="parent-id-{{$item->id}} parentPer" data-parentid='{{$item->id}}'
                                         @if($item->id==1) id="checkRoot" @endif
                                          @if(in_array($item->id,$arrayPerWebsite))
                                            checked
                                         @endif
                                         > {{$item->title}}
                                       </label>
                                    </div>
                                    <?php
                                        $sql="select * from categories where parent_id=".$item->id;
                                        $listPermissionChild=DB::select($sql);
                                    ?>
                                    @foreach($listPermissionChild as $itemChild)
                                        <div class="checkbox permissionChild">
                                       <label>
                                         <input type="checkbox" value="{{$itemChild->id}}" name="lisPerWebsite[]"
                                         class="child-id-{{$item->id}}"
                                         @if(in_array($itemChild->id,$arrayPerWebsite))
                                            checked
                                         @endif
                                         > {{$itemChild->title}}
                                       </label>
                                    </div>
                                    <?php
                                        $sql="select * from categories where parent_id=".$itemChild->id;
                                        $listPermissionChildTwo=DB::select($sql);
                                    ?>
                                    @foreach($listPermissionChildTwo as $itemChildTwo)
                                        <div class="checkbox permissionChild" style="margin-left: 80px">
                                       <label>
                                         <input type="checkbox" value="{{$itemChildTwo->id}}" name="lisPerWebsite[]"
                                         class="child-id-{{$item->id}}"
                                         @if(in_array($itemChildTwo->id,$arrayPerWebsite))
                                            checked
                                         @endif
                                         > {{$itemChildTwo->title}}
                                       </label>
                                    </div>
                                    @endforeach
                                    @endforeach
                                   @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7" id="showPerKhachHang" style="display: none">
                    <div class="panel">
                        <div class="panel-heading">
                             <div class="row" style="margin:0px">
                                <h3 class="panel-title pull-left">Danh sách quyền</h3>
                                <button class="btn btn-success pull-right"><i class="fa fa-plus"></i> Cập nhật </button>
                             </div>

                        </div>
                        <div class="panel-body p-none">
                            <div class="col-md-12">
                                   <?php
                                    $listPerContact=DB::select('select * from group_contact');
                                   ?>
                                   @foreach($listPerContact as $item)
                                    <div class="checkbox permission">
                                       <label>
                                         <input type="checkbox" value="{{$item->id}}" name="listPerContact[]"
                                          @if(in_array($item->id,$arrayPerContact))
                                            checked
                                         @endif
                                         > {{$item->name}}
                                       </label>
                                    </div>
                                    
                                   @endforeach
                                
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
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}
    
<script>
     $(document).ready(function() {
        $('#selectWebsite').selectpicker();
        @if($groupRoleWebsite)
            $('#selectWebsite').selectpicker('val',{{$groupRoleWebsite->type_perm}});
        @endif
        $('#selectKhachHang').selectpicker();
        @if($groupRoleKhachHang)
            $('#selectKhachHang').selectpicker('val',{{$groupRoleKhachHang->type_perm}});
        @endif

        $('.parentPer').click(function(){
            var parentId = $(this).data('parentid');
            if($(this).is(":checked")){
                $('.child-id-'+parentId).prop('checked',true);    
            }
            else {
             $('.child-id-'+parentId).prop('checked',false);       
            }
        });

        $('#tdWebsite').click(function(){
            $('#showPerKhachHang').hide();
            $('#showPerWebsite').show();
            return false;
        });

        $('#tdKhachHang').click(function(){
            $('#showPerWebsite').hide();
            $('#showPerKhachHang').show();
            return false;
        });

        $('#checkRoot').click(function(){
          if($(this).is(":checked")){
            $('#showPerWebsite input[type=checkbox]').prop('checked',true);
          }
          else{
            $('#showPerWebsite input[type=checkbox]').prop('checked',false); 
          }
          
        })

    });   
    </script>

@endsection
