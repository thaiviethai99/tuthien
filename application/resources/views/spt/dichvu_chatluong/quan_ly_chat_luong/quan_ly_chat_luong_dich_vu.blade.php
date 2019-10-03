@extends('client_menu')

{{--External Style Section--}}
@section('style')
@endsection


@section('content')
    <div class="content container">
    <div class="page-wrapper">
        <div class="row">
        <header class="page-heading clearfix">
            <div class="breadcrumbs pull-left">
                <ul class="breadcrumbs-list">
                    <li><a href="{{url('/')}}">Trang chủ</a><i class="fa fa-angle-right"></i></li>
                    <li><a href="{{url('dich-vu-chat-luong')}}">Dịch vụ & Chất lượng</a><i class="fa fa-angle-right"></i></li>
                    <li class="current">Quản lý chất lượng dịch vụ</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-6 col-sm-6">
                    <div class="main-content">
                        <div class="slider-wrapper theme-default">
                  <div id="page-banner-group-item" class="nivoSlider">
                    <img src="{{URL::asset('assets/img/gioi-thieu_menu.jpg')}}">
                     <img src="{{URL::asset('assets/img/vetinh.jpg')}}">
                    </div>
               </div>
               
                    </div>
                </div><!--//faq-wrapper-->
                <aside class="page-sidebar col-md-6 col-sm-6">
                          <div id="article-item0" class="article-list-item1 mtwo">
                             <a href="{{url('/dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/cac-dich-vu-ma-doanh-nghiep-dang-cung-cap')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Các dịch vụ mà doanh nghiệp đang cung cấp</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item5" class="article-list-item1 mone">
                             <a href="{{url('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/cac-quy-chuan-ki-thuat-tieu-chuan-ap-dung-cho-tung-dich-vu')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Các quy chuẩn kỹ thuật,tiêu chuẩn áp dụng cho từng dịch vụ</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item5" class="article-list-item1 mone">
                             <a href="{{url('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/ban-cong-bo-chat-luong-cac-dich-vu-vien-thong')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Bản công bố chất lượng các dịch vụ viễn thông</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item4" class="article-list-item1 mtwo">
                             <a href="{{url('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/bao-cao-dinh-ky-chat-luong-dich-vu-vien-thong')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Báo cáo định kỳ chất lượng dịch vụ viễn thông</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item0" class="article-list-item1 mtwo">
                             <a href="{{url('/dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/cac-ban-ket-qua-tu-kiem-tra-dinh-ky-chat-luong-dich-vu-vien-thong-va-ket-qua-tu-do-kiem-chi-tieu-chat-luong-cho-tung-dich-vu')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Các bản kết quả tự kiểm tra định kỳ chất lượng dịch vụ viễn thông và kết quả tự đo kiểm chỉ tiêu chất lượng cho từng dịch vụ</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                           <div id="article-item3" class="article-list-item1 mone">
                             <a href="{{url('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/dia-chi-so-dien-thoai-tiep-nhan-va-giai-quyet-khieu-nai-cua-khach-hang')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Địa chỉ, số điện thoại tiếp nhận và giải quyết khiếu nại của khách hàng</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item2" class="article-list-item1 mtwo">
                             <a href="{{url('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/quy-trinh-tiep-nhan-va-giai-quyet-khieu-nai-cua-khach-hang')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Quy trình tiếp nhận và giải quyết khiếu nại của khách hàng</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/cac-thong-tin-ho-tro-khach-hang')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Các thông tin hỗ trợ khách hàng</div>
                                </div>
                             </a>
                          </div>
						  <div class="article-list-space"></div>
						  <div id="article-item5" class="article-list-item1 mone">
                             <a href="{{url('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/bieu-mau-cung-cap-thong-tin-dich-vu')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Biểu mẫu cung cấp thông tin dịch vụ</div>
                                </div>
                             </a>
                          </div>
              <div id="article-item5" class="article-list-item1 mone">
                             <a href="{{url('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/hop-dong-mau-cung-cap-dich-vu')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Hợp đồng mẫu cung cấp dịch vụ</div>
                                </div>
                             </a>
                          </div>
                </aside>
                @include('sub.new_run')
            </div><!--//page-row-->
        </div><!--//page-content-->
    </div><!--//page-->
</div><!--//content-->


    </div><!--//wrapper-->



@endsection

{{--External Style Section--}}
@section('script')
    <script type="text/javascript">$(window).load(function() {$('#page-banner-group-item').nivoSlider({effect:'fade',pauseTime: 5000});});</script>
@endsection