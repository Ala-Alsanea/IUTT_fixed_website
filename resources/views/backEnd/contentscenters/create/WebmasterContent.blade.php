    
    <div class="form-group hidden row">
        <label for="faculty_id"
               class="col-sm-2 form-control-label">{!!  trans('backLang.faculty') !!} </label>
        <div class="col-sm-10">
            <?php 
         //   ['webmasterSection.name','faculties']
        
            
 $faculties=App\Models\Faculty::where('status', 1)->orderby('row_no', 'asc')->get();
  
            ?>
          
               <select name="faculty_id" id="faculty_id" class="form-control " 
                                    ui-jp="select2" placeholder="{{ trans('backLang.faculty')  }}"
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

            <option value="{{ $facultiy->id  }}">{{ $ftitle }}</option>
            
        @endforeach
          

   
    </select>
      
        </div>
    </div>
 
     <div class="form-group row">
        <label for="father_id"
               class="col-sm-2 form-control-label">{!!  trans('backLang.universitycenters') !!} </label>
        <div class="col-sm-10">
            <?php 
         //   ['webmasterSection.name','faculties']
        
            
 $universitycenters=App\Models\UniversityCenter::where('status', 1)->orderby('row_no', 'asc')->get();
  
            ?>
          
               <select name="father_id" id="father_id" class="form-control " required
                                    ui-jp="select2" placeholder="{{ trans('backLang.universitycenter')  }}"
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

            <option value="{{ $universitycenter->id  }}">{{ $ftitle }}</option>
            
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
                
                       <div class="form-group row hidden">
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


<div class="form-group row  hidden">
    <label for="banner"
           class="col-sm-2 form-control-label">{!!  trans('backLang.banner') !!}</label>
    <div class="col-sm-10">

         <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='banner' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
               {!! Form::text('banner','', array('placeholder' => '','class' => 'form-control','id'=>'banner', 'dir'=>trans('backLang.ltr'))) !!}
                
      {{--   {!! Form::file('photo_file', array('class' => 'form-control','id'=>'photo_file','accept'=>'image/*')) !!} --}}
    </div>
</div>

<div class="form-group row hidden m-t-md" style="margin-top: 0 !important;">
    <div class="col-sm-offset-2 col-sm-10">
        <small>
            <i class="material-icons">&#xe8fd;</i>
            {!!  trans('backLang.imagesTypes') !!}
        </small>
    </div>
</div>

 


    <div class="form-group row hidden">
        <label for="attach_file"
               class="col-sm-2 form-control-label">{!!  trans('backLang.topicAttach') !!}</label>
        <div class="col-sm-10">
             <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='attach_file' type=0 multi=0> {!!  trans('backLang.iframebtn') !!}</a>
                     {!! Form::text('attach_file','', array('placeholder' => '','class' => 'form-control','id'=>'attach_file')) !!}
            {{-- {!! Form::file('attach_file', array('class' => 'form-control','id'=>'attach_file')) !!} --}}
        </div>
    </div>
    <div class="form-group row hidden m-t-md" style="margin-top: 0 !important;">
        <div class="col-sm-offset-2 col-sm-10">
            <small>
                <i class="material-icons">&#xe8fd;</i>
                {!!  trans('backLang.attachTypes') !!}
            </small>
        </div>
    </div>

  
 

     
    <div class="form-group row">
        <label for="catagoryes"
               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionsOf') !!} </label>
        <div class="col-sm-10"> 
          
 <select name="catagoryes" id="catagoryes" class="form-control " required
                                     placeholder="{{ trans('backLang.sectionsOf')  }}"
                                    ui-options="{theme: 'bootstrap'}">
        

        
            <option value="0"></option>
 <option value="1">{{ trans('frontLang.Overview')  }}</option>
         
         <option value="2">{{ trans('frontLang.Vision_Mission')  }}</option>   
 <option value="3">{{ trans('frontLang.coursedescriptions')  }}</option>
 <option value="4">{{ trans('frontLang.AcademicPlan')  }}</option>
           
 
         
   
    </select>
      
        </div>
    </div>