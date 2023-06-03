    <style type="text/css">
      .section-text__image-wrap img{
        width:100%;
        height:auto;  
      }
    </style>
     <div class="main-detail main-detail-3" style="display: none;">
                     @if(count((array)$contentsmestionvi)>0)
              <?php 
       $indexr=0;
              ?>
                           @foreach($contentsmestionvi as $key=> $Item)
                            
                              @if($Item->catagoryes==2)
                      
   <section class="section-text    {{  ($indexr%2==0)?'has-color-grey':'' }} ">
    <div id="c2879" class="anchor"></div>
   
        <div class="row">
          @if(($Item->photo_file!='' ||  $Item->photo_file!='#') && (strip_tags($Item->$details_var)!=''))
                  @if($indexr%2==0)
            <div class="col-md-8 col-lg-8 col-12">
                <div class="section-text__text align-left">
                    <div class="section-text__text--header"><h3 class="h3">{!! $Item->$title_var !!}</h3></div>
                    <div class="section-text__text--body">
                       {!! $Item->$details_var !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-12">
                <div class="section-text__image align-center">
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Item->photo_file) }}"   alt="{!! $Item->$title_var !!}" /></div>
                </div>
            </div>
            @else


            <div class="col-md-4 col-lg-4 col-12">
                <div class="section-text__image align-center">
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Item->photo_file) }}"   alt="{!! $Item->$title_var !!}" /></div>
                </div>
            </div>

                  <div class="col-md-8 col-lg-8 col-12">
                <div class="section-text__text align-left">
                    <div class="section-text__text--header"><h3 class="h3">{!! $Item->$title_var !!}</h3></div>
                    <div class="section-text__text--body">
                       {!! $Item->$details_var !!}
                    </div>
                </div>
            </div>



            @endif

            @elseif($Item->photo_file=='' ||  $Item->photo_file=='#')

                <div class="col-md-12 col-lg-12 col-12">
                <div class="section-text__text align-left">
                    <div class="section-text__text--header"><h3 class="h3">{!! $Item->$title_var !!}</h3></div>
                    <div class="section-text__text--body">
                       {!! $Item->$details_var !!}
                    </div>
                </div>
            </div>

          @elseif(strip_tags($Item->$details_var)=='')  
             <div class="col-md-12 col-lg-12 col-12">
                <div class="section-text__image align-center">
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Item->photo_file) }}"  alt="{!! $Item->$title_var !!}" /></div>
                </div>
            </div>

         @endif   
        </div>
   
</section>  
<hr>

      <?php 
       ++$indexr;
              ?>
 

                                    @endif  
                             @endforeach 

                     @endif  
               

 
               
            </div>