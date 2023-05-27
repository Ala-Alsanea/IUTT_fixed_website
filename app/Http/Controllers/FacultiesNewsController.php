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


class FacultiesNewsController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function topicfaculty($faculty,$id = 0)
    {
        $lang_dirs = array_filter(glob(App::langPath() . '/*'), 'is_dir');
        // check if this like "/ar/blog"
        if (in_array(App::langPath() . "/news/faculty/", $lang_dirs)) {
            return $this->topicfacultyByLang($faculty,$id, 0);
        } else {
            return $this->topicfacultyByLang("",$faculty,$id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $cat
     * @return \Illuminate\Http\Response
     */
    public function topicsfacultyByLang($lang = "",$id,$cat = 0)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }
$section = 'news';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);


        // get Webmaster section settings by name
        $WebmasterSection = WebmasterSection::where('name', $section)->first();
        if (count((array)$WebmasterSection) == 0) {
            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($section);
        }
        if (count((array)$WebmasterSection) > 0) {


  
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
        $defultFaculty= Faculty::where('status', 1)->first();

      // dd($facultyNameSegment);
      $FacultyData= Faculty::where('status', 1)->find($id);


        if (count((array)$FacultyData) == 0) {
            // get Webmaster section settings by ID
             return redirect()->action('FrontendHomeController@HomePage');
        }

  


            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('status', 1)->orderby('row_no', 'desc')->get();
            if (count((array)$AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->whereIn('id', $category_topics)->orderby('row_no', 'desc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = Section::find($cat);
            // Get a list of all Category ( for side bar )
            $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('father_id', '=',
                '0')->where('status', 1)->orderby('row_no', 'desc')->get();

            if (count((array)$CurrentCategory) > 0) {
                $category_topics = array();
                $TopicCategories = TopicCategory::where('section_id', $cat)->get();
                foreach ($TopicCategories as $category) {
                    $category_topics[] = $category->topic_id;
                }
                // update visits
                $CurrentCategory->visits = $CurrentCategory->visits + 1;
                $CurrentCategory->save();
                // Topics by Cat_ID
                $Topics = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->whereIn('id', $category_topics)->orderby('row_no', 'desc')->paginate(env('FRONTEND_PAGINATION'));
                // Get Most Viewed Topics fot this Category
                $TopicsMostViewed = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->whereIn('id', $category_topics)->orderby('visits', 'desc')->limit(3)->get();
            } else {
                // Topics if NO Cat_ID
                $Topics = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status',
                    1]])->orderby('row_no', 'desc')->paginate(env('FRONTEND_PAGINATION'));
                // Get Most Viewed
                $TopicsMostViewed = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status',
                    1]])->orderby('visits', 'desc')->limit(3)->get();
            }

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
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
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                1)->orderby('row_no', 'asc')->get();
       

         $listTopic_id=array();
                $TopicsNews = Topic::where('faculty_id',$FacultyData->id)->where('status', 1)->orwhere('webmaster_id', $WebmasterSettings->latest_news_section_id)->orderby('date', 'desc')->get();
           foreach ($TopicsNews as  $Item) {
                          if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value!=''  && $Item->fields[0]->field_value==1){
                             array_push($listTopic_id,$Item->id);
                          }
                  }
              // if (count($listTopic_id<)) {
              //     # code...
              // }
            // Get Latest News
               //   dd($listTopic_id);
            $LatestNews = Topic::where('faculty_id',$FacultyData->id)->where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->wherein('id',$listTopic_id)->orderby('date', 'desc')->limit(3)->get();


          
            // Page Title, Description, Keywords
            if (count((array)$CurrentCategory) > 0) {
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($CurrentCategory->$seo_title_var != "") {
                    $PageTitle = $CurrentCategory->$seo_title_var;
                } else {
                    $PageTitle = $CurrentCategory->$tpc_title_var;
                }
                if ($CurrentCategory->$seo_description_var != "") {
                    $PageDescription = $CurrentCategory->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($CurrentCategory->$seo_keywords_var != "") {
                    $PageKeywords = $CurrentCategory->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }
            } else {
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

                $PageTitle = trans('backLang.' . $WebmasterSection->name);
                $PageDescription = $WebsiteSettings->$site_desc_var;
                $PageKeywords = $WebsiteSettings->$site_keywords_var;

            }


    $title_var = "title_" . trans('backLang.boxCode'); 
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');



            // .. end of .. Page Title, Description, Keywords

            // Send all to the view
            return view("frontEnd.onepage.topics",
                compact("WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en", 
                    "LatestNews", 
                    "WebmasterSection",
                    "Categories",
                    "Topics",
                    "CurrentCategory",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "TopicsMostViewed",
                     "FacultyData",
                     "title_var",
                      "details_var",
                      "file_var",
                      "slug_var",
                    "category_and_topics_count"));

        } else {

            return $this->SEOByLang($lang, $section);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function topicfacultyByLang($lang = "",$faculty, $id = 0)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }
