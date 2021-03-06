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
                     <li><a href="{{url('services-quality')}}">Services & Quality</a><i class="fa fa-angle-right"></i></li>
                     <li><a href="{{url('services-quality/service-standards')}}">Quality Management Services</a><i class="fa fa-angle-right"></i></li>
                    <li class="">Address, telephone number to receive and resolve customer complaints
</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
                    <div class="article-left"><div class="article-item-name"><h1>Address, telephone number to receive and resolve customer complaints
</h1></div>
					<div class="article-item-content">
					{!! html_entity_decode($new->content_en) !!}
					</div>
</div>
        </div>
                </div><!--//faq-wrapper-->
                <aside class="page-sidebar col-sm-12 col-md-3" style="padding-left:0px">
                        <div id="article-item0" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/the-services-that-the-business-is-providing')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">The services that the business is providing</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('services-quality/service-standards/regular-standards-standard-apply-for-each-service')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Regular standards, standard apply for each service</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item2" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/announcement-of-the-quality-of-telecommunications-services')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Announcement of the quality of telecommunications services</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item3" class="article-list-item mone col-sm-4">
                           <a href="{{url('services-quality/service-standards/reporting-periodically-the-quality-of-telecommunications-services')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Reporting periodically the quality of telecommunications services</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/the-results-of-the-self-test-periodic-quality-of-telecommunications-services-and-results-of-self-test-quality-indicators-for-each-service')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">
The results of the self-test periodic quality of telecommunications services and results of self-test quality indicators for each service</div>
                              </div>
                           </a>
                        </div>
            <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/address-telephone-number-to-receive-and-resolve-customer-complaints')}}">
                              <div class="article-list-item-content article-select">
                                 <div class="article-list-name">Address, telephone number to receive and resolve customer complaints</div>
                              </div>
                           </a>
                        </div>
            
                        <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/process-of-receiving-and-resolving-customer-complaints')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Process of receiving and resolving customer complaints</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/customer-support-information')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Customer Support information</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/the-form-provides-service-information')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">The form provides service information</div>
                              </div>
                           </a>
                        </div>
                      <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/sample-contract-for-service-delivery')}}">
                              <div class="article-list-item-content">
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
@endsection