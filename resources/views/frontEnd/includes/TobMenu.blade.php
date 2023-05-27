    <?php

     $TobHeaderLinks =App\Models\Menu::where('father_id',19)->where('status',
            1)->orderby('row_no',
            'asc')->get();

                        $link_title_var = "title_" . trans('backLang.boxCode');
                        $main_title_var = "TobHeaderLinks_name_" . trans('backLang.boxCode');
                        $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                        $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                        ?>
   
  <!-- TOP BAR -->
        <div class="ed-top">
            <div class="container"    style=" background-color: #005fae;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ed-com-t1-left">
                               
                        
                        </div>
                       
                        <div class="ed-com-t1-left">
               
                              <ul>
                          
                        @if(count((array)$TobHeaderLinks)>0)
                           @foreach($TobHeaderLinks as $TobHeaderLink)
                                @if($TobHeaderLink->type==3 || $TobHeaderLink->type==2)


                                       <li>
                                        <?php
                                        if ($TobHeaderLink->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $TobHeaderLink->webmasterSection->$slug_var);
                                            } else {
                                                $mmnnuu_link = url($TobHeaderLink->webmasterSection->$slug_var);
                                            }
                                        } else {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $TobHeaderLink->webmasterSection->name);
                                            } else {
                                                $mmnnuu_link = url($TobHeaderLink->webmasterSection->name);
                                            }
                                        }
                                        ?>

                                        <a href="{{ $mmnnuu_link }}">{{ $TobHeaderLink->$link_title_var }}</a>
                                    </li>
                                @elseif($TobHeaderLink->type==1)
                                    {{-- Direct link --}}
                                    <?php
                                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                        $this_link_url = url(trans('backLang.code') . "/" . $TobHeaderLink->link);
                                    } else {
                                        $this_link_url = url($TobHeaderLink->link);
                                    }
                                    ?>
                                    <li>
                                        <a href="{{ $this_link_url }}">{{ $TobHeaderLink->$link_title_var }}</a>
                                    </li>
                                @else
                                    {{-- No link --}}
                                    <li><a>{{ $TobHeaderLink->$link_title_var }}</a></li>
                                @endif
                            @endforeach
                                 @endif
                                 <li>
                                      @if($WebmasterSettings->languages_count ==2)
                        
                        <strong>
                            @if(trans('backLang.code')=="ar")
                                <a href="{{ url(Helper::ChangeUrl('en')) }}" class="language"><i
                                            class="fa fa-language "></i> {{ str_replace("[ ","",str_replace(" ]","",strip_tags(trans('backLang.englishBox')))) }}
                                </a>
                            @else
                                <a href="{{ url(Helper::ChangeUrl('ar')) }}" class="language"><i
                                            class="fa fa-language "></i> {{ str_replace("[ ","",str_replace(" ]","",strip_tags(trans('backLang.arabicBox')))) }}
                                </a>
                            @endif

                        </strong>
                    @endif
                   
                             </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
