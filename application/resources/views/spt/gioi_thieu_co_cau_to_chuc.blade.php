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
                     <li><a href="{{url('/gioi-thieu')}}">Giới thiệu</a><i class="fa fa-angle-right"></i></li>
                    <li class="current">Cơ cấu tổ chức</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                 <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
                        <div class="article-left"><div class="article-item-name"><h1>Cơ cấu tổ chức</h1></div><div class="article-item-content">
                            {!! html_entity_decode($new->content) !!}
</div></div>
        </div>
                </div><!--//faq-wrapper-->
                <aside class="page-sidebar  col-md-3" style="padding-left:0px">
					
                      <div id="article-item0" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('gioi-thieu/tong-quan')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Tổng quan</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('gioi-thieu/lich-su-phat-trien')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Lịch sử phát triển</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item2" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('gioi-thieu/co-cau-to-chuc')}}">
                              <div class="article-list-item-content article-select">
                                 <div class="article-list-name">Cơ cấu tổ chức</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item3" class="article-list-item mone col-sm-4">
                           <a href="{{url('gioi-thieu/giai-thuong')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Giải thưởng</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('gioi-thieu/thuong-hieu')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Thương hiệu</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item5" class="article-list-item mone col-sm-4">
                           <a href="{{url('gioi-thieu/ebrochure')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">eBrochure</div>
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