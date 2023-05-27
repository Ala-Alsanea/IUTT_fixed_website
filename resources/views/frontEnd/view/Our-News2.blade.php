@if(count($LatestNews)>0)

  <?php
                    $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    $details_var2 = "details_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                    $section_url = "";
                    ?>
<section class="wed-ser-bg" style="background-color: #fff;">
    <div class=" com-sp pad-bot-0">
    <div class="container">
       <div class="news-blk desktoponly">
            <div class="bg">
                <div class="wrapper"></div>
            </div>
            <div class="wrapper content">
                <div class="ed-about-tit">
                    <div class="con-title">
                        <h2> <span> {{ trans('frontLang.News') }}</span>&nbsp;{{ trans('frontLang.University') }}</h2>
                    </div>
                </div>

                <div class="posts clear">
                      @foreach($LatestNews as $key => $HomeTopic)
<?php 
                          $topic_link_url = url(trans('backLang.code').'/news/topic/'.$HomeTopic->id);
                        if ($HomeTopic->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $topic_link_url = url(trans('backLang.code') . "/" . $HomeTopic->$slug_var);
                            } else {
                                $topic_link_url = url($HomeTopic->$slug_var);
                            }
                        }  
   

?>
              @if($key==0)
                      <div class="post post-3 clear">
                        <div class="img">
                            <a href="{{ $topic_link_url }}" title="{{ $HomeTopic->$title_var }}">
                                <img class="image-1" src="{{ Helper::FilterImage($HomeTopic->photo_file) }}" alt="{{ $HomeTopic->$title_var }}">
                            </a>
                            <a href="{{ $topic_link_url }}" title="{{ $HomeTopic->$title_var }}">
                                <img class="image-2" src="{{ Helper::FilterImage($HomeTopic->photo_file) }}">
                            </a>
                        </div>
                        <div class="text">
                            <!-- Developer note : Limit the text length of title and description -->
                            <div class="inner">
                                <span class="title"><a href="{{ $topic_link_url }}">{{ $HomeTopic->$title_var }}</a></span>

                                <p><a href="{{ $topic_link_url }}">  {{ trans('frontLang.readMore') }}  </a></p>
                            </div>
                        </div>
                    </div>


                        @else




                    <div class="post post-{{ $key }} clear">
                        <div class="img">
                            <a href="{{ $topic_link_url }}" title="{{ $HomeTopic->$title_var }}"><img class="image-1" src="{{ Helper::FilterImage($HomeTopic->photo_file) }}" alt="{{ $HomeTopic->$title_var }}"></a>
                            <a href="{{ $topic_link_url }}" title="{{ $HomeTopic->$title_var }}">
                                <img class="image-2" src="{{ Helper::FilterImage($HomeTopic->photo_file) }}" alt="{{ $HomeTopic->$title_var }}">
                            </a>
                        </div>
                        <div class="text">
                            <!-- Developer note : Limit the text length of title and description -->
                            <div class="inner">
                                <span class="title"><a href="{{ $HomeTopic->$title_var }}">{{ $HomeTopic->$title_var }}</a></span>
                               
                                <p><a href="{{ $topic_link_url }}"> {{ trans('frontLang.readMore') }}</a></p>
                            </div>
                        </div>
                    </div>

                     @endif

                    @endforeach

                  

                 
                </div> 



                <div style="
    border-bottom: 0px solid #dcdcdc;
    padding: 0px 0px;
    min-height: 23px;
    margin: 0px;
" class="" c="">

    <?php 
$FaLeftIcon='right';
$FaRightIcon='left'; 
if(trans('backLang.boxCode')=='ar'){
$FaLeftIcon='left';
$FaRightIcon='right';
}

?>

                                        <div class="col-md-12 " style="text-align: {{ $FaLeftIcon }};background-color: #222831;min-height: 29px;vertical-align: middle;margin-top: -5px;">
           <a class="" href="{{ url(trans('backLang.boxCode').'/news') }}" style="
   
      float: {{ $FaRightIcon }}
    text-align: center;    color: #fff !important;
">{{ trans('frontLang.Load_More') }}...
                                                <i class="fa fa-chevron-{{ $FaLeftIcon }}" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
             
            </div>
        </div>

<div class="row mobilonly">
    <div class="col-md-12" style="border-bottom: 0px solid #dcdcdc; padding-bottom: 22px; padding-top: 14px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
    <!--<div class="ho-ex-title"><h4>Upcoming Event</h4></div>-->
    <div class="ho-ev-latest ho-ev-latest-bg-2" style="background: url(https://themar-ye.com/noorlast/uploads/banner/2018092975832824.jpg) no-repeat; background-size: cover; padding: 51px;">
        <div class="ho-lat-ev">

            <h4>{{ trans('frontLang.University_News') }}</h4>
            <p>{{ trans('frontLang.University_News_message') }}</p>
        </div>
    </div>
    <div class="bot-gal h-blog ho-event row">
            @foreach($LatestNews as $key => $HomeTopic)
            <?php 
     $topic_link_url = url(trans('backLang.code').'/news/topic/'.$HomeTopic->id);
                        if ($HomeTopic->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $topic_link_url = url(trans('backLang.code') . "/" . $HomeTopic->$slug_var);
                            } else {
                                $topic_link_url = url($HomeTopic->$slug_var);
                            }
                        }  
   





?>
            <div style="border-bottom: 0px solid #dcdcdc; padding: 4px 0px;" class="col-sm-6">
                <div class="home-top-cour" style="margin-bottom: 3px;">
                    <!--POPULAR COURSES IMAGE-->
                    <div class="col-md-3"><img src="{{ Helper::FilterImage($HomeTopic->photo_file) }}" style="min-height: 110px; min-width: 130px;" alt=""></div>
                    <!--POPULAR COURSES: CONTENT-->
                    <div class="col-md-9 home-top-cour-desc">
                        <a href="{{ $topic_link_url }}"> <h5>
                            {{ str_limit(strip_tags($HomeTopic->$title_var), $limit =50, $end = '...') }}
                             </h5> </a>
                        <p>{{ str_limit(strip_tags($HomeTopic->$details_var), $limit =100, $end = '...') }}</p>
                        <span class="home-top-cour-rat">{{ $HomeTopic->date }}</span>
                        <div class="hom-list-share">
                            <ul>
                                <li>
                                    <a href="{{ $topic_link_url }}">
                                       More..
                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $topic_link_url }}"> <i class="fa fa-eye" aria-hidden="true"></i>{{ $HomeTopic->visits }}</a>
                                </li>
                                <li>
                                    <a href="{{ $topic_link_url }}"> <i class="fa fa-share-alt" aria-hidden="true"></i> 320 </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

           

            @endforeach
            
        
            <div style="border-bottom: 0px solid #dcdcdc; padding: 0px 0px; min-height: 23px; margin: 0px;" class="col-sm-6">
                <div class="col-md-12" style="text-align: right;">
                    <a class="home-top-cour-rat" href="{{ url(trans('backLang.boxCode').'/news') }}">
                        {{ trans('frontLang.Load_More') }}... 
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        
    </div>
</div>
</div>
    </div>
</div>
</section>



 

 @endif