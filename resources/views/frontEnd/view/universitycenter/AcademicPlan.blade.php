          <div class="main-detail main-detail-5" style="display: none;">
                <div class="tab-type-2">
         
                    @if(count((array)$universitycenter->mycontent)>0)

                           @foreach($universitycenter->mycontent as $Item)
                              @if($Item->catagoryes==4)

                                
                                 <h2>{!!  $Item->$title_var !!} </h2>
                             <hr>
                             <div class="contentsection">
                                   {!!  $Item->$details_var !!}

                                 </div>  

                                    @endif  
                             @endforeach 

                     @endif  
                   
                  
                </div>
            </div>

  
 