
@extends('frontEnd.layout')

@section('content')
 

 <?php
 $category_title_var = "title_" . trans('backbackLang.boxCode');
    $title_var = "title_" . trans('backLang.boxCode');
    $title_var2 = "title_" . trans('backLang.boxCodeOther');
    $details_var = "details_" . trans('backLang.boxCode');
    $details_var2 = "details_" . trans('backLang.boxCodeOther');
$title='';
$details='';
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
     if (isset($Topic->fields) && isset($Topic->fields[0])) {
         $backgroundImage=$Topic->fields[0]->field_value;
     }

 
   
    

    //dd($thisDetailMenu->parentMenus->);
    //  dd($Topic);
     // dd($Topics);
   
    
   
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
                                  
                                  <li class="active">{{ $title }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  
    @if(isset($Topic->fields) && isset($Topic->fields[1]))
        
          <?php 
       switch ($Topic->fields[1]->field_value) {
           case 1: //about
                ?> @include('frontEnd.sections.section_about') <?php
               break;
                 case 2: //messages
                 ?> @include('frontEnd.sections.section_messages')<?php
                      
               break;
                 case 3://QualityAssurance
                ?> @include('frontEnd.sections.section_QualityAssurance') <?php
              
               break;
                 case 4: //brandguidelines 
               ?>   @include('frontEnd.sections.section_brandguidelines')<?php
             
               break;
                 case 5://visionMission 
                ?>  @include('frontEnd.sections.section_visionMission')<?php
               
               break;
                 case 6: //content_only 
                ?>  @include('frontEnd.sections.section_content_only')<?php
               
               break;
                case 7: //image_only 
                ?> @include('frontEnd.sections.section_image_only')<?php
               
               break;
           
           default:
                ?> @include('frontEnd.sections.section_about') <?php
               break;
       }

          ?>
     @else
     
     @include('frontEnd.sections.section_about');      

    @endif
 
  

 
  



   @endif

   @endsection
 
 

   
  
 