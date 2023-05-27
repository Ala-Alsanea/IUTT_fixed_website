   <?php
// Current Full URL
$fullPagePath = Request::url();
// Char Count of Backend folder Plus 1
$envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
// URL after Root Path EX: admin/home
$urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
?>
<?php
$category_title_var = "title_" . trans('backbackLang.boxCode');
$slug_var = "seo_url_slug_" . trans('backbackLang.boxCode');
$slug_var2 = "seo_url_slug_" . trans('backbackLang.boxCodeOther');
?>
<!-- LOGO AND MENU SECTION -->
<div class="top-logo" data-spy="affix" data-offset-top="250">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="wed-logo" dir="{{ trans('backbackLang.direction') }}">
     <a class="logo" href="{{ route("Home") }}">
@if(Helper::GeneralSiteSettings("style_logo_".trans('backLang.boxCode')) !="" )
<img alt=""
     src="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode'))) }}" srcset="{{ Helper::FilterImage(Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode'))) }}" class="wed-logo-section">


@else
<img alt="" src="{{ URL::to('uploads/settings/nologo.png') }}" srcset="{{ URL::to('uploads/settings/nologo.png') }}" class="wed-logo-section">
@endif
    
</div>
<div class="main-menu">
    <ul>
        
        <li class="about-menu">
            <a href="#" class="mm-arr"><i class="fa fa-th" style='padding: 3px;'></i> {{ trans('frontLang.University') }} </a>
            <!-- MEGA MENU 1 -->
<div class="mm-pos">
    <div class="about-mm m-menu">
         <div class="m-menu-inn row">
                        <div class="mm1-com mm1-s1 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="ed-course-in">
                                <a class="course-overlay menu-about" href="#">
                                    <img src="{{ Helper::getBannerStatic('Banner_menu_about') }}" style="box-shadow: 0px 7px 12px -4px rgba(0, 0, 0, 0.45);">
                             
                                </a>
                            </div>
                        </div>


                  <div class="mm1-com mm1-s3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <h4 class="m-header">{{ trans('frontLang.About_University') }}</h4>
                            <ul>
                     <li><a  href="page/welcome">{{ trans('frontLang.Welcome') }}</a></li>
                       <li><a  href="History.php">{{ trans('frontLang.History') }} </a></li>
                        <li><a  href="Vision.php">{{ trans('frontLang.Vision_Mission') }}</a></li>
                         <li><a href="Facts.php">{{ trans('frontLang.Facts_Highlights') }}</a></li>
                            <li><a href="Facts.php">{{ trans('frontLang.Strategic_Goals') }}</a></li>
                             <li><a  href="#">{{ trans('frontLang.Strategic_Plan') }}</a></li>                                         
                                   <li><a  href="History.php">{{ trans('frontLang.UITT_Awards') }}</a></li>
                                   <li><a href="International-Relations.php">{{ trans('frontLang.International_Relations') }}</a></li>
                            </ul>
                        </div>
                       
                       
             

                       <div class="mm1-com mm1-s3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <h4 class="m-header">{{ trans('frontLang.Presidency_University') }} </h4>
                            <ul>
                       <li><a href="president.php">{{ trans('frontLang.Universitys_President') }}</a></li>
                         <li><a href="president.php">{{ trans('frontLang.Board_Trustees') }} </a></li>
                         <li><a href="president.php">{{ trans('frontLang.General_Secretary') }}</a></li>
                        <li><a href="president.php">{{ trans('frontLang.University_Vice_President') }}</a></li>
                       
                          <li><a href="Organizational-Structure.php">{{ trans('frontLang.Organizational_Structure') }}</a></li>
                          <li><a  href="#">{{ trans('frontLang.Administration_Staff') }}</a></li>
                          <li><a  href="1-visual-identity-and-branding-guidelines.php">{{ trans('frontLang.BRAND_GUIDELINES') }}</a></li>
                       
                        
                        
                                
                            </ul>
                        </div>

                    <div class="mm1-com mm1-s3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <h4 class="m-header">{{ trans('frontLang.University_Centers') }}</h4>
                            <ul>
                     <li><a href="Quality.php"> {{ trans('frontLang.Quality_Assurance') }}</a></li>
                     <li><a href="#">{{ trans('frontLang.Language_Center') }}</a></li>
                       <li><a href="#">{{ trans('frontLang.IT_Center') }}</a></li>
                          <li><a href="#">{{ trans('frontLang.Research_Center') }}</a></li>
                         
                          <li><a href="#">{{ trans('frontLang.Industrial_Training') }}   </a></li>
                          <li><a href="#">{{ trans('frontLang.Training_Conditions') }}  </a></li>
                           
                            </ul>
                        </div>



                    </div>
                </div>
            </div>
        </li>

     <li class="academics-menu">
            <a href="#" class="mm-arr">{{ trans('frontLang.Academics') }}</a>
            <!-- MEGA MENU 1 -->
