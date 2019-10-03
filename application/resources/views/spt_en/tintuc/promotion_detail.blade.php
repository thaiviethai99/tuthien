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
                    <li><a href="{{url('news-events')}}">News & Events</a><i class="fa fa-angle-right"></i></li>
                    <li><a href="{{url('news-events/news')}}">News</a><i class="fa fa-angle-right"></i></li>
                    <li><a href="#">{{$new->title_en}}</a></li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
                        <div class="article-left">
                            <div class="article-item-name"><h1>{{$new->title_en}}</h1></div>
              <div class="article-item-content">
                {!! html_entity_decode($new->content_en) !!}
              </div>
</div>
        </div>
                </div><!--//faq-wrapper-->
                <aside class="page-sidebar  col-md-3" style="padding-left:0px">
                        <div id="article-item0" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('news-events/news')}}">
                              <div class="article-list-item-content article-select">
                                 <div class="article-list-name">News</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('news-events/the-media')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">The Media</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item2" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('news-events/investment-cooperation')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Investment Cooperation</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item3" class="article-list-item mone col-sm-4">
                           <a href="{{url('news-events/bidding')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Bidding</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item4" class="article-list-item mtwo col-sm-4">
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
@endsection