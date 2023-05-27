
                {{-- Related Topics --}}

                @if($WebmasterSection->related_status)
                    <div class="tab-pane  {{ $tab_7 }}" id="tab_related">

                        <div class="box-body">
                            @if (Session::has('relatedST'))
                                @if (Session::get('relatedST') == "create")

                                    <div>
                                        {{Form::open(['route'=>['topicsRelatedStore',$WebmasterSection->id,$Topics->id],'method'=>'POST' ])}}

                                        <div class="form-group row">
                                            <label for="file_title_ar"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.siteSectionsSettings') !!}
                                            </label>
                                            <div class="col-sm-10">
                                                <select name="related_section_id" id="related_section_id"
                                                        class="form-control c-select">
                                                    <option value="0">- - {!!  trans('backLang.topicSelectSection') !!}
                                                        - -
                                                    </option>
                                                    @foreach ($GeneralWebmasterSections as $WebmasterSection)
                                                        <?php
                                                        ?>
                                                        <option value="{{ $WebmasterSection->id  }}">{!! trans('backLang.'.$WebmasterSection->name)   !!}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="file_title_ar"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.relatedTopics') !!}
                                            </label>
                                            <div class="col-sm-10">
                                                <div id="r_topics"
                                                     style="max-height: 200px;overflow-y: scroll;padding: 5px;background: #f5f5f5;border: 1px solid #eee">
                                                    <i class="material-icons">&#xe8fd;</i> {!!  trans('backLang.relatedTopicsSelect') !!}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row m-t-md">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary m-t"><i
                                                            class="material-icons">
                                                        &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                                                <a href="{{ route('topicsRelated',[$WebmasterSection->id,$Topics->id]) }}"
                                                   class="btn btn-default m-t"><i class="material-icons">
                                                        &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                                            </div>
                                        </div>

                                        {{Form::close()}}
                                    </div>

                                @endif

                            @else

                                @if(count((array)$Topics->relatedTopics)>0)
                                    <div class="row p-a">
                                        <div class="col-sm-12">
                                            <a class="btn btn-fw primary"
                                               href="{{route("topicsRelatedCreate",[$WebmasterSection->id,$Topics->id])}}">
                                                <i class="material-icons">&#xe02e;</i>
                                                &nbsp; {{ trans('backLang.relatedTopicsAdd') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                @if(count((array)$Topics->relatedTopics) == 0)
                                    <div class="row p-a">
                                        <div class="col-sm-12">
                                            <div class=" p-a text-center light ">
                                                {{ trans('backLang.noData') }}
                                                <br>
                                                <br>
                                                <a class="btn btn-fw primary"
                                                   href="{{route("topicsRelatedCreate",[$WebmasterSection->id,$Topics->id])}}">
                                                    <i class="material-icons">&#xe02e;</i>
                                                    &nbsp; {{ trans('backLang.relatedTopicsAdd') }}
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(count((array)$Topics->relatedTopics)>0)
                                    {{Form::open(['route'=>['topicsRelatedUpdateAll',$WebmasterSection->id,$Topics->id],'method'=>'post'])}}
                                    <div class="row">
                                        <table class="table table-striped  b-t">
                                            <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="ui-check m-a-0">
                                                        <input id="checkAll4" type="checkbox"><i></i>
                                                    </label>
                                                </th>
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
                                            @foreach($Topics->relatedTopics as $relatedTopic)
                                                <?php


                                                if ($relatedTopic->topic->$title_var != "") {
                                                $relatedTopic_title = $relatedTopic->topic->$title_var;
                                                } else {
                                                $relatedTopic_title = $relatedTopic->topic->$title_var2;
                                                }

                                                ?>
                                                <tr>
                                                    <td><label class="ui-check m-a-0">
                                                            <input type="checkbox" name="ids[]"
                                                                   value="{{ $relatedTopic->id }}"><i
                                                                    class="dark-white"></i>
                                                            {!! Form::hidden('row_ids[]',$relatedTopic->id, array('class' => 'form-control row_no')) !!}
                                                        </label>
                                                    </td>
                                                    <td> {!! Form::text('row_no_'.$relatedTopic->id,$relatedTopic->row_no, array('class' => 'pull-left form-control row_no')) !!}
                                                        <small>
                                                            {!! $relatedTopic_title !!}
                                                        </small>
                                                    </td>
                                                    <td class="text-center">
                                                        @if(@Auth::user()->permissionsGroup->delete_status)
                                                            <button class="btn btn-sm warning" data-toggle="modal"
                                                                    data-target="#mf-{{ $relatedTopic->id }}"
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
                                                <div id="mf-{{ $relatedTopic->id }}" class="modal fade"
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
                                                                    <strong>[ {!! $relatedTopic_title !!} ]</strong>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark-white p-x-md"
                                                                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                                                <a href="{{ route("topicsRelatedDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"related_id"=>$relatedTopic->id]) }}"
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

                @include('backEnd.topics.edit.WebmastersMaps')
                {{-- End of Related Topics --}}