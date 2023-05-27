<div class="col-sm">
    <div ui-view class="padding">
        <div>
            <div class="box">
                <div class="box-header dker">
                    <h3>{{ trans('backLang.permissions') }}</h3>
                    <small>
                        <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                        <a href="">{{ trans('backLang.settings') }}</a> /
                        <a href="">{{ trans('backLang.siteMenus') }}</a>

                    </small>
                </div>
                @if(count($Permissions) >0)
                    <div class="row p-a pull-right" style="margin-top: -70px;">
                        <div class="col-sm-12">
                            <a class="btn btn-fw danger" href="{{route("Create")}}">
                                <i class="material-icons">&#xe03b;</i>
                                &nbsp; {{ trans('backLang.newPermissions') }}
                            </a>
                        </div>
                    </div>
                @endif
                @if(count($Permissions)  == 0)
                    <div class="row p-a">
                        <div class="col-sm-12">
                            <div class=" p-a text-center ">
                                {{ trans('backLang.noData') }}
                                <br>
                                <br>
                                <a class="btn btn-fw primary" href="{{route("Create")}}">
                                    <i class="material-icons">&#xe03b;</i>
                                    &nbsp; {{ trans('backLang.newPermissions') }}
                                </a>

                            </div>
                        </div>
                    </div>
                @endif

               @if(count($Permissions) > 0)
                {{Form::open(['route'=>'PrimationUpdateAll','id'=>'PrimationUpdateAll','method'=>'post'])}}
                    {!! Form::hidden('id',0) !!}
                    <div class="table-responsive">
                
                    <div class="table-responsive">
                        <table class="table table-striped  zero-configuration b-t">
                            <thead>
                              <tr>
                                 <th style="width:20px;">
                                    <label class="ui-check m-a-0">
                                        <input id="checkAll" type="checkbox"><i></i>
                                    </label>
                                 </th>
                                    <th>{{ trans('backLang.title') }}</th>
                                    <th>{{ trans('backLang.permissions') }}</th>
                                    <th class="text-center" style="width:50px;">{{ trans('backLang.status') }}</th>
                                    <th class="text-center" style="width:200px;">{{ trans('backLang.options') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                         $CatTitle = "CatTitle_" . trans('backLang.boxCode');
                         $title_var2 = "CatTitle_" . trans('backLang.boxCodeOther');
                            ?>
                             @foreach($Permissions as $Permission)
                              
                                <tr>
                                    <td><label class="ui-check m-a-0">
                                            <input type="checkbox" name="ids[]" value="{{ $Permission->id }}"><i
                                                    class="dark-white"></i>
                                            {!! Form::hidden('Permission[]',$Permission->id, array('class' => 'form-control row_no')) !!}
                                        </label>
                                 </td>
                                 <td>
                                         
                                        {!! $Permission->name  !!}</td>

                                        <td></td>
                                     
                                      <td class="text-center">
                                        <i class="fa {{ ($Permission->status=='1') ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    </td>

                                    <td class="text-center">
                                        <a class="btn btn-sm success"
                                           href="{{ route("Edit",["id"=>$Permission->id]) }}">
                                            <small><i class="material-icons">
                                                    &#xe3c9;</i> {{ trans('backLang.edit') }}
                                            </small>
                                        </a>

                                    </td>

                                   
                                </tr>
                                <?php 
                                 $Permission_id=$Permission->id;
                              
                                   $PagesSections = App\Models\PermissionsPage::where('Permission_id',$Permission_id)->where('PermissionStatus','Active')->orderby('Id', 'asc')->get();

                                ?>
                                @foreach($PagesSections as $Page)
                                    <?php

                                      $Page_id=$Page->Page_id;
                                   $Sections= App\Models\CategorieSection::find($Page_id);


                                    ?>
                                    <tr class="">
                                         <td><label class="ui-check m-a-0">
                                            <input type="checkbox" name="PagesListId[]" value="{{ $Page->Id }}"><i
                                                    class="dark-white"></i>
                                            {!! Form::hidden('PagesList[]',$Page->Id, array('class' => 'form-control row_no')) !!}
                                        </label>
                                        </td>
                                          <td>
                                            <img src="{{ URL::to('plugins/backEnd/assets/images/treepart_'.trans('backLang.direction').'.png') }}" class="submenu_tree">
                                             
                                            {!! $Sections->$CatTitle  !!}</td>

                                         
                                        <td class="text-center">
                                             <small>
                                    <small>
                                        @if($Page->AddStatus==1)
                                            <i class="fa fa-check text-success inline"></i> {{ trans('backLang.perAdd') }}
                                            &nbsp;
                                        @endif
                                        @if($Page->EditStatus==1)
                                            <i class="fa fa-check text-success inline"></i> {{ trans('backLang.perEdit') }}
                                            &nbsp;
                                        @endif
                                        @if($Page->DeleteStatus==1)
                                            <i class="fa fa-check text-success inline"></i> {{ trans('backLang.perDelete') }}
                                            &nbsp;
                                        @endif

                                        @if($Page->AddStatus==0 && $Page->EditStatus==0 && $Page->DeleteStatus==0)
                                            {{ trans('backLang.viewOnly') }}
                                            &nbsp;
                                        @endif
                                    </small>
                                </small>

                                        </td>
                                         <td class="text-center">
                                            <i class="fa {{ ($Page->PermissionStatus=='Active') ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                        </td>
                                        <td class="text-center">
                                           

                                        </td>
                                    </tr>
                                @endforeach

                            @endforeach

                            </tbody>
                        </table>

                    </div>
                    <footer class="dker p-a">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">

                                <select name="action" id="action"
                                        class="input-sm form-control w-sm inline v-middle"
                                        required>
                                    <option value="">{{ trans('backLang.bulkAction') }}</option>
                                    <option value="order">{{ trans('backLang.saveOrder') }}</option>
                                    <option value="activate">{{ trans('backLang.activeSelected') }}</option>
                                    <option value="block">{{ trans('backLang.blockSelected') }}</option>
                                    <option value="delete">{{ trans('backLang.deleteSelected') }}</option>
                                    <option value="deletePrimiton">حذف   صلاحية مجموعة</option>
                                </select>
                                <button type="submit" id="submit_all"
                                        class="btn btn-sm white">{{ trans('backLang.apply') }}</button>
                                <button id="submit_show_msg" class="btn btn-sm white" data-toggle="modal"
                                        style="display: none"
                                        data-target="#m-all" ui-toggle-class="bounce"
                                        ui-target="#animate">{{ trans('backLang.apply') }}
                                </button>
                            </div>

                            <div class="col-sm-3 text-center">
                                <small class="text-muted inline m-t-sm m-b-sm">{{ trans('backLang.showing') }} {{ $Permissions->firstItem() }}
                                    -{{ $Permissions->lastItem() }} {{ trans('backLang.of') }}
                                    <strong>{{ $Permissions->total()  }}</strong> {{ trans('backLang.records') }}
                                </small>
                            </div>
                            <div class="col-sm-6 text-right text-center-xs">
                                {!! $Permissions->links() !!}
                            </div>
                        </div>
                    </footer>
                   
                         {{Form::close()}}
                  
                @endif
            </div>
        </div>
    </div>
</div>