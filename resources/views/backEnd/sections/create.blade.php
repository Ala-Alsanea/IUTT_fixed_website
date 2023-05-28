@extends('backEnd.layout')

@section('headerInclude')
    <link href="{{ asset("/backEnd/libs/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
@endsection

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> {{ trans('backLang.sectionNew') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a>{!! trans('backLang.'.$WebmasterSection->name) !!}</a> /
                    <a>{{ trans('backLang.sectionsOf') }}  {!! trans('backLang.'.$WebmasterSection->name) !!}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route('sections',$WebmasterSection->id) }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['sectionsStore',$WebmasterSection->id],'method'=>'POST', 'files' => true ])}}

                @if($WebmasterSection->sections_status==2)
                    <div class="form-group row">
                        <label for="father_id"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionFather') !!} </label>
                        <div class="col-sm-10">
                            <select name="father_id" id="father_id" class="form-control c-select">
                                <option value="0">- - {!!  trans('backLang.sectionNoFather') !!} - -</option>
                                <?php
                                $title_var = "title_" . trans('backLang.boxCode');
                                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                ?>
                                @foreach ($fatherSections as $fatherSection)
                                    <?php
                                    if ($fatherSection->$title_var != "") {
                                        $title = $fatherSection->$title_var;
                                    } else {
                                        $title = $fatherSection->$title_var2;
                                    }
                                    ?>
                                    <option value="{{ $fatherSection->id  }}">{{ $title }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                @else
                    {!! Form::hidden('father_id','0') !!}
                @endif

                @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                    <div class="form-group row">
                        <label for="title_ar"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionName') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('title_ar','', array('placeholder' => '','class' => 'form-control','id'=>'title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>

                @endif
                @if(Helper::GeneralWebmasterSettings("en_box_status"))
                    <div class="form-group row">
                        <label for="title_en"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionName') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('title_en','', array('placeholder' => '','class' => 'form-control','id'=>'title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>


                @endif
   @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                <div class="form-group row">
                    <label for="details_ar"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.bannerDetails') !!}
                        @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                    </label>
                    <div class="col-sm-10">
                        {!! Form::textarea('details_ar','', array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                    </div>
                </div>
            @endif

            @if(Helper::GeneralWebmasterSettings("en_box_status"))
                <div class="form-group row">
                    <label for="details_en"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.bannerDetails') !!}
                        @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                    </label>
                    <div class="col-sm-10">
                        <div class="box p-a-xs">
                            {!! Form::textarea('details_en','', array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                        </div>
                    </div>
                </div>
            @endif
                <div class="form-group row">
                    <label for="photo"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.bannerPhoto') !!}</label>
                    <div class="col-sm-10">

                          <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='photo' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
                       {!! Form::text('photo','', array('placeholder' => '','class' => 'form-control','id'=>'photo')) !!}



                    </div>
                </div>
      <div class="form-group row">
                    <label for="banner"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!}</label>
                    <div class="col-sm-10">

                          <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
                       {!! Form::text('banner','#', array('placeholder' => '','class' => 'form-control','id'=>'banner')) !!}



                    </div>
                </div>
                <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                    <div class="col-sm-offset-2 col-sm-10">
                        <small>
                            <i class="material-icons">&#xe8fd;</i>
                            {!!  trans('backLang.imagesTypes') !!}
                        </small>
                    </div>
                </div>

                @if($WebmasterSection->section_icon_status)
                    <div class="form-group row">
                        <label for="icon"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionIcon') !!}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                {!! Form::text('icon','', array('placeholder' => '','class' => 'form-control icp icp-auto','id'=>'icon', 'data-placement'=>'bottomRight')) !!}
                                <span class="input-group-addon"></span>
                            </div>
                        </div>
                    </div>
                @endif



            <div class="form-group row">
                    <label for="section_url"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.url_link') !!}
                    </label>
                      <div class="col-sm-10">
                        {!! Form::text('section_url',(isset($Sections->section_url))?$Sections->section_url:'#', array('placeholder' => '','class' => 'form-control','id'=>'section_url', 'dir'=>trans('backLang.ltr'))) !!}
                    </div>
                </div>
                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                        <a href="{{ route('sections',$WebmasterSection->id) }}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection

@section('footerInclude')

    <script src="{{ asset("/backEnd/libs/js/iconpicker/fontawesome-iconpicker.js") }}"></script>
    <script>
        $(function () {
            $('.icp-auto').iconpicker({placement: '{{ (trans('backLang.direction')=="rtl")?"topLeft":"topRight" }}'});
        });
    </script>
@endsection
