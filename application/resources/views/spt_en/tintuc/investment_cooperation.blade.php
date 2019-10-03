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
                    <li class="current">Investment Cooperation</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content @if(count($news)==0 || count($news)==1  || count($news)==2) nocontent @endif">
          <div class="list-items-wrap">
             <h1 style="margin-left: 20px;color: #113067;font-size:28px;padding-top: 16px">Investment Cooperation</h1>
             @foreach($news as $item)
          <div class="list-item-dem">
              <div class="row">
                <div class="col-md-2 col-xs-3">  
                  <a href="{{url('news-events/investment-cooperation-detail/'.$item->id.'/'.vn_to_str($item->title_en))}}" class="thumbnail">
                    <img src="{{URL::asset('assets/img/'.$item->img)}}" class="img-responsive" >
                </a>
                </div>
                 <div class="col-md-10 col-xs-9" style="padding-left:0px">
                  <div class="list-item-dem-header">
                    <a href="{{url('news-events/investment-cooperation-detail/'.$item->id.'/'.vn_to_str($item->title_en))}}">  
              
                {{$item->title_en}}
              </a>
                  </div>
                  <div class="article-item-list-date">{{date('d-m-Y',strtotime($item->created_date))}}</div>
                  <div class="list-item-dem-description">
                    {!! html_entity_decode($item->summary_en) !!}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        <nav>
            {!! $news->render() !!}
        </nav>  
          </div>
        </div>
                </div><!--//faq-wrapper-->
                <aside class="page-sidebar col-md-3" style="padding-left:0px;margin-top: 20px;">
                        <div id="article-item0" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('news-events/news')}}">
                              <div class="article-list-item-content ">
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
                              <div class="article-list-item-content article-select">
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