@extends('client')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
    <style>
   .tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative
}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
}
.tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
}
.tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#fff;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color:#369;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}
   </style>
@endsection

<?php
$listNewPermissionOneParent=[];
$listParentMenu=[];
$listNewPermission=[];
?>

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">Website</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">
                 <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Danh sách danh mục</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <ul id="tree1" style="display: none">
                                    <?php
                                        $listNewPermission=[];
                                        $sql="SELECT DISTINCT(cate.parent_id)
                                                FROM group_role g,group_role_user r,group_role_perm p,categories cate
                                                WHERE 
                                                g.id=r.group_role_id 
                                                AND r.id=p.group_role_user_id 
                                                and p.group_role_perm_id=cate.id
                                                AND r.client_id='".$client_id."' AND g.name='website'
                                                AND r.full_permission=1
                                                order by parent_id asc";
                                        $checkParent=DB::selectOne($sql);
                                    ?>
                                    @if($checkParent)
                                    @foreach($categories as $category)
                                        <li>
                                            {{ $category->title }}
                                            @if(count($category->childs))
                                                @include('client.manageChild',['childs' => $category->childs])
                                            @endif
                                        </li>
                                    @endforeach
                                    @else
                                    <?php
                                        $sql="SELECT DISTINCT(cate.parent_id)
                                                FROM group_role g,group_role_user r,group_role_perm p,categories cate
                                                WHERE 
                                                g.id=r.group_role_id 
                                                AND r.id=p.group_role_user_id 
                                                and p.group_role_perm_id=cate.id
                                                AND r.client_id='".$client_id."' AND g.name='website'
                                                AND r.full_permission=0
                                                AND cate.parent_id>1
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
                                    @foreach($parentMenu as $item)
                                    <?php
                                    $listParentMenu[]=$item->parent_id;
                                    $sql="select * from categories where id='".$item->parent_id."'";
                                    $result=DB::selectOne($sql);
                                    ?>
                                    <li>
                                        {{$result->title}}
                                        <ul>
                                            @foreach($childMenu as $item1)
                                            @if($item1->parent_id==$item->parent_id)
                                            <?php
                                                $listNewPermission[]=$item1->id;
                                            ?>
                                                <li>
                                                    <a href="{{url('client/show-new-by-catetory/'.$item1->id)}}">{{ $item1->title }}</a> (<?php
                                                        $res = \DB::selectOne('select count(*) as total from news where is_delete=0 and cate_id='.$item1->id);
                                                        $count = $res->total;
                                                        echo $count;
                                                    ?>)
                                                </li>
                                            @endif
                                            @endforeach
                                            
                                        </ul>
                                    </li>
                                    @endforeach
                                    @foreach($childMenu as $item1)
                                     @if (!in_array($item1->id,$listParentMenu) && $item1->parent_id==1)
                                     <?php
                                        $listNewPermissionOneParent[]=$item1->id;
                                     ?>
                                        <li>
                                            <a href="{{url('client/show-new-by-catetory/'.$item1->id)}}">{{ $item1->title }}</a> (<?php
                                                        $res = \DB::selectOne('select count(*) as total from news where is_delete=0 and cate_id='.$item1->id);
                                                        $count = $res->total;
                                                        echo $count;
                                                    ?>)
                                        </li>
                                        @endif
                                     @endforeach
                                    @endif
                                     
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row" style="margin:0px">
                                <h3 class="panel-title pull-left">Dữ liệu gần đây</h3>
                                @if($typePermisson==1)
                                    @if(Auth::guard('client')->user()->id!=8 &&  Auth::guard('client')->user()->id!=9 && Auth::guard('client')->user()->id!=10 )
                                     <a href="{{url('client/showInsertNew')}}"><button class="btn btn-success pull-right"><i class="fa fa-plus"></i> Thêm </button></a>
                                    @endif
                                @endif
                            </div>

                        </div>
                        <div class="panel-body p-none">

                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">Hình ảnh</th>
                                    <th style="width: 20%;">Tên</th>
                                    <th style="width: 15%;">Danh mục</th>
                                    <th style="width: 15%;">Ngày tạo</th>
                                    <th style="width: 10%;">Duyệt bài</th>
                                    <th style="width: 10%;">Trạng thái</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(!$checkParent){
                                        $listNewPermission=array_unique(array_merge($listNewPermission,$listNewPermissionOneParent));
                                        $news=\App\Models\News::whereIn('cate_id',$listNewPermission)->where('is_delete',0)->orderBy('id', 'DESC')->get();
                                    }
                                ?>
                                @foreach($news as $item)
                                    <tr>
                                        <!-- <td>{{ $loop->iteration }}</td> -->
                                        <td>
                                            @if(!empty($item->img)) 
                                                <img src="{{URL::asset('assets/img/'.$item->img)}}" width="80">
                                            @endif
                                        </td>
                                        <td>{{$item->title}}</td>
                                        <td>
                                            <?php
                                                $cate=DB::selectOne('select * from categories c where c.id='.$item->cate_id);
                                                echo $cate->title;
                                            ?>
                                        </td>
                                        <td><p>{{date('d-m-Y',strtotime($item->created_date))}}</p></td>
                                        <td>
                                            {{($item->is_approval==1)?'Đã duyệt':'Chưa duyệt'}}
                                        </td>
                                        <td>
                                            {{($item->is_active==1)?'Active':'DeActive'}}
                                        </td>
                                        <td>
                                            @if($typePermisson==1)
                                                @if(Auth::guard('client')->user()->id!=8 &&  Auth::guard('client')->user()->id!=9 && Auth::guard('client')->user()->id!=10 )
                                                <a class="btn btn-success btn-xs" href="{{url('client/edit-new/'.$item->id)}}"><i class="fa fa-edit"></i> Sửa</a>
                                                <a href="#" class="btn btn-danger btn-xs cdelete" id="{{$item->id}}"><i class="fa fa-trash"></i> Xoá</a>
                                                @else
                                                    @if(
                                                    (Auth::guard('client')->user()->id==8 || Auth::guard('client')->user()->id==9 || Auth::guard('client')->user()->id==10 ) && Auth::guard('client')->user()->is_approval_new==1)
                                                        <a class="btn btn-success btn-xs" href="{{url('client/edit-new/'.$item->id)}}"><i class="fa fa-edit"></i> Duyệt</a>
                                                    @endif
                                                @endif
                                            @else
                                                 <a class="btn btn-success btn-xs" href="{{url('client/xem-new/'.$item->id)}}"><i class="fa fa-edit"></i> Xem</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
