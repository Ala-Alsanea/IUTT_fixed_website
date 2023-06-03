<section class="event_about_area">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-5 col-md-5">
                <div class="event_about_img">
                    <img class="wow fadeInRight" data-wow-delay="0.2s" src="{{ Helper::FilterImage($FacultyData->photo_file) }}" alt=" {!! $FacultyData->$title_var !!}" />
                    <div class="about_bg"></div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="event_about_content">
                    <h2 class="wow fadeInUp"> {!! $FacultyData->$title_var !!}</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">
                       {!! $FacultyData->$details_var !!}
                    
                </div>
            </div>
        </div>
    </div>
</section>

 