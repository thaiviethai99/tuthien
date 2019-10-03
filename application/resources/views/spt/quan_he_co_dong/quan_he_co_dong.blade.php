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
                    <li class="current">Quan hệ cổ đông</li>
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
                             <a href="{{url('quan-he-co-dong/bao-cao-thuong-nien')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Báo cáo thường niên</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('quan-he-co-dong/tin-tuc-co-dong')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Tin tức cổ đông</div>
                                </div>
                             </a>
                          </div>
                          <?php 
                          $i=0;
                          $u=0;
                          ?>
                          @foreach($qhcd as $item)
                            <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('quan-he-co-dong/dai-hoi-co-dong-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">{{$item->title}}</div>
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
                             <a href="{{url('quan-he-co-dong/co-dong-chien-luoc/co-dong-chien-luoc')}}">
                                <div class="article-list-item-content">
                                   <div class="article-list-name">Cổ đông chiến lược</div>
                                </div>
                             </a>
                          </div>
                          <?php if($u%2==0){?>
                          <div class="article-list-space"></div>
                          <?php }?>
                          <div id="article-item1" class="article-list-item1 mone">
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
    <script type="text/javascript">$(window).load(function() {$('#page-banner-group-item').nivoSlider({effect:'fade',pauseTime: 5000});});</script>
@endsection