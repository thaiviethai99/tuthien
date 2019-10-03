@extends('client_menu_en')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')
    <div class="content container">
    <div class="page-wrapper">
        <div class="row">
        <header class="page-heading clearfix">
            <div class="breadcrumbs pull-left">
                <ul class="breadcrumbs-list">
                    <li><a href="{{url('/')}}">Home</a><i class="fa fa-angle-right"></i></li>
                     <li><a href="{{url('tin-tuc')}}">News & Events</a></li>
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
                             <a href="{{url('news-events/news')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">News</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('news-events/the-media')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">The Media</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item2" class="article-list-item1 mtwo">
                             <a href="{{url('news-events/investment-cooperation')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Investment Cooperation</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item3" class="article-list-item1 mone">
                             <a href="{{url('news-events/bidding')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Bidding</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item4" class="article-list-item1 mtwo">
                             <a href="{{url('news-events/spt-news')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">SPT News</div>
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