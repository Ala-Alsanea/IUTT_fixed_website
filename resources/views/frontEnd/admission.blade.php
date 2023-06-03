
@extends('frontEnd.layout')

@section('content')
<?php 
                    $section_url = "";
         $backgroundImage="uploads/banar.jpg";
         $backgroundImage= Helper::getBannerStatic('admissionsgenral');   

?>
    
 
<div class="page-title head-1" id="adhead1" style="background-image: url({{ Helper::FilterImage($backgroundImage) }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ trans('frontLang.Apply_Now') }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                 @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                  
                                  <li class="active">{{ trans('frontLang.Apply_Now') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--SECTION START-->
  <section class="c-all h-quote">
        <div class="container">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="all-title quote-title qu-new">
                    
                    
                    
                    <p class="help-line" style="
    /* color: #8d969e; */
    padding-top: 25%;
    font-size: 58px;
"><span style="
    font-size: 68px;
">{{ trans('frontLang.Apply_Now') }}</span> </p> <span class="help-arrow pulse"><i class="fa fa-angle-right" aria-hidden="true"></i></span> </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="n-form-com admiss-form">
                    {{Form::open(['route'=>['contactPage'],'method'=>'POST','class'=>'contactForm','id'=>'contactForm'])}}
                    <div class="col s12">
                      
                            <div class="form-group row">
                                <label class="control-label col-sm-3">{{ trans('frontLang.yourName') }}:</label>
                                <div class="col-sm-9">
                                   {!! Form::text('contact_name',"", array('placeholder' => trans('frontLang.yourName'),'id'=>'name', 'data-msg'=> trans('frontLang.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                      <div class="alert alert-warning validation"></div>

                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3">{{ trans('frontLang.phone') }}:</label>
                                <div class="col-sm-9">
                                     {!! Form::text('contact_phone',"", array('class' => 'form-control','id'=>'phone', 'data-msg'=> trans('frontLang.enterYourPhone'),'data-rule'=>'minlen:4')) !!}
                        <div class="validation"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3">{{ trans('frontLang.email') }}:</label>
                                <div class="col-sm-9">
                                  {!! Form::email('contact_email',"", array('class' => 'form-control','id'=>'email', 'data-msg'=> trans('frontLang.enterYourEmail'),'data-rule'=>'email')) !!}
                        <div class="validation"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3">{{ trans('frontLang.city') }}</label>
                                <div class="col-sm-9">
                                   
                                 
                                      {!! Form::text('city',"", array('placeholder' => trans('frontLang.city'),'id'=>'name', 'data-msg'=> trans('frontLang.city'),'data-rule'=>'minlen:4')) !!}
                        <div class="validation"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3">{{ trans('frontLang.Educational_system') }}:</label>
                                <div class="col-sm-9">
                                   {!! Form::text('education',"", array('placeholder' => trans('frontLang.Educational_system'),'id'=>'name', 'data-msg'=> trans('frontLang.Educational_system'),'data-rule'=>'minlen:4')) !!}
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3">{{ trans('frontLang.course') }}:</label>
                                <div class="col-sm-9">
                                  
                                <select class="initialized">
                                <option>-- Select course --</option>
                                <option>Aerospace Engineering</option>
                                <option>Agriculture Courses</option>   
                                <option>Marine Engineering</option>
                                <option>Building, Construction Management</option>
                                <option>Web Development</option>
                                <option>Accountant course</option>
                                <option>Dot Net Development</option>
                                <option>Java Development</option>
                                <option>Chemical Engineering</option>
                              </select></div>
                                </div>
                            </div>
                            <div class="form-group mar-bot-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <i class="waves-effect waves-light light-btn waves-input-wrapper" style="">
  <i class="waves-effect waves-light light-btn waves-input-wrapper" style=""><input type="submit" value="{{ trans('frontLang.submit') }}" class="waves-button-input"></i>
                                        
 
                                      </i>
                                </div>
                            </div>
                       {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION END-->


 @endsection
     @include('frontEnd.includes.scriptsubmit')  
@endsection
   
  

