@extends('client_home')

{{--External Style Section--}}
@section('style')
@endsection


@section('content')
<?php
$languageId = getLanguageId();
?>
    <div class="">

        <!-- ******HEADER****** -->
        <header class="header" style="max-width: 1203px;">
            <div class="header-main container">
              <div class="row">
                <h1 class="logo col-md-4 col-sm-6 col-md-offset-1 col-xs-6">
                    <a href="{{url('/')}}"><img id="logo" src="{{URL::asset('assets/img/logo.png')}}" alt="Logo"></a>
                </h1><!--//logo-->
                <div class="info col-md-7 col-sm-6 col-xs-6">
                        <ul class="menu-top navbar-right hidden-xs">
                        <li class="divider"><a href="{{url('tuyen-dung')}}"><strong>Tuyển dụng</strong></a></li>
                        <li class="divider"><a href="{{url('lien-he')}}"><strong>Liên hệ và phản hồi</strong></a></li>
                        <li>
                          @if($languageId==1)
                            <a href="{{URL::asset('')}}language/vi"><img src="{{URL::asset('assets/img/vn-flag.png')}}" title="Tiếng Việt" border="0"></a>
                          @else
                            <a href="{{URL::asset('')}}language/en"><img src="{{URL::asset('assets/img/en-flag.png')}}" title="Tiếng Anh" border="0"></a>
                          @endif
                        </li>
                    </ul>
                </div><!--//info-->
              </div>
              <div class="row">
                <h1 class=" col-md-4 col-sm-6 col-md-offset-1 col-xs-6">
                    
                </h1><!--//logo-->
                <div class="info col-md-7 col-sm-6 col-xs-6">
                        <div class="dropdown navbar-right hidden-xs" style="margin-right: 0px">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Chăm sóc khách hàng
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu" style="min-width:auto">
                            <li><a href="https://khachhang.spt.vn" style="color:#000;padding:8px 16px">Khách hàng viễn thông</a></li>
                            <li><a href="#" style="color:#000;border-bottom: none;padding:8px 16px">Khách hàng bưu chính</a></li>
                          </ul>
                        </div>
                </div><!--//info-->
            </div>
            </div><!--//header-main-->
        </header><!--//header-->

        <!-- ******NAV****** -->
        <?php //include("menu.php");?>
        <!--//main-nav-->
        <!-- ******CONTENT****** -->
        