$.fn.extend({
    treed: function (o) {
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        /*tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });*/
    }
});
//Initialization of treeviews
$(function(){
    $('#tree1').treed();
    $('#tree1').show().find('.indicator').eq(0).trigger('click');
    $('.glyphicon-plus-sign').trigger('click');
});

</script>
    <script>
        $(document).ready(function(){
           // $('.data-table').DataTable();
           var table = $('.data-table').DataTable( {
                                        rowId: '',
                                        "bDestroy": true,
                                        ordering: false,
                                        "searching": true,
                                        //"bAutoWidth": false,
                                        //"autoWidth": true,
                                        //"scrollX": true,
                                        "scrollX": false,
                                        "bAutoWidth": false,
                                        "oLanguage": {
                                            "sLengthMenu": "Hiện _MENU_ Dòng",
                                            "sSearch": "",
                                            "sEmptyTable": "Không có dữ liệu",
                                            "sProcessing": "Đang xử lý...",
                                            "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                                            "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                                            "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                                            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                                            "sInfoPostFix": "",
                                            "sUrl": ""
                                        }
                                      });
            $('.createdDate').datetimepicker({
                keepOpen: false,
                format: 'DD-MM-YYYY'
            });
        });
    </script>
<script>
    $( "body" ).delegate( ".cdelete", "click",function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/client/delete-new/" + id;
                    }
                });
            });
</script>
@endsection
