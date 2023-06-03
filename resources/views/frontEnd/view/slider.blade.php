@if (count((array) $SliderBanners) > 0)
    <?php
    $AlingSlider = '';
    if (trans('backLang.direction') == 'ltr') {
        $AlingSlider = 'left';
    } elseif (trans('backLang.direction') == 'rtl') {
        $AlingSlider = 'right';
    }
    $title_var = 'title_' . trans('backLang.boxCode');
    $title_var2 = 'title_' . trans('backLang.boxCodeOther');
    $details_var = 'details_' . trans('backLang.boxCode');
    $details_var2 = 'details_' . trans('backLang.boxCodeOther');
    $slug_var = 'seo_url_slug_' . trans('backLang.boxCode');
    $slug_var2 = 'seo_url_slug_' . trans('backLang.boxCodeOther');
    $file_var = 'file_' . trans('backLang.boxCode');
    $section_url = '';
    ?>
    {{-- <style type="text/css">
.carousel-control{
    left:unset;
    width:100%;
  }
  .left.carousel-control .fa{
  left:5px;
  }
    .right.carousel-control .fa{
  right:5px;
  }
</style> --}}
    <!-- Wrapper for slides -->
    <section>
        <div id="fixed_Carousel" class="carousel slide " data-ride="carousel">

            <div style=" position: relative; z-index: -10;" class="carousel-inner">
                @foreach ($SliderBanners as $key => $SliderBanner)
                    <div class="item  {{ $key == 0 ? 'active' : '' }}">

                        <div style=" position: relative; z-index: -10;">
                            <img src="{{ asset($SliderBanner->$file_var) }}" alt="{{ $SliderBanner->$title_var }}">
                        </div>

                        @if ($SliderBanner->$title_var != '')
                            <div class="carousel-caption slider-con bg-dark">

                                <h2>{{ $SliderBanner->$title_var }}</h2>
                                @if ($SliderBanner->$details_var != '')
                                    <p> {{ nl2br(e($SliderBanner->$details_var), false) }}</p>
                                @endif
                                @if ($SliderBanner->url_link != '' && $SliderBanner->url_link != '#')
                                    <a class="bann-btn-2" href="{{ $SliderBanner->link_url }} ">
                                        {{ trans('frontLang.moreDetails') }}
                                    </a>
                                @endif

                            </div>
                        @endif
                    </div>
                @endforeach

            </div>

            <!-- Left and right controls -->
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>



    </section>
@endif