<div class="mm-pos ">
       <div class="academics-mm m-menu">
           <div class="m-menu-inn row">
        <div class="mm1-com mm1-s1 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="ed-course-in">
              <a class="course-overlay menu-about" href="#">
                  <img src="{{ Helper::getBannerStatic('Banner_menu_academics') }}" style="box-shadow: 0px 7px 12px -4px rgba(0, 0, 0, 0.45);">
                
              </a>
          </div>
      </div>                 
                       
<div class="mm1-com mm1-s3 col-xl-3  col-lg-4 col-md-4 col-sm-4 col-xs-12">
<h4 class="m-header">{{ trans('frontLang.Faculties') }}</h4>
   <ul>
      <li><a href="Colleges.php" class="">Business & Finance</a></li>
      <li><a href="Colleges.php" class="">Multimedia and Creative Technology</a></li>
      <li><a href="Colleges.php" class="">Computer Science and Information</a></li>
      <li><a href="Colleges.php" class="">Engineering</a></li> 
        </ul> 
          <!-- <a  href="#" class="mm-r-m-btn-cust">Read More</a>   -->

</div>
  <div class="mm1-com mm1-s3 col-xl-3  col-lg-4 col-md-4 col-sm-4 col-xs-12">
         <h4 class="m-header">{{ trans('frontLang.Programs') }}</h4>
        <ul>
            <li><a href="1-undergraduate-programs.php">{{ trans('frontLang.undergraduate_programs') }}</a></li>
             <li><a href="1-graduate-programs.php">{{ trans('frontLang.graduate_programs') }}</a></li>
             <li><a href="#">{{ trans('frontLang.Educational_system') }}</a></li>
        </ul>
    </div>



                    </div>
                </div>
            </div>
        </li>

<li class="admi-menu">
<a href="Admissions.php" class="mm-arr">{{ trans('frontLang.Admission') }}</a>
<!-- MEGA MENU 1 -->
<div class="mm-pos">
  <div class="admi-mm m-menu">
      <div class="m-menu-inn row">
            <div class="mm1-com mm1-s1 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="ed-course-in">
                  <a class="course-overlay menu-about" href="#">
                      <img src="{{ Helper::getBannerStatic('Banner_menu_Admission') }}" style="box-shadow: 0px 7px 12px -4px rgba(0, 0, 0, 0.45);">
                    
                  </a>
              </div>
          </div>
      <div class="mm1-com mm1-s3 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <h4 class="m-header"><a href="1-undergraduate-programs.php">{{ trans('frontLang.Undergraduate_Studies') }}</a> </h4>  
        
              <ul>
          <li><a href="AdmissionGuide.php">{{ trans('frontLang.Admission_Guide') }} </a></li>
          <li><a href="AdmissionRequirements.php">{{ trans('frontLang.Admission_Requirments') }}</a></li>
           <li><a href="ProgramsOfStudy.php">{{ trans('frontLang.Study_Programs') }} </a></li>
              
                  <li><a href="TermsAdmission.php">{{ trans('frontLang.Terms_Admission') }}</a></li>
                  <li><a href="CourseEquivalence.php">{{ trans('frontLang.Course_Equivalence') }}</a></li>
                 
                  <li><a href="#">{{ trans('frontLang.Programs_Fees') }}</a></li>
                  <li><a href="FAQadmis.php">{{ trans('frontLang.FAQ_Contact') }}</a></li>
                                                     
          
                 
              </ul>
              <a  href="Apply_now.php" class="mm-r-m-btn-cust">{{ trans('frontLang.Apply_Now') }}</a>
          </div>
        
           <div class="mm1-com mm1-s3 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <h4 class="m-header"><a href="1-graduate-programs.php">{{ trans('frontLang.Graduate_Studies') }}</a> </h4>  
              <ul>
              <li><a href="AdmissionGuide.php">{{ trans('frontLang.Enrolment_Procedures') }} </a></li>
          <li><a href="AdmissionRequirements.php">{{ trans('frontLang.Admission_Requirments') }}</a></li>
           <li><a href="ProgramsOfStudy.php">{{ trans('frontLang.Study_Programs') }}</a></li>
              
                  <li><a href="TermsAdmission.php">{{ trans('frontLang.Terms_Admission') }}</a></li>
                  <li><a href="CourseEquivalence.php">{{ trans('frontLang.Course_Equivalence') }}</a></li>
                 
                  <li><a href="#">{{ trans('frontLang.Programs_Fees') }}</a></li>
                  <li><a href="FAQadmis.php">{{ trans('frontLang.FAQ_Contact') }}</a></li>
                                                     
          
                 
                                                                               
          
                 
              </ul>
              <a  href="Apply_now.php" class="mm-r-m-btn-cust">{{ trans('frontLang.Apply_Now') }}</a>
          </div>

      </div>
  </div>
