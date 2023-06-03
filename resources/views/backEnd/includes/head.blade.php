
<meta charset="utf-8"/>
<title>{{ trans('backLang.control') }} | {{ Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode')) }}</title>
<meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- for ios 7 style, multi-resolution icon of 152x152 -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
<link rel="apple-touch-icon" href="{{ asset('plugins/backEnd/assets/images/faveicon.png') }}">
<meta name="apple-mobile-web-app-title" content="Flatkit">
<!-- for Chrome on Android, multi-resolution icon of 196x196 -->
<meta name="mobile-web-app-capable" content="yes">
<link rel="shortcut icon" sizes="196x196" href="{{ asset('plugins/backEnd/assets/images/faveicon.png') }}">

<!-- style -->

{{--  <link rel="stylesheet" type="text/css" href="{{asset('plugins/assets/global/plugins/vendors/css/vendors-'.trans("backLang.direction").'.min.css')}}"> --}}
<link rel="stylesheet" href="{{ asset('plugins/assets/global/plugins/fonts/boxicons/css/boxicons.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('plugins/assets/global/plugins/fonts/flag-icon-css/css/flag-icon.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('plugins/backEnd/assets/animate.css/animate.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('plugins/backEnd/assets/glyphicons/glyphicons.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('plugins/backEnd/assets/font-awesome/css/font-awesome.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('plugins/backEnd/assets/material-design-icons/material-design-icons.css') }}" type="text/css">


<link rel="stylesheet" href="{{ asset('plugins/backEnd/assets/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css"/>
{{-- <link rel="stylesheet" type="text/css" href="{{asset('plugins/backEnd/libs/jquery/summernote/dist/summernote-lite.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/backEnd/libs/jquery/summernote/dist/plugin/table/summernote-ext-table.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('plugins/backEnd/assets/styles/app.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/assets/global/plugins/fancybox/source/jquery.fancybox.css') }}"
      type="text/css"/>

      <link rel="stylesheet" href="{{ asset('plugins/assets/global/plugins/tables/datatable/css/datatables.min.css') }}" type="text/css"/>
{{-- <link rel="stylesheet" href="{{ asset('plugins/assets/thame/dark.css') }}" type="text/css"/> --}}

<link rel="stylesheet" href="{{ asset('plugins/backEnd/assets/styles/font.css') }}" type="text/css"/>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@if( trans('backLang.direction')=="rtl")
    <link rel="stylesheet" href="{{ asset('plugins/backEnd/assets/styles/rtl.css') }}">
@endif

<link rel="stylesheet" href="{{ asset('plugins/backEnd/custom/custom.css') }}" type="text/css"/>

<link href="{{ asset('plugins/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
