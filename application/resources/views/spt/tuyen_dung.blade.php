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
                    <li class="current">Tuyển dụng
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
          <div class="list-items-wrap">
             <h1 style="margin-left: 20px;color: #113067;font-size:28px;padding-top: 16px">Tuyển dụng</h1>
             @foreach($news as $item)
          <div class="list-item-dem" style="margin-left:20px">
              <div class="row">
                
                <div class="col-md-10">
                  <div class="list-item-dem-header">
                    <a href="{{url('tuyen-dung/tuyen-dung-chi-tiet/'.$item->id.'/'.vn_to_str($item->title))}}">  
              
                {{$item->title}}
              </a>
                  </div>
                  <div class="article-item-list-date">
				  @if($item->created_date!='1970-01-01')
					{{date('d-m-Y',strtotime($item->created_date))}}
				  @endif
				  </div>
                  <div class="list-item-dem-description">
                    {!! html_entity_decode($item->summary) !!}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        <nav>
            {!! $news->render() !!}
        </nav>  
          </div>
        </div>
                </div><!--//faq-wrapper-->
                <aside class="page-sidebar col-md-3" style="padding-left:0px;margin-top: 20px;">
                        <div id="article-item0" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('gioi-thieu/tong-quan')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Tổng quan</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('gioi-thieu/lich-su-phat-trien')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Lịch sử phát triển</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item2" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('gioi-thieu/co-cau-to-chuc')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Cơ cấu tổ chức</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item3" class="article-list-item mone col-sm-4">
                           <a href="{{url('gioi-thieu/giai-thuong')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Giải thưởng</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('gioi-thieu/thuong-hieu')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Thương hiệu</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item5" class="article-list-item mone col-sm-4">
                           <a href="{{url('gioi-thieu/ebrochure')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">eBrochure</div>
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