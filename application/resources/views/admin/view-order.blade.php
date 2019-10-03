@extends('admin')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('View Invoice')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')

            <div class="panel">
                <div class="panel-body p-none">
                    <div class="p-20">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6 p-t-20">
                                    <div class="m-b-5">
                                        <img src="<?php echo asset(app_config('AppLogo')); ?>" alt="Logo">
                                    </div>
                                    <address>
                                        {!!app_config('Address')!!}
                                    </address>

                                    <div class="m-t-20">
                                        <h3 class="panel-title">{{language_data('Invoice To')}}: </h3>
                                        <h3 class="invoice-to-client-name">{{$client->fname}}</h3>
                                    </div>

                                    <address>
                                        {{$client->address1}} <br>
                                        {{$client->address2}} <br>
                                        {{$client->state}}, {{$client->city}} - {{$client->postcode}},  {{$client->country}}
                                        <br><br>
                                        {{language_data('Phone')}}: {{$client->phone}}
                                        <br>
                                        {{language_data('Email')}}: {{$client->email}}
                                    </address>

                                </div>

                                <div class="col-lg-6 p-t-20">


                                    <div class="btn-group pull-right" aria-label="...">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn  btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{language_data('Mark As')}} <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                                @if($order->status_id!=0)
                                                    <li><a href="#" id="mark_paid" data-value="{{$order->id}}">Chưa thanh toán</a></li>
                                                @endif
                                                @if($order->status_id!=1)
                                                    <li><a href="#" id="mark_unpaid" data-value="{{$order->id}}">Đang chờ admin duyệt</a></li>
                                                @endif
                                                @if($order->status_id!=2)
                                                    <li><a href="#" id="mark_partially_paid" data-value="{{$order->id}}">Admin duyệt</a></li>
                                                @endif
                                                @if($order->status_id!=3)
                                                    <li><a href="#" id="mark_cancelled" data-value="{{$order->id}}">Admin hủy</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                        <a href="{{url('order/client-iview/'.$order->id)}}" target="_blank" class="btn btn-danger  btn-sm"><i class="fa fa-paper-plane-o"></i> {{language_data('Preview')}}</a>
                                        <a href="{{url('order/edit/'.$order->id)}}" class="btn btn-warning  btn-sm"><i class="fa fa-pencil"></i> {{language_data('Edit')}}</a>
                                        <a href="#" data-toggle="modal" data-target="#send-email-invoice" class="btn btn-complete  btn-sm send-email"><i class="fa fa-envelope"></i> {{language_data('Send')}} {{language_data('Email')}}</a>
                                        <a href="{{url('order/download-pdf/'.$order->id)}}" class="btn btn-pdf  btn-sm download-pdf"><i class="fa fa-file-pdf-o"></i> {{language_data('PDF')}}</a>
                                        <a href="{{url('order/iprint/'.$order->id)}}" target="_blank" class="btn btn-primary  btn-sm"><i class="fa fa-print"></i> {{language_data('Print')}}</a>
                                        <br>
                                        <br>

                                        <div class="modal fade" id="send-email-invoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">{{language_data('Send Invoice')}}</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form class="form-some-up" role="form" action="{{url('invoices/send-invoice-email')}}" method="post">

                                                            <div class="form-group">
                                                                <label>{{language_data('Subject')}}</label>
                                                                <input type="text" class="form-control" name="subject" required="">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{{language_data('Message')}}</label>
                                                                <textarea class="form-control" rows="5" name="message"></textarea>
                                                            </div>

                                                            <div class="text-right">
                                                                <input type="hidden" value="{{$order->id}}" name="cmd">
                                                                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">{{language_data('Close')}}</button>
                                                                <button type="submit" class="btn btn-success btn-sm">{{language_data('Send')}}</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="m-t-20">
                                            <div class="bill-data">
                                                <p class="m-b-5">
                                                    <span class="bill-data-title">{{language_data('Invoice No')}}:</span>
                                                    <span class="bill-data-value">#{{$order->id}}</span>
                                                </p>
                                                <p class="m-b-5">
                                                    <span class="bill-data-title">{{language_data('Invoice Status')}}:</span>
                                                    @if($order->status_id==0)
                                                        <span class="bill-data-value"><span class="bill-data-status label-warning">Chưa thanh toán</span></span>
                                                    @elseif($order->status_id==1)
                                                        <span class="bill-data-value"><span class="bill-data-status label-success">Đang chờ admin duyệt</span></span>
                                                    @elseif($order->status_id==2)
                                                        <span class="bill-data-value"><span class="bill-data-status label-info">Admin đã duyệt</span></span>
                                                    @else
                                                        <span class="bill-data-value"><span class="bill-data-status label-danger">Admin hủy</span></span>
                                                    @endif
                                                </p>
                                                <p class="m-b-5">
                                                    <span class="bill-data-title">{{language_data('Invoice Date')}}:</span>
                                                    <span class="bill-data-value">{{get_date_format($order->created_at)}}</span>
                                                </p>
                                                
                                                @if($order->status_id=='Paid')
                                                    <p class="m-b-5">
                                                        <span class="bill-data-title">{{language_data('Paid Date')}}:</span>
                                                        <span class="bill-data-value">{{get_date_format($order->datepaid)}}</span>
                                                    </p>
                                                @endif

                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>

                            <div class="col-lg-12">
                                <table class="table invoice-items invoice-view">
                                    <thead>
                                    <tr class="h5 text-dark">
                                        <th id="cell-item" class="text-semibold" style="width: 65%;">Mã thanh toán</th>
                                        <th id="cell-price" class="text-center text-semibold" style="width: 10%;">Giá tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-semibold text-dark" style="width: 65%;">{{$order->ma_tt}}</td>
                                            <td class="text-center" style="width: 10%;">{{number_format($order->tien_no,0,0,".")}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                           

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
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function(){
            /*For Invoice mark paid*/
            $("#mark_paid").click(function (e) {
                e.preventDefault();
                var id = $(this).data('value');

                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/invoices/mark-paid/" + id;
                    }
                });
            });

            /*For Invoice mark as unpaid*/
            $("#mark_unpaid").click(function (e) {
                e.preventDefault();
                var id = $(this).data('value');

                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/invoices/mark-unpaid/" + id;
                    }
                });
            });

            /*For Invoice mark as partially paid*/
            $("#mark_partially_paid").click(function (e) {
                e.preventDefault();
                var id = $(this).data('value');

                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/invoices/mark-partially-paid/" + id;
                    }
                });
            });

            /*For Invoice mark as cancelled*/
            $("#mark_cancelled").click(function (e) {
                e.preventDefault();
                var id = $(this).data('value');

                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/invoices/mark-cancelled/" + id;
                    }
                });
            });


        });
    </script>


@endsection