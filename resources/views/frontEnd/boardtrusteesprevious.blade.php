
@extends('frontEnd.layout')

@section('content')
 

 
   <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/custm-people.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/new-custom.css') }}">
@if(count((array)$Topics)==0)
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
 $backgroundImage="uploads/banar.jpg";
     if (!empty($CurrentCategory->photo)) {
         $backgroundImage=$CurrentCategory->photo;
     }


?>
 
   <?php 
//dd('ddd');

 ?>
 <section>
  <div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_staff') }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ $name_section }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                    @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                 
                                  <li class="active">{{ $name_section }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 


    @if(count((array)$Topics)>0)
       <!--SECTION START-->
 <div class="main-holder">
 
        <div class="container inner-content com-sp pad-bot-70">
        
           <?php 
            $conterx=0;
          ?>
            <div class="row">

   <div class="common-members-block clear Academic Faculty">          
             <section id="team" class="team-area">
                
           

                <div class="ed-about-tit">
                        <div class="con-title">
                            <h2> {{ $name_section }}</h2>
                            
                        </div>
                    </div>
                 <div class="row team-items" style="margin:0">
                      @foreach($Topics as $Item)
                      
                                      
                                 <?php 
            
                         
                          if($conterx<1)
                      {

                              ?>     
                    
                  
                     
              <div class="col-md-4 single-item " style="min-width: 140px;    min-height: 362px;height: 100%">
                         
                         </div>
                     <div class="col-md-4 single-item">
                         <div class="item">
                             <div class="thumb">
                                 <img class="img-fluid" style="object-fit: contain;"  src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="">
                                 <div class="overlay">
                                    
                                     <?php

                                           $qualification='qualification_'.trans('backLang.boxCode');
                                           $major='major_'.trans('backLang.boxCode'); 
                                           $postion='postion_'.trans('backLang.boxCode');

                                         ?>
                                        @if ($Item->$qualification!='')
                                        {{--  <p><small><strong>{{ trans('frontLang.Qualification') }}:</strong> {!!   $Item->$qualification !!}</small></p> --}}
                                         @endif
                                
                                @if ($Item->$major!='')
                                         {{-- <p><small><strong>{{ trans('frontLang.Major') }}:</strong>{!!  $Item->$major !!}</small></p> --}}
                                         @endif

                                     
                                        {{--  {!!  $Item->$details_var !!} --}}
                                      
                                    
                                 </div>
                             </div>
                             <div class="info">
                                 <span class="message">
                                     <a href="{{ url(trans('backLang.boxCode').'/university/iutt/profile/'.$Item->id) }}"><i class="fas fa-envelope-open"></i></a>
                                 </span>
                                 <h4><a href="{{ url(trans('backLang.boxCode').'/university/iutt/profile/'.$Item->id) }}">{!!  $Item->$title_var !!}</a></h4>
                                 
                                         @if ($Item->$postion)
                                         <span>{!!  $Item->$postion !!}</span>
                                         @endif


                                       
                             </div>
                         </div>
                     </div>
                  <div class="col-md-4 single-item " style="min-width: 140px;    min-height: 362px;height: 100%">
                         
                         </div>
                <?php 
            }else{


                  ?>    
                                <div class="col-md-3 single-item">
                         <div class="item">
                             <div class="thumb">
                                 <img class="img-fluid" style="object-fit: contain;" src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="">
                                 <div class="overlay">
                                    
                                     <?php

                                           $qualification='qualification_'.trans('backLang.boxCode');
                                           $major='major_'.trans('backLang.boxCode'); 
                                           $postion='postion_'.trans('backLang.boxCode');

                                         ?>
                                        @if ($Item->$qualification!='')
                                         <p><small><strong>{{ trans('frontLang.Qualification') }}:</strong> {!!   $Item->$qualification !!}</small></p>
                                         @endif
                                
                                @if ($Item->$major!='')
                                         <p><small><strong>{{ trans('frontLang.Major') }}:</strong>{!!  $Item->$major !!}</small></p>
                                         @endif

                                     
                                         {!!  $Item->$details_var !!}
                                      
                                    
                                 </div>
                             </div>
                             <div class="info">
                                 <span class="message">
                                     <a href="{{ url(trans('backLang.boxCode').'/university/iutt/profile/'.$Item->id) }}"><i class="fas fa-envelope-open"></i></a>
                                 </span>
                                 <h4><a href="{{ url(trans('backLang.boxCode').'/university/iutt/profile/'.$Item->id) }}">{!!  $Item->$title_var !!}</a></h4>
                                 
                                         @if ($Item->$postion)
                                         <span>{!!  $Item->$postion !!}</span>
                                         @endif


                                       
                             </div>
                         </div>
                     </div>

                <?php 
           
                
                        }
                        $conterx+=1;
                          ?>  

                      @endforeach 





          
                 </div>
         
     </section>             
                   
 
 </div>
</div>
</div>
</div>


     @endif


@endif
@endsection
@section('footerInclude')

   

   @endsection
 

   
  
 