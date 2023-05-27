          <div class="form-group  row">
        <label for="faculty_id"
               class="col-sm-2 form-control-label">{!!  trans('backLang.faculty') !!}  </label>
        <div class="col-sm-10">
            <?php 
         //   ['webmasterSection.name','faculties']
            $title_var = "title_" . trans('backLang.boxCode');
 $faculties=App\Models\Faculty::where('status', 1)->orderby('row_no', 'asc')->get();
         
            ?>
          
               <select name="faculty_id" id="faculty_id" class="form-control "
               
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
               <option value="{{ $facultiy->id  }}" {{ ($facultiy->id==$Topics->faculty_id) ? "selected='selected'":""  }}>{{ $ftitle }}</option>
            
            
        @endforeach
           

 


    </select>
      
        </div>
    </div>
          {!! Form::hidden('section_id',$section_id) !!}
 
           <?php 
         //   ['webmasterSection.name','faculties']
             $universitycenters=App\Models\Department::where('status', 1)->orderby('row_no', 'asc')->get();
              $title_father=trans('backLang.departments');
         if($section_id==44){
            $title_father=trans('backLang.universitycenters');
             $universitycenters=App\Models\UniversityCenter::where('status', 1)->orderby('row_no', 'asc')->get();
         }
            

  
            ?>
        <div class="form-group  row">
        <label for="father_id"
               class="col-sm-2 form-control-label">{!!  $title_father !!} </label>
        <div class="col-sm-10">
           
          
      <select name="father_id" id="father_id" class="form-control " 
                                    ui-jp="select2" placeholder="{{ $title_father  }}"
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

           
 
        @foreach ($universitycenters as $universitycenter)
            <?php
            if ($universitycenter->$title_var != "") {
                $ftitle = $universitycenter->$title_var;
            } else {
                $ftitle = $universitycenter->$title_var2;
            }
            ?>

            <option value="{{ $universitycenter->id  }}" {{ ($universitycenter->id==$Topics->father_id) ? "selected='selected'":""  }}>{{ $ftitle }}</option>
            
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
                {!! Form::text('title_ar',$Topics->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'title_ar', 'dir'=>trans('backLang.rtl'))) !!}
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
                {!! Form::text('title_en',$Topics->title_en, array('placeholder' => '','class' => 'form-control','id'=>'title_en', 'dir'=>trans('backLang.ltr'))) !!}
            </div>
        </div>
    @endif

 
