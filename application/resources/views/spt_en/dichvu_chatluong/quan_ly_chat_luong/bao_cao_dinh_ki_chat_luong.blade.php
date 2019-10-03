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
                    <li class="">Reporting periodically the quality of telecommunications services
</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
                    <div class="article-left"><div class="article-item-name"><h1>Reporting periodically the quality of telecommunications services

</h1></div>
					<div class="article-item-content">
                {!! html_entity_decode($new->content_en) !!}
                <?php 
          use App\Models\NewFileEn;
                  $listFile =NewFileEn::where('new_id',$new->id)->orderBy('id','desc')->get();
                  if(count($listFile)>0){
                ?>
                <div class="article-att">
                  <div class="gscah">Tài liệu đính kèm:</div>
                  <?php
                    foreach($listFile as $item){
                      $pathFile = dirname(base_path()).'/assets/files/'.$item->file_name;
                      $filesize = filesize($pathFile); // bytes
                      $filesize = round($filesize / 1024 / 1024, 2);
                  ?>
                  <div class="gsca">
                    <div class="gscai">
                    <div class="gscaic">
             <?php
            $pos = strpos($item->file_name,'pdf');
            if ($pos === false) {
             ?>
            <img src="{{URL::asset('assets/img/ico_docx.png')}}">
            <?php }else{?>
            <img src="{{URL::asset('assets/img/ico_pdf.png')}}">
            <?php }?>
                    </div>
                      <a href="{{url('client/download-file/'.$item->id)}}" target="_blank">{{$item->title}}</a><div class="gscais"><i>{{$filesize}}MB</i>
                      </div>
                    </div>
                  </div>
                <?php }?>
                  <!-- end one file -->
                </div>
              <?php }?>
                <!--end list file -->
              </div>
</div>
        </div>
                </div><!--//faq-wrapper-->
                <aside class="page-sidebar col-sm-12 col-md-3" style="padding-left:0px">
                        <div id="article-item0" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/reporting-service-quality-check-and-the-result-of-quality-checksum-for-quality-service')}}">
                              <div class="article-list-item-content  ">
                                 <div class="article-list-name">Report the test service quality and the result of the quality checksum for the quality service</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('services-quality/service-standards/customer-support-information')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Customer Support information</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item2" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/process-of-receiving-and-resolving-customer-complaints')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Process of receiving and resolving customer complaints</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item3" class="article-list-item mone col-sm-4">
                           <a href="{{url('services-quality/service-standards/address-telephone-number-to-receive-and-resolve-customer-complaints')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Address, telephone number to receive and resolve customer complaints</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/reporting-periodically-the-quality-of-telecommunications-services')}}">
                              <div class="article-list-item-content article-select">
                                 <div class="article-list-name">
Reporting periodically the quality of telecommunications services</div>
                              </div>
                           </a>
                        </div>
            <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/the-published-quality-of-SPT-service-is-provided')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">The published quality of SPT service is provided</div>
                              </div>
                           </a>
                        </div>
            <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('services-quality/service-standards/standards-technical-standards')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Standards - technical standards</div>
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