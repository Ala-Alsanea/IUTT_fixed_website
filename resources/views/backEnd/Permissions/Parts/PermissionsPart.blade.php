                   
                   <?php  
                     $AddStatus=0;
                      $EditStatus=0;
                      $DeleteStatus=0;
                     $PermissionsPageId=0;

                     
                     if (count($PageDetail)>0) {
                          $PermissionsPageId=$PageDetail[0]->Id;
                          $AddStatus=$PageDetail[0]->AddStatus;
                         
                          $EditStatus=$PageDetail[0]->EditStatus;
                         $DeleteStatus=$PageDetail[0]->DeleteStatus;
                     }
                     

                   ?>
                    <div class="contentPrivligebox">
                               {!! Form::hidden('PermissionsPageId[]',$PermissionsPageId) !!}
                         {!! Form::hidden('Pages_id[]',$Page_id) !!}
                              <div class="checkbox">
                                    <label class="ui-check">
                                         
                                        {!! Form::checkbox('AddStatus[]',$Page_id,($AddStatus==1) ? true : false, array('id' =>'AddStatus'.$Page_id)) !!}
                                        <i class="light"></i><label
                                                for="AddStatus"><i class="material-icons add">&#xe03b;</i></label>
                                    </label>
                                </div>
                             
                              <div class="checkbox">
                                    <label class="ui-check">
                                         
                                        {!! Form::checkbox('EditStatus[]',$Page_id,($EditStatus==1) ? true : false, array('id' =>'EditStatus'.$Page_id)) !!}
                                        <i class="light"></i><label
                                                for="EditStatus{{ $Page_id }}"><i class="material-icons edit">&#xe3c9;</i> </label>
                                    </label>
                                </div>
                           
                              <div class="checkbox">
                                    <label class="ui-check">
                                         
                                        {!! Form::checkbox('DeleteStatus[]',$Page_id,($DeleteStatus==1) ? true : false, array('id' =>'DeleteStatus'.$Page_id)) !!}
                                        <i class="light"></i><label
                                                for="DeleteStatus{{ $Page_id }}"><i class="material-icons  delete">&#xe872;</i>  </label>
                                    </label>
                            </div>
                        </div>
                          