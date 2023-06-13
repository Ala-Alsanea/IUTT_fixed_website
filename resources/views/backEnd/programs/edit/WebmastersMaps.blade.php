

  @if (Session::has('mapST') && $Topics->id==2)
@if($WebmasterSection->maps_status)
<div class="tab-pane  {{ $tab_5 }}" id="tab_maps">

<div class="box-body">

    <div class="row">
        @if (Session::has('mapST') && $Topics->id==2)

            @if (Session::get('mapST') == "edit")
                <div class="col-sm-offset-2 col-sm-8">
                    <br>
                    {{Form::open(['route'=>['topicsMapsUpdate',$WebmasterSection->id,$Topics->id,Session::get('Map')->id],'method'=>'POST', 'files' => true ])}}


                    <div class="form-group row">
                        <label for="longitude"
                               class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapLocation') !!}
                        </label>
                        <div class="col-sm-5">
                            {!! Form::text('longitude',Session::get('Map')->longitude, array('placeholder' => '','class' => 'form-control','id'=>'longitude','required'=>'')) !!}
                        </div>
                        <div class="col-sm-4">
                            {!! Form::text('latitude',Session::get('Map')->latitude, array('placeholder' => '','class' => 'form-control','id'=>'latitude','required'=>'')) !!}
                        </div>
                    </div>


                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                        <div class="form-group row">
                            <label for="title_ar"
                                   class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapTitle') !!}
                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                            </label>
                            <div class="col-sm-9">
                                {!! Form::text('title_ar',Session::get('Map')->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'title_ar', 'dir'=>trans('backLang.rtl'))) !!}
                            </div>
                        </div>
                    @endif
                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                        <div class="form-group row">
                            <label for="title_en"
                                   class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapTitle') !!}
                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                            </label>
                            <div class="col-sm-9">
                                {!! Form::text('title_en',Session::get('Map')->title_en, array('placeholder' => '','class' => 'form-control','id'=>'title_en', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                        </div>
                    @endif

                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                        <div class="form-group row">
                            <label for="details_ar"
                                   class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapDetails') !!}
                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                            </label>
                            <div class="col-sm-9">
                                {!! Form::textarea('details_ar',Session::get('Map')->details_ar, array('placeholder' => '','class' => 'form-control','id'=>'details_ar','rows'=>'3', 'dir'=>trans('backLang.rtl'))) !!}
                            </div>
                        </div>
                    @endif
                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                        <div class="form-group row">
                            <label for="details_en"
                                   class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapDetails') !!}
                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                            </label>
                            <div class="col-sm-9">
                                {!! Form::textarea('details_en',Session::get('Map')->details_en, array('placeholder' => '','class' => 'form-control','id'=>'details_en','rows'=>'3', 'dir'=>trans('backLang.ltr'))) !!}
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="link_status"
                               class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapIcon') !!}</label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('icon','0',true, array('id' => 'status1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <img src="{{ secure_asset('backEnd/assets/images/marker_0.png')}}"
                                         style="width: 25px;">
                                </label>
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('icon','1',(Session::get('Map')->icon==1) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <img src="{{ secure_asset('backEnd/assets/images/marker_1.png')}}"
                                         style="width: 25px;">
                                </label>
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('icon','2',(Session::get('Map')->icon==2) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <img src="{{ secure_asset('backEnd/assets/images/marker_2.png')}}"
                                         style="width: 25px;">
                                </label>
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('icon','3',(Session::get('Map')->icon==3) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <img src="{{ secure_asset('backEnd/assets/images/marker_3.png')}}"
                                         style="width: 25px;">
                                </label>
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('icon','4',(Session::get('Map')->icon==4) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <img src="{{ secure_asset('backEnd/assets/images/marker_4.png')}}"
                                         style="width: 25px;">
                                </label>
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('icon','5',(Session::get('Map')->icon==5) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <img src="{{ secure_asset('backEnd/assets/images/marker_5.png')}}"
                                         style="width: 25px;">
                                </label>
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('icon','6',(Session::get('Map')->icon==6) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <img src="{{ secure_asset('backEnd/assets/images/marker_6.png')}}"
                                         style="width: 25px;">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="link_status"
                               class="col-sm-3 form-control-label">{!!  trans('backLang.status') !!}</label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('status','1',(Session::get('Map')->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.active') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('status','0',(Session::get('Map')->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.notActive') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row m-t-md">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary m-t"><i
                                        class="material-icons">
                                    &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                            <a href="{{ route('topicsMaps',[$WebmasterSection->id,$Topics->id]) }}"
                               class="btn btn-default m-t"><i class="material-icons">
                                    &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            @endif

        @else
            <div>
                <div id="mmn-{{ $Topics->id }}" class="modal fade"
                     data-backdrop="true">
                    <div class="modal-dialog" id="animate">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ trans('backLang.topicNewMap') }}</h5>
                            </div>
                            {{Form::open(['route'=>['topicsMapsStore',$WebmasterSection->id,$Topics->id],'method'=>'POST', 'files' => true ])}}
                            <div class="modal-body p-lg">
                                <div>

                                    <div class="form-group row">
                                        <label for="longitude"
                                               class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapLocation') !!}
                                        </label>
                                        <div class="col-sm-5">
                                            {!! Form::text('longitude','', array('placeholder' => '','class' => 'form-control','id'=>'longitude','required'=>'')) !!}
                                        </div>
                                        <div class="col-sm-4">
                                            {!! Form::text('latitude','', array('placeholder' => '','class' => 'form-control','id'=>'latitude','required'=>'')) !!}
                                        </div>
                                    </div>


                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group row">
                                            <label for="title_ar"
                                                   class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapTitle') !!}
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                            </label>
                                            <div class="col-sm-9">
                                                {!! Form::text('title_ar','', array('placeholder' => '','class' => 'form-control','id'=>'title_ar', 'dir'=>trans('backLang.rtl'))) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group row">
                                            <label for="title_en"
                                                   class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapTitle') !!}
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                            </label>
                                            <div class="col-sm-9">
                                                {!! Form::text('title_en','', array('placeholder' => '','class' => 'form-control','id'=>'title_en', 'dir'=>trans('backLang.ltr'))) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group row">
                                            <label for="details_ar"
                                                   class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapDetails') !!}
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                            </label>
                                            <div class="col-sm-9">
                                                {!! Form::textarea('details_ar','', array('placeholder' => '','class' => 'form-control','id'=>'details_ar','rows'=>'3', 'dir'=>trans('backLang.rtl'))) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group row">
                                            <label for="details_en"
                                                   class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapDetails') !!}
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                            </label>
                                            <div class="col-sm-9">
                                                {!! Form::textarea('details_en','', array('placeholder' => '','class' => 'form-control','id'=>'details_en','rows'=>'3', 'dir'=>trans('backLang.ltr'))) !!}
                                            </div>
                                        </div>
                                    @endif


                                    <div class="form-group row">
                                        <label for="link_status"
                                               class="col-sm-3 form-control-label">{!!  trans('backLang.topicMapIcon') !!}</label>
                                        <div class="col-sm-9">
                                            <div class="radio">
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('icon','0',true, array('id' => 'status1','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    <img src="{{ secure_asset('backEnd/assets/images/marker_0.png')}}"
                                                         style="width: 25px;">
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('icon','1',false, array('id' => 'status2','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    <img src="{{ secure_asset('backEnd/assets/images/marker_1.png')}}"
                                                         style="width: 25px;">
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('icon','2',false, array('id' => 'status2','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    <img src="{{ secure_asset('backEnd/assets/images/marker_2.png')}}"
                                                         style="width: 25px;">
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('icon','3',false, array('id' => 'status2','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    <img src="{{ secure_asset('backEnd/assets/images/marker_3.png')}}"
                                                         style="width: 25px;">
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('icon','4',false, array('id' => 'status2','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    <img src="{{ secure_asset('backEnd/assets/images/marker_4.png')}}"
                                                         style="width: 25px;">
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('icon','5',false, array('id' => 'status2','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    <img src="{{ secure_asset('backEnd/assets/images/marker_5.png')}}"
                                                         style="width: 25px;">
                                                </label>
                                                <label class="ui-check ui-check-md">
                                                    {!! Form::radio('icon','6',false, array('id' => 'status2','class'=>'has-value')) !!}
                                                    <i class="dark-white"></i>
                                                    <img src="{{ secure_asset('backEnd/assets/images/marker_6.png')}}"
                                                         style="width: 25px;">
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                        class="btn dark-white p-x-md"
                                        data-dismiss="modal">{{ trans('backLang.cancel') }}</button>
                                <button type="submit"
                                        class="btn btn-primary p-x-md">{{ trans('backLang.add') }}</button>
                            </div>
                            {{Form::close()}}
                        </div><!-- /.modal-content -->
                    </div>
                </div>
                <div class="row p-a" style="display: none">
                    <div class="col-sm-12">
                        <button class="btn btn-fw primary" data-toggle="modal"
                                data-target="#mmn-{{ $Topics->id }}"
                                ui-toggle-class="bounce" id="mapNew"
                                ui-target="#animate">
                            <i class="material-icons">&#xe02e;</i>
                            &nbsp; {{ trans('backLang.topicNewMap') }}
                        </button>
                    </div>
                </div>
                @if(count((array)$Topics->maps) == 0)
                    <div class="row p-a" id="mapDivBtns">
                        <div class="col-sm-12">
                            <div class=" p-a text-center light ">
                                {{ trans('backLang.noData') }}
                                <br>
                                <br>
                                <a class="btn btn-fw primary" id="mapDivNew">
                                    <i class="material-icons">&#xe02e;</i>
                                    &nbsp; {{ trans('backLang.topicNewMap') }}
                                </a>

                            </div>
                        </div>
                    </div>
                @endif
<div class="col-sm-5">
    @if(count((array)$Topics->maps)>0)
        {{Form::open(['route'=>['topicsMapsUpdateAll',$WebmasterSection->id,$Topics->id],'method'=>'post'])}}
        <div class="row">
            <table class="table table-striped  b-t">
                <thead>
                <tr>
                    <th style="width:20px;">
                        <label class="ui-check m-a-0">
                            <input id="checkAll3" type="checkbox"><i></i>
                        </label>
                    </th>
                    <th>{{ trans('backLang.topicCommentName') }}</th>
                    <th class="text-center"
                        style="width:30px;">{{ trans('backLang.status') }}</th>
                    <th class="text-center"
                        style="width:110px;">{{ trans('backLang.options') }}</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $title_var = "title_" . trans('backLang.boxCode');
                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                ?>
                @foreach($Topics->maps as $map)
                    <?php
                    if ($map->$title_var != "") {
                    $title = $map->$title_var;
                    } else {
                    $title = $map->$title_var2;
                    }
                    ?>
                    <tr>
                        <td><label class="ui-check m-a-0">
                                <input type="checkbox" name="ids[]"
                                       value="{{ $map->id }}"><i
                                        class="dark-white"></i>
                                {!! Form::hidden('row_ids[]',$map->id, array('class' => 'form-control row_no')) !!}
                            </label>
                        </td>
                        <td>
                            {!! Form::text('row_no_'.$map->id,$map->row_no, array('class' => 'pull-left form-control row_no','id'=>'row_no3')) !!}
                            <img src="{{ secure_asset('backEnd/assets/images/marker_').$map->icon.".png" }}"
                                 style="width: 20px;">
                            @if($title !="")
                                <small>{!! $title !!}</small>
                            @else
                                <small>
                                    {!! $map->longitude !!}
                                </small>
                            @endif
                        </td>

                        <td class="text-center">
                            <i class="fa {{ ($map->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-sm success"
                               href="{{ route("topicsMapsEdit",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"map_id"=>$map->id]) }}">
                                <small><i class="material-icons">
                                        &#xe3c9;</i></small>
                            </a>
                            @if(@Auth::user()->permissionsGroup->delete_status)
                                <button class="btn btn-sm warning"
                                        data-toggle="modal"
                                        data-target="#mm-{{ $map->id }}"
                                        ui-toggle-class="bounce"
                                        ui-target="#animate">
                                    <small><i class="material-icons">
                                            &#xe872;</i></small>
                                </button>
                            @endif

                        </td>
                    </tr>
                    <!-- .modal -->
                    <div id="mm-{{ $map->id }}" class="modal fade"
                         data-backdrop="true">
                        <div class="modal-dialog" id="animate">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                </div>
                                <div class="modal-body text-center p-lg">
                                    <p>
                                        {{ trans('backLang.confirmationDeleteMsg') }}
                                        <br>
                                        <strong>{!! $title !!}</strong>
                                        <br>
                                        <small>[
                                            {!! $map->longitude !!}
                                            , {!! $map->latitude !!}
                                            ]
                                        </small>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                            class="btn dark-white p-x-md"
                                            data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                    <a href="{{ route("topicsMapsDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"map_id"=>$map->id]) }}"
                                       class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div>
                    </div>
                    <!-- / .modal -->
                @endforeach

                </tbody>
            </table>

        </div>
        <div class="row">
            <div class="col-sm-12 hidden-xs">
                <!-- .modal -->
                <div id="mm-all" class="modal fade" data-backdrop="true">
                    <div class="modal-dialog" id="animate">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                            </div>
                            <div class="modal-body text-center p-lg">
                                <p>
                                    {{ trans('backLang.confirmationDeleteMsg') }}
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                        class="btn dark-white p-x-md"
                                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                <button type="submit"
                                        class="btn danger p-x-md">{{ trans('backLang.yes') }}</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div>
                </div>
                <!-- / .modal -->

                                <select name="action" id="action3"
                                        class="input-sm form-control w-sm inline v-middle"
                                        required>
                                    <option value="">{{ trans('backLang.bulkAction') }}</option>
                                    <option value="order">{{ trans('backLang.saveOrder') }}</option>
                                    <option value="activate">{{ trans('backLang.activeSelected') }}</option>
                                    <option value="block">{{ trans('backLang.blockSelected') }}</option>
                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                        <option value="delete">{{ trans('backLang.deleteSelected') }}</option>
                                    @endif
                                </select>
                                <button type="submit" id="submit_all3"
                                        class="btn btn-sm white">{{ trans('backLang.apply') }}</button>
                                <button id="submit_show_msg3" class="btn btn-sm white"
                                        data-toggle="modal"
                                        style="display: none"
                                        data-target="#mm-all" ui-toggle-class="bounce"
                                        ui-target="#animate">{{ trans('backLang.apply') }}
                                </button>
                            </div>
                        </div>
                        {{Form::close()}}
                    @endif
                </div>
            </div>
            <?php
            $map_dsp = "style='display:none'";
            $map_wds = "12";
            if (count((array)$Topics->maps) > 0) {
            $map_dsp = "";
            $map_wds = "7";
            }
            ?>
            <div id="mapDiv" class="col-sm-{{$map_wds}}" {!! $map_dsp !!}>

                <br>
                <div style="margin-bottom: 3px;">
                    <small>
                        {!! trans('backLang.topicMapClick') !!} ,
                        <a data-toggle="modal"
                           data-target="#mmn-{{ $Topics->id }}"
                           ui-toggle-class="bounce"
                           ui-target="#animate">
                            <u>
                                {!! trans('backLang.topicMapORClick') !!}
                            </u>
                        </a>
                    </small>
                </div>
                <div id="map" style="height: 400px"></div>
            </div>
        @endif
    </div>

</div>
</div>
@endif

@endif
