   <div class="form-group row">
        <label for="father_id"
               class="col-sm-2 form-control-label">{!!  trans('backLang.faculty') !!}  </label>
        <div class="col-sm-10">
            <?php 
         //   ['webmasterSection.name','faculties']
            $title_var = "title_" . trans('backLang.boxCode');
 $faculties=App\Models\Faculty::where('status', 1)->orderby('row_no', 'asc')->get();
         
            ?>
          
               <select name="faculty_id" id="faculty_id" class="form-control "
              required 
                                    ui-jp="select2" placeholder="{!!  trans('backLang.faculty') !!} "
                                    ui-options="{theme: 'bootstrap'}">
        <?php
        $title_var = "title_" . trans('backLang.boxCode');
        $title_var2 = "title_" . trans('backLang.boxCodeOther');
        $t_arrow = "&laquo;";
        if (trans('backLang.direction') == "ltr") {
            $t_arrow = "&raquo;";
        }
        ?>
         

            <option value="0"></option>

     

          
        @foreach ($faculties as $facultiy)
            <?php
            if ($facultiy->$title_var != "") {
                $ftitle = $facultiy->$title_var;
            } else {
                $ftitle = $facultiy->$title_var2;
            }
            ?>
               <option value="{{ $facultiy->id  }}" {{ ($facultiy->id==$universitycenters->faculty_id) ? "selected='selected'":""  }}>{{ $ftitle }}</option>
            
            
        @endforeach
           

 


    </select>
      
        </div>
    </div>
@if(Helper::GeneralWebmasterSettings("ar_box_status"))
        <div class="form-group row">
            <label for="title_ar"
                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
            </label>
            <div class="col-sm-10">
                {!! Form::text('title_ar',$universitycenters->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
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
                {!! Form::text('title_en',$universitycenters->title_en, array('placeholder' => '','class' => 'form-control','id'=>'title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
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
                            {!! Form::textarea('details_ar',$universitycenters->details_ar, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control summernote', 'dir'=>trans('backLang.rtl'),'ui-options'=>'{height: 300}')) !!}
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
                            {!! Form::textarea('details_en',$universitycenters->details_en, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                        </div>
                    </div>
                </div>
            @endif
                         <div class="form-group row">
                                <label for="details_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.url_link') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('url_link',$universitycenters->url_link, array('placeholder' => '','class' => 'form-control','id'=>'url_link','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

 <div class="form-group row">
    <label for="photo_file"
           class="col-sm-2 form-control-label">{!!  trans('backLang.topicPhoto') !!}</label>
    <div class="col-sm-10">
         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='photo_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

        {!! Form::text('photo_file',$universitycenters->photo_file, array('placeholder' => '','class' => 'form-control','id'=>'photo_file','required'=>'')) !!}
        @if($universitycenters->photo_file!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($universitycenters->photo_file) }}"><img
                                    src="{{Helper::FilterImage($universitycenters->photo_file) }}"
                                    class="img-responsive photo_file groupMediaPhoto">
                            {{-- $universitycenters->photo_file --}}
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

        {!! Form::text('banner',$universitycenters->banner, array('placeholder' => '','class' => 'form-control','id'=>'banner','required'=>'')) !!}
        @if($universitycenters->banner!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($universitycenters->banner) }}"><img
                                    src="{{Helper::FilterImage($universitycenters->banner) }}"
                                    class="img-responsive banner groupMediaPhoto">
                            {{-- $universitycenters->photo_file --}}
                        </a>
                       
                        <a onclick="document.getElementById('topic_photo').style.display='none';document.getElementById('banner_delete').value='1';document.getElementById('undo').style.display='block';"
                           class="btn btn-sm btn-default">{!!  trans('backLang.delete') !!}</a>
                    </div>
                    <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                        <a onclick="document.getElementById('topic_photo').style.display='block';document.getElementById('banner_delete').value='0';document.getElementById('undo').style.display='none';">
                            <i class="material-icons">
                                &#xe166;</i> {!!  trans('backLang.undoDelete') !!}</a>
                    </div>


                    {!! Form::hidden('banner_delete','0', array('id'=>'banner_delete')) !!}
                </div>
            </div>
        @endif

        
 

    </div>
</div>

 

 <div class="form-group row">
    <label for="admitionbanner"
           class="col-sm-2 form-control-label">{!!  trans('backLang.topicPhoto') !!}</label>
    <div class="col-sm-10">
         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='admitionbanner' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

        {!! Form::text('admitionbanner',$universitycenters->admitionbanner, array('placeholder' => '','class' => 'form-control','id'=>'admitionbanner','required'=>'')) !!}
        @if($universitycenters->admitionbanner!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($universitycenters->admitionbanner) }}"><img
                                    src="{{Helper::FilterImage($universitycenters->admitionbanner) }}"
                                    class="img-responsive admitionbanner groupMediaPhoto">
                            {{-- $universitycenters->photo_file --}}
                        </a>
                       
                        <a onclick="document.getElementById('topic_photo').style.display='none';document.getElementById('admitionbanner_delete').value='1';document.getElementById('undo').style.display='block';"
                           class="btn btn-sm btn-default">{!!  trans('backLang.delete') !!}</a>
                    </div>
                    <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                        <a onclick="document.getElementById('topic_admitionbanner').style.display='block';document.getElementById('admitionbanner_delete').value='0';document.getElementById('undo').style.display='none';">
                            <i class="material-icons">
                                &#xe166;</i> {!!  trans('backLang.undoDelete') !!}</a>
                    </div>


                    {!! Form::hidden('admitionbanner_delete','0', array('id'=>'admitionbanner_delete')) !!}
                </div>
            </div>
        @endif

        
 

    </div>
</div>

 

 

     <div class="form-group row">
        <label for="attach_file"
               class="col-sm-2 form-control-label">{!!  trans('backLang.topicAttach') !!}</label>
        <div class="col-sm-10">
            @if($universitycenters->attach_file!="")
                <div id="topic_attach" class="col-sm-4 box p-a-xs">
                 {{--    <a target="_blank"
                           href="{{Helper::FilterImage($universitycenters->attach_file) }}"><img
                                    src="{{Helper::FilterImage($universitycenters->attach_file) }}"
                                    class="img-responsive">
                          
                        </a>
                    --}}
                
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
             {!! Form::text('attach_file',$universitycenters->attach_file, array('placeholder' => '','class' => 'form-control','id'=>'attach_file')) !!}

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
 <div class="form-group row">
                                <label for="mobile"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.mobile') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('mobile',$universitycenters->mobile, array('placeholder' => '','class' => 'form-control','id'=>'mobile','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>
       <div class="form-group row">
                                <label for="phone"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.phone') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('phone',$universitycenters->phone, array('placeholder' => '','class' => 'form-control','id'=>'phone','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

                              <div class="form-group row">
                                <label for="fax"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.fax') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('fax',$universitycenters->fax, array('placeholder' => '','class' => 'form-control','id'=>'fax','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

                              <div class="form-group row">
                                <label for="email"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.email') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('email',$universitycenters->email, array('placeholder' => '','class' => 'form-control','id'=>'email','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>        