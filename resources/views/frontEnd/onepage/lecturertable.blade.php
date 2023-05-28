
@extends('frontEnd.onepage.layout')

@section('content')

 <link rel="stylesheet" type="text/css" href="{{asset('plugins/css/new-custom.css') }}">
 <link href="{{asset('plugins/css/graduate-admissions.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{asset('plugins/css/graduate-admissions-responsive.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{asset('plugins/css/about.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{asset('plugins/css/about-responsive.css') }}" type="text/css" rel="stylesheet"/>

  <style>
 .highlighted-box {
      background: #f2f2f2;
    padding: 18px;
    float: left;
    width: 47%;
    margin: 30px 20px 0px 0px;
    height: 114px;
        margin-bottom: 20px;
}
.highlighted-box.apply-now .content {
    float: left;
    width: calc(100% - 150px);
    padding-right: 30px;
}
.common-btn span {color: currentcolor;
}
  </style>

  <?php
$listLevel=array(1,2,3,4);
 $Topics=$FacultyData->lecturerstable;
   $backgroundImage="uploads/banar.jpg";
?>
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





 <section>
  <div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_Academic_page_staff') }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ $name_section }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ trans('frontLang.Home') }}</a></li>
                                    <li><a href="{{ url(trans('backLang.boxCode')."/faculties/".$FacultyData->$title_var) }}">{{ $FacultyData->$title_var }}</a>

                                  <li class="active">{{ $name_section }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="process_area bg_color sec_pad about">

    @if(count((array)$Topics)>0)
       <!--SECTION START-->
       <div class="container">
    <div class="wrapper clear">
        <div class="main-image-tab-2 clear">



              <?php
               $bannersidef="uploads/banar.jpg";
               if ($FacultyData->banner!='' && $FacultyData->banner!='#') {
                   $bannersidef=$FacultyData->banner;
               }


              ?>
            <a href="javascript:void();" title="{!!  $FacultyData->$title_var !!}">
                <div class="option  option-{{ $FacultyData->id }} "  data-id="{{ $FacultyData->id }}" style="background:url({{ Helper::FilterImage($bannersidef) }}) no-repeat center center; background-size:cover;">
                    <span class="about facult-{{ $FacultyData->id }}">{!!  $FacultyData->$title_var !!}</span>
                </div>
            </a>




        </div>

    <div class="main-image-tab-2-details" id="main-page-details-2">
            <div class="first-row">



                <h2 class="title about title-{{ $FacultyData->id }} facult-{{ $FacultyData->id }} active" style="display:block">{!!  $FacultyData->$title_var !!}</h2>



            </div>




  <div class="mobile-option option-1 facult-1"  data-id="1">
                <span>{!!  $FacultyData->$title_var !!}</span>
            </div>
            <div class="main-detail main-detail-1 active" data-id="1">
              <div class="row">
                  <div class="col-md-12">









            <?php  $indexer=0; ?>
           @foreach($Topics as $Item)

         @if($FacultyData->id==$Item->faculty_id)
            @if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value!='' && $Item->fields[0]->field_value==1)


               @if($indexer==0)
                <h4 class="title " >{{ trans('frontLang.Level_1') }}</h4>
                 @endif
                 <?php   ++$indexer; ?>

              <div class="highlighted-box apply-now download-box ">
                <div class="content">
                    <p>{!!  $Item->$title_var !!}</p>
                </div>
                <div>
                    <a href="{!!  $Item->attach_file !!}" class="common-btn" target="_blank" rel="noopener noreferrer" title="{{ trans('frontLang.download_now') }}"><span>{{ trans('frontLang.download_now') }}  </span></a>
                </div>
            </div>




             @endif
           @endif

            @endforeach


            <?php  $indexer=0; ?>
           @foreach($Topics as $Item)

            @if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value!='' && $Item->fields[0]->field_value==2 && $FacultyData->id==$Item->faculty_id)




               @if($indexer==0)
                <h4 class="title " >{{ trans('frontLang.Level_2') }}</h4>
                 @endif
                 <?php   ++$indexer; ?>

              <div class="highlighted-box apply-now download-box ">
                <div class="content">
                    <p>{!!  $Item->$title_var !!}</p>
                </div>
                <div>
                    <a href="{!!  $Item->attach_file !!}" class="common-btn" target="_blank" rel="noopener noreferrer" title="{{ trans('frontLang.download_now') }}"><span>{{ trans('frontLang.download_now') }}  </span></a>
                </div>
            </div>
             @endif

            @endforeach

              <?php  $indexer=0; ?>
           @foreach($Topics as $Item)

            @if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value!='')

            @if($Item->fields[0]->field_value==3 && $FacultyData->id==$Item->faculty_id)


               @if($indexer==0)
                <h4 class="title " >{{ trans('frontLang.Level_3') }}</h4>
                 @endif
                 <?php   ++$indexer; ?>

              <div class="highlighted-box apply-now download-box ">
                <div class="content">
                    <p>{!!  $Item->$title_var !!}</p>
                </div>
                <div>
                    <a href="{!!  $Item->attach_file !!}" class="common-btn" target="_blank" rel="noopener noreferrer" title="{{ trans('frontLang.download_now') }}"><span>{{ trans('frontLang.download_now') }}  </span></a>
                </div>
            </div>
               @endif
             @endif

            @endforeach

             <?php  $indexer=0; ?>
           @foreach($Topics as $Item)


            @if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value!='')

            @if($Item->fields[0]->field_value==4 && $FacultyData->id==$Item->faculty_id)

               @if($indexer==0)
                <h4 class="title " >{{ trans('frontLang.Level_4') }}</h4>
                 @endif
                 <?php   ++$indexer; ?>

              <div class="highlighted-box apply-now download-box ">
                <div class="content">
                    <p>{!!  $Item->$title_var !!}</p>
                </div>
                <div>
                    <a href="{!!  $Item->attach_file !!}" class="common-btn" target="_blank" rel="noopener noreferrer" title="{{ trans('frontLang.download_now') }}"><span>{{ trans('frontLang.download_now') }}  </span></a>
                </div>
            </div>
               @endif
             @endif

            @endforeach


          </div>
              </div>
           </div>









</div>
      </div>

  </div>

     @endif

   </section>


@endif
@endsection
@section('footerInclude')

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



