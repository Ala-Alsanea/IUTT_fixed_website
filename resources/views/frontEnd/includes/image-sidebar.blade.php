       <?php 
$pullright='right';
$pullleft='left'; 
if(trans('backLang.boxCode')=='en'){
$pullright='left';
$pullleft='right'; 
}
       ?>
         <div class="blog-sidebar">
 
    @if(count((array)$TopicsMostViewed)>0)
      <?php
            $side_title_var = "title_" . trans('backLang.boxCode');
            $side_title_var2 = "title_" . trans('backLang.boxCodeOther');
            $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
            $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
            ?>
    <div class="widget sidebar_widget widget_recent_post mt_60">
        <div class="widget_title">
            <h3 class="f_p f_size_20 t_color3">{{ trans('frontLang.RecentPosts') }}</h3>
            <div class="border_bottom"></div>
        </div>
          @foreach($TopicsMostViewed as $TopicMostViewed)
           <?php
                        if ($TopicMostViewed->$side_title_var != "") {
                            $side_title = $TopicMostViewed->$side_title_var;
                        } else {
                            $side_title = $TopicMostViewed->$side_title_var2;
                        }
                        if ($TopicMostViewed->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $topic_link_url = url(trans('backLang.code') . "/" . $TopicMostViewed->$slug_var);
                            } else {
                                $topic_link_url = url($TopicMostViewed->$slug_var);
                            }
                        } else {
                           
                        }

                           $topic_link_url = url(trans('backLang.code').'/news/topic/'.$TopicMostViewed->id);
                        if ($TopicMostViewed->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $topic_link_url = url(trans('backLang.code') . "/" . $TopicMostViewed->$slug_var);
                            } else {
                                $topic_link_url = url($TopicMostViewed->$slug_var);
                            }
                        }  

                        ?>
        <div class="media post_item">
                 @if($TopicMostViewed->photo_file !="")
                                            <img src="{{ Helper::FilterImage($TopicMostViewed->photo_file) }}"
                                                 class="pull-left" alt="{{ $side_title }}"/>
                                        @elseif($TopicMostViewed->webmasterSection->type==2 && $TopicMostViewed->video_file!="")
                                            @if($Topic->video_type ==1)
                                                <?php
                                                $Youtube_id = Helper::Get_youtube_video_id($Topic->video_file);
                                                ?>
                                                @if($Youtube_id !="")
                                                    <img src="http://img.youtube.com/vi/{{$Youtube_id}}/0.jpg"
                                                         class="pull-left" alt="{{ $side_title }}"/>
                                                @endif
                                            @elseif($Topic->video_type ==2)
                                                <?php
                                                $Vimeo_id = Helper::Get_vimeo_video_id($Topic->video_file);
                                                ?>
                                                @if($Vimeo_id !="")
                                                    <?php
                                                    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$Vimeo_id.php"));
                                                    ?>

                                                    <img src="{{ $hash[0]['thumbnail_large'] }}"
                                                         class="pull-left" alt="{{ $side_title }}"/>
                                                @endif
                                            @endif
                                        @endif
            <div class="media-body">
                <a href="{{ $topic_link_url }}">
                    <h3 class="f_size_16 f_p f_400">{{ str_limit(strip_tags($side_title), $limit = 30, $end = '...') }}</h3>
                </a>
               
            </div>
        </div>
         @endforeach
       
        
    </div>
     @endif
       @if(count((array)$Categories)>0)
        <?php
            $category_title_var = "title_" . trans('backLang.boxCode');
            $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
            $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
            ?>
    <div class="widget sidebar_widget widget_categorie mt_60">
        <div class="widget_title">
            <h3 class="f_p f_size_20 t_color3">{{ trans('frontLang.categories') }}</h3>
            <div class="border_bottom"></div>
        </div>
        <ul class="list-unstyled">
             @foreach($Categories as $Category)
                        <?php $active_cat = ""; ?>
                        @if($CurrentCategory!="none")
                            @if(count((array)$CurrentCategory) >0)
                                @if($Category->id == $CurrentCategory->id)
                                    <?php $active_cat = "class=active"; ?>
                                @endif
                            @endif
                        @endif
                        <?php
                       // count($category_and_topics_count);
                        $ccount = $category_and_topics_count[$Category->id];
                        if ($Category->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $Category_link_url = url(trans('backLang.code') . "/" . $Category->$slug_var);
                            } else {
                                $Category_link_url = url($Category->$slug_var);
                            }
                        } else {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $Category_link_url = route('FrontendTopicsByCatWithLang', ["lang" => trans('backLang.code'), "section" => $Category->webmasterSection->name, "cat" => $Category->id]);
                            } else {
                                $Category_link_url = route('FrontendTopicsByCat', ["section" => $Category->webmasterSection->name, "cat" => $Category->id]);
                            }
                        }
                        ?>
                        <li>
                            @if($Category->icon !=="")
                                <i class="fa {{$Category->icon}}"></i> &nbsp;
                            @endif
                            <a {{ $active_cat }} href="{{ $Category_link_url }}">{{$Category->$category_title_var}}</a><span
                                    class="pull-{{ $pullleft }}">({{ $ccount }})</span></li>
                        @foreach($Category->fatherSections as $MnuCategory)
                            <?php $active_cat = ""; ?>
                            @if($CurrentCategory!="none")
                                @if(count((array)$CurrentCategory) >0)
                                    @if($MnuCategory->id == $CurrentCategory->id)
                                        <?php $active_cat = "class=active"; ?>
                                    @endif
                                @endif
                            @endif
                            <?php
                            $ccount = $category_and_topics_count[$MnuCategory->id];
                            if ($MnuCategory->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                    $SubCategory_link_url = url(trans('backLang.code') . "/" . $MnuCategory->$slug_var);
                                } else {
                                    $SubCategory_link_url = url($MnuCategory->$slug_var);
                                }
                            } else {
                                if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                    $SubCategory_link_url = route('FrontendTopicsByCatWithLang', ["lang" => trans('backLang.code'), "section" => $MnuCategory->webmasterSection->name, "cat" => $MnuCategory->id]);
                                } else {
                                    $SubCategory_link_url = route('FrontendTopicsByCat', ["section" => $MnuCategory->webmasterSection->name, "cat" => $MnuCategory->id]);
                                }
                            }
                            ?>
                            <li> &nbsp; &nbsp; &nbsp;
                                @if($MnuCategory->icon !=="")
                                    <i class="fa {{$MnuCategory->icon}}"></i> &nbsp;
                                @endif
                                <a {{ $active_cat }}  href="{{ $SubCategory_link_url }}">{{$MnuCategory->$category_title_var}}</a><span
                                        class="pull-{{ $pullleft }}">({{ $ccount }})</span></li>
                        @endforeach

                    @endforeach
        </ul>
    </div>
      @endif
  
</div>