


    <!--Import jQuery before materialize.js-->
    <script src="{{secure_asset('plugins/js/main.min.js') }}"></script>
    <script src="{{secure_asset('plugins/js/bootstrap.min.js') }}"></script>
    <script src="{{secure_asset('plugins/js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{secure_asset('plugins/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{secure_asset('plugins/js/jquery.counterup.min.js') }}"></script>
    <script src="{{secure_asset('plugins/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{secure_asset('plugins/js/Functions.js') }}"></script>
    <script src="{{secure_asset('plugins/js/custom.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function(){


        $('.text-block__text').click(function(){
            $(this).toggleClass('active');
        });
    });
</script>
</body>

</html>



<?php
if($PageTitle==""){
    $PageTitle = Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode'));
}
?>
{!! Helper::SaveVisitorInfo($PageTitle) !!}
