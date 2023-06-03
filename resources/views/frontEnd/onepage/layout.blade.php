<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    @include('frontEnd.onepage.layout.Header') 
</head>

  
 
        
   

<body lang="{{ trans('backLang.code') }}"  data-spy="scroll" data-target="header" data-offset="80"  class="js {{ trans('backLang.direction') }}"  dir="{{ trans('backLang.direction') }}">
 
    <!-- start header -->
      <div class="body_wrapper">

 @include('frontEnd.onepage.layout.Menu')
    
            <!-- end header -->

    <!-- Content Section -->
    @yield('content')
            <!-- end of Content Section -->

  
  @include('frontEnd.onepage.layout.Footer')

</div>
  @include('frontEnd.onepage.layout.Script')
 


 
</body>
</html>