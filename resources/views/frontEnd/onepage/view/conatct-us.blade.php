<style type="text/css">
 .event_location_area .map #google-map {
    position: absolute;
    height: 100%;
    width: 100%;
    border: 0px;
    z-index: 1;
}
 
</style>
<section class="event_location_area">
    <div class="map">
      @if(count((array)$ContactUsData->maps) >0) 
        {{-- <iframe class="actAsDiv" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15393.616334015082!2d44.1716558!3d15.3002599!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc077282656bcc8db!2sTwintech%20University!5e0!3m2!1sen!2s!4v1606767153474!5m2!1sen!2s"></iframe> --}}
         <div id="google-map" class="actAsDiv"></div>
         @endif
    </div>
    <div class="container">
        <div class="event_location">
            <div class="contact_info_item">
                <h6>{{ trans('frontLang.ContactInfos') }}</h6>
                @if(trans('backLang.boxCode')=='en')
                 @if($FacultyData->addres_en!='')  
                <p> {{ $FacultyData->addres_en }} </p>
                @endif
                @else
                   
                 @if($FacultyData->addres_ar!='')  
                <p> {{ $FacultyData->addres_ar }} </p>
                @endif


                @endif
            </div>
            <div class="contact_info_item">
                <h6>{{ trans('frontLang.ContactInfos') }}</h6>
                 @if($FacultyData->email!='')  
                <p> {{ trans('frontLang.email') }}: <a href="emailto:{{ $FacultyData->email }}">{{ $FacultyData->email }}</a>  </p>
                 @endif
               @if($FacultyData->phone!='')  
                <p>{{ trans('frontLang.callPhone') }}:<a href="tel:{{ $FacultyData->phone }}">{{ $FacultyData->phone }}</a></p>
                 @endif
                 @if($FacultyData->fax!='')  
                <p>{{ trans('frontLang.callFax') }}:<a href="tel:{{ $FacultyData->fax }}">{{ $FacultyData->fax }}</a></p>
                 @endif
            </div>
            <div class="f_social_icon_two">
                  @if($WebsiteSettings->social_link1)
                       <a href="{{$WebsiteSettings->social_link1}}" data-placement="top" title="Facebook"
                                   target="_blank"><i class="ti-facebook"></i></a> 
                        @endif
                        @if($WebsiteSettings->social_link2)
                        <a href="{{$WebsiteSettings->social_link2}}" data-placement="top" title="Twitter"
                                   target="_blank"><i class="ti-twitter-alt"></i></a> 
                        @endif
                        @if($WebsiteSettings->social_link3)
                      <a href="{{$WebsiteSettings->social_link3}}" data-placement="top" title="Google+"
                                   target="_blank"><i
                                            class="icon fa fa-google-plus"></i></a> 
                        @endif
                        @if($WebsiteSettings->social_link4)
                           <a href="{{$WebsiteSettings->social_link4}}" data-placement="top" title="linkedin"
                                   target="_blank"><i
                                            class="icon fa fa-linkedin"></i></a> 
                        @endif
                        @if($WebsiteSettings->social_link5)
                            <a href="{{$WebsiteSettings->social_link5}}" data-placement="top" title="Youtube"
                                   target="_blank"><i
                                            class="icon fa fa-youtube-play"></i></a> 
                        @endif
                        @if($WebsiteSettings->social_link6)
                           <a href="{{$WebsiteSettings->social_link6}}" data-placement="top" title="Instagram"
                                   target="_blank"><i
                                            class="icon fa fa-instagram"></i></a> 
                        @endif
                        @if($WebsiteSettings->social_link7)
                            <a href="{{$WebsiteSettings->social_link7}}" data-placement="top" title="Pinterest"
                                   target="_blank"><i
                                            class="icon fa fa-pinterest"></i></a> 
                        @endif
                       
                       
                        @if($WebsiteSettings->social_link10)
                            <a href="whatsapp://call?number={{$WebsiteSettings->social_link10}}"
                                   data-placement="top"
                                   title="Whatsapp" target="_blank"><i
                                            class="icon fa fa-whatsapp"></i></a> 
                        @endif

                
            </div>
        </div>
    </div>
</section>
   