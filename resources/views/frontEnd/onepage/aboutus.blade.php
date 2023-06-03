@extends('frontEnd.onepage.layout')

@section('content')
 
@section('styleInclude')
    
   
 @endsection
 
 <?php

  

     //dd($thisDetailMenu->parentMenus->);
    $backgroundImage="uploads/banar.jpg";
     if (isset($Topic->banner) && $Topic->banner!='' && $Topic->banner!='#') {
         $backgroundImage=$Topic->banner;
     }

 

//dd($quicklinks);

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
 
  <div class="page-title head-1" style="background-image: url({{ Helper::FilterImage($backgroundImage) }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-9 col-lg-9 page-title-container">
                        <div class="title-column">
                            <h1>{{ $Topic->$title_var }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ trans('frontLang.Home') }}</a></li>
                                   @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                       
                               <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ $FacultyData->$title_var }}</a></li>
                             <li class="active">{{ $Topic->$title_var }} </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="event_about_area">
    <div class="container">
       @if($Topic->photo_file!='' && $Topic->photo_file!='#')
        <div class="row align-items-center flex-row-reverse">

         
            <div class="col-lg-5">
                <div class="event_about_img">
                    <img class="wow fadeInRight" data-wow-delay="0.2s" src="{{ Helper::FilterImage($Topic->photo_file) }}" alt=" {!! $Topic->$title_var !!}" />
                    
                </div>
            </div>

            <div class="col-lg-7">
                <div class="event_about_content">
                    <h2 class="wow fadeInUp"> {!! $Topic->$title_var !!}</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">
                       {!! $Topic->$details_var !!}
                    </p>
                </div>
            </div>
        </div>
       @else

       <div class="row align-items-center flex-row-reverse">

         
           
            <div class="col-lg-12">
                <div class="event_about_content">
                    <h2 class="wow fadeInUp"> {!! $Topic->$title_var !!}</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">
                       {!! $Topic->$details_var !!}
                    </p>
                </div>
            </div>
        </div>

       @endif
    </div>
</section>




@endif

@endsection
@section('footerInclude')
  
   

   @endsection