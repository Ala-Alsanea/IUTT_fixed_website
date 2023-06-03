
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
 
   
    
    
    //dd($thisDetailMenu->parentMenus->);
    //  dd($Topic);
    //  dd($Topics);
   
    
   
    ?>

 
 
 

    
<section>
  <div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_videos') }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ trans('frontLang.video_library') }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                 @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                  
                                  <li class="active">{{ trans('frontLang.video_library') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
  <section>
       
        <div class="container com-sp pad-bot-70 ed-res-bg">
            <div class="row">
              
            </div>
        </div>
        </div>
    </section>
  @if(count((array)$Topics)>0)
    <section>
         <div class="ed-res-bg">
        <div class="container com-sp eventpage">

            <div class="row">
                <div class="cor about-sp">
                    <div class="ed-about-tit">
                        <div class="con-title">
                            <h2>{{ trans('frontLang.video_library') }}</h2>
                            
                        </div>
                        <div>
                           <div class="row about-sp h-gal ed-pho-gal">
               

                    @foreach($Topics as $key=> $Topic)
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="video-container">
                                                    @if($Topic->video_type ==1)
                                                        <?php
                                                        $Youtube_id = Helper::Get_youtube_video_id($Topic->video_file);
                                                        ?>
                                                        @if($Youtube_id !="")
                                                            {{-- Youtube Video --}}
                                                            <iframe allowfullscreen
                                                                    src="https://www.youtube.com/embed/{{ $Youtube_id }}">
                                                            </iframe>
                                                        @endif
                                                    @elseif($Topic->video_type ==2)
                                                        <?php
                                                        $Vimeo_id = Helper::Get_vimeo_video_id($Topic->video_file);
                                                        ?>
                                                        @if($Vimeo_id !="")
                                                            {{-- Vimeo Video --}}
                                                            <iframe allowfullscreen
                                                                    src="http://player.vimeo.com/video/{{ $Vimeo_id }}?title=0&amp;byline=0">
                                                            </iframe>
                                                        @endif

                                                    @elseif($Topic->video_type ==3)
                                                        @if($Topic->video_file !="")
                                                            {{-- Embed Video --}}
                                                            {!! $Topic->video_file !!}
                                                        @endif

                                                    @else
                                                        <video width="100%" height="300" controls>
                                                            <source src="{{ Helper::FilterImage($Topic->video_file) }}"
                                                                    type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif


                                                </div>
                                              </div>

             
                 
                 
                 @endforeach
                              
                             
                               
                                   
                                 
                            </div>
                        </div>
              
                       
                    </div>
                </div>
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
 
 

   
  
 