<?php 
$listRelatdFaculty=array('facultiesslider','fstudents','news','departments','sitePages');
  $existfaculty=false;
if(in_array($WebmasterSection->name,$listRelatdFaculty)){
$existfaculty=true;
}
?>
  @if($existfaculty)

    <div class="form-group row">
        <label for="section_id"
               class="col-sm-2 form-control-label">{!!  trans('backLang.faculties') !!} </label>
        <div class="col-sm-10">
            <?php 
         //   ['webmasterSection.name','faculties']
            $title_var = "title_" . trans('backLang.boxCode');
 $faculties=App\Models\Topic::where([['status', 1],['webmaster_id',15]])->orderby('row_no', 'asc')->get();
   
            ?>
          
               <select name="father_id" id="father_id" class="form-control " 
                                    ui-jp="select2" placeholder="{{ trans('backLang.faculty') }}"
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
               <option value="{{ $facultiy->id  }}" {{ ($facultiy->id==$Topics->father_id) ? "selected='selected'":""  }}>{{ $ftitle }}</option>
            
            
        @endforeach
    </select>
      
        </div>
    </div>
 
    
@endif

           <div class="form-group row">
                    <label for="hasParents"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.hasParents') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('hasParents','0',true, array('id' => 'status1','class'=>'has-value','onclick'=>'document.getElementById("father_id_topcs").style.display="block";')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('hasParents','1',false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.no') }}
                            </label>
                            
                           
                        </div>
                    </div>
                </div>
  <div class="form-group row" id="father_id_topcs">
        <label for="father_id"
               class="col-sm-2 form-control-label">{!!  trans('backLang.faculties') !!} </label>
        <div class="col-sm-10">
            <?php 
         //   ['webmasterSection.name','faculties']
            $title_var = "title_" . trans('backLang.boxCode');
 $sitePages=App\Models\Topic::where([['status', 1],['webmaster_id',1]])->orderby('row_no', 'asc')->get();
   
            ?>
          
               <select name="father_id" id="father_id" class="form-control " 
                                    ui-jp="select2"  
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