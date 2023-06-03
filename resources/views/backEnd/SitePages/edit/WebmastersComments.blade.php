  @if($WebmasterSection->comments_status)
                    <div class="tab-pane  {{ $tab_4 }}" id="tab_comments">

                        <div class="box-body">
                            @if (Session::has('commentST'))
                                @if (Session::get('commentST') == "create")

                                    <div>
                                        {{Form::open(['route'=>['topicsCommentsStore',$WebmasterSection->id,$Topics->id],'method'=>'POST', 'files' => true ])}}


                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicCommentName') !!}
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::text('name','', array('placeholder' => '','class' => 'form-control','id'=>'name','required'=>'')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicCommentEmail') !!}
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::email('email','', array('placeholder' => '','class' => 'form-control','id'=>'email','required'=>'')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="comment"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicComment') !!}
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::textarea('comment','', array('placeholder' => '','class' => 'form-control','id'=>'comment','required'=>'','rows'=>'5')) !!}
                                            </div>
                                        </div>


                                        <div class="form-group row m-t-md">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary m-t"><i
                                                            class="material-icons">
                                                        &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                                                <a href="{{ route('topicsComments',[$WebmasterSection->id,$Topics->id]) }}"
                                                   class="btn btn-default m-t"><i class="material-icons">
                                                        &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                                            </div>
                                        </div>

                                        {{Form::close()}}
                                    </div>

                                @endif

                                @if (Session::get('commentST') == "edit")
                                    <div>
                                        {{Form::open(['route'=>['topicsCommentsUpdate',$WebmasterSection->id,$Topics->id,Session::get('Comment')->id],'method'=>'POST', 'files' => true ])}}


                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicCommentName') !!}
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::text('name',Session::get('Comment')->name, array('placeholder' => '','class' => 'form-control','id'=>'name','required'=>'')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicCommentEmail') !!}
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::email('email',Session::get('Comment')->email, array('placeholder' => '','class' => 'form-control','id'=>'email','required'=>'')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="comment"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicComment') !!}
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::textarea('comment',Session::get('Comment')->comment, array('placeholder' => '','class' => 'form-control','id'=>'comment','required'=>'','rows'=>'5')) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="link_status"
                                                   class="col-sm-2 form-control-label">{!!  trans('backLang.status') !!}</label>
                                            <div class="col-sm-10">
                                                <div class="radio">
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('status','1',(Session::get('Comment')->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.active') }}
                                                    </label>
                                                    &nbsp; &nbsp;
                                                    <label class="ui-check ui-check-md">
                                                        {!! Form::radio('status','0',(Session::get('Comment')->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                                        <i class="dark-white"></i>
                                                        {{ trans('backLang.notActive') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row m-t-md">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary m-t"><i
                                                            class="material-icons">
                                                        &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                                                <a href="{{ route('topicsComments',[$WebmasterSection->id,$Topics->id]) }}"
                                                   class="btn btn-default m-t"><i class="material-icons">
                                                        &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                                            </div>
                                        </div>

                                        {{Form::close()}}
                                    </div>
                                @endif
                            @else

                                @if(count((array)$Topics->comments)>0)
                                    <div class="row p-a">
                                        <div class="col-sm-12">
                                            <a class="btn btn-fw primary"
                                               href="{{route("topicsCommentsCreate",[$WebmasterSection->id,$Topics->id])}}">
                                                <i class="material-icons">&#xe02e;</i>
                                                &nbsp; {{ trans('backLang.topicNewComment') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                @if(count((array)$Topics->comments) == 0)
                                    <div class="row p-a">
                                        <div class="col-sm-12">
                                            <div class=" p-a text-center light ">
                                                {{ trans('backLang.noData') }}
                                                <br>
                                                <br>
                                                <a class="btn btn-fw primary"
                                                   href="{{route("topicsCommentsCreate",[$WebmasterSection->id,$Topics->id])}}">
                                                    <i class="material-icons">&#xe02e;</i>
                                                    &nbsp; {{ trans('backLang.topicNewComment') }}
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(count((array)$Topics->comments)>0)
                                    {{Form::open(['route'=>['topicsCommentsUpdateAll',$WebmasterSection->id,$Topics->id],'method'=>'post'])}}
                                    <div class="row">
                                        <table class="table table-striped  b-t">
                                            <thead>
                                            <tr>
                                                <th style="width:20px;">
                                                    <label class="ui-check m-a-0">
                                                        <input id="checkAll2" type="checkbox"><i></i>
                                                    </label>
                                                </th>
                                                <th>{{ trans('backLang.topicCommentName') }}</th>
                                                <th>{{ trans('backLang.topicComment') }}</th>
                                                <th class="text-center"
                                                    style="width:50px;">{{ trans('backLang.status') }}</th>
                                                <th class="text-center"
                                                    style="width:200px;">{{ trans('backLang.options') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Topics->comments as $comment)
                                                <tr>
                                                    <td><label class="ui-check m-a-0">
                                                            <input type="checkbox" name="ids[]"
                                                                   value="{{ $comment->id }}"><i
                                                                    class="dark-white"></i>
                                                            {!! Form::hidden('row_ids[]',$comment->id, array('class' => 'form-control row_no')) !!}
                                                        </label>
                                                    </td>
                                                    <td>
                                                        {!! Form::text('row_no_'.$comment->id,$comment->row_no, array('class' => 'pull-left form-control row_no','id'=>'row_no2')) !!}
                                                        {{$comment->name}}
                                                        <div>
                                                            <small>
                                                                {{$comment->email}}
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <small>{{ $comment->date }}</small>
                                                        <div>
                                                            <small>{{ $comment->comment }}</small>
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        <i class="fa {{ ($comment->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm success"
                                                           href="{{ route("topicsCommentsEdit",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"comment_id"=>$comment->id]) }}">
                                                            <small><i class="material-icons">
                                                                    &#xe3c9;</i> {{ trans('backLang.edit') }}</small>
                                                        </a>
                                                        @if(@Auth::user()->permissionsGroup->delete_status)
                                                            <button class="btn btn-sm warning" data-toggle="modal"
                                                                    data-target="#mc-{{ $comment->id }}"
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
                                                <div id="mc-{{ $comment->id }}" class="modal fade" data-backdrop="true">
                                                    <div class="modal-dialog" id="animate">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                                            </div>
                                                            <div class="modal-body text-center p-lg">
                                                                <p>
                                                                    {{ trans('backLang.confirmationDeleteMsg') }}
                                                                    <br>
                                                                    <strong>[ {!! $comment->name !!} ]</strong>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark-white p-x-md"
                                                                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                                                <a href="{{ route("topicsCommentsDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"comment_id"=>$comment->id]) }}"
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
                                            <div id="mc-all" class="modal fade" data-backdrop="true">
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

                                            <select name="action" id="action2"
                                                    class="input-sm form-control w-sm inline v-middle" required>
                                                <option value="">{{ trans('backLang.bulkAction') }}</option>
                                                <option value="order">{{ trans('backLang.saveOrder') }}</option>
                                                <option value="activate">{{ trans('backLang.activeSelected') }}</option>
                                                <option value="block">{{ trans('backLang.blockSelected') }}</option>
                                                @if(@Auth::user()->permissionsGroup->delete_status)
                                                    <option value="delete">{{ trans('backLang.deleteSelected') }}</option>
                                                @endif
                                            </select>
                                            <button type="submit" id="submit_all2"
                                                    class="btn btn-sm white">{{ trans('backLang.apply') }}</button>
                                            <button id="submit_show_msg2" class="btn btn-sm white" data-toggle="modal"
                                                    style="display: none"
                                                    data-target="#mc-all" ui-toggle-class="bounce"
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