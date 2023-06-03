@extends('frontEnd.onepage.layout')

@section('content')

@section('styleInclude')

    <link rel="stylesheet" type="text/css" href="{{asset('plugins/css/new-custom.css') }}">
   <link rel="stylesheet" type="text/css" href="{{asset('plugins/css/custm-people.css') }}">
   <link href="{{asset('plugins/css/undergraduate-admissions.css') }}" type="text/css" rel="stylesheet"/>
   <link href="{{asset('plugins/css/college-of-health.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{asset('plugins/css/college-of-health-responsive.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{asset('plugins/css/undergraduate-admissions-responsive.css') }}" type="text/css" rel="stylesheet"/>
 @endsection
 <style>
table tr td {
    padding: 10px 15px;
    border: 1px solid #ccc;
}
.validation{
    display:none;
}

 </style>
  <style>
table tr td {
    padding: 10px 15px ;
    border: 1px solid #ccc !important;
}
.validation{
    display:none;
}
.main-detail table{
  margin:0 !important;
  margin-bottom:20px !important;
 border-style: inherit !important;
 width:100%  !important;
     border: 1px solid #ccc;
}
.contentsection{

  margin-bottom:30px;
}
 </style>
 <?php



     //dd($thisDetailMenu->parentMenus->);
    $backgroundImageTest="uploads/banar.jpg";
    $backgroundImage="uploads/banar.jpg";
     if ($FacultyData->banner2!='') {
         $backgroundImage=$FacultyData->banner2;
     }

       $deparmentsImage="uploads/banar.jpg";
     if ($FacultyData->banner3!='') {
         $deparmentsImage=$FacultyData->banner3;
     }
 $backgroundImagedeanship="uploads/banar.jpg";
     if (isset($FacultyData->banner1) && $FacultyData->banner1!='' && $FacultyData->banner1!='#') {
         $backgroundImagedeanship=$FacultyData->banner1;
     }
//dd($quicklinks);

 ?>
