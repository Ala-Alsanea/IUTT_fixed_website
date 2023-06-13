   <div class="form-group row">
@if(Helper::GeneralWebmasterSettings("ar_box_status"))
<div class="col-sm-6">
<label for="logo">{!!  trans('backLang.siteLogo') !!} @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif</label>
<br>
   <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='logo' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
     {!! Form::text('logo',$Facultys->logo, array('placeholder' => '','class' => 'form-control','id'=>'logo','required'=>'')) !!}
@if($Facultys->logo!="")
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12 box p-a-xs text-center">

            <a target="_blank"
               href="{{ Helper::FilterImage($Facultys->logo) }}"><img
                        src="{{ Helper::FilterImage($Facultys->logo) }}"
                        class="img-responsive groupMediaPhoto logo" id="logo_prv"
                        style="width: auto;max-width: 260px;max-height: 60px">
                <br>
                <small>{{ $Facultys->logo }}</small>
            </a>
        </div>
    </div>
</div>
@else
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 box p-a-xs text-center">
                <img
                        src="{{ asset('uploads/settings/nologo.png') }}"
                        class="img-responsive logo groupMediaPhoto" id="logo_prv"
                        style="width: auto;max-width: 260px;max-height: 60px">
                <br>
                <small>nologo.png</small>

            </div>
        </div>
    </div>
@endif



<small>
    <i class="material-icons">&#xe8fd;</i>( 260x60 px ) -
    {!!  trans('backLang.imagesTypes') !!}
</small>
</div>
@endif
@if(Helper::GeneralWebmasterSettings("en_box_status"))
<div class="col-sm-6">
    <label for="logo2">{!!  trans('backLang.siteLogo') !!} @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif</label>
    <br>
      <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='logo2' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
     {!! Form::text('logo2',$Facultys->logo2, array('placeholder' => '','class' => 'form-control','id'=>'logo2','required'=>'')) !!}
    @if($Facultys->logo2!="")
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-12 box p-a-xs text-center">
                    <a target="_blank"
                       href="{{ Helper::FilterImage($Facultys->logo2) }}"><img
                                src="{{ Helper::FilterImage($Facultys->logo2) }}"
                                class="img-responsive logo2  groupMediaPhoto" id="logo2_prv"
                                style="width: auto;max-width: 260px;max-height: 60px">
                        <br>
                        <small>{{ $Facultys->logo2 }}</small>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-12 box p-a-xs text-center">
                    <img
                            src="{{ asset('uploads/settings/nologo.png') }}"
                            class="img-responsive logo2 groupMediaPhoto" id="logo2_prv"
                            style="width: auto;max-width: 260px;max-height: 60px">
                    <br>
                    <small>nologo.png</small>

                </div>
            </div>
        </div>
    @endif



    <small>
        <i class="material-icons">&#xe8fd;</i>( 260x60 px ) -
        {!!  trans('backLang.imagesTypes') !!}
    </small>
</div>
@endif

