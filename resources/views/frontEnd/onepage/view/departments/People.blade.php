 <div class="main-detail main-detail-3" style="display: none;">

  @if(count((array)$department->mycontent)>0)
<?php 
$limit=0;
?>
  @foreach($department->mycontent as $Item)
      @if($Item->catagoryes==6 && $limit==0)
      <?php 
++$limit;
?>
	 <section class="section-text has-padding-m has-color-grey align-left">
    <div id="c2879" class="anchor"></div>
    <div class="container">
        <div class="row">
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
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Item->photo_file) }}" width="720" height="364" alt="{!! $Item->$title_var !!}" /></div>
                </div>
            </div>
        </div>
    </div>
</section>	 
		    @endif  
    @endforeach 

                     @endif  			
       @if(count((array)$department->staffs)>0)
                      
                        
				 
  <h3 class="people-category-title">{{ trans('frontLang.People') }}  </h3>
                 
  <div class="common-members-block clear Academic Faculty">					
             <section id="team" class="team-area">
        
            
                 <div class="row team-items" style="margin:0">
                      @foreach($department->staffs as $Item)

                         
                     <div class="col-md-4 single-item">
                         <div class="item">
                             <div class="thumb">
                                 <img class="img-fluid" src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="">
                                 <div class="overlay">
                                    
                                     <?php

                                           $qualification='qualification_'.trans('backLang.boxCode');
                                           $major='major_'.trans('backLang.boxCode'); 
                                           $postion='postion_'.trans('backLang.boxCode');

                                         ?>
                                        @if ($Item->$qualification!='')
                                        {{--  <p><small><strong>{{ trans('frontLang.Qualification') }}:</strong> {!!   $Item->$qualification !!}</small></p> --}}
                                         @endif
                                
                                @if ($Item->$major!='')
                                        {{--  <p><small><strong>{{ trans('frontLang.Major') }}:</strong>{!!  $Item->$major !!}</small></p> --}}
                                         @endif

                                     
                                      {{--    {!!  $Item->$details_var !!} --}}
                                      
                                    
                                 </div>
                             </div>
                             <div class="info">
                                 <span class="message">
                                     <a href="{{ url(trans('backLang.boxCode').'/university/iutt/profile/'.$Item->id) }}"><i class="fas fa-envelope-open"></i></a>
                                 </span>
                                 <h4><a href="{{ url(trans('backLang.boxCode').'/university/iutt/profile/'.$Item->id) }}">{!!  $Item->$title_var !!}</a></h4>
                                 
                                         @if ($Item->$postion)
                                         <span>{!!  $Item->$postion !!}</span>
                                         @endif


                                       
                             </div>
                         </div>
                     </div>

                      @endforeach 





          
                 </div>
         
     </section>							
                                     
                                     
                                     
                                     
                                                
                                     
      </div>			
              
                
               		
        @endif        
               
                 
               
					
				 @if(count($department->staffs)>0)
   
  <h3 class="people-category-title">{{ trans('frontLang.employees') }}  </h3>
                 
  <div class="common-members-block clear Academic Faculty">         
             <section id="team" class="team-area">
        
            
                 <div class="row team-items" style="margin:0">
                      @foreach($department->employees as $Item)

                         
                     <div class="col-md-4 single-item">
                         <div class="item">
                             <div class="thumb">
                                 <img class="img-fluid" src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="">
                                 <div class="overlay">
                                    
                                     <?php

                                           $qualification='qualification_'.trans('backLang.boxCode');
                                           $major='major_'.trans('backLang.boxCode'); 
                                           $postion='postion_'.trans('backLang.boxCode');

                                         ?>
                                        @if ($Item->$qualification!='')
                                         <p><small><strong>{{ trans('frontLang.Qualification') }}:</strong> {!!   $Item->$qualification !!}</small></p>
                                         @endif
                                
                                @if ($Item->$major!='')
                                         <p><small><strong>{{ trans('frontLang.Major') }}:</strong>{!!  $Item->$major !!}</small></p>
                                         @endif

                                     
                                         {!!  $Item->$details_var !!}
                                      
                                    
                                 </div>
                             </div>
                             <div class="info">
                                 <span class="message">
                                     <a href="{{ url(trans('backLang.boxCode').'/university/iutt/profile/'.$Item->id) }}"><i class="fas fa-envelope-open"></i></a>
                                 </span>
                                 <h4><a href="{{ url(trans('backLang.boxCode').'/university/iutt/profile/'.$Item->id) }}">{!!  $Item->$title_var !!}</a></h4>
                                 
                                         @if ($Item->$postion)
                                         <span>{!!  $Item->$postion !!}</span>
                                         @endif


                                       
                             </div>
                         </div>
                     </div>

                      @endforeach 





          
                 </div>
         
     </section>             
                                     
                                     
                                     
                                     
                                                
                                     
      </div>      
              
                
                  
        @endif        
               
                 
               
          
        
    </div>
			