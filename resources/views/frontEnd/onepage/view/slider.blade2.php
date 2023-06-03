
@if(count((array)$FacultyData->sliderfaculties)>0) 
        <?php
        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');
        $file1_var = "file1_" . trans('backLang.boxCode');
        $SliderBanner_type=1;
        ?>

 


<section class="saas_banner_area_three owl-carousel" dir="ltr">

     @foreach($FacultyData->sliderfaculties as $key=> $SliderBanner)
    <div class="slider_item">
        <img src="{{ Helper::FilterImage($SliderBanner->photo_file) }}" alt="{{ $SliderBanner->$title_var }}">
        <div class="container">
            <div class="slidet_content">
                @if($SliderBanner->$title_var!="")
                          <h2><?php  echo $SliderBanner->$title_var; ?></h2>
                             @endif

                @if($SliderBanner->$details_var !="")
                          <p>{{ $SliderBanner->$details_var }}</p>
                            @endif
                            @if($SliderBanner->url_link !="")  
                       <a href="{!! $SliderBanner->url_link !!}" class="slider_btn btn_hover">{{ trans('frontLang.moreDetails') }}</a>

                       @endif

             
            </div>
           
        </div>
    </div>
      @endforeach
 
   
</section>
 @endif