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
                     <li><a href="{{url('services-quality')}}">Services & Quality</a></li>
                    <li class="current">Quality Management Services</li>
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
                             <a href="{{url('services-quality/service-standards/the-services-that-the-business-is-providing')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">The services that the business is providing</div>
                                </div>
                             </a>
                          </div>
                           <div class="article-list-space"></div>
                           <div id="article-item5" class="article-list-item1 mone">
                             <a href="{{url('services-quality/service-standards/regular-standards-standard-apply-for-each-service')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Regular standards, standard apply for each service</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item5" class="article-list-item1 mone">
                             <a href="{{url('services-quality/service-standards/announcement-of-the-quality-of-telecommunications-services')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Announcement of the quality of telecommunications services</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item4" class="article-list-item1 mtwo">
                             <a href="{{url('services-quality/service-standards/reporting-periodically-the-quality-of-telecommunications-services')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">
Reporting periodically the quality of telecommunications services</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item0" class="article-list-item1 mtwo">
                             <a href="{{url('services-quality/service-standards/the-results-of-the-self-test-periodic-quality-of-telecommunications-services-and-results-of-self-test-quality-indicators-for-each-service')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">
The results of the self-test periodic quality of telecommunications services and results of self-test quality indicators for each service</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item3" class="article-list-item1 mone">
                             <a href="{{url('services-quality/service-standards/address-telephone-number-to-receive-and-resolve-customer-complaints')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Address, telephone number to receive and resolve customer complaints</div>
                                </div>
                             </a>
                          </div>
                          <div class="article-list-space"></div>
                          <div id="article-item2" class="article-list-item1 mtwo">
                             <a href="{{url('services-quality/service-standards/process-of-receiving-and-resolving-customer-complaints')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Process of receiving and resolving customer complaints</div>
                                </div>
                             </a>
                          </div>
                          <div id="article-item1" class="article-list-item1 mone">
                             <a href="{{url('services-quality/service-standards/customer-support-information')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Customer Support information</div>
                                </div>
                             </a>
                          </div>
						  <div class="article-list-space"></div>
						  <div id="article-item5" class="article-list-item1 mone">
                             <a href="{{url('services-quality/service-standards/the-form-provides-service-information')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">The form provides service information</div>
                                </div>
                             </a>
                          </div>
                <div class="article-list-space"></div>
              <div id="article-item5" class="article-list-item1 mone">
                             <a href="{{url('services-quality/service-standards/sample-contract-for-service-delivery')}}">
                                <div class="article-list-item-content list-background">
                                   <div class="article-list-name">Sample contract for service delivery</div>
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