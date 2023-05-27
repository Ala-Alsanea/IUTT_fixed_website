 <div class="main-detail main-detail-3" style="display: none;">
	<style type="text/css">
     

    </style>		 
							
       @if(count((array)$universitycenter->staffs)>0)
                      
                        
				 
                 <h3 class="people-category-title">{{ trans('frontLang.People') }}  </h3>
                 
  <div class="common-members-block clear Academic Faculty">					
             <section id="team" class="team-area">
        
            
                 <div class="row team-items" style="margin:0">
                      @foreach($universitycenter->staffs as $Item)

                   
                        
                        

                 
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
                                       {{--   <p><small><strong>{{ trans('frontLang.Qualification') }}:</strong> {!!   $Item->$qualification !!}</small></p> --}}
                                         @endif
                                
                                @if ($Item->$major!='')
                                        {{--  <p><small><strong>{{ trans('frontLang.Major') }}:</strong>{!!  $Item->$major !!}</small></p> --}}
                                         @endif

                                     
                                        {{--  {!!  $Item->$details_var !!} --}}
                                      
                                    
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
			