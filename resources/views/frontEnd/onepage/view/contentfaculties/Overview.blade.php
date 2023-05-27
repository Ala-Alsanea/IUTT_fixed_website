    
                 
<div class="main-detail main-detail-2 " style="display: none;">

                   @if(count((array)$contentsoverview)>0)

                           @foreach($contentsoverview as $Item)
                              

                                
                                 <h2>{!!  $Item->$title_var !!} </h2>
                             <hr>
                             <div class="contentsection">
                                   {!!  $Item->$details_var !!}

                                 </div>  

                                   
                             @endforeach 

                     @endif  
               
                 </div>
      