<?php

namespace App\Http\Controllers;

use App;
use Helper;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Contact;
use App\Http\Requests;
use App\Models\Menu;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\TopicCategory;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Program;
use App\Models\SliderFaculty;
use App\Models\Staff;
use App\Models\Student;
use App\Models\UniversityCenter;
use App\Models\ContentSection;
use App\Models\Webmail;
use App\Models\WebmasterSection;
use App\Models\WebmasterSetting;
use Illuminate\Http\Request;
use Mail;


class FacultiesHomeController extends Controller
{
    public function __construct()
    {
        // Check the website Status
        $WebsiteSettings = Setting::find(1);
        $lang = trans('backLang.boxCode');

        $site_status = $WebsiteSettings->site_status;
        $site_msg = $WebsiteSettings->close_msg;
        if ($site_status == 0) {
            // close the website
            if ($lang == "ar") {
                $site_title = $WebsiteSettings->site_title_ar;
                $site_desc = $WebsiteSettings->site_desc_ar;
                $site_keywords = $WebsiteSettings->site_keywords_ar;
            } else {
                $site_title = $WebsiteSettings->site_title_en;
                $site_desc = $WebsiteSettings->site_desc_en;
                $site_keywords = $WebsiteSettings->site_keywords_en;
            }
            echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"utf-8\">
<title>$site_title</title>
<meta name=\"description\" content=\"$site_desc\"/>
<meta name=\"keywords\" content=\"$site_keywords\"/>
<body>
<br>
<div style='text-align: center;'>
<p>$site_msg</p>
</div>
</body>
</html>
        ";
            exit();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int /string $seo_url_slug
     * @return \Illuminate\Http\Response
     */
    public function SEO($seo_url_slug = 0)
    {
        return $this->SEOByLang("", $seo_url_slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int /string $seo_url_slug
     * @return \Illuminate\Http\Response
     */
    public function SEOByLang($lang = "", $seo_url_slug = 0)
    {
        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }
        $seo_url_slug = str_slug($seo_url_slug, '-');

        switch ($seo_url_slug) {
            case "home" :
                return $this->HomePage();
                break;
            case "about" :
                $id = 1;
                $section = 1;
                return $this->topic($section, $id);
                break;
            case "privacy" :
                $id = 3;
                $section = 1;
                return $this->topic($section, $id);
                break;
            case "terms" :
                $id = 4;
                $section = 1;
                return $this->topic($section, $id);
                break;
        }
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
        $URL_Title = "seo_url_slug_" . trans('backLang.boxCode');

        $WebmasterSection1 = WebmasterSection::where("seo_url_slug_ar", $seo_url_slug)->orwhere("seo_url_slug_en", $seo_url_slug)->first();
        if (count((array)$WebmasterSection1) > 0) {
            // MAIN SITE SECTION
            $section = $WebmasterSection1->id;
            return $this->topics($section, 0);
        } else {
            $WebmasterSection2 = WebmasterSection::where('name', $seo_url_slug)->first();
            if (count((array)$WebmasterSection2) > 0) {
                // MAIN SITE SECTION
                $section = $WebmasterSection2->id;
                return $this->topics($section, 0);
            } else {
                $Section = Section::where('status', 1)->where("seo_url_slug_ar", $seo_url_slug)->orwhere("seo_url_slug_en", $seo_url_slug)->first();
                if (count((array)$Section) > 0) {
                    // SITE Category
                    $section = $Section->webmaster_id;
                    $cat = $Section->id;
                    return $this->topics($section, $cat);
                } else {
                    $Topic = Topic::where('status', 1)->where("seo_url_slug_ar", $seo_url_slug)->orwhere("seo_url_slug_en", $seo_url_slug)->first();
                    if (count((array)$Topic) > 0) {
                        // SITE Topic
                        $section_id = $Topic->webmaster_id;
                        $WebmasterSection = WebmasterSection::find($section_id);
                        $section = $WebmasterSection->name;
                        $id = $Topic->id;
                        return $this->topic($section, $id);
                    } else {
                        // Not found
                        return redirect()->route("HomePage");
                    }
                }
            }
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function HomePageFaculty($id)
    {
        return $this->HomePageFacultyByLang('',$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function HomePageFacultyByLang($lang = "",$id)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }
        $navbar_fixed='';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);


         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(2);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(3);
              //dd($segments);
           }
         // dd($segments);
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');
        $defultFaculty= Faculty::where('status', 1)->first();


      $FacultyData= Faculty::where('status', 1)->with('departments')->with('programs')->with('sliderfaculties')->with('staffs')->with('news')->with('students')->find($id);
        if (count((array)$FacultyData) == 0) {

            return redirect()->route("HomePage");
            // get Webmaster section settings by ID
             //dd($facultyNameSegment);
          //  $Facultyname="title_".trans('backLang.boxCodeOther');
          //  $FacultyData= Faculty::where('status', 1)->where($Facultyname,$facultyNameSegment)->with('departments')->with('programs')->with('sliderfaculties')->with('staffs')->with('news')->with('students')->first();
          //  if (count((array)$FacultyData) == 0) {

          // }
        }




   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);



        // Home topics

        $fatherList=array(0,$FacultyData->id);
        $HomeTopics = Topic::where('status',1)->where('webmaster_id',3)->where('faculty_id',$FacultyData->id)->orderby('row_no', 'desc')->limit(3)->get();
        // Home photos
        $StudentsList = Topic::where([['status', 1], ['webmaster_id',21]])->where('father_id',$FacultyData->id)->orderby('row_no', 'asc')->get();
          if (count((array)$StudentsList)==0) {
            $StudentsList = Topic::where([['status', 1], ['webmaster_id',21]])->where('father_id',$defultFaculty->id)->orderby('row_no', 'asc')->get();
          }


            $SectionFuculty = Topic::where([['status', 1], ['webmaster_id',22]])->where('father_id',$FacultyData->id)->orderby('row_no', 'asc')->get();
          if (count((array)$SectionFuculty)==0) {
            $SectionFuculty = Topic::where([['status', 1], ['webmaster_id',22]])->where('father_id',$defultFaculty->id)->orderby('row_no', 'asc')->get();
          }

        // Get Latest News
        $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->where('faculty_id',$FacultyData->id)->orderby('row_no', 'desc')->limit(3)->get();

        // Get Home page slider banners
     $SliderBanners = Topic::where([['status', 1], ['webmaster_id',20]])->where('father_id',$FacultyData->id)->orderby('row_no', 'asc')->get();
      if (count((array)$SliderBanners)==0) {
              $SliderBanners = Topic::where([['status', 1], ['webmaster_id',20]])->where('father_id',$FacultyData->id)->orderby('row_no', 'asc')->get();
          }


    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');



        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }
                // .. end of .. Page Title, Description, Keywords




        return view("frontEnd.onepage.faculties",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "SectionFuculty",
                "SliderBanners",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "HomeTopics",
                "defultFaculty",
                "FacultyData",
                "ContactUsData",
                "StudentsList",
                "title_var",
                "details_var",
                "file_var",
                "slug_var",
                "navbar_fixed",
                "LatestNews"));

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetDepartments($faculty,$id)
    {
        return $this->GetDepartmentsByLang('',$faculty,$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetDepartmentsByLang($lang = "",$faculty,$id)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(2);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(3);
              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');
        $defultFaculty= Faculty::where('status', 1)->first();

       // dd($facultyNameSegment);




   $department= Department::where('status', 1)->with('faculty')->with('mycontent')->find($id);


    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

        if (count((array)$department) == 0) {
            // get Webmaster section settings by ID
               // if (count((array)$FacultyData)>0) {
               //     return redirect('faculties/'.$FacultyData->$title_var);
               // }
             return redirect()->action('FrontendHomeController@HomePage');
        }

        $FacultyData=$department->faculty;
   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);



        // Home topics

        $fatherList=array(0,$FacultyData->id);




              $quicklinks = Topic::where([['status', 1], ['webmaster_id',10]])->where('father_id',$department->id)->orderby('row_no', 'asc')->get();


           $facultyacademics=$department->staffs;

             $departmentcontents= $department->mycontent;






        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }

               if ($department->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var."|".$department->$seo_title_var;
                } else {
                    $PageTitle = $department->$tpc_title_var;
                }
                if ($department->$seo_description_var != "") {
                    $PageDescription = $department->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($department->$seo_keywords_var != "") {
                    $PageKeywords = $department->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }

                // .. end of .. Page Title, Description, Keywords




        return view("frontEnd.onepage.department",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "department",
                // "SectionFuculty",
                "facultyacademics",
                "departmentcontents",
                "quicklinks",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                // "HomeTopics",
                "defultFaculty",
                "FacultyData",
                "ContactUsData",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
              ));

    }

 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetPrograms($id)
    {
        return $this->GetProgramsByLang('',$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetProgramsByLang($lang = "",$id)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
          $ProgramNameSegment= \Request::segment(2);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
               $ProgramNameSegment= \Request::segment(3);
             // dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Programname="title_".trans('backLang.boxCode');
        //$defultFaculty= Topic::where([['status', 1], ['webmaster_id', $WebmasterSection->id]])->first();

       //dd($fullPagePath);




   $program= Program::where('status', 1)->find($id);


    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

        if (count((array)$program) == 0) {
            // get Webmaster section settings by ID
               // if (count((array)$FacultyData)>0) {
               //     return redirect('faculties/'.$FacultyData->$title_var);
               // }
             return redirect()->action('FrontendHomeController@HomePage');
        }


        $FacultyData=$program->faculty;


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);


              $thisDetailMenu = Menu::where('link',$fullPagePath)->with('parentMenus')->first();


       $quicklinks = Topic::where([['status', 1], ['webmaster_id',10]])->where('father_id',$program->id)->orderby('row_no', 'asc')->get();






        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($program->$seo_title_var != "") {
                    $PageTitle = $program->$seo_title_var;
                } else {
                    $PageTitle = $program->$tpc_title_var;
                }
                if ($program->$seo_description_var != "") {
                    $PageDescription = $program->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($program->$seo_keywords_var != "") {
                    $PageKeywords = $program->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }


                // .. end of .. Page Title, Description, Keywords




        return view("frontEnd.onepage.programs",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "program",
                "FacultyData",
                "thisDetailMenu",
                "quicklinks",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
              ));

    }

    public function facultyAboutUs($id)
    {
        return $this->facultyAboutUsByLang('',$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facultyAboutUsByLang($lang = "",$id)
    {


       if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(2);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(3);
              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');
        $Topic=ContentSection::where('status', 1)->find($id);
 if (count((array)$Topic) == 0) {
          return redirect()->action('FrontendHomeController@HomePage');
        }
       // dd($facultyNameSegment);


    $FacultyData= Faculty::where('status', 1)->find($Topic->faculty_id);





    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');



   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);



        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }

               if ($Topic->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var."|".$Topic->$seo_title_var;
                } else {
                    $PageTitle = $Topic->$tpc_title_var;
                }
                if ($Topic->$seo_description_var != "") {
                    $PageDescription = $Topic->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($Topic->$seo_keywords_var != "") {
                    $PageKeywords = $Topic->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }

                // .. end of .. Page Title, Description, Keywords


        return view("frontEnd.onepage.aboutus",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "Topic",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "FacultyData",
                "ContactUsData",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
              ));
    }

  public function facultyAboutUsPage($id)
    {
        return $this->facultyAboutUsPageByLang('',$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facultyAboutUsPageByLang($lang = "",$id)
    {


       if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(2);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(3);
              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');

      $FacultyData= Faculty::where('status', 1)->find($id);

 if (count((array)$FacultyData) == 0) {
          return redirect()->action('FrontendHomeController@HomePage');
        }
       // dd($facultyNameSegment);









    $contentsoverview=ContentSection::where('faculty_id',$FacultyData->id)->where('status', 1)->where('key_content','faculty')->where('father_id',0)->where('catagoryes',1)->get();
    $contentsmestionvi=ContentSection::where('faculty_id',$FacultyData->id)->where('status', 1)->where('key_content','faculty')->where('father_id',0)->where('catagoryes',2)->orderby('row_no', 'asc')->get();
    $contentdeansmessage=ContentSection::where('faculty_id',$FacultyData->id)->where('status', 1)->where('key_content','faculty')->where('father_id',0)->where('catagoryes',3)->orderby('row_no', 'asc')->first();
    $coursedescriptions=ContentSection::where('faculty_id',$FacultyData->id)->where('status', 1)->where('key_content','faculty')->where('father_id',0)->where('catagoryes',4)->orderby('row_no', 'asc')->get();
    $contentAcademicPlan=ContentSection::where('faculty_id',$FacultyData->id)->where('status', 1)->where('key_content','faculty')->where('father_id',0)->where('catagoryes',5)->orderby('row_no', 'asc')->get();
    $contentHighlights=ContentSection::where('faculty_id',$FacultyData->id)->where('status', 1)->where('key_content','faculty')->where('father_id',0)->where('catagoryes',6)->orderby('row_no', 'asc')->get();


 $WebmasterSection = WebmasterSection::where('name','photos')->first();

     $Photos = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orderby('row_no', 'asc')->limit(10)->get();


    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');



   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);



        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }






        return view("frontEnd.onepage.contentfaculty",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "Topic",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "FacultyData",
                "ContactUsData",
                "title_var",
                "details_var",
                "file_var",
                "slug_var" ,
                "contentsoverview",
                "contentsmestionvi",
                "contentdeansmessage",
                "coursedescriptions",
                "contentAcademicPlan",
                "contentHighlights",
                "Photos"
              ));
    }

    public function facultydeanship($id)
    {
        return $this->facultydeanshipByLang('',$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facultydeanshipByLang($lang = "",$id)
    {


       if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(1);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(2);
              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');


       // dd($facultyNameSegment);


    $FacultyData= Faculty::where('status', 1)->find($id);


  if (count((array)$FacultyData) == 0) {
          return redirect()->action('FrontendHomeController@HomePage');
        }


    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');



   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);




        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }


                // .. end of .. Page Title, Description, Keywords


        return view("frontEnd.onepage.deanship",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "Topic",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "FacultyData",
                "ContactUsData",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
              ));
    }



    public function facultylecturerstable($id)
    {
        return $this->facultylecturerstableByLang('',$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facultylecturerstableByLang($lang = "",$id)
    {


       if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(1);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(2);
              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');


       // dd($facultyNameSegment);


    $FacultyData= Faculty::where('status', 1)->find($id);


  if (count((array)$FacultyData) == 0) {
          return redirect()->action('FrontendHomeController@HomePage');
        }
 $WebmasterSection = WebmasterSection::where('name','lecturertable')->first();

    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

        $name_section=trans('backLang.'.$WebmasterSection->name);

   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);



        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }


                // .. end of .. Page Title, Description, Keywords


        return view("frontEnd.onepage.lecturertable",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "Topic",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "name_section",
                "PageDescription",
                "PageKeywords",
                "FacultyData",
                "ContactUsData",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
              ));
    }




     /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function GetstafffacultyDetail($id)
    {
           return $this->GetstafffacultyDetailByLang('',$id);
    }
    public function GetstafffacultyDetailByLang($lang = "",$id=0)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);


       $Topic = Staff::where('status', 1)->find($id);



            // count topics by Category
            $category_and_topics_count = array();
        $fullPagePath= Helper::GetUrlMenuOnly();


  $segments= \Request::segments();
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);

              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);




            if (count((array)$Topic) > 0) {
                // update visits
                // $Topic->visits = $Topic->visits + 1;
                // $Topic->save();
                $Section_id=$Topic->section_id;

    $FacultyData= Faculty::where('status', 1)->find($Topic->faculty_id);


  if (count((array)$FacultyData) == 0) {
          return redirect()->action('FrontendHomeController@HomePage');
        }


    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');


 $Section = Section::where('status', 1)->find($Section_id);

                // General for all pages
             $thisDetailMenu = Menu::where('link',$fullPagePath)->with('parentMenus')->first();


                $WebsiteSettings = Setting::find(1);
                $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();
                $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();
                $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
                $FooterMenuLinks_name_ar = "";
                $FooterMenuLinks_name_en = "";
                if (count((array)$FooterMenuLinks_father) > 0) {
                    $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                    $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
                }

    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
    $name_section=$Section->$title_var;
                 $backgroundImage="uploads/banar.jpg";
      if (!empty($Section->photo) && $Section->photo!='#') {
         $backgroundImage=$Section->photo;
     }
                // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($Topic->$seo_title_var != "") {
                    $PageTitle = $Topic->$seo_title_var;
                } else {
                    $PageTitle = $Topic->$tpc_title_var;
                }
                if ($Topic->$seo_description_var != "") {
                    $PageDescription = $Topic->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($Topic->$seo_keywords_var != "") {
                    $PageKeywords = $Topic->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }
                // .. end of .. Page Title, Description, Keywords


                return view("frontEnd.onepage.detailboard",
                    compact("WebsiteSettings",
                        "WebmasterSettings",
                        "HeaderMenuLinks",
                        "FooterMenuLinks",
                        "FooterMenuLinks_name_ar",
                        "FooterMenuLinks_name_en",
                        "FacultyData",
                        "Topic",
                        "name_section",
                        "backgroundImage",
                        "PageTitle",
                        "PageDescription",
                        "thisDetailMenu",
                        "PageKeywords",
                          "title_var",
                        "details_var",
                        "file_var",
                        "slug_var"
                    ));

            } else {
                return redirect()->action('FrontendHomeController@HomePage');
            }

    }

        public function facultyevents($id)
    {
        return $this->facultyeventsByLang('',$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facultyeventsByLang($lang = "",$id)
    {


       if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(1);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(2);
              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');


       // dd($facultyNameSegment);


    $FacultyData= Faculty::where('status', 1)->find($id);


  if (count((array)$FacultyData) == 0) {
          return redirect()->action('FrontendHomeController@HomePage');
        }
 $WebmasterSection = WebmasterSection::where('name','events')->first();
        if (count((array)$WebmasterSection) == 0) {
              return redirect()->action('FrontendHomeController@HomePage');
        }

    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

     $Topics = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orderby('row_no', 'asc')->paginate(env('FRONTEND_PAGINATION'));



   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);



        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }


                // .. end of .. Page Title, Description, Keywords


        return view("frontEnd.onepage.events",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "Topics",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "FacultyData",
                "ContactUsData",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
              ));
    }


        public function facultyannouncements($id)
    {
        return $this->facultyannouncementsByLang('',$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facultyannouncementsByLang($lang = "",$id)
    {


       if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(1);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(2);
              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');


       // dd($facultyNameSegment);


    $FacultyData= Faculty::where('status', 1)->find($id);


  if (count((array)$FacultyData) == 0) {
          return redirect()->action('FrontendHomeController@HomePage');
        }
 $WebmasterSection = WebmasterSection::where('name','announcements')->first();
        if (count((array)$WebmasterSection) == 0) {
              return redirect()->action('FrontendHomeController@HomePage');
        }

    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

     $Topics = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orderby('row_no', 'asc')->paginate(env('FRONTEND_PAGINATION'));



   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);



        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }


                // .. end of .. Page Title, Description, Keywords


        return view("frontEnd.onepage.announcements",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "Topics",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "FacultyData",
                "ContactUsData",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
              ));
    }


   public function facultyourGallery($faculty)
    {
        return $this->facultyourGalleryByLang('',$faculty);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facultyourGalleryByLang($lang = "",$faculty)
    {


       if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(1);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(2);
              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');


       // dd($facultyNameSegment);


    $FacultyData= Faculty::where('status', 1)->find($faculty);


  if (count((array)$FacultyData) == 0) {
          return redirect()->action('FrontendHomeController@HomePage');
        }
 $WebmasterSection = WebmasterSection::where('name','photos')->first();
        if (count((array)$WebmasterSection) == 0) {
              return redirect()->action('FrontendHomeController@HomePage');
        }

    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

     $Topics = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orderby('row_no', 'asc')->paginate(env('FRONTEND_PAGINATION'));



   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);



        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }


                // .. end of .. Page Title, Description, Keywords


        return view("frontEnd.onepage.photos",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "Topics",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "FacultyData",
                "ContactUsData",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
              ));
    }





   public function facultyourGalleryDetail($faculty,$id)
    {
        return $this->facultyourGalleryDetailByLang('',$faculty,$id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facultyourGalleryDetailByLang($lang = "",$faculty,$id)
    {


       if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed='navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
//

         $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(1);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);
                $facultyNameSegment= \Request::segment(2);
              //dd($segments);
           }
           $fullPagePath=implode('/', $segments);
        // General for all pages
        $Facultyname="title_".trans('backLang.boxCode');


       // dd($facultyNameSegment);


    $FacultyData= Faculty::where('status', 1)->find($faculty);


  if (count((array)$FacultyData) == 0) {
          return redirect()->action('FrontendHomeController@HomePage');
        }
 $WebmasterSection = WebmasterSection::where('name','photos')->first();
        if (count((array)$WebmasterSection) == 0) {
              return redirect()->action('FrontendHomeController@HomePage');
        }

    $title_var = "title_" . trans('backLang.boxCode');
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

     $Topic = Topic::where('faculty_id',$FacultyData->id)->where('status', 1)->orderby('row_no', 'asc')->find($id);



   // dd($FacultyData);


        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
    $HeaderMenuOnePageLinks = Menu::where('father_id',96)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

       $contact_page_id= $WebmasterSettings->contact_page_id;
        $ContactUsData= Topic::where('status', 1)->find($contact_page_id);



        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

          // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($FacultyData->$seo_title_var != "") {
                    $PageTitle = $FacultyData->$seo_title_var;
                } else {
                    $PageTitle = $FacultyData->$tpc_title_var;
                }
                if ($FacultyData->$seo_description_var != "") {
                    $PageDescription = $FacultyData->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($FacultyData->$seo_keywords_var != "") {
                    $PageKeywords = $FacultyData->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }
               if ($Topic->$seo_title_var != "") {
                    $PageTitle = $Topic->$seo_title_var;
                } else {
                    $PageTitle = $Topic->$tpc_title_var;
                }
                if ($Topic->$seo_description_var != "") {
                    $PageDescription = $Topic->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($Topic->$seo_keywords_var != "") {
                    $PageKeywords = $Topic->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }

                // .. end of .. Page Title, Description, Keywords


        return view("frontEnd.onepage.photosdetail",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "Topic",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "FacultyData",
                "ContactUsData",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
              ));
    }



}


