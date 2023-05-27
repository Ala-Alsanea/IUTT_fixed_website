   <footer class="footer_area f_bg">
           
                <div class="footer_bottom">
                    <div class="container">
                        <div class="row align-items-center copy-right">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                  <?php
                        $site_title_var = "site_title_" . trans('backLang.boxCode');
                        ?>
                     <p class="mb-0 f_400">   &copy; <?php echo date("Y") ?> {{ trans('frontLang.AllRightsReserved') }}
                        .<a>{{$WebsiteSettings->$site_title_var}} </a>{{ trans('backLang.designedby') }}<a target="_blank" href="http://techsoft-ye.com/"> Techsoft</a></p>

 
                            </div> 
                        </div>
                    </div>
                </div>
            </footer>