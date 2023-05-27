@extends('frontEnd.onepage.layout')

@section('content')
<?php 
 
        $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    $details_var2 = "details_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                     $file_var = "file_" . trans('backLang.boxCode');
                    $section_url = "";
 $backgroundImage="uploads/banar.jpg";
 
?>

 

<style type="text/css">
 
</style>
 



 
  
 <section>
  <div class="page-title head-1" style="background-image: url({{ Helper::getBannerStatic('Banner_news') }});">

        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-8 col-lg-6 page-title-container">
                        <div class="title-column">
                            <h1>{{ $FacultyData->$title_var }}
                            </h1>
                     </div>
                        <div class="breadcrumb-column">
                            <ul class="bread-crumb clearfix">
                              <li><a href="{{ route('FacultyPage',$FacultyData->id) }}">{{ trans('frontLang.Home') }}</a></li>
                   
                    @if(@$WebmasterSection!="none")
                        <li class="active">{!! trans('backLang.'.$WebmasterSection->name) !!}</li>
                    @elseif(@$search_word!="")
                        <li class="active">{{ @$search_word }}</li>
                    @else
                        <li class="active">{{ $User->name }}</li>
                    @endif
                    @if($CurrentCategory!="none")
                        @if(count((array)$CurrentCategory) >0)
                            <?php
                            $category_title_var = "title_" . trans('backLang.boxCode');
                            ?>
                            <li class="active"><i
                                        class="icon-angle-right"></i>{{ $CurrentCategory->$category_title_var }}
                            </li>
                        @endif
                    @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 


 
  
   <!-- NEWS AND EVENTS -->
    <section>
        <div class="container com-sp">
            <div class="row">
                <div class="con-title">
                    <h2> {{ $FacultyData->$title_var }}</h2>
                   
                </div>
            </div>
            <div class="row">
                  @if($Topics->total() == 0)
                    <div class="alert alert-warning">
                        <i class="fa fa-info"></i> &nbsp; {{ trans('frontLang.noData') }}
                    </div>
                @else
              
      <div class="col-md-8">
             
                
                 
                         @if($Topics->total() > 0)
               <div class="ho-event pg-eve-main  news_section ui-newslist">
                 
                     
                        <div class="ho-event">
                            <ul class="row">
                            <?php
                            $title_var = "title_" . trans('backLang.boxCode');
                            $title_var2 = "title_" . trans('backLang.boxCodeOther');
                            $details_var = "details_" . trans('backLang.boxCode');
                            $details_var2 = "details_" . trans('backLang.boxCodeOther');
                            $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                            $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                            $i = 0;
                            ?>
                            @foreach($Topics as $Topic)
                                <?php
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
                                $section = "";
                                try {
                                    if ($Topic->section->$title_var != "") {
                                        $section = $Topic->section->$title_var;
                                    } else {
                                        $section = $Topic->section->$title_var2;
                                    }
                                } catch (Exception $e) {
                                    $section = "";
                                }

                                // set row div
                                if (($i == 1 && count((array)$Categories) > 0) || ($i == 2 && count((array)$Categories) == 0)) {
                                    $i = 0;
                                   // echo "</div><div class='row'>";
                                }
                             

                         $topic_link_url = url(trans('backLang.code').'/'.$FacultyData->id.'/news/faculty/'.$Topic->id);
                      


                                ?>

                
                  
                    
                                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                     <a href="{{ $topic_link_url }}" class="i">
                                        <div class="dt">

             
                                            <p class="p1"> <?php echo date('Y ,M', strtotime($Topic->date)); ?></p>
                                            <p class="p2"><?php  echo date("d", strtotime($Topic->date)); ?></p>
                                        </div>
                                        <div class="hd">
                                            <img src="{{ Helper::FilterImage($Topic->photo_file) }}" alt="{{ $title }}">
                                        </div>
                                        <div class="ct">
                                            <p class="p1">{{ str_limit(strip_tags($title), $limit = 30, $end = '...') }}</p>
                                            <p class="p2">{{ str_limit(strip_tags($Topic->$details), $limit =100, $end = '...') }}</p>
                                            <p class="p3"><label for="">{{ trans('frontLang.readMore') }}</label></p>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                         
                              
                            </ul>
                        </div>
                    </div>
                    @endif
                       <div class="row">
                        <div class="col-lg-8">
                            {!! $Topics->links() !!}
                        </div>
                        <div class="col-lg-4 text-right">
                            <br>
                            <small>{{ $Topics->firstItem() }} - {{ $Topics->lastItem() }} {{ trans('backLang.of') }}
                                ( {{ $Topics->total()  }} ) {{ trans('backLang.records') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                 @include('frontEnd.onepage.layout.blog-sidebar')


                </div>
            </div>
            @endif
        </div>
    </section>
 


   

 
  @endsection
 
 

   
  
 