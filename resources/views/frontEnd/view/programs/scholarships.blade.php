          <div class="main-detail main-detail-3" style="display: none;">
                <div class="tab-type-2">
                  <?php    $index=0;   ?>
                    @if(!empty($program->mycontent))

                           @foreach($program->mycontent as $key=> $Item)
                              @if($Item->catagoryes==2)

                     <div class="tab2-title" data-id="{{ $key+1 }} ">{!!  $Item->$title_var !!} </div>
                                <div class="tab2-dtl tab2-dtl-{{ $key+1 }}" style="display:{{ ($index==0)?'block':'none' }} ">
                                  
                                      
                                         {!!  $Item->$details_var !!}
                                  


                                  
                              </div>
                                <?php    ++$index;   ?>
                                    @endif  
                             @endforeach 

                     @endif  
                   
                  
                </div>
            </div>

  
 