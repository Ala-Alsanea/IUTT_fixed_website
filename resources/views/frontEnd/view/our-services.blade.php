<!-- total info -->
    <?php
     $QuickService=App\Models\Topic::where([['status', 1], ['webmaster_id',10]])->orderby('row_no', 'asc')->get();
          $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    $details_var2 = "details_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                     $file_var = "file_" . trans('backLang.boxCode');
                    $section_url = "";
 

    ?>
    @if(count((array)$QuickService)>0)
<section>
  
		<div class="ui-services com-sp pad-bot-70">
			 <div class="container">
            <div class="ui-headtabs-holder"></div>
<div class="ui-headtabs">
                <ul>
				 @foreach($QuickService as $Item)
                   @if(isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value==1)
                    <li>
                        <a href="{{ ($Item->url_link!='' && $Item->url_link!="#")?$Item->url_link:'#' }}" class="i on">
                            <p class="p1"><i class="ico" style="background-image:url(''); ">
                                <img src="{{ Helper::FilterImage($Item->photo_file) }}" alt=" {{ $Item->$title_var }}">
                            </i></p>
                            <p class="p2"> {{ $Item->$title_var }}</p>
                        </a>
                    </li>
                    @endif
                @endforeach
                    
               
                     
               
                   
                    <div class="clearfix"></div>
                </ul>
</div>

 
        </div>
		</div>

	</section>

    @endif