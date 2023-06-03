

@if($WebmasterSection->type==2)
    <div class="form-group row">
        <label for="video_type"
               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoType') !!}</label>
        <div class="col-sm-10">
            <div class="radio">
                <label class="ui-check ui-check-md">
                    {!! Form::radio('video_type','0',($Facultys->video_type==0) ? true : false, array('id' => 'video_type1','class'=>'has-value','onclick'=>'document.getElementById("embed_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="block";document.getElementById("youtube_link").value=""')) !!}
                    <i class="dark-white"></i>
                    {{ trans('backLang.bannerVideoType1') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('video_type','1',($Facultys->video_type==1) ? true : false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("embed_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="block";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("youtube_link").value=""')) !!}
                    <i class="dark-white"></i>
                    {{ trans('backLang.bannerVideoType2') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('video_type','2',($Facultys->video_type==2) ? true : false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("embed_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="block";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("vimeo_link").value=""')) !!}
                    <i class="dark-white"></i>
                    {{ trans('backLang.bannerVideoType3') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('video_type','3',($Facultys->video_type==3) ? true : false, array('id' => 'video_type3','class'=>'has-value','onclick'=>'document.getElementById("embed_link_div").style.display="block";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("embed_link").value=""')) !!}
                    <i class="dark-white"></i>
                    Embed
                </label>
            </div>
        </div>
    </div>

    <div id="files_div" style="display: {{ ($Facultys->video_type ==0) ? "block" : "none" }}">
        <div class="form-group row">
            <label for="video_file"
                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicVideo') !!}</label>
            <div class="col-sm-10">
                @if($Facultys->video_type==0 && $Facultys->video_file!="")
                    <div class="box p-a-xs">

                        <video width="380" height="230" controls>
                            <source src="{{ Helper::FilterImage($Facultys->video_file) }}"
                                    type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <br>
                        <a target="_blank"
                           href="{{ Helper::FilterImage($Facultys->video_file) }}">
                            {{ $Facultys->video_file }} </a>
                    </div>
                @endif

                 <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='video_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

             {!! Form::text('video_file',$Facultys->video_file, array('placeholder' => '','class' => 'form-control','id'=>'video_file')) !!}

               
            </div>
        </div>

        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
            <div class="col-sm-offset-2 col-sm-10">
                <small>
                    <i class="material-icons">&#xe8fd;</i>
                    {!!  trans('backLang.videoTypes') !!}
                </small>
            </div>
        </div>
    </div>
    <div class="form-group row" id="youtube_link_div"
         style="display: {{ ($Facultys->video_type==1) ? "block" : "none" }}">
        <label for="youtube_link"
               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoUrl') !!}</label>
        <div class="col-sm-10">
            {!! Form::text('youtube_link',$Facultys->video_file, array('placeholder' => 'https://www.youtube.com/watch?v=JQs4QyKnYMQ','class' => 'form-control','id'=>'youtube_link', 'dir'=>trans('backLang.ltr'))) !!}
        </div>
    </div>
    <div class="form-group row" id="vimeo_link_div"
         style="display: {{ ($Facultys->video_type ==2) ? "block" : "none" }}">
        <label for="youtube_link"
               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoUrl2') !!}</label>
        <div class="col-sm-10">
            {!! Form::text('vimeo_link',$Facultys->video_file, array('placeholder' => 'https://vimeo.com/131766159','class' => 'form-control','id'=>'vimeo_link', 'dir'=>trans('backLang.ltr'))) !!}
        </div>
    </div>

    <div class="form-group row" id="embed_link_div"
         style="display: {{ ($Facultys->video_type ==3) ? "block" : "none" }}">
        <label for="embed_link"
               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoUrl2') !!}</label>
        <div class="col-sm-10">
            {!! Form::textarea('embed_link',$Facultys->video_file, array('placeholder' => '','class' => 'form-control','id'=>'embed_link', 'dir'=>trans('backLang.ltr'),'rows'=>'3')) !!}
        </div>
    </div>
@endif

@if($WebmasterSection->type==3)
    <div class="form-group row">
        <label for="audio_file"
               class="col-sm-2 form-control-label">{!!  trans('backLang.topicAudio') !!}</label>
        <div class="col-sm-10">
            @if($Facultys->audio_file!="")
                <div class="box p-a-xs">
                    <audio controls>
                        <source src="{{ Helper::FilterImage($Facultys->audio_file) }}"
                                type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    <br>
                    <a target="_blank"
                       href="{{ Helper::FilterImage($Facultys->audio_file) }}"> {{ $Facultys->audio_file }} </a>
                </div>
            @endif

                <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='audio_file' type=3 multiple=0> {!!  trans('backLang.iframebtn') !!}</a>

             {!! Form::text('audio_file',$Facultys->audio_file, array('placeholder' => '','class' => 'form-control','id'=>'audio_file')) !!}

        </div>
    </div>

    <div class="form-group row m-t-md" style="margin-top: 0 !important;">
        <div class="col-sm-offset-2 col-sm-10">
            <small>
                <i class="material-icons">&#xe8fd;</i>
                {!!  trans('backLang.audioTypes') !!}
            </small>
        </div>
    </div>
@endif


<div class="form-group row">
    <label for="photo_file"
           class="col-sm-2 form-control-label">{!!  trans('backLang.topicPhoto') !!}</label>
    <div class="col-sm-10">
         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='photo_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

        {!! Form::text('photo_file',$Facultys->photo_file, array('placeholder' => '','class' => 'form-control','id'=>'photo_file','required'=>'')) !!}
        @if($Facultys->photo_file!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($Facultys->photo_file) }}"><img
                                    src="{{Helper::FilterImage($Facultys->photo_file) }}"
                                    class="img-responsive photo_file groupMediaPhoto">
                            {{-- $Facultys->photo_file --}}
                        </a>
                       
                        <a onclick="document.getElementById('topic_photo').style.display='none';document.getElementById('photo_delete').value='1';document.getElementById('undo').style.display='block';"
                           class="btn btn-sm btn-default">{!!  trans('backLang.delete') !!}</a>
                    </div>
                    <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                        <a onclick="document.getElementById('topic_photo').style.display='block';document.getElementById('photo_delete').value='0';document.getElementById('undo').style.display='none';">
                            <i class="material-icons">
                                &#xe166;</i> {!!  trans('backLang.undoDelete') !!}</a>
                    </div>


                    {!! Form::hidden('photo_delete','0', array('id'=>'photo_delete')) !!}
                </div>
            </div>
        @endif

        
 

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

@if($WebmasterSection->icon_status)
    <div class="form-group row">
        <label for="icon"
               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionIcon') !!}</label>
        <div class="col-sm-10">
            <div class="input-group">
                {!! Form::text('icon',$Facultys->icon, array('placeholder' => '','class' => 'form-control icp icp-auto','id'=>'icon', 'data-placement'=>'bottomRight')) !!}
                <span class="input-group-addon"></span>
            </div>
        </div>
    </div>
@endif

@if($WebmasterSection->attach_file_status)
    <div class="form-group row">
        <label for="attach_file"
               class="col-sm-2 form-control-label">{!!  trans('backLang.topicAttach') !!}</label>
        <div class="col-sm-10">
            @if($Facultys->attach_file!="")
                <div id="topic_attach" class="col-sm-4 box p-a-xs">
                    <a target="_blank"
                           href="{{Helper::FilterImage($Facultys->attach_file) }}"><img
                                    src="{{Helper::FilterImage($Facultys->attach_file) }}"
                                    class="img-responsive">
                            {{-- $Facultys->attach_file --}}
                        </a>
                   
                
                </div>
                <div id="undo2" class="col-sm-4 p-a-xs" style="display: none">
                    <a onclick="document.getElementById('topic_attach').style.display='block';document.getElementById('attach_delete').value='0';document.getElementById('undo2').style.display='none';">
                        <i class="material-icons">
                            &#xe166;</i> {!!  trans('backLang.undoDelete') !!}</a>
                </div>
                {!! Form::hidden('attach_delete','0', array('id'=>'attach_delete')) !!}
            @endif
             <div class="col-sm-10">
             <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='attach_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
             {!! Form::text('attach_file',$Facultys->attach_file, array('placeholder' => '','class' => 'form-control','id'=>'attach_file')) !!}

         </div>
            
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
@endif