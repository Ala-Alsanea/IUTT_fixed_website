 

    <style>

.get-in-touch {
  max-width: 800px;
  margin: 50px auto;
  position: relative;

}
.get-in-touch .title {
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 3px;
  font-size: 3.2em;
  line-height: 48px;
  padding-bottom: 48px;
     color: #005fae;
    background: #005fae;
    background: -moz-linear-gradient(left,#f4524d  0%,#005fae 100%) !important;
    background: -webkit-linear-gradient(left,#f4524d  0%,#005fae 100%) !important;
    background: linear-gradient(to right,#f4524d  0%,#005fae  100%) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
}

.contact-form .form-field {
  position: relative;
  margin: 32px 0;
}
.contact-form .input-text {
  display: block;
  width: 100%;
  height: 36px;
  border-width: 0 0 1px 0;
  border-color: #005fae;
  font-size: 18px;
  line-height: 26px;
  font-weight: 400;
}
.contact-form .input-text:focus {
  outline: none;
}
.contact-form .input-text:focus + .label,
.contact-form .input-text.not-empty + .label {
  -webkit-transform: translateY(-24px);
          transform: translateY(-24px);
}
.contact-form .label {
  position: absolute;
  left: 20px;
  bottom: 11px;
  font-size: 18px;
  line-height: 26px;
  font-weight: 400;
  color: #005fae;
  cursor: text;
  transition: -webkit-transform .2s ease-in-out;
  transition: transform .2s ease-in-out;
  transition: transform .2s ease-in-out, 
  -webkit-transform .2s ease-in-out;
}
.contact-form .submit-btn {
  display: inline-block;
  background-color: #005fae;
 
  color: #fff;
  text-transform: uppercase;
  
  font-size: 16px;
  padding: 8px 16px;
  border: none;
  width:200px;
  cursor: pointer;
}

.validation{
  display:none;
}
.rtl .contact-form .label{
  left:unset;
  right :20px;
}

 </style>
 
 

                   <br>
                    <div class="page-title-custom text-center">
                     {{ trans('frontLang.Apply_Now') }}
                    </div>

                     <br>
                   

                    <div>
                        <!---------------------------------------------------------------------------------------------->
   {{Form::open(['route'=>['contactPage'],'method'=>'POST','class'=>'contactForm contact-form row','id'=>'contactForm'])}}
                          
                              <div class="form-field col-lg-6">
                                {!! Form::text('contact_name',"", array('class'=>'name','class'=>'input-text js-input', 'data-msg'=> trans('frontLang.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                      <div class="alert alert-warning validation"></div>

                                
                                 <label class="label" for="name">{{ trans('frontLang.yourName') }}</label>
                              </div>
                              <div class="form-field col-lg-6 ">
                                   {!! Form::email('contact_email',"", array('class' => 'input-text js-input','id'=>'email', 'data-msg'=> trans('frontLang.enterYourEmail'),'data-rule'=>'email')) !!}
                        <div class="validation"></div>
                                
                                 <label class="label" for="email">{{ trans('frontLang.email') }}</label>
                              </div>
                              <div class="form-field col-lg-6 ">
  {!! Form::text('contact_subject',"", array('class' => 'input-text js-input','id'=>'subject', 'data-msg'=> trans('frontLang.address'))) !!}
                            
                                 <label class="label" for="contact_subject"> {{ trans('frontLang.address') }}</label>
                              </div>
                               <div class="form-field col-lg-6 ">
                                     {!! Form::text('contact_phone',"", array('class' => 'input-text js-input','id'=>'phone', 'data-msg'=> trans('frontLang.enterYourPhone'),'data-rule'=>'minlen:4')) !!}
                        <div class="validation"></div>
                                   <label class="label" for="contact_phone"> {{ trans('frontLang.phone') }}</label>
                                 
                              </div>
                              <div class="form-field col-lg-12">
                                {!! Form::textarea('contact_message','', array('class' => 'input-text js-input','id'=>'message','rows'=>'8', 'data-msg'=> trans('frontLang.enterYourMessage'),'data-rule'=>'required')) !!}
                                 
                                
                                 <label class="label" for="contact_message"> {{ trans('frontLang.message') }}</label>
                              </div>
                              <div class="form-field col-lg-12">

                                 <button type="submit" class="submit-btn">{{ trans('frontLang.submit') }}</button>
                                 
                              </div>
                                  {{Form::close()}}
                                         
            
                        </div>
                        <!------------------------------------------------------------------------------------>
                 
 

