@extends('backEnd.layout')

@section('headerInclude')
    <link href="{{ secure_asset("/backEnd/libs/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
@endsection

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> {{ trans('backLang.newLink') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">{{ trans('backLang.settings') }}</a> /
                    <a href="">{{ trans('backLang.siteMenus') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route("Catmenus",["ParentMenuId"=>$ParentMenuId]) }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['CatmenusStore',$ParentMenuId],'method'=>'POST', 'files' => true ])}}
                {!! Form::hidden('ParentMenuId',$ParentMenuId) !!}

                <div class="form-group row">
                    <label for="Father_id"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.fatherSection') !!} </label>
                    <div class="col-sm-10">
                        <select name="Father_id" id="Father_id" class="form-control c-select">
                            <option value="{{$ParentMenuId}}">- - {!!  trans('backLang.sectionNoFather') !!} - -
                            </option>
                            <?php
                            $CatTitle_var = "CatTitle_" . trans('backLang.boxCode');
                            $CatTitle_var2 = "CatTitle_" . trans('backLang.boxCodeOther');
                            ?>
                            @foreach ($FatherMenus as $FatherMenu)
                                <?php
                                if ($FatherMenu->$CatTitle_var != "") {
                                    $title = $FatherMenu->$CatTitle_var;
                                } else {
                                    $title = $FatherMenu->$CatTitle_var2;
                                }
                                ?>
                                <option value="{{ $FatherMenu->Cat_id  }}">{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                    <div class="form-group row">
                        <label for="CatTitle_ar"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionTitle') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('CatTitle_ar','', array('placeholder' => '','class' => 'form-control','id'=>'CatTitle_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>
                @endif
                @if(Helper::GeneralWebmasterSettings("en_box_status"))
                    <div class="form-group row">
                        <label for="CatTitle_en"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionTitle') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('CatTitle_en','', array('placeholder' => '','class' => 'form-control','id'=>'CatTitle_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <label for="CatIcon"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.iconPicker') !!}</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            {!! Form::text('CatIcon','', array('placeholder' => '','class' => 'form-control icp icp-auto','id'=>'CatIcon', 'data-placement'=>'bottomRight')) !!}
                            <span class="input-group-addon"></span>
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="link_status"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.linkType') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('CatType','0',true, array('id' => 'status1','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";document.getElementById("cat_div").style.display="none"')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.linkType1') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('CatType','1',false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="block";document.getElementById("cat_div").style.display="none"')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.linkType2') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('CatType','2',false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";document.getElementById("cat_div").style.display="block"')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.linkType3') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('CatType','3',false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";document.getElementById("cat_div").style.display="block"')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.linkType4') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div id="link_div" class="form-group row" style="display: none">
                    <label for="link"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.linkURL') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('Catlink','', array('placeholder' => '','class' => 'form-control','id'=>'CatTitle_ar', 'dir'=>trans('backLang.ltr'))) !!}
                    </div>
                </div>
                <div id="cat_div" class="form-group row"  style="display: none">
                    <label for="link"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.linkSection') !!}
                    </label>
                    <div class="col-sm-10">
                        <select name="Subcat_id" id="Subcat_id" class="form-control c-select">
                            <option value="{{$ParentMenuId}}">- - {!!  trans('backLang.linkSection') !!} - -
                            </option>

                            @foreach ($GeneralWebmasterSections as $WSection)
                                <option value="{{ $WSection->id  }}">{!!  str_replace("backLang.","",trans('backLang.'.$WSection->name)) !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                        <a href="{{ route("Catmenus",["ParentMenuId"=>$ParentMenuId]) }}"
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

    <script src="{{ secure_asset("/backEnd/libs/js/iconpicker/fontawesome-iconpicker.js") }}"></script>
    <script>
        $(function () {
            $('.icp-auto').iconpicker({placement: '{{ (trans('backLang.direction')=="rtl")?"topLeft":"topRight" }}'});
        });
    </script>
@endsection
