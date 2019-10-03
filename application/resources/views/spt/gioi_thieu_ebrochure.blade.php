@extends('client_menu')

{{--External Style Section--}}
@section('style')
    <link href="{{URL::asset('assets/js/bookflip/css/thumbs_carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/js/bookflip/css/main.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
    <div class="content container">
    <div class="page-wrapper">
        <div class="row">
        <header class="page-heading clearfix">
            <div class="breadcrumbs pull-left">
                <ul class="breadcrumbs-list">
                    <li><a href="{{url('/')}}">Trang chủ</a><i class="fa fa-angle-right"></i></li>
                     <li><a href="{{url('gioi-thieu')}}">Giới thiệu</a><i class="fa fa-angle-right"></i></li>
                    <li class="current">ebrochure</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-12 col-sm-12">
                    <div>
                        <div class=article-content>
            
			
           
            <div id=gallery-content>
               <div class=magazine-viewport>
                  <div class=container>
                     <div class=magazine>
                        <div ignore=1 class=next-button></div>
                        <div ignore=1 class=previous-button></div>
                     </div>
                  </div>
               </div>
               <div class=navbar>
                  <div class=navbarcontent>
                     <ul>
                        <li>
                           <a id=home>
                              <div  title="Home"></div>
                           </a>
                        </li>
                        <li>
                           <a id=show_thumbnails>
                              <div   title="Thumbnails"></div>
                           </a>
                        </li>
                     </ul>
                     <div class=gotopagediv>
                        <div class=uinput><span><input type="text" id="page-number" name="page-number" value=""  placeholder=""></span></div>
                        <a id="gotopage"><img src="{{URL::asset('assets/js/bookflip/img/page-go.png')}}" alt="Go to page" /></a>
                     </div>
                  </div>
               </div>
               <div class=overlay>
                  <div id=thumbs_carousel>
                     <ul>
                        <li><img src="{{URL::asset('assets/img/10333460_Page_01_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10333120_Page_02_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10332805_Page_03_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10332455_Page_04_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10332149_Page_05_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10331806_Page_06_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10331429_Page_07_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10330307_Page_08_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10325827_Page_09_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10325507_Page_10_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10324925_Page_11_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10324559_Page_12_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10323987_Page_13_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10323678_Page_14_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10323332_Page_15_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10323014_Page_16_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10322721_Page_17_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10322442_Page_18_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10322089_Page_19_thumbnail.jpg')}}"></li>
                        <li><img src="{{URL::asset('assets/img/10321726_Page_20_thumbnail.jpg')}}"></li>
                     </ul>
                  </div>
               </div>
            </div>
            <script type="text/javascript">var flag = 0;var pageshow = 20;</script>
			
         </div>
               
                    </div>
                </div><!--//faq-wrapper-->
                
            </div><!--//page-row-->
        </div><!--//page-content-->
    </div><!--//page-->
</div><!--//content-->


    </div><!--//wrapper-->



@endsection

{{--External Style Section--}}
@section('script')
	<script type="text/javascript" src="{{URL::asset('assets/js/bookflip/turn.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('assets/js/bookflip/modernizr.2.5.3.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('assets/js/bookflip/hash.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('assets/js/bookflip/magazine.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/bookflip/jquery.mousewheel.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('assets/js/bookflip/jquery.tooltipster.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('assets/js/bookflip/jMyCarousel.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('assets/js/bookflip/onload.js')}}"></script>
@endsection