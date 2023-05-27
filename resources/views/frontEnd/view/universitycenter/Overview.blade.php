    
                   @if(count((array)$universitycenter->mycontent)>0)

                           @foreach($universitycenter->mycontent as $Item)
                              @if($Item->catagoryes==1)

                                
                                 <h2>{!!  $Item->$title_var !!} </h2>
                             <hr>
                             <div class="contentsection">
                                   {!!  $Item->$details_var !!}

                                 </div>  

                                    @endif  
                             @endforeach 

                     @endif  
               
               
      