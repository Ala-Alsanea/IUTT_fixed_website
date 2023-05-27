 <div class="container com-sp">
   
    <div class="row">
        <div class="col-md-12">
            <div class="section-text__text align-center">
                <div class="section-text__text--header"><h2 class="h2">{{ $title }}</h2></div>
                <div class="section-text__text--body">
                    {!! $Topic->$details_var !!}
                </div>
            </div>
        </div>
    </div>
</div>
</section>
 
  @if(count((array)$Topics)>0)

    <section>
        <div class="container com-sp">
    <div class="row"></div>
    <div class="row">
      @foreach($Topics as $key=> $Item)
        @if($key>=0 && $key<3)
        <div class="col-md-6 col-lg-6">
            <a href="#" class="teaser-b" title="{!! $Item->$title_var !!}">
                <div class="teaser-image"><img src="{{ Helper::FilterImage($Item->photo_file) }}" width="360" height="270" alt="{!! $Item->$title_var !!}" /></div>
                <div class="teaser-wrapper">
                    <div class="teaser-header"><h3>{!! $Item->$title_var !!}</h3></div>
                    <div class="teaser-body">{!! $Item->$details_var !!}.</div>
                </div>
            </a>
        </div>
         @endif
        @endforeach
        
         
    </div>
</div>

</section>
 
 <?php 
//dd($Topics[3]->title_ar);
 ?>

  @foreach($Topics as $key=> $Item)

    @if($key>=3)

      @if($key%2==0)
<section class="section-text has-padding-m has-color-grey align-left">
    <div id="c2879" class="anchor"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-12">
                <div class="section-text__text align-left">
                    <div class="section-text__text--header"><h3 class="h3">{!! $Item->$title_var !!}</h3></div>
                    <div class="section-text__text--body">
                       {!! $Item->$details_var !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-12">
                <div class="section-text__image align-center">
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Item->photo_file) }}" width="720" height="364" alt="{!! $Item->$title_var !!}" /></div>
                </div>
            </div>
        </div>
    </div>
</section>
  @else
         <section class="section-text has-padding-m ">
 
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-12 order-first">
                <div class="section-text__image align-center">
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Item->photo_file) }}" width="720"  alt="{!! $Item->$title_var !!}" /></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-12">
                <div class="section-text__text align-left">
                    <div class="section-text__text--header"><h3 class="h3">{!! $Item->$title_var !!}</h3></div>
                    <div class="section-text__text--body">
                          {!! $Item->$details_var !!}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>



@endif


  @endif
@endforeach


@endif
 