<!-- ******CONTENT****** -->
<div class="content container">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row page-row">
              <div class="page-menu">
                <div id=menuresponsive class="main clearfix" style="display: none;">
               <nav id=menu class=nav>
                  <ul>
                     <li class="martwo @if(
            Request::path()== '/') mselected @else mitem-link @endif "><a href="{{url('/')}}"><span>Trang chủ</span></a></li>
                     <li class="marone @if(
            Request::path()== 'gioi-thieu') mselected @else mitem-link @endif "><a href="{{url('gioi-thieu')}}"><span>Giới thiệu</span></a></li>
                     <li class="martwo @if(
            Request::path()== 'tin-tuc') mselected @else mitem-link @endif "><a href="{{url('tin-tuc')}}"><span>Tin tức</span></a></li>
                     <li class="marone @if(
            Request::path()== 'dich-vu-chat-luong') mselected @else mitem-link @endif "><a href="{{url('dich-vu-chat-luong')}}"><span>Dịch vụ & Chất lượng</span></a></li>
                     <li class="martwo @if(
            Request::path()== 'don-vi-thanh-vien') mselected @else mitem-link @endif "><a href="{{url('don-vi-thanh-vien')}}"><span>Đơn vị thành viên</span></a></li>
                     <li class="marone @if(
            Request::path()== 'quan-he-co-dong') mselected @else mitem-link @endif "><a href="{{url('quan-he-co-dong')}}"><span>Quan hệ Cổ đông</span></a></li>
                  </ul>
               </nav>
            </div>
            <script>var changeClass = function (r) {if(r.className == 'navtoogle active') {r.className = 'navtoogle';}else{r.className = 'navtoogle active';}return r.className;};var menuElements = document.getElementById('menu');menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i></button>');document.getElementById('menutoggle').onclick = function() {changeClass(this);};document.onclick = function(e) {var mobileButton = document.getElementById('menutoggle'),buttonStyle =  mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {changeClass(mobileButton);}}</script>
          </div>
            <div class=home-banner id="menudropdown">
            <div class=banner>
               <div class=banner-item-home>
                  
                  
                  <div class="slider-wrapper theme-default">
                     <div id="home-banner-main" class="nivoSlider">
                        <img src="{{URL::asset('assets/img/10282782_spt3.jpg')}}"/>
                        <img src="{{URL::asset('assets/img/15475778_spt1.jpg')}}"/>
                        <img src="{{URL::asset('assets/img/15475168_spt2.jpg')}}"/>
                    </div>
                  </div>
                 
               </div>
            </div>
            <div class=home-menu>
               <div id=hm0 class="hone-menu-item mtwo">
                  <a href="{{url('gioi-thieu')}}">
                     <div class=home-menu-item-content>
                        <div class=home-menu-item-name>Giới thiệu</div>
                     </div>
                  </a>
               </div>
               <div class=hone-menu-space></div>
               <div id=hm1 class="hone-menu-item mone">
                  <a href="{{url('tin-tuc')}}">
                     <div class=home-menu-item-content>
                        <div class=home-menu-item-name>Tin tức</div>
                     </div>
                  </a>
               </div>
               <div class=hone-menu-space></div>
               <div id=hm2 class="hone-menu-item mtwo">
                  <a href="{{url('dich-vu-chat-luong')}}">
                     <div class=home-menu-item-content>
                        <div class=home-menu-item-name>Dịch vụ & Chất lượng</div>
                     </div>
                  </a>
               </div>
               <div class=hone-menu-space></div>
               <div id=hm3 class="hone-menu-item mone">
                  <a href="{{url('don-vi-thanh-vien')}}">
                     <div class=home-menu-item-content>
                        <div class=home-menu-item-name>Đơn vị thành viên</div>
                     </div>
                  </a>
               </div>
               <div class=hone-menu-space></div>
               <div id=hm4 class="hone-menu-item mtwo">
                  <a href="{{url('quan-he-co-dong')}}">
                     <div class=home-menu-item-content>
                        <div class=home-menu-item-name>Quan hệ Cổ đông</div>
                     </div>
                  </a>
               </div>
            </div>
         </div>
         <div class=home-article>
          <?php $i=0;?>
          @foreach($homeList as $item)
            <div class="home-article-item @if($i%2==0) matwo @else maone @endif">
               <div class=home-article-item-img>
                  @if($item->cate_id==4)
                  <a href="{{url('quan-he-co-dong/bao-cao-thuong-nien-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                     <div class=home-article-item-img-div style="background-image:url('{{URL::asset('assets/img/'.$item->img)}}')"></div>
                  </a>
                  @endif
                  @if($item->cate_id==5)
                  <a href="{{url('quan-he-co-dong/tin-tuc-co-dong-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                     <div class=home-article-item-img-div style="background-image:url('{{URL::asset('assets/img/'.$item->img)}}')"></div>
                  </a>
                  @endif
                  @if($item->cate_id==14)
                  <a href="{{url('tin-tuc/tin-tuc-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                     <div class=home-article-item-img-div style="background-image:url('{{URL::asset('assets/img/'.$item->img)}}')"></div>
                  </a>
                  @endif
                  @if($item->cate_id==15)
                  <a href="{{url('tin-tuc/diem-bao-thi-truong-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                     <div class=home-article-item-img-div style="background-image:url('{{URL::asset('assets/img/'.$item->img)}}')"></div>
                  </a>
                  @endif
                  @if($item->cate_id==16)
                  <a href="{{url('tin-tuc/hop-tac-dau-tu-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                     <div class=home-article-item-img-div style="background-image:url('{{URL::asset('assets/img/'.$item->img)}}')"></div>
                  </a>
                  @endif
                  @if($item->cate_id==17)
                  <a href="{{url('tin-tuc/dau-thau-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                     <div class=home-article-item-img-div style="background-image:url('{{URL::asset('assets/img/'.$item->img)}}')"></div>
                  </a>
                  @endif
                  @if($item->cate_id==18)
                  <a href="{{url('tin-tuc/hoat-dong-spt-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                     <div class=home-article-item-img-div style="background-image:url('{{URL::asset('assets/img/'.$item->img)}}')"></div>
                  </a>
                  @endif
                  @if($item->cate_id==28)
                  <a href="{{url('tuyen-dung/tuyen-dung-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                     <div class=home-article-item-img-div style="background-image:url('{{URL::asset('assets/img/'.$item->img)}}')"></div>
                  </a>
                  @endif
                  @if($item->cate_id==32)
                  <a href="{{url('quan-he-co-dong/dai-hoi-co-dong-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">
                     <div class=home-article-item-img-div style="background-image:url('{{URL::asset('assets/img/'.$item->img)}}')"></div>
                  </a>
                  @endif
               </div>
               <div class=home-article-item-name>
                @if($item->cate_id==4)
                <a href="{{url('quan-he-co-dong/bao-cao-thuong-nien-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
                  {{$item->title}}
                </a>
                @endif
                @if($item->cate_id==5)
                <a href="{{url('quan-he-co-dong/tin-tuc-co-dong-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
                  {{$item->title}}
                </a>
                @endif
                @if($item->cate_id==14)
                <a href="{{url('tin-tuc/tin-tuc-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
                  {{$item->title}}
                </a>
                @endif
                @if($item->cate_id==15)
                <a href="{{url('tin-tuc/diem-bao-thi-truong-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
                  {{$item->title}}
                </a>
                @endif
                @if($item->cate_id==16)
                <a href="{{url('tin-tuc/hop-tac-dau-tu-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
                  {{$item->title}}
                </a>
                @endif
                @if($item->cate_id==17)
                <a href="{{url('tin-tuc/dau-thau-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
                  {{$item->title}}
                </a>
                @endif
                @if($item->cate_id==18)
                <a href="{{url('tin-tuc/hoat-dong-spt-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
                  {{$item->title}}
                </a>
                @endif
                @if($item->cate_id==28)
                <a href="{{url('tuyen-dung/tuyen-dung-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
                  {{$item->title}}
                </a>
                @endif
                @if($item->cate_id==32)
                <a href="{{url('quan-he-co-dong/dai-hoi-co-dong-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
                  {{$item->title}}
                </a>
                @endif
               </div>
               <div class=home-article-item-date>{{date('d-m-Y',strtotime($item->created_date))}}</div>
            </div>
            <div class=home-article-item-space></div>
            <?php $i++;?>
            <?php if($i%4==0){?>
              <div class="home-article-item-sheight"></div>
            <?php } 
            ?>
          @endforeach
         </div>
                @include('sub.new_run')
            </div><!--//page-row-->
        </div><!--//page-content-->
    </div><!--//page-->
</div><!--//content-->


    </div><!--//wrapper-->
    <!-- ******FOOTER****** -->
    <?php //include("footer.php");?>
    <!--//footer-->
    <!-- Javascript -->
    <!-- jQuery -->
    



@endsection

{{--External Style Section--}}
@section('script')

    <script>
        $('#js-news').ticker({titleText:''});
    </script>
@endsection