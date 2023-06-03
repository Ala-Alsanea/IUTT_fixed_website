
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

    <style type="text/css">
        .ho-ev-link a h4 {
    color: #112842;
    padding-bottom: 5px;
    margin-bottom: 3px;
    border-bottom: 0px;
    text-overflow: ellipsis;
     white-space:unset; 
     overflow: visible; 
    letter-spacing: 0px;
}
.rtl .ho-ev-link{
    float: right; 
    margin-right: 50px;

}
.ho-ev-date{
padding: 7px 0;

}
    </style>
 
 

    
<section>
  <div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_events') }});">

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
                                  
                                  <li class="active">{{ trans('frontLang.Events_Activities') }}
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
        <div class="container com-sp eventpage">
            <div class="row">
                <div class="cor about-sp">
                    <div class="ed-about-tit">
                        <div class="con-title">
                            <h2>{{ trans('frontLang.Events_Activities') }}</h2>
                            <p>{{ trans('frontLang.events_messages_index') }}</p>
                        </div>
                        <div>
                            <div class="ho-event pg-eve-main">
                                <ul>
                                   @foreach($Topics as $key=> $Item)
                                    <li>
                                        <div class="ho-ev-date pg-eve-date">
                                             <span> <?php  echo date("d", strtotime($Item->date)); ?></span>
            <span> <?php echo date('Y ,M', strtotime($Item->date)); ?> </span>
                                        </div>
                                        <div class="ho-ev-link pg-eve-desc">
                                            <a href="">
                                                <h4>{{ $Item->$title_var }}</h4>
                                            </a>
                                           
                                           
                                        </div>
                                         
                                    </li>
                                     @endforeach
                              
                             
                               
                                   
                                </ul>
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
 
 
 
 <hr>
       <div class="ed-about-sec1">
                       <div class="ed-about-tit">
                        <div class="con-title">
                            <div class="share-btn blog-share-btn">
                                                <ul>
                                                    <li><a href="{{ Helper::SocialShare("facebook", $PageTitle)}}"><i class="fa fa-facebook fb1"></i> {{ trans('frontLang.ShareFacebook') }}</a>
                                                    </li>
                                                    <li><a href="{{ Helper::SocialShare("twitter", $PageTitle)}}"><i class="fa fa-twitter tw1"></i>  {{ trans('frontLang.ShareTwitter') }}</a>
                                                    </li>
                                                    <li><a href="{{ Helper::SocialShare("google", $PageTitle)}}"><i class="fa fa-google-plus gp1"></i>  {{ trans('frontLang.ShareGoogle') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                            
                        </div>
                    </div>
                    </div>
 


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
 
 

   
  
 