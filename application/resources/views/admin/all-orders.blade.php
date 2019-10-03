@extends('admin')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">Danh sách hóa đơn</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Danh sách hóa đơn</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 15%;">Tên khách hàng</th>
                                    <th style="width: 10%;">Tiền nợ</th>
                                    <th style="width: 10%;">Ngày tạo</th>
                                    <th style="width: 10%;">Trạng thái</th>
                                    <th style="width: 30%;">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $in)
								<?php
									$client = App\Client::find($in->cl_id);
								?>
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$client->fname}} {{$client->lname}}</td>
										<td>{{number_format($in->tien_no,0,0,".")}}</td>
                                        <td>{{$in->created_at}}</td>
                                        <td>

                                            @if($in->status_id==0)
                                                <span class="label label-warning">Chưa thanh toán</span>
                                            @elseif($in->status_id==1)
                                                <span class="label label-success">Đang chờ admin duyệt</span>
											@elseif($in->status_id==2)
                                                <span class="label label-warning">Amdin đã duyệt</span>
											@elseif($in->status_id==3)
                                                <span class="label label-warning">Amdin hủy</span>	
                                            @endif
                                        </td>
                                        
                                        <td>
                                            
                                            <a href="{{url('orders/view/'.$in->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> {{language_data('View')}}</a>
                                            <!--<a href="{{url('invoices/edit/'.$in->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> {{language_data('Edit')}}</a>-->
                                            <a href="#" class="btn btn-danger btn-xs cdelete" id="{{$in->id}}"><i class="fa fa-trash"></i> {{language_data('Delete')}}</a>
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
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function(){
            $('.data-table').DataTable();


            /*For Delete Invoice*/
            $( "body" ).delegate( ".cdelete", "click",function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Bạn có chắc muốn xóa đơn hàng này không ?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/orders/delete-order/" + id;
                    }
                });
            });
            /*For Delete Designation*/
            $(".stop-recurring").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/invoices/stop-recurring-invoice/" + id;
                    }
                });
            });

        });
    </script>
@endsection