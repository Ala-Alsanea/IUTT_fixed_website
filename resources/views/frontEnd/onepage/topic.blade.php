
@extends('frontEnd.onepage.layout')

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

  
    
    if ($Topic->$title_var != "") {
        $title = $Topic->$title_var;
    } else {
        $title = $Topic->$title_var2;
    }
    if ($Topic->$details_var != "") {
        $details = $details_var;
    } else {
        $details = $details_var2;
    }
    $section = "";
    try {
        if ($Topic->section->$title_var != "") {
            $section = $Topic->section->$title_var;
        } else {
            $section = $Topic->section->$title_var2;
        }
    } catch (Exception $e) {
        $section = "";
    }

        
                        


    ?>


 

<style type="text/css">

</style>
 
  
 <section>
  <div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_news') }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-11 col-lg-11 page-title-container">
                        <div class="title-column">
                            <h1>{{ $FacultyData->$title_var }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                   <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ trans('frontLang.Home') }}</a></li>
              
                       
                        @if(count((array)$CurrentCategory) >0)
                            <?php
                            $category_title_var = "title_" . trans('backLang.boxCode');
                            ?>
                            <li class="">{{ $CurrentCategory->$category_title_var }}</li>
                            
                        @endif
                        <li class="active">{{ $title }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 


 
  
   <!-- NEWS AND EVENTS -->
    <section>
        <div class="container com-sp">
            <div class="row">
                <div class="con-title">
                    <h2> {{ $FacultyData->$title_var }}</h2>
                   
                </div>
            </div>
            <div class="row">
               
              
    <div class="col-lg-8 blog_sidebar_left">
    <div class="blog_single mb_50">
        <img class="img-fluid" src="{{ Helper::FilterImage($Topic->photo_file) }}" alt="{{ $title }}" />
        <div class="blog_content">
            <div class="post_date">
                <h2> <?php  echo date("d", strtotime($Topic->date)); ?> <span><?php  echo date("Y ,M", strtotime($Topic->date)); ?></span></h2>
            </div>
              <div class="process_area  sec_pad">
            <div class="entry_post_info hidden">
                By: <a href="{{  url(trans('backLang.code').'/'.$FacultyData->id.'/news/faculty/'.$Topic->id) }}">{{$Topic->user->name}}</a>
                
                
            </div>
            <a href="{{   url(trans('backLang.code').'/'.$FacultyData->id.'/news/faculty/'.$Topic->id)  }}">
                <h5 class="f_p f_size_20 f_500 t_color mb-30">{{ $title }}</h5>
            </a>
  
            {!! $Topic->$details !!}
        </div>

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
                             <li><a href="{{ Helper::SocialShare("linkedin", $PageTitle)}}"><i class="fa fa-linkedin"></i>  {{ trans('frontLang.Sharelinkedin') }}</a>
                            </li>
                              <li><a href="{{ Helper::SocialShare("whatsapp", $PageTitle)}}"><i class="fa fa-whatsapp"></i>  {{ trans('frontLang.Sharewhatsapp') }}</a>
                            </li>
                        </ul>
                    </div>
                             
                        </div>
                    </div>
                    </div>

      {{--       <div class="post_share">
                <div class="post-nam">Share:</div>
                <div class="flex">
                     <a href="{{ Helper::SocialShare("facebook", $PageTitle)}}" class="facebook"
                           data-placement="top"
                           title="Facebook" target="_blank"><i class="fa fa-facebook"></i>Facebook</a> 
                <a href="{{ Helper::SocialShare("twitter", $PageTitle)}}" class="twitter"
                           data-placement="top" title="Twitter"
                           target="_blank"><i
                                    class="fa fa-twitter"></i>Twitter</a> 
                 <a href="{{ Helper::SocialShare("google", $PageTitle)}}" class="google"
                           data-placement="top"
                           title="Google+"
                           target="_blank"><i
                                    class="fa fa-google-plus"></i>Google+</a> 
            <a href="{{ Helper::SocialShare("linkedin", $PageTitle)}}" class="linkedin"
                           data-placement="top" title="linkedin"
                           target="_blank"><i
                                    class="fa fa-linkedin"></i>linkedin</a> 
             <a href="{{ Helper::SocialShare("tumblr", $PageTitle)}}" class="pintrest"
                           data-placement="top" title="Pinterest"
                           target="_blank"><i
                                    class="fa fa-pinterest"></i>Pinterest</a> 

                   
                </div>
            </div> --}}
          
          
        </div>
    </div>
 
 
     </div>
                <div class="col-md-4">

                @include('frontEnd.onepage.layout.blog-sidebar')


                </div>
            </div>
        </div>
    </section>
 


   

 
@endsection
@section('footerInclude')

   

   @endsection
 

   
  
 