    <?php
// Current Full URL
$fullPagePath = Request::url();
// Char Count of Backend folder Plus 1
$envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
// URL after Root Path EX: admin/home
$urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);


?>
<?php
$category_title_var = "title_" . trans('backbackLang.boxCode');
$slug_var = "seo_url_slug_" . trans('backbackLang.boxCode');
$slug_var2 = "seo_url_slug_" . trans('backbackLang.boxCodeOther');
$link_title_var = "title_" . trans('backLang.boxCode');
 $title_var = "title_" . trans('backLang.boxCode');
    $title_var2 = "title_" . trans('backLang.boxCodeOther');
    $details_var = "details_" . trans('backLang.boxCode');
    $details_var2 = "details_" . trans('backLang.boxCodeOther');
$BannerMenu="Banner_menu_about";
?>
<style type="text/css">
  .menu > .nav-item.submenu .dropdown-menu .nav-item:last-child {
     padding-bottom:20px;
    margin-bottom: -8px;
}

.menu > .nav-item.submenu .dropdown-menu .nav-item:first-child {
     padding-top:20px;
}
.rtl .menu > .nav-item.submenu .dropdown-menu{
  text-align:right;
}
#landing_page .w_menu .nav-item .nav-link.active, #landing_page .w_menu .nav-item .nav-link:hover {
    color: #000;
}
.rtl .menu > .nav-item.submenu .dropdown-menu{
left:unset;
right:0;
}
 .menu > .nav-item.submenu .dropdown-menu {

    top: 77%;
}
.menu > .nav-item.submenu .dropdown-menu .nav-item {

    padding: 0px 15px;

}

@media (max-width:500px) {
  .menu_four .btn_get a{
    color: #000;
  }

}
@media (max-width: 991px){
 .menu_four .navbar-collapse.in{

    display: block;
}
}

</style>
 <header class="header_area ">
                <nav class="navbar navbar-expand-lg menu_one menu_four" id="landing_page">
                    <div class="container-fluid">
                       <a href="{{ route("FacultyPage",$FacultyData->id) }}" class="wed-logo-section navbar-brand sticky_logo">
           @if($FacultyData->logo2!='#')

                 <img alt="{{ $FacultyData->$title_var }}"
            src="{{ Helper::FilterImage($FacultyData->logo2) }}" >
           @else

         @if(Helper::GeneralSiteSettings("style_logo_w_".trans('backLang.boxCode')) !="" )
      <img alt=""
           src="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_logo_w_" . trans('backLang.boxCode'))) }}" srcset="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_logo_w_" . trans('backLang.boxCode'))) }}" >


      @else
      <img alt="" src="{{ secure_asset('uploads/settings/nologo.png') }}" srcset="{{ secure_asset('uploads/settings/nologo.png') }}" class="wed-logo-section">
      @endif

        @endif



 @if($FacultyData->logo!='#')
             <img alt="{{ $FacultyData->$title_var }}"
            src="{{ Helper::FilterImage($FacultyData->logo) }}" >

            @else
              @if(Helper::GeneralSiteSettings("style_logo_".trans('backLang.boxCode')) !="" )
      <img alt=""
           src="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode'))) }}" srcset="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode'))) }}">


      @else
      <img alt="" src="{{ secure_asset('uploads/settings/nologo.png') }}" srcset="{{ secure_asset('uploads/settings/nologo.png') }}" >
      @endif

       @endif




                            </a>

                      {{--   <a class="btn_get btn_hover mobile_btn ml-auto" href="{{ url(trans('backLang.code').'/view/admission') }}">{{ trans('frontLang.Admission') }}</a> --}}
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_toggle">
                                <span class="hamburger">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="hamburger-cross">
                                    <span></span>
                                    <span></span>
                                </span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav mr-auto ml-auto menu w_menu">
                   {{--       @foreach($HeaderMenuOnePageLinks as $key=> $HeaderMenuLink) --}}
                          <li class="nav-item"><a href="{{ url(trans('backLang.boxCode').'/'.$FacultyData->id.'/faculty/about') }}" class="nav-link">{{ trans('frontLang.about_us') }}</a></li>

                              <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   {{ trans('frontLang.departments') }}
                                </a>
                                <ul class="dropdown-menu">
                                  @if(count($FacultyData->departments)>0)

                                      @foreach($FacultyData->departments as $key => $Item)
                                          <li class="nav-item"><a href="{{ url(trans('backLang.boxCode').'/'.$FacultyData->id.'/departments/'.$Item->id) }}" class="nav-link">{{ $Item->$title_var }}</a></li>
                                     @endforeach
                                     @endif

                                </ul>
                            </li>
                      <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   {{ trans('frontLang.Programs') }}
                                </a>
                                <ul class="dropdown-menu">
                                     @if(count($FacultyData->programs)>0)

                                      @foreach($FacultyData->programs as $key => $Item)
                                          <li class="nav-item"><a href="{{ url(trans('backLang.boxCode').'/faculty/programs/'.$Item->id) }}" class="nav-link">{{ $Item->$title_var }}</a></li>
                                     @endforeach
                                     @endif

                                </ul>
                            </li>
                             <li class="nav-item"><a href="#" class="nav-link">{{ trans('frontLang.Research') }}</a></li>
                              {{-- <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="home-security.html#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   {{ trans('frontLang.Research') }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="blog-grid.html" class="nav-link">{{ trans('frontLang.Research') }}</a></li>

                                </ul>
                            </li> --}}


                         <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   {{ trans('frontLang.more') }}
                                </a>
                                <ul class="dropdown-menu">

                                    <li class="nav-item"><a href="{{ url(trans('backLang.code').'/'.$FacultyData->id.'/news/faculty/') }}" class="nav-link">{{ trans('frontLang.News') }}</a></li>
                                    <li class="nav-item"><a href="{{ url(trans('backLang.code').'/'.$FacultyData->id.'/events/') }}" class="nav-link">{{ trans('frontLang.Events_Activities') }}</a></li>
                                    <li class="nav-item"><a href="{{ url(trans('backLang.code').'/'.$FacultyData->id.'/announcements/') }}" class="nav-link">{{ trans('frontLang.announcements') }}</a></li>
                                     <li class="nav-item"><a href="{{ url(trans('backLang.code').'/'.$FacultyData->id.'/lecturertable/') }}" class="nav-link">{{ trans('frontLang.lecturertable') }}</a></li>

                                </ul>
                            </li>



                         {{--  @endforeach --}}



                            </ul>
                              <div class="btn_hover btn_get">
                            @if(trans('backLang.code')=="ar")
                                <a href="{{  url(Helper::ChangeUrl('en'))   }}" class="language "><i
                                            class="fa fa-language "></i> {{-- {{ str_replace("[ ","",str_replace(" ]","",strip_tags(trans('backLang.englishBox')))) }} --}}
                                </a>
                            @else
                                <a href="{{ url( Helper::ChangeUrl('ar')) }}" class="language btn_get"><i
                                            class="fa fa-language "></i>{{--  {{ str_replace("[ ","",str_replace(" ]","",strip_tags(trans('backLang.arabicBox')))) }} --}}
                                </a>
                            @endif
                            &nbsp;| &nbsp;
                            <a href="{{ route('Home') }}" class="service_item1">

                                        <i class="icon fa fa-home"></i>



                            </a>
                          </div>


                          {{--   <a class="btn_get btn_hover" href="{{ url(trans('backLang.code').'/view/admission') }}">{{ trans('frontLang.Admission') }}</a> --}}
                        </div>
                    </div>
                </nav>
            </header>
