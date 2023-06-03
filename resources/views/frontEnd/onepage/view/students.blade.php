 <!-- center Area End Here -->  <!-- Students Join 2 Area Start Here -->
   @if($FacultyData->students->count()>0)
        <div class="students-join2-area" >
            <div class="container">
                <div class="students-join2-wrapper">
                    <div class="students-join2-right">
                        <div>
                            <h2>{{ trans('frontLang.Join') }}   {{ $FacultyData->students->count() }}   {{ trans('frontLang.Students') }}.</h2>
                             
                            <a href="#" class="app_btn btn_transparent_white btn_hover cus_mb-10">{{ trans('frontLang.JoinNow') }}</a>
                        </div>
                    </div>
                    <div class="students-join2-left" dir="ltr">
                        <div id="ri-grid" class="author-banner-bg ri-grid header text-center">
                            <ul class="ri-grid-list">
                                 @foreach($FacultyData->students as $key => $Item) 
                                <li>
                                    <a href="#" title="{{ $Item->$title_var }}"><img src="{{ Helper::FilterImage($Item->photo_file) }}" alt="{{ $Item->$title_var }}"></a>
                                </li>
                                 @endforeach
                               
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Students Join 2 Area End Here -->

          @endif