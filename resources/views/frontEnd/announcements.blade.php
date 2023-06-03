
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
                            <h1>{{ trans('frontLang.announcements') }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                 @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                  
                                  <li class="active">{{ trans('frontLang.announcements') }}
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
    <div class="container com-sp pad-bot-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h4>{{ trans('frontLang.announcements') }}</h4>
                </div>
                <div class="ho-event ho-event-mob-bot-sp path-announcements">
                    <div class="view-content view-annoucements">

                 @foreach($Topics as $key=> $Item)
                        <div class="views-row">
                            <div class="views-field views-field-title">
                                <span class="field-content">
                                    <img src="{{ Helper::FilterImage($Item->photo_file) }}" class="img-annoucements" alt="{{ $Item->$title_var }}" />
                                    <a href="#" hreflang="en"  title="{{ $Item->$title_var }}"> {{ $Item->$title_var }} </a>
                                        <input type="hidden" readonly="readonly" value="{{ $Item->$title_var }}"    class="form-control input_annoucements{{ $Item->id }}" />
                                </span>
                            </div>
                            <div class="views-field views-field-share-everywhere-field">
                                <span class="field-content">
                                    <div class="se-block se-align-left" class="se-align-left">
                                        <div class="block-content">
                                            <div class="se-container">
                                                <div class="se-links-container">
                                                    <ul class="se-links se-active">
                                                        <li class="se-link facebook_share custom-share facebook">
                                                            <a href="{{ Helper::SocialShare("facebook", $Item->$title_var)}}" title="{{ $Item->$title_var }}">
                                                                <img src="{{ url('plugins/img/facebook-share.svg') }}" title="Share on Facebook" alt="Share on Facebook" />
                                                            </a>
                                                        </li>
                                                        <li class="se-link twitter">
                                                            <a href="{{ Helper::SocialShare("twitter", $Item->$title_var)}}" class="custom-share twitter" title="{{ $Item->$title_var }}">
                                                                <img src="{{ url('plugins/img/twitter.svg') }}" title="Share on Twitter" alt="Share on Twitter" />
                                                            </a>
                                                        </li>
                                                        <li class="se-link linkedin">
                                                            <a href="{{ Helper::SocialShare("linkedin", $Item->$title_var)}}" class="custom-share linkedin" title="{{ $Item->$title_var }}">
                                                                <img src="{{ url('plugins/img/linkedin.svg') }}" title="Share on LinkedIn" alt="Share on LinkedIn" />
                                                            </a>
                                                        </li>
                                                        <li class="se-link whatsapp">
                                                            <a href="{{ Helper::SocialShare("whatsapp", $Item->$title_var)}}" class="custom-share whatsapp" title="{{ $Item->$title_var }}">
                                                                <img src="{{ url('plugins/img/whatsapp.svg') }}" data-text="Share via WhatsApp" title="Share via WhatsApp" alt="Share via WhatsApp" />
                                                            </a>
                                                        </li>
                                                        <li class="se-link copy" title="{{ $Item->$title_var }}">
                                                            <a   onclick="copyToClipboard('input_annoucements{{ $Item->id }}')"><img src="{{ url('plugins/img/copy-url.svg') }}" title="Copy site URL" alt="Copy site URL" /></a>
                                                            
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                         @endforeach



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
        </div>
    </div>
</section>

 
 
 
 
 
 


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
 
 
@section('footerInclude')
 
<script type="text/javascript">

 
 
     function copyToClipboard (t) {
                    var e = document.querySelector("." + t);
                    e.select();
                    try {
                        document.execCommand("copy"),
                            "selectionStart" in e && (e.selectionEnd = e.selectionStart),
                            e.blur(),
                            $("." + t)
                                .next("a")
                                .attr("data-original-title", "Copied!")
                                .tooltip("fixTitle")
                                .tooltip("show"),
                            $(".tooltip-inner").css("background-color", "#25919a"),
                            $(".tooltip.top .tooltip-arrow").css("border-top-color", "#25919a"),
                            $(".tooltip.right .tooltip-arrow").css("border-right-color", "#25919a"),
                            $(".tooltip.left .tooltip-arrow").css("border-left-color", "#25919a"),
                            $(".tooltip.bottom .tooltip-arrow").css("border-bottom-color", "#25919a"),
                            $("." + t).css("border-color", "#b0e5e3"),
                            $("." + t).css("background-color", "#EEF9F9"),
                            $("." + t)
                                .next("a")
                                .html('<i class="font-green fa fa-check"></i>'),
                            $("." + t).animate({ opacity: 1 }, 1e3, function () {
                                $("." + t).removeAttr("style"),
                                    $("." + t)
                                        .next("a")
                                        .html('<span class="font-grey-mint"></span>');
                            });
                    } catch (e) {
                        $("." + t).css("border-color", "#e5b0b0"),
                            $("." + t).css("background-color", "#f9eeee"),
                            $("." + t)
                                .next("a")
                                .html('<i class="font-green fa fa-check"></i>'),
                            $("." + t).animate({ opacity: 1 }, 1200, function () {
                                $("." + t).css("background-color", "#EEF9F9"),
                                    $("." + t).css("border-color", "#eee"),
                                    $("." + t)
                                        .next("a")
                                        .html('<span class="font-grey-mint"></span>'),
                                    $("." + t).tooltip("hide"),
                                    $("input.form-control").mouseover(function () {
                                        $(this).tooltip("hide");
                                    });
                            });
                    }
                }

</script>
   


@endsection