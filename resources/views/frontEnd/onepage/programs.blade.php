@extends('frontEnd.onepage.layout')

@section('content')

@section('styleInclude')

    <link rel="stylesheet" type="text/css" href="{{secure_asset('plugins/css/new-custom.css') }}">
   <link rel="stylesheet" type="text/css" href="{{secure_asset('plugins/css/custm-people.css') }}">
   <link href="{{secure_asset('plugins/css/undergraduate-admissions.css') }}" type="text/css" rel="stylesheet"/>
   <link href="{{secure_asset('plugins/css/college-of-health.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{secure_asset('plugins/css/college-of-health-responsive.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{secure_asset('plugins/css/undergraduate-admissions-responsive.css') }}" type="text/css" rel="stylesheet"/>
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
 <?php




   $backgroundImage="uploads/banar.jpg";
     if (isset($program->banner) && $program->banner!='' && $program->banner!='#') {
         $backgroundImage=$program->banner;
     }

   $admitionImage="uploads/banar.jpg";
     if (isset($program->admitionbanner) && $program->admitionbanner!='' && $program->admitionbanner!='#') {
         $admitionImage=$program->admitionbanner;
     }



 ?>
@if(count((array)$program)==0)
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
                            <h1>{{ $program->$title_var }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ trans('frontLang.Home') }}</a></li>
                                   @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))

                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>



                                      @endif
                                         <li><a>{{ $program->faculty->$title_var }}</a></li>
                                         <li><a>{{ trans('frontLang.Programs') }}</a></li>
                             <li class="active">{{ $program->$title_var }} </li>
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
           <a href="javascript:void();">
                <div class="option  option-1 active" data-id="1" style="background:url({{ Helper::getBannerStatic('Banner_Overview_Programs') }}) no-repeat center center; background-size:cover;">
                    <span class="about">{{ trans('frontLang.Overview') }}</span>
                </div>
            </a>
            <a href="javascript:void();">
                <div class="option option-2" data-id="2" style="background:url({{ Helper::getBannerStatic('Banner_Programs_Programs') }}) no-repeat center center; background-size:cover;">
                    <span class="departments">{{ trans('frontLang.Programs') }}</span>
                </div>
            </a>
            <a href="javascript:void();" >
                <div class="option option-3 " data-id="3" style="background:url({{ Helper::getBannerStatic('Banner_scholarships_Programs') }}) no-repeat center center; background-size:cover;">
                    <span class="scholarship">{{ trans('frontLang.scholarships') }}</span>
                </div>
            </a>

            <a href="javascript:void();">
                <div class="option option-2" data-id="5" style="background:url({{ Helper::getBannerStatic('Banner_Contact_Us_departments') }}) no-repeat center center; background-size:cover;">
                    <span class="departments">{{ trans('frontLang.Contact_Us') }}</span>
                </div>
            </a>
        </div>

           <div class="main-image-tab-2-details" id="main-page-details-2" style="min-height: 1000px;">
            <div class="first-row">
                <h2 class="title title-1 active about" style="display: block;">{{ trans('frontLang.Overview') }}</h2>
                <h2 class="title title-2 departments" style="display: none;">{{ trans('frontLang.Programs') }}</h2>
                <h2 class="title title-3 scholarship" style="display: none;">{{ trans('frontLang.scholarships') }}</h2>

                <h2 class="title title-4 apply" style="display: none;">{{ trans('frontLang.Contact_Us') }}</h2>
            </div>


             <div class="mobile-option option-1 active about" data-id="1">
                <span>{{ trans('frontLang.Overview') }}</span>
            </div>

              <div class="main-detail main-detail-1 active" style="display: block;">
                 {!! $program->$details_var !!}

                <br class="px-50">

                <div class="btn-img-text-blk by-2 clear">
                    <div class="img" style="background:url({{ Helper::FilterImage($program->photo_file) }}) no-repeat center center; background-size:cover;"></div>
                    <div class="btn btn-1 closed"><span></span></div>
                </div>




            </div>

               <div class="mobile-option option-2 programs" data-id="2">
                <span>{{ trans('frontLang.Programs') }}</span>
                </div>
                @include('frontEnd.onepage.programs.Programs')

              <div class="mobile-option option-3 research" data-id="3">
                <span>{{ trans('frontLang.scholarships') }}</span>
              </div>

             @include('frontEnd.onepage.programs.scholarships')

               <div class="mobile-option option-5 apply" data-id="5">
                <span>{{ trans('frontLang.Contact_Us') }}</span>
            </div>
             @include('frontEnd.onepage.programs.Contact_Us')





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
