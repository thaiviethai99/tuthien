@extends('client_menu_en')

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
                    <li><a href="{{url('/')}}">Home</a><i class="fa fa-angle-right"></i></li>
                     <li><a href="{{url('about-us')}}">About Us</a></li>
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
                             <a href="{{url('about-us/overview')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Overview</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('about-us/key-milestones')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Key Milestones</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item2" class="article-list-item1 mtwo">
                             <a href="{{url('about-us/corporate-structure')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Corporate Structure</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item3" class="article-list-item1 mone">
                             <a href="{{url('about-us/achievements-awards')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Achievements & Awards</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item4" class="article-list-item1 mtwo">
                             <a href="{{url('about-us/the-brand')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">The Brand</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item5" class="article-list-item1 mone">
                             <a href="{{url('about-us/ebrochure')}}">
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
    <script type="text/javascript">$(window).load(function() {$('#page-banner-group-item').nivoSlider({effect:'fade',pauseTime: 5000});});</script>
@endsection