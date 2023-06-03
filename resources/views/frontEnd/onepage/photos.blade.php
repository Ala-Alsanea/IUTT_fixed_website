
@extends('frontEnd.onepage.layout')

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
 
   
    
    
    //dd($thisDetailMenu->parentMenus->);
    //  dd($Topic);
    //  dd($Topics);
   
    
   
    ?>

 
 
<style type="text/css">
  .ed-course-in a.course-overlay img{
        height: 250px;
  }
</style>

    
<section>
  <div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_photos') }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ trans('frontLang.ourGallery') }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ trans('frontLang.Home') }}</a></li>
                                 @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                  
                                  <li class="active">{{ trans('frontLang.ourGallery') }}
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
         <div class="ed-res-bg">
        <div class="container com-sp eventpage">

            <div class="row">
                 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ed-about-tit">
                        <div class="con-title">
                            <h2>{{ trans('frontLang.ourGallery') }}</h2>
                           
                        </div>
                   </div>
                 </div>
           
   <div class="ed-about-sec1 ed-course">
         
             @foreach($Topics as $key=> $Item)
        
           <div class="col-md-4">             
                <div class="ed-course-in">
                            <a class="course-overlay" title="{{ $Item->$title_var }}" href="{{ url(trans('backLang.code').'/'.$FacultyData->id.'/ourGallery/details/'.$Item->id) }}">
                                <img src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{{ $Item->$title_var }}">
                                <span>{{ $Item->$title_var }}</span>
                            </a>
                        </div>
                   
                 </div>
                      
                 @endforeach
                              
                             
      
                        </div>
              
                       
      </div>
             <div class="row"> 
                   <div class="pg-pagina">
                        <div class="col-lg-12">

                             {!! $Topics->links() !!}
                              <br>
                            <small>{{ $Topics->firstItem() }} - {{ $Topics->lastItem() }} {{ trans('backLang.of') }}
                                ( {{ $Topics->total()  }} ) {{ trans('backLang.records') }}</small>
                           
                        </div>
                        <div class="col-lg-4 text-center">
                           
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
 
 

   
  
 