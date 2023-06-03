@extends('backEnd.layout')

@section('content')

<style type="text/css">
    .contentPrivligebox .checkbox{
        display:inline-block; 
    }
  .contentPrivligebox .checkbox  .light {
    background-color: #f0f0f0;
        border: 1px solid #c7c2c2;
}
.contentPrivligebox .checkbox .ui-check input:checked + i:before {
    left: 5px;
    top: 5px;
    width: 6px;
    height: 6px;
    background-color: #000000;
}
.contentPrivligebox .checkbox .material-icons.delete{
       color: #f44455;

}
.contentPrivligebox .checkbox .material-icons.edit{
       color: #6cc788;
       
}
.contentPrivligebox .checkbox .material-icons.add{
       color: #6887ff;
       
}
</style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe03b;</i> {{ trans('backLang.newPermissions') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">{{ trans('backLang.settings') }}</a> /
                    <a href="">{{ trans('backLang.usersPermissions') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("users")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body FormPermission">
 
                {{Form::open(['route'=>['Store'],'method'=>'POST'])}}


                       
                <div class="form-group row">
                    <label for="name"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.title') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('name','', array('placeholder' => '','class' => 'form-control','id'=>'name','required'=>'')) !!}
                    </div>
                </div>

 
               <div class="form-group row">
                    <label for="permissions1"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.dataManagements') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('view_status','1',true, array('id' => 'view_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.dataManagements1') }}
                            </label>
                            <br>
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('view_status','0',false, array('id' => 'view_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.dataManagements2') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="analytics_status"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.activeApps') !!}
                    </label>
                    <div class="col-sm-10">
                  @if(Helper::GeneralWebmasterSettings("analytics_status"))

                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('analytics_status','1',false, array('id' => 'analytics_status')) !!}
                                <i class="dark-white"></i><label
                                        for="analytics_status">{{ trans('backLang.visitorsAnalytics') }}</label>
                            </label>
                        </div>

                        @endif

                      @if(Helper::GeneralWebmasterSettings("newsletter_status"))
                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('newsletter_status','1',false, array('id' => 'newsletter_status')) !!}
                                <i class="dark-white"></i><label
                                        for="newsletter_status">{{ trans('backLang.newsletter') }}</label>
                            </label>
                        </div>
                           @endif
                 @if(Helper::GeneralWebmasterSettings("inbox_status"))


                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('inbox_status','1',false, array('id' => 'inbox_status')) !!}
                                <i class="dark-white"></i><label
                                        for="inbox_status">{{ trans('backLang.siteInbox') }}</label>
                            </label>
                        </div>
                        @endif
                     @if(Helper::GeneralWebmasterSettings("calendar_status"))

                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('calendar_status','1',false, array('id' => 'calendar_status')) !!}
                                <i class="dark-white"></i><label
                                        for="calendar_status">{{ trans('backLang.calendar') }}</label>
                            </label>
                        </div>
                      @endif
                     @if(Helper::GeneralWebmasterSettings("banners_status"))

                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('banners_status','1',false, array('id' => 'banners_status')) !!}
                                <i class="dark-white"></i><label
                                        for="banners_status">{{ trans('backLang.adsBanners') }}</label>
                            </label>
                        </div>
                        @endif
                    @if(Helper::GeneralWebmasterSettings("settings_status"))
                   

                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('settings_status','1',false, array('id' => 'settings_status')) !!}
                                <i class="dark-white"></i><label
                                        for="settings_status">{{ trans('backLang.generalSettings') }}</label>
                            </label>
                        </div>
                        @endif


                        <div class="checkbox">
                            <label class="ui-check">
                                {!! Form::checkbox('webmaster_status','1',false, array('id' => 'webmaster_status')) !!}
                                <i class="dark-white"></i><label
                                        for="webmaster_status">{{ trans('backLang.webmasterTools') }}</label>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                  
                        <?php
                        $Permission_id=0;
                         $Page_id=0;
//permissions_page
                       //  
                         $MenutTitles=Helper::ParentMenuBackend(0,0);
                          $CatTitle = "CatTitle_" . trans('backLang.boxCode');
                        ?>

                @if(count($MenutTitles)>0)
                     @foreach($MenutTitles as $MenutTitle)

                       <label for="analytics_status"
                           class="col-sm-2 form-control-label">{{ $MenutTitle->$CatTitle }}
                    </label>
                    <div class="col-sm-10">

                        
                <?php

                  $Father_id=$MenutTitle->Cat_id;

                   $MainMenus=Helper::MenuSectionSite($Father_id);
              

                ?>
                         

                   @if(count($MainMenus)>0)
                     @foreach ($MainMenus as   $MainMenu)
                      
                   <div class="form-group row">
                      <?php 

                         $Father_idSub=$MainMenu->Cat_id;
                         $Page_id=$MainMenu->Cat_id;

                          $SubMenus=Helper::MenuSectionSite($Father_idSub);
                            $PageDetail= App\Models\PermissionsPage::where('Permission_id',$Permission_id)->where('Page_id',$Page_id)->where('PermissionStatus','Active')->orderby('Id', 'asc')->get();
                   ?>
                  
              @if(count($SubMenus)==0)
                  <div class="col-sm-4">
                     <div class="checkbox">
                            <label class="ui-check">
                               @if($MainMenu->CatType==2)
                                 <input type="hidden" name="data_sections[]" value="{{ $MainMenu->Subcat_id }}">
                                 @endif
                                 
                                {!! Form::checkbox('MenuSection[]',$MainMenu->Cat_id,false, array('id' =>'MenuSection'.$MainMenu->Cat_id)) !!}
                                <i class="dark"></i><label
                                        for="MenuSection{{ $MainMenu->Cat_id }}">{{ $MainMenu->$CatTitle }}</label>
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-6">

                         @include('backEnd.Permissions.Parts.PermissionsPart')
                    </div>

                    
                   @else
                   <div class="col-sm-2">
                      <label for="analytics_status"
                           class="form-control-label">{{ $MainMenu->$CatTitle }}
                    </label>
                   </div>

                @endif

            
                   


             
                    @if(count($SubMenus)>0) 
                 <div class="col-sm-10">
                     @foreach($SubMenus as $SubMenu)

                <div class="row">
                     <div class="col-sm-4"> 
                        <div class="checkbox">
                            <label class="ui-check">
                                  @if($SubMenu->CatType==2)
                                 <input type="hidden" name="data_sections[]" value="{{ $SubMenu->Subcat_id }}">
                                 @endif
                                {!! Form::checkbox('MenuSection[]',$SubMenu->Cat_id,false, array('id' =>'MenuSection'.$SubMenu->Cat_id)) !!}
                                <i class="dark"></i><label
                                        for="MenuSection{{ $SubMenu->Cat_id }}">{{ $SubMenu->$CatTitle }}</label>
                            </label>
                        </div>
                    </div>
                         <div class="col-sm-8">
                            <?php  
                             $Page_id=$SubMenu->Cat_id;

                            ?>
                            @include('backEnd.Permissions.Parts.PermissionsPart')
                       </div>
                   </div>
                          @endforeach 


                      </div> 
                      @endif
                       
                     {{--  end   $SubMenus --}}

                        
                          
                     </div>
                         @endforeach  

                     <hr>
                      @endif
                      </div>
                    

                      @endforeach  


                      @endif 
                      
                    

 

                    
                </div>
               
              

 
               
           

                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                        <a href="{{route("Permissions")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection
