
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
@if(count((array)$Topic)==0)
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
   

    //dd($thisDetailMenu->parentMenus->);
    $backgroundImage="uploads/banar.jpg";
     if (isset($Topic->fields) && isset($Topic->fields[0])) {
         $backgroundImage=$Topic->fields[0]->field_value;
     }
    ?>
  <style type="text/css">
     .ltr .image_about{
        max-width:50%;
        float:left;  
            margin-right: 20px;
      }
       .rtl .image_about{
        max-width:50%;
        float:right;  
            margin-left: 20px;
      }
  </style>
 <section>
  <div class="page-title head-1" style="background-image: url({{ Helper::FilterImage($backgroundImage) }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ $title }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                   @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                       
                                  <li class="">{{ trans('backLang.'.$Topic->webmasterSection->name) }}</li>
                                  <li class="active">{{ $title }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 @if(!empty(strip_tags($Topic->$details_var)))
     
     @if($Topic->photo_file=='' || $Topic->photo_file=='#')
  <section class="event_about_area">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
          
            <div class="col-lg-6">
                <div class="event_about_content">
                    <h2 class="wow fadeInUp">  {{ $title }}</h2>
                    
                        
                        {!! $Topic->$details_var !!}
                   
                   
                </div>
            </div>
             
           
        </div>
    </div>
</section>
@else

<section class="process_area bg_color sec_pad about">
            <div class="container">
                <div class="welcome welcome-links">
 <h2 class="wow fadeInUp">  {{ $title }}</h2>
 <hr>
<div class="welcome-image">
 
</div>
         <div class="welcome-content">
                                
 
  <img alt=""  src="{{ Helper::FilterImage($Topic->photo_file) }}"  style=" " class="image_about">
{!! $Topic->$details_var !!}
 
 
  

 
                             
                            </div>

            </div>
        </section>  

        @endif


    @else
    
 <div class=""> 
                            <img src="{{ Helper::FilterImage($Topic->photo_file) }}" alt="{{ $title }}" class="img-cover">
                        </div>


 @endif





@endif
@endsection
@section('footerInclude')

   

   @endsection
 

   
  
