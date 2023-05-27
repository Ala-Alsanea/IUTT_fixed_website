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

 

             
        
             

          

           @endif