@extends('client_menu')

{{--External Style Section--}}
@section('style')
@endsection


@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="content container">
    <div class="page-wrapper">
        <div class="row">
        <header class="page-heading clearfix">
            <div class="breadcrumbs pull-left">
                <ul class="breadcrumbs-list">
                    <li><a href="{{url('/')}}">Trang chủ</a><i class="fa fa-angle-right"></i></li>
                    <li class="current">Liên hệ</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
                        <div class="article-left">
                            <div class="article-item-name"><h1>Liên hệ</h1></div>
              <div class=article-item-content>
                     <div class=contact-content>
                        <p><strong style="color: #034ea2;">SAIGON POSTEL CORP. </strong><span style="color: #034ea2;">-</span><strong style="color: #034ea2;"> SPT</strong></p>
                        <p>Trụ sở ch&iacute;nh:&nbsp;<span>10 C&ocirc; Giang, P. Cầu &Ocirc;ng L&atilde;nh,&nbsp;</span></p>
                        <p>Qu&acirc;̣n 1, TP.HCM</p>
                        <p>Tel: (+84 28) 5444 9999<br />Fax: (+84 28) 5404 0609<br />Email: <a href="mailto:info@spt.vn">info@spt.vn</a>&nbsp;<br /><br /></p>
                        <div class=contact-map><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1959.8028765321462!2d106.69700483034282!3d10.764836847665165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f15001b9083%3A0xf8ca95bbfdce9fc8!2zMTAgQ8O0IEdpYW5nLCBD4bqndSDDlG5nIEzDo25oLCBRdeG6rW4gMSwgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1444035581646" width="355" height="350" frameborder="0" style="border:0" allowfullscreen></iframe></div>
                     </div>
                     <div class=page-contact>
                        <div id=contactheader>Quý khách có thể liên hệ với chúng tôi bằng cách điền thông tin vào mẫu dưới đây</div>
                        @include('notification.notify')
                        <div id=contact>
                           <form id = fm name=fm action="{{url('gui-lien-he')}}" method="post">
                              <div id=contactitem>
                                 <div id=contactLabel>Quý danh</div>
                                 <div id=contactinput>
                                    <div class=uinput><span><input type="text" id="name" name="name" value="{{old('name')}}"  ></span></div>
                                 </div>
                              </div>
                              <div id=contactitem>
                                 <div id=contactLabel>Email</div>
                                 <div id=contactinput>
                                    <div class=uinput><span><input type="text" id="email" name="email" value="{{old('email')}}"  ></span></div>
                                 </div>
                              </div>
                              <div id=contactitem>
                                 <div id=contactLabel>Điện thoại</div>
                                 <div id=contactinput>
                                    <div class=uinput><span><input type="text" id="mobile" name="mobile" value="{{old('mobile')}}"  ></span></div>
                                 </div>
                              </div>
                              <div id=contactitem>
                                 <div id=contactLabel>Tiêu đề</div>
                                 <div id=contactinput>
                                    <div class=uinput><span><input type="text" id="subject" name="subject" value="{{old('subject')}}"  ></span></div>
                                 </div>
                              </div>
                              <div id=contactitem>
                                 <div id=contactLabel>Về vấn đề</div>
                                 <div id=contactinput>
                                    <select id="groupContactId" name="groupContactId" >
                                       @foreach($groupContact as $item)
									   <option value="{{$item->id}}">{{$item->name}}</option>
									   @endforeach
                                    </select>
                                    
                                 </div>
                              </div>
                              <div id=contactitem>
                                 <div id=contactLabel>Nội dung</div>
                                 <div id=contactcontent>
                                    <textarea name="content" id="content" >{{old('content')}}</textarea>
                                 </div>
                              </div>
                              <div id=contactitem>
							  <div id=contactLabel>&nbsp;</div>
							  <div id=contactcontent>
							  <div id="g-recaptcha" class="g-recaptcha" data-sitekey="6LeDxGAUAAAAAA7axcymxCd8qW8cghIkXNabJMgt" data-expired-callback="recaptchaCallback"></div>

                                <noscript>
                                    <div style="">
                                        <div style="width: 100%; height: 352px; position: relative;">
                                            <div style="width: 100%; height: 352px; position: absolute;">
                                                <!-- change YOUR_SITE_KEY with your google recaptcha key -->
                                                <iframe src="https://www.google.com/recaptcha/api/fallback?k=6LeDxGAUAAAAAA7axcymxCd8qW8cghIkXNabJMgt" style="width: 302px; height:352px; border-style: none;">
                                                </iframe>
                                            </div>
                                            <div style="width: 250px; height: 80px; position: absolute; border-style: none; bottom: 21px; left: 25px; margin: 0px; padding: 0px; right: 25px;">
                                                <textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 80px; border: 1px solid #c1c1c1; margin: 0px; padding: 0px; resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </noscript>
							  </div>
                                 
                                 
                              </div>
							  <div id=contactbutton>
                              <input type="submit" value="Gửi yêu cầu" class="btn btn-primary"/>
                           </div>
                           </form>
                           
                        </div>
						
                     </div>
                  </div>
</div>
        </div>
                </div><!--//faq-wrapper-->
               <aside class="page-sidebar col-sm-12 col-md-3" style="padding-left:0px">
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