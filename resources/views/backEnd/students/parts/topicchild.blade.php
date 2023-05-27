     <?php
                        $title_var = "title_" . trans('backLang.boxCode');
                        $title_var2 = "title_" . trans('backLang.boxCodeOther');
                       // dd($Topic->Childtopic);

            $Childtopics=App\Models\Topic::where([['status', 1], ['refrence_id',$Topic->id]])->orderby('row_no', 'asc')->get();
          $title_var = "title_" . trans('backLang.boxCode');

                        ?>
                      @if(count((array)$Childtopics)>0)  
   @foreach($Childtopics as $subTopic)
                            <?php
                            if ($subTopic->$title_var != "") {
                                $title = $subTopic->$title_var;
                            } else {
                                $title = $subTopic->$title_var2;
                            }
                            // Get Categories list
                            $section = "";
                            $sectionSt = "";
                            if ($WebmasterSection->sections_status != 0) {
                                foreach ($subTopic->categories as $category) {
                                    try {
                                        if ($category->section->$title_var != "") {
                                            $cat_title = $category->section->$title_var;
                                        } else {
                                            $cat_title = $category->section->$title_var2;
                                        }
                                        $section .= $cat_title . ", ";

                                    } catch (Exception $e) {

                                    }

                                }
                                if ($section == "") {
                                    $sectionSt = "<span style='color: orangered'><i>" . trans('backLang.topicDeletedSection') . "</i></span>";
                                } else {
                                    $section = rtrim($section, ", ");
                                }
                            }
                          $refrencetopiccontent="";
                             if ($subTopic->refrence_id != 0) {
                                
                                 $refrencetopiccontent = "<span style='color:blue'>".$subTopic->refrencetopic->$title_var ."</span>";

                                }
                                  $facultyopiccontent = "";
                                  
                             if ($subTopic->father_id != 0) {
                                   $facultyopiccontent = "<span style='color: green'><i>" . trans('backLang.faculty') . "</i>:".$subTopic->father->$title_var."</span>";
                              

                                }

                             
                               
                            


                            ?>
                            <tr>
                                <td><label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]" value="{{ $subTopic->id }}"><i
                                                class="dark-white"></i>
                                        {!! Form::hidden('row_ids[]',$subTopic->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
                              
                        
                                <td>
                                    @if($subTopic->photo_file !="" && $subTopic->photo_file !="#")
                                        <div class="pull-right">
                                            <img src="{{ Helper::FilterImage($subTopic->photo_file) }}"
                                                 style="height: 40px" alt="{{ $title }}">
                                        </div>
                                    @endif

                                    <img src="{{ URL::to('plugins/backEnd/assets/images/treepart_'.trans('backLang.direction').'.png') }}" class="submenu_tree">
                                    {!! Form::text('row_no_'.$subTopic->id,$subTopic->row_no, array('class' => 'pull-left form-control row_no','id'=>'row_no')) !!}

                                    @if($subTopic->icon !="")
                                        <i class="fa {!! $subTopic->icon !!} "></i>
                                    @endif
                                    {{ $title }}
                                    <div>
                                          <small>
                                             {!! $facultyopiccontent !!}
                                        </small>
                                       
                                        <small>
                                            {{ $section }} {!! $sectionSt !!} {!! $refrencetopiccontent !!}
                                        </small>
                                         
                                        
                                    </div>
                                </td>
                                @if($WebmasterSection->date_status)
                                    <td class="text-center">
                                        <small>{!! $subTopic->date  !!}</small>
                                    </td>
                                @endif
                                @if($WebmasterSection->expire_date_status)
                                    <td class="text-center">
                                        <small {!! ($subTopic->expire_date < date("Y-m-d"))? "style='color:red'":"" !!}>{!! $subTopic->expire_date  !!}</small>
                                    </td>
                                @endif
                                
                                <td class="text-center">
                                    {!! $subTopic->visits !!}
                                     
                                </td>
                            
                                <td class="text-center">
                                    <i class="fa {{ ($subTopic->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                </td>
                                <td class="text-center">
                                    @if(@Auth::user()->permissionsGroup->edit_status)
                                        <a class="btn btn-sm success"
                                           href="{{ route("topicsEdit",["webmasterId"=>$WebmasterSection->id,"id"=>$subTopic->id]) }}">
                                            <small><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.edit') }}
                                            </small>
                                        </a>
                                    @endif
                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                        <button class="btn btn-sm warning" data-toggle="modal"
                                                data-target="#m-{{ $subTopic->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small><i class="material-icons">&#xe872;</i> {{ trans('backLang.delete') }}
                                            </small>
                                        </button>
                                    @endif

                                </td>
                            </tr>
                            <!-- .modal -->
                            <div id="m-{{ $subTopic->id }}" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ trans('backLang.confirmationDeleteMsg') }}
                                                <br>
                                                <strong>[ {{ $title }} ]</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                            <a href="{{ route("topicsDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$subTopic->id]) }}"
                                               class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->

                        @endforeach
                      @endif   