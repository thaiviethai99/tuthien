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
                    <li class="current">Dịch vụ Dữ liệu</li>
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
                             <a href="{{url('dich-vu-chat-luong/dich-vu-du-lieu/truy-nhap-internet-xdsl')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Truy nhập Internet xDSL</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('dich-vu-chat-luong/dich-vu-du-lieu/truy-nhap-internet-cap-quang-ftth/')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Truy nhập Internet cáp quang (FTTH)</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item2" class="article-list-item1 mtwo">
                             <a href="{{url('/dich-vu-chat-luong/dich-vu-du-lieu/truyen-hinh-internet-iptv')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Truyền hình Internet (IPTV)</div>
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