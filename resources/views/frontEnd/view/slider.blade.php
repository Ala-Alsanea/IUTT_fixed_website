@if(count((array)$SliderBanners)>0)
 <?php 
           $AlingSlider='';
          if(trans('backLang.direction')=='ltr'){
             $AlingSlider='left';
          }elseif (trans('backLang.direction')=='rtl') {
             $AlingSlider='right' ;
          }
           $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    $details_var2 = "details_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                     $file_var = "file_" . trans('backLang.boxCode');
                    $section_url = "";
           ?>
<style type="text/css">
.carousel-control{
    left:unset; 
    width:100%; 
  }
  .left.carousel-control .fa{
  left:5px; 
  }
    .right.carousel-control .fa{
  right:5px; 
  }
</style>
  <section>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                   @foreach($SliderBanners as $key=> $SliderBanner)
                <div class="item  {{ ($key==0)?'active':'' }}">
                    <img src="{{ URL::to($SliderBanner->$file_var) }}" alt="{{ $SliderBanner->$title_var }}">
                    <div class="carousel-caption slider-con">
                              @if($SliderBanner->$title_var !="")
                          <h2>{!! $SliderBanner->$title_var !!}</h2>
                            @endif
                            
                            @if($SliderBanner->$details_var !="")
                      
                                 <p>{!! nl2br(e($SliderBanner->$details_var), false)  !!}</p>
                               @endif
                                @if($SliderBanner->url_link !="" && $SliderBanner->url_link !="#") 
                                
                       <a class="bann-btn-2" href="{!! $SliderBanner->link_url !!}">{{ trans('frontLang.moreDetails') }}</a>   
                       
                         @endif
                    </div>
                </div>
                 @endforeach 
               
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <i class="fa fa-chevron-left slider-arr"></i>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <i class="fa fa-chevron-right slider-arr"></i>
            </a>
        </div>
    </section>
  @endif