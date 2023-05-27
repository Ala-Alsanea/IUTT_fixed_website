<meta charset="utf-8">
<title>{{ $PageTitle }} {{ $PageTitle != '' ? '|' : '' }}
    {{ Helper::GeneralSiteSettings('site_title_' . trans('backLang.boxCode')) }}</title>
<meta name="description" content="{{ $PageDescription }}" />
<meta name="keywords" content="{{ $PageKeywords }}" />
<meta name="author" content="{{ URL::to('') }}" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
{{--     <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
<link rel="stylesheet" href="{{ asset('plugins/css/font-awesome.min.css') }}">
<!-- ALL CSS FILES -->
{{--     <link href="{{ asset('plugins/css/materialize.css') }}" rel="stylesheet"> --}}
<link href="{{ asset('plugins/css/bootstrap.css') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/vendors/owl-carousel/assets/owl.carousel.min.css') }}">
@yield('vendorInclude')
<link href="{{ asset('plugins/css/style.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/css/customfotter.css') }}" rel="stylesheet" />
<!--     <link href="plugins/css/custommenu.css" rel="stylesheet" /> -->
<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
<link href="{{ asset('plugins/css/style-mob.css') }}" rel="stylesheet" />


<link href="{{ asset('plugins/css/custom.css') }}" rel="stylesheet" />
@yield('styleInclude')

@if (trans('backLang.direction') == 'rtl')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/rtl.css') }}">
@endif


<style>
    .ed-mm-right {
        right: 12px;
        width: 50%;
        position: absolute;
        top: 4px;
    }

    @media (max-width: 500px) {
        .wed-logo a img {
            max-width: 85%;
            padding: 0;
            padding-top: 9px;
        }

        .onlydesk {
            display: none;
        }
    }
</style>
<!-- Favicon and Touch Icons -->
{{-- @if (Helper::GeneralSiteSettings('style_fav') != '') --}}
<link href="{{ Helper::FilterImage(Helper::GeneralSiteSettings('style_fav')) }}" rel="shortcut icon" type="image/png">
{{-- @else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="shortcut icon" type="image/png">
@endif --}}
@if (Helper::GeneralSiteSettings('style_apple') != '')
    <link href="{{ Helper::FilterImage(Helper::GeneralSiteSettings('style_apple')) }}" rel="apple-touch-icon">
    <link href="{{ Helper::FilterImage(Helper::GeneralSiteSettings('style_apple')) }}" rel="apple-touch-icon"
        sizes="72x72">
    <link href="{{ Helper::FilterImage(Helper::GeneralSiteSettings('style_apple')) }}" rel="apple-touch-icon"
        sizes="114x114">
    <link href="{{ Helper::FilterImage(Helper::GeneralSiteSettings('style_apple')) }}" rel="apple-touch-icon"
        sizes="144x144">
@else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="144x144">
@endif
