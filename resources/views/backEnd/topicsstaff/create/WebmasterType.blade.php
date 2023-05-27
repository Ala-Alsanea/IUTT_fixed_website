@if($WebmasterSection->type==2)
    <div class="form-group row">
        <label for="video_type"
               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoType') !!}</label>
        <div class="col-sm-10">
            <div class="radio">
                <label class="ui-check ui-check-md">
                    {!! Form::radio('video_type','0',true, array('id' => 'video_type1','class'=>'has-value','onclick'=>'document.getElementById("youtube_link_div").style.display="none";document.getElementById("embed_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="block";document.getElementById("youtube_link").value=""')) !!}
                    <i class="dark-white"></i>
                    {{ trans('backLang.bannerVideoType1') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('video_type','1',false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("youtube_link_div").style.display="block";document.getElementById("embed_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("youtube_link").value=""')) !!}
                    <i class="dark-white"></i>
                    {{ trans('backLang.bannerVideoType2') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('video_type','2',false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("vimeo_link_div").style.display="block";document.getElementById("embed_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("vimeo_link").value=""')) !!}
                    <i class="dark-white"></i>
                    {{ trans('backLang.bannerVideoType3') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('video_type','3',false, array('id' => 'video_type3','class'=>'has-value','onclick'=>'document.getElementById("embed_link_div").style.display="block";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("embed_link").value=""')) !!}
                    <i class="dark-white"></i>
                    Embed
                </label>
            </div>
        </div>
    </div>

    <div id="files_div">
        <div class="form-group row">
            <label for="video_file"
                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicVideo') !!}</label>
            <div class="col-sm-10">

                <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='video_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

             {!! Form::text('video_file','', array('placeholder' => '','class' => 'form-control','id'=>'video_file')) !!}

 
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
    <div class="form-group row" id="youtube_link_div" style="display: none">
        <label for="youtube_link"
               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoUrl') !!}</label>
        <div class="col-sm-10">
            {!! Form::text('youtube_link','', array('placeholder' => 'https://www.youtube.com/watch?v=JQs4QyKnYMQ','class' => 'form-control','id'=>'youtube_link', 'dir'=>trans('backLang.ltr'))) !!}
        </div>
    </div>
    <div class="form-group row" id="vimeo_link_div" style="display: none">
        <label for="youtube_link"
               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoUrl2') !!}</label>
        <div class="col-sm-10">
            {!! Form::text('vimeo_link','', array('placeholder' => 'https://vimeo.com/131766159','class' => 'form-control','id'=>'vimeo_link', 'dir'=>trans('backLang.ltr'))) !!}
        </div>
    </div>
    <div class="form-group row" id="embed_link_div" style="display: none">
        <label for="embed_link"
               class="col-sm-2 form-control-label">Embed Code</label>
        <div class="col-sm-10">
            {!! Form::textarea('embed_link','', array('placeholder' => '','class' => 'form-control','id'=>'embed_link', 'dir'=>trans('backLang.ltr'),'rows'=>'3')) !!}
        </div>
    </div>
@endif

{{--  end type1 ................ --}}

   @if($WebmasterSection->type==3)
    <div class="form-group row">
        <label for="audio_file"
               class="col-sm-2 form-control-label">{!!  trans('backLang.topicAudio') !!}</label>
        <div class="col-sm-10">


                <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='audio_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

             {!! Form::text('audio_file','', array('placeholder' => '','class' => 'form-control','id'=>'audio_file')) !!}
         
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
               {!! Form::text('photo_file','', array('placeholder' => '','class' => 'form-control','id'=>'photo_file','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                
      {{--   {!! Form::file('photo_file', array('class' => 'form-control','id'=>'photo_file','accept'=>'image/*')) !!} --}}
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
                {!! Form::text('icon','', array('placeholder' => '','class' => 'form-control icp icp-auto','id'=>'icon', 'data-placement'=>'bottomRight')) !!}
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
             <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='attach_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
                     {!! Form::text('attach_file','', array('placeholder' => '','class' => 'form-control','id'=>'attach_file')) !!}
            {{-- {!! Form::file('attach_file', array('class' => 'form-control','id'=>'attach_file')) !!} --}}
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