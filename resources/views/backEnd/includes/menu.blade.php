<?php
// Current Full URL
$fullPagePath = Request::url();
// Char Count of Backend folder Plus 1
$envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
// URL after Root Path EX: admin/home
$urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
$UserPermission_id=@Auth::user()->permissions_id;
$Permission_id=@Auth::user()->permissions_id;
     $PageDetails=\App\Models\PermissionsPage::where('Permission_id',@Auth::user()->permissions_id)->orderby('Permission_id','asc')->pluck('Page_id');
$PagesList=Helper::GetPageIdListBy(@Auth::user()->permissions_id);
//dd($PagesList);
?>

<div id="aside" class="app-aside modal fade folded md nav-expand">
    <div class="left navside dark dk" layout="column">
        <div class="navbar navbar-md no-radius">
            <!-- brand -->
            <a class="navbar-brand" href="{{ route('adminHome') }}">
                <img src="{{ asset('plugins/backEnd/assets/images/logo.png') }}" alt="Control">
                <span class="hidden-folded inline">{{ trans('backLang.control') }}</span>
            </a>
            <!-- / brand -->
        </div>
        <?php
//print_r($PagesList);
        ?>
        <div flex class="hide-scroll">
            <nav class="nav-stacked nav-border scroll nav-active-primary">

                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ trans('backLang.main') }}</small>
                    </li>

                    <li>
                        <a href="{{ route('adminHome') }}" onclick="location.href='{{ route('adminHome') }}'">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe3fc;</i>
                  </span>
                            <span class="nav-text">{{ trans('backLang.dashboard') }}</span>
                        </a>
                    </li>


                    @if(Helper::GeneralWebmasterSettings("analytics_status"))
                        @if(@Auth::user()->permissionsGroup->analytics_status)
                            <?php
                            $currentFolder = "analytics"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                            $currentFolder2 = "ip"; // Put folder name here
                            $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                            $currentFolder3 = "visitors"; // Put folder name here
                            $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder3));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder || $PathCurrentFolder2==$currentFolder2  || $PathCurrentFolder3==$currentFolder3) ? 'class=active' : '' }}>
                                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                                    <span class="nav-icon">
                    <i class="material-icons">&#xe1b8;</i>
                  </span>
                                    <span class="nav-text">{{ trans('backLang.visitorsAnalytics') }}</span>
                                </a>
                                <ul class="nav-sub">
                                    <li>
                                        <a onclick="location.href='{{ route('analytics', 'date') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsBydate') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/country"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'country') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByCountry') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/city"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'city') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByCity') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/os"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'os') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByOperatingSystem') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/browser"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'browser') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByBrowser') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/referrer"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'referrer') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByReachWay') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "analytics/hostname"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'hostname') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByHostName') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "analytics/org"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'org') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByOrganization') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "visitors"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('visitors') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsVisitorsHistory') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "ip"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('visitorsIP') }}">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsIPInquiry') }}</span>
                                        </a>
                                    </li>


                                </ul>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("newsletter_status"))
                        @if(@Auth::user()->permissionsGroup->newsletter_status)
                            <?php
                            $currentFolder = "contacts"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('contacts') }}">