$section = 'news';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        // check for pages called by name not id
        // switch ($section) {
        //     case "about" :
        //         $id = 1;
        //         $section = 1;
        //         break;
        //     case "privacy" :
        //         $id = 3;
        //         $section = 1;
        //         break;
        //     case "terms" :
        //         $id = 4;
        //         $section = 1;
        //         break;
        // }


        // get Webmaster section settings by name
        $WebmasterSection = WebmasterSection::where('name', $section)->first();
        if (count((array)$WebmasterSection) == 0) {
            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($section);
        }
        if (count((array)$WebmasterSection) > 0) {


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
        $defultFaculty= Faculty::where('status', 1)->first();

       // dd($facultyNameSegment);
      $FacultyData= Faculty::where('status', 1)->find($faculty);
        if (count((array)$FacultyData) == 0) {
            // get Webmaster section settings by ID
             return redirect()->action('FrontendHomeController@HomePage');
        }

  



            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('status', 1)->orderby('row_no', 'desc')->get();
            if (count((array)$AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->whereIn('id', $category_topics)->orderby('row_no', 'desc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            $Topic = Topic::where('faculty_id',$FacultyData->id)->where('status', 1)->find($id);


            if (count((array)$Topic) > 0 && ($Topic->expire_date == '' || ($Topic->expire_date != '' && $Topic->expire_date >= date("Y-m-d")))) {
                // update visits
                $Topic->visits = $Topic->visits + 1;
                $Topic->save();

                // Get current Category Section details
                $CurrentCategory = array();
                $TopicCategory = TopicCategory::where('topic_id', $Topic->id)->first();
                if (count((array)$TopicCategory) > 0) {
                    $CurrentCategory = Section::find($TopicCategory->section_id);
                }
                // Get a list of all Category ( for side bar )
                $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('status',
                    1)->where('father_id', '=', '0')->orderby('row_no', 'desc')->get();

                // Get Most Viewed
                $TopicsMostViewed = Topic::where('faculty_id',$FacultyData->id)->where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orderby('visits', 'desc')->limit(3)->get();

                // General for all pages

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
                $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();

                // Get Latest News
                $LatestNews = Topic::where('faculty_id',$FacultyData->id)->where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'desc')->limit(3)->get();

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

    $title_var = "title_" . trans('backLang.boxCode'); 
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                return view("frontEnd.onepage.topic",
                    compact("WebsiteSettings",
                        "WebmasterSettings",
                        "HeaderMenuLinks",
                        "FooterMenuLinks",
                        "FooterMenuLinks_name_ar",
                        "FooterMenuLinks_name_en",
                        "LatestNews",
                        "Topic",
                        "SideBanners",
                        "WebmasterSection",
                        "Categories",
                        "CurrentCategory",
                        "PageTitle",
                        "PageDescription",
                        "PageKeywords",
                        "TopicsMostViewed",
                          "FacultyData",
                     "title_var",
                      "details_var",
                      "file_var",
                      "slug_var",
                        "category_and_topics_count"));

            } else {
                return redirect()->action('FrontendHomeController@HomePage');
            }
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $cat
     * @return \Illuminate\Http\Response
     */
    public function topicsfaculty($faculty,$cat = 0)
    {
        $lang_dirs = array_filter(glob(App::langPath() . '/*'), 'is_dir');
        // check if this like "/ar/blog"
        if (in_array(App::langPath() . "/news/faculty", $lang_dirs)) {
            return $this->topicsfacultyByLang($faculty,$cat, 0);
        } else {
            return $this->topicsfacultyByLang("",$faculty,$cat);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function userTopicsfaculty($faculty,$id)
    {
        return $this->userTopicsfacultyByLang("",$faculty, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function userTopicsfacultyByLang($lang = "",$faculty, $id)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        // get User Details
        $User = User::find($id);
        if (count((array)$User) > 0) {


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
        $defultFaculty= Faculty::where('status', 1)->first();

       // dd($facultyNameSegment);
      $FacultyData= Faculty::where('status', 1)->find($faculty);
        if (count((array)$FacultyData) == 0) {
            // get Webmaster section settings by ID
             return redirect()->action('FrontendHomeController@HomePage');
        }

            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('status', 1)->orderby('row_no', 'asc')->get();
            if (count((array)$AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where('faculty_id',$FacultyData->id)->where([['status', 1]])->orWhere([['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'asc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = "none";
            $WebmasterSection = "none";
            // Get a list of all Category ( for side bar )
            $Categories = Section::where('father_id', '=',
                '0')->where('status', 1)->orderby('row_no', 'asc')->get();

            // Topics if NO Cat_ID
            $Topics = Topic::where('faculty_id',$FacultyData->id)->where([['created_by', $User->id], ['status', 1]])->orwhere([['created_by', $User->id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->paginate(env('FRONTEND_PAGINATION'));
            // Get Most Viewed
            $TopicsMostViewed = Topic::where('faculty_id',$FacultyData->id)->where([['created_by', $User->id], ['status', 1]])->orwhere([['created_by', $User->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
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
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                1)->orderby('row_no', 'asc')->get();
    $title_var = "title_" . trans('backLang.boxCode'); 
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

            // Get Latest News
            $LatestNews = Topic::where('faculty_id',$FacultyData->id)->where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();

            // Page Title, Description, Keywords
            $site_desc_var = "site_desc_" . trans('backLang.boxCode');
            $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

            $PageTitle = $User->name;
            $PageDescription = $WebsiteSettings->$site_desc_var;
            $PageKeywords = $WebsiteSettings->$site_keywords_var;

            // .. end of .. Page Title, Description, Keywords

            // Send all to the view
            return view("frontEnd.onepage.topics",
                compact("WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "LatestNews",
                    "User",
                    "SideBanners",
                    "WebmasterSection",
                    "Categories",
                    "Topics",
                    "CurrentCategory",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "TopicsMostViewed",
                      "FacultyData",
                     "title_var",
                      "details_var",
                      "file_var",
                      "slug_var",
                    "category_and_topics_count"));

        } else {
            // If no section name/ID go back to home
            return redirect()->action('FrontendHomeController@HomePage');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchTopicsfaculty(Request $request,$faculty)
    {

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $search_word = $request->search_word;

        if ($search_word != "") {
   $WebmasterSection = WebmasterSection::where('name','news')->first();
            // count topics by Category


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
        $defultFaculty= Faculty::where('status', 1)->first();

       // dd($facultyNameSegment);
      $FacultyData= Faculty::where('status', 1)->find($faculty);
        if (count((array)$FacultyData) == 0) {
            // get Webmaster section settings by ID
             return redirect()->action('FrontendHomeController@HomePage');
        }

            $category_and_topics_count = array();
            $AllSections = Section::where('status', 1)->where('webmaster_id',$WebmasterSection->id)->orderby('row_no', 'asc')->get();
            if (count((array)$AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where('faculty_id',$FacultyData->id)->where('status', 1)->whereIn('id', $category_topics)->where('webmaster_id',$WebmasterSection->id)->orderby('row_no', 'asc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = "none";
          //  $WebmasterSection = "none";
           
            // Get a list of all Category ( for side bar )
            $Categories = Section::where('father_id', '=',
                '0')->where('status', 1)->where('webmaster_id',$WebmasterSection->id)->orderby('row_no', 'asc')->get();

            // Topics if NO Cat_ID
            $Topics = Topic::where('faculty_id',$FacultyData->id)->where('title_ar', 'like', '%' . $search_word . '%')
                ->orwhere('title_en', 'like', '%' . $search_word . '%')
                ->orwhere('seo_title_ar', 'like', '%' . $search_word . '%')
                ->orwhere('seo_title_en', 'like', '%' . $search_word . '%')
                ->orwhere('details_ar', 'like', '%' . $search_word . '%')
                ->orwhere('details_en', 'like', '%' . $search_word . '%')->where('webmaster_id',$WebmasterSection->id)
                ->orderby('id', 'desc')->paginate(env('FRONTEND_PAGINATION'));
            // Get Most Viewed
            $TopicsMostViewed = Topic::where('faculty_id',$FacultyData->id)->where('status', 1)->where('webmaster_id',$WebmasterSection->id)->orderby('visits', 'desc')->limit(3)->get();

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
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
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                1)->orderby('row_no', 'asc')->get();
    $title_var = "title_" . trans('backLang.boxCode'); 
    $details_var = "details_" . trans('backLang.boxCode');
     $file_var = "file_" . trans('backLang.boxCode');
      $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

            // Get Latest News
            $LatestNews = Topic::where('faculty_id',$FacultyData->id)->where('status', 1)->where('webmaster_id',$WebmasterSection->id)->orderby('row_no', 'asc')->limit(3)->get();

            // Page Title, Description, Keywords
            $site_desc_var = "site_desc_" . trans('backLang.boxCode');
            $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

            $PageTitle = $search_word;
            $PageDescription = $WebsiteSettings->$site_desc_var;
            $PageKeywords = $WebsiteSettings->$site_keywords_var;

            // .. end of .. Page Title, Description, Keywords

            // Send all to the view
            return view("frontEnd.onepage.topics",
                compact("WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "LatestNews",
                    "search_word",
                    "SideBanners",
                    "WebmasterSection",
                    "Categories",
                    "Topics",
                    "CurrentCategory",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "TopicsMostViewed",
                      "FacultyData",
                     "title_var",
                      "details_var",
                      "file_var",
                      "slug_var",
                    "category_and_topics_count"));

        } else {
            // If no section name/ID go back to home
            return redirect()->action('FrontendHomeController@HomePage');
        }

    }

   
    

   
}


