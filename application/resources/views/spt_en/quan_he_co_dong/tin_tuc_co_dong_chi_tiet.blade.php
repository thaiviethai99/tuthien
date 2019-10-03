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
                     <li><a href="{{url('investor-relation')}}">Investor Relation</a><i class="fa fa-angle-right"></i></li>
                    <li><a href="{{url('investor-relation/corporate-announcements')}}">Corporate Announcements</a><i class="fa fa-angle-right"></i></li>
                    <li class="">{{$new->title_en}}

</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
                    <div class="article-left"><div class="article-item-name"><h1>{{$new->title_en}}

</h1></div>
					<div class="article-item-content">
					{!! html_entity_decode($new->content_en) !!}
					<?php 
					use App\Models\NewFileEn;
                  $listFile =NewFileEn::where('new_id',$new->id)->orderBy('id','desc')->get();
                  if(count($listFile)>0){
                ?>
                <div class="article-att">
                  <div class="gscah">Attachments:</div>
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
					</div>
</div>
        </div>
                </div><!--//faq-wrapper-->
                <aside class="page-sidebar col-md-3" style="padding-left:0px;">
                        <div id="article-item0" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('investor-relation/annual-reports')}}">
                              <div class="article-list-item-content ">
                                 <div class="article-list-name">Annual Reports</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('investor-relation/corporate-announcements')}}">
                              <div class="article-list-item-content article-select">
                                 <div class="article-list-name">Corporate Announcements</div>
                              </div>
                           </a>
                        </div>
            @foreach($qhcd as $item)
            <?php 
                                    $title=$item->title;
                                    $year=explode(' ',$title);
                                    $year=array_reverse($year);
                                    $year=$year[0];
                                    ?>
                        <div id="article-item2" class="article-list-item mtwo col-sm-4">
                          <a href="{{url('investor-relation/annual-general-meeting-detail/'.$item->id.'/annual-general-meeting-'.$year)}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Annual General Meeting 
                                    {{$year}}</div>
                              </div>
                           </a>
                        </div>
            @endforeach
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('investor-relation/strategic-shareholders/strategic-shareholders')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Strategic Shareholders</div>
                              </div>
                           </a>
                        </div>
            <div id="article-item1" class="article-list-item mone col-sm-4">
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
@endsection