</div>
<hr>
@if(Helper::GeneralWebmasterSettings("ar_box_status"))
        <div class="form-group row">
            <label for="title_ar"
                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
            </label>
            <div class="col-sm-10">
                {!! Form::text('title_ar',$Facultys->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
            </div>
        </div>
    @endif
    @if(Helper::GeneralWebmasterSettings("en_box_status"))
        <div class="form-group row">
            <label for="title_en"
                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
            </label>
            <div class="col-sm-10">
                {!! Form::text('title_en',$Facultys->title_en, array('placeholder' => '','class' => 'form-control','id'=>'title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
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
                        <div class="box p-a-xs">
                            {!! Form::textarea('details_ar',$Facultys->details_ar, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control summernote', 'dir'=>trans('backLang.rtl'),'ui-options'=>'{height: 300}')) !!}
                        </div>
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
                            {!! Form::textarea('details_en',$Facultys->details_en, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                        </div>
                    </div>
                </div>
            @endif
                         <div class="form-group row">
                                <label for="details_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.url_link') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('url_link',$Facultys->url_link, array('placeholder' => '','class' => 'form-control','id'=>'url_link','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

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


<div class="form-group row">
    <label for="banner"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!}</label>
    <div class="col-sm-10">

         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
               {!! Form::text('banner',$Facultys->banner, array('placeholder' => '','class' => 'form-control','id'=>'banner','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}

     <div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12 box p-a-xs text-center">

            <a target="_blank"
               href="{{ Helper::FilterImage($Facultys->banner) }}"><img
                        src="{{ Helper::FilterImage($Facultys->banner) }}"
                        class="img-responsive groupMediaPhoto logo" id="logo_prv"
                        style="width: auto;max-width: 260px;max-height: 60px">
                <br>
                <small>{{ $Facultys->banner }}</small>
            </a>
        </div>
    </div>
</div>
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

<div class="form-group row">
    <label for="banner"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!} 1</label>
    <div class="col-sm-10">

         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner1' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
               {!! Form::text('banner1',$Facultys->banner1, array('placeholder' => '','class' => 'form-control','id'=>'banner1','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}

     <div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12 box p-a-xs text-center">

            <a target="_blank"
               href="{{ Helper::FilterImage($Facultys->banner1) }}"><img
                        src="{{ Helper::FilterImage($Facultys->banner1) }}"
                        class="img-responsive groupMediaPhoto banner1" id="banner1_prv"
                        style="width: auto;max-width: 260px;max-height: 60px">
                <br>
                <small>{{ $Facultys->banner1 }}</small>
            </a>
        </div>
    </div>
</div>
    </div>
</div>


<div class="form-group row">
    <label for="banner"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!} 2</label>
    <div class="col-sm-10">

         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner2' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
               {!! Form::text('banner2',$Facultys->banner2, array('placeholder' => '','class' => 'form-control','id'=>'banner2','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}

     <div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12 box p-a-xs text-center">

            <a target="_blank"
               href="{{ Helper::FilterImage($Facultys->banner2) }}"><img
                        src="{{ Helper::FilterImage($Facultys->banner2) }}"
                        class="img-responsive groupMediaPhoto banner2" id="banner2_prv"
                        style="width: auto;max-width: 260px;max-height: 60px">
                <br>
                <small>{{ $Facultys->banner2 }}</small>
            </a>
        </div>
    </div>
</div>
    </div>
</div>


<div class="form-group row">
    <label for="banner"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!} 3</label>
    <div class="col-sm-10">

         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner3' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
               {!! Form::text('banner3',$Facultys->banner3, array('placeholder' => '','class' => 'form-control','id'=>'banner3','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}

     <div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12 box p-a-xs text-center">

            <a target="_blank"
               href="{{ Helper::FilterImage($Facultys->banner3) }}"><img
                        src="{{ Helper::FilterImage($Facultys->banner3) }}"
                        class="img-responsive groupMediaPhoto banner3" id="banner3_prv"
                        style="width: auto;max-width: 260px;max-height: 60px">
                <br>
                <small>{{ $Facultys->banner3 }}</small>
            </a>
        </div>
    </div>
</div>
    </div>
</div>

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


                  @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                    <div class="form-group row">
                        <label for="addres_ar"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('addres_ar',$Facultys->addres_ar, array('placeholder' => '','class' => 'form-control','id'=>'addres_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>
                @endif
                @if(Helper::GeneralWebmasterSettings("en_box_status"))
                    <div class="form-group row">
                        <label for="addres_en"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('addres_en',$Facultys->addres_en, array('placeholder' => '','class' => 'form-control','id'=>'addres_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>
                @endif


                              <div class="form-group row">
                                <label for="phone"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.phone') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('phone',$Facultys->phone, array('placeholder' => '','class' => 'form-control','id'=>'phone','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

                              <div class="form-group row">
                                <label for="fax"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.fax') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('fax',$Facultys->fax, array('placeholder' => '','class' => 'form-control','id'=>'fax','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

                              <div class="form-group row">
                                <label for="email"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.email') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('email',$Facultys->email, array('placeholder' => '','class' => 'form-control','id'=>'email','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

