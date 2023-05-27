          <div class="main-detail main-detail-4" style="display: none;">
                <div class="tab-type-2">

                    @if(count((array)$department->mycontent)>0)

                           @foreach($department->mycontent as $Item)
                              @if($Item->catagoryes==3)

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