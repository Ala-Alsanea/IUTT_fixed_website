
<script type="text/javascript">
    var public_lang = "{{ trans('backLang.calendarLanguage') }}"; // this is a public var used in app.html.js to define path to js files
    var public_folder_path = "{{ URL::to('') }}"; // this is a public var used in app.html.js to define path to js files
</script>

<script src="{{ secure_asset('plugins/backEnd/scripts/app.html.js') }}"></script>
<script type="text/javascript" src="{{secure_asset('plugins/backEnd/libs/jquery/summernote/dist/summernote-lite.min.js') }}"></script>
<script type="text/javascript" src="{{secure_asset('plugins/backEnd/libs/jquery/summernote/dist/plugin/table/summernote-ext-table.js') }}"></script>
<script src="{{ secure_asset('plugins/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}"></script>
<script src="{{ secure_asset('plugins/assets/global/plugins/fancybox/source/jquery.fancybox.js') }}"></script>
<script src="{{secure_asset('plugins/assets/global/plugins/tables/datatable/js/datatables.min.js')}}"></script>
<script src="{{secure_asset('plugins/assets/global/plugins/tables/datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{secure_asset('plugins/assets/global/plugins/tables/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{secure_asset('plugins/assets/global/plugins/tables/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{secure_asset('plugins/assets/global/plugins/tables/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{secure_asset('plugins/assets/global/plugins/tables/datatable/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{secure_asset('plugins/assets/global/plugins/tables/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{secure_asset('plugins/assets/global/plugins/tables/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{secure_asset('plugins/assets/global/plugins/tables/datatable/js/datatable.js')}}"></script>



  <script src="{{secure_asset('plugins/assets/global/plugins/fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{secure_asset('plugins/assets/global/plugins/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{secure_asset('plugins/assets/global/plugins/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>


<script src="{{ secure_asset('plugins/js/custome.js') }}"></script>
<script src="{{ secure_asset('plugins/assets/global/js/App.js') }}"></script>
{{-- <script src="{{ secure_asset('plugins/backEnd/libs/jquery/summernote/dist/lang/summernote-ar-AR.js') }}"></script> --}}
{!! Helper::SaveVisitorInfo("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") !!}


<script type="text/javascript">

jQuery(document).ready(function() {

	   var  NamehtisPage=$('body').attr('Page');
     //$('.scroll.nav-active-primary  li#active').addClass('active');
    // $('.scroll.nav-active-primary  li#'+NamehtisPage).addClass('active');
     // $('.scroll.nav-active-primary  li .nav-sub li#'+NamehtisPage).addClass('active');

            $('.scroll.nav-active-primary  li .nav-sub li.active').parents('li').each(function () {
                $(this).addClass('active');
                 // $('.page-sidebar-menu > li.active > a > span').addClass('open');
                // $(this).children('a > span.arrow').addClass('open');

            });

});

</script>
