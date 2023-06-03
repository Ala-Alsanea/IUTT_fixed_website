
@extends('frontEnd.layout')

@section('content')
 
  <?php
 $category_title_var = "title_" . trans('backbackLang.boxCode');
    $title_var = "title_" . trans('backLang.boxCode');
    $title_var2 = "title_" . trans('backLang.boxCodeOther');
    $details_var = "details_" . trans('backLang.boxCode');
    $details_var2 = "details_" . trans('backLang.boxCodeOther');
$title='';
$details='';
 $backgroundImage="uploads/banar.jpg";
    if ($type_page=='topic') {
          
           if ($Topic->$title_var != "") {
                    $title = $Topic->$title_var;
                } else {
                    $title = $Topic->$title_var2;
                }
                if ($Topic->$details_var != "") {
                    $details = $details_var;
                } else {
                    $details = $details_var2;
                }
       if (isset($Topic->fields) && isset($Topic->fields[0])) {
         $backgroundImage=$Topic->fields[0]->field_value;
     }

    }else{
           
            if ($SectionPage->$title_var != "") {
                    $title = $SectionPage->$title_var;
                } else {
                    $title = $SectionPage->$title_var2;
                }
                if ($SectionPage->$details_var!= "") {
                    $details = $SectionPage->$details_var;
                } else {
                    $details = $details_var2;
                }
       $backgroundImage=$SectionPage->photo;
    }
   
    

    //dd($thisDetailMenu->parentMenus->);
    //  dd($Topic);
    //  dd($Topics);
   
    
   
    ?>

    
<section>
  <div class="page-title head-1" style="background-image: url({{ Helper::FilterImage($backgroundImage) }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ $title }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{ route("Home") }}">{{ trans('frontLang.Home') }}</a></li>
                                 @if(isset($thisDetailMenu->parentMenus) && isset($thisDetailMenu->parentMenus->$title_var))
                                       
                                       <li><a>{{ $thisDetailMenu->parentMenus->$title_var }}</a></li>

                                       

                                      @endif
                                  
                                  <li class="active">{{ $title }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <section>
 <div class="container com-sp">
   
    <div class="row">
        <div class="col-md-12">
            <div class="section-text__text align-center">
                <div class="section-text__text--header"><h2 class="h2">{{ $title }}</h2></div>
                <div class="section-text__text--body">
                     {!! $details !!}
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
        <div class="col-md-6 col-lg-4">
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
 @if(isset($Topics[3]))
 <?php 
//dd($Topics[3]->title_ar);
 ?>
<section class="section-text has-padding-m has-color-grey align-left">
    <div id="c2879" class="anchor"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-12">
                <div class="section-text__text align-left">
                    <div class="section-text__text--header"><h3 class="h3">{!! $Topics[3]->$title_var !!}</h3></div>
                    <div class="section-text__text--body">
                       {!! $Topics[3]->$details_var !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-12">
                <div class="section-text__image align-center">
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Topics[3]->photo_file) }}" width="720" height="364" alt="{!! $Topics[3]->$title_var !!}" /></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endif
 @if(isset($Topics[4]))
 
 <section class="section-text has-padding-m ">
 
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-12 order-first">
                <div class="section-text__image align-center">
                    <div class="section-text__image-wrap"><img src="{{ Helper::FilterImage($Topics[4]->photo_file) }}" width="720" height="300" alt="{!! $Topics[4]->$title_var !!}" /></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-12">
                <div class="section-text__text align-left">
                    <div class="section-text__text--header"><h3 class="h3">{!! $Topics[4]->$title_var !!}</h3></div>
                    <div class="section-text__text--body">
                          {!! $Topics[4]->$details_var !!}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

@endif
 


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

 



 
 

   
@endsection
 
 

   
  
 