
@extends('frontEnd.layout')

@section('content')

 <link rel="stylesheet" type="text/css" href="{{secure_asset('plugins/css/new-custom.css') }}">
 <link href="{{secure_asset('plugins/css/graduate-admissions.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{secure_asset('plugins/css/graduate-admissions-responsive.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{secure_asset('plugins/css/about.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{secure_asset('plugins/css/about-responsive.css') }}" type="text/css" rel="stylesheet"/>

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
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                  {{--   @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))

                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>



                                      @endif --}}

                                  <li class="active">{{ $name_section }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
$listLevel=array(1,2,3,4);
  $Facultylist= App\Models\Faculty::where('status', 1)->get();
   $backgroundImage="uploads/banar.jpg";
?>

    @if(count((array)$Topics)>0)
       <!--SECTION START-->
       <div class="container">
    <div class="wrapper clear">
        <div class="main-image-tab-2 clear">
               @if(count((array)$Facultylist)>0)

             @foreach($Facultylist as $key=> $Faculty)

              <?php
               $bannersidef="uploads/banar.jpg";
               if (isset($Faculty->fields) && isset($Faculty->fields[6])) {
                   $bannersidef=$Faculty->fields[6]->field_value;
               }


              ?>
            <a href="javascript:void();" title="{!!  $Faculty->$title_var !!}">
                <div class="option  option-{{ $key+1 }} {{ ($key==0)?'active':'' }}"  data-id="{{ $key+1 }}" style="background:url({{ Helper::FilterImage($bannersidef) }}) no-repeat center center; background-size:cover;">
                    <span class="about facult-{{ $key+1 }}">{!!  $Faculty->$title_var !!}</span>
                </div>
            </a>


            @endforeach
           @endif


        </div>

    <div class="main-image-tab-2-details" id="main-page-details-2">
            <div class="first-row">
                @if(count((array)$Facultylist)>0)

             @foreach($Facultylist as $key=> $Faculty)
                <h2 class="title about title-{{ $key+1 }} facult-{{ $key+1 }} {{ ($key==0)?'active':'' }} " style="display:{{ ($key==0)?'block':'' }} ">{!!  $Faculty->$title_var !!}</h2>

                  @endforeach
           @endif
            </div>

          @if(count((array)$Facultylist)>0)

             @foreach($Facultylist as $key=> $Faculty)
  <div class="mobile-option option-{{ $key+1 }} facult-{{ $key+1 }}"  data-id="{{ $key+1 }}">
                <span>{!!  $Faculty->$title_var !!}</span>
            </div>
            <div class="main-detail main-detail-{{ $key+1 }} {{ ($key==0)?'active':'' }} " data-id="{{ $key+1 }}">
              <div class="row">
                  <div class="col-md-12">









            <?php  $indexer=0; ?>
           @foreach($Topics as $Item)

         @if($Faculty->id==$Item->faculty_id)
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

            @if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value!='' && $Item->fields[0]->field_value==2 && $Faculty->id==$Item->faculty_id)




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

            @if($Item->fields[0]->field_value==3 && $Faculty->id==$Item->faculty_id)


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

            @if($Item->fields[0]->field_value==4 && $Faculty->id==$Item->faculty_id)

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

            @endforeach

       @endif





</div>
      </div>

  </div>




     @endif


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



