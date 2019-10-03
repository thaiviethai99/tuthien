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
                    <li class="current">Investor Relation</li>
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
                             <a href="{{url('investor-relation/annual-reports')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Annual Reports</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('investor-relation/corporate-announcements')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Corporate Announcements</div>
                                </div>
                             </a>
                          </div>
                          <?php 
                          $i=0;
                          $u=0;
                          ?>
                          @foreach($qhcd as $item)
                          <?php 
                                    $title=$item->title;
                                    $year=explode(' ',$title);
                                    $year=array_reverse($year);
                                    $year=$year[0];
                                    ?>
                            <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('investor-relation/annual-general-meeting-detail/'.$item->id.'/annual-general-meeting-'.$year)}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name"> 
                                    Annual General Meeting 
                                    {{$year}}</div>
                                </div>
                             </a>
                          </div>
                          <?php if($i==0){?>
                          <div class="article-list-space"></div>
                          <?php
                           
                        }?>
                          <?php if($i==2){?>
                          <div class="article-list-space"></div>
                          <?php
                            $i=0;
                        }?>
                          <?php $i++;$u++;?>
                          @endforeach
                          <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('investor-relation/strategic-shareholders/strategic-shareholders')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Strategic Shareholders</div>
                                </div>
                             </a>
                          </div>
                          <?php if($u%2==0){?>
                          <div class="article-list-space"></div>
                          <?php }?>
                          <div id="article-item1" class="article-list-item1 mone">
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
    <script type="text/javascript">$(window).load(function() {$('#page-banner-group-item').nivoSlider({effect:'fade',pauseTime: 5000});});</script>
@endsection