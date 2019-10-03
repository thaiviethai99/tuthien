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
                     <li><a href="{{url('quan-he-co-dong')}}">Quan hệ cổ đông</a><i class="fa fa-angle-right"></i></li>
                    <li class="current">Tin tức cổ đông
</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
          <div class="list-items-wrap">
             <h1 style="margin-left: 20px;color: #113067;font-size:28px;padding-top: 16px">Tin tức cổ đông</h1>
             @foreach($news as $item)
          <div class="list-item-dem" style="margin-left:20px">
              <div class="row">
                
                <div class="col-md-10">
                  <div class="list-item-dem-header">
                    <a href="{{url('quan-he-co-dong/tin-tuc-co-dong-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
              
                {{$item->title}}
              </a>
                  </div>
                  <div class="article-item-list-date">{{date('d-m-Y',strtotime($item->created_date))}}</div>
                  <div class="list-item-dem-description">
                    {!! html_entity_decode($item->summary) !!}
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
                           <a href="{{url('quan-he-co-dong/bao-cao-thuong-nien')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Báo cáo thường niên</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('quan-he-co-dong/tin-tuc-co-dong')}}">
                              <div class="article-list-item-content article-select">
                                 <div class="article-list-name">Tin tức cổ đông</div>
                              </div>
                           </a>
                        </div>
						@foreach($qhcd as $item)
                        <div id="article-item2" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('quan-he-co-dong/dai-hoi-co-dong-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">{{$item->title}}</div>
                              </div>
                           </a>
                        </div>
						@endforeach
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('quan-he-co-dong/co-dong-chien-luoc/co-dong-chien-luoc')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Cổ đông chiến lược</div>
                              </div>
                           </a>
                        </div>
						<div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('quan-he-co-dong/dieu-le/dieu-le-spt-2008')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Điều lệ</div>
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