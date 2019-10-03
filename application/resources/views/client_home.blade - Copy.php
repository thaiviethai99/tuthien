<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Saigon Postel Corp :: Cong ty Co Phan Dich vu Buu chinh Vien thong Saigon</title>
    <!-- <link rel="icon" type="image/x-icon"  href="<?php echo asset(app_config('AppFav')); ?>" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{--Global StyleSheet Start--}}
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    {!! Html::style("assets/libs/bootstrap/css/bootstrap.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-toggle/css/bootstrap-toggle.min.css") !!}
    {!! Html::style("assets/libs/font-awesome/css/font-awesome.min.css") !!}
    {!! Html::style("assets/css_spt/styles.css") !!}
    {!! Html::style("assets/css_spt/bootstrap-dropdownhover.css") !!}
	{!! Html::style("assets/css_spt/ticker-style.css") !!}
    {!! Html::style("assets/css_spt/home.css") !!}
    {!! Html::style("assets/css_spt/home-responsive.css") !!}
    {!! Html::style("assets/css_spt/nivo-slider.css") !!}
    {!! Html::style("assets/css_spt/default.css") !!}
    {{--Custom StyleSheet Start--}}

    @yield('style')
    

    {{--Global StyleSheet End--}}
    {!! Html::style("assets/css_spt/custom.css") !!}
    
</head>

<body class="home-page" onresize="myFunction();" onload="myFunction();">

    {{--Content File Start Here--}}
    @yield('content')
    
    {{--Content File End Here--}}
    <footer class="">
        <div class="">
            <div class="container">
                <div class="row">
                  <div class="col-md-12" style="padding:0px">
                    <div class="footer-catalog"><div class="fc-item">
<div class="fc-name"><a href="{{url('gioi-thieu')}}">Giới thiệu</a></div>
<div class="fc-link"><a href="{{url('gioi-thieu/tong-quan')}}">Tổng quan</a></div>
<div class="fc-link"><a href="{{url('gioi-thieu/lich-su-phat-trien')}}">Lịch sử phát triển</a></div>
<div class="fc-link"><a href="{{url('gioi-thieu/co-cau-to-chuc')}}">Cơ cấu tổ chức</a></div>
<div class="fc-link"><a href="{{url('gioi-thieu/giai-thuong')}}">Giải thưởng</a></div>
<div class="fc-link"><a href="{{url('gioi-thieu/thuong-hieu')}}">Thương hiệu</a></div>
<div class="fc-link"><a href="{{url('gioi-thieu/ebrochure')}}">eBrochure</a></div>
</div>
<div class="fc-item">
<div class="fc-name"><a href="{{url('tin-tuc')}}">Tin tức</a></div>
<div class="fc-link"><a href="{{url('tin-tuc/khuyen-mai-spt')}}">Khuyến mãi SPT</a></div>
<div class="fc-link"><a href="{{url('tin-tuc/diem-bao-thi-truong')}}">Điểm báo thị trường</a></div>
<div class="fc-link"><a href="{{url('tin-tuc/hop-tac-dau-tu')}}">Hợp tác đầu tư</a></div>
<div class="fc-link"><a href="{{url('tin-tuc/hoat-dong-spt')}}">Hoạt động SPT</a></div>
</div>
<div class="fc-item">
<div class="fc-name"><a href="{{url('dich-vu-chat-luong')}}">Dịch vụ &amp; Chất lượng</a></div>
<div class="fc-link"><a href="{{url('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu')}}">Công bố chất lượng</a></div>
<div class="fc-link"><a href="{{url('dich-vu-chat-luong/dich-vu-thoai')}}">Dịch vụ thoại</a></div>
<div class="fc-link"><a href="{{url('dich-vu-chat-luong/dich-vu-du-lieu')}}">Dịch vụ dữ liệu</a></div>
<div class="fc-link"><a href="{{url('dich-vu-chat-luong/dich-vu-buu-chinh/nhom-dich-vu-chuyen-phat-buu-chinh')}}">Dịch vụ Bưu chính</a></div>
<div class="fc-link"><a href="{{url('dich-vu-chat-luong/dich-vu-truyen-dan')}}">Dịch vụ truyền dẫn</a></div>
<div class="fc-link"><a href="{{url('dich-vu-chat-luong/dich-vu-khac')}}">Dịch vụ khác</a></div>
</div>
<div class="fc-item">
<div class="fc-name"><a href="{{url('don-vi-thanh-vien')}}">Đơn vị thành viên</a></div>
<div class="fc-link"><a href="{{url('don-vi-thanh-vien/trung-tam-truc-thuoc-spt')}}">Trung tâm</a></div>
<div class="fc-link"><a href="{{url('don-vi-thanh-vien/chi-nhanh-dai-dien-tai-cac-khu-vuc')}}">Chi nhánh</a></div>
<div class="fc-link"><a href="#">Đối tác</a></div>
</div>
<div class="fc-item">
<div class="fc-name"><a href="{{url('quan-he-co-dong')}}">Quan hệ cổ đông</a></div>
<div class="fc-link"><a href="{{url('quan-he-co-dong/dieu-le/dieu-le-spt-2008')}}">Điều lệ</a></div>
<div class="fc-link"><a href="{{url('quan-he-co-dong/bao-cao-thuong-nien')}}">Báo cáo thường niên</a></div>
<div class="fc-link"><a href="{{url('quan-he-co-dong/tin-tuc-co-dong/')}}">Tin tức cổ đông</a></div>
<div class="fc-link"><a href="{{url('quan-he-co-dong/co-dong-chien-luoc/co-dong-chien-luoc')}}">Cổ đông chiến lược</a></div>
</div>
</div>
<div class="footer-text" style="float:left"><p>© 1995 - 2018 Công ty Cổ phần Dịch vụ Bưu chính Viễn thông Sài Gòn (SPT)</p>
<p>10 Cô Giang, Quận 1, TP. Hồ Chí Minh&nbsp; - ĐT: (028) 5444 9999 - Fax: (028) 5404 0609 - Email: info@spt.vn</p></div><div id="ipv6" style="float:right">
    <!-- IPv6-test.com button BEGIN -->
