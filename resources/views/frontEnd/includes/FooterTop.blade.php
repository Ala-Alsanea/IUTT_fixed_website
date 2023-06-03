   <footer class="section-fluid aos-init aos-animate" data-aos="fade-up" data-aos-delay="1" data-aos-duration="800">
 
   <div class="footer-top">
       <div class="container-fluid"> 
       <div class="row">
             <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                 
            
            <div class="footer-social">
                <ul class="social-panel s-link" style="">
                    @if($WebsiteSettings->social_link1)
                            <li><a href="{{$WebsiteSettings->social_link1}}" data-placement="top" title="Facebook"
                                   target="_blank"><i
                                            class="icon  fa fa-facebook"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link2)
                            <li><a href="{{$WebsiteSettings->social_link2}}" data-placement="top" title="Twitter"
                                   target="_blank"><i
                                            class="icon fa fa-twitter"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link3)
                            <li><a href="{{$WebsiteSettings->social_link3}}" data-placement="top" title="Google+"
                                   target="_blank"><i
                                            class="icon fa fa-google-plus"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link4)
                            <li><a href="{{$WebsiteSettings->social_link4}}" data-placement="top" title="linkedin"
                                   target="_blank"><i
                                            class="icon fa fa-linkedin"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link5)
                            <li><a href="{{$WebsiteSettings->social_link5}}" data-placement="top" title="Youtube"
                                   target="_blank"><i
                                            class="icon fa fa-youtube-play"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link6)
                            <li><a href="{{$WebsiteSettings->social_link6}}" data-placement="top" title="Instagram"
                                   target="_blank"><i
                                            class="icon fa fa-instagram"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link7)
                            <li><a href="{{$WebsiteSettings->social_link7}}" data-placement="top" title="Pinterest"
                                   target="_blank"><i
                                            class="icon fa fa-pinterest"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link8)
                            <li><a href="{{$WebsiteSettings->social_link8}}" data-placement="top" title="Tumblr"
                                   target="_blank"><i
                                            class="icon fa fa-tumblr"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link9)
                            <li><a href="{{$WebsiteSettings->social_link9}}" data-placement="top" title="Flickr"
                                   target="_blank"><i
                                            class="icon fa fa-flickr"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link10)
                            <li><a href="whatsapp://call?number={{$WebsiteSettings->social_link10}}"
                                   data-placement="top"
                                   title="Whatsapp" target="_blank"><i
                                            class="icon fa fa-whatsapp"></i></a></li>
                        @endif

               
                </ul>
                
            </div>
            </div>
             <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                 
           
            <div class="footer-call"><div class="f-working-time s-bub-link">
                        <h5 class="title c-second">{{ trans('backLang.worksTime') }}</h5>
                        <p class="time-show">
                            @if(Helper::GeneralSiteSettings("contact_t7_" . trans('backLang.boxCode'))!='')
                            <span class="c-white">{{ Helper::GeneralSiteSettings("contact_t7_" . trans('backLang.boxCode')) }}                      </span>

                                 @endif
                        </p>
                    </div>
            </div>
            
              </div>
       </div> 
            
         </div>
    </div>
    </div>
</footer>