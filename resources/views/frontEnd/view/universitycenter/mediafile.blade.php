          <div class="main-detail main-detail-5" style="display: none;">
                <div class="tab-type-2">
                  
                       
                    @if(count((array)$universitycenter->mycontent)>0)
                        <table class="table  table-striped ">
                          
                           <thead>
                             <tr>
                               <th>{{ trans('frontLang.image') }}</th>
                               <th>{{ trans('frontLang.namefile') }}</th>
                               <th>{{ trans('frontLang.download') }}</th>
                             </tr>
                           </thead>
                           <tbody>
                             
                          
                           @foreach($universitycenter->mycontent as $Item)
                              @if($Item->catagoryes==5)

                                 <tr>
                                   <td>   <img class="img-fluid" src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{!!  $Item->$title_var !!}" style="width:50px "></td>
                                   <td>{!!  $Item->$title_var !!}</td>
                                   <td> <a href="{{ Helper::FilterImage($Item->attach_file) }}">{{ trans('frontLang.download_now') }}</a></td>
                                 </tr>
                                 
                            

                                    @endif  
                             @endforeach
                              </tbody> 

                               </table>

                     @endif  
                   
                  
                </div>
            </div>

  
 