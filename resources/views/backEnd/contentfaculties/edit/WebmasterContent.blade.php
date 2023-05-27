         <div class="form-group row">
        <label for="faculty_id"
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
               <option value="{{ $facultiy->id  }}" {{ ($facultiy->id==$contentsections->faculty_id) ? "selected='selected'":""  }}>{{ $ftitle }}</option>
            
            
        @endforeach
           

 


    </select>
      
        </div>
    </div>
   <div class="form-group hidden row">
        <label for="father_id"
               class="col-sm-2 form-control-label">{!!  trans('backLang.departments') !!}  </label>
        <div class="col-sm-10">
            <?php 
         //   ['webmasterSection.name','faculties']
            $title_var = "title_" . trans('backLang.boxCode');
 $departments=App\Models\Department::where('status', 1)->orderby('row_no', 'asc')->get();
         
            ?>
          
               <select name="father_id" id="father_id" class="form-control "
               
                                    ui-jp="select2" placeholder="{!!  trans('backLang.departments') !!} "
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

     

          
        @foreach ($departments as $department)
            <?php
            if ($department->$title_var != "") {
                $ftitle = $department->$title_var;
            } else {
                $ftitle = $department->$title_var2;
            }
            ?>
               <option value="{{ $department->id  }}" {{ ($department->id==$contentsections->father_id) ? "selected='selected'":""  }}>{{ $ftitle }}</option>
            
            
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
                {!! Form::text('title_ar',$contentsections->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
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
                {!! Form::text('title_en',$contentsections->title_en, array('placeholder' => '','class' => 'form-control','id'=>'title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
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
                            {!! Form::textarea('details_ar',$contentsections->details_ar, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control summernote', 'dir'=>trans('backLang.rtl'),'ui-options'=>'{height: 300}')) !!}
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
                            {!! Form::textarea('details_en',$contentsections->details_en, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                        </div>
                    </div>
                </div>
            @endif
                         <div class="form-group row hidden">
                                <label for="details_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.url_link') !!}
                                </label>
                                  <div class="col-sm-10">
                                    {!! Form::text('url_link',$contentsections->url_link, array('placeholder' => '','class' => 'form-control','id'=>'url_link','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>

 <div class="form-group row">
    <label for="photo_file"
           class="col-sm-2 form-control-label">{!!  trans('backLang.topicPhoto') !!}</label>
    <div class="col-sm-10">
         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='photo_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

        {!! Form::text('photo_file',$contentsections->photo_file, array('placeholder' => '','class' => 'form-control','id'=>'photo_file','required'=>'')) !!}
        @if($contentsections->photo_file!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($contentsections->photo_file) }}"><img
                                    src="{{Helper::FilterImage($contentsections->photo_file) }}"
                                    class="img-responsive photo_file groupMediaPhoto">
                            {{-- $contentsections->photo_file --}}
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

 
 <div class="form-group  row">
    <label for="banner"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!}</label>
    <div class="col-sm-10">
         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

        {!! Form::text('banner',$contentsections->banner, array('placeholder' => '','class' => 'form-control','id'=>'banner')) !!}
        @if($contentsections->banner!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($contentsections->banner) }}"><img
                                    src="{{Helper::FilterImage($contentsections->banner) }}"
                                    class="img-responsive banner groupMediaPhoto">
                            {{-- $contentsections->photo_file --}}
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

 
 

 

     <div class="form-group row hidden">
        <label for="attach_file"
               class="col-sm-2 form-control-label">{!!  trans('backLang.topicAttach') !!}</label>
        <div class="col-sm-10">
            @if($contentsections->attach_file!="")
                <div id="topic_attach" class="col-sm-4 box p-a-xs">
                 {{--    <a target="_blank"
                           href="{{Helper::FilterImage($contentsections->attach_file) }}"><img
                                    src="{{Helper::FilterImage($contentsections->attach_file) }}"
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
             {!! Form::text('attach_file',$contentsections->attach_file, array('placeholder' => '','class' => 'form-control','id'=>'attach_file')) !!}

         </div>
            
        </div>
    </div>
    <div class="form-group row m-t-md hidden" style="margin-top: 0 !important;">
        <div class="col-sm-offset-2 col-sm-10">
            <small>
                <i class="material-icons">&#xe8fd;</i>
                {!!  trans('backLang.attachTypes') !!}
            </small>
        </div>
    </div>
 


   <div class="form-group  row">
        <label for="catagoryes"
               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionsOf') !!} </label>
        <div class="col-sm-10"> 
          
 <select name="catagoryes" id="catagoryes" class="form-control " required
                                     placeholder="{{ trans('backLang.sectionsOf')  }}"
                                    ui-options="{theme: 'bootstrap'}">
        

        
            <option value="0"></option>
  
 
         
              <option value="1"  {{ ($contentsections->catagoryes==1)?'selected':'' }}>{{ trans('frontLang.Overview')  }}</option>
         
         <option value="2"  {{ ($contentsections->catagoryes==2)?'selected':'' }}>{{ trans('frontLang.Vision_Mission')  }}</option>   
           <option value="3" {{ ($contentsections->catagoryes==3)?'selected':'' }}>{{ trans('frontLang.deansmessage')  }}</option>
 <option value="4" {{ ($contentsections->catagoryes==4)?'selected':'' }}>{{ trans('frontLang.coursedescriptions')  }}</option>
 <option value="5"  {{ ($contentsections->catagoryes==5)?'selected':'' }}>{{ trans('frontLang.AcademicPlan')  }}</option> 
 <option value="6" {{ ($contentsections->catagoryes==6)?'selected':'' }}>{{ trans('frontLang.highlights')  }}</option>



   
    </select>
      
        </div>
    </div>