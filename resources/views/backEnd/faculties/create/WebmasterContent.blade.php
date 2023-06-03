    
       <div class="form-group row">
@if(Helper::GeneralWebmasterSettings("ar_box_status"))
<div class="col-sm-6">
<label for="logo">{!!  trans('backLang.siteLogo') !!} @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif</label>
<br>
   <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='logo' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
     {!! Form::text('logo',null, array('placeholder' => '','class' => 'form-control','id'=>'logo','required'=>'')) !!}
 

 
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
     {!! Form::text('logo2',null, array('placeholder' => '','class' => 'form-control','id'=>'logo2','required'=>'')) !!}
 
  

    
  
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
                            {!! Form::text('title_ar','', array('placeholder' => '','class' => 'form-control','id'=>'title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
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
                                    <div class="box p-a-xs">
                                        {!! Form::textarea('details_ar','<div dir=rtl><br></div>', array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control summernote', 'dir'=>trans('backLang.rtl'),'ui-options'=>'{height: 300}')) !!}
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
                                        {!! Form::textarea('details_en','<div dir=ltr><br></div>', array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                
                       <div class="form-group row">
                                <label for="url_link"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.url_link') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('url_link','#', array('placeholder' => '','class' => 'form-control','id'=>'url_link','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>


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


<div class="form-group row">
    <label for="banner"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!}</label>
    <div class="col-sm-10">

         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
               {!! Form::text('banner','', array('placeholder' => '','class' => 'form-control','id'=>'banner','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                
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

<div class="form-group row">
    <label for="banner1"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!} 1</label>
    <div class="col-sm-10">

         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner1' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
               {!! Form::text('banner1','', array('placeholder' => '','class' => 'form-control','id'=>'banner1', 'dir'=>trans('backLang.ltr'))) !!}
                
      {{--   {!! Form::file('photo_file', array('class' => 'form-control','id'=>'photo_file','accept'=>'image/*')) !!} --}}
    </div>
</div>

<div class="form-group row">
    <label for="banner2"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!} 2</label>
    <div class="col-sm-10">

         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner2' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
               {!! Form::text('banner2','', array('placeholder' => '','class' => 'form-control','id'=>'banner2', 'dir'=>trans('backLang.ltr'))) !!}
                
      {{--   {!! Form::file('photo_file', array('class' => 'form-control','id'=>'photo_file','accept'=>'image/*')) !!} --}}
    </div>
</div>

<div class="form-group row">
    <label for="banner3"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!} 3</label>
    <div class="col-sm-10">

         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner3' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
               {!! Form::text('banner3','', array('placeholder' => '','class' => 'form-control','id'=>'banner3', 'dir'=>trans('backLang.ltr'))) !!}
                
      {{--   {!! Form::file('photo_file', array('class' => 'form-control','id'=>'photo_file','accept'=>'image/*')) !!} --}}
    </div>
</div>

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


                  @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                    <div class="form-group row">
                        <label for="addres_ar"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('addres_ar',null, array('placeholder' => '','class' => 'form-control','id'=>'addres_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
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
                            {!! Form::text('addres_en',null, array('placeholder' => '','class' => 'form-control','id'=>'addres_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>
                @endif


                              <div class="form-group row">
                                <label for="phone"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.phone') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('phone',null, array('placeholder' => '','class' => 'form-control','id'=>'phone','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

                              <div class="form-group row">
                                <label for="fax"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.fax') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('fax',null, array('placeholder' => '','class' => 'form-control','id'=>'fax','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

                              <div class="form-group row">
                                <label for="email"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.email') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('email',null, array('placeholder' => '','class' => 'form-control','id'=>'email','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>
 

 