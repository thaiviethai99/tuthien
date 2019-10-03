@extends('client')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection

<style type="text/css">
.modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>
@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">Quản lý danh sách chưa thanh toán</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tìm kiếm</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="get" action="{{url('user/notpays/all')}}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-xs-2">Mã thanh toán</label>
                                    <div class="col-xs-6">
                                    <input type="text" class="form-control search-input" placeholder="Nhập mã thanh toán" value="<?php echo isset($_GET['ma_tt'])?$_GET['ma_tt']:''?>" name="ma_tt" id="ma_tt">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-2">Ngày cập nhật</label>
                                    <div class="col-xs-6">
                                    <input type="text" class="form-control search-input" placeholder="Nhập ngày cập nhật" value="<?php echo isset($_GET['createdDate'])?$_GET['createdDate']:''?>" name="createdDate" id="createdDate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-2">Tiền nợ</label>
                                    <div class="col-xs-6">
                                    <input type="text" class="form-control search-input" placeholder="Nhập tiền nợ" value="<?php echo isset($_GET['money'])?$_GET['money']:''?>" name="money" id="money">
                                    </div>
                                </div>
                                 <div class="col-xs-offset-2 col-xs-10">   
                                 <button type="submit" style="margin-right: 10px;" class="btn btn-success"><i class="fa fa-plus"></i> {{language_data('Find')}} </button>
                                <a href="{{url('user/pays/all')}}"><button type="button" class="btn btn-danger"><i class="fa fa-plus"></i> Reset </button></a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Danh sách chưa thanh toán</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 15%;">Mã thanh toán</th>
                                    <th style="width: 20%;">Tên thanh toán</th>
                                    <th style="width: 20%;">Địa chỉ thanh toán</th>
                                    <th style="width: 15%;">Tiền nợ (VNĐ)</th>
                                    <th style="width: 15%;">Ngày cập nhật </th>
									<th style="width: 10%;">Hành động </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($arrThanhToan as $item)
                                <?php //if($item['tienNo']>0){?>
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item['ma_tt']}}</td>
                                        <td>{{$item['ten_tt']}}</td>
                                        <td>{{$item['diachi_tt']}}</td>
                                        <td>{{number_format($item['tienNo'],0,0,".")}}</td>
                                        <td>
                                            {{$item['ngay_cn']}}
                                        </td>
										<td>
                                            <?php
                                                if($item['isShowPaidButton']==1){
                                            ?>
											<button class="btn btn-success center-block" data-toggle="modal" data-target="#purchase_now" data-link="{{$item['linkPayoo']}}" data-matt="{{$item['ma_tt']}}"
                                            data-tentt="{{$item['ten_tt']}}"
                                            data-diachitt="{{$item['diachi_tt']}}"
                                            data-tienno="{{$item['tienNo']}}"><i class="fa fa-shopping-cart"></i>Thanh toán</button>
                                            <?php }?>
										</td>
                                    </tr>
                                    <?php //}?>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal fade" id="purchase_now" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Thanh toán</h4>
                        </div>
                        <div class="modal-body">

                            <!-- <form class="form-some-up" role="form" action="{{url('user/sms/post-purchase-sms-plan')}}" method="post">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Chọn phương thức thanh toán</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline control-label">
                                            <input checked="checked" id="" name="choosePaid" type="radio" value="2"> Chuyển khoản ngân hàng
                                        </label>
                                        <label class="radio-inline control-label">
                                            <input id="" name="choosePaid" type="radio" value="1"> 
                                            Payoo
                                        </label>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <input type="hidden" value="" name="cmd">
                                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">{{language_data('Close')}}</button>
                                    <button type="submit" class="btn btn-success btn-sm">{{language_data('Purchase Now')}}</button>
                                </div>
                            </form> -->
                            <form class="form-some-up" role="form" action="{{url('user/order/post-purchase-order-client')}}" method="post">

                                <div class="form-group">
                                    <label>Chọn phương thức thanh toán</label>
                                   <select class="selectpicker form-control" name="gateway">
                                        @foreach($payment_gateways as $pg)
                                            <option value="{{$pg->settings}}">{{$pg->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-right">
                                    <input type="hidden" value="" name="payooLink" id="payooLink">
                                    <input type="hidden" value="" name="matt" id="matt">
                                    <input type="hidden" value="" name="tentt" id="tentt">
                                    <input type="hidden" value="" name="diachitt" id="diachitt">
                                    <input type="hidden" value="" name="tienno" id="tienno">
                                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-success btn-sm">Thanh toán</button>
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
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}

    <script>
        $(document).ready(function(){
            $('.data-table').DataTable();
        });
        $('#purchase_now').on('show.bs.modal', function(e) {
                $('#payooLink').val($(e.relatedTarget).data('link'));
                $('#matt').val($(e.relatedTarget).data('matt'));
                $('#tienno').val($(e.relatedTarget).data('tienno'));
                $('#statusid').val($(e.relatedTarget).data('statusid'));
                $('#tentt').val($(e.relatedTarget).data('tentt'));
                $('#diachitt').val($(e.relatedTarget).data('diachitt'));
            });
    </script>
@endsection