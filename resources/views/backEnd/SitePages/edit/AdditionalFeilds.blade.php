
{{--Additional Feilds--}}
@if(count((array)$WebmasterSection->customFields) >0)
    <?php
    $cf_title_var = "title_" . trans('backLang.boxCode');
    $cf_title_var2 = "title_" . trans('backLang.boxCodeOther');
    ?>
    @foreach($WebmasterSection->customFields as $customField)
        <?php
        if ($customField->$cf_title_var != "") {
            $cf_title = $customField->$cf_title_var;
        } else {
            $cf_title = $customField->$cf_title_var2;
        }

        // check field language status
        $cf_land_identifier = "";
        $cf_land_active = false;
        $cf_land_dir = trans('backLang.direction');
        if (Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")) {
            if ($customField->lang_code == "ar") {
                $cf_land_identifier = trans('backLang.arabicBox');
            } elseif ($customField->lang_code == "en") {
                $cf_land_identifier = trans('backLang.englishBox');
            }
        }
        if (Helper::GeneralWebmasterSettings("ar_box_status") && $customField->lang_code == "ar") {
            $cf_land_active = true;
            $cf_land_dir = "rtl";
        }
        if (Helper::GeneralWebmasterSettings("en_box_status") && $customField->lang_code == "en") {
            $cf_land_active = true;
            $cf_land_dir = "ltr";
        }
        if ($customField->lang_code == "all") {
            $cf_land_active = true;
        }
        // required Status
        $cf_required = "";
        if ($customField->required) {
            $cf_required = "required";
        }

        $cf_saved_val = "";
        $cf_saved_val_array = array();
        if (count((array)$Topics->fields) > 0) {
            foreach ($Topics->fields as $t_field) {
                if ($t_field->field_id == $customField->id) {
                    if ($customField->type == 7) {
                        // if multi check
                        $cf_saved_val_array = explode(", ", $t_field->field_value);
                    } else {
                        $cf_saved_val = $t_field->field_value;
                    }
                }
            }
        }


        ?>

        @if($cf_land_active)
            @if($customField->type ==12)
                {{--Vimeo Video Link--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!} <i class="fa fa-vimeo"></i>
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('customField_'.$customField->id,$cf_saved_val, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>'ltr')) !!}
                    </div>
                </div>
            @elseif($customField->type ==11)
                {{--Youtube Video Link--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!} <i class="fa fa-youtube"></i>
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('customField_'.$customField->id,$cf_saved_val, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>'ltr')) !!}
                    </div>
                </div>
            @elseif($customField->type ==10)
                {{--Video File--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}</label>
                    <div class="col-sm-10">
                        @if($cf_saved_val !="")
                            <?php
                            $file_name_id = 'topic_file_' . $customField->id;
                            $file_del_id = 'file_delete_' . $customField->id;
                            $file_old_id = 'file_old_' . $customField->id;
                            $file_undo_id = 'undo_' . $customField->id;
                            ?>
                            <div id="{{$file_name_id}}" class="col-sm-4 box p-a-xs">
                                <video width="380" height="230" controls>
                                    <source src="{{ asset('uploads/topics/'.$cf_saved_val) }}"
                                            type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <a target="_blank"
                                   href="{{ asset('uploads/topics/'.$cf_saved_val) }}">
                                    {{ $cf_saved_val }}
                                </a>
                                <br>
                                <a onclick="document.getElementById('{{$file_name_id}}').style.display='none';document.getElementById('{{$file_del_id}}').value='1';document.getElementById('{{$file_undo_id}}').style.display='block';"
                                   class="btn btn-sm btn-default">{!!  trans('backLang.delete') !!}</a>
                            </div>
                            <div id="{{$file_undo_id}}" class="col-sm-4 p-a-xs"
                                 style="display: none">
                                <a onclick="document.getElementById('{{$file_name_id}}').style.display='block';document.getElementById('{{$file_del_id}}').value='0';document.getElementById('{{$file_undo_id}}').style.display='none';">
                                    <i class="material-icons">
                                        &#xe166;</i> {!!  trans('backLang.undoDelete') !!}</a>
                            </div>

                            {!! Form::hidden($file_del_id,'0', array('id'=>$file_del_id)) !!}
                            {!! Form::hidden($file_old_id,$cf_saved_val, array('id'=>$file_old_id)) !!}
                        @endif
                        {!! Form::file('customField_'.$customField->id, array('class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','accept'=>'*')) !!}
                    </div>
                </div>
            @elseif($customField->type ==9)
                {{--Attach File--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}</label>
                    <div class="col-sm-10">
                        @if($cf_saved_val !="")
                            <?php
                            $file_name_id = 'topic_file_' . $customField->id;
                            $file_del_id = 'file_delete_' . $customField->id;
                            $file_old_id = 'file_old_' . $customField->id;
                            $file_undo_id = 'undo_' . $customField->id;
                            ?>
                            <div id="{{$file_name_id}}" class="col-sm-4 box p-a-xs">
                                <a target="_blank"
                                   href="{{ asset('uploads/topics/'.$cf_saved_val) }}">
                                    {{ $cf_saved_val }}
                                </a>
                                <br>
                                <a onclick="document.getElementById('{{$file_name_id}}').style.display='none';document.getElementById('{{$file_del_id}}').value='1';document.getElementById('{{$file_undo_id}}').style.display='block';"
                                   class="btn btn-sm btn-default">{!!  trans('backLang.delete') !!}</a>
                            </div>
                            <div id="{{$file_undo_id}}" class="col-sm-4 p-a-xs"
                                 style="display: none">
                                <a onclick="document.getElementById('{{$file_name_id}}').style.display='block';document.getElementById('{{$file_del_id}}').value='0';document.getElementById('{{$file_undo_id}}').style.display='none';">
                                    <i class="material-icons">
                                        &#xe166;</i> {!!  trans('backLang.undoDelete') !!}</a>
                            </div>

                            {!! Form::hidden($file_del_id,'0', array('id'=>$file_del_id)) !!}
                            {!! Form::hidden($file_old_id,$cf_saved_val, array('id'=>$file_old_id)) !!}
                        @endif
                        {!! Form::file('customField_'.$customField->id, array('class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','accept'=>'*')) !!}
                    </div>
                </div>
            @elseif($customField->type ==8)
                {{--Photo File--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}</label>
                    <div class="col-sm-10">
                       {{--  @if($cf_saved_val !="") --}}
                            <?php
                            $file_name_id = 'topic_file_' . $customField->id;
                            $file_del_id = 'file_delete_' . $customField->id;
                            $file_old_id = 'file_old_' . $customField->id;
                            $file_undo_id = 'undo_' . $customField->id;
                            ?>
                               <div class="col-sm-10">
                                  <a href="javascript:void(0)"    class="btn  iframe-btn" onclick="App.OpenFileManager(this)" field_id='customField_{!! $customField->id !!}' type=0 multi=0>{{ trans('backLang.iframebtn') }}</a>
                                 </div>


                               {!! Form::text('customField_'.$customField->id,  Helper::FilterImage($cf_saved_val), array('class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'')) !!}
                            <div id="{{$file_name_id}}" class="col-sm-4 box p-a-xs">
                                <a target="_blank"
                                   href="{{ Helper::FilterImage($cf_saved_val) }}  "><img
                                            src="{{ Helper::FilterImage($cf_saved_val) }}"
                                            class="img-responsive  groupMediaPhoto customField_{{ $customField->id }}">
                                   {{ Helper::FilterImage($cf_saved_val) }}
                                </a>
                                <br>
                                <a onclick="document.getElementById('{{$file_name_id}}').style.display='none';document.getElementById('{{$file_del_id}}').value='1';document.getElementById('{{$file_undo_id}}').style.display='block';"
                                   class="btn btn-sm btn-default">{!!  trans('backLang.delete') !!}</a>
                            </div>
                            <div id="{{$file_undo_id}}" class="col-sm-4 p-a-xs"
                                 style="display: none">
                                <a onclick="document.getElementById('{{$file_name_id}}').style.display='block';document.getElementById('{{$file_del_id}}').value='0';document.getElementById('{{$file_undo_id}}').style.display='none';">
                                    <i class="material-icons">
                                        &#xe166;</i> {!!  trans('backLang.undoDelete') !!}</a>
                            </div>

                            {!! Form::hidden($file_del_id,'0', array('id'=>$file_del_id)) !!}
                            {!! Form::hidden($file_old_id,$cf_saved_val, array('id'=>$file_old_id)) !!}
                       {{--  @endif --}}


                    </div>
                </div>
            @elseif($customField->type ==7)
                {{--Multi Check--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}</label>
                    <div class="col-sm-10">
                        <select name="{{'customField_'.$customField->id}}[]"
                                id="{{'customField_'.$customField->id}}"
                                class="form-control select2-multiple" multiple
                                ui-jp="select2"
                                ui-options="{theme: 'bootstrap'}" {{$cf_required}}>
                            <?php
                            $cf_details_var = "details_" . trans('backLang.boxCode');
                            $cf_details_var2 = "details_en" . trans('backLang.boxCodeOther');
                            if ($customField->$cf_details_var != "") {
                                $cf_details = $customField->$cf_details_var;
                            } else {
                                $cf_details = $customField->$cf_details_var2;
                            }
                            $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                            $line_num = 1;
                            ?>
                            @foreach ($cf_details_lines as $cf_details_line)
                                <option value="{{ $line_num  }}" {{ (in_array($line_num,$cf_saved_val_array)) ? "selected='selected'":""  }}>{{ $cf_details_line }}</option>
                                <?php
                                $line_num++;
                                ?>
                            @endforeach
                        </select>
                    </div>
                </div>
            @elseif($customField->type ==6)
                {{--Select--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}</label>
                    <div class="col-sm-10">
                        <select name="{{'customField_'.$customField->id}}"
                                id="{{'customField_'.$customField->id}}"
                                class="form-control c-select" {{$cf_required}}>
                            <option value="">- - {!!  $cf_title !!} - -</option>
                            <?php
                            $cf_details_var = "details_" . trans('backLang.boxCode');
                            $cf_details_var2 = "details_en" . trans('backLang.boxCodeOther');
                            if ($customField->$cf_details_var != "") {
                                $cf_details = $customField->$cf_details_var;
                            } else {
                                $cf_details = $customField->$cf_details_var2;
                            }
                            $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                            $line_num = 1;
                            ?>
                            @foreach ($cf_details_lines as $cf_details_line)
                                <option value="{{ $line_num  }}" {{ ($cf_saved_val == $line_num) ? "selected='selected'":""  }}>{{ $cf_details_line }}</option>
                                <?php
                                $line_num++;
                                ?>
                            @endforeach
                        </select>
                    </div>
                </div>
            @elseif($customField->type ==5)
                {{--Date & Time--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}
                    </label>
                    <div class="col-sm-10">
                        <div>
                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
format: 'YYYY-MM-DD hh:mm A',
icons: {
time: 'fa fa-clock-o',
date: 'fa fa-calendar',
up: 'fa fa-chevron-up',
down: 'fa fa-chevron-down',
previous: 'fa fa-chevron-left',
next: 'fa fa-chevron-right',
today: 'fa fa-screenshot',
clear: 'fa fa-trash',
close: 'fa fa-remove'
}
}">
                                {!! Form::text('customField_'.$customField->id,$cf_saved_val, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                <span class="input-group-addon">
<span class="fa fa-calendar"></span>
</span>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($customField->type ==4)
                {{--Date--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}
                    </label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
format: 'YYYY-MM-DD',
icons: {
time: 'fa fa-clock-o',
date: 'fa fa-calendar',
up: 'fa fa-chevron-up',
down: 'fa fa-chevron-down',
previous: 'fa fa-chevron-left',
next: 'fa fa-chevron-right',
today: 'fa fa-screenshot',
clear: 'fa fa-trash',
close: 'fa fa-remove'
}
}">
                                {!! Form::text('customField_'.$customField->id,$cf_saved_val, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                <span class="input-group-addon">
<span class="fa fa-calendar"></span>
</span>
                            </div>
                        </div>

                    </div>
                </div>
            @elseif($customField->type ==3)
                {{--Email Address--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::email('customField_'.$customField->id,$cf_saved_val, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                    </div>
                </div>

            @elseif($customField->type ==2)
                {{--Number--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::number('customField_'.$customField->id,$cf_saved_val, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','min'=>0, 'dir'=>$cf_land_dir)) !!}
                    </div>
                </div>
            @elseif($customField->type ==1)
                {{--Text Area--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::textarea('customField_'.$customField->id,$cf_saved_val, array('placeholder' => '','class' => 'form-control',$cf_required=>'', 'dir'=>$cf_land_dir,'rows'=>'5')) !!}
                    </div>
                </div>
            @else
                {{--Text Box--}}
                <div class="form-group row">
                    <label for="{{'customField_'.$customField->id}}"
                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                        {!! $cf_land_identifier !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('customField_'.$customField->id,$cf_saved_val, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                    </div>
                </div>
            @endif
        @endif

    @endforeach
@endif
{{--End of -- Additional Feilds--}}
