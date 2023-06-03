
@extends('frontEnd.layout')

@section('content')
<?php 
      $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    $details_var2 = "details_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                     $file_var = "file_" . trans('backLang.boxCode');
                    $section_url = "";
         $backgroundImage="uploads/banar.jpg";
         

?>

   
<style type="text/css">
  .main-holder {
    background-color: #f5f5f5;
}
  .content_faq{
    padding:30px;

  }
   .rtl .content_faq{
    /*padding-right:30px;*/
    
  }
</style>
<div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_faqs_page') }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ trans('frontLang.studentsservices') }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                 @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                  
                                  <li class="active">{{ trans('frontLang.studentsservices') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   @if(count((array)$Topics)>0)
    <section>
        <div class="container com-sp pad-bot-70">
            <div class="row">
                <div class="cor about-sp">
                    <div class="ed-about-tit">
                        <div class="con-title">
                            <h2>{{ trans('frontLang.studentsservices') }}</h2>
                          
                        </div>
                    </div>
                    <div class="ed-about-sec1">
                        <div class="row ed-advan2">
                            <ul>
                                @foreach($Topics as $key=> $Item) 

                                <?php 
                                  $UrlTopic=url($Item->url_link);  
                                if ($Item->url_link=='' || $Item->url_link=='#') {
                                    $UrlTopic=url(trans('backLang.boxCode').'/showdetails/'.$Item->id);  
                                }
                         

                                ?>
                                <li>
                                    <div class="ed-ad-img2">
                                        <img src="{{ Helper::FilterImage($Item->photo_file) }}" alt="  {!! $Item->$title_var !!}">
                                    </div>
                                    <div class="ed-ad-dec2">
                                        <h4>  {!! $Item->$title_var !!} </h4>
                                        <p>  {!! $Item->$title_var !!}
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

            <div class="ed-about-sec1">
                       <div class="ed-about-tit">
                        <div class="con-title">
                            <div class="share-btn blog-share-btn">
                                                <ul>
                                                    <li><a href="{{ Helper::SocialShare("facebook", $PageTitle)}}"><i class="fa fa-facebook fb1"></i> Share On Facebook</a>
                                                    </li>
                                                    <li><a href="{{ Helper::SocialShare("twitter", $PageTitle)}}"><i class="fa fa-twitter tw1"></i> Share On Twitter</a>
                                                    </li>
                                                    <li><a href="{{ Helper::SocialShare("whatsapp", $PageTitle)}}"><i class="fa fa-whatsapp gp1"></i>Share via WhatsApp</a>
                                                    </li>
                                                </ul>
                                            </div>
                            
                        </div>
                    </div>
                    </div>
        </div>
    </section>

 

 

@else



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


 

 





   @endif

   @endsection
 
   
  

