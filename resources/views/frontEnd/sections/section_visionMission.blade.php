  @if(count((array)$Topics)>0)
 <section>
        <div class="container com-sp pad-bot-70">
            <div class="row">
                <div class="ed-about-tit">
                        <div class="con-title">
                            <h2>{{ $title }}</h2>
                            
                        </div>
                    </div>
            </div>
        </div>
    </section>

  @foreach($Topics as $key=> $Item)

   

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
@endforeach


@else



        <section class="process_area bg_color sec_pad about">
            <br><br>
         <div class="row">
                            <div class="col-sm-12">
                                <div class=" p-a text-center ">
                                    {{ trans('backLang.noData') }}
                                    <br>
                                    <br>
                                     
                                       
                                   
                                </div>
                            </div>
            </div>
        </section>


 

 





   @endif