<span class="nav-icon">
<i class="material-icons">&#xe7ef;</i>
</span>
                                    <span class="nav-text">{{ trans('backLang.newsletter') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('webmails') }}">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe156;</i>
                  </span>
                                    <span class="nav-text">{{ trans('backLang.siteInbox') }}
                                        @if( Helper::webmailsNewCount() >0)
                                            <badge class="label warn m-l-xs">{{ Helper::webmailsNewCount() }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Helper::GeneralWebmasterSettings("calendar_status"))
                        @if(@Auth::user()->permissionsGroup->calendar_status)
                            <?php
                            $currentFolder = "calendar"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('calendar') }}" onclick="location.href='{{ route('calendar') }}'">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe5c3;</i>
                  </span>
                                    <span class="nav-text">{{ trans('backLang.calendar') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    <?php
                            $currentFolder = "media"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>

                     <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('media') }}" onclick="location.href='{{ route('media') }}'">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe2c8;</i>
                  </span>
                                    <span class="nav-text">{{ trans('backLang.FileManager') }}</span>
                                </a>
                            </li>



                    <?php
                    $data_sections_arr = explode(",", Auth::user()->permissionsGroup->data_sections);
                    ?>

                <?php


                     $PermissionsPage=0;
                        $SelectedPage=0;
                 $MenutTitles=Helper::ParentMenuBackend(0,0);
                  $CatTitle = "CatTitle_" . trans('backLang.boxCode');


                    ?>
                 @if(count((array)$MenutTitles)>0)
                     @foreach($MenutTitles as $MenutTitle)


                       <?php



           $Page_id=0;
                  $Father_id=$MenutTitle->Cat_id;
               $listid=array_values($PagesList);
        $MainMenus= \App\Models\CategorieSection::where('Father_id',$Father_id)->whereIn('Cat_id',$listid)->where('CatStatus','Active')->orderby('row_no','asc')->get();
             // $MainMenus=Helper::MenuSectionSite($Father_id);

              //571775002564288
       // dd($MainMenus);
            if(count($MainMenus)>0){


                   ?>

                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{  $MenutTitle->$CatTitle }}</small>
                   </li>

                   <?php

                  foreach($MainMenus as $MainMenu){
                          $CatType=$MainMenu->CatType;
                            $Page_id=$MainMenu->Cat_id;
                           $currentFolder =$MainMenu->Catlink;
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            $ClassActive="";
                            if ($PathCurrentFolder==$MainMenu->Catlink) {
                                    $ClassActive="active";
                               }
                        $Father_idSub=$MainMenu->Cat_id;

                       $SubMenus=Helper::MenuSectionSite($Father_idSub);
                   $CheckIsPage=Helper::GetPageInPrimion($Permission_id,$Father_idSub);

                       ?>

                       @if(count($SubMenus)==0 && $MainMenu->CatType==1)


                      @if(in_array($MainMenu->Cat_id,$PagesList))

                          <li id="{{ $MainMenu->Catlink }}" class="{{ $ClassActive }}">

                           <a href="{{ route($MainMenu->Catlink) }}">
                                   <span class="nav-icon">

                                     <i class="material-icons fa {{ $MainMenu->CatIcon }}"></i>

                                   </span>
                                    <span class="nav-text">{{  $MainMenu->$CatTitle }}</span>
                                </a>
                            </li>

                            @endif

                          @elseif($MainMenu->CatType==2)
                           <?php
                           $Section_idM=$MainMenu->Subcat_id;

                          $SectionMain=Helper::SectionSiteInMenu($Section_idM);


                           ?>
                        @if(count((array)$SectionMain)>0)
                        @if(in_array($MainMenu->Cat_id,$PagesList))
                          @if($SectionMain->status>0)
                          <li id="{{ $MainMenu->Catlink }}" class="{{ $ClassActive }}">

                           <a href="{{  (Route::has($MainMenu->Catlink,$MainMenu->Subcat_id))? route($MainMenu->Catlink,$MainMenu->Subcat_id):'#' }}">
                                   <span class="nav-icon">

                                     <i class="material-icons fa {{ $MainMenu->CatIcon }}"></i>

                                   </span>
                                    <span class="nav-text">{{  $MainMenu->$CatTitle }}</span>
                                </a>
                            </li>
                            @endif
                        @endif
                      @endif
                          @elseif(count($SubMenus)>0 && $MainMenu->CatType==0 && count($CheckIsPage)>0)


                                <li>
                                    <a>
                                <span class="nav-caret">
                                   <i class="fa fa-caret-down"></i>
                                 </span>
                                    <span class="nav-icon">
                                        <i class="material-icons fa {{ $MainMenu->CatIcon }}"></i>
                                       </span>
                                    <span class="nav-text"> {{  $MainMenu->$CatTitle }}</span>
                                    </a>
                                <ul class="nav-sub">
                                   @foreach($SubMenus as $SubMenu)

                                    <?php
                                    $Page_idsub=$SubMenu->Cat_id;
                                //if(in_array($Page_idsub,$PagesList)) {
                                     $currentFolder1=$MainMenu->Catlink.'/'.$SubMenu->Catlink;

                                       $currentFolder1=$SubMenu->Catlink;
                                    $ClassActive1=Helper::GetMenuActiveId($urlAfterRoot,$currentFolder1);
                                        $RouteContent=$SubMenu->Catlink;
                                        if ($MainMenu->Catlink!='') {
                                            $RouteContent=$MainMenu->Catlink.','.$SubMenu->Catlink;
                                        }
                                  // Route::exists()
                       //if(Route::has($MainMenu->Catlink,$SubMenu->Catlink))
                                    // $RouteContent=Helper::FilterRoutMenu($SubMenu->Catlink);




                                    ?>
                             @if(in_array($SubMenu->Cat_id,$PagesList))
                                  @if($SubMenu->CatType==2)
                                  <?php
                                    $Section_id=$SubMenu->Subcat_id;

                                   $Sections=Helper::SectionSiteInMenu($Section_id);


                                  ?>
                                  @if(count((array)$Sections)>0)
                                  @if($SubMenu->Catlink=='sections')
                                    @if($Sections->sections_status>0)
                                        <li class="{{ $ClassActive1 }} {{ $currentFolder1 }}">
                                          <a href="{{ route($SubMenu->Catlink,$SubMenu->Subcat_id) }}">
                                                <span class="nav-text"> {{  $SubMenu->$CatTitle }}</span>
                                            </a>
                                        </li>
                                      @endif

                                      @else
                                        @if($Sections->status>0)
                                         <li class="{{ (request()->is(env('BACKEND_PATH').'/'.$SubMenu->Subcat_id.'/topics')) ? 'active' : '' }}">

                                         <?php  //dd($SubMenu->Catlink); ?>

                                               <a href="{{  url(env('BACKEND_PATH').'/'.$SubMenu->Subcat_id.'/topics') }}">
                                                <span class="nav-text"> {{  $SubMenu->$CatTitle }}</span>
                                            </a>

                                        </li>
                                       @endif


                                   @endif
                                      @endif


                                    @elseif($SubMenu->CatType==1)
                                     <li class="{{ (request()->is(env('BACKEND_PATH').'/'.$SubMenu->Catlink)) ? 'active' : '' }}">

                                         <?php  //dd($SubMenu->Catlink); ?>

                                               <a href="{{  url(env('BACKEND_PATH').'/'.$SubMenu->Catlink) }}">
                                                <span class="nav-text"> {{  $SubMenu->$CatTitle }}</span>
                                            </a>

                                        </li>



                                    @else
                                   @if(count($CheckIsPage)>0)
                                <li class="{{ $ClassActive1 }} {{ $currentFolder1 }}">
                                      @if($MainMenu->Catlink!="")

                                      <a href="{{ route($MainMenu->Catlink,$SubMenu->Catlink) }}">
                                        @elseif(strpos($SubMenu->Catlink,'/') !== false)
                                            <a href="{{ url($SubMenu->Catlink) }}">
                                        @elseif(Route::has($SubMenu->Catlink))
                                         <a href="{{ route($SubMenu->Catlink)}}">
                                         @endif
                                            <span class="nav-text"> {{  $SubMenu->$CatTitle }}</span>
                                        </a>
                                    </li>
                                      @endif {{-- CheckIsPage --}}
                                    @endif
                                  @endif


                                     @endforeach


                                </ul>
                            </li>




                         @endif





                      <?php



            }


              }








                      ?>





                         @endforeach
                      @endif




                   <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ trans('backLang.DeveloperSection') }}</small>
                    </li>


                    @if(@Auth::user()->permissionsGroup->webmaster_status)
                        <?php
                        $currentFolder = "webmaster"; // Put folder name here
                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                        ?>
                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                            <a>
