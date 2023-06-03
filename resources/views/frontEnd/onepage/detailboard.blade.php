@extends('frontEnd.onepage.layout')
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
                    <div class="col-md-9 col-lg-9 page-title-container">
                        <div class="title-column">
                            <h1>{{ $title }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ trans('frontLang.Home') }}</a></li>
                                   @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                       
                                  <li class="">{{ $name_section }}</li>
                                  <li class="active">{{ $title }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
     <style type="text/css">
      .nav-tabs{
        width:100%; 
      }
       .nav-tabs > li{
        float:none; 
            margin-bottom: 4px;
       }
   .nav-tabs > li  a {
   
 
}  
  .ltr .nav-tabs > li.active > a,.ltr .nav-tabs > li.active > a:hover,.ltr .nav-tabs > li.active > a:focus {
    color: #333;
    cursor: default;
    background-color: #ffffff;
    border: 1px solid #dcdbdb  !important;
    border-left-color: transparent  !important;
}

     .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #333;
    cursor: default;
    background-color: #ffffff;
    border: 1px solid #dcdbdb  !important;
    border-left-color: transparent  !important;
}
.event_about_area ul li a {
    font-weight: 500;
    background-color: #eee;
    padding: 10px;
}
.rtl .contenPostion{
  margin-right:20px; 
}
.ltr .contenPostion{
    margin-left:20px; 
}
.event_about_area img{
  width:100%;
  max-height:600px;  
}

@media (min-width: 768px){
  .navbar-right {
    float: right !important;
    margin-right: -15px;
}
}


     </style>

   
  <section class="event_about_area">
    <div class="container">
        <div class="row">
        
            <div class="col-lg-4">
                 <ul class="nav nav-tabs software_service_tab">
                                    <li class="active nav-item">
                                       <a data-toggle="tab" href="#home" class="nav-link">
                                          <span>{{ trans('frontLang.Home') }} </span>
                                      </a>
                                    </li>
                                    <li class="nav-item">
                                      <a data-toggle="tab" href="#Publications" class="nav-link">
                                      <span>{{ trans('frontLang.Publications') }}</span>
                                    </a>
                                  </li>
                                   <li class="nav-item">
                                      <a data-toggle="tab" href="#Experiences" class="nav-link">
                                      <span>{{ trans('frontLang.Experiences') }}</span>
                                    </a>
                                  </li>
                                    <li class="nav-item"><a data-toggle="tab" href="#Courses" class="nav-link">
                                   
                                      <span>{{ trans('frontLang.Courses') }}</span>
                                    </a>
                                  </li>
                                    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#Activities">
                                      <span>{{ trans('frontLang.Activities') }}</span>
                                    </a>
                                  </li>
                                </ul>
                
            </div>
              <div class="col-lg-8">

                           
                                 
                      <?php 
                      
 

                   $qualification='qualification_'.trans('backLang.boxCode');
                   $major='major_'.trans('backLang.boxCode'); 
                   $postion='postion_'.trans('backLang.boxCode');
                   $address='address_'.trans('backLang.boxCode');
                   $publications='publications_'.trans('backLang.boxCode');
                   $Experiences='Experiences_'.trans('backLang.boxCode');
                   $Courses='Courses_'.trans('backLang.boxCode');
                   $Activities='Activities_'.trans('backLang.boxCode');
 
                        


                       ?>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane  active">
                                  <h4>{!!  $Topic->$title_var !!}</h4>
                                     @if ($Topic->$postion!='')
                                        <p class="contenPostion"><strong>{!!  $Topic->$postion !!}</strong></p>
                                         @endif
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-xs-12">
                                                <img class="img-fluid" src="{{ Helper::FilterImage($Topic->photo_file) }}" alt="{!!  $Topic->$title_var !!}" style="">
                                            </div>
                                      <div class="col-lg-8 col-md-8 col-xs-12">
                                 {{--        {{ trans('frontLang.ContactInformation') }} --}}
                                        

                                     @if ($Topic->$qualification!='')
                                         <p><strong>{{ trans('frontLang.Qualification') }}:</strong> {!!  $Topic->$qualification !!}</p>
                                         @endif
                                     @if ( $Topic->$major!='')
                                         <p><strong>{{ trans('frontLang.Major') }}:</strong>{!!   $Topic->$major !!}</p>
                                         @endif

                                          @if ( $Topic->$address!='')
                                         <p><strong>{{ trans('frontLang.address') }}:</strong> {!!   $Topic->$address !!}</p>
                                         @endif
                                     
                                        @if ($Topic->email!='')
                                         <p><strong>{{ trans('frontLang.email') }}:</strong>{!!   $Topic->email !!}</p>
                                         @endif

                                      @if ( $Topic->attach_file!='')
                                         <p><strong>{{ trans('frontLang.cv_teacher') }}:</strong> <a href="{{ Helper::FilterImage($Topic->attach_file) }}">{{ trans('frontLang.download_now') }}</a></p>
                                         @endif
                                          


                                        {!! $Topic->$details_var !!}
                                              
                                            </div>
                                        </div>
                                     
                                       
                                       
                                    </div>
                                     <div id="Publications" class="tab-pane">
                                             <h4>{{ trans('frontLang.Publications') }}</h4>
                                              <hr>

                                       
                                       {!!   $Topic->$publications !!}
                                       

                                      
                                      
                                    </div>

                                     <div id="Experiences" class="tab-pane">
                                       <h4>{{ trans('frontLang.Experiences') }}</h4>
                                      
                                       {!!   $Topic->$Experiences !!}
                                     
                                    

                                       
                                    </div>
                                      <div id="Courses" class="tab-pane">
                                        <h4>{{ trans('frontLang.Courses') }}</h4>
                                         <hr>
                                       
                                       {!!   $Topic->$Courses !!}
                                    
                                        
                                    </div>
                                     <div id="Activities" class="tab-pane">
                                       <h4>{{ trans('frontLang.Activities') }}</h4>
                                        <hr>
                                     
                                       {!!   $Topic->$Activities !!}
                                       
                                       
                                    </div>

                        </div>
                      </div>
             
           
        </div>
    </div>
</section>
 
    

@endif
@endsection
@section('footerInclude')

   

   @endsection
  


