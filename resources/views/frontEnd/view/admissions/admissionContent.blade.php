  <style>
    .apply-btn{
        z-index: 60;
    }
    .text-block{
        position: relative;
        overflow:hidden;
        padding-bottom:20px;
        margin-bottom: 25px;
    }
    .text-block__title{}
    .text-block__text{
        max-height: 407px;
        overflow:hidden;
        cursor:pointer;
        padding-bottom: 30px;
    }
    .text-block__text:hover:before{
        background-color: #0d6cb0;
        color:#fff;
    }
    .text-block__text.active:before{
        content: '\f106';
        
    }
    .text-block__text:before{
        content: '\f107';
        font-family: 'FontAwesome';
        font-size: 24px;
        line-height: 30px;
        text-align: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        position: absolute;
        left: 50%;
        bottom: 0;
        background: #eee;
        -moz-transform: translate(-50%, 50%);
        -ms-transform: translate(-50%, 50%);
        -webkit-transform: translate(-50%, 50%);
        -o-transform: translate(-50%, 50%);
        transform: translate(-50%, 50%);
        z-index: 50;
    }
    .text-block__text:after{
        content: '';
        display: block;
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 50px;
        border-bottom: 1px solid #eee;
        background: linear-gradient(to bottom, rgba(255,255,255,0), #fff);
    }
    .text-block__text.active{
        max-height: inherit;
    }
    .text-block__title{
        font-size:26px;
    }
    li.timeline-inverted:hover .timeline-badge{
        background:#0d6cb0!important;
    }
    li.timeline-inverted:hover .timeline-title{
        color:#0d6cb0!important;
    }
    .timeline {
      list-style: none;
      padding: 20px 0 20px;
      position: relative;
    }

    .timeline:before {
      top: 0;
      bottom: 0;
      position: absolute;
      content: " ";
      width: 0px;
      /*background-color: #eeeeee;*/
      border: 1px dashed;
      left: 5%;
      margin-left: -1.5px;
    }
 .rtl .timeline:before {
      top: 0;
      bottom: 0;
      position: absolute;
      content: " ";
      width: 0px;
      /*background-color: #eeeeee;*/
      border: 1px dashed;
      left:unset;
      right: 5%;
      margin-left: unset;
      margin-right: -1.5px;
    }
    .timeline > li {
      margin-bottom: 20px;
      position: relative;
    }

    .timeline > li:before,
    .timeline > li:after {
      content: " ";
      display: table;
    }

    .timeline > li:after {
      clear: both;
    }

    .timeline > li:before,
    .timeline > li:after {
      content: " ";
      display: table;
    }

    .timeline > li:after {
      clear: both;
    }

    .timeline > li > .timeline-panel {
        background-color:#fff;
      width: 90%;
      float: left;
      border: 1px solid #d4d4d4;
      border-radius: 2px;
      padding: 20px;
      position: relative;
      -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
      box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    }

    .timeline > li > .timeline-panel:before {
      position: absolute;
      top: 26px;
      right: -15px;
      display: inline-block;
      border-top: 15px solid transparent;
      border-left: 15px solid #ccc;
      border-right: 0 solid #ccc;
      border-bottom: 15px solid transparent;
      content: " ";
    }

 .rtl  .timeline > li > .timeline-panel:before {
     border-top: 15px solid transparent;
      border-left: 0 solid #ccc;
      border-right:15px solid #ccc;
   }
    .timeline > li > .timeline-panel:after {
      position: absolute;
      top: 27px;
      right: -14px;
      display: inline-block;
      border-top: 14px solid transparent;
      border-left: 14px solid #fff;
      border-right: 0 solid #fff;
      border-bottom: 14px solid transparent;
      content: " ";
    }
.rtl .timeline > li > .timeline-panel:after{
  right:unset;
    left: -14px;
}
    .timeline > li > .timeline-badge {
      color: #fff;
      width: 50px;
      height: 50px;
      line-height: 50px;
      font-size: 1.4em;
      text-align: center;
      position: absolute;
      top: 16px;
    
      background-color: #999999;
      border-top-right-radius: 50%;
      border-top-left-radius: 50%;
      border-bottom-right-radius: 50%;
      border-bottom-left-radius: 50%;
    }
    .ltr .timeline > li > .timeline-badge{
          left: 5%;
      margin-left: -25px;
    }
   .rtl .timeline > li > .timeline-badge{
      right: 5%;
      margin-right: -25px;
   }
    .ltr .timeline > li.timeline-inverted > .timeline-panel {
      float: right;
    }

    .timeline > li.timeline-inverted > .timeline-panel:before {
      border-left-width: 0;
      border-right-width: 15px;
      left: -15px;
      right: auto;
    }

    .timeline > li.timeline-inverted > .timeline-panel:after {
      border-left-width: 0;
      border-right-width: 14px;
      left: -14px;
      right: auto;
    }
   .rtl .timeline > li.timeline-inverted > .timeline-panel:before {
      border-right-width: 0;
      border-left-width: 15px;
      right: -15px;
      left: auto;
    }

    .rtl  .timeline > li.timeline-inverted > .timeline-panel:after {
      border-right-width: 0;
      border-left-width: 14px; 

        right: -14px;
      left: auto;
    }
    .timeline-badge.primary {
      background-color: #2e6da4 !important;
    }

    .timeline-badge.success {
      background-color: #3f903f !important;
    }

    .timeline-badge.warning {
      background-color: #f0ad4e !important;
    }

    .timeline-badge.danger {
      background-color: #d9534f !important;
    }

    .timeline-badge.info {
      background-color: #5bc0de !important;
    }

    .timeline-title {
      margin-top: 0;
      color: inherit;
    }

    .timeline-body > p,
    .timeline-body > ul {
      margin-bottom: 0;
    }

    .timeline-body > p + p {
      margin-top: 5px;
    }
    .soc-icons{
        padding-left: 40px;
        position: relative;
        display: block;
        line-height: 37px;
        font-size: 18px;
    }
    .soc-icons:before{
        content: '';
        background-image: url(/bitrix/templates/ UITT _english/i/soc-icons.png);
        width: 33px;
        height: 49px;
        position: absolute;
        left: 0;
        background-repeat: no-repeat;
        background-size: cover;
        top: -10px;
    }
    .rtl .soc-icons:before{
        content: '';
        background-image: url(/bitrix/templates/ UITT _english/i/soc-icons.png);
        width: 33px;
        height: 49px;
        position: absolute;
        left: unset;
        right:0;
        background-repeat: no-repeat;
        background-size: cover;
        top: -10px;
    }
    .soc-icons.vk:before{
        background-position: 0 0;
    }
    .soc-icons.fb:before{
        background-position: -75px 0;
    }
    .soc-icons.inst:before{
        background-position: -37px 0;
    }
    .accordion .collapse{
        overflow:hidden; 
    }
    .image_content{
      width:100%; 
/*    float: right;*/
    /*margin-right: unset;
    margin-left: 10px;*/
  }

  .contentsection table{
    width:100% !important;
    margin:0 !important; 
  }
   .contentsection table td{
    width:100% !important;
   }
</style>
   @if(count((array)$Topics)>0)
 
                    <br>
                    <div class="page-title-custom text-center">
                    
                    </div>

                     <br>

               
                        <!---------------------------------------------------------------------------------------------->
                   @if($viewtype=='timeline')


                       
                     <div class="text-block">
                            <div class="text-block__title">
                                <h2>{{ trans('frontLang.AdmissionGuideMessage') }}</h2>
                            </div>
                           <div class="text-block__text ">
                                 <ul class="timeline">
                                    @foreach($Topics as $key=> $Item)
                                         <li class="timeline-inverted">
                                            <div class="timeline-badge">
                                                {{ $key+1 }}
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"> {!!  $Item->$title_var !!}</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    {!! $Item->$details_var !!}
                                                </div>
                                            </div>
                                        </li>
                                          @endforeach



                                 </ul>

                        </div>


                    @elseif($viewtype=='accordion')

                    <div class="accordion accordion-3" id="accordion03" role="tablist" aria-multiselectable="true">
                          @foreach($Topics as $key=> $Item)
                        <div class="panel bg-white">
                            <div class="panel--heading" role="tab" id="CommonQuestions{{ $key }}_head">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion03" href="#CommonQuestions{{ $key }}" aria-expanded="true" aria-controls="#CommonQuestions{{ $key }}"> {!!  $Item->$title_var !!}</a>
                            </div>
                            <div id="CommonQuestions{{ $key }}" class="collapse {{ ($key==0)?'in':'' }}" role="tabpanel" aria-labelledby="CommonQuestions{{ $key }}_head" data-parent=".accordion-3" style="">

                              @if($Item->photo_file!='' && $Item->photo_file!='#')
                                 <img alt="" height="257" class="image_content" src="{{ Helper::FilterImage($Item->photo_file) }}"   style="">
                                 @endif
                                 {!! $Item->$details_var !!}

                            </div>
                        </div>
                         @endforeach

                     
                    </div>


                     @else

                      <div class="welcome welcome-links">
                             @foreach($Topics as $Item)

  
                                 <h2>{!!  $Item->$title_var !!} </h2>
                             <hr>
                        @if($Item->photo_file!='' && $Item->photo_file!='#')
                               

                                 <style>
                                  #adhead1 {
                                   background-image: url({{ Helper::FilterImage($Item->photo_file) }} !important); 
                                  }
                                 </style>
                                 @endif
                               @if($Item->photo_file!='' && $Item->photo_file!='#')
                                 <img alt="" height="257" class="image_content" src="{{ Helper::FilterImage($Item->photo_file) }}"   style="height: auto; max-width: 752px;BORDER:0px solid;">
                                 @endif

                             <div class="contentsection">
                                   {!!  $Item->$details_var !!}

                                 </div> 

                                  <hr> 

                             
 

                             @endforeach




                        </div>


                     


                       @endif  

                        <!------------------------------------------------------------------------------------> 
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

 
 
   
  


