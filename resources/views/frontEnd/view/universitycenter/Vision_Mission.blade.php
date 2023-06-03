    <style type="text/css">
      .section-text__image-wrap img{
        width:100%;
        height:auto;  
      }
    </style>
     <div class="main-detail main-detail-2" style="display: none;">
                     @if(count((array)$universitycenter->mycontent)>0)
              <?php 
       $indexr=0;
              ?>
                           @foreach($universitycenter->mycontent as $key=> $Item)
                            
                              @if($Item->catagoryes==2)
                      
   <section class="section-text    {{  ($indexr%2==0)?'has-color-grey':'' }} ">
    <div id="c2879" class="anchor"></div>
   
        
          @if(($Item->photo_file!='' ||  $Item->photo_file!='#') && (strip_tags($Item->$details_var)!=''))
                  @if($indexr%2==0)
            <div class="row">
                     
            <div class="col-md-6 col-lg-6 col-12 order-first">
                <div class="section-text__image align-center">
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Item->photo_file) }}" width="720" alt="{!! $Item->$title_var !!}"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-12">
                <div class="section-text__text align-left">
                    <div class="section-text__text--header"><h3 class="h3">{!! $Item->$title_var !!}</h3></div>
                    <div class="section-text__text--body">
                            {!! $Item->$details_var !!}
                    </div>
                </div>
            </div>
            
        </div>
            @else


              <div class="row">
            <div class="col-md-6 col-lg-6 col-12">
                <div class="section-text__text align-left">
                    <div class="section-text__text--header"><h3 class="h3">{!! $Item->$title_var !!}</h3></div>
                    <div class="section-text__text--body"> 
                      {!! $Item->$details_var !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-12">
                <div class="section-text__image align-center">
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Item->photo_file) }}" width="720" height="364" alt="{!! $Item->$title_var !!}"></div>
                </div>
            </div>
        </div>



            @endif

           
        
            
         @endif   
      
   
</section>  
<hr>

      <?php 
       ++$indexr;
              ?>
 

                                    @endif  
                             @endforeach 

                     @endif  
               

 
               
            </div>