<!-- total info -->
    <?php
     $HomeEvent=App\Models\Topic::where([['status', 1], ['webmaster_id',12]])->orderby('row_no', 'desc')->limit(3)->get();
          $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    $details_var2 = "details_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                     $file_var = "file_" . trans('backLang.boxCode');
                    $section_url = "";
  $HomeAnnounce=App\Models\Topic::where([['status', 1], ['webmaster_id',11]])->orderby('row_no', 'desc')->limit(5)->get();

    ?>

@if(count((array)$HomeEvent)>0 || count((array)$HomeAnnounce)>0)

 


<section class="com-sp event_index">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if(count((array)$HomeEvent)>0)
          <div   style="border-bottom: 0px solid #dcdcdc; /* box-shadow: 3px 6px 6px -6px #22283185; */  /* margin: 1px; */margin-left: -12px;margin-right: 10px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
                <div class="ho-ev-latest ho-ev-latest-bg-1" style="background: url(uploads/banners/events-banner.jpg) no-repeat; background-size: cover; padding: 40px;">
<div class="ho-lat-ev">
    <h4>{{  trans('backLang.events') }}</h4>
    <p>{{  trans('frontLang.events_messages_index') }} </p>
</div>
                </div>
                <div class="ho-event ho-event-mob-bot-sp view-annoucements">

   @foreach($HomeEvent as $Item)
<div class="ed-rese-grid ed-rese-grid-mar-bot-30">
    <div class="ed-rsear-img">
        <div class="ho-ev-date" style="min-width: 107px;">
            <span> <?php  echo date("d", strtotime($Item->date)); ?></span>
            <span> <?php echo date('Y ,M', strtotime($Item->date)); ?> </span>
        </div>
    </div>
    <div class="ed-rsear-dec" style="float: none;">
        <h4 style="color: #393e46;font-size: 10px;">
            <a href="#" style="color: #393e46;">{{ $Item->$title_var }}</a>
        </h4>
       {{--  <a href="#">
            Status
            <span>Pendding</span>
        </a>
        <a href="#">
            Duration
            <span>11 Days</span>
        </a> --}}
    </div>
</div>
 @endforeach

 
  <div class="com-sp  text-center">
                <a href="{{ asset('university/events') }}" class="btn-custom">{{ trans('frontLang.readMore') }}</a>
            </div>
                </div>
            </div>
            @endif
</div>








<div class="col-md-6">

    @if(count((array)$HomeAnnounce)>0)
<div
 style="
    border-bottom: 0px solid #dcdcdc;
    padding-bottom: 22px;
 
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
">
                <!--<div class="ho-ex-title"><h4>Upcoming Event</h4></div>-->
                <div class="ho-ev-latest ho-ev-latest-bg-2" style="
    background: url({{ asset('uploads/banners/events-banner.jpg') }}) no-repeat;
    background-size: cover;
    padding: 51px;
">
                    <div class="ho-lat-ev">
                        <h4>{{  trans('backLang.announcements') }}</h4>
                        <p>{{  trans('frontLang.announcements_message') }}</p>
                    </div>
                </div>
                <div class="ho-event ho-event-mob-bot-sp path-announcements" >
        <div class="view-content view-annoucements">
 @foreach($HomeAnnounce as $Item)
            <div class="views-row">
                <div class="views-field views-field-title">
                    <span class="field-content textblack">
                        <img src="{{ Helper::FilterImage($Item->photo_file) }}" class="img-annoucements" alt="{{ $Item->$title_var }}">
                        <a href="#">{{ $Item->$title_var }}</a>
                    </span>
                </div>
                <div class="views-field views-field-share-everywhere-field">
                    <span class="field-content textblack">
                        <div class="se-block se-align-left">
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
                                                            <img src="{{ url('plugins/img/copy-url.svg') }}" title="Copy site URL" alt="Copy site URL" />
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
 <div class="com-sp  text-center">
                <a href="{{ asset('university/events') }}" class="btn-custom">{{ trans('frontLang.readMore') }}</a>
            </div>
    </div>
</div>
@endif
                        </div>
        </div>
    </div>
</section>

@endif