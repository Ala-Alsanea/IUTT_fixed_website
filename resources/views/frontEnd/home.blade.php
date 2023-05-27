@extends('frontEnd.layout')

 

@section('content')
<?php 
$FaLeftIcon='right';
$FaRightIcon='left'; 
if(trans('backLang.boxCode')=='ar'){
$FaLeftIcon='left';
$FaRightIcon='right';
}

?>
<!-- start Home Slider -->
@include('frontEnd.view.slider') 
@include('frontEnd.view.our-services')  
@include('frontEnd.view.Our-News2') 
@include('frontEnd.view.Our-News3') 
@include('frontEnd.view.counting') 
@include('frontEnd.view.why-us') 
<!-- end Home Slider -->
 




@endsection
 