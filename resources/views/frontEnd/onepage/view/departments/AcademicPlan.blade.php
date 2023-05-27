     <div class="main-detail main-detail-5" style="display: none;">
                   @if(count((array)$department->mycontent)>0)

                           @foreach($department->mycontent as $Item)
                             @if($Item->catagoryes==4)

                                <h2>{!!  $Item->$title_var !!} </h2>
                                <hr>

                                   {!!  $Item->$details_var !!}

                                    @endif  
                             @endforeach 

                     @endif  
               
               
            </div>