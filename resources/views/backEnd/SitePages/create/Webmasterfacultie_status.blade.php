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

            <option value="{{ $facultiy->id  }}">{{ $ftitle }}</option>
            
        @endforeach
    </select>
      
        </div>
    </div>
 
    
@endif