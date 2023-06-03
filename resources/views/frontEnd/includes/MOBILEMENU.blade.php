 <!-- MOBILE MENU -->
 <?php
$category_title_var = "title_" . trans('backLang.boxCode');
$title_var = "title_" . trans('backLang.boxCode');
$slug_var = "seo_url_slug_" . trans('backLang.boxCode');
$slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
$link_title_var = "title_" . trans('backLang.boxCode');
$BannerMenu="Banner_menu_about";
?>
    <section>
        <div class="ed-mob-menu">
            <div class="ed-mob-menu-con">
                <div class="ed-mm-left">
                    <div class="wed-logo">
                        <a href="{{ route("Home") }}" class="wed-logo-section">
                           @if(Helper::GeneralSiteSettings("style_logo_".trans('backLang.boxCode')) !="" )
      <img alt=""
           src="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode'))) }}" srcset="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode'))) }}" >


      @else
      <img alt="" src="{{ asset('uploads/settings/nologo.png') }}" srcset="{{ asset('uploads/settings/nologo.png') }}" >
      @endif


                            </a>
                    </div>
                </div>
                <div class="ed-mm-right">
                    <div class="ed-mm-menu">
                       <div class="ed-micon d-flex">

                         <a href="#!" class=""><i class="fa fa-bars"></i></a>
                            @if($WebmasterSettings->languages_count ==2)


                            @if(trans('backLang.code')=="ar")
                                <a href="{{ url(Helper::ChangeUrl('en')) }}" class="" style="color: #0d6ab0;border: 1px solid #0a2444;padding: 0px 5px;font-size: 17px;">  {{ str_replace("[ ","",str_replace(" ]","",strip_tags(trans('backLang.boxCodeOther')))) }}
                                </a>
                            @else
                                <a href="{{ url(Helper::ChangeUrl('ar')) }}" class="" style="color: #0d6ab0;border: 1px solid #0a2444;padding:0px 5px;font-size: 17px;"> {{ str_replace("[ ","",str_replace(" ]","",strip_tags(trans('backLang.boxCodeOther')))) }}
                                </a>
                            @endif


                    @endif
                        <div class="ed-mm-inn">
                          <a href="#!" class="ed-mi-close"><i class="fa fa-times"></i></a>
                     @foreach($HeaderMenuLinks as $key=> $HeaderMenuLink)
                         @if($HeaderMenuLink->father_id ==1)

                            <h4>{{ $HeaderMenuLink->$link_title_var }}</h4>
                            <ul>
                     @foreach($HeaderMenuLink->subMenus as $subMenus)
                            @if($subMenus->status==1)

                          <li> <h4 class="m-header">{{ $subMenus->$link_title_var }}</h4></li>

                             @if($subMenus->type==1)
     <?php
                         $namesection='';
                         $endlenk='/home';
                  $faculties = App\Models\Faculty::where('status', 1)->get();






                             ?>


                          @if(count($faculties->toArray())>0)
                                   @foreach($faculties as  $MenuSectionCustom)

             <?php
             $MenuSectionCustom_link_url=url(trans('backLang.code').'/'.$MenuSectionCustom->url_link);
                    if ($MenuSectionCustom->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                    $MenuSectionCustom_link_url = url(trans('backLang.code')."/" .$MenuSectionCustom->$slug_var);
                    }else{
                    $MenuSectionCustom_link_url = url($MenuSectionCustom->$slug_var);
                    }
             }
                    ?>



                                      <li><a  href="{{ url(trans('backLang.code').'/faculties/'.$MenuSectionCustom->id).$endlenk }}"> {{ $MenuSectionCustom->$title_var }}</a></li>


                                      @endforeach


                        @endif



                  @elseif($subMenus->type==3)


                     @if(count($subMenus->webmasterSection->sections) >0)

                        @foreach($subMenus->webmasterSection->sections as $SubMnuCategory)
            @if($SubMnuCategory->father_id ==0 && $SubMnuCategory->status ==1)

                    <?php

                    $Category_link_url1 =url(($SubMnuCategory->section_url=='')?'#':trans('backLang.code').'/'.$SubMnuCategory->section_url);
                    if ($SubMnuCategory->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                    $Category_link_url1 = url(trans('backLang.code')."/" .$SubMnuCategory->$slug_var);
                    }else{
                    $Category_link_url1 = url($SubMnuCategory->$slug_var);
                    }
                    }
                    ?>
                    <li><a  href="{{ $Category_link_url1 }}"> {{$SubMnuCategory->$title_var}}</a></li>


            @endif

        @endforeach









                    @endif






                  @else

                         @foreach($subMenus->subMenus as $keys=> $subMenusFilnal)
                               @if($subMenusFilnal->status==1)
                                 @if($HeaderMenuLink->link=='admi' && $keys==$subMenus->subMenus->count()-1)
                                     <li><a  class="mm-r-m-btn-cust btn_m" href="{{ url($subMenusFilnal->link) }}">{{ $subMenusFilnal->$link_title_var }}</a></li>

                                 @else
                                    <li><a  href="{{ url(trans('backLang.code').'/'.$subMenusFilnal->link) }}">{{ $subMenusFilnal->$link_title_var }}</a></li>
                                     @endif
                              @endif
                           @endforeach





                         @endif



                           @endif
                      @endforeach
                            </ul>
                           @endif
                      @endforeach
                            <h4>User Account</h4>
                            <ul>
                                <li><a href="#!" data-toggle="modal" data-target="#modal1">Sign In</a></li>
                                <li><a href="#!" data-toggle="modal" data-target="#modal2">Register</a></li>
                            </ul>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--HEADER SECTION-->
