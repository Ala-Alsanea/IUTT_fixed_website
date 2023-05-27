 <?php 
$listRelatdFaculty=array('facultiesslider','fstudents');
  $existfaculty=false;
if(in_array($WebmasterSection->name,$listRelatdFaculty)){
$existfaculty=true;
}
?>

  <li class="nav-item inline">
                    <a class="nav-link {{ $tab_1 }}" href data-toggle="tab" data-target="#tab_details">
                        <span class="text-md"><i class="material-icons">
                                &#xe31e;</i> {{ trans('backLang.topicTabDetails') }}</span>
                    </a>
                </li>
           @if(!$existfaculty)
                @if($WebmasterSection->multi_images_status)
                    <li class="nav-item inline">
                        <a class="nav-link  {{ $tab_3 }}" href data-toggle="tab" data-target="#tab_photos">
                    <span class="text-md"><i class="material-icons">
                            &#xe251;</i>
                        {{ trans('backLang.topicAdditionalPhotos') }}
                        @if(count($Topics->photos)>0)
                            <span class="label rounded">{{ count($Topics->photos) }}</span>
                        @endif
                    </span>
                        </a>
                    </li>
                @endif


                @if($WebmasterSection->extra_attach_file_status)
                    <li class="nav-item inline">
                        <a class="nav-link  {{ $tab_6 }}" href data-toggle="tab" data-target="#tab_files">
                    <span class="text-md"><i class="material-icons">
                            &#xe226;</i> {{ trans('backLang.additionalFiles') }}
                        @if(count((array)$Topics->attachFiles)>0)
                            <span class="label rounded">{{ count((array)$Topics->attachFiles) }}</span>
                        @endif
                    </span>
                        </a>
                    </li>
                @endif

                @if($WebmasterSection->comments_status)
                    <li class="nav-item inline">
                        <a class="nav-link  {{ $tab_4 }}" href data-toggle="tab" data-target="#tab_comments">
                    <span class="text-md"><i class="material-icons">
                            &#xe0b9;</i> {{ trans('backLang.comments') }}
                        @if(count((array)$Topics->comments)>0)
                            <span class="label rounded">{{ count((array)$Topics->comments) }}</span>
                        @endif
                    </span>
                        </a>
                    </li>
                @endif

             @if (Session::has('mapST') && $Topics->id==2)
                @if($WebmasterSection->maps_status)
                    <li class="nav-item inline">
                        <a class="nav-link  {{ $tab_5 }}" id="mapTabLink" href data-toggle="tab"
                           data-target="#tab_maps">
                    <span class="text-md"><i class="material-icons">
                            &#xe0c8;</i> {{ trans('backLang.topicGoogleMaps') }}
                        @if(count((array)$Topics->maps)>0)
                            <span class="label rounded">{{ count((array)$Topics->maps) }}</span>
                        @endif
                    </span>
                        </a>
                    </li>
                @endif
                 @endif
                @if($WebmasterSection->related_status)
                    <li class="nav-item inline">
                        <a class="nav-link  {{ $tab_7 }}" href data-toggle="tab" data-target="#tab_related">
                    <span class="text-md"><i class="material-icons">
                            &#xe867;</i> {{ trans('backLang.relatedTopics') }}
                        @if(count((array)$Topics->relatedTopics)>0)
                            <span class="label rounded">{{ count((array)$Topics->relatedTopics) }}</span>
                        @endif
                    </span>
                        </a>
                    </li>
                @endif

                @if(Helper::GeneralWebmasterSettings("seo_status"))
                    <li class="nav-item inline">
                        <a class="nav-link  {{ $tab_2 }}" href data-toggle="tab" data-target="#tab_seo">
                    <span class="text-md"><i class="material-icons">
                            &#xe8e5;</i> {{ trans('backLang.seoTabTitle') }}</span>
                        </a>
                    </li>
                @endif

           @endif