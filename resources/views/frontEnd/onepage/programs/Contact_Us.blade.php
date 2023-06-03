<style type="text/css"
>
  label ,.label{
    /* font-size: 13px; */
    color: #2d2d33;
    font-weight: 400 !important;
    line-height: 24px;
    /* border: 1px solid #ccc; */
}
</style>
      <div class="main-detail main-detail-5"     style="display: none;">
    
              <div class="printable-version" style="background-color: #fff; padding: 10px;">
                      <div class="contact-us row">

                 
                       
                        
                        <div class="col-md-12 col-sm-12 col-xs-12 new-con new-con1 text-center">
                         
                          

                                  @if(Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) !="")
                            <address>
                                <i class="fa fa-map-marker"></i>
                                <h4>{{ trans('frontLang.address') }}:</h4> 
                                {{ Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) }}
                            </address>
                        @endif
                        </div>
                        
                        <div class="col-md-6 col-sm-6 col-xs-12 new-con new-con3">  
                           <br>
                               @if(Helper::GeneralSiteSettings("contact_t3") !="")
                            <p>
                                <i class="fa fa-phone"></i>
                                <strong>{{ trans('frontLang.callPhone') }}:</strong> 
                                <span
                                        dir="ltr"><a href="tel:{{ Helper::GeneralSiteSettings("contact_t3") }}">{{ Helper::GeneralSiteSettings("contact_t3") }} </a></span>
                            </p>
                        @endif

                        @if(Helper::GeneralSiteSettings("contact_t5") !="")
                            <p>
                                <i class="fa fa-phone"></i>
                                <strong>{{ trans('frontLang.callMobile') }}:</strong> 
                                <span
                                        dir="ltr"><a href="tel:{{ Helper::GeneralSiteSettings("contact_t5") }}">{{ Helper::GeneralSiteSettings("contact_t5") }}</a> </span>
                            </p>
                        @endif
                   
                            
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 new-con new-con4">  
                              <br>

                          @if(Helper::GeneralSiteSettings("contact_t4") !="")
                            <p>
                                <i class="fa fa-fax"></i>
                                <strong>{{ trans('frontLang.callFax') }}:</strong> 
                                <span
                                        dir="ltr">  <a href="tel:{{ Helper::GeneralSiteSettings("contact_t4") }}">{{ Helper::GeneralSiteSettings("contact_t4") }}</a></span>
                            </p>
                        @endif
                        @if(Helper::GeneralSiteSettings("contact_t6") !="")
                            <p>
                                <i class="fa fa-envelope"></i>
                                <strong>{{ trans('frontLang.email') }}:</strong>
                               <a href="mailto: {{ Helper::GeneralSiteSettings("contact_t6") }}">  {{ Helper::GeneralSiteSettings("contact_t6") }}</a>
                            </p>
                        @endif
                       
                                
                        </div>



                <div class="col-md-6 col-sm-6 col-xs-12 new-con new-con3"> 
                         

                        @if($FacultyData->phone !="")
                            <p>
                                <i class="fa fa-phone"></i>
                                <strong>{{  trans('frontLang.callPhone') }}:</strong> 
                                <span
                                        dir="ltr"><a href="tel:{{ $FacultyData->phone }}">{{ $FacultyData->phone }}</a></span>
                            </p>
                        @endif
                   
                            
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 new-con new-con4"> <img src="img/contact/3.png" alt="">
                              <br>
                          @if($FacultyData->fax !="")
                            <p>
                                <i class="fa fa-fax"></i>
                                <strong>{{ trans('frontLang.callFax') }}:</strong> 
                                <span
                                        dir="ltr"><a href="tel:{{ $FacultyData->fax }}">{{ $FacultyData->fax }} </a></span>
                            </p>
                        @endif
                        @if($FacultyData->email !="")
                            <p>
                                <i class="fa fa-envelope"></i>
                                <strong>{{ trans('frontLang.email') }}:</strong>
                                <a href="mailto:{{ $FacultyData->email }}">{{ $FacultyData->email }}</a>
                            </p>
                        @endif
                       
                                
                        </div>


 
            </div>
<br>
            <hr>
            <br>

                        <!---------------------------------------------------------------------------------------------->
   {{Form::open(['route'=>['contactPage'],'method'=>'POST','class'=>'contactForm row'])}}
                         
                        <div class="col-md-6">
                            <div class="form-group">
                                 <label class="label" for="name">{{ trans('frontLang.yourName') }}</label>
                                {!! Form::text('contact_name',"", array('class'=>'name','class'=>'form-control', 'data-msg'=> trans('frontLang.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                      <div class="alert alert-warning validation"></div>

                                
                                
                              </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                 <label class="label" for="email">{{ trans('frontLang.email') }}</label>
                                   {!! Form::email('contact_email',"", array('class' => 'form-control','id'=>'email', 'data-msg'=> trans('frontLang.enterYourEmail'),'data-rule'=>'email')) !!}
                        <div class="validation"></div>
                                
                                
                              </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                 <label class="label" for="contact_subject"> {{ trans('frontLang.address') }}</label>
  {!! Form::text('contact_subject',"", array('class' => 'form-control','id'=>'subject', 'data-msg'=> trans('frontLang.address'))) !!}
                            
                                
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label class="label" for="contact_phone"> {{ trans('frontLang.phone') }}</label>
                                     {!! Form::text('contact_phone',"", array('class' => 'form-control','id'=>'phone', 'data-msg'=> trans('frontLang.enterYourPhone'),'data-rule'=>'minlen:4')) !!}
                        <div class="validation"></div>
                                  
                                 
                              </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                 <label class="label" for="contact_message"> {{ trans('frontLang.message') }}</label>
                                {!! Form::textarea('contact_message','', array('class' => 'form-control','id'=>'message','rows'=>'8', 'data-msg'=> trans('frontLang.enterYourMessage'),'data-rule'=>'required')) !!}
                                 
                                
                                
                              </div>
                            </div>
                              <div class="col-lg-12 text-center">

                                 <button type="submit" class="submit-btn btn btn-primary">{{ trans('frontLang.submit') }}</button>
                                 
                              </div>
                                  {{Form::close()}}
                                         
            
                        </div>




        </div>

 