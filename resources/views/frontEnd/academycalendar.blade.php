
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


$listLevel=array(0=>trans('frontLang.Firstterm'),1=>trans('frontLang.Secondterm'),2=>trans('frontLang.Summerterm'));

?>





<div class="container com-sp pad-bot-70">


            <div class="ed-about-tit">
                <div class="con-title">
                    <h2>{{ $name_section }}</h2>

                </div>
            </div>

<div class="path-academic-calendar ">
   @foreach($listLevel as $level=> $value)

    <div class="view-content accordion ui-accordion" role="tablist"  id="accordion-{{ $level }}">


        <?php
        $indexer=0;

        ?>
        @foreach($Topics as $Item)




         @if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value!='' && $Item->fields[0]->field_value==$level)
           @if($indexer==0)
                   <h2>{{ $value }}</h2>
                   <br>
                 @endif
                 <?php   ++$indexer; ?>

        <div class="views-row">
            <div class="" id="heading-id-{{ $Item->id }}-level-{{ $level  }}">
                <div
                    data-toggle="collapse"
                    data-target="#ui-id-{{ $Item->id }}-level-{{ $level  }}"
                    aria-expanded="false"
                    data-parent="#accordion-{{ $level }}"
                    aria-controls="ui-id-{{ $Item->id }}-level-{{ $level  }}"
                    class="views-field views-field-title views-accordion-header ui-accordion-header ui-corner-top ui-state-default ui-accordion-icons ui-accordion-header-collapsed ui-corner-all accordion-toggle collapsed"
                    id="ui-ui-id-{{ $Item->id }}-level-{{ $level  }}"
                >
                    <span class="ui-accordion-header-icon ui-icon fa fa-chevron-right"></span>
                    <span class="field-content">
                        <h3 class="title-collapse-aca">
                            <div class="aca-title">
                              <a href="#ui-id-{{ $Item->id }}-level-{{ $level  }}" title="{!!  $Item->$title_var !!}" >{!!  $Item->$title_var !!} </a></div>
                            @if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value!='')
                            <div class="aca-day">{{ $Item->fields[0]->field_value }}</div>
                              @endif


                            <div class="aca-date">{!!  $Item->date !!}</div>

                        </h3>
                    </span>
                </div>
            </div>

            <div class="ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content collapse" role="tabpanel" id="ui-id-{{ $Item->id }}-level-{{ $level  }}" aria-labelledby="ui-ui-id-{{ $Item->id }}-level-{{ $level  }}" data-parent=".accordion-{{ $level }}" aria-expanded="false">
                @if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value!='')
                <div class="views-field views-field-field-academic-event-date">

                    <span class="views-label views-label-field-academic-event-date">{{ trans('frontLang.Day') }}</span>
                    <div class="field-content">{{ $Item->fields[0]->field_value }}</div>
                </div>
                   @endif
                <div class="views-field views-field-field-academic-event-date-1">
                    <span class="views-label views-label-field-academic-event-date-1">{{ trans('frontLang.Date') }}</span>
                    <div class="field-content">{!!  $Item->date !!}</div>
                </div>

                <div class="views-field views-field-body">
                    <span class="views-label views-label-body">{{ trans('frontLang.Description') }}</span>
                    <div class="field-content"><p>{!!  $Item->$details_var !!}</p></div>
                </div>
            </div>
        </div>
             @endif
         @endforeach



    </div>
 @endforeach
  </div>

</div>








@endif
@endsection
@section('footerInclude')



   @endsection




