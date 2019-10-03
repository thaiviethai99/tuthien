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
                     <li><a href="{{url('investor-relation')}}">Investor Relation</a><i class="fa fa-angle-right"></i></li>
                    <li class="current">Annual Reports
</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content @if(count($news)==0 || count($news)==1  || count($news)==2) nocontent @endif">
          <div class="list-items-wrap">
             <h1 style="margin-left: 20px;color: #113067;font-size:28px;padding-top: 16px">Annual Reports</h1>
             @foreach($news as $item)
          <div class="list-item-dem" style="margin-left:20px">
              <div class="row">
                
                <div class="col-md-10">
                  <div class="list-item-dem-header">
                    <a href="{{url('investor-relation/annual-reports-detail/'.$item->id.'/'.vn_to_str($item->title_en))}}">  
              
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
                           <a href="{{url('investor-relation/annual-reports')}}">
                              <div class="article-list-item-content article-select">
                                 <div class="article-list-name">Annual Reports</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('investor-relation/corporate-announcements')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Corporate Announcements</div>
                              </div>
                           </a>
                        </div>
						@foreach($qhcd as $item)
            <?php 
                                    $title=$item->title;
                                    $year=explode(' ',$title);
                                    $year=array_reverse($year);
                                    $year=$year[0];
                                    ?>
                        <div id="article-item2" class="article-list-item mtwo col-sm-4">
                          <a href="{{url('investor-relation/annual-general-meeting-detail/'.$item->id.'/annual-general-meeting-'.$year)}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Annual General Meeting 
                                    {{$year}}</div>
                              </div>
                           </a>
                        </div>
						@endforeach
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('investor-relation/strategic-shareholders/strategic-shareholders')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Strategic Shareholders</div>
                              </div>
                           </a>
                        </div>
						<div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('investor-relation/charter')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Charter</div>
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