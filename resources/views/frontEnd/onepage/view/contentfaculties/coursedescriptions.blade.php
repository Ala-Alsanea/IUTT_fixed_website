     <div class="main-detail main-detail-6" style="display: none;">
               @if(count((array)$coursedescriptions)>0)

                           @foreach($coursedescriptions as $Item)
                             

                                
                                 <h2>{!!  $Item->$title_var !!} </h2>
                             <hr>
                             <div class="contentsection">
                                   {!!  $Item->$details_var !!}

                                 </div>  

                                    
                             @endforeach 

                     @endif  
               
               
            </div>