<div class="form-group row">
    <label for="photo_file"
           class="col-sm-2 form-control-label">{!!  trans('backLang.topicPhoto') !!}</label>
    <div class="col-sm-10">
         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='photo_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>

        {!! Form::text('photo_file',$Topics->photo_file, array('placeholder' => '','class' => 'form-control','id'=>'photo_file')) !!}
        @if($Topics->photo_file!="")
            <div class="row">
                <div class="col-sm-12">
                    <div id="topic_photo" class="col-sm-4 box p-a-xs">

                        
                        <a target="_blank"
                           href="{{Helper::FilterImage($Topics->photo_file) }}"><img
                                    src="{{Helper::FilterImage($Topics->photo_file) }}"
                                    class="img-responsive photo_file groupMediaPhoto">
                            {{-- $Topics->photo_file --}}
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

 
 

 
    <div class="form-group row">
        <label for="attach_file"
               class="col-sm-2 form-control-label">{{ trans('frontLang.cv_teacher') }}</label>
        <div class="col-sm-10">
            @if($Topics->attach_file!="")
                <div id="topic_attach" class="col-sm-4 box p-a-xs">
                    
                   
                
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
             {!! Form::text('attach_file',$Topics->attach_file, array('placeholder' => '','class' => 'form-control','id'=>'attach_file')) !!}

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
                        <label for="email"
                               class="col-sm-2 form-control-label">{{ trans('frontLang.email') }}
                           
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('email',$Topics->email, array('placeholder' => '','class' => 'form-control','id'=>'email', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>
 

  <div class="form-group row">
                        <label for="qualification_ar"
                               class="col-sm-2 form-control-label">{{ trans('frontLang.Qualification') }}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('qualification_ar',$Topics->qualification_ar, array('placeholder' => '','class' => 'form-control','id'=>'qualification_ar', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="qualification_en"
                               class="col-sm-2 form-control-label">{{ trans('frontLang.Qualification') }}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('qualification_en',$Topics->qualification_en, array('placeholder' => '','class' => 'form-control','id'=>'qualification_en', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>



                     <div class="form-group row">
                        <label for="postion_ar"
                               class="col-sm-2 form-control-label">{{ trans('frontLang.Position') }}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('postion_ar',$Topics->postion_ar, array('placeholder' => '','class' => 'form-control','id'=>'postion_ar', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>

                 <div class="form-group row">
                        <label for="postion_en"
                               class="col-sm-2 form-control-label">{{ trans('frontLang.Position') }}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('postion_en',$Topics->postion_en, array('placeholder' => '','class' => 'form-control','id'=>'postion_en', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>


        <div class="form-group row">
                        <label for="address_ar"
                               class="col-sm-2 form-control-label">{{ trans('frontLang.address') }}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('address_ar',$Topics->address_ar, array('placeholder' => '','class' => 'form-control','id'=>'address_ar', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>

                 <div class="form-group row">
                        <label for="address_en"
                               class="col-sm-2 form-control-label">{{ trans('frontLang.address') }}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('address_en',$Topics->address_en, array('placeholder' => '','class' => 'form-control','id'=>'address_en', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>


        <div class="form-group row">
                        <label for="major_ar"
                               class="col-sm-2 form-control-label">{{ trans('frontLang.Major') }}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('major_ar',$Topics->major_ar, array('placeholder' => '','class' => 'form-control','id'=>'major_ar', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>

                 <div class="form-group row">
                        <label for="major_en"
                               class="col-sm-2 form-control-label">{{ trans('frontLang.Major') }}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('major_en',$Topics->major_en, array('placeholder' => '','class' => 'form-control','id'=>'major_en', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>

        <div class="form-group row">
                <label for="publications_ar"
                       class="col-sm-2 form-control-label">{{ trans('frontLang.Publications') }}
                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                </label>
                <div class="col-sm-10">
                    <div class="box p-a-xs">
                        {!! Form::textarea('publications_ar',$Topics->publications_ar, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                    </div>
                </div>
            </div>

         <div class="form-group row">
                <label for="publications_en"
                       class="col-sm-2 form-control-label">{{ trans('frontLang.Publications') }}
                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                </label>
                <div class="col-sm-10">
                    <div class="box p-a-xs">
                        {!! Form::textarea('publications_en',$Topics->publications_en, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                    </div>
                </div>
            </div>



        <div class="form-group row">
                <label for="Experiences_ar"
                       class="col-sm-2 form-control-label">{{ trans('frontLang.Experiences') }}
                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                </label>
                <div class="col-sm-10">
                    <div class="box p-a-xs">
                        {!! Form::textarea('Experiences_ar',$Topics->Experiences_ar, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                    </div>
                </div>
            </div>

         <div class="form-group row">
                <label for="Experiences_en"
                       class="col-sm-2 form-control-label">{{ trans('frontLang.Experiences') }}
                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                </label>
                <div class="col-sm-10">
                    <div class="box p-a-xs">
                        {!! Form::textarea('Experiences_en',$Topics->Experiences_en, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                    </div>
                </div>
            </div>



                 <div class="form-group row">
                <label for="Courses_ar"
                       class="col-sm-2 form-control-label">{{ trans('frontLang.Courses') }}
                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                </label>
                <div class="col-sm-10">
                    <div class="box p-a-xs">
                        {!! Form::textarea('Courses_ar',$Topics->Courses_ar, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                    </div>
                </div>
            </div>

         <div class="form-group row">
                <label for="Courses_en"
                       class="col-sm-2 form-control-label">{{ trans('frontLang.Courses') }}
                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                </label>
                <div class="col-sm-10">
                    <div class="box p-a-xs">
                        {!! Form::textarea('Courses_en',$Topics->Courses_en, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                    </div>
                </div>
            </div>




                 <div class="form-group row">
                <label for="Activities_ar"
                       class="col-sm-2 form-control-label">{{ trans('frontLang.Activities') }}
                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                </label>
                <div class="col-sm-10">
                    <div class="box p-a-xs">
                        {!! Form::textarea('Activities_ar',$Topics->Activities_ar, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                    </div>
                </div>
            </div>

         <div class="form-group row">
                <label for="Activities_en"
                       class="col-sm-2 form-control-label">{{ trans('frontLang.Activities') }}
                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                </label>
                <div class="col-sm-10">
                    <div class="box p-a-xs">
                        {!! Form::textarea('Activities_en',$Topics->Activities_en, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                    </div>
                </div>
            </div>


     
    <div class="form-group row">
        <label for="level_view"
               class="col-sm-2 form-control-label">{!!  trans('backLang.level_view') !!} </label>
        <div class="col-sm-10"> 
          
 <select name="level_view" id="level_view" class="form-control" required
                                     placeholder="{{ trans('backLang.level_view')  }}"
                                    ui-options="{theme: 'bootstrap'}">
        

        
     <option value="0"></option>
 <option value="1"  {{ ($Topics->level_view==1)?'selected':'' }}>1</option>
         
         <option value="2"  {{ ($Topics->level_view==1)?'selected':'' }}>2</option>   
 <option value="3"  {{ ($Topics->level_view==1)?'selected':'' }}>3</option>
 
           
 
         
   
    </select>
      
        </div>
    </div>  

 

        <div class="form-group row">
                            <label for="link_status"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.previous_emp') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('previous_emp','1',($Topics->previous_emp==1) ? true : false, array('id' => 'previous_emp1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('previous_emp','0',($Topics->previous_emp==0) ? true : false, array('id' => 'previous_emp2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>