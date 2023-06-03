@if(count($HomeTopics)>0)
<section class="blog_area bg-wighte sec_pad index-blog">
  <div class="sec_title text-center mb_70">
        <h2 class="f_p f_size_30 l_height45 f_600 t_color3">{{ trans('frontLang.LastNews') }}</h2>
     {{--    <p class="f_400 f_size_16 mb-0">Samsa will only charge a fee if you make a profit</p> --}}
    </div>
        <div class="container">
      
             
            <div class="row">
               
                
                <div class="col-md-12">
                     <div class="ho-event pg-eve-main  news_section ui-newslist">
                 
                     
                        <div class="ho-event">
                            <ul class="row">
                                 @foreach($HomeTopics as $key => $HomeTopic)
                                 <?php 

                      

                        $details_content=$HomeTopic->$details_var;
                           if ($HomeTopic->$details_var != "") {
                            $details_content = $HomeTopic->$details_var;
                        } else {
                            $details_content = $HomeTopic->$title_var;
                        }

                 $topic_link_url = url(trans('backLang.code').'/news/faculty/'.$HomeTopic->id);
       $topic_link_url = url(trans('backLang.code').'/'.$FacultyData->id.'/news/faculty/'.$HomeTopic->id); 

?>

                                  <li class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                     <a href="{{ $topic_link_url }}" class="i" title="{{ $HomeTopic->$title_var }}">
                                        <div class="dt">
                                         
                                               <p class="p1"> <?php echo date('Y ,M', strtotime($HomeTopic->date)); ?></p>
                                            <p class="p2"><?php  echo date("d", strtotime($HomeTopic->date)); ?></p>

                                        </div>
                                        <div class="hd">
                                            <img src="{{ Helper::FilterImage($HomeTopic->photo_file) }}" alt="{{ $HomeTopic->$title_var }}">
                                        </div>
                                        <div class="ct">
                                            <p class="p1">{{ $HomeTopic->$title_var }}</p>
                                            <p class="p2">{{ str_limit(strip_tags($details_content), $limit = 30, $end = '...') }}</p>
                                            <p class="p3"><label for=""> {{ trans('frontLang.readMore') }} </label></p>
                                        </div>
                                    </a>
                                </li>

                                @endforeach
                              
                            
                              
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
 