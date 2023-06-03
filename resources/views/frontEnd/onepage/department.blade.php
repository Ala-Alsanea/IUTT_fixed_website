@extends('frontEnd.onepage.layout')

@section('content')
   <link rel="stylesheet" type="text/css" href="{{asset('plugins/css/new-custom.css') }}">
   <link rel="stylesheet" type="text/css" href="{{asset('plugins/css/custm-people.css') }}">
   <link href="{{asset('plugins/css/undergraduate-admissions.css') }}" type="text/css" rel="stylesheet"/>
   <link href="{{asset('plugins/css/college-of-health.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{asset('plugins/css/college-of-health-responsive.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{asset('plugins/css/undergraduate-admissions-responsive.css') }}" type="text/css" rel="stylesheet"/>








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
    $backgroundImage="uploads/banar.jpg";
     if ($department->banner!='') {
         $backgroundImage=$department->banner;
     }

       $admitionImage="uploads/banar.jpg";
     if ($department->banner!='') {
         $admitionImage=$department->admitionbanner;
     }
//dd($quicklinks);

 ?>
@if(count((array)$department)==0)
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
                            <h1>{{ $department->$title_var }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ trans('frontLang.Home') }}</a></li>
                                   @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))

                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>



                                      @endif

                               <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ $FacultyData->$title_var }}</a></li>
                             <li class="active">{{ $department->$title_var }} </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<section class="sec_pad">
 <div class="container">
    <div class="wrapper clear">
        <div class="main-image-tab-2 clear">
           <a href="javascript:void();">
                <div class="option  option-1 active" data-id="1" style="background:url({{ Helper::getBannerStatic('Banner_Overview_departments') }}) no-repeat center center; background-size:cover;">
                    <span class="about">{{ trans('frontLang.Overview') }}</span>
                </div>
            </a>

         <a href="javascript:void();">
                <div class="option  option-2 " data-id="2" style="background:url({{ Helper::getBannerStatic('Banner_Vision_Mission_departments') }}) no-repeat center center; background-size:cover;">
                    <span class="about">{{ trans('frontLang.Vision_Mission') }}</span>
                </div>
            </a>

            <a href="javascript:void();">
                <div class="option option-3" data-id="3" style="background:url({{ Helper::getBannerStatic('Banner_People_departments') }}) no-repeat center center; background-size:cover;">
                    <span class="departments">{{ trans('frontLang.People') }}</span>
                </div>
            </a>
            <a href="javascript:void();" >
                <div class="option option-4 " data-id="4" style="background:url({{ Helper::getBannerStatic('Banner_coursedescriptions_departments') }}) no-repeat center center; background-size:cover;">
                    <span class="scholarship">{{ trans('frontLang.coursedescriptions') }}</span>
                </div>
            </a>

            <a href="javascript:void();">
                <div class="option option-5" data-id="5" style="background:url({{ Helper::getBannerStatic('Banner_AcademicPlan_departments') }}) no-repeat center center; background-size:cover;">
                    <span class="apply">{{ trans('frontLang.AcademicPlan') }}</span>
                </div>
            </a>
            <a href="javascript:void();">
                <div class="option option-6" data-id="6" style="background:url({{ Helper::getBannerStatic('Banner_Contact_Us_departments') }}) no-repeat center center; background-size:cover;">
                    <span class="departments">{{ trans('frontLang.Contact_Us') }}</span>
                </div>
            </a>
        </div>

           <div class="main-image-tab-2-details" id="main-page-details-2" style="min-height: 1000px;">
            <div class="first-row">
                <h2 class="title title-1 active about" style="display: block;">{{ trans('frontLang.Overview') }}</h2>
                     <h2 class="title title-2  about" style="display: none;">{{ trans('frontLang.Vision_Mission') }}</h2>
                <h2 class="title title-3 departments" style="display: none;">{{ trans('frontLang.People') }}</h2>
                <h2 class="title title-4 scholarship" style="display: none;">{{ trans('frontLang.coursedescriptions') }}</h2>

                <h2 class="title title-5 apply" style="display: none;">{{ trans('frontLang.AcademicPlan') }}</h2>

                <h2 class="title title-6 apply" style="display: none;">{{ trans('frontLang.Contact_Us') }}</h2>
            </div>


             <div class="mobile-option option-1 active about" data-id="1">
                <span>{{ trans('frontLang.Overview') }}</span>
            </div>

              <div class="main-detail main-detail-1 active" style="display: block;">
                 {!! $department->$details_var !!}

                <br class="px-50">

                <div class="btn-img-text-blk by-2 clear">
                    <div class="img" style="background:url({{ Helper::FilterImage($admitionImage) }}) no-repeat center center; background-size:cover;"></div>
                    <div class="btn btn-1 closed"><span></span></div>
                </div>

                <br class="px-50">
               @include('frontEnd.onepage.view.departments.Overview')
                <div class="quick-links clear">
                     <p>
                        @if(count((array)$quicklinks)>0)
                        @foreach($quicklinks as $quicklink)

                                <a class="link" href="{!!  $quicklink->link !!}" title="{!!  $quicklink->$title_var !!}"><i style="background-image: url({{ Helper::FilterImage($quicklink->photo_file) }});background-repeat: no-repeat;    background-position: center;"></i><span>{!!  $quicklink->$title_var !!}</span></a>

                         @endforeach
                          @endif

                    </p>


                   </div>
            </div>

            <div class="mobile-option option-2 Vision_Mission" data-id="2">
                <span>{{ trans('frontLang.Vision_Mission') }}</span>
            </div>
             @include('frontEnd.onepage.view.departments.Vision_Mission')



               <div class="mobile-option option-3 programs" data-id="3">
                <span>{{ trans('frontLang.People') }}</span>
                </div>
                @include('frontEnd.onepage.view.departments.People')

              <div class="mobile-option option-4 research" data-id="4">
                <span>{{ trans('frontLang.coursedescriptions') }}</span>
              </div>
               @include('frontEnd.onepage.view.departments.CourseDescriptions')
                 <div class="mobile-option option-5 apply" data-id="5">
                <span>{{ trans('frontLang.AcademicPlan') }}</span>
            </div>
             @include('frontEnd.onepage.view.departments.AcademicPlan')
               <div class="mobile-option option-6 apply" data-id="6">
                <span>{{ trans('frontLang.Contact_Us') }}</span>
            </div>
             @include('frontEnd.onepage.view.departments.Contact_Us')





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
