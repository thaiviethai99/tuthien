<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SPT</title>
    <!-- <link rel="icon" type="image/x-icon"  href="<?php echo asset(app_config('AppFav')); ?>" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{--Global StyleSheet Start--}}
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    {!! Html::style("assets/libs/bootstrap/css/bootstrap.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-toggle/css/bootstrap-toggle.min.css") !!}
    {!! Html::style("assets/libs/font-awesome/css/font-awesome.min.css") !!}
    {!! Html::style("assets/libs/alertify/css/alertify.css") !!}
    {!! Html::style("assets/libs/alertify/css/alertify-bootstrap-3.css") !!}
    {!! Html::style("assets/libs/bootstrap-select/css/bootstrap-select.min.css") !!}
	{!! Html::style("assets/css/bootstrap-fileupload.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
    {{--Custom StyleSheet Start--}}

    

    {{--Global StyleSheet End--}}

    {!! Html::style("assets/css/style.css") !!}
    {!! Html::style("assets/css/admin.css") !!}
    {!! Html::style("assets/css/responsive.css") !!}
	@yield('style')

</head>



<body class="has-left-bar has-top-bar @if(Auth::guard('client')->user()->menu_open==1) left-bar-open @endif">

<nav id="left-nav" class="left-nav-bar">
    <div class="nav-top-sec">
        <div class="app-logo">
            <img with="160" height="40" src="<?php echo asset(app_config('AppLogo')); ?>" alt="logo" class="bar-logo">
        </div>

        <a href="#" id="bar-setting" class="bar-setting"><i class="fa fa-bars"></i></a>
    </div>
    <div class="nav-bottom-sec">
        <ul class="left-navigation" id="left-navigation">

            {{--Dashboard--}}
            <!-- <li @if(Request::path()== 'dashboard') class="active" @endif><a href="{{url('dashboard')}}"><span class="menu-text">{{language_data('Dashboard')}}</span> <span class="menu-thumb"><i class="fa fa-dashboard"></i></span></a></li> -->
			<li @if(Request::path()== 'client/spt-dashboard') class="active" @endif><a href="{{url('client/spt-dashboard')}}"><span class="menu-text">Trang chính</span> <span class="menu-thumb"><i class="fa fa-tachometer"></i></span></a></li>
			{{--website--}}
            <?php
                $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" .Auth::guard('client')->user()->id. "' and g.name='website'";
                $result        = DB::selectOne($sql);
                if($result){
            ?>
            <li @if(Request::path()== 'client/website') class="active" @endif><a href="{{url('client/website')}}"><span class="menu-text">Website</span> <span class="menu-thumb"><i class="fa fa-newspaper-o"></i></span></a></li>
            <?php }?>
            <?php
                $sql           = "select * from group_role_user r,group_role g where r.group_role_id=g.id and client_id='" .Auth::guard('client')->user()->id. "' and g.name='khách hàng'";
                $result        = DB::selectOne($sql);
                if($result){
            ?>
			<li @if(Request::path()== 'client/list-contact') class="active" @endif><a href="{{url('client/list-contact')}}"><span class="menu-text">Khách hàng</span> <span class="menu-thumb"><i class="fa fa-user"></i></span></a></li>
            <?php }?>
			{{--user--}}
            @if(Auth::guard('client')->user()->id==2 || Auth::guard('client')->user()->id==16 || Auth::guard('client')->user()->id==19)
			     <li @if(Request::path()== 'client/list-user-spt') class="active" @endif><a href="{{url('client/list-user-spt')}}"><span class="menu-text">Người dùng</span> <span class="menu-thumb"><i class="fa fa-users"></i></span></a></li>
            @endif
            {{--Logout--}}
            <li @if(Request::path()== 'logout') class="active" @endif><a href="{{url('logout')}}"><span class="menu-text">Đăng xuất</span> <span class="menu-thumb"><i class="fa fa-power-off"></i></span></a></li>

        </ul>
    </div>
</nav>

<main id="wrapper" class="" style="padding-top: 60px;">

    <div class="top-bar clearfix">
        <div class="navbar-right">

            <div class="clearfix">
                <div class="dropdown user-profile pull-right">


                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <!-- <span class="user-info text-complete text-uppercase m-r-30">{{language_data('SMS Balance')}} : {{Auth::guard('client')->user()->sms_limit}}</span> -->


                        <i class="fa fa-user" aria-hidden="true" style="margin-right: 5px"></i><span class="user-info">{{Auth::guard('client')->user()->name}}</span>

                        <!-- @if(Auth::guard('client')->user()->image!='')
                            <img class="user-image" src="<?php echo asset('assets/client_pic/'.Auth::guard('client')->user()->image); ?>" alt="{{Auth::guard('client')->user()->fname}} {{Auth::guard('client')->user()->lname}}">
                        @else
                            <img class="user-image" src="<?php echo asset('assets/client_pic/profile.jpg'); ?>" alt="{{Auth::guard('client')->user()->fname}} {{Auth::guard('client')->user()->lname}}">
                        @endif -->

                    </a>
                    <ul class="dropdown-menu arrow right-arrow" role="menu">
                        <!-- <li><a href="{{url('user/edit-profile')}}"><i class="fa fa-edit"></i>Cập nhật tài khoản</a></li> -->
                        <li><a href="{{url('user/change-password')}}"><i class="fa fa-lock"></i> Đổi mật khẩu</a></li>
                        <li class="bg-dark">
                            <a href="{{url('logout')}}" class="clearfix">
                                <span class="pull-left">Đăng xuất</span>
                                <span class="pull-right"><i class="fa fa-power-off"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

    {{--Content File Start Here--}}

    @yield('content')

    {{--Content File End Here--}}

    <input type="hidden" id="_url" value="{{url('/')}}">

</main>
        <div class="">
            <div class="container">
                <div class="row">
                  <div class="col-md-12" >
<div class="footer-text text-center" style="padding-top:10px"><p>© 1995 - <?php echo date('Y')?> Công ty Cổ phần Dịch vụ Bưu chính Viễn thông Sài Gòn (SPT)</p>
<p>10 Cô Giang, Quận 1, TP. Hồ Chí Minh&nbsp; - ĐT: (028) 5444 9999 - Fax: (028) 5404 0609 - Email: info@spt.vn</p></div>
                  </div>
                </div>
            </div>
        </div><!--//footer-content-->
        
    </footer>
{{--Global JavaScript Start--}}
{!! Html::script("assets/libs/jquery-1.10.2.min.js") !!}
{!! Html::script("assets/libs/jquery.slimscroll.min.js") !!}
{!! Html::script("assets/libs/bootstrap/js/bootstrap.min.js") !!}
{!! Html::script("assets/libs/bootstrap-toggle/js/bootstrap-toggle.min.js") !!}
{!! Html::script("assets/libs/alertify/js/alertify.js") !!}
{!! Html::script("assets/libs/bootstrap-select/js/bootstrap-select.min.js") !!}
{!! Html::script("assets/js/boostrap-fileupload.js") !!}
{!! Html::script("assets/libs/moment/moment.min.js") !!}
{!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") !!}
{!! Html::script("assets/js/scripts.js") !!}
{{--Global JavaScript End--}}

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
    
    $(".alert").delay(5000).slideUp(200, function() {
        $(this).alert('close');
    });
</script>

{{--Custom JavaScript Start--}}

@yield('script')

{{--Custom JavaScript End Here--}}
</body>

</html>