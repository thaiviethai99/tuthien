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
  /*white-space: nowrap;*/
}
.table tbody tr td {
    font-size:12px;
}


   </style>
@endsection


@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Hỗ trợ kĩ thuật',{{$count1}}],
          ['Tuyển dụng',{{$count2}}],
          ['Quản trị web',{{$count3}}],
          ['Khách hàng',{{$count4}}],
          ['Cổ đông',{{$count5}}],
          ['Hợp tác đầu tư',{{$count6}}]
        ]);

        // Set chart options
        var options = {'title':'',
                       //'width':400,
                       //'height':300,
                       chartArea:{left:0,top:0,width:"80%",height:"70%"}
                   };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <style type="text/css">
    #modulegrouptree {
    float: left;
    display: inline;
    width: 300px;
    height: auto;
    margin-top: 15px;
}
        #chart_div {
    float: left;
    display: inline;
    width: 470px;
    height: auto;
    margin-top: 15px;
    z-index: inherit;
}
    </style>
    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">
               Khách hàng
            </h2>
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
                            <div class="col-md-12" id="modulegrouptree">
                                <ul style="list-style: none;">
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
                                    <li>
                                        <a href="{{url('client/show-contact-by-catetory/'.$item->id)}}">{{$item->name}}</a>
                                        <span>(
                                        <?php
                                            $sql="select count(*) as total from contact where is_delete=0 and group_contact_id='".$item->id."'";
                                            $result = DB::selectOne($sql);
                                            echo $result->total;
                                        ?>
                                        )
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div id="chart_div"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                             <div class="row" style="margin:0px"><h3 class="panel-title pull-left">Liên hệ</h3>
                            @if($typePermisson==1)
                             <a href="{{url('client/showInsertContact/'.Request::route('cateIdSub'))}}"><button class="btn btn-success pull-right"><i class="fa fa-plus"></i> Thêm </button></a>
                            @endif
                         </div>

                        </div>
                        <div class="panel-body p-none">

                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <!-- <th>{{language_data('SL')}}#</th> -->
                                    <th style="width: 15%;">Tên</th>
                                    <th style="width: 15%;">Nhóm</th>
                                    <th style="width: 10%;">Điện thoại</th>
									<th style="width: 10%;" >Trạng thái</th>
                                    <th style="width: 20%;" >Tiêu đề</th>
									<th style="width: 10%;">Ngày tạo</th>
									<th style="width: 20%;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $contacts=\App\Models\Contact::whereIn('group_contact_id',$listIdCate)->where('is_delete',0)->orderBy('id', 'DESC')->get();
                                ?>
                                @foreach($contacts as $item)
                                    <tr>
                                        <!-- <td>{{ $loop->iteration }}</td> -->
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <?php
                                                $sql="select * from group_contact where id='".$item->group_contact_id."'";
                                                $group= DB::selectOne($sql);
                                                echo $group->name;
                                            ?>
                                        </td>
                                        <td>{{$item->mobile}}</td>
                                        <td>@if($item->status_contact==0)
                                                Chưa xử lý
                                            @else
                                                Đã phản hồi
                                            @endif
                                        </td>
                                        <td>{{$item->subject}}</td>
                                        <td>{{date('d-m-Y',strtotime($item->created_date))}}</td>
                                        <td>
                                            @if($typePermisson==1)
                                                <a class="btn btn-success btn-xs" href="{{url('client/get-reply-contact/'.$item->id)}}"><i class="fa fa-edit"></i> Trả lời</a>
                                                <a href="#" class="btn btn-danger btn-xs cdelete" id="{{$item->id}}"><i class="fa fa-trash"></i> Xoá</a>
                                            @else
                                                <a class="btn btn-success btn-xs" href="{{url('client/get-reply-contact/'.$item->id)}}"><i class="fa fa-edit"></i>Xem</a>
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
    <script type="text/javascript">
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
                                        
                                        

</script>
    <script>
        $(document).ready(function(){
            //$('.data-table').DataTable();
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
                        window.location.href = _url + "/client/delete-contact/" + id;
                    }
                });
            });
</script>
@endsection
