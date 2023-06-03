<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    @include('frontEnd.includes.head')
 {{--    @include('frontEnd.includes.colors') --}}
</head>

  
<body lang="{{ trans('backLang.code') }}"  class="js {{ trans('backLang.direction') }}"  dir="{{ trans('backLang.direction') }}">
 
    <!-- start header -->
    
    @include('frontEnd.includes.MenuParent')
            <!-- end header -->

    <!-- Content Section -->
    @yield('content')
            <!-- end of Content Section -->

    <!-- start footer -->
    @include('frontEnd.includes.footer')
            <!-- end footer -->
 
@include('frontEnd.includes.foot')
@yield('footerInclude')

@if(Helper::GeneralSiteSettings("style_preload"))
    <div id="preloader"></div>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(window).load(function () {
                $('#preloader').fadeOut('slow', function () {
                    // $(this).remove();
                });
            });
        });
    </script>
@endif
</body>
</html>