<?php
// Current Full URL
$fullPagePath = Request::url();
// Char Count of Backend folder Plus 1
$envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
// URL after Root Path EX: admin/home
$urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
$LangCode=trans('backLang.boxCode');
 $CatTitle = "CatTitle_" . trans('backLang.boxCode');


?>


<div id="aside" class="app-aside modal fade folded md nav-expand">
    <div class="left navside  dark dk" layout="column">
        <div class="navbar navbar-md no-radius">
            <!-- brand -->
            <a class="navbar-brand" href="{{ route('adminHome') }}">
                <img src="{{ asset('plugins/backEnd/assets/images/logo.png') }}" alt="Control">
                <span class="hidden-folded inline">{{ trans('backLang.control') }}</span>
            </a>
            <!-- / brand -->
        </div>
        <div flex class="hide-scroll">
            <nav flex class="nav-stacked nav-border scroll nav-active-primary">
 <?php   // echo $urlAfterRoot;      ?>
                <ul class="nav" ui-nav>


                    <?php

                  $MenutTitles=Helper::ParentMenuBackend(0,0);


                    ?>
                 @if(count($MenutTitles)>0)
                     @foreach($MenutTitles as $MenutTitle)
                         <li class="nav-header hidden-folded">
                        <small class="text-muted">{{  $MenutTitle->$CatTitle }}</small>
                       </li>

                       <?php

                       $Father_id=$MenutTitle->Cat_id;

           $MainMenus=Helper::MenuSectionSite($Father_id);


            if(count($MainMenus)>0){

                  foreach($MainMenus as $MainMenu){
                          $CatType=$MainMenu->CatType;

                           $currentFolder =$MainMenu->Catlink;
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            $ClassActive="";
                            if ($PathCurrentFolder==$MainMenu->Catlink) {
                                    $ClassActive="active";
                               }
                        if ($MainMenu->CatType==1) {
                              ?>
                          @if(Route::has($MainMenu->Catlink))
                          <li id="{{ $MainMenu->Catlink }}" class="{{ $ClassActive }}">

                           <a href="{{ route($MainMenu->Catlink) }}">
                                   <span class="nav-icon">

                                     <i class="material-icons fa {{ $MainMenu->CatIcon }}"></i>

                                   </span>
                                    <span class="nav-text">{{  $MainMenu->$CatTitle }}</span>
                                </a>
                            </li>
                            @endif





                      <?php
                           }elseif ($MainMenu->CatType==0) {


                             $Father_idSub=$MainMenu->Cat_id;

                              $SubMenus=Helper::MenuSectionSite($Father_idSub);



                            ?>

                          @if(count($SubMenus)>0)
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

                                  @if($SubMenu->CatType==2)
                                  <?php
                                    $Section_id=$SubMenu->Subcat_id;

                                   $Sections=Helper::SectionSiteInMenu($Section_id);


                                  ?>
                                  @if($SubMenu->Catlink=='sections')
                                    @if($Sections->sections_status>0)
                                        <li class="{{ $ClassActive1 }} {{ $currentFolder1 }}">
                                          <a href="{{ route($SubMenu->Catlink,$SubMenu->Subcat_id) }}">
                                                <span class="nav-text"> {{  $SubMenu->$CatTitle }}</span>
                                            </a>
                                        </li>
                                      @endif

                                      @elseif($SubMenu->Catlink=='topics')
                                        @if($Sections->status>0)
                                         <li class="{{ $ClassActive1 }} {{ $currentFolder1 }}">
                                          <a href="{{ route($SubMenu->Catlink,$SubMenu->Subcat_id) }}">
                                                <span class="nav-text"> {{  $SubMenu->$CatTitle }}</span>
                                            </a>
                                        </li>
                                       @endif
                                   @endif



                                    @else

                                <li class="{{ $ClassActive1 }} {{ $currentFolder1 }}">
                                      @if($MainMenu->Catlink!="")
                                      <a href="{{ route($MainMenu->Catlink,$SubMenu->Catlink) }}">
                                        @elseif(strpos($SubMenu->Catlink,'/') !== false)
                                            <a href="{{ url($SubMenu->Catlink) }}">
                                        @elseif(Route::has($SubMenu->Catlink))
                                         <a href="{{ route($SubMenu->Catlink) }}">
                                         @endif
                                            <span class="nav-text"> {{  $SubMenu->$CatTitle }}</span>
                                        </a>
                                    </li>
                                    @endif


                                     @endforeach


                                </ul>
                            </li>
                        @else

                          @if(Route::has($MainMenu->Catlink))
                              <li id="{{ $MainMenu->Catlink }}" class="{{ $ClassActive }}">
                               <a href="{{ route($MainMenu->Catlink) }}">
                                       <span class="nav-icon">

                                         <i class="material-icons fa {{ $MainMenu->CatIcon }}"></i>

                                       </span>
                                        <span class="nav-text">{{  $MainMenu->$CatTitle }}</span>
                                    </a>
                                </li>

                               @endif
                             @endif



                            <?php


                    }elseif ($MainMenu->CatType==2) {

                          $Section_idM=$MainMenu->Subcat_id;

                          $SectionMain=Helper::SectionSiteInMenu($Section_idM);

                           ?>
                       @if($SectionMain->status>0)
                          <li id="{{ $MainMenu->Catlink }}" class="{{ $ClassActive }}">

                           <a href="{{ route($MainMenu->Catlink,$MainMenu->Subcat_id) }}">
                                   <span class="nav-icon">

                                     <i class="material-icons fa {{ $MainMenu->CatIcon }}"></i>

                                   </span>
                                    <span class="nav-text">{{  $MainMenu->$CatTitle }}</span>
                                </a>
                            </li>
                            @endif


                      <?php



                         }

            }

          }








                      ?>





                         @endforeach
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
