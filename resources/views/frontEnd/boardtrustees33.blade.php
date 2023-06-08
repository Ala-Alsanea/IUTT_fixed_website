
@extends('frontEnd.layout')

@section('content')



   <link rel="stylesheet" type="text/css" href="{{secure_asset('plugins/css/custm-people.css') }}">
   <link rel="stylesheet" type="text/css" href="{{secure_asset('plugins/css/new-custom.css') }}">
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



    @if(count((array)$Topics)>0)
       <!--SECTION START-->
 <div class="main-holder">

        <div class="container inner-content com-sp pad-bot-70">

            <div class="ed-about-tit">
                <div class="con-title">
                    <h2>{{ $name_section }}</h2>

                </div>
            </div>
            <div class="row">

   <div class="common-members-block clear Academic Faculty">
             <section id="team" class="team-area">
          <?php
            $conterx=0;
          ?>

                 <div class="row team-items" style="margin:0">
                      @foreach($Topics as $Item)


                       <?php


                         $conterx+=1;

                        $q_id=0;
                        $p_id=2;
                        $e_id=4;
                        $m_id=5;
                        $pp_id=7;
                        $exp_id=9;
                        $cour_id=11;
                        $activ_id=13;
                       if (trans('backLang.boxCode')=='en') {
                            $q_id=1;
                             $p_id=3;
                              $m_id=6;
                               $pp_id=8;
                               $exp_id=10;
                                $cour_id=12;
                                $activ_id=14;
                       }

                      if($conterx>1)
                      {




                       ?>

                 <div class="col-md-3 single-item"> ssssss</div>
                     <div class="col-md-3 single-item">
                         <div class="item">
                             <div class="thumb">
                                 <img class="img-fluid" src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="">

                             </div>
                             <div class="info">
                                 <span class="message">
                                     <a href="#"><i class="fas fa-envelope-open"></i></a>
                                 </span>
                                 <h4> {!!  $Item->$title_var !!}</h4>

                                          <span> {!!  $Item->$details_var !!}</span>



                             </div>
                         </div>
                     </div>
                      <div class="col-md-3 single-item"> ssssss</div>
                        <?php
                          }else{



                        ?>
                          <div class="col-md-3 single-item">
                         <div class="item">
                             <div class="thumb">
                                 <img class="img-fluid" src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="">

                             </div>
                             <div class="info">
                                 <span class="message">
                                     <a href="#"><i class="fas fa-envelope-open"></i></a>
                                 </span>
                                 <h4> {!!  $Item->$title_var !!}</h4>

                                          <span> {!!  $Item->$details_var !!}</span>



                             </div>
                         </div>
                     </div>
                     <?php

                          }

                        ?>
                      @endforeach






                 </div>

     </section>


 </div>
</div>
</div>
</div>


     @endif


@endif
@endsection
@section('footerInclude')



   @endsection