<span class="nav-caret">
<i class="fa fa-caret-down"></i>
</span>
                                <span class="nav-icon">
<i class="material-icons">&#xe8be;</i>
</span>
                                <span class="nav-text">{{ trans('backLang.webmasterTools') }}</span>
                            </a>
                            <ul class="nav-sub">
                                <?php
                                $PathCurrentSubFolder = substr($urlAfterRoot, 0, (strlen($currentFolder) + 1));
                                ?>
                                <li {{ ($PathCurrentFolder==$PathCurrentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('webmasterSettings') }}">
                                        <span class="nav-text">{{ trans('backLang.generalSettings') }}</span>
                                    </a>
                                </li>
                                 <?php
                                    $currentFolder = "Catmenus"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('Catmenus') }}">
                                            <span class="nav-text">{{ trans('backLang.CatBackendMenu') }}</span>
                                        </a>
                                    </li>
                                <?php
                                $currentSubFolder = "sections"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('WebmasterSections') }}">
                                        <span class="nav-text">{{ trans('backLang.siteSectionsSettings') }}</span>
                                    </a>
                                </li>
                                <?php
                                $currentSubFolder = "banners"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('WebmasterBanners') }}">
                                        <span class="nav-text">{{ trans('backLang.adsBannersSettings') }}</span>
                                    </a>
                                </li>

                                <?php
                                $currentSubFolder = "translations"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ url(env('BACKEND_PATH').'/webmaster/translations') }}">
                                        <span class="nav-text">{{ trans('backLang.translations') }}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    @endif
                </ul>
            </nav>
        </div>
        <div flex-no-shrink>
            <div>
                <nav ui-nav>
                    <ul class="nav">

                        <li>
                            <div class="b-b b m-t-sm"></div>
                        </li>
                        <li class="no-bg"><a href="{{ url('/logout') }}"
                                             onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="nav-icon"><i class="material-icons">&#xe8ac;</i></span>
                                <span class="nav-text">{{ trans('backLang.logout') }}</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
