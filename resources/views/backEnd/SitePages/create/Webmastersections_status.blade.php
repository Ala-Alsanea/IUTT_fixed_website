 @if($WebmasterSection->sections_status!=0)
                    <div class="form-group row">
                        <label for="section_id"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.hasCategories') !!} </label>
                        <div class="col-sm-10">
                              @if($WebmasterSection->id==3)
                      <select name="section_id[]" id="section_id" class="form-control select2-multiple"
                    multiple
                    ui-jp="select2"
                    ui-options="{theme: 'bootstrap'}" required> 
                  @else

                <select name="section_id[]" id="section_id" class="form-control select2-multiple"
                    
                    ui-jp="select2"
                    ui-options="{theme: 'bootstrap'}"> 
                    <option value="0"></option>


                  @endif  

                       
                                <?php
                                $title_var = "title_" . trans('backLang.boxCode');
                                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                $t_arrow = "&laquo;";
                                if (trans('backLang.direction') == "ltr") {
                                    $t_arrow = "&raquo;";
                                }
                                ?>
                                @foreach ($fatherSections as $fatherSection)
                                    <?php
                                    if ($fatherSection->$title_var != "") {
                                        $ftitle = $fatherSection->$title_var;
                                    } else {
                                        $ftitle = $fatherSection->$title_var2;
                                    }
                                    ?>
                                    <option value="{{ $fatherSection->id  }}">{{ $ftitle }}</option>
                                    @foreach ($fatherSection->fatherSections as $subFatherSection)
                                        <?php
                                        if ($subFatherSection->$title_var != "") {
                                            $title = $subFatherSection->$title_var;
                                        } else {
                                            $title = $subFatherSection->$title_var2;
                                        }
                                        ?>
                                        <option value="{{ $subFatherSection->id  }}">{{ $ftitle }} {{$t_arrow}} {{ $title }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    {!! Form::hidden('section_id','0') !!}
                @endif