</div>
</li>
    <li class="student-menu">
            <a href="#" class="mm-arr">{{ trans('frontLang.Students') }}</a>
            <!-- MEGA MENU 1 -->
            <div class="mm-pos">
                <div class="student-mm m-menu">
                    <div class="m-menu-inn row">
                          <div class="mm1-com mm1-s1 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="ed-course-in">
                                <a class="course-overlay menu-about" href="#">
                                    <img src="{{ Helper::getBannerStatic('students_services_banner') }}" alt="{{ trans('frontLang.students_services') }}">
                                    <span>{{ trans('frontLang.Academics') }}</span>
                                </a>
                            </div>
                        </div>
                    <div class="mm1-com mm1-s3 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                       <h4 class="m-header">{{ trans('frontLang.students_services') }}</h4>  
                            <ul>
                                 <li><a  href="Calendar.php">{{ trans('frontLang.Calendar') }}</a></li>
                                 <li><a  href="time-line.php">{{ trans('frontLang.lecturer_table') }}</a></li>
                                   <li><a  href="#">{{ trans('frontLang.exams_schedule') }}</a></li>
                       
                             
                                <li><a  href="StudentsServices.php">{{ trans('frontLang.students_services') }}</a></li>
                                <li><a target="_blank" href="announcements.php">{{ trans('frontLang.announcements') }}</a></li>
                                <li><a  href="#">{{ trans('frontLang.course_schedule') }}</a></li>
                               
                                </ul>
                        </div>
                          <div class="mm1-com mm1-s3 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                       <h4 class="m-header">{{ trans('frontLang.Students_Activities') }}</h4>  
                            <ul>
                                 <li><a  href="#">{{ trans('frontLang.Students_Activities') }} </a></li>
                                  <li><a  href="#">{{ trans('frontLang.Annual_Exam') }}</a></li>
                               
                                </ul>
                        </div>
                      
                         <div class="mm1-com mm1-s3 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                              <h4 class="m-header">{{ trans('frontLang.Students_Portal') }} </h4>  
                      <ul>
                      <li><a href="#">{{ trans('frontLang.UITT Library') }}</a></li>
                          <li><a  href="#">{{ trans('frontLang.E-eLearning') }}</a></li>
                          <li><a  href="#">{{ trans('frontLang.E-Library') }} </a></li>
                               
                                                                                             
                        
                               
                            </ul>
                            
                        </div>

                    </div>
                </div>
            </div>
        </li>
     <li class="media-menu">
            <a href="#" class="mm-arr">{{ trans('frontLang.campus_life') }} </a>
            <!-- MEGA MENU 1 -->
            <div class="mm-pos">
                <div class="media-mm m-menu">
                    <div class="m-menu-inn row">
                          <div class="mm1-com mm1-s1 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="ed-course-in">
                                <a class="course-overlay menu-about" href="#">
                                    <img src="{{ Helper::getBannerStatic('campus_life_banner') }}" alt="{{ trans('frontLang.campus_life') }}">
                                    <span>{{ trans('frontLang.campus_life') }}</span>
                                </a>
                            </div>
                        </div>
                    <div class="mm1-com mm1-s3 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                     <!--   <h4 class="m-header">Undergraduate</h4>   -->
                  <ul>
                    <li><a href="Photo.php">{{ trans('frontLang.Pictures') }}</a></li>
                    <li><a href="#">{{ trans('frontLang.video_library') }} </a></li>
                    <li><a href="#">{{ trans('frontLang.download_center') }}</a></li>
                    </ul>
                   
                        </div>
                      
                         <div class="mm1-com mm1-s3 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                           <!--    <h4 class="m-header">Graduate</h4>   -->
                      <ul>
                          <li><a  href="blog.php">{!!  trans('backLang.news') !!}</a></li>
                          <li><a  href="event.php">{!!  trans('frontLang.Events_Activities') !!} </a></li>
                               
                                                                                             
                        
                               
                            </ul>
                            
                        </div>

                    </div>
                </div>
            </div>
        </li>
    
    </li>
   
   <li><span class="navbar-text"><i id='morex' class="more fa fal fa-th " aria-hidden="true" title="Quick Menu" style="color: #000;"></i><span class="sr-only">Quick Menu</span></span>

    </li>
    
             <!--    <li> <div class="header_shar">
           <p>
        <a href="tel:(+967-1) 427570/1" class="ico1">
            <label for="">(+967-1) 427570/1 </label>
        </a>
        <a href="" class="ico2">
            <img src="plugins/img/shar/qr-1.jpg" alt="">
        </a>
        <a href="tencent://message/?uin=01427570&amp;Site=qq&amp;Menu=yes" class="ico3" target="_blank"></a>
        <a href="mailto:info@iutt.edu.ye" class="ico4" target="_blank"></a>
    </p>
</div>
            </li> -->
              
        </ul>

      </div>

    </div>

<div class="all-drop-down-menu">
          
        <div class="mega-menu2" style="display:none;">

        @include('frontEnd.includes.Quick-Menu')

        </div>
    </div>

    </div>
    </div>
    </div>