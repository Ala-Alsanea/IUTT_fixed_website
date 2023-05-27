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
               <option value="{{ $facultiy->id  }}" {{ ($facultiy->id==$programs->faculty_id) ? "selected='selected'":""  }}>{{ $ftitle }}</option>
            
            
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
                {!! Form::text('title_ar',$programs->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
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
                {!! Form::text('title_en',$programs->title_en, array('placeholder' => '','class' => 'form-control','id'=>'title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
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
                            {!! Form::textarea('details_ar',$programs->details_ar, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control summernote', 'dir'=>trans('backLang.rtl'),'ui-options'=>'{height: 300}')) !!}
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
                            {!! Form::textarea('details_en',$programs->details_en, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                        </div>
                    </div>
                </div>
            @endif
                         <div class="form-group row">
                                <label for="details_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.url_link') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('url_link',$programs->url_link, array('placeholder' => '','class' => 'form-control','id'=>'url_link','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

 <div class="form-group row">
    <label for="photo_file"
           class="col-sm-2 form-control-label">{!!  trans('backLang.topicPhoto') !!}</label>
    <div class="col-sm-10">
         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='photo_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

        {!! Form::text('photo_file',$programs->photo_file, array('placeholder' => '','class' => 'form-control','id'=>'photo_file','required'=>'')) !!}
        @if($programs->photo_file!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($programs->photo_file) }}"><img
                                    src="{{Helper::FilterImage($programs->photo_file) }}"
                                    class="img-responsive photo_file groupMediaPhoto">
                            {{-- $programs->photo_file --}}
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

        {!! Form::text('banner',$programs->banner, array('placeholder' => '','class' => 'form-control','id'=>'banner','required'=>'')) !!}
        @if($programs->banner!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($programs->banner) }}"><img
                                    src="{{Helper::FilterImage($programs->banner) }}"
                                    class="img-responsive banner groupMediaPhoto">
                            {{-- $programs->photo_file --}}
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

        {!! Form::text('admitionbanner',$programs->admitionbanner, array('placeholder' => '','class' => 'form-control','id'=>'admitionbanner','required'=>'')) !!}
        @if($programs->admitionbanner!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($programs->admitionbanner) }}"><img
                                    src="{{Helper::FilterImage($programs->admitionbanner) }}"
                                    class="img-responsive admitionbanner groupMediaPhoto">
                            {{-- $programs->photo_file --}}
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
            @if($programs->attach_file!="")
                <div id="topic_attach" class="col-sm-4 box p-a-xs">
                 {{--    <a target="_blank"
                           href="{{Helper::FilterImage($programs->attach_file) }}"><img
                                    src="{{Helper::FilterImage($programs->attach_file) }}"
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
             {!! Form::text('attach_file',$programs->attach_file, array('placeholder' => '','class' => 'form-control','id'=>'attach_file')) !!}

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

 