          <div class="main-detail main-detail-9" style="display: none;">
                <div class="row">
      
                  
                  <style type="text/css">
  .ed-course-in a.course-overlay img{
        height: 250px;
  }
</style>     
                      <div class="ed-about-sec1 ed-course">
         
             @foreach($Photos as $key=> $Item)
        
           <div class="col-md-4">             
                <div class="ed-course-in">
                            <a class="course-overlay" title="{{ $Item->$title_var }}" href="{{ url(trans('backLang.code').'/'.$FacultyData->id.'/ourGallery/details/'.$Item->id) }}">
                                <img src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{{ $Item->$title_var }}">
                                <span>{{ $Item->$title_var }}</span>
                            </a>
                        </div>
                   
                 </div>
                      
                 @endforeach
                              
                             
      
          </div>
                   
                  
               </div>
          
            </div>

  
 