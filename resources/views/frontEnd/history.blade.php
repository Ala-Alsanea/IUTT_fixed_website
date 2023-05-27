
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
    if ($CurrentCategory->$title_var != "") {
        $title = $CurrentCategory->$title_var;
    } else {
        $title = $CurrentCategory->$title_var2;
    }
    if ($CurrentCategory->$details_var != "") {
        $details = $details_var;
    } else {
        $details = $details_var2;
    }
    $section = "";
    

   // dd($CurrentCategory);
    $backgroundImage="uploads/banar.jpg";
     if (!empty($CurrentCategory->photo)) {
         $backgroundImage=$CurrentCategory->photo;
     }
    ?>
  
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
                                  @if(count((array)$thisDetailMenu->parentMenus)>0)
                                         <li><a href="{{ ($thisDetailMenu->parentMenus->type==1)? url($thisDetailMenu->parentMenus->link):'#' }}">{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>
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
 
 
 

  @if(count((array)$Topics)>0)
 <section>
        <div class="container com-sp pad-bot-70">
            <div class="row">
                <div class="cor about-sp">

                    <div class="ed-about-tit">
                        <div class="con-title">
                            <h2>{{ $title }}</h2>
                            
                        </div>
                    </div>
                    <div class="s18-age-event l-info-pack-days">
                        <ul>

                             @foreach($Topics as $Item)
                            <li>
                                <div class="age-eve-com age-eve-1">
                                    <img src="{{ Helper::FilterImage($Item->photo_file) }}" alt="">
                                </div>
                                <div class="s17-eve-time">
                                    


                                    <div class="s17-eve-time-msg">
                                        <h4>{!! $Item->$title_var !!}</h4>
                                        <p>{!! $Item->$details_var !!}.</p>
                                    </div>
                                </div>
                            </li>

                              @endforeach
                            
 
 

                          
                            
                      

                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

@endif
@endif
@endsection
@section('footerInclude')

   

   @endsection
 

   
  
 