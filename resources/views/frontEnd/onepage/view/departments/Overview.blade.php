    
   
                   @if(count((array)$department->mycontent)>0)

                           @foreach($department->mycontent as $Item)
                              @if($Item->catagoryes==1)

                                
                                 <h2>{!!  $Item->$title_var !!} </h2>
                             <hr>
                             <div class="contentsection">
                                   {!!  $Item->$details_var !!}

                                 </div>  

                                    @endif  
                             @endforeach 

                     @endif  
               
               
      