<a href='http://ipv6-test.com/validate.php?url=spt.vn'><img src='{{URL::asset('assets/img/button-ipv6-big.png')}}' alt='ipv6 ready' title='ipv6 ready' border='0' /></a>
<!-- IPv6-test.com button END -->
</div>
                  </div>
                </div>
            </div>
        </div><!--//footer-content-->
        
    </footer>
    <input type="hidden" id="_url" value="{{url('/')}}">
{{--Global JavaScript Start--}}
{!! Html::script("assets/libs/jquery-1.10.2.min.js") !!}
{!! Html::script("assets/libs/bootstrap/js/bootstrap.min.js") !!}
{!! Html::script("assets/libs/bootstrap-toggle/js/bootstrap-toggle.min.js") !!}
{{--Global JavaScript End--}}
{!! Html::script("assets/js/back-to-top.js") !!}
{!! Html::script("assets/js/bootstrap-dropdownhover.min.js") !!}
{!! Html::script("assets/js/jquery.nivo.slider.js") !!}
{!! Html::script("assets/js/jquery.ticker.js") !!}
<script>
function myFunction()
{
    var mD = document.getElementById('menudropdown');
    var mR = document.getElementById('menuresponsive');
    var name = window.navigator.appName;
    //var v = jQuery.browser.version;

    if (window.innerWidth > 700)
    {
        mR.style.display = 'none';
        mD.style.display = 'block';
    }
    else
    {
        mR.style.display = 'block';
        mD.style.display = 'none';
    }
}

</script>
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/component.css')}}">
<script type='text/javascript' src="{{URL::asset('assets/js/modernizr.custom.js')}}"></script>
<script type='text/javascript' src="{{URL::asset('assets/js/cbpHorizontalMenu.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/component2.css')}}">
<script type="text/javascript">
$(window).load(function() {$('#home-banner-main').nivoSlider({effect:'fade',pauseTime: 5000});});
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });

    var _url=$('#_url').val();

    $('#bar-setting').click(function(e){
        e.preventDefault();
        $.post(_url+'/user/menu-open-status');
    });
</script>

{{--Custom JavaScript Start--}}

@yield('script')

{{--Custom JavaScript End Here--}}
</body>

</html>