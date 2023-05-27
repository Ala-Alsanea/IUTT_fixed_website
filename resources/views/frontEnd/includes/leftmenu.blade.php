   

              @if(count((array)$sideBarMenuadmission)>0) 
           
   

    <div class="col-lg-3 col-sm-3 col-md-3" style="background-color: #005fae;padding: 10px;">
                    <div class="left-nav" style="background-color: #005fae;">
                        <nav class="navbar navbar-default">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-left-menu" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse left-nav" id="my-left-menu">
                                <ul id="ctl00_PlaceHolderMain_MyCurrentNavigation_navUL" class="nav navbar-nav">
                                   @foreach($sideBarMenuadmission as $leftMenus)
                                @if($leftMenus->type==3 || $leftMenus->type==2)

                                  <?php
                                        if ($leftMenus->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $leftMenus->webmasterSection->$slug_var);
                                            } else {
                                                $mmnnuu_link = url($leftMenus->webmasterSection->$slug_var);
                                            }
                                        } else {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $leftMenus->webmasterSection->name);
                                            } else {
                                                $mmnnuu_link = url($leftMenus->webmasterSection->name);
                                            }
                                        }
                                        ?>
                                
                                   
                                    <li><a class="text-capitalize" href="{{ $mmnnuu_link }}">{{ $leftMenus->$title_var }}</a> </a></li>
                                 
                                        @elseif($leftMenus->type==1)

                                         <?php
                                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                        $this_link_url = url(trans('backLang.code') . "/" . $leftMenus->link);
                                    } else {
                                        $this_link_url = url($leftMenus->link);
                                    }
                                    ?>

                                      <li>
                                        <a class="text-capitalize" href="{{ $this_link_url }}">{{ $leftMenus->$title_var }}</a>
                                    </li>
                                @else
                                    {{-- No link --}}
                                    <li><a>{{ $leftMenus->$title_var }}</a></li>
                                @endif
                            @endforeach


                                      
                                  
                                   
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <div>
                        <span id="ctl00_PlaceHolderMain_MyCurrentNavigation_lblResult"></span>
                    </div>

                    <style>
                        .left-nav ul {
                            list-style: none;
                            margin: 0;
                            padding: 0;
                        }
                        .left-nav ul li {
                            min-height: 40px;
                            position: relative;
                            width: 100%;
                            border-bottom: 1px #fff solid;
                             border-bottom-width: thin;
                        }
                        .navbar-default .navbar-collapse, .navbar-default .navbar-form {
                            border-color: #efdddd;
                            background-color: #f3f3f3;
                            background-color: #005fae;
                                }
                        .left-nav ul li a,
                        .left-nav ul li a:visited {
                            color: #fff !important;
                            display: inline-block;
                            font-family: "Montserrat", sans-serif;
                            font-size: 16px;
                            padding: 10px;
                            text-decoration: none;
                            letter-spacing: 0;
                        }
                        .left-nav ul li a:hover {
                            text-decoration: none;
                        }
                        .left-nav ul li::before {
                            content: "";
                            background: #fff none repeat scroll 0 0;
                            height: 4px;
                            width: 90%;
                            position: absolute;
                            bottom: 0;
                            left: 0;
                            opacity: 0;
                            pointer-events: none;
                            transition: width 0.45s ease 0s, opacity 0.1s ease 0s;
                            width: 0;
                        }
                        .left-nav ul li:hover::before {
                            opacity: 1;
                            text-decoration: none;
                            width: 100%;
                        }

                        .left-nav button {
                            min-width: 0;
                        }
                        .left-nav .navbar-default {
                            background-color: transparent !important;
                            border: none;
                            background-image: none;
                            box-shadow: none;
                        }
                        .left-nav .navbar-default .navbar-toggle {
                            border-color: #fff;
                        }
                        .left-nav .navbar-default .navbar-toggle .icon-bar {
                            background-color: #fff;
                        }
                        .btn-custom{
                            text-transform:capitalize;
                            color:#fff; 
                        }
                    </style>
                </div>

                 @endif