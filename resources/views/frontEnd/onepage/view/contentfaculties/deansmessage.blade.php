       <div class="main-detail main-detail-1" style="display: block;padding-right: 10px">
         @if(count((array)$contentdeansmessage)>0)  
  @if($contentdeansmessage->photo_file!='' && $contentdeansmessage->photo_file!='#')
        
<section class="event_about_area">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-4">
                <div class="event_about_img">
                    <img class="wow fadeInRight" data-wow-delay="0" src="{{ Helper::FilterImage($contentdeansmessage->photo_file) }}" alt="{!! $contentdeansmessage->$title_var !!}" style="visibility: visible; animation-delay: 0s; animation-name: fadeInRight;">
                    <div class="about_bg"></div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="event_about_content" style="padding-right: 10px">
                    <h2 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;"> {!! $contentdeansmessage->$title_var !!}</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                     

                            {!! $contentdeansmessage->$details_var !!}
                    </p>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>

       @else

       <div class="row align-items-center flex-row-reverse">

         
           
            <div class="col-lg-12">
                <div class="event_about_content">
                    <h2 class="wow fadeInUp"> {!! $contentdeansmessage->$title_var !!}</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">
                       {!! $contentdeansmessage->$details_var !!}
                    </p>
                </div>
            </div>
        </div>

       @endif
                       

                       </div>

                          @endif