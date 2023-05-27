<div class="col-sm">
    <div ui-view class="padding">
        <div>
            <div class="box">
                <div class="box-header dker">
                    <h3>{{ $edt_title }}</h3>
                    <small>
                        <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                        <a href="">{{ trans('backLang.settings') }}</a> /
                        <a href="">{{ trans('backLang.siteMenus') }}</a>

                    </small>
                </div>
                @if($CatMenus->total() >0)
                    <div class="row p-a">
                        <div class="col-sm-12">
                            <a class="btn btn-fw primary" href="{{route("CatmenusCreate",$edt_id)}}">
                                <i class="material-icons">&#xe02e;</i>
                                &nbsp; {{ trans('backLang.newLink') }}
                            </a>
                        </div>
                    </div>
                @endif
                @if($CatMenus->total() == 0)
                    <div class="row p-a">
                        <div class="col-sm-12">
                            <div class=" p-a text-center ">
                                {{ trans('backLang.noData') }}
                                <br>
                                @if(count($ParentMenus)>0)
                                    <br>
                                    <a class="btn btn-fw primary" href="{{route("CatmenusCreate",$edt_id)}}">
                                        <i class="material-icons">&#xe02e;</i>
                                        &nbsp; {{ trans('backLang.newLink') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if($CatMenus->total() > 0)
                    {{Form::open(['route'=>'CatmenusUpdateAll','id'=>'CatmenusUpdateAll','method'=>'post'])}}
                    {!! Form::hidden('ParentMenuId',$edt_id) !!}
                    <div class="table-responsive">
                        <table class="table table-striped  b-t">
                            <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="ui-check m-a-0">
                                        <input id="checkAll" type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>{{ trans('backLang.fullName') }}</th>
                                <th class="text-center" style="width:50px;">{{ trans('backLang.status') }}</th>
                                <th class="text-center"
                                    style="width:100px;">{{ trans('backLang.options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $title_var = "CatTitle_" . trans('backLang.boxCode');
                            $title_var2 = "CatTitle_" . trans('backLang.boxCodeOther');
                            ?>
                            @foreach($CatMenus as $Menu)
                                <?php
                                if ($Menu->$title_var != "") {
                                    $title = $Menu->$title_var;
                                } else {
                                    $title = $Menu->$title_var2;
                                }
                                ?>
                                <tr>
                                    <td><label class="ui-check m-a-0">
                                            <input type="checkbox" name="ids[]" value="{{ $Menu->Cat_id }}"><i
                                                    class="dark-white"></i>
                                            {!! Form::hidden('row_ids[]',$Menu->Cat_id, array('class' => 'form-control row_no')) !!}
                                        </label>
                                    </td>
                                    <td>
                                        {!! Form::text('row_no_'.$Menu->Cat_id,$Menu->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                        {!! $title  !!}</td>
                                    <td class="text-center">
                                        <i class="fa {{ ($Menu->CatStatus=='Active') ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm success"
                                           href="{{ route("CatmenusEdit",["ParentMenuId"=>$edt_id,"id"=>$Menu->Cat_id]) }}">
                                            <small><i class="material-icons">
                                                    &#xe3c9;</i> {{ trans('backLang.edit') }}
                                            </small>
                                        </a>

                                    </td>
                                </tr>
                                @foreach($Menu->CatsubMenus as $subMenu)
                                    <?php
                                    if ($subMenu->$title_var != "") {
                                        $title = $subMenu->$title_var;
                                    } else {
                                        $title = $subMenu->$title_var2;
                                    }
                                    ?>
                                    <tr>
                                        <td><label class="ui-check m-a-0">
                                                <input type="checkbox" name="ids[]" value="{{ $subMenu->Cat_id }}"><i
                                                        class="dark-white"></i>
                                                {!! Form::hidden('row_ids[]',$subMenu->Cat_id, array('class' => 'form-control row_no')) !!}
                                            </label>
                                        </td>
                                        <td>
                                            <img src="{{ secure_asset('plugins/backEnd/assets/images/treepart_'.trans('backLang.direction').'.png') }}" class="submenu_tree">
                                            {!! Form::text('row_no_'.$subMenu->Cat_id,$subMenu->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                            {!! $title  !!}</td>
                                        <td class="text-center">
                                            <i class="fa {{ ($subMenu->CatStatus=='Active') ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm success"
                                               href="{{ route("CatmenusEdit",["ParentMenuId"=>$edt_id,"id"=>$subMenu->Cat_id]) }}">
                                                <small><i class="material-icons">
                                                        &#xe3c9;</i> {{ trans('backLang.edit') }}
                                                </small>
                                            </a>

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
                                <small class="text-muted inline m-t-sm m-b-sm">{{ trans('backLang.showing') }} {{ $CatMenus->firstItem() }}
                                    -{{ $CatMenus->lastItem() }} {{ trans('backLang.of') }}
                                    <strong>{{ $CatMenus->total()  }}</strong> {{ trans('backLang.records') }}
                                </small>
                            </div>
                            <div class="col-sm-6 text-right text-center-xs">
                                {!! $CatMenus->links() !!}
                            </div>
                        </div>
                    </footer>
                    {{Form::close()}}


                @endif
            </div>
        </div>
    </div>
</div>
