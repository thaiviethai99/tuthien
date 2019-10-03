@extends('client_menu_en')

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
                    <li><a href="{{url('/')}}">Home</a><i class="fa fa-angle-right"></i></li>
                    <li class="current">Contact Us</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header>
        </div>
        <div class="page-content">
            <div class="row page-row">
                <div class="faq-wrapper col-md-9 col-sm-12 col-xs-12">
                    <div class="main-content">
                        <div class="article-left">
                            <div class="article-item-name"><h1>Contact Us</h1></div>
              <div class=article-item-content>
                     <div class="contact-content"><p><span style="color: #034ea2;"><strong>SAIGON POSTEL CORP. - SPT</strong></span></p>
<p><span>Head office: </span>10 Co Giang, District 1</p>
<p>Ho Chi Minh City, Vietnam</p>
<p>Tel: (+84 28) 5444 9999<br>Fax: (+84 28) 5404 0609<br>E-mail:&nbsp;<a href="mailto: info@spt.vn">info@spt.vn</a></p><div class="contact-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1959.8028765321462!2d106.69700483034282!3d10.764836847665165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f15001b9083%3A0xf8ca95bbfdce9fc8!2zMTAgQ8O0IEdpYW5nLCBD4bqndSDDlG5nIEzDo25oLCBRdeG6rW4gMSwgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1444035581646" style="border:0" allowfullscreen="" width="355" height="350" frameborder="0"></iframe></div></div>
                     <div class=page-contact>
                        <div id=contactheader>Please fill out the form below to send us your request</div>
                        @include('notification.notify')
                        <div id=contact>
                           <form id = fm name=fm action="{{url('post-contact')}}" method="post">
                              <div id=contactitem>
                                 <div id=contactLabel>Name</div>
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
                                 <div id=contactLabel>Phone</div>
                                 <div id=contactinput>
                                    <div class=uinput><span><input type="text" id="mobile" name="mobile" value="{{old('mobile')}}"  ></span></div>
                                 </div>
                              </div>
                              <div id=contactitem>
                                 <div id=contactLabel>Subject</div>
                                 <div id=contactinput>
                                    <div class=uinput><span><input type="text" id="subject" name="subject" value="{{old('subject')}}"  ></span></div>
                                 </div>
                              </div>
                              <div id=contactitem>
                                 <div id=contactLabel>Contact with</div>
                                 <div id=contactinput>
                                    <select id="groupContactId" name="groupContactId" >
                                       @foreach($groupContact as $item)
									   <option value="{{$item->id}}">{{$item->name}}</option>
									   @endforeach
                                    </select>
                                    
                                 </div>
                              </div>
                              <div id=contactitem>
                                 <div id=contactLabel>Content</div>
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
                              <input type="submit" value="Send" class="btn btn-primary"/>
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
                           <a href="{{url('about-us/overview')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Overview</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item1" class="article-list-item mone col-sm-4">
                           <a href="{{url('about-us/key-milestones')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Key Milestones</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item2" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('about-us/corporate-structure')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Corporate Structure</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item3" class="article-list-item mone col-sm-4">
                           <a href="{{url('about-us/achievements-awards')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">Achievements & Awards</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item4" class="article-list-item mtwo col-sm-4">
                           <a href="{{url('about-us/the-brand')}}">
                              <div class="article-list-item-content">
                                 <div class="article-list-name">The Brand</div>
                              </div>
                           </a>
                        </div>
                        <div id="article-item5" class="article-list-item mone col-sm-4">
                           <a href="{{url('about-us/ebrochure')}}">
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