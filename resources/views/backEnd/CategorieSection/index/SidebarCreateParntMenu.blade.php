<div class="col-sm ww-md w-auto-xs light lt bg-auto  hidden-print">
    <div class="padding pos-rlt">
        <div>
            <div class="nav-active-white">
                <ul class="nav nav-pills nav-stacked nav-sm b-b">
                    <li class="nav-item">
                        <ul class="list p-b-1" style="list-style: none;">
                            <?php
                            $title_var = "CatTitle_" . trans('backLang.boxCode');
                            $title_var2 = "CatTitle_" . trans('backLang.boxCodeOther');
                            ?>
                            @foreach($ParentMenus as $ParentMenu)
                                <?php
                                if ($ParentMenu->$title_var != "") {
                                    $title = $ParentMenu->$title_var;
                                } else {
                                    $title = $ParentMenu->$title_var2;
                                }
                                ?>
                                <?php
                                if ($ParentMenu->Cat_id == $edt_id) {
                                    $edt_title = $title;
                                }
                                ?>
                                <li style="margin-bottom: 5px"
                                    onmouseover="document.getElementById('grpRow{{ $ParentMenu->Cat_id }}').style.display='block'"
                                    onmouseout="document.getElementById('grpRow{{ $ParentMenu->Cat_id }}').style.display='none'">
                                    <a href="{{ route("Catmenus",["ParentMenuId"=>$ParentMenu->Cat_id]) }}"
                                            {!!   ($ParentMenu->Cat_id == $edt_id) ? " style='font-weight: bold;color:#0cc2aa'":""  !!} >
                                        {!! $title !!}
                                    </a>

                                    <div id="grpRow{{ $ParentMenu->Cat_id }}"
                                         style="display: none"
                                         class="pull-right">
                                        <a class="btn btn-sm success p-a-0 m-a-0"
                                           title="{{ trans('backLang.edit') }}"
                                           href="{{ route("parentCatMenusEdit",["id"=>$ParentMenu->Cat_id]) }}">
                                            <small>&nbsp;<i class="material-icons">&#xe3c9;</i>&nbsp;
                                            </small>
                                        </a>

                                        <button class="btn btn-sm warning p-a-0 m-a-0"
                                                data-toggle="modal"
                                                data-target="#mg-{{ $ParentMenu->Cat_id }}"
                                                ui-toggle-class="bounce"
                                                title="{{ trans('backLang.delete') }}"
                                                ui-target="#animate">
                                            <small>&nbsp;<i class="material-icons">&#xe872;</i>&nbsp;
                                            </small>
                                        </button>


                                    </div>

                                </li>

                            @endforeach

                        </ul>
                    </li>
                </ul>
                <div class="p-y">
                    @if(Session::has('EditCatMenu'))
                        {{Form::open(['route'=>['parentCatMenusUpdate',"id"=>$EditedMenu->Cat_id,"ParentMenuId"=>"0"],'method'=>'POST'])}}
                        <div class="input-group input-group-sm">
                            @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        {!! Form::text('CatTitle_ar',$EditedMenu->CatTitle_ar, array('placeholder' => trans('backLang.menuTitle').strip_tags(trans('backLang.arabicBox')),'class' => 'form-control','id'=>'CatTitle_ar','required'=>'')) !!}
                                    </div>
                                </div>
                            @endif
                            @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        {!! Form::text('CatTitle_en',$EditedMenu->CatTitle_en, array('placeholder' => trans('backLang.menuTitle').strip_tags(trans('backLang.englishBox')),'class' => 'form-control','id'=>'CatTitle_en','required'=>'')) !!}
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-sm-12">
                                <span class="input-group-btn">
            <button class="btn btn-fw primary" type="submit">{!! trans('backLang.save') !!}</button>
          </span>
                                </div>
                            </div>
                        </div>
                        {{Form::close()}}
                    @else
                        {{Form::open(['route'=>['parentCatMenusStore',$edt_id],'method'=>'POST'])}}
                        <div class="input-group input-group-sm">
                            {!! trans('backLang.newMenu') !!} :
                            @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        {!! Form::text('CatTitle_ar','', array('placeholder' => trans('backLang.menuTitle').strip_tags(trans('backLang.arabicBox')),'class' => 'form-control','id'=>'CatTitle_ar','required'=>'')) !!}
                                    </div>
                                </div>
                            @endif
                            @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        {!! Form::text('CatTitle_en','', array('placeholder' => trans('backLang.menuTitle').strip_tags(trans('backLang.englishBox')),'class' => 'form-control','id'=>'CatTitle_en','required'=>'')) !!}
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-sm-12">
                                <span class="input-group-btn">
            <button class="btn btn-sm primary" type="submit">{!! trans('backLang.add') !!}</button>
          </span>
                                </div>
                            </div>
                        </div>
                        {{Form::close()}}
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>