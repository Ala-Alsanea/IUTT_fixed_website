{{-- Additional Files--}}

@if($WebmasterSection->extra_attach_file_status)
    <div class="tab-pane  {{ $tab_6 }}" id="tab_files">

        <div class="box-body">
            @if (Session::has('fileST'))
                @if (Session::get('fileST') == "create")

                    <div>
                        {{Form::open(['route'=>['topicsFilesStore',$WebmasterSection->id,$Topics->id],'method'=>'POST', 'files' => true ])}}

                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group row">
                                <label for="file_title_ar"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::text('title_ar','', array('placeholder' => '','class' => 'form-control','id'=>'file_title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                                </div>
                            </div>
                        @endif
                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group row">
                                <label for="file_title_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::text('title_en','', array('placeholder' => '','class' => 'form-control','id'=>'file_title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="files_file"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicAttach') !!}</label>
                            <div class="col-sm-10">
                                {!! Form::file('file', array('class' => 'form-control','id'=>'attach_file','required'=>'')) !!}
                            </div>
                        </div>
                        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                            <div class="col-sm-offset-2 col-sm-10">
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!!  trans('backLang.attachTypes') !!}
                                </small>
                            </div>
                        </div>


                        <div class="form-group row m-t-md">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary m-t"><i
                                            class="material-icons">
                                        &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                                <a href="{{ route('topicsFiles',[$WebmasterSection->id,$Topics->id]) }}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>

                @endif

                @if (Session::get('fileST') == "edit")
                    <div>
                        {{Form::open(['route'=>['topicsFilesUpdate',$WebmasterSection->id,$Topics->id,Session::get('AttachFile')->id],'method'=>'POST', 'files' => true ])}}


                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group row">
                                <label for="file_title_ar"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::text('title_ar',Session::get('AttachFile')->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'file_title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                                </div>
                            </div>
                        @endif
                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group row">
                                <label for="file_title_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::text('title_en',Session::get('AttachFile')->title_en, array('placeholder' => '','class' => 'form-control','id'=>'file_title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="files_file"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicAttach') !!}</label>
                            <div class="col-sm-10">
                                <div class="col-sm-4 box p-a-xs">
                                    <a target="_blank"
                                       href="{{ secure_asset('uploads/topics/'.Session::get('AttachFile')->file) }}"> {!! Helper::GetIcon(secure_asset('uploads/topics/'),Session::get('AttachFile')->file) !!} {{ Session::get('AttachFile')->file }} </a>
                                </div>
                                {!! Form::file('file', array('class' => 'form-control','id'=>'files_file')) !!}
                            </div>
                        </div>
                        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                            <div class="col-sm-offset-2 col-sm-10">
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!!  trans('backLang.attachTypes') !!}
                                </small>
                            </div>
                        </div>

                        <div class="form-group row m-t-md">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary m-t"><i
                                            class="material-icons">
                                        &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                                <a href="{{ route('topicsFiles',[$WebmasterSection->id,$Topics->id]) }}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                @endif
            @else

                @if(count($Topics->attachFiles)>0)
                    <div class="row p-a">
                        <div class="col-sm-12">
                            <a class="btn btn-fw primary"
                               href="{{route("topicsFilesCreate",[$WebmasterSection->id,$Topics->id])}}">
                                <i class="material-icons">&#xe02e;</i>
                                &nbsp; {{ trans('backLang.topicAttach') }}
                            </a>
                        </div>
                    </div>
                @endif
                @if(count($Topics->attachFiles) == 0)
                    <div class="row p-a">
                        <div class="col-sm-12">
                            <div class=" p-a text-center light ">
                                {{ trans('backLang.noData') }}
                                <br>
                                <br>
                                <a class="btn btn-fw primary"
                                   href="{{route("topicsFilesCreate",[$WebmasterSection->id,$Topics->id])}}">
                                    <i class="material-icons">&#xe02e;</i>
                                    &nbsp; {{ trans('backLang.topicAttach') }}
                                </a>

                            </div>
                        </div>
                    </div>
                @endif
                @if(count((array)$Topics->attachFiles)>0)
                    {{Form::open(['route'=>['topicsFilesUpdateAll',$WebmasterSection->id,$Topics->id],'method'=>'post'])}}
                    <div class="row">
                        <table class="table table-striped  b-t">
                            <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="ui-check m-a-0">
                                        <input id="checkAll4" type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>{{ trans('backLang.topicAttach') }}</th>
                                <th>{{ trans('backLang.topicName') }}</th>
                                <th class="text-center"
                                    style="width:200px;">{{ trans('backLang.options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $title_var = "title_" . trans('backLang.boxCode');
                            $title_var2 = "title_" . trans('backLang.boxCodeOther');
                            ?>
                            @foreach($Topics->attachFiles as $file)
                                <?php
                                if ($file->$title_var != "") {
                                    $file_title = $file->$title_var;
                                } else {
                                    $file_title = $file->$title_var2;
                                }
                                ?>
                                <tr>
                                    <td><label class="ui-check m-a-0">
                                            <input type="checkbox" name="ids[]"
                                                   value="{{ $file->id }}"><i
                                                    class="dark-white"></i>
                                            {!! Form::hidden('row_ids[]',$file->id, array('class' => 'form-control row_no')) !!}
                                        </label>
                                    </td>
                                    <td>
                                        {!! Form::text('row_no_'.$file->id,$file->row_no, array('class' => 'pull-left form-control row_no')) !!}
                                        <a href="{{ secure_asset('uploads/topics/'.$file->file) }}"
                                           target="_blank">
                                            {!! Helper::GetIcon(secure_asset('uploads/topics/'),$file->file) !!}
                                            {{$file->file}}</a>
                                    </td>
                                    <td>
                                        <small>
                                            {!! $file_title !!}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm success"
                                           href="{{ route("topicsFilesEdit",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"file_id"=>$file->id]) }}">
                                            <small><i class="material-icons">
                                                    &#xe3c9;</i> {{ trans('backLang.edit') }}</small>
                                        </a>
                                        @if(@Auth::user()->permissionsGroup->delete_status)
                                            <button class="btn btn-sm warning" data-toggle="modal"
                                                    data-target="#mf-{{ $file->id }}"
                                                    ui-toggle-class="bounce"
                                                    ui-target="#animate">
                                                <small><i class="material-icons">
                                                        &#xe872;</i> {{ trans('backLang.delete') }}
                                                </small>
                                            </button>
                                        @endif

                                    </td>
                                </tr>
                                <!-- .modal -->
                                <div id="mf-{{ $file->id }}" class="modal fade" data-backdrop="true">
                                    <div class="modal-dialog" id="animate">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <p>
                                                    {{ trans('backLang.confirmationDeleteMsg') }}
                                                    <br>
                                                    <strong>[ {!! $file_title !!} ]</strong>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white p-x-md"
                                                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                                <a href="{{ route("topicsFilesDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"file_id"=>$file->id]) }}"
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
                        <div class="col-sm-3 hidden-xs">
                            <!-- .modal -->
                            <div id="mf-all" class="modal fade" data-backdrop="true">
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
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                            <button type="submit"
                                                    class="btn danger p-x-md">{{ trans('backLang.yes') }}</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->

                            <select name="action" id="action4"
                                    class="input-sm form-control w-sm inline v-middle" required>
                                <option value="">{{ trans('backLang.bulkAction') }}</option>
                                <option value="order">{{ trans('backLang.saveOrder') }}</option>
                                @if(@Auth::user()->permissionsGroup->delete_status)
                                    <option value="delete">{{ trans('backLang.deleteSelected') }}</option>
                                @endif
                            </select>
                            <button type="submit" id="submit_all4"
                                    class="btn btn-sm white">{{ trans('backLang.apply') }}</button>
                            <button id="submit_show_msg4" class="btn btn-sm white" data-toggle="modal"
                                    style="display: none"
                                    data-target="#mf-all" ui-toggle-class="bounce"
                                    ui-target="#animate">{{ trans('backLang.apply') }}
                            </button>
                        </div>
                    </div>
                    {{Form::close()}}
                @endif
            @endif
        </div>
    </div>
@endif
{{-- End of Additional Files--}}
