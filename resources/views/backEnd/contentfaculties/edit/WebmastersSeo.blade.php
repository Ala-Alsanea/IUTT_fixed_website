
    @if(Helper::GeneralWebmasterSettings("seo_status"))
        <div class="tab-pane  {{ $tab_2 }}" id="tab_seo">

            <div class="box-body">
                {{Form::open(['route'=>['contentfacultiesSEOUpdate',"id"=>$contentsections->id],'method'=>'POST'])}}
                <div class="row">
                    <div class="col-sm-6">
                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group">
                                <div>
                                    <small>{!!  trans('backLang.topicSEOTitle') !!}</small>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.arabicBox') !!}</small> @endif

                                    {!! Form::text('seo_title_ar',$contentsections->seo_title_ar, array('class' => 'form-control','id'=>'seo_title_ar','maxlength'=>'65', 'dir'=>trans('backLang.rtl'))) !!}
                                </div>
                            </div>
                        @endif

                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group">
                                <div>
                                    <small>{!!  trans('backLang.friendlyURL') !!}</small>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.arabicBox') !!}</small> @endif

                                    {!! Form::text('seo_url_slug_ar',$contentsections->seo_url_slug_ar, array('class' => 'form-control','id'=>'seo_url_slug_ar', 'dir'=>trans('backLang.rtl'))) !!}
                                </div>
                            </div>
                        @endif

                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group">
                                <div>
                                    <small>{!!  trans('backLang.topicSEODesc') !!}</small>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.arabicBox') !!}</small> @endif

                                    {!! Form::textarea('seo_description_ar',$contentsections->seo_description_ar, array('class' => 'form-control','id'=>'seo_description_ar','maxlength'=>'165', 'dir'=>trans('backLang.rtl'),'rows'=>'2')) !!}
                                </div>
                            </div>
                        @endif

                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group">
                                <div>
                                    <small>{!!  trans('backLang.topicSEOKeywords') !!}</small>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.arabicBox') !!}</small>@endif

                                    {!! Form::textarea('seo_keywords_ar',$contentsections->seo_keywords_ar, array('class' => 'form-control','id'=>'seo_keywords_ar', 'dir'=>trans('backLang.rtl'),'rows'=>'2')) !!}
                                </div>
                            </div>
                            <br>
                            <br>
                        @endif
                    </div>
                    <div class="col-sm-6">

                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <?php
                            $seo_example_title = $contentsections->title_ar;
                            $seo_example_desc = Helper::GeneralSiteSettings("site_desc_ar");
                            if ($contentsections->seo_title_ar != "") {
                            $seo_example_title = $contentsections->seo_title_ar;
                            }
                            if ($contentsections->seo_description_ar != "") {
                            $seo_example_desc = $contentsections->seo_description_ar;
                            }
                            if ($contentsections->seo_url_slug_ar != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            $seo_example_url = url($contentsections->seo_url_slug_ar);
                            } else {
                                $seo_example_url ="";
                            }
                            ?>
                            <div class="form-group">
                                <div>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.arabicBox') !!}</small> @endif
                                    &nbsp;
                                    <div class="search-example" dir="rtl">
                                        <a id="title_in_engines_ar" href="{{ $seo_example_url }}"
                                           target="_blank">{{ $seo_example_title }}</a>
                                        <span id="url_in_engines_ar">{{ $seo_example_url }}</span>
                                        <div id="desc_in_engines_ar">{{ $seo_example_desc }} ...</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <i class="material-icons">&#xe8fd;</i>
                                    <small>{!!  trans('backLang.seoTabSettings') !!}</small>
                                </div>
                            </div>
                            <br>
                            <br>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">

                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group">
                                <div>
                                    <small>{!!  trans('backLang.topicSEOTitle') !!}</small>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                    {!! Form::text('seo_title_en',$contentsections->seo_title_en, array('class' => 'form-control','id'=>'seo_title_en','maxlength'=>'65', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>
                        @endif
                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group">
                                <div>
                                    <small>{!!  trans('backLang.friendlyURL') !!}</small>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                    {!! Form::text('seo_url_slug_en',$contentsections->seo_url_slug_en, array('class' => 'form-control','id'=>'seo_url_slug_en', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>
                        @endif

                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group">
                                <div>
                                    <small>{!!  trans('backLang.topicSEODesc') !!}</small>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                    {!! Form::textarea('seo_description_en',$contentsections->seo_description_en, array('class' => 'form-control','id'=>'seo_description_en','maxlength'=>'165', 'dir'=>trans('backLang.ltr'),'rows'=>'2')) !!}
                                </div>
                            </div>
                        @endif
                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group">
                                <div>
                                    <small>{!!  trans('backLang.topicSEOKeywords') !!}</small>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                    {!! Form::textarea('seo_keywords_en',$contentsections->seo_keywords_en, array('class' => 'form-control','id'=>'seo_keywords_en', 'dir'=>trans('backLang.ltr'),'rows'=>'2')) !!}
                                </div>
                            </div>
                        @endif


                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                        &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                                <a href="{{ route('contentfaculties') }}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                            </div>
                        </div>
                        <br>
                        <br>

                    </div>

                    <div class="col-sm-6">
                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <?php
                            $seo_example_title = $contentsections->title_en;
                            $seo_example_desc = Helper::GeneralSiteSettings("site_desc_en");
                            if ($contentsections->seo_title_en != "") {
                            $seo_example_title = $contentsections->seo_title_en;
                            }
                            if ($contentsections->seo_description_en != "") {
                            $seo_example_desc = $contentsections->seo_description_en;
                            }
                            if ($contentsections->seo_url_slug_en != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            $seo_example_url = url($contentsections->seo_url_slug_en);
                            } else {
                            $seo_example_url ="#";
                            }
                            ?>
                            <div class="form-group">
                                <div>
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                        <small>{!!  trans('backLang.englishBox') !!}</small> @endif
                                    &nbsp;
                                    <div class="search-example" dir="ltr">
                                        <a id="title_in_engines_en" href="{{ $seo_example_url }}"
                                           target="_blank">{{ $seo_example_title }}</a>
                                        <span id="url_in_engines_en">{{ $seo_example_url }}</span>
                                        <div id="desc_in_engines_en">{{ $seo_example_desc }} ...</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <i class="material-icons">&#xe8fd;</i>
                                    <small>{!!  trans('backLang.seoTabSettings') !!}</small>
                                </div>
                            </div>
                            <br>
                            <br>
                        @endif
                    </div>
                </div>


                {{Form::close()}}
            </div>

        </div>
    @endif