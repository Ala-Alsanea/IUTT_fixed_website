@include('frontEnd.includes.FooterTop')
<section class="wed-hom-footer  ">
        <div class="container">
             <div class="row onlydesk">
              <div class="col-xl-7 col-lg-4 col-md-4 col-sm-7 col-xs-12 foot-tc-mar-t-o address">
                    <h4>{{ trans('frontLang.contactDetails') }}</h4>
                     @if(Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) !="")
                          <address>
                             <p>
                                <i class="fa fa-map-marker"></i>
                                &nbsp;<strong>{{ trans('frontLang.address') }} :</strong> &nbsp;
                                {{ Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) }}
                            </p>
                            </address>

                        @endif
                        @if(Helper::GeneralSiteSettings("contact_t3") !="")
                            <p>
                                 <i class="fa fa-phone"></i> &nbsp;<strong>{{ trans('frontLang.callUs') }}:</strong> &nbsp;
                               <a
                                        href="call:{{ Helper::GeneralSiteSettings("contact_t3") }}"><span
                                            dir="ltr">{{ Helper::GeneralSiteSettings("contact_t3") }}</span></a></p>
                        @endif
                        @if(Helper::GeneralSiteSettings("contact_t6") !="")
                            <p>
                                <i class="fa fa-envelope"></i> &nbsp;<strong>{{ trans('frontLang.email') }}:</strong> &nbsp;
                                <a
                                        href="mailto:{{ Helper::GeneralSiteSettings("contact_t6") }}">{{ Helper::GeneralSiteSettings("contact_t6") }}</a>
                            </p>
                        @endif


                </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">

               <div class="footer-logo text-center" style="">
         <h4 class="loh c-second">{{ trans('frontLang.Aim_to_be_distinguished') }} </h4><br>
           <a class="wed-logo-section" href="{{ route("Home") }}">
                    @if(Helper::GeneralSiteSettings("style_logo_w_" . trans('backLang.boxCode')) !="")
                        <img alt=""
                             src="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_logo_w_" . trans('backLang.boxCode'))) }}">
                    @else
                        <img alt="" src="{{ secure_asset('uploads/settings/nologo.png') }}">
                    @endif

                </a>

                        </div>



        </div>
<div class="col-xl-5 col-lg-4 col-md-4 col-sm-5 col-xs-12">
                    <h4> {{ trans('frontLang.HELP_SUPPORT') }}</h4>
                      <ul class="link-list">
                         <?php
                        $link_title_var = "title_" . trans('backLang.boxCode');
                        $main_title_var = "FooterMenuLinks_name_" . trans('backLang.boxCode');
                        $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                        $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                        ?>
                            @foreach($FooterMenuLinks as $FooterMenuLink)
                                @if($FooterMenuLink->type==3 || $FooterMenuLink->type==2)
                                    {{-- Get Section Name as a link --}}
                                    <li>
                                        <?php
                                        if ($FooterMenuLink->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $FooterMenuLink->webmasterSection->$slug_var);
                                            } else {
                                                $mmnnuu_link = url($FooterMenuLink->webmasterSection->$slug_var);
                                            }
                                        } else {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $FooterMenuLink->webmasterSection->name);
                                            } else {
                                                $mmnnuu_link = url($FooterMenuLink->webmasterSection->name);
                                            }
                                        }
                                        ?>
                                        <a href="{{ $mmnnuu_link }}">{{ $FooterMenuLink->$link_title_var }}</a>
                                    </li>
                                @elseif($FooterMenuLink->type==1)
                                    {{-- Direct link --}}
                                    <?php
                                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                        $this_link_url = url(trans('backLang.code') . "/" . $FooterMenuLink->link);
                                    } else {
                                        $this_link_url = url($FooterMenuLink->link);
                                    }
                                    ?>
                                    <li>
                                        <a href="{{ $this_link_url }}">{{ $FooterMenuLink->$link_title_var }}</a>
                                    </li>
                                @else
                                    {{-- No link --}}
                                    <li><a>{{ $FooterMenuLink->$link_title_var }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    <ul>



                </div>


    </div>
<div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mtop15" style="text-align: center;">

                    <span class="copy-right" style="
    color: #f1f1f1;
    font-size: 14px;
">

  <?php
                        $site_title_var = "site_title_" . trans('backLang.boxCode');
                        ?>
                        &copy; <?php echo date("Y") ?> {{ trans('frontLang.AllRightsReserved') }}
                        . <a>{{$WebsiteSettings->$site_title_var}}</a>

                        </span>
                </div>
                <div class="clearfix"></div>
            </div>


        </div>
    </section>
