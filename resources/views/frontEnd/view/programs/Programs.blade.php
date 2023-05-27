     <div class="main-detail main-detail-2" style="display: none;">
                     @if(!empty($program->mycontent))

                        @foreach($program->mycontent as $key=> $Item)
                                 @if($Item->catagoryes==1)
   <h2>{!!  $Item->$title_var !!} </h2>
                             <hr>
                             <div class="contentsection">
                                   {!!  $Item->$details_var !!}

                                 </div>  
                                

                                    @endif  
                             @endforeach 

                     @endif  
               
               
            </div>