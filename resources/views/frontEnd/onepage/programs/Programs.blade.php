     <div class="main-detail main-detail-2" style="display: none;">
                     @if(!empty($program->mycontent))

                        @foreach($program->mycontent as $key=> $Item)
                                 @if($Item->catagoryes==1)

                                 <h3>
                                     <strong><u>{!!  $Item->$title_var !!} </u></strong>
                                   </h3>

                                   {!!  $Item->$details_var !!}

                                    @endif  
                             @endforeach 

                     @endif  
               
               
            </div>