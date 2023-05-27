          <div class="main-detail main-detail-7" style="display: none;">
                <div class="tab-type-2">
         
                    @if(count((array)$contentAcademicPlan)>0)

                           @foreach($contentAcademicPlan as $Item)
                         
  @if($Item->photo_file!='' && $Item->photo_file!='#')
        <div class="row align-items-center flex-row-reverse">

         
            <div class="col-lg-5">
                <div class="event_about_img">
                    <img class="wow fadeInRight" data-wow-delay="0.2s" src="{{ Helper::FilterImage($Item->photo_file) }}" alt=" {!! $Item->$title_var !!}" />
                    
                </div>
            </div>

            <div class="col-lg-7">
                <div class="event_about_content">
                    <h2 class="wow fadeInUp"> {!! $Item->$title_var !!}</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">
                       {!! $Item->$details_var !!}
                    </p>
                </div>
            </div>
        </div>
       @else

       <div class="row align-items-center flex-row-reverse">

         
           
            <div class="col-lg-12">
                <div class="event_about_content">
                    <h2 class="wow fadeInUp"> {!! $Item->$title_var !!}</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">
                       {!! $Item->$details_var !!}
                    </p>
                </div>
            </div>
        </div>

       @endif
                                
                               

                                  
                             @endforeach 

                     @endif  
                   
                  
                </div>
            </div>

  
 