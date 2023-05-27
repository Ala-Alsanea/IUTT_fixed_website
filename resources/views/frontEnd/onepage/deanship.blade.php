@extends('frontEnd.onepage.layout')

@section('content')
 
@section('styleInclude')
    
     
 @endsection
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/custm-people.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/new-custom.css') }}">
 <?php

  

     //dd($thisDetailMenu->parentMenus->);
   $backgroundImage="uploads/banar.jpg";
     if (isset($FacultyData->banner1) && $FacultyData->banner1!='' && $FacultyData->banner1!='#') {
         $backgroundImage=$FacultyData->banner1;
     }

 

//dd($quicklinks);

 ?>
 
 
  <div class="page-title head-1" style="background-image: url({{ Helper::FilterImage($backgroundImage) }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-9 col-lg-9 page-title-container">
                        <div class="title-column">
                            <h1>{{ trans('frontLang.deanship') }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ trans('frontLang.Home') }}</a></li>
                                   @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                       
                               <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ $FacultyData->$title_var }}</a></li>
                             <li class="active">{{ trans('frontLang.deanship') }} </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 

 
       <!--SECTION START-->
 <div class="main-holder">
 
        <div class="container inner-content com-sp pad-bot-70">
              
             @if(!empty($FacultyData->staffs))
            <div class="row">

   <div class="common-members-block clear col-lg-12 col-md-12  Academic Faculty team-area">          
            
        
            
                 <div class="row team-items">
                      <div class="col-md-4 single-item"></div>
                      @foreach($FacultyData->staffs as $Item)
                      
                                      
                                     
                  @if($Item->level_view==1)
                  
                  
                   
                     <div class="col-md-3 single-item">
                         <div class="item">
                             <div class="thumb">
                                 <img class="img-fluid" src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="">
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
                                     <a href="{{ url(trans('backLang.boxCode').'/faculty/profile/staff/'.$Item->id) }}"><i class="fas fa-envelope-open"></i></a>
                                 </span>
                                 <h4><a href="{{ url(trans('backLang.boxCode').'/faculty/profile/staff/'.$Item->id) }}">{!!  $Item->$title_var !!}</a></h4>
                                 
                                         @if ($Item->$postion)
                                         <span>{!!  $Item->$postion !!}</span>
                                         @endif


                                       
                             </div>
                         </div>
                     </div>
                   @endif
                 
                      @endforeach  
                 </div>
            <hr>
                   <div class="row team-items">
   @foreach($FacultyData->staffs as $Item)
                       
                     @if($Item->level_view>1)
                     <div class="col-md-3 single-item">
                         <div class="item">
                             <div class="thumb">
                                 <img class="img-fluid" src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="">
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
                                     <a href="{{ url(trans('backLang.boxCode').'/faculty/profile/staff/'.$Item->id) }}"><i class="fas fa-envelope-open"></i></a>
                                 </span>
                                 <h4><a href="{{ url(trans('backLang.boxCode').'/faculty/profile/staff/'.$Item->id) }}">{!!  $Item->$title_var !!}</a></h4>
                                 
                                         @if ($Item->$postion)
                                         <span>{!!  $Item->$postion !!}</span>
                                         @endif


                                       
                             </div>
                         </div>
                     </div>
                       @endif
                  
                 
                      @endforeach  


                   </div>
                
                   
 
 </div>
</div>

   @endif


  @if(!empty($FacultyData->employees))
          <hr>
            <div class="row">

   <div class=" col-lg-12 col-md-12 common-members-block clear Academic team-area Faculty">          
      
        
            
                 <div class="row team-items">
                      @foreach($FacultyData->employees as $Item)
                      
                                      
                                     
             
                     <div class="col-md-3 col-lg-3">
                         <div class="item">
                             <div class="thumb">
                                 <img class="img-fluid" src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="">
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
                                     <a href="{{ url(trans('backLang.boxCode').'/faculty/profile/staff/'.$Item->id) }}"><i class="fas fa-envelope-open"></i></a>
                                 </span>
                                 <h4><a href="{{ url(trans('backLang.boxCode').'/faculty/profile/staff/'.$Item->id) }}">{!!  $Item->$title_var !!}</a></h4>
                                 
                                         @if ($Item->$postion)
                                         <span>{!!  $Item->$postion !!}</span>
                                         @endif


                                       
                             </div>
                         </div>
                     </div>
                  
                 
                      @endforeach 





          
                 </div>
         
            
                   
 
 </div>
</div>

   @endif


</div>
</div>


  
 

@endsection
@section('footerInclude')
  
   

   @endsection