@if(count((array)$FacultyData)==0)
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
                            <h1>{{ $FacultyData->$title_var }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                   @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))

                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>



                                      @endif

                             <li class="">{{ $FacultyData->$title_var }} </li>
                             <li class="active">{{ trans('frontLang.about_us') }} </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="sec_pad">
 <div class="container">
    <div class="wrapper clear">
        <div class="main-image-tab-2 clear">

             <?php
            $Bannerdeansmessage="uploads/banar.jpg";
             if (!empty($contentdeansmessage)) {
                 $Bannerdeansmessage=$contentdeansmessage->banner;
             }

            ?>
              <?php
            $BannerVisonM="uploads/banar.jpg";
             if (!empty($contentsmestionvi) && isset($contentsmestionvi[0])) {
                 $BannerVisonM=$contentsmestionvi[0]->banner;
             }

            ?>
           <a href="javascript:void();">
                <div class="option  option-1 active" data-id="1" style="background:url({{ Helper::FilterImage($Bannerdeansmessage) }}) no-repeat center center; background-size:cover;">
                    <span class="about">{{ trans('frontLang.deansmessage') }}</span>
                </div>
            </a>
            <?php
            $BannerOverView="uploads/banar.jpg";
             if (!empty($contentsoverview) && isset($contentsoverview[0])) {
                 $BannerOverView=$contentsoverview[0]->banner;
             }

            ?>

              <a href="javascript:void();">
                <div class="option  option-2 " data-id="2" style="background:url({{ Helper::FilterImage($BannerOverView) }}) no-repeat center center; background-size:cover;">
                    <span class="about">{{ trans('frontLang.Overview') }}</span>
                </div>
            </a>

   <a href="javascript:void();">
                <div class="option option-3" data-id="3" style="background:url({{ Helper::FilterImage($BannerVisonM) }}) no-repeat center center; background-size:cover;">
                    <span class="People">{{ trans('frontLang.Vision_Mission') }}</span>
                </div>
            </a>
              <a href="javascript:void();">
                <div class="option option-4" data-id="4" style="background:url({{ Helper::getBannerStatic('Banner_People_departments') }}) no-repeat center center; background-size:cover;">
                    <span class="People">{{ trans('frontLang.People') }}</span>
                </div>
            </a>



           <a href="javascript:void();">
                <div class="option option-8" data-id="8" style="background:url({{ Helper::getBannerStatic('Banner_departments') }}) no-repeat center center; background-size:cover;">
                    <span class="departments">{{ trans('backLang.departments') }}</span>
                </div>
            </a>
            <a href="javascript:void();" >
                <div class="option option-9 " data-id="9" style="background:url({{ Helper::getBannerStatic('Banner_photos') }}) no-repeat center center; background-size:cover;">
                    <span class="scholarship">{{ trans('frontLang.mediafile') }}</span>
                </div>
            </a>

            <a href="javascript:void();">
                <div class="option option-10" data-id="10" style="background:url({{ Helper::getBannerStatic('Banner_Contact_Us_facultiy') }}) no-repeat center center; background-size:cover;">
                    <span class="departments">{{ trans('frontLang.Contact_Us') }}</span>
                </div>
            </a>
        </div>

           <div class="main-image-tab-2-details" id="main-page-details-2" style="min-height: 1000px;">
            <div class="first-row">
                <h2 class="title title-2  about" style="display: none;">{{ trans('frontLang.Overview') }}</h2>
                   <h2 class="title title-3  about" style="display: none;">{{ trans('frontLang.Vision_Mission') }}</h2>

                  <h2 class="title title-4 deanship" style="display: none;">{{ trans('frontLang.deanship') }}</h2>
                  <h2 class="title title-5 highlights" style="display: none;">{{ trans('frontLang.highlights') }}</h2>
                <h2 class="title title-6" style="display: none;">{{ trans('frontLang.coursedescriptions') }}</h2>
                <h2 class="title title-7" style="display: none;">{{ trans('frontLang.AcademicPlan') }}</h2>
                <h2 class="title title-8" style="display: none;">{{ trans('frontLang.departments') }}</h2>
                <h2 class="title title-9 mediafile" style="display: none;">{{ trans('frontLang.mediafile') }}</h2>

                <h2 class="title title-10 Contact_Us" style="display: none;">{{ trans('frontLang.Contact_Us') }}</h2>
            </div>


             <div class="mobile-option option-1 active deansmessage" data-id="1">
                <span>{{ trans('frontLang.deansmessage') }}</span>
            </div>


                   @include('frontEnd.onepage.view.contentfaculties.deansmessage')





            <div class="mobile-option option-2 about " data-id="2">
                <span>{{ trans('frontLang.Overview') }}</span>
              </div>
            @include('frontEnd.onepage.view.contentfaculties.Overview')
            <div class="mobile-option option-3 Vision_Mission" data-id="3">
                <span>{{ trans('frontLang.Vision_Mission') }}</span>
            </div>
             @include('frontEnd.onepage.view.contentfaculties.Vision_Mission')

             <div class="mobile-option option-4 deanship" data-id="4">
                <span>{{ trans('frontLang.deanship') }}</span>
              </div>
             @include('frontEnd.onepage.view.contentfaculties.deanship')

   <div class="mobile-option option-5 highlights" data-id="5">
                <span>{{ trans('frontLang.highlights') }}</span>
                </div>
                @include('frontEnd.onepage.view.contentfaculties.highlights')


               <div class="mobile-option option-6 contentfaculties" data-id="6">
                <span>{{ trans('frontLang.coursedescriptions') }}</span>
                </div>
                @include('frontEnd.onepage.view.contentfaculties.coursedescriptions')


    <div class="mobile-option option-7 AcademicPlan" data-id="7">
                <span>{{ trans('frontLang.AcademicPlan') }}</span>
                </div>
                @include('frontEnd.onepage.view.contentfaculties.AcademicPlan')




 <div class="mobile-option option-8 departments" data-id="8">
                <span>{{ trans('frontLang.departments') }}</span>
                </div>
                @include('frontEnd.onepage.view.contentfaculties.departments')


              <div class="mobile-option option-9 research" data-id="9">
                <span>{{ trans('frontLang.mediafile') }}</span>
              </div>
             @include('frontEnd.onepage.view.contentfaculties.mediafile')

               <div class="mobile-option option-10 apply" data-id="10">
                <span>{{ trans('frontLang.Contact_Us') }}</span>
            </div>
             @include('frontEnd.onepage.view.contentfaculties.Contact_Us')





        </div>



    </div>
</div>


</section>


@endif

@endsection
@section('footerInclude')

 @include('frontEnd.includes.scriptsubmit')
<script>
    $(document).ready(function () {

        main_image_tab_2_height = $('.main-image-tab-2').height();
        $('.main-image-tab-2-details').css('min-height', main_image_tab_2_height + 'px');

        $('.main-image-tab-2 .option').click(function () {
            id = $(this).data('id');
            $('.main-image-tab-2 .option').removeClass('active');
            $(this).addClass('active');
            $('.first-row .title').hide();
            $('.first-row .title-' + id).css('display', 'block');
            $('.main-detail').hide();
            $('.main-detail-' + id).fadeIn();
        });

        $('.main-image-tab-2-details .mobile-option').click(function () {
            id = $(this).data('id');
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $('.main-detail-' + id).slideUp();
            } else {
                $('.main-image-tab-2-details .mobile-option').removeClass('active');
                $(this).addClass('active');
                $('.main-detail').slideUp();
                $('.main-detail-' + id).slideDown();
            }
        });


        $('.tab2-title').click(function () {
            parent = $(this).parent('.tab-type-2');
            id = $(this).data('id');

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(parent).children('.tab2-dtl').slideUp();
            } else {
                $(parent).children('.tab2-title').removeClass('active');
                $(parent).children('.tab2-dtl').slideUp();
                $(this).addClass('active');
                $(this).siblings('.tab2-dtl-' + id).slideDown();
            }
        });
    });
</script>

   @endsection
