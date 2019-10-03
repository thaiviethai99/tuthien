<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home 01</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo asset('assets/images/icons/favicon.png')?>"/>
<!--===============================================================================================-->
    {!! Html::style("assets/vendor/bootstrap/css/bootstrap.min.css") !!}
<!--===============================================================================================-->
    {!! Html::style("assets/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css") !!}
<!--===============================================================================================-->
    {!! Html::style("assets/fonts/iconic/css/material-design-iconic-font.min.css") !!}
<!--===============================================================================================-->
    {!! Html::style("assets/vendor/animate/animate.css") !!}
<!--===============================================================================================-->
    {!! Html::style("assets/vendor/css-hamburgers/hamburgers.min.css") !!}
<!--===============================================================================================-->
    {!! Html::style("assets/vendor/animsition/css/animsition.min.css") !!}
<!--===============================================================================================-->
    {!! Html::style("assets/css/util.min.css") !!}
<!--===============================================================================================-->
    {!! Html::style("assets/css/main.css") !!}
<!--===============================================================================================-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
<style type="text/css">
    /******************  News Slider Demo-10 *******************/
.post-slide10{
    padding-bottom: 10px;
    margin: 0 15px;
    position:relative;
    background:#fff !important;
    box-shadow: 0 1px 2px rgba(43,59,93,0.30);
    margin-bottom:2em;
}
.post-slide10 img{
    width: 100%;
    height: auto;
}
.post-slide10 .post-date{
    position:absolute;
    top:2%;
    left:8%;
    padding: 3% 5%;
    background: #e74c3c;
}
.post-slide10 .month{
    font-size: 14px;
    color:#fff;
    font-weight: bold;
    text-transform:uppercase;
}
.post-slide10 .month:after{
    content:"";
    display: block;
    border:1px solid #fff;
}
.post-slide10 .date{
    font-size: 14px;
    color:#fff;
    display: block;
    text-align:center;
    font-weight: bold;
}
.post-slide10 .post-title{
    margin:25px 0 15px 0;
}
.post-slide10 .post-title a{
    font-size:15px;
    font-weight:bold;
    color:#333;
    padding:0px 15px;
    display: inline-block;
    text-transform:uppercase;
    transition: all 0.3s ease 0s;
}
.post-slide10 .post-title a:hover{
    text-decoration: none;
    color:#e74c3c;
}
.post-slide10 .post-description{
    font-size: 14px;
    line-height:24px;
    color:#808080;
    padding:0px 15px;
}
.post-slide10 .read-more{
    color:#333;
    padding:0px 15px;
    text-transform:capitalize;
    transition: color 0.20s linear;
}
.post-slide10 .read-more i{
    margin-left:10px;
    font-size:10px;
}
.post-slide10 .read-more:hover{
    text-decoration:none;
    color:#e74c3c;
}
.owl-controls .owl-buttons{
    margin-top:20px;
    position:relative;
}
.owl-controls .owl-prev{
    position: absolute;
    left: -40px;
    bottom: 230px;
    padding: 8px 17px;
    background:#333;
    transition:background 0.50s ease;
}
.owl-controls .owl-next{
    position: absolute;
    right: -40px;
    bottom: 230px;
    padding:8px 17px;
    background:#333;
    transition:background 0.50s ease;
}
.owl-controls .owl-prev:after,
.owl-controls .owl-next:after{
    content:"\f104";
    font-family: 'Font Awesome\ 5 Free';
    font-weight: 900;
    color: #d3d3d3;
    font-size:16px;
}
.owl-controls .owl-next:after{
    content:"\f105";
    font-weight: 900;
}
.owl-controls .owl-prev:hover,
.owl-controls .owl-next:hover{
    background: #e74c3c;
    font-weight: 900;
}
@media only screen and (max-width: 990px) {
    .post-slide10{
        margin: 0 20px;
    }
    .owl-controls .owl-buttons .owl-prev{
        left:-20px;
        padding:5px 14px;
    }
    .owl-controls .owl-buttons .owl-next{
        right:-20px;
        padding:5px 14px;
    }
}
@media only screen and (max-width: 767px){
    .owl-controls .owl-buttons .owl-prev{
        left:0px;
        bottom: 260px;
    }
    .owl-controls .owl-buttons .owl-next{
        right:0px;
        bottom: 260px;
    }
}
</style>
@yield('style')
</head>
<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <div class="topbar">
                <div class="content-topbar container h-100">
                    <div class="left-topbar">
                        <span class="left-topbar-item flex-wr-s-c">
                            <span>
                                New York, NY
                            </span>

                            <img class="m-b-1 m-rl-8" src="http://localhost/tuthien/assets/images/icons/icon-night.png" alt="IMG">

                            <span>
                                HI 58° LO 56°
                            </span>
                        </span>

                        <a href="#" class="left-topbar-item">
                            About
                        </a>

                        <a href="#" class="left-topbar-item">
                            Contact
                        </a>

                        <a href="#" class="left-topbar-item">
                            Sing up
                        </a>

                        <a href="#" class="left-topbar-item">
                            Log in
                        </a>
                    </div>

                    <div class="right-topbar">
                        <a href="#">
                            <span class="fab fa-facebook-f"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-twitter"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-pinterest-p"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-vimeo-v"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-youtube"></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Header Mobile -->
            <div class="wrap-header-mobile">
                <!-- Logo moblie -->
                <div class="logo-mobile">
                    <a href="index.html"><img src="http://localhost/tuthien/assets/images/icons/logo-01.png" alt="IMG-LOGO"></a>
                </div>

                <!-- Button show menu -->
                <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>

            <!-- Menu Mobile -->
            <div class="menu-mobile">
                <ul class="topbar-mobile">
                    <li class="left-topbar">
                        <span class="left-topbar-item flex-wr-s-c">
                            <span>
                                New York, NY
                            </span>

                            <img class="m-b-1 m-rl-8" src="http://localhost/tuthien/assets/images/icons/icon-night.png" alt="IMG">

                            <span>
                                HI 58° LO 56°
                            </span>
                        </span>
                    </li>

                    <li class="left-topbar">
                        <a href="#" class="left-topbar-item">
                            About
                        </a>

                        <a href="#" class="left-topbar-item">
                            Contact
                        </a>

                        <a href="#" class="left-topbar-item">
                            Sing up
                        </a>

                        <a href="#" class="left-topbar-item">
                            Log in
                        </a>
                    </li>

                    <li class="right-topbar">
                        <a href="#">
                            <span class="fab fa-facebook-f"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-twitter"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-pinterest-p"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-vimeo-v"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-youtube"></span>
                        </a>
                    </li>
                </ul>

                <ul class="main-menu-m">
                    <li>
                        <a href="index.html">Home</a>
                        <ul class="sub-menu-m">
                            <li><a href="index.html">Homepage v1</a></li>
                            <li><a href="home-02.html">Homepage v2</a></li>
                            <li><a href="home-03.html">Homepage v3</a></li>
                        </ul>

                        <span class="arrow-main-menu-m">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                    </li>

                    <li>
                        <a href="category-01.html">News</a>
                    </li>

                    <li>
                        <a href="category-02.html">Entertainment </a>
                    </li>

                    <li>
                        <a href="category-01.html">Business</a>
                    </li>

                    <li>
                        <a href="category-02.html">Travel</a>
                    </li>

                    <li>
                        <a href="category-01.html">Life Style</a>
                    </li>

                    <li>
                        <a href="category-02.html">Video</a>
                    </li>

                    <li>
                        <a href="#">Features</a>
                        <ul class="sub-menu-m">
                            <li><a href="category-01.html">Category Page v1</a></li>
                            <li><a href="category-02.html">Category Page v2</a></li>
                            <li><a href="blog-grid.html">Blog Grid Sidebar</a></li>
                            <li><a href="blog-list-01.html">Blog List Sidebar v1</a></li>
                            <li><a href="blog-list-02.html">Blog List Sidebar v2</a></li>
                            <li><a href="blog-detail-01.html">Blog Detail Sidebar</a></li>
                            <li><a href="blog-detail-02.html">Blog Detail No Sidebar</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>

                        <span class="arrow-main-menu-m">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                    </li>
                </ul>
            </div>

            <!--  -->
            <div class="wrap-logo container">
                <!-- Logo desktop -->
                <div class="logo">
                    <a href="index.html"><img src="http://localhost/tuthien/assets/images/icons/logo-01.png" alt="LOGO"></a>
                </div>

                <!-- Banner -->
                <div class="banner-header">
                    <a href="#"><img src="http://tuthien.vn/images/banner.jpg" alt="IMG"></a>
                </div>
            </div>

            <!--  -->
            <div class="wrap-main-nav">
                <div class="main-nav">
                    <!-- Menu desktop -->
                    <nav class="menu-desktop">
                        <a class="logo-stick" href="index.html">
                            <img src="http://localhost/tuthien/assets/images/icons/logo-01.png" alt="LOGO">
                        </a>

                        <ul class="main-menu">
                            <li class="main-menu-active">
                                <a href="index.html">Home</a>
                                <ul class="sub-menu">
                                    <li><a href="index.html">Homepage v1</a></li>
                                    <li><a href="home-02.html">Homepage v2</a></li>
                                    <li><a href="home-03.html">Homepage v3</a></li>
                                </ul>
                            </li>

                            <li class="mega-menu-item">
                                <a href="category-01.html">News</a>

                                <div class="sub-mega-menu">
                                    <div class="nav flex-column nav-pills" role="tablist">
                                        <a class="nav-link active" data-toggle="pill" href="#news-0" role="tab">All</a>
                                        <a class="nav-link" data-toggle="pill" href="#news-1" role="tab">Entertaiment</a>
                                        <a class="nav-link" data-toggle="pill" href="#news-2" role="tab">Fashion</a>
                                        <a class="nav-link" data-toggle="pill" href="#news-3" role="tab">Life Style</a>
                                        <a class="nav-link" data-toggle="pill" href="#news-4" role="tab">Technology</a>
                                        <a class="nav-link" data-toggle="pill" href="#news-5" role="tab">Travel</a>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="news-0" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-05.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-10.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Finance
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-14.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Beach
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-36.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Technology
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="news-1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-50.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-08.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-07.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-06.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="news-2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-21.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-24.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-22.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-23.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="news-3" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-25.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-27.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-26.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-34.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="news-4" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-35.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-36.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-37.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-38.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="news-5" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-39.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-41.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-42.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-40.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="mega-menu-item">
                                <a href="category-02.html">Entertainment </a>

                                <div class="sub-mega-menu">
                                    <div class="nav flex-column nav-pills" role="tablist">
                                        <a class="nav-link active" data-toggle="pill" href="#enter-1" role="tab">All</a>
                                        <a class="nav-link" data-toggle="pill" href="#enter-2" role="tab">Game</a>
                                        <a class="nav-link" data-toggle="pill" href="#enter-3" role="tab">Celebrity</a>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="enter-1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-25.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-27.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-26.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-34.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="enter-2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-35.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-36.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-37.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-38.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="enter-3" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-39.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-41.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-42.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-40.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="mega-menu-item">
                                <a href="category-01.html">Business</a>

                                <div class="sub-mega-menu">
                                    <div class="nav flex-column nav-pills" role="tablist">
                                        <a class="nav-link active" data-toggle="pill" href="#business-1" role="tab">All</a>
                                        <a class="nav-link" data-toggle="pill" href="#business-2" role="tab">Economy</a>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="business-1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-10.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-11.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-26.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-34.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="business-2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-35.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-36.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-37.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-38.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="mega-menu-item">
                                <a href="category-02.html">Travel</a>

                                <div class="sub-mega-menu">
                                    <div class="nav flex-column nav-pills" role="tablist">
                                        <a class="nav-link active" data-toggle="pill" href="#travel-1" role="tab">All</a>
                                        <a class="nav-link" data-toggle="pill" href="#travel-2" role="tab">Hotels</a>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="travel-1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-39.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-41.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-42.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-40.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="travel-2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-35.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-36.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-37.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-38.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="mega-menu-item">
                                <a href="category-01.html">Life Style</a>

                                <div class="sub-mega-menu">
                                    <div class="nav flex-column nav-pills" role="tablist">
                                        <a class="nav-link active" data-toggle="pill" href="#life-1" role="tab">All</a>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="life-1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-25.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-27.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-26.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-34.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="mega-menu-item">
                                <a href="category-02.html">Video</a>

                                <div class="sub-mega-menu">
                                    <div class="nav flex-column nav-pills" role="tablist">
                                        <a class="nav-link active" data-toggle="pill" href="#video-1" role="tab">All</a>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="video-1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-50.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 18
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-08.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Feb 12
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-07.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 20
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!-- Item post -->
                                                    <div>
                                                        <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                            <img src="http://localhost/tuthien/assets/images/post-06.jpg" alt="IMG">
                                                        </a>

                                                        <div class="p-t-10">
                                                            <h5 class="p-b-5">
                                                                <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                    Donec metus orci, malesuada et lectus vitae
                                                                </a>
                                                            </h5>

                                                            <span class="cl8">
                                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                    Music
                                                                </a>

                                                                <span class="f1-s-3 m-rl-3">
                                                                    -
                                                                </span>

                                                                <span class="f1-s-3">
                                                                    Jan 15
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <a href="#">Features</a>
                                <ul class="sub-menu">
                                    <li><a href="category-01.html">Category Page v1</a></li>
                                    <li><a href="category-02.html">Category Page v2</a></li>
                                    <li><a href="blog-grid.html">Blog Grid Sidebar</a></li>
                                    <li><a href="blog-list-01.html">Blog List Sidebar v1</a></li>
                                    <li><a href="blog-list-02.html">Blog List Sidebar v2</a></li>
                                    <li><a href="blog-detail-01.html">Blog Detail Sidebar</a></li>
                                    <li><a href="blog-detail-02.html">Blog Detail No Sidebar</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Headline -->
    <div class="container">
        <div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
                <span class="text-uppercase cl2 p-r-8">
                    Trending Now:
                </span>

                <span class="dis-inline-block cl6 slide100-txt pos-relative size-w-0" data-in="fadeInDown" data-out="fadeOutDown">
                    <span class="dis-inline-block slide100-txt-item animated visible-false">
                        Interest rate angst trips up US equity bull market
                    </span>

                    <span class="dis-inline-block slide100-txt-item animated visible-false">
                        Designer fashion show kicks off Variety Week
                    </span>

                    <span class="dis-inline-block slide100-txt-item animated visible-false">
                        Microsoft quisque at ipsum vel orci eleifend ultrices
                    </span>
                </span>
            </div>

            <div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
                <button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Slider -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="news-slider10" class="owl-carousel">
                    <div class="post-slide10">
                        <img src="http://localhost/tuthien/assets/images/post-01.jpg" alt="">
                        <h3 class="post-title">
                            <a href="#">Lorem ipsum dolor sit amet, consectetur.</a>
                        </h3>
                        <p class="post-description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......
                        </p>
                        <a href="#" class="read-more">read more<i class="fa fa-chevron-right"></i></a>
                    </div>

                    <div class="post-slide10">
                        <img src="http://localhost/tuthien/assets/images/post-01.jpg" alt="">
                        <h3 class="post-title">
                            <a href="#">Lorem ipsum dolor sit amet, consectetur.</a>
                        </h3>
                        <p class="post-description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......
                        </p>
                        <a href="#" class="read-more">read more<i class="fa fa-chevron-right"></i></a>
                    </div>

                    <div class="post-slide10">
                        <img src="http://localhost/tuthien/assets/images/post-01.jpg" alt="">
                        <h3 class="post-title">
                            <a href="#">Lorem ipsum dolor sit amet, consectetur.</a>
                        </h3>
                        <p class="post-description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......
                        </p>
                        <a href="#" class="read-more">read more<i class="fa fa-chevron-right"></i></a>
                    </div>

                    <div class="post-slide10">
                        <img src="http://localhost/tuthien/assets/images/post-01.jpg" alt="">
                        <h3 class="post-title">
                            <a href="#">Lorem ipsum dolor sit amet, consectetur.</a>
                        </h3>
                        <p class="post-description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......
                        </p>
                        <a href="#" class="read-more">read more<i class="fa fa-chevron-right"></i></a>
                    </div>

                    <div class="post-slide10">
                        <img src="http://localhost/tuthien/assets/images/post-01.jpg" alt="">
                        <h3 class="post-title">
                            <a href="#">Lorem ipsum dolor sit amet, consectetur.</a>
                        </h3>
                        <p class="post-description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......
                        </p>
                        <a href="#" class="read-more">read more<i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Post -->
    <section class="bg0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="p-b-20">
                        <!-- Entertainment -->
                        <div class="tab01 p-b-20">
                            <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                <!-- Brand tab -->
                                <h3 class="f1-m-2 cl12 tab01-title">
                                    Entertainment
                                </h3>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab1-1" role="tab">All</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab1-2" role="tab">Celebrity</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab1-3" role="tab">Movies</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab1-4" role="tab">Music</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab1-5" role="tab">Games</a>
                                    </li>

                                    <li class="nav-item-more dropdown dis-none">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>

                                        <ul class="dropdown-menu">

                                        </ul>
                                    </li>
                                </ul>

                                <!--  -->
                                <a href="category-01.html" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                    View all
                                    <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                </a>
                            </div>


                            <!-- Tab panes -->
                            <div class="tab-content p-t-35">
                                <!-- - -->
                                <div class="tab-pane fade show active" id="tab1-1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-05.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            American live music lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-06.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-07.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Game
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-08.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Celebrity
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab1-2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-09.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            American live music lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-08.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Celebrity
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-06.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-07.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Game
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab1-3" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-08.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            American live music lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-07.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Celebrity
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-06.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-05.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Game
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab1-4" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-06.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            American live music lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-09.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Celebrity
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-07.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-08.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Game
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab1-5" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-07.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            American live music lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-08.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Celebrity
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-06.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Music
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-09.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Game
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Business -->
                        <div class="tab01 p-b-20">
                            <div class="tab01-head how2 how2-cl2 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                <!-- Brand tab -->
                                <h3 class="f1-m-2 cl13 tab01-title">
                                    Business
                                </h3>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab2-1" role="tab">All</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab2-2" role="tab">Finance</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab2-3" role="tab">Money & Markets</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab2-4" role="tab">Small Business</a>
                                    </li>

                                    <li class="nav-item-more dropdown dis-none">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>

                                        <ul class="dropdown-menu">

                                        </ul>
                                    </li>
                                </ul>

                                <!--  -->
                                <a href="category-01.html" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                    View all
                                    <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                </a>
                            </div>


                            <!-- Tab panes -->
                            <div class="tab-content p-t-35">
                                <!-- - -->
                                <div class="tab-pane fade show active" id="tab2-1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-10.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            Bitcoin lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Finance
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-11.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Small Business
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-12.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Economy
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-13.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Money & Markets
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab2-2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-13.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            Bitcoin lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Finance
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-12.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Small Business
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-11.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Economy
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-10.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Money & Markets
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab2-3" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-11.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            Bitcoin lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Finance
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-12.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Small Business
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-13.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Economy
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-10.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Money & Markets
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab2-4" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-12.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            Bitcoin lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Finance
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-13.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Small Business
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-10.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Economy
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-11.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Money & Markets
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Travel -->
                        <div class="tab01 p-b-20">
                            <div class="tab01-head how2 how2-cl3 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                <!-- Brand tab -->
                                <h3 class="f1-m-2 cl14 tab01-title">
                                    Travel
                                </h3>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab3-1" role="tab">All</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab3-2" role="tab">Hotels</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab3-3" role="tab">Flight</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab3-4" role="tab">Beachs</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab3-5" role="tab">Culture</a>
                                    </li>

                                    <li class="nav-item-more dropdown dis-none">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>

                                        <ul class="dropdown-menu">

                                        </ul>
                                    </li>
                                </ul>

                                <!--  -->
                                <a href="category-01.html" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                    View all
                                    <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                </a>
                            </div>


                            <!-- Tab panes -->
                            <div class="tab-content p-t-35">
                                <!-- - -->
                                <div class="tab-pane fade show active" id="tab3-1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-14.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            You wish lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Hotels
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-15.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Beachs
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-16.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Flight
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-17.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Culture
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab3-2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-15.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            You wish lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Hotels
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-16.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Beachs
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-17.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Flight
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-18.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Culture
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab3-3" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-16.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            You wish lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Hotels
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-17.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Beachs
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-18.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Flight
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-14.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Culture
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab3-4" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-17.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            You wish lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Hotels
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-18.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Beachs
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-14.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Flight
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-15.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Culture
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="tab3-5" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="m-b-30">
                                                <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-18.jpg" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            You wish lorem ipsum dolor sit amet consectetur
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                            Hotels
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 18
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-17.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Beachs
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 17
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-16.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Flight
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 16
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="http://localhost/tuthien/assets/images/post-15.jpg" alt="IMG">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            Donec metus orci, malesuada et lectus vitae
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                            Culture
                                                        </a>

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            Feb 12
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-lg-4">
                    <div class="p-l-10 p-rl-0-sr991 p-b-20">
                        <!--  -->
                        <div>
                            <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Most Popular
                                </h3>
                            </div>

                            <ul class="p-t-35">
                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                        1
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                    </a>
                                </li>

                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                        2
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Proin velit consectetur non neque
                                    </a>
                                </li>

                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                        3
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Nunc vestibulum, enim vitae condimentum volutpat lobortis ante
                                    </a>
                                </li>

                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                        4
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Proin velit justo consectetur non neque elementum
                                    </a>
                                </li>

                                <li class="flex-wr-sb-s p-b-22">
                                    <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0">
                                        5
                                    </div>

                                    <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                        Proin velit consectetur non neque
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!--  -->
                        <div class="flex-c-s p-t-8">
                            <a href="#">
                                <img class="max-w-full" src="http://localhost/tuthien/assets/images/banner-02.jpg" alt="IMG">
                            </a>
                        </div>

                        <!--  -->
                        <div class="p-t-50">
                            <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Stay Connected
                                </h3>
                            </div>

                            <ul class="p-t-35">
                                <li class="flex-wr-sb-c p-b-20">
                                    <a href="#" class="size-a-8 flex-c-c borad-3 size-a-8 bg-facebook fs-16 cl0 hov-cl0">
                                        <span class="fab fa-facebook-f"></span>
                                    </a>

                                    <div class="size-w-3 flex-wr-sb-c">
                                        <span class="f1-s-8 cl3 p-r-20">
                                            6879 Fans
                                        </span>

                                        <a href="#" class="f1-s-9 text-uppercase cl3 hov-cl10 trans-03">
                                            Like
                                        </a>
                                    </div>
                                </li>

                                <li class="flex-wr-sb-c p-b-20">
                                    <a href="#" class="size-a-8 flex-c-c borad-3 size-a-8 bg-twitter fs-16 cl0 hov-cl0">
                                        <span class="fab fa-twitter"></span>
                                    </a>

                                    <div class="size-w-3 flex-wr-sb-c">
                                        <span class="f1-s-8 cl3 p-r-20">
                                            568 Followers
                                        </span>

                                        <a href="#" class="f1-s-9 text-uppercase cl3 hov-cl10 trans-03">
                                            Follow
                                        </a>
                                    </div>
                                </li>

                                <li class="flex-wr-sb-c p-b-20">
                                    <a href="#" class="size-a-8 flex-c-c borad-3 size-a-8 bg-youtube fs-16 cl0 hov-cl0">
                                        <span class="fab fa-youtube"></span>
                                    </a>

                                    <div class="size-w-3 flex-wr-sb-c">
                                        <span class="f1-s-8 cl3 p-r-20">
                                            5039 Subscribers
                                        </span>

                                        <a href="#" class="f1-s-9 text-uppercase cl3 hov-cl10 trans-03">
                                            Subscribe
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <span class="fas fa-angle-up"></span>
        </span>
    </div>


<!--===============================================================================================-->
    {!! Html::script("assets/vendor/jquery/jquery-3.2.1.min.js") !!}
<!--===============================================================================================-->
    {!! Html::script("assets/vendor/animsition/js/animsition.min.js") !!}
<!--===============================================================================================-->
    {!! Html::script("assets/vendor/bootstrap/js/popper.js") !!}
    {!! Html::script("assets/vendor/bootstrap/js/bootstrap.min.js") !!}
<!--===============================================================================================-->
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    {!! Html::script("assets/js/mainnew.js") !!}
<script type="text/javascript">

$(document).ready(function() {
    $("#news-slider10").owlCarousel({
        items : 4,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        navigation:true,
        navigationText:["",""],
        pagination:true,
        autoPlay:true
    });
});




</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });

    var _url=$('#_url').val();
</script>
{{--Custom JavaScript Start--}}

@yield('script')

{{--Custom JavaScript End Here--}}
</body>
</html>