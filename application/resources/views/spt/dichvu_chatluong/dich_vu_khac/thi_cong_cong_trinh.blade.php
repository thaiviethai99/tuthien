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
                     <li><a href="{{url('dich-vu-chat-luong')}}">Dịch vụ và Chất lượng</a><i class="fa fa-angle-right"></i></li>
                     <li><a href="{{url('dich-vu-chat-luong/dich-vu-khac')}}">Dịch vụ khác</a><i class="fa fa-angle-right"></i></li>
                    <li class="">Thi công công trình và kinh doanh thiết bị viễn thông
</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
                    <div class="article-left"><div class="article-item-name"><h1>Thi công công trình và kinh doanh thiết bị viễn thông
</h1></div>
					<div class="article-item-content">
					{!! html_entity_decode($new->content) !!}
					</div>
</div>
        </div>
                </div><!--//faq-wrapper-->
                <aside class="page-sidebar col-sm-12 col-md-3" style="padding-left:0px">
                        <div id="article-item0" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('dich-vu-chat-luong/dich-vu-khac/thi-cong-cong-trinh-va-kinh-doanh-thiet-bi-vien-thong')}}">
                              <div class="article-list-item-content article-select">
                                 <div class="article-list-name">Thi công công trình và kinh doanh thiết bị viễn thông
</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('dich-vu-chat-luong/dich-vu-khac/dich-vu-thong-tin')}}">
                              <div class="article-list-item-content ">
                                 <div class="article-list-name">Dịch vụ thông tin</div>
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
@endsection