    @if($WebmasterSection->multi_images_status)
    <div class="tab-pane  {{ $tab_3 }}" id="tab_photos">

    <div class="box-body">

     <ul class="nav nav-md">

      <li class="nav-item inline">
                    <a class="nav-link active" href data-toggle="tab" data-target="#dropzone">
                        <span class="text-md"><i class="material-icons">
                                &#xe31e;</i> {{ trans('backLang.topicDropFiles') }}</span>
                    </a>
    </li>
          <li class="nav-item inline">
                    <a class="nav-link" href data-toggle="tab" data-target="#FileManagerTab">
                        <span class="text-md"><i class="material-icons ">
                                &#xe2c8;</i> {{ trans('backLang.iframebtn') }}</span>
                    </a>
    </li>

  </ul>
   <div class="tab-content clear b-t">
      <div class="tab-pane  active" id="dropzone">

           
       <div class="text-center box-body">
        {{Form::open(['route'=>['topicsPhotosEdit',"webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id],'method'=>'POST','class'=>'dropzone white', 'files' => true])}}
        <div class="dz-message" ui-jp="dropzone"
             ui-options="{ url: '{{ URL::to('backEnd/api/dropzone') }}' }">
            <h4 class="m-t-lg m-b-md">{{ trans('backLang.topicDropFiles') }}</h4>
            <span class="text-muted block m-b-lg">( {{ trans('backLang.topicDropFiles2') }}
                )</span>
        </div> 
        {{Form::close()}}
        </div>
  

      </div>

        <div class="tab-pane " id="FileManagerTab">

            <div class="box-body text-center bggray">
         {{Form::open(['route'=>['FileManagertopicsPhotos',"webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id],'method'=>'POST', 'files' => true])}}



               <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='MultipleFileUploads' multi=1  type=0  relative_url=''> {!!trans('backLang.iframebtn') !!}</a>
          <div class="form-group">

             {!! Form::textarea('MultipleFileUploads','', array('placeholder' => '','class' => 'form-control','rows' =>5,'id'=>'MultipleFileUploads')) !!}
           </div>
       <div class="form-group row">
                    <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="material-icons">
                        &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                <a href="{{ route('topics',$WebmasterSection->id) }}"
                   class="btn btn-default"><i class="material-icons">
                        &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                    </div>
   </div>


              {{Form::close()}}
        </div>
    </div>
    <hr>

   </div>
        @if(count($Topics->photos)>0)
            <div class="row">
                {{Form::open(['route'=>['topicsPhotosUpdateAll',$WebmasterSection->id,$Topics->id],'method'=>'post'])}}
                @foreach($Topics->photos as $photo)
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="box p-a-xs">
                            <div class="pull-right">
                                {!! Form::text('row_no_'.$photo->id,$photo->row_no, array('class' => 'pull-left form-control row_no','id'=>'row_no','style'=>'margin:0;margin-bottom:5px')) !!}
                            </div>
                            <label class="ui-check m-a-0">
                                <input type="checkbox" name="ids[]" value="{{ $photo->id }}"><i
                                        class="dark-white"></i>
                                {!! Form::hidden('row_ids[]',$photo->id, array('class' => 'form-control row_no')) !!}
                            </label>
                            <img src="{{ Helper::FilterImage($photo->file) }}"
                                 alt="{{ $photo->title  }}" title="{{ $photo->title  }}"
                                 style="height: 150px"
                                 class="img-responsive">
                            <div class="p-a-sm">
                                <div class="text-ellipsis">
                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                        <button class="btn btn-sm warning pull-right"
                                                data-toggle="modal"
                                                data-target="#mx-{{ $photo->id }}"
                                                ui-toggle-class="bounce"
                                                ui-target="#animate"
                                                title="{{ trans('backLang.delete') }}"
                                                style="padding: 0 5px 2px;">
                                            <small><i class="material-icons">&#xe872;</i></small>
                                        </button>
                                    @endif
                                    <a style="display: block;overflow: hidden;"
                                       href="{{ Helper::FilterImage($photo->file) }}"
                                       target="_blank">
                                        <small>{{ ($photo->title !="") ? $photo->title:$photo->file  }}</small>
                                    </a>
                                </div>
                            </div>

                            <!-- .modal -->
                            <div id="mx-{{ $photo->id }}" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ trans('backLang.confirmationDeleteMsg') }}
                                                <br>
                                                <strong>[ {{ ($photo->title !="") ? $photo->title:$photo->file  }}
                                                    ]</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                            <a href="{{ route("topicsPhotosDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"photo_id"=>$photo->id]) }}"
                                               class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->
                        </div>
                    </div>

                @endforeach
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- .modal -->
                    <div id="mx-all" class="modal fade" data-backdrop="true">
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

                    <label class="ui-check m-a-0">
                        <input id="checkAll"
                               type="checkbox"><i></i> {{ trans('backLang.checkAll') }}
                    </label>
                    <div class="pull-right">
                        <select name="action" id="action"
                                class="input-sm form-control w-sm inline v-middle" required>
                            <option value="">{{ trans('backLang.bulkAction') }}</option>
                            <option value="order">{{ trans('backLang.saveOrder') }}</option>
                            @if(@Auth::user()->permissionsGroup->delete_status)
                                <option value="delete">{{ trans('backLang.deleteSelected') }}</option>
                            @endif
                        </select>
                        <button type="submit" id="submit_all"
                                class="btn btn-sm white">{{ trans('backLang.apply') }}</button>
                        <button id="submit_show_msg" class="btn btn-sm white" data-toggle="modal"
                                style="display: none"
                                data-target="#mx-all" ui-toggle-class="bounce"
                                ui-target="#animate">{{ trans('backLang.apply') }}
                        </button>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        @endif
    </div>
    </div>
    @endif