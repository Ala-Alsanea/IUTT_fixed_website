@extends('frontEnd.layout')

@section('content')
    <?php
    $title_var = "title_" . trans('backLang.boxCode');
    $title_var2 = "title_" . trans('backLang.boxCodeOther');
    $details_var = "details_" . trans('backLang.boxCode');
    $details_var2 = "details_" . trans('backLang.boxCodeOther');
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
    $section = "";
    try {
        if ($Topic->section->$title_var != "") {
            $section = $Topic->section->$title_var;
        } else {
            $section = $Topic->section->$title_var2;
        }
    } catch (Exception $e) {
        $section = "";
    }

      $backgroundImage="uploads/banar.jpg";
     if (isset($Topic->fields) && isset($Topic->fields[0])) {
         $backgroundImage=$Topic->fields[0]->field_value;
     }
    ?>

<style type="text/css">
    #google-map{
    width: 100%;
    height: 550px;
    border: 0px;
    margin-bottom: -5px;
    display: block;
    pointer-events: none;
    position: relative;
}
#sendmessage, #subscribesendmessage, #ordersendmessage {
    color: green !important;
    border: 1px solid #b1deca;
    background: #e7fff7;
    display: none;
    text-align: center;
    padding: 10px;
    font-weight: 600;
    margin-bottom: 10px;
    border-radius: 5px;
}
#errormessage, #ordererrormessage, #subscribeerrormessage {
    color: red;
    display: none;
    border: 1px solid #ea9c97;
    background: #ffe4e9;
    text-align: center;
    padding: 10px;
    font-weight: 600;
    margin-bottom: 10px;
    border-radius: 5px;
}
</style>
    <section>
  <div class="page-title head-1" style="background-image: url({{ Helper::FilterImage($backgroundImage) }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ trans('frontLang.Contact_Us') }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                 @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                  
                                  <li class="active">{{ trans('frontLang.Contact_Us') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
   
                      
                
   <!--SECTION START-->
    <section>
        <div class="container com-sp pad-bot-70">
            <div class="row">
                <div class="cor about-sp">
                    <div class="ed-about-tit">
                        <div class="con-title">
                            <h2>{{ trans('frontLang.Contact_Us') }}</h2>
                            <p>{{ trans('frontLang.contactDetails') }}</p>
                        </div>
                    </div>
                    <div class="pg-contact">
                        <div class="col-md-1 col-sm-6 col-xs-12 new-con new-con1"></div>
                        <div class="col-md-4 col-sm-6 col-xs-12 new-con new-con1">
                       
                          

                                  @if(Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) !="")
                            <address>
                                <i class="fa fa-map-marker"></i>
                                <h4>{{ trans('frontLang.address') }}:</h4> 
                                {{ Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) }}
                            </address>
                        @endif
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 new-con new-con3">  
                           <br>
                               @if(Helper::GeneralSiteSettings("contact_t3") !="")
                            <p>
                                <i class="fa fa-phone"></i>
                                <strong>{{ trans('frontLang.callPhone') }}:</strong> 
                             <span
                                        dir="ltr"><a href="tel:{{ Helper::GeneralSiteSettings("contact_t3") }}">{{ Helper::GeneralSiteSettings("contact_t3") }} </a></span>
                            </p>
                        @endif

                        @if(Helper::GeneralSiteSettings("contact_t5") !="")
                            <p>
                                <i class="fa fa-phone"></i>
                                <strong>{{ trans('frontLang.callMobile') }}:</strong> 
                             <span
                                        dir="ltr"><a href="tel:{{ Helper::GeneralSiteSettings("contact_t5") }}">{{ Helper::GeneralSiteSettings("contact_t5") }}</a> </span>
                            </p>
                        @endif
                   
                            
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 new-con new-con4"> <img src="img/contact/3.png" alt="">
                              <br>
                          @if(Helper::GeneralSiteSettings("contact_t4") !="")
                            <p>
                                <i class="fa fa-fax"></i>
                                <strong>{{ trans('frontLang.callFax') }}:</strong> 
                                <span
                                        dir="ltr"> <a href="tel:{{ Helper::GeneralSiteSettings("contact_t4") }}">{{ Helper::GeneralSiteSettings("contact_t4") }}</a></span>
                            </p>
                        @endif
                        @if(Helper::GeneralSiteSettings("contact_t6") !="")
                            <p>
                                <i class="fa fa-envelope"></i>
                                <strong>{{ trans('frontLang.email') }}:</strong>
                                <a href="mailto: {{ Helper::GeneralSiteSettings("contact_t6") }}">  {{ Helper::GeneralSiteSettings("contact_t6") }}</a>
                            </p>
                        @endif
                       
                                
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION END-->

        <section id="map">
        <div class="row contact-map">
            <!-- IFRAME: GET YOUR LOCATION FROM GOOGLE MAP -->
            @if(count((array)$Topic->maps) >0)  

            <div id="google-map" class="actAsDiv"></div>
          {{--     <iframe class="actAsDiv" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15393.616334015082!2d44.1716558!3d15.3002599!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc077282656bcc8db!2sTwintech%20University!5e0!3m2!1sen!2s!4v1606767153474!5m2!1sen!2s"  allowfullscreen=""></iframe> --}}
              @endif
            <div class="container">
                <div class="overlay-contact footer-part footer-part-form">
                    <div class="map-head">
                        <h2>{{ trans('frontLang.sendMessage') }}</h2>
                        <h5>{{ trans('frontLang.getInTouch') }}</h5>
                       

                    </div>
                  

                    <div id="sendmessage"><i class="fa fa-check-circle"></i>
                        &nbsp;{{ trans('frontLang.youMessageSent') }}</div>
                    <div id="errormessage">{{ trans('frontLang.youMessageNotSent') }}</div>

                      {{Form::open(['route'=>['contactPageSubmit'],'method'=>'POST','class'=>'contactForm','id'=>'contactForm',"file"=>true,'enctype'>='multipart/form-data'])}}
                  
                        <ul>
                            <li class="col-md-6 col-sm-6 col-xs-12 contact-input-spac">

                                 {!! Form::text('contact_name',"", array('placeholder' => trans('frontLang.yourName'),'id'=>'name', 'data-msg'=> trans('frontLang.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                      <div class="alert alert-warning validation"></div>

 
                            </li>
                         
                            <li class="col-md-6 col-sm-6 col-xs-12 contact-input-spac">
                              
                                        {!! Form::email('contact_email',"", array('placeholder' => trans('frontLang.yourEmail'),'class' => 'form-control','id'=>'email', 'data-msg'=> trans('frontLang.enterYourEmail'),'data-rule'=>'email')) !!}
                        <div class="validation"></div>
                               </li>
                            <li class="col-md-6 col-sm-6 col-xs-12 contact-input-spac">
                                  {!! Form::text('contact_phone',"", array('placeholder' => trans('frontLang.phone'),'class' => 'form-control','id'=>'phone', 'data-msg'=> trans('frontLang.enterYourPhone'),'data-rule'=>'minlen:4')) !!}
                        <div class="validation"></div>
                     
                        

                                 </li>
                            <li class="col-md-12 col-sm-12 col-xs-12 contact-input-spac">
                               
                                 {!! Form::hidden('contact_subject',"", array('placeholder' => trans('frontLang.subject'),'class' => 'form-control','id'=>'subject', 'data-msg'=> trans('frontLang.enterYourSubject'))) !!}
                                   {!! Form::textarea('contact_message','', array('placeholder' => trans('frontLang.message'),'class' => 'form-control','id'=>'message','rows'=>'8', 'data-msg'=> trans('frontLang.enterYourMessage'),'data-rule'=>'required')) !!}
                        <div class="validation"></div>
                            </li>
                            <li class="col-md-6">

                                 <button type="submit" class="btn btn-theme">{{ trans('frontLang.sendMessage') }}</button>
                             

                            </li>
                        </ul>
                      {{Form::close()}}
                </div>
            </div>
        </div>
    </section>

 
 
      

@endsection
@section('footerInclude')
    @if(count((array)$Topic->maps) >0)
        @foreach($Topic->maps->slice(0,1) as $map)
            <?php
            $MapCenter = $map->longitude . "," . $map->latitude;
            ?>
        @endforeach
        <?php
        $map_title_var = "title_" . trans('backLang.boxCode');
        $map_details_var = "details_" . trans('backLang.boxCode');
        ?>
        <script type="text/javascript"
                src="http://maps.google.com/maps/api/js?key=AIzaSyAgzruFTTvea0LEmw_jAqknqskKDuJK7dM"></script>

        <script type="text/javascript">
            // var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
            var iconURLPrefix = "{{ URL::to('plugins/backEnd/assets/images/')."/" }}";
            var icons = [
                iconURLPrefix + 'marker_0.png',
                iconURLPrefix + 'marker_1.png',
                iconURLPrefix + 'marker_2.png',
                iconURLPrefix + 'marker_3.png',
                iconURLPrefix + 'marker_4.png',
                iconURLPrefix + 'marker_5.png',
                iconURLPrefix + 'marker_6.png'
            ]

            var locations = [
                    @foreach($Topic->maps as $map)
                ['<?php echo "<strong>" . $map->$map_title_var . "</strong>" . "<br>" . $map->$map_details_var; ?>', <?php echo $map->longitude; ?>, <?php echo $map->latitude; ?>, <?php echo $map->id; ?>, <?php echo $map->icon; ?>],
                @endforeach
            ];

            var map = new google.maps.Map(document.getElementById('google-map'), {
                zoom:17,
                draggable: false,
                scrollwheel: false,
                center: new google.maps.LatLng(<?php echo $MapCenter; ?>),
               // mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    icon: icons[locations[i][4]],
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        </script>
    @endif
    @include('frontEnd.includes.scriptsubmit')
    
   

@endsection