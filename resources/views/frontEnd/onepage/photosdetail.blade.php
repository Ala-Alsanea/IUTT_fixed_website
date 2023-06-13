
@extends('frontEnd.onepage.layout')
@section('styleInclude')
    <link href="{{secure_asset('plugins/css/materialize.css') }}" rel="stylesheet">
   <style type="text/css">
     nav i, nav [class^="mdi-"], nav [class*="mdi-"], nav i.material-icons {
    display: unset;
    font-size: unset;
    height:unset;
    line-height:unset;
}
@media only screen and (min-width: 601px){
  nav, nav .nav-wrapper i, nav a.button-collapse, nav a.button-collapse i {
    height: unset;
    line-height: unset;
}
}
.menu > .nav-item > .nav-link:hover {
    color: #fff !important;
}

   </style>
 @endsection
@section('content')

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

    ?>


 <section>
  <div class="page-title head-1" style="background-image: url({{ Helper::FilterImage($backgroundImage) }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-11 col-lg-11 page-title-container">
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
                         <li class=""><a href="{{  url(trans('backLang.code').'/'.$FacultyData->id.'/ourGallery/')  }}">{{ trans('frontLang.ourGallery') }}</a>
                                </li>
                        <li class="active">{{ $title }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





   <section>
         <div class="ed-res-bg">
        <div class="container clearfix com-sp eventpage">


      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ed-about-tit">
                        <div class="con-title">
                            <h2> {{ $title }}</h2>

                        </div>
                        <div>
     </div>


 <div class="cor about-sp">
                    <div class="ed-about-tit">
                   <div>
               <div class="cor about-sp h-gal ed-pho-gal">
                    <ul>



                       @if(count((array)$Topic->photos)>0)
                           @foreach($Topic->photos as  $photo)
                        <li><img class="materialboxed" data-caption="{{ $Topic->$title_var }}" src="{{ Helper::FilterImage($photo->file) }}" alt="{{ $Topic->$title_var }}">
                        </li>
                        @endforeach

                         @endif








                   </ul>
           </div>

       </div>
   </div>
</div>



        <hr>




            <div class="post_share">
                <div class="post-nam">Share:</div>
                <div class="flex">
                     <a href="{{ Helper::SocialShare("facebook", $PageTitle)}}" class="facebook"
                           data-placement="top"
                           title="Facebook" target="_blank"><i class="fa fa-facebook"></i>Facebook</a>
                <a href="{{ Helper::SocialShare("twitter", $PageTitle)}}" class="twitter"
                           data-placement="top" title="Twitter"
                           target="_blank"><i
                                    class="fa fa-twitter"></i>Twitter</a>
                 <a href="{{ Helper::SocialShare("google", $PageTitle)}}" class="google"
                           data-placement="top"
                           title="Google+"
                           target="_blank"><i
                                    class="fa fa-google-plus"></i>Google+</a>
            <a href="{{ Helper::SocialShare("linkedin", $PageTitle)}}" class="linkedin"
                           data-placement="top" title="linkedin"
                           target="_blank"><i
                                    class="fa fa-linkedin"></i>linkedin</a>
             <a href="{{ Helper::SocialShare("tumblr", $PageTitle)}}" class="pintrest"
                           data-placement="top" title="Pinterest"
                           target="_blank"><i
                                    class="fa fa-pinterest"></i>Pinterest</a>


                </div>
            </div>


        </div>
    </div>






    </section>



      @endif


@endsection
@section('footerInclude')
 <script src="{{secure_asset('plugins/js/materialize.min.js') }}"></script>


   @endsection




