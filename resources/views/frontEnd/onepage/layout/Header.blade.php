<meta charset="utf-8">
<title>{{$PageTitle}} {{($PageTitle !="")? "|":""}} {{ Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode')) }}</title>
<meta name="description" content="{{$PageDescription}}"/>
<meta name="keywords" content="{{$PageKeywords}}"/>
<meta name="author" content="{{ URL::to('') }}"/>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
{{--     <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

<link rel="stylesheet" href="{{asset('plugins/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/bootstrap-selector/css/bootstrap-select.min.css') }}" />

        <link rel="stylesheet" href="{{asset('plugins/vendors/themify-icon/themify-icons.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/flaticon/flaticon.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/animation/animate.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/owl-carousel/assets/owl.carousel.min.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/slick/slick.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/slick/slick-theme.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/magnify-pop/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/nice-select/nice-select.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/scroll/jquery.mCustomScrollbar.min.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/vendors/elagent/style.css') }}" />
          <link rel="stylesheet" href="{{asset('plugins/css/reImageGrid.css') }}">
        <link rel="stylesheet" href="{{asset('plugins/css/style-onepage.css') }}" />
        <link rel="stylesheet" href="{{asset('plugins/css/custom-onepage.css') }}" />

        <link rel="stylesheet" href="{{asset('plugins/css/responsive-onepage.css') }}" />

            <script src="{{asset('plugins/js/modernizr-2.8.3.min.js') }}" type="text/javascript"></script>
@yield('styleInclude')

    @if(trans('backLang.direction')=='rtl')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/css/rtl.css') }}">
     @endif


<!-- Favicon and Touch Icons -->
@if(Helper::GeneralSiteSettings("style_fav") !="")
    <link href="{{Helper::FilterImage( Helper::GeneralSiteSettings("style_fav")) }}" rel="shortcut icon"
          type="image/png">
@else
    <link href="{{ asset('uploads/settings/nofav.png') }}" rel="shortcut icon" type="image/png">
@endif
@if(Helper::GeneralSiteSettings("style_apple") !="")
    <link href="{{Helper::FilterImage(Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon">
    <link href="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="72x72">
    <link href="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="114x114">
    <link href="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="144x144">
@else
    <link href="{{ asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="144x144">
@endif
