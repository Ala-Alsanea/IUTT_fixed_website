<?php 
$listRelatdFaculty=array('facultiesslider','fstudents','news','departments','sitePages','contentsdepartment','section_quik_icon','academicstaff','contentprograms','lecturertable','contentscenters');
  $existfaculty=false;
if(in_array($WebmasterSection->name,$listRelatdFaculty)){
$existfaculty=true;
} 
   $title_var = "title_" . trans('backLang.boxCode');
            $titleLable=trans('backLang.faculty');
            $webmaster_id=15;
            if ($WebmasterSection->name=='contentsdepartment') {
              $webmaster_id=22;
               $titleLable=trans('backLang.departments');

             }elseif ($WebmasterSection->name=='section_quik_icon') {
               $webmaster_id=22;
               $titleLable=trans('backLang.departments');
              }elseif ($WebmasterSection->name=='contentprograms') {
               $webmaster_id=16;
               $titleLable=trans('backLang.programs');
             }elseif ($WebmasterSection->name=='contentscenters') {
               $webmaster_id=30;
               $titleLable=trans('backLang.universitycenters');
             }

?>
<style type="text/css">
    optgroup span{
        font-weight:bold; 
    }
    .rtl .childmenu{
        margin-right:10px; 
    }
    .ltr .childmenu{
         margin-left:10px; 
    }
</style>
    <div class="form-group row">
        <label for="faculty_id"
               class="col-sm-2 form-control-label">{!!  trans('backLang.faculty') !!}  </label>
        <div class="col-sm-10">
            <?php 
         //   ['webmasterSection.name','faculties']
            $title_var = "title_" . trans('backLang.boxCode');
        $faculties=App\Models\Topic::where([['status', 1],['webmaster_id',$webmaster_id]])->orderby('row_no', 'asc')->get();
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
          @if($WebmasterSection->name=='news')
           <option value="0">{{ trans('backLang.public') }}</option>
           @else

            <option value="0"></option>

            @endif

          
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
 

  @if($WebmasterSection->name=='sitePages' || $WebmasterSection->name=='section_quik_icon')
           <div class="form-group row">
                    <label for="hasParents"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.hasParents') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('hasParents','0',false, array('id' => 'status1','class'=>'has-value','onclick'=>'document.getElementById("father_id_topcs").style.display="block";')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('hasParents','1',true, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("father_id_topcs").style.display="none";')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.no') }}
                            </label>
                            
                           
                        </div>
                    </div>
                </div>
                <style type="text/css">
                  .select2.select2-container.select2-container--bootstrap{
                    width:100% !important; 
                  }
                </style>
 <div class="" id="father_id_topcs" style="display:{{ ($Topics->refrence_id>0)?'block':'none' }} ">
  <div class="form-group row ">
        <label for="refrence_id"
               class="col-sm-2 form-control-label">{!!  trans('backLang.father_id') !!} </label>
        <div class="col-sm-10">
            <?php 
         //   ['webmasterSection.name','faculties']
            $title_var = "title_" . trans('backLang.boxCode');
 $sitePages=App\Models\Topic::where([['status', 1],['webmaster_id',1]])->orderby('row_no', 'asc')->get();
   
            ?>
          
               <select name="father_id"  id="father_id"  class="form-control"  ui-jp="select2"    placeholder="{{ trans('backLang.father_id') }}"
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

        
        @foreach ($sitePages as $sitePage)
            <?php
            if ($sitePage->$title_var != "") {
                $sitePagetitle = $sitePage->$title_var;
            } else {
                $sitePagetitle = $sitePage->$title_var2;
            }
            ?>
               <option value="{{ $sitePage->id  }}" {{ ($sitePage->id==$Topics->father_id) ? "selected='selected'":""  }}>{{ $sitePagetitle }}</option>
            
            
        @endforeach
    </select>
      
        </div>
    </div>
  </div>

  @endif