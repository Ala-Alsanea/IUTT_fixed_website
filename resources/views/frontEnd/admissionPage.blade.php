
@extends('frontEnd.layout')

@section('content')
 
<?php
 
$titlePage='';
$details='';
 $backgroundImage="uploads/banar.jpg";
 
      $backgroundImage= Helper::getBannerStatic('Banner_contact_us_admissions');
   
   
 
    ?>
  
   
 
        
          <?php 
       switch ($PageNametype) {
              case 'topic': 
                  $backgroundImage= Helper::getBannerStatic('admissionsgenral');
               break;
                 case 'applnow':  
                      $breadcrumbTitle = trans('frontLang.Apply_Now');
                     $backgroundImage= Helper::getBannerStatic('Banner_applynow_admissions');
               break;
                 case 'contacts': 
                    $breadcrumbTitle = trans('frontLang.Contact_Us');
                  $backgroundImage= Helper::getBannerStatic('Banner_contact_us_admissions');
             
                   break;
             
           
           default:
                 $backgroundImage= Helper::getBannerStatic('admissionsgenral');
               break;
       }
 
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

<div class="page-title head-1" id="adhead1" style="background-image: url({{ Helper::FilterImage($backgroundImage) }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ $thisDetailMenu->$title_var }} </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                 @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                  
                                  <li class="active">{{ $thisDetailMenu->$title_var }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="main-holder">
   
        <div class="container inner-content com-sp pad-bot-70">
        
          
            <div class="row">
              
               @include('frontEnd.includes.leftmenu')

                <div class="col-sm-8 col-md-8 printable-version" style="background-color: #fff; padding: 10px;">
                   @switch($PageNametype)
                      @case('topic')
                         @include('frontEnd.view.admissions.admissionContent')
                          @break

                      @case($PageNametype)
                          @include('frontEnd.view.admissions.'.$PageNametype)
                          @break

                      @default
                           @include('frontEnd.view.admissions.admissionContent')
                  @endswitch



                    
                </div>
            </div>
        </div>
   
</div>


   @endsection
 
   
  @section('footerInclude')

@include('frontEnd.includes.scriptsubmit')  

  @endsection