    <?php

     $QuickLinks =App\Models\Menu::where('father_id',48)->where('status',
            1)->orderby('row_no',
            'asc')->get();

                        $link_title_var = "title_" . trans('backLang.boxCode');
                        $main_title_var = "QuickLinks_name_" . trans('backLang.boxCode');
                        $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                        $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                        ?>

              @if(count((array)$QuickLinks)>0) 
               <ul class="menu menu--secondary-menu nav">
                            @foreach($QuickLinks as $QuickLink)
                                @if($QuickLink->type==3 || $QuickLink->type==2)
                                    {{-- Get Section Name as a link --}}
                                    <li>
                                        <?php
                                        if ($QuickLink->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $QuickLink->webmasterSection->$slug_var);
                                            } else {
                                                $mmnnuu_link = url($QuickLink->webmasterSection->$slug_var);
                                            }
                                        } else {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $QuickLink->webmasterSection->name);
                                            } else {
                                                $mmnnuu_link = url($QuickLink->webmasterSection->name);
                                            }
                                        }
                                        ?>

                                        <a href="{{ $mmnnuu_link }}"><i class="fa fas fa-th" aria-hidden="true"></i>&nbsp;&nbsp;{{ $QuickLink->$link_title_var }}</a>
                                    </li>
                                @elseif($QuickLink->type==1)
                                    {{-- Direct link --}}
                                    <?php
                                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                        $this_link_url = url(trans('backLang.code') . "/" . $QuickLink->link);
                                    } else {
                                        $this_link_url = url($QuickLink->link);
                                    }
                                    ?>
                                    <li>
                                        <a href="{{ $this_link_url }}"><i class="fa fas fa-th" aria-hidden="true"></i>&nbsp;&nbsp;{{ $QuickLink->$link_title_var }}</a>
                                    </li>
                                @else
                                    {{-- No link --}}
                                    <li><a>{{ $QuickLink->$link_title_var }}</a></li>
                                @endif
                            @endforeach
                        </ul>
    @endif