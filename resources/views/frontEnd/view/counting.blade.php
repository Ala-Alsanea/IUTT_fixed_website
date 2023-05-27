<!-- total info -->
    <?php
     $HomeCounters=App\Models\Topic::where([['status', 1], ['webmaster_id',13]])->orderby('row_no', 'asc')->get();
          $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    $details_var2 = "details_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                     $file_var = "file_" . trans('backLang.boxCode');
                    $section_url = "";
 

    ?>

@if(count((array)$HomeCounters)>0)

<section class="event_fact_area sec_pad" style="background: #222831; background-image: linear-gradient(to bottom right, #17191a, #0d6cb052);">
    <div class="container">
        <div class="hosting_title security_title text-center">
            <h2 style="color: #ffffff;">{{  trans('backLang.counters') }}</h2>
        </div>
        <div class="seo_fact_info">

@foreach($HomeCounters as $Item)
         <div class="seo_fact_item wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                <div class="text">
                    <div class="counter one">{!!  $Item->url_link !!}</div>
                    <p>{{ $Item->$title_var }}</p>
                </div>
            </div>
              @endforeach
        
          
           
            
        </div>
    </div>
</section>
@endif