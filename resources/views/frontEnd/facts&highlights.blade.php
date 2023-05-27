
@extends('frontEnd.layout')

@section('content')
<?php 
$FaLeftIcon='right';
$FaRightIcon='left'; 
if(trans('backLang.boxCode')=='ar'){
$FaLeftIcon='left';
$FaRightIcon='right';
}
 
?>

   <?php
     $Facts_Highlights=App\Models\Topic::where([['status', 1], ['webmaster_id',14]])->orderby('row_no', 'asc')->get();
          $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    $details_var2 = "details_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                     $file_var = "file_" . trans('backLang.boxCode');
                    $section_url = "";
 

    ?>


@if(count((array)$Facts_Highlights)==0)
<section class="process_area bg_color sec_pad about">
    <br><br>
 <div class="row">
                    <div class="col-sm-12">
                        <div class=" p-a text-center ">
                            {{ trans('backLang.noData') }}
                            <br>
                            <br>
                             
                               
                           
                        </div>
                    </div>
    </div>
</section>
@else




 <?php
    $title_var = "title_" . trans('backLang.boxCode');
    $title_var2 = "title_" . trans('backLang.boxCodeOther');
    $details_var = "details_" . trans('backLang.boxCode');
    $details_var2 = "details_" . trans('backLang.boxCodeOther');
   

   
    ?>
  
 <section>
  <div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_Facts_Highlights') }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ trans('frontLang.Facts_Highlights') }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                 <li><a>{{ trans('frontLang.About_University') }}</a></li>
                                  <li class="active">{{ trans('frontLang.Facts_Highlights') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 


    @if(count((array)$Facts_Highlights)>0)
 <section>
        <div class="container com-sp pad-bot-70">
            <div class="row">
                <div class="cor about-sp">
                    <div class="ed-about-tit">
                        <div class="con-title">
                            <h2>{{ trans('frontLang.Facts_Highlights') }}</h2>
                            <p>{{ trans('frontLang.Facts_Highlights_message') }}</p>
                        </div>
                    </div>
                    <div class="ed-about-sec1">
                        <div class="ed-advan">
                            <ul>
                                 @foreach($Facts_Highlights as $Item)
 
                                 <?php 
                                  $UrlTopic=url($Item->url_link);  
                                if ($Item->url_link=='' || $Item->url_link=='#') {
                                    $UrlTopic=url(trans('backLang.boxCode').'/showdetails/'.$Item->id);  
                                }
                         

                                ?>
                                <li>
                                    <div class="ed-ad-img">
                                        <img src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{{ $Item->$title_var }}">
                                    </div>
                                    <div class="ed-ad-dec">
                                        <h4>{{ $Item->$title_var }}</h4>
                                        <p> {{ strip_tags($Item->$details_var)  }}
                                        </p>
                                         <a href="{{ $UrlTopic }}">{{ trans('frontLang.readMore') }}</a>
                                    </div>
                                </li>
                                @endforeach 
                                  
                            </ul>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </section>

     @endif


@endif
<hr>
       <div class="ed-about-sec1">
                       <div class="ed-about-tit">
                        <div class="con-title">
                            <div class="share-btn blog-share-btn">
                                                <ul>
                                                    <li><a href="{{ Helper::SocialShare("facebook", $PageTitle)}}"><i class="fa fa-facebook fb1"></i> {{ trans('frontLang.ShareFacebook') }}</a>
                                                    </li>
                                                    <li><a href="{{ Helper::SocialShare("twitter", $PageTitle)}}"><i class="fa fa-twitter tw1"></i>  {{ trans('frontLang.ShareTwitter') }}</a>
                                                    </li>
                                                    <li><a href="{{ Helper::SocialShare("google", $PageTitle)}}"><i class="fa fa-google-plus gp1"></i>  {{ trans('frontLang.ShareGoogle') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                            
                        </div>
                    </div>
                    </div>
@endsection
@section('footerInclude')

   

   @endsection
 

   
  
 