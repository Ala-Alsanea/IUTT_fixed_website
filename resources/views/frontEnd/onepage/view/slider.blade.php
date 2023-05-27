
@if(count((array)$FacultyData->sliderfaculties)>0) 
        <?php
        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');
        $file1_var = "file1_" . trans('backLang.boxCode');
        $SliderBanner_type=1;
        ?>

 
<style type="text/css">
  .saas_banner_area_three img {
    max-height:500px; 
   /* min-height:500px;*/ 
  }

 
@media (max-width: 991px){
  .saas_banner_area_three .slider_item .slidet_content h2 {
    font-size: 16px;
}
}
 @media (max-width:768px){
  .saas_banner_area_three .slider_item{
      padding-bottom:unset;
  }
.saas_banner_area_three .slider_item .slidet_content{
    
    padding-top:unset;
    position: absolute;
    
    top: auto;
    bottom: 15%;
    
}
.saas_banner_area_three .slider_item .slidet_content .slider_btn {
    padding: 4px 15px; 
      font-size:14px; 
}
.saas_banner_area_three .slider_item .slidet_content p{
  font-size:14px; 
}
}
 @media (max-width: 576px){
  .saas_banner_area_three .slider_item {
   /* padding-bottom: 100px;*/
    padding-bottom:unset;
    
}
.wed-logo-section img {
    display: inline-block;
    max-width: 257px;
}

  .saas_banner_area_three .slider_item .container {
/*  display:none; */
}
 }


</style>

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
                            @if($SliderBanner->url_link !="" && $SliderBanner->url_link !="#")  
                       <a href="{!! $SliderBanner->url_link !!}" class="slider_btn btn_hover">{{ trans('frontLang.moreDetails') }}</a>

                       @endif

             
            </div>
           
        </div>
    </div>
      @endforeach
 
   
</section>
 @endif