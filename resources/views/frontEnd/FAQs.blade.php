
@extends('frontEnd.layout')

@section('content')
<?php 
      $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    $details_var2 = "details_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                     $file_var = "file_" . trans('backLang.boxCode');
                    $section_url = "";
         $backgroundImage="uploads/banar.jpg";
         

?>

   
<style type="text/css">
  .main-holder {
    background-color: #f5f5f5;
}
  .content_faq{
    padding:30px;

  }
   .rtl .content_faq{
    /*padding-right:30px;*/
    
  }
</style>
<div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_faqs_page') }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ trans('frontLang.FAQs') }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                 @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                  
                                  <li class="active">{{ trans('frontLang.FAQs') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   @if(count((array)$Topics)>0)
    <div class="main-holder">
    <div>
        <div class="container inner-content com-sp pad-bot-70">
        
          
            <div class="row">
              
              

                <div class="col-sm-12 col-md-12 printable-version" style="background-color: #fff; padding: 10px;">
                    <br>
                    <div class="page-title-custom text-center">
                     {{ trans('frontLang.FAQs') }}
                    </div>

                     <br>

                    <div>
                        <!---------------------------------------------------------------------------------------------->

              <div class="welcome welcome-links">
                  <div class="accordion accordion-3" id="accordion03" role="tablist" aria-multiselectable="true">
                     @foreach($Topics as $key=> $Item)  
                      <div class="panel bg-white">
                          <div class="panel--heading" role="tab" id="CommonQuestions{!! $key !!}_head">
                              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion03" href="#CommonQuestions{!! $key !!}" aria-expanded="false" aria-controls="#CommonQuestions{!! $key !!}">
                                  {!! $Item->$title_var !!}
                              </a>
                          </div>
                          <div id="CommonQuestions{!! $key !!}" class="collapse content_faq" role="tabpanel" aria-labelledby="CommonQuestions{!! $key !!}_head" data-parent=".accordion-3" style="">
                             {!! $Item->$details_var !!}
                          </div>
                      </div>

                        @endforeach

             

                   

                  </div>
              </div>

                        <!------------------------------------------------------------------------------------>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 

@else



        <section class="process_area bg_color sec_pad about">
            <br><br>
         <div class="row">
                            <div class="col-sm-12">
                                <div class=" p-a text-center ">
                                    {{ trans('backLang.noData') }}
                                    <br>
                                    <br>
                                     
                                       
                                   
                                </div>
                            </div>
            </div>
        </section>


 

 





   @endif

   @endsection
 
   
  

