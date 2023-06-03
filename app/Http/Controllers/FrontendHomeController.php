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
use App\Models\TopicField;
use App\Models\WebmasterSectionField;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Mail;


class FrontendHomeController extends Controller
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
            case "home":
                return $this->HomePage();
                break;
            case "about":
                $id = 1;
                $section = 1;
                return $this->topic($section, $id);
                break;
            case "privacy":
                $id = 3;
                $section = 1;
                return $this->topic($section, $id);
                break;
            case "terms":
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
    public function HomePage()
    {
        return $this->HomePageByLang("");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function HomePageByLang($lang = "")
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            // Session::put('locale', $lang);
        }
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        // General for all pages
        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
            'status',
            1
        )->orderby(
            'row_no',
            'asc'
        )->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
            'status',
            1
        )->orderby(
            'row_no',
            'asc'
        )->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

        // Home topics
        $HomeTopics = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->home_content1_section_id]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->home_content1_section_id], ['expire_date', null]])->orderby('row_no', 'desc')->limit(3)->get();
        // Home photos
        $HomePhotos = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->home_content2_section_id]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->home_content2_section_id], ['expire_date', null]])->orderby('row_no', 'desc')->limit(6)->get();
        // Home Partners
        $HomePartners = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->home_content3_section_id]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->home_content3_section_id], ['expire_date', null]])->orderby('row_no', 'desc')->get();

        // Get Latest News
        $listTopic_id = array();
        $TopicsNews = Topic::where('status', 1)->orwhere('webmaster_id', $WebmasterSettings->latest_news_section_id)->orderby('row_no', 'desc')->get();
        foreach ($TopicsNews as  $Item) {
            if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value != ''  && $Item->fields[0]->field_value == 1) {
                array_push($listTopic_id, $Item->id);
            }
        }
        // if (count($listTopic_id<)) {
        //     # code...
        // }
        // Get Latest News
        //   dd($listTopic_id);
        $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->orderby('date', 'desc')->limit(3)->get();


        // $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'desc')->limit(3)->get();

        // Get Home page slider banners
        $SliderBanners = Banner::where('section_id', $WebmasterSettings->home_banners_section_id)->where(
            'status',
            1
        )->orderby('row_no', 'desc')->get();

        // Get Home page Test banners
        $TextBanners = Banner::where('section_id', $WebmasterSettings->home_text_banners_section_id)->where(
            'status',
            1
        )->orderby('row_no', 'desc')->get();

        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

        return view(
            "frontEnd.home",
            compact(
                "WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "SliderBanners",
                "TextBanners",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "HomeTopics",
                "HomePhotos",
                "HomePartners",
                "LatestNews"
            )
        );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function topic($id = 0)
    {
        $lang_dirs = array_filter(glob(App::langPath() . '/*'), 'is_dir');
        // check if this like "/ar/blog"
        if (in_array(App::langPath() . "/news", $lang_dirs)) {
            return $this->topicsByLang($id, 0);
        } else {
            return $this->topicByLang("", $id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $cat
     * @return \Illuminate\Http\Response
     */
    public function topicsByLang($lang = "", $cat = 0)
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

                    $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'desc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = Section::find($cat);
            // Get a list of all Category ( for side bar )
            $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where(
                'father_id',
                '=',
                '0'
            )->where('status', 1)->orderby('row_no', 'desc')->get();

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
                $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'desc')->paginate(env('FRONTEND_PAGINATION'));
                // Get Most Viewed Topics fot this Category
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('visits', 'desc')->limit(3)->get();
            } else {
                // Topics if NO Cat_ID
                $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], [
                    'status',
                    1
                ]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'desc')->paginate(env('FRONTEND_PAGINATION'));
                // Get Most Viewed
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], [
                    'status',
                    1
                ]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();
            }

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                'status',
                1
            )->orderby(
                'row_no',
                'asc'
            )->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                'status',
                1
            )->orderby(
                'row_no',
                'asc'
            )->get();
            $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
            $FooterMenuLinks_name_ar = "";
            $FooterMenuLinks_name_en = "";
            if (count((array)$FooterMenuLinks_father) > 0) {
                $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
            }
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();


            $listTopic_id = array();
            $TopicsNews = Topic::where('status', 1)->orwhere('webmaster_id', $WebmasterSettings->latest_news_section_id)->orderby('date', 'desc')->get();
            foreach ($TopicsNews as  $Item) {
                if (isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value != ''  && $Item->fields[0]->field_value == 1) {
                    array_push($listTopic_id, $Item->id);
                }
            }
            // if (count($listTopic_id<)) {
            //     # code...
            // }
            // Get Latest News
            //   dd($listTopic_id);
            $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->wherein('id', $listTopic_id)->orderby('date', 'desc')->limit(3)->get();



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
            // .. end of .. Page Title, Description, Keywords

            // Send all to the view
            return view(
                "frontEnd.topics",
                compact(
                    "WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "LatestNews",
                    "SideBanners",
                    "WebmasterSection",
                    "Categories",
                    "Topics",
                    "CurrentCategory",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "TopicsMostViewed",
                    "category_and_topics_count"
                )
            );
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
    public function topicByLang($lang = "", $id = 0)
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

                    $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'desc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            $Topic = Topic::where('status', 1)->find($id);


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
                $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where(
                    'status',
                    1
                )->where('father_id', '=', '0')->orderby('row_no', 'desc')->get();

                // Get Most Viewed
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orwhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();

                // General for all pages

                $WebsiteSettings = Setting::find(1);
                $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                    'status',
                    1
                )->orderby('row_no', 'asc')->get();
                $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                    'status',
                    1
                )->orderby('row_no', 'asc')->get();
                $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
                $FooterMenuLinks_name_ar = "";
                $FooterMenuLinks_name_en = "";
                if (count((array)$FooterMenuLinks_father) > 0) {
                    $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                    $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
                }
                $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where(
                    'status',
                    1
                )->orderby('row_no', 'asc')->get();

                // Get Latest News
                $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'desc')->limit(3)->get();

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


                return view(
                    "frontEnd.topic",
                    compact(
                        "WebsiteSettings",
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
                        "category_and_topics_count"
                    )
                );
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
    public function topics($cat = 0)
    {
        $lang_dirs = array_filter(glob(App::langPath() . '/*'), 'is_dir');
        // check if this like "/ar/blog"
        if (in_array(App::langPath() . "/news", $lang_dirs)) {
            return $this->topicsByLang($cat, 0);
        } else {
            return $this->topicsByLang("", $cat);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function userTopics($id)
    {
        return $this->userTopicsByLang("", $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function userTopicsByLang($lang = "", $id)
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


            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('status', 1)->orderby('row_no', 'desc')->get();
            if (count((array)$AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where([['status', 1]])->orWhere([['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'desc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = "none";
            $WebmasterSection = "none";
            // Get a list of all Category ( for side bar )
            $Categories = Section::where(
                'father_id',
                '=',
                '0'
            )->where('status', 1)->orderby('row_no', 'desc')->get();

            // Topics if NO Cat_ID
            $Topics = Topic::where([['created_by', $User->id], ['status', 1]])->orwhere([['created_by', $User->id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'desc')->paginate(env('FRONTEND_PAGINATION'));
            // Get Most Viewed
            $TopicsMostViewed = Topic::where([['created_by', $User->id], ['status', 1]])->orwhere([['created_by', $User->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                'status',
                1
            )->orderby(
                'row_no',
                'asc'
            )->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                'status',
                1
            )->orderby(
                'row_no',
                'asc'
            )->get();
            $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
            $FooterMenuLinks_name_ar = "";
            $FooterMenuLinks_name_en = "";
            if (count((array)$FooterMenuLinks_father) > 0) {
                $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
            }
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where(
                'status',
                1
            )->orderby('row_no', 'desc')->get();


            // Get Latest News
            $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'desc')->limit(3)->get();

            // Page Title, Description, Keywords
            $site_desc_var = "site_desc_" . trans('backLang.boxCode');
            $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

            $PageTitle = $User->name;
            $PageDescription = $WebsiteSettings->$site_desc_var;
            $PageKeywords = $WebsiteSettings->$site_keywords_var;

            // .. end of .. Page Title, Description, Keywords

            // Send all to the view
            return view(
                "frontEnd.topics",
                compact(
                    "WebsiteSettings",
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
                    "category_and_topics_count"
                )
            );
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
    public function searchTopics(Request $request)
    {

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $search_word = $request->search_word;

        if ($search_word != "") {
            $WebmasterSection = WebmasterSection::where('name', 'news')->first();
            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('status', 1)->where('webmaster_id', $WebmasterSection->id)->orderby('row_no', 'asc')->get();
            if (count((array)$AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where('status', 1)->whereIn('id', $category_topics)->where('webmaster_id', $WebmasterSection->id)->orderby('row_no', 'desc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = "none";
            //  $WebmasterSection = "none";

            // Get a list of all Category ( for side bar )
            $Categories = Section::where(
                'father_id',
                '=',
                '0'
            )->where('status', 1)->where('webmaster_id', $WebmasterSection->id)->orderby('row_no', 'asc')->get();

            // Topics if NO Cat_ID
            $Topics = Topic::where('title_ar', 'like', '%' . $search_word . '%')
                ->orwhere('title_en', 'like', '%' . $search_word . '%')
                ->orwhere('seo_title_ar', 'like', '%' . $search_word . '%')
                ->orwhere('seo_title_en', 'like', '%' . $search_word . '%')
                ->orwhere('details_ar', 'like', '%' . $search_word . '%')
                ->orwhere('details_en', 'like', '%' . $search_word . '%')->where('webmaster_id', $WebmasterSection->id)
                ->orderby('id', 'desc')->paginate(env('FRONTEND_PAGINATION'));
            // Get Most Viewed
            $TopicsMostViewed = Topic::where('status', 1)->where('webmaster_id', $WebmasterSection->id)->orderby('visits', 'desc')->limit(3)->get();

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                'status',
                1
            )->orderby(
                'row_no',
                'asc'
            )->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                'status',
                1
            )->orderby(
                'row_no',
                'asc'
            )->get();
            $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
            $FooterMenuLinks_name_ar = "";
            $FooterMenuLinks_name_en = "";
            if (count((array)$FooterMenuLinks_father) > 0) {
                $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
            }
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();


            // Get Latest News
            $LatestNews = Topic::where('status', 1)->where('webmaster_id', $WebmasterSection->id)->orderby('row_no', 'desc')->limit(3)->get();

            // Page Title, Description, Keywords
            $site_desc_var = "site_desc_" . trans('backLang.boxCode');
            $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

            $PageTitle = $search_word;
            $PageDescription = $WebsiteSettings->$site_desc_var;
            $PageKeywords = $WebsiteSettings->$site_keywords_var;

            // .. end of .. Page Title, Description, Keywords

            // Send all to the view
            return view(
                "frontEnd.topics",
                compact(
                    "WebsiteSettings",
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
                    "category_and_topics_count"
                )
            );
        } else {
            // If no section name/ID go back to home
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ContactPage()
    {
        return $this->ContactPageByLang("");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ContactPageByLang($lang = "")
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $id = $WebmasterSettings->contact_page_id;
        $Topic = Topic::where('status', 1)->find($id);


        if (count((array)$Topic) > 0 && ($Topic->expire_date == '' || ($Topic->expire_date != '' && $Topic->expire_date >= date("Y-m-d")))) {

            // update visits
            $Topic->visits = $Topic->visits + 1;
            $Topic->save();

            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($Topic->webmaster_id);

            if (count((array)$WebmasterSection) > 0) {

                // Get current Category Section details
                $CurrentCategory = Section::find($Topic->section_id);
                // Get a list of all Category ( for side bar )
                $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where(
                    'father_id',
                    '=',
                    '0'
                )->where('status', 1)->orderby('row_no', 'asc')->get();

                // Get Most Viewed
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orwhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();

                // General for all pages

                $WebsiteSettings = Setting::find(1);
                $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                    'status',
                    1
                )->orderby('row_no', 'asc')->get();
                $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                    'status',
                    1
                )->orderby('row_no', 'asc')->get();
                $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
                $FooterMenuLinks_name_ar = "";
                $FooterMenuLinks_name_en = "";
                if (count((array)$FooterMenuLinks_father) > 0) {
                    $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                    $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
                }
                $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where(
                    'status',
                    1
                )->orderby('row_no', 'asc')->get();

                // Get Latest News
                $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'desc')->limit(3)->get();

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

                return view(
                    "frontEnd.contact",
                    compact(
                        "WebsiteSettings",
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
                        "TopicsMostViewed"
                    )
                );
            } else {
                return redirect()->action('FrontendHomeController@HomePage');
            }
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }
    public function AboutUs($id)
    {

        return  $this->AboutUsByLang('', $id);
    }
    public function AboutUsByLang($lang = "", $id)
    {


        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);


        $section = 1;

        // get Webmaster section settings by name
        $WebmasterSection = WebmasterSection::where('name', $section)->first();
        if (count((array)$WebmasterSection) == 0) {
            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($section);
        }
        if (count((array)$WebmasterSection) > 0) {

            // count topics by Category




            $Topic = Topic::where('status', 1)->find($id);


            if (count((array)$Topic) > 0) {
                // update visits
                $Topic->visits = $Topic->visits + 1;
                $Topic->save();


                $Topics = Topic::where('status', 1)->where('refrence_id', $Topic->id)->orderby('row_no', 'asc')->get();
                // Get Most Viewed


                // General for all pages

                $fullPagePath = Helper::GetUrlMenuOnly();
                $segments = \Request::segments();
                $lang_code = trans('backLang.boxCode');
                if (in_array($lang_code, $segments)) {
                    unset($segments[0]);

                    //dd($segments);
                }
                $fullPagePath = implode('/', $segments);



                $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();

                $WebsiteSettings = Setting::find(1);
                $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                    'status',
                    1
                )->orderby('row_no', 'asc')->get();
                $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                    'status',
                    1
                )->orderby('row_no', 'asc')->get();
                $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
                $FooterMenuLinks_name_ar = "";
                $FooterMenuLinks_name_en = "";
                if (count((array)$FooterMenuLinks_father) > 0) {
                    $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                    $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
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
                $title_var = "title_" . trans('backLang.boxCode');
                $details_var = "details_" . trans('backLang.boxCode');
                $file_var = "file_" . trans('backLang.boxCode');
                $slug_var = "seo_url_slug_" . trans('backLang.boxCode');



                return view(
                    "frontEnd.Pagetopic",
                    compact(
                        "WebsiteSettings",
                        "WebmasterSettings",
                        "HeaderMenuLinks",
                        "FooterMenuLinks",
                        "FooterMenuLinks_name_ar",
                        "FooterMenuLinks_name_en",
                        "WebmasterSection",
                        "thisDetailMenu",
                        "PageTitle",
                        "PageDescription",
                        "PageKeywords",
                        "Topics",
                        "Topic",
                        "title_var",
                        "details_var",
                        "file_var",
                        "slug_var"
                    )
                );
            } else {
                return redirect()->action('FrontendHomeController@HomePage');
            }
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }
    public function getPageBySection($section)
    {
        return $this->getPageBySectionbyLang('', $section);
    }
    public function getPageBySectionbyLang($lang = "", $section)
    {


        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
        $sectionM = $section;
        $type_page = 'topic';




        // get Webmaster section settings by name
        $WebmasterSection = WebmasterSection::where('name', $section)->first();
        if (count((array)$WebmasterSection) == 0) {
            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($section);
        }
        if (count((array)$WebmasterSection) > 0) {

            // count topics by Category

            //  dd($id);
            $fullPagePath = Helper::GetUrlMenuOnly();
            $segments = \Request::segments();
            $lang_code = trans('backLang.boxCode');
            if (in_array($lang_code, $segments)) {
                unset($segments[0]);

                //dd($segments);
            }
            $fullPagePath = implode('/', $segments);

            $listPagination = array('events', 'announcements', 'photos', 'videos');

            // $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orderby('row_no', 'asc')->get();
            $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orderby('row_no', 'asc');
            if (in_array($WebmasterSection->name, $listPagination)) {
                $Topics = $Topics->paginate(env('FRONTEND_PAGINATION'));
            } else {
                $Topics = $Topics->get();
            }



            //dd($fullPagePath);


            // General for all pages

            $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
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

            // Page Title, Description, Keywords
            $name_section = trans('backLang.' . $WebmasterSection->name);
            $seo_title_var = "seo_title_" . trans('backLang.boxCode');
            $seo_description_var = "seo_description_" . trans('backLang.boxCode');
            $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
            $tpc_title_var = "title_" . trans('backLang.boxCode');
            $site_desc_var = "site_desc_" . trans('backLang.boxCode');
            $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');


            if ($WebmasterSection->$seo_title_var != "") {
                $PageTitle = $WebmasterSection->$seo_title_var;
            } else {
                $PageTitle = $WebmasterSection->$tpc_title_var;
            }
            if ($WebmasterSection->$seo_description_var != "") {
                $PageDescription = $WebmasterSection->$seo_description_var;
            } else {
                $PageDescription = $WebsiteSettings->$site_desc_var;
            }
            if ($WebmasterSection->$seo_keywords_var != "") {
                $PageKeywords = $WebmasterSection->$seo_keywords_var;
            } else {
                $PageKeywords = $WebsiteSettings->$site_keywords_var;
            }


            $PageName = $WebmasterSection->name;
            // .. end of .. Page Title, Description, Keywords

            return view(
                "frontEnd." . $PageName,
                compact(
                    "WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "WebmasterSection",
                    "name_section",
                    "thisDetailMenu",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "type_page",
                    // "SectionPage",
                    // "Topic",
                    "Topics",
                    "title_var",
                    "details_var",
                    "file_var",
                    "slug_var",
                    // "category_and_topics_count"
                )
            );
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }
    public function GetAdmitionStudeiswithid($id, $page)
    {
        return $this->GetAdmitionStudeisbyLang('', $id, $page);
    }
    public function GetAdmitionStudeiswithidbylang($lang, $id, $page)
    {
        return $this->GetAdmitionStudeisbyLang($lang, $id, $page);
    }
    public function GetAdmitionStudeis($id)
    {
        return $this->GetAdmitionStudeisbyLang('', $id, 0);
    }
    public function GetAdmitionStudeisbyLang($lang = '', $typevar, $page = 0)
    {
        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
        // $section='events';
        $type_page = 'topic';
        $viewtype = 'text';
        $page_id = 0;
        $studies_id = 0;
        $cat_page_id = 0;

        $PageNametype = "topic";
        if (is_string($typevar)) {
            $PageNametype = $typevar;
        } elseif (is_numeric($typevar)) {
            $page_id = $typevar;
        }

        if (is_numeric($page)) {
            $cat_page_id = $page;
        }
        if ($cat_page_id == 1) {
            $viewtype = 'timeline';
        } elseif ($cat_page_id == 3) {
            $viewtype = 'accordion';
        }
        $BannerPage = "uploads/banar.jpg";
        $liststudies = array(1 => trans('frontLang.Graduate_Studies'), 2 => trans('frontLang.Undergraduate_Studies'));




        $listcat_page = array(1 => trans('frontLang.Admission_Guide'), 2 => trans('frontLang.Admission_Requirments'), 3 => trans('frontLang.Study_Programs'), 4 => trans('frontLang.Terms_Admission'), 5 => trans('frontLang.Course_Equivalence'), 6 => trans('frontLang.Programs_Fees'));
        if (isset($liststudies[$typevar])) {
            $PageNametype = "topic";
            $studies_id = $typevar;
        }
        $breadcrumbTitle = "";
        if (isset($listcat_page[$page])) {
            $PageNametype = "topic";
            $cat_page_id = $page;
            $breadcrumbTitle = $listcat_page[$cat_page_id];
        }




        $WebmasterSection = WebmasterSection::where('name', 'admissioncontent')->first();

        //
        $segments = \Request::segments();
        $lang_code = trans('backLang.boxCode');
        if (in_array($lang_code, $segments)) {
            unset($segments[0]);

            //dd($segments);
        }
        $fullPagePath = implode('/', $segments);
        //  dd($fullPagePath);
        $listTopic_id = array();
        $Topics = Topic::where('status', 1)->where('webmaster_id', $WebmasterSection->id)->orderby('row_no', 'asc')->get();

        if (count((array)$Topics) == 0) {
            return redirect()->action('FrontendHomeController@HomePage');
        }

        foreach ($Topics as  $Item) {
            if ((isset($Item->fields) && isset($Item->fields[0]) && $Item->fields[0]->field_value != ''  && $Item->fields[0]->field_value == $studies_id) && (isset($Item->fields) && isset($Item->fields[1]) && $Item->fields[1]->field_value != ''  && $Item->fields[1]->field_value == $cat_page_id)) {
                array_push($listTopic_id, $Item->id);
            }
        }
        //dd($listTopic_id);
        $Topics = Topic::where('status', 1)->whereIn('id', $listTopic_id)->orderby('row_no', 'asc')->get();
        // General for all pages
        if (count((array)$Topics) == 0 && $studies_id == 0) {
            return redirect()->action('FrontendHomeController@HomePage');
        }
        $father_id = 0;
        $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();
        if (!empty($thisDetailMenu)) {
            $father_id = $thisDetailMenu->father_id;
        }
        $sideBarMenuadmission = Menu::where('status', 1)->where('father_id', $father_id)->get();

        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
            'status',
            1
        )->orderby('row_no', 'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
            'status',
            1
        )->orderby('row_no', 'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }



        // Page Title, Description, Keywords
        $seo_title_var = "seo_title_" . trans('backLang.boxCode');
        $seo_description_var = "seo_description_" . trans('backLang.boxCode');
        $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
        $tpc_title_var = "title_" . trans('backLang.boxCode');
        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');


        // Page Title, Description, Keywords
        $seo_title_var = "seo_title_" . trans('backLang.boxCode');
        $seo_description_var = "seo_description_" . trans('backLang.boxCode');
        $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
        $tpc_title_var = "title_" . trans('backLang.boxCode');
        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = $WebsiteSettings->$seo_title_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$seo_keywords_var;

        if (isset($Topics[0])) {

            $BannerPage = $Topics[0]->photo_file;
            if ($Topics[0]->$seo_title_var != "") {
                $PageTitle = $Topics[0]->$seo_title_var;
            } else {
                $PageTitle = $Topics[0]->$tpc_title_var;
            }
            if ($Topics[0]->$seo_description_var != "") {
                $PageDescription = $Topics[0]->$seo_description_var;
            } else {
                $PageDescription = $WebsiteSettings->$site_desc_var;
            }
            if ($Topics[0]->$seo_keywords_var != "") {
                $PageKeywords = $Topics[0]->$seo_keywords_var;
            } else {
                $PageKeywords = $WebsiteSettings->$site_keywords_var;
            }
        }




        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');
        $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
        // .. end of .. Page Title, Description, Keywords






        // .. end of .. Page Title, Description, Keywords

        return view(
            "frontEnd.admissionPage",
            compact(
                "WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "thisDetailMenu",
                "sideBarMenuadmission",
                "Topics",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "viewtype",
                "PageNametype",
                "BannerPage",
                "breadcrumbTitle",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
            )
        );
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function GetDetilaInfoTopic($id)
    {
        return $this->GetDetilaInfoTopicBylang('', $id);
    }
    public function GetDetilaInfoTopicBylang($lang = "", $id = 0)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);


        $Topic = Topic::where('status', 1)->find($id);



        // count topics by Category
        $category_and_topics_count = array();
        $fullPagePath = Helper::GetUrlMenuOnly();


        $segments = \Request::segments();
        $lang_code = trans('backLang.boxCode');
        if (in_array($lang_code, $segments)) {
            unset($segments[0]);

            //dd($segments);
        }
        $fullPagePath = implode('/', $segments);




        if (count((array)$Topic) > 0) {
            // update visits
            $Topic->visits = $Topic->visits + 1;
            $Topic->save();


            // General for all pages
            $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();


            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
            $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
            $FooterMenuLinks_name_ar = "";
            $FooterMenuLinks_name_en = "";
            if (count((array)$FooterMenuLinks_father) > 0) {
                $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
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


            return view(
                "frontEnd.item_details",
                compact(
                    "WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "Topic",
                    // "WebmasterSection",
                    "PageTitle",
                    "PageDescription",
                    "thisDetailMenu",
                    "PageKeywords",
                    "category_and_topics_count"
                )
            );
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ViewCustomPage($PageName)
    {
        return $this->ViewCustomPageByLang("", $PageName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ViewCustomPageByLang($lang = "", $PageName)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);



        $segments = \Request::segments();
        $lang_code = trans('backLang.boxCode');
        if (in_array($lang_code, $segments)) {
            unset($segments[0]);

            //dd($segments);
        }
        $fullPagePath = implode('/', $segments);
        //$thisDetailMenu = Menu::where('link',$fullPagePath)->with('parentMenus')->first();




        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
            'status',
            1
        )->orderby('row_no', 'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
            'status',
            1
        )->orderby('row_no', 'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }



        // Page Title, Description, Keywords

        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');

        $title_var = "title_" . trans('backLang.boxCode');
        $seo_title_var = "seo_title_" . trans('backLang.boxCode');
        $seo_description_var = "seo_description_" . trans('backLang.boxCode');
        $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
        $tpc_title_var = "title_" . trans('backLang.boxCode');
        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = $WebsiteSettings->$seo_title_var;
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;
        // .. end of .. Page Title, Description, Keywords

        return view(
            "frontEnd." . $PageName,
            compact(
                "WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "WebmasterSection",
                "thisDetailMenu",
                "file_var",
                "slug_var",
                "title_var",
                "details_var",
                "PageTitle",
                "PageDescription",
                "PageKeywords"
            )
        );
    }
    public function getacademicstaffBySection($id)
    {
        return $this->getacademicstaffBySectionByLang('', $id);
    }
    public function getacademicstaffBySectionByLang($lang = "", $id)
    {


        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $type_page = 'topic';










        // count topics by Category
        $Topic = "";
        $Topics = array();
        //  dd($id);
        $fullPagePath = Helper::GetUrlMenuOnly();
        $segments = \Request::segments();
        $lang_code = trans('backLang.boxCode');
        if (in_array($lang_code, $segments)) {
            unset($segments[0]);

            //dd($segments);
        }
        $fullPagePath = implode('/', $segments);


        $listPagination = array('events', 'announcements', 'photos', 'videos');
        $Section = Section::where('status', 1)->orderby('row_no', 'asc')->find($id);



        if (count((array)$Section) == 0) {
            return redirect()->action('FrontendHomeController@HomePage');
        }


        $Topics = Staff::where('status', 1)->where('previous_emp', 0)->where('section_id', $Section->id)->get();

        if (count((array)$Topics) == 0) {
            return redirect()->action('FrontendHomeController@HomePage');
        }

        $StaffLevel1 = Staff::where('status', 1)->where('level_view', 1)->where('section_id', $Section->id)->first();
        $StaffLevel2 = Staff::where('status', 1)->where('level_view', 2)->where('section_id', $Section->id)->get();
        $StaffLevel3 = Staff::where('status', 1)->where('level_view', 3)->where('section_id', $Section->id)->get();
        // General for all pages

        $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();

        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
            'status',
            1
        )->orderby('row_no', 'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
            'status',
            1
        )->orderby('row_no', 'asc')->get();
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

        // Page Title, Description, Keywords
        $name_section = $Section->$title_var;
        $backgroundImage = "uploads/banar.jpg";
        if ($Section->photo != '' && $Section->photo != '#') {
            $backgroundImage = $Section->photo;
        }
        $seo_title_var = "seo_title_" . trans('backLang.boxCode');
        $seo_description_var = "seo_description_" . trans('backLang.boxCode');
        $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
        $tpc_title_var = "title_" . trans('backLang.boxCode');
        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');


        if ($Section->$seo_title_var != "") {
            $PageTitle = $Section->$seo_title_var;
        } else {
            $PageTitle = $WebmasterSection->$tpc_title_var;
        }
        if ($Section->$seo_description_var != "") {
            $PageDescription = $Section->$seo_description_var;
        } else {
            $PageDescription = $WebsiteSettings->$site_desc_var;
        }
        if ($Section->$seo_keywords_var != "") {
            $PageKeywords = $Section->$seo_keywords_var;
        } else {
            $PageKeywords = $WebsiteSettings->$site_keywords_var;
        }



        // .. end of .. Page Title, Description, Keywords

        return view(
            "frontEnd.academicstaff",
            compact(
                "WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "thisDetailMenu",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "name_section",
                "backgroundImage",
                "Topic",
                "Topics",
                "StaffLevel1",
                "StaffLevel2",
                "StaffLevel3",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
            )
        );
    }
    public function getacademicstaffPreviousBySection($id)
    {
        return $this->getacademicstaffPreviousBySectionByLang('', $id);
    }
    public function getacademicstaffPreviousBySectionByLang($lang = "", $id)
    {


        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $type_page = 'topic';










        // count topics by Category
        $Topic = "";
        $Topics = array();
        //  dd($id);
        $fullPagePath = Helper::GetUrlMenuOnly();
        $segments = \Request::segments();
        $lang_code = trans('backLang.boxCode');
        if (in_array($lang_code, $segments)) {
            unset($segments[0]);

            //dd($segments);
        }
        $fullPagePath = implode('/', $segments);


        $listPagination = array('events', 'announcements', 'photos', 'videos');
        $Section = Section::where('status', 1)->orderby('row_no', 'asc')->find($id);



        if (count((array)$Section) == 0) {
            return redirect()->action('FrontendHomeController@HomePage');
        }


        $Topics = Staff::where('status', 1)->where('previous_emp', 1)->where('section_id', $Section->id)->get();

        if (count((array)$Topics) == 0) {
            return redirect()->action('FrontendHomeController@HomePage');
        }
        $SectionEmployee = Section::where('status', 1)->orderby('row_no', 'asc')->find(41);
        $Staffemployee = Staff::where('status', 1)->where('level_view', 1)->where('previous_emp', 1)->where('section_id', $SectionEmployee->id)->get();
        $StaffLevel2 = Staff::where('status', 1)->where('level_view', 2)->where('previous_emp', 1)->where('section_id', $Section->id)->get();
        $StaffLevel3 = Staff::where('status', 1)->where('level_view', 3)->where('section_id', $Section->id)->get();
        // General for all pages

        $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();

        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
            'status',
            1
        )->orderby('row_no', 'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
            'status',
            1
        )->orderby('row_no', 'asc')->get();
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

        // Page Title, Description, Keywords
        $name_section = $Section->$title_var;
        $backgroundImage = "uploads/banar.jpg";
        if ($Section->photo != '' && $Section->photo != '#') {
            $backgroundImage = $Section->photo;
        }
        $seo_title_var = "seo_title_" . trans('backLang.boxCode');
        $seo_description_var = "seo_description_" . trans('backLang.boxCode');
        $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
        $tpc_title_var = "title_" . trans('backLang.boxCode');
        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');


        if ($Section->$seo_title_var != "") {
            $PageTitle = $Section->$seo_title_var;
        } else {
            $PageTitle = $WebmasterSection->$tpc_title_var;
        }
        if ($Section->$seo_description_var != "") {
            $PageDescription = $Section->$seo_description_var;
        } else {
            $PageDescription = $WebsiteSettings->$site_desc_var;
        }
        if ($Section->$seo_keywords_var != "") {
            $PageKeywords = $Section->$seo_keywords_var;
        } else {
            $PageKeywords = $WebsiteSettings->$site_keywords_var;
        }



        // .. end of .. Page Title, Description, Keywords

        return view(
            "frontEnd.boardtrusteesprevious",
            compact(
                "WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "thisDetailMenu",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "name_section",
                "backgroundImage",
                "Topic",
                "Topics",
                "SectionEmployee",
                "Staffemployee",
                "StaffLevel2",
                "StaffLevel3",
                "title_var",
                "details_var",
                "file_var",
                "slug_var"
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function GetAcademicstaffDetail($id)
    {
        return $this->GetAcademicstaffDetailByLang('', $id);
    }
    public function GetAcademicstaffDetailByLang($lang = "", $id = 0)
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
        $fullPagePath = Helper::GetUrlMenuOnly();


        $segments = \Request::segments();
        $lang_code = trans('backLang.boxCode');
        if (in_array($lang_code, $segments)) {
            unset($segments[0]);

            //dd($segments);
        }
        $fullPagePath = implode('/', $segments);




        if (count((array)$Topic) > 0) {
            // update visits
            // $Topic->visits = $Topic->visits + 1;
            // $Topic->save();
            $Section_id = $Topic->section_id;

            $Section = Section::where('status', 1)->find($Section_id);

            // General for all pages
            $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();


            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
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
            $name_section = $Section->$title_var;
            $backgroundImage = "uploads/banar.jpg";
            if (!empty($Section->photo) && $Section->photo != '#') {
                $backgroundImage = $Section->photo;
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


            return view(
                "frontEnd.detailboard",
                compact(
                    "WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
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
                )
            );
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function GetphotosDetail($id)
    {
        return $this->GetphotosDetailByLang('', $id);
    }
    public function GetphotosDetailByLang($lang = "", $id = 0)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);


        $Topic = Topic::where('status', 1)->find($id);



        // count topics by Category
        $category_and_topics_count = array();
        $fullPagePath = Helper::GetUrlMenuOnly();


        $segments = \Request::segments();
        $lang_code = trans('backLang.boxCode');
        if (in_array($lang_code, $segments)) {
            unset($segments[0]);

            //dd($segments);
        }
        $fullPagePath = implode('/', $segments);




        if (count((array)$Topic) > 0) {
            // update visits
            $Topic->visits = $Topic->visits + 1;
            $Topic->save();


            // General for all pages
            $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();


            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
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


            return view(
                "frontEnd.photosdetail",
                compact(
                    "WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "Topic",
                    "WebmasterSection",
                    "PageTitle",
                    "PageDescription",
                    "thisDetailMenu",
                    "PageKeywords",
                    "title_var",
                    "details_var",
                    "file_var",
                    "slug_var"
                )
            );
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetPrograms($id)
    {
        return $this->GetProgramsByLang('', $id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetProgramsByLang($lang = "", $id)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed = 'navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
        //
        $WebmasterSection = WebmasterSection::where('name', 'programs')->first();
        if (count((array)$WebmasterSection) == 0) {
            // get Webmaster section settings by ID
            return redirect()->action('FrontendHomeController@HomePage');
        }
        $segments = \Request::segments();
        $ProgramNameSegment = \Request::segment(2);
        $lang_code = trans('backLang.boxCode');
        if (in_array($lang_code, $segments)) {
            unset($segments[0]);
            $ProgramNameSegment = \Request::segment(3);
            // dd($segments);
        }
        $fullPagePath = implode('/', $segments);
        // General for all pages
        $Programname = "title_" . trans('backLang.boxCode');
        //$defultFaculty= Topic::where([['status', 1], ['webmaster_id', $WebmasterSection->id]])->first();

        //dd($fullPagePath);


        //$program= Program::where('status', 1)->find($id);
        $program = Program::where('status', 1)->find($id);




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




        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
            'status',
            1
        )->orderby(
            'row_no',
            'asc'
        )->get();
        $HeaderMenuOnePageLinks = Menu::where('father_id', 96)->where(
            'status',
            1
        )->orderby(
            'row_no',
            'asc'
        )->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
            'status',
            1
        )->orderby(
            'row_no',
            'asc'
        )->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

        $contact_page_id = $WebmasterSettings->contact_page_id;
        $ContactUsData = Topic::where('status', 1)->find($contact_page_id);


        $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();


        $quicklinks = Topic::where([['status', 1], ['webmaster_id', 10]])->where('father_id', $program->id)->orderby('row_no', 'asc')->get();








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




        return view(
            "frontEnd.programs",
            compact(
                "WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuOnePageLinks",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "program",
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
            )
        );
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Getuniversitycenter($id)
    {
        return $this->GetuniversitycenterByLang('', $id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetuniversitycenterByLang($lang = "", $id)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        $navbar_fixed = 'navbar_fixed';
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
        //
        //   $WebmasterSection = WebmasterSection::where('name','universitycenters')->first();
        // if (count((array)$WebmasterSection) == 0) {
        //     // get Webmaster section settings by ID
        //      return redirect()->action('FrontendHomeController@HomePage');
        // }
        $segments = \Request::segments();
        $ProgramNameSegment = \Request::segment(2);
        $lang_code = trans('backLang.boxCode');
        if (in_array($lang_code, $segments)) {
            unset($segments[0]);
            $ProgramNameSegment = \Request::segment(3);
            // dd($segments);
        }
        $fullPagePath = implode('/', $segments);
        // General for all pages
        $Programname = "title_" . trans('backLang.boxCode');
        //$defultFaculty= Topic::where([['status', 1], ['webmaster_id', $WebmasterSection->id]])->first();

        //dd($fullPagePath);




        $universitycenter = UniversityCenter::where('status', 1)->with('mycontent')->with('staffs')->find($id);


        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');
        $slug_var = "seo_url_slug_" . trans('backLang.boxCode');

        if (count((array)$universitycenter) == 0) {
            // get Webmaster section settings by ID
            // if (count((array)$FacultyData)>0) {
            //     return redirect('faculties/'.$FacultyData->$title_var);
            // }
            return redirect()->action('FrontendHomeController@HomePage');
        }




        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
            'status',
            1
        )->orderby(
            'row_no',
            'asc'
        )->get();

        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
            'status',
            1
        )->orderby(
            'row_no',
            'asc'
        )->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count((array)$FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

        $contact_page_id = $WebmasterSettings->contact_page_id;
        $ContactUsData = Topic::where('status', 1)->find($contact_page_id);


        $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();


        $quicklinks = Topic::where([['status', 1], ['webmaster_id', 10]])->where('father_id', $universitycenter->id)->orderby('row_no', 'asc')->get();



        $contentscenters = $universitycenter->mycontent;
        $centeracademics = $universitycenter->staffs;



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
        if ($universitycenter->$seo_title_var != "") {
            $PageTitle = $universitycenter->$seo_title_var;
        } else {
            $PageTitle = $universitycenter->$tpc_title_var;
        }
        if ($universitycenter->$seo_description_var != "") {
            $PageDescription = $universitycenter->$seo_description_var;
        } else {
            $PageDescription = $WebsiteSettings->$site_desc_var;
        }
        if ($universitycenter->$seo_keywords_var != "") {
            $PageKeywords = $universitycenter->$seo_keywords_var;
        } else {
            $PageKeywords = $WebsiteSettings->$site_keywords_var;
        }


        // .. end of .. Page Title, Description, Keywords




        return view(
            "frontEnd.universitycenter",
            compact(
                "WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "universitycenter",
                "thisDetailMenu",
                "contentscenters",
                "centeracademics",
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
            )
        );
    }

    public function getlecturertable($section)
    {
        return $this->getlecturertablebyLang('', $section);
    }
    public function getlecturertablebyLang($lang = "", $section)
    {


        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
        $sectionM = $section;
        $type_page = 'topic';




        // get Webmaster section settings by name
        $WebmasterSection = WebmasterSection::where('name', 'lecturertable')->first();

        if (count((array)$WebmasterSection) > 0) {

            // count topics by Category

            //  dd($id);
            $fullPagePath = Helper::GetUrlMenuOnly();
            $segments = \Request::segments();
            $lang_code = trans('backLang.boxCode');
            if (in_array($lang_code, $segments)) {
                unset($segments[0]);

                //dd($segments);
            }
            $fullPagePath = implode('/', $segments);

            $listPagination = array('events', 'announcements', 'photos', 'videos');

            // $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orderby('row_no', 'asc')->get();
            $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1]])->orderby('row_no', 'asc')->get();




            //dd($fullPagePath);


            // General for all pages

            $thisDetailMenu = Menu::where('link', $fullPagePath)->with('parentMenus')->first();

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where(
                'status',
                1
            )->orderby('row_no', 'asc')->get();
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

            // Page Title, Description, Keywords
            $name_section = trans('backLang.' . $WebmasterSection->name);
            $seo_title_var = "seo_title_" . trans('backLang.boxCode');
            $seo_description_var = "seo_description_" . trans('backLang.boxCode');
            $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
            $tpc_title_var = "title_" . trans('backLang.boxCode');
            $site_desc_var = "site_desc_" . trans('backLang.boxCode');
            $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');


            if ($WebmasterSection->$seo_title_var != "") {
                $PageTitle = $WebmasterSection->$seo_title_var;
            } else {
                $PageTitle = $WebmasterSection->$tpc_title_var;
            }
            if ($WebmasterSection->$seo_description_var != "") {
                $PageDescription = $WebmasterSection->$seo_description_var;
            } else {
                $PageDescription = $WebsiteSettings->$site_desc_var;
            }
            if ($WebmasterSection->$seo_keywords_var != "") {
                $PageKeywords = $WebmasterSection->$seo_keywords_var;
            } else {
                $PageKeywords = $WebsiteSettings->$site_keywords_var;
            }


            $PageName = $WebmasterSection->name;
            // .. end of .. Page Title, Description, Keywords

            return view(
                "frontEnd.lecturertable",
                compact(
                    "WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "WebmasterSection",
                    "name_section",
                    "thisDetailMenu",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "type_page",
                    "SectionPage",
                    "Topic",
                    "Topics",
                    "title_var",
                    "details_var",
                    "file_var",
                    "slug_var",
                    "category_and_topics_count"
                )
            );
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function ContactPageSubmit(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            //'contact_subject' => 'required|string|max:255',
            'contact_message' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            $messages =  $validator->errors()->all();
            return response()->json([

                'Message' => $messages[0],
                'Status' => '0',

            ], 400);
        }
        //   $uploadedFile = $request->file('file');

        //  echo $uploadedFile;
        //   dd($request->all());
        //  $fileName = time().'.'.$request->file;

        // $request->file->move(public_path('uploads'), $fileName);

        if (env('NOCAPTCHA_STATUS', false)) {
            $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }
        // SITE SETTINGS
        $WebsiteSettings = Setting::find(1);
        $site_title_var = "site_title_" . trans('backLang.boxCode');
        $site_email = $WebsiteSettings->site_webmails;
        $site_url = $WebsiteSettings->site_url;
        $site_title = $WebsiteSettings->$site_title_var;

        $Webmail = new Webmail;
        $Webmail->cat_id = 0;
        $Webmail->group_id = null;
        $Webmail->title = $request->contact_name;
        if (isset($request->contact_subject)) {
            $Webmail->title = $request->contact_subject;
        }

        $Webmail->details = $request->contact_message;
        $Webmail->date = date("Y-m-d H:i:s");
        $Webmail->from_email = $request->contact_email;
        $Webmail->from_name = $request->contact_name;
        $Webmail->from_phone = $request->contact_phone;
        $Webmail->to_email = $WebsiteSettings->site_webmails;
        $Webmail->to_name = $site_title;
        $Webmail->status = 0;
        $Webmail->flag = 0;
        $status = $Webmail->save();
        if (!$status) {
            return response()->json([

                'Message' => $obj->error . 'خطأ: برجاء إعادة المحاولة',
                'Status' => '0',

            ], 400);
            //  return response()->json($network, 500);
        }

        // SEND Notification Email
        if ($WebsiteSettings->notify_messages_status) {
            if (env('MAIL_USERNAME') != "") {
                Mail::send('backEnd.emails.webmail', [
                    'title' => "NEW MESSAGE:" . $request->contact_subject,
                    'details' => $request->contact_message,
                    'websiteURL' => $site_url,
                    'websiteName' => $site_title
                ], function ($message) use ($request, $site_email, $site_title) {
                    $message->from(env('NO_REPLAY_EMAIL', $request->contact_email), $request->contact_name);
                    $message->to($site_email);
                    $message->replyTo($request->contact_email, $site_title);
                    $message->subject($request->contact_subject);
                });
            }
        }
        return response()->json([

            'Message' => '  تم إرسال رسالتكم بنجاح، وسنقوم بالتواصل معكم في أقرب وقت ممكن. نشكركم لمراسلتنا! ',
            'Status' => '1',

        ], 201);
        // return "OK";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function subscribeSubmit(Request $request)
    {


        $this->validate($request, [
            'subscribe_name' => 'required|string|max:255',
            'subscribe_email' => 'required|email'
        ]);

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $Contacts = Contact::where('email', $request->subscribe_email)->get();
        if (count((array)$Contacts) > 0) {
            return trans('frontLang.subscribeToOurNewsletterError');
        } else {
            $subscribe_names = explode(' ', $request->subscribe_name, 2);

            $Contact = new Contact;
            $Contact->group_id = $WebmasterSettings->newsletter_contacts_group;
            $Contact->first_name = @$subscribe_names[0];
            $Contact->last_name = @$subscribe_names[1];
            $Contact->email = $request->subscribe_email;
            $Contact->status = 1;
            $Contact->save();

            return "OK";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function commentSubmit(Request $request)
    {

        $this->validate($request, [
            'comment_name' => 'required|string|max:255',
            'comment_message' => 'required|string|max:255',
            'topic_id' => 'required',
            'comment_email' => 'required|email'
        ]);

        if (env('NOCAPTCHA_STATUS', false)) {
            $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $next_nor_no = Comment::where('topic_id', '=', $request->topic_id)->max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }

        $Comment = new Comment;
        $Comment->row_no = $next_nor_no;
        $Comment->name = $request->comment_name;
        $Comment->email = $request->comment_email;
        $Comment->comment = $request->comment_message;
        $Comment->topic_id = $request->topic_id;;
        $Comment->date = date("Y-m-d H:i:s");
        $Comment->status = $WebmasterSettings->new_comments_status;
        $Comment->save();

        // Site Details
        $WebsiteSettings = Setting::find(1);
        $site_title_var = "site_title_" . trans('backLang.boxCode');
        $site_email = $WebsiteSettings->site_webmails;
        $site_url = $WebsiteSettings->site_url;
        $site_title = $WebsiteSettings->$site_title_var;

        // Topic details
        $Topic = Topic::where('status', 1)->find($request->topic_id);
        if (count((array)$Topic) > 0) {
            $tpc_title_var = "title_" . trans('backLang.boxCode');
            $tpc_title = $WebsiteSettings->$tpc_title_var;

            // SEND Notification Email
            if ($WebsiteSettings->notify_comments_status) {
                if (env('MAIL_USERNAME') != "") {
                    Mail::send('backEnd.emails.webmail', [
                        'title' => "NEW Comment on :" . $tpc_title,
                        'details' => $request->comment_message,
                        'websiteURL' => $site_url,
                        'websiteName' => $site_title
                    ], function ($message) use ($request, $site_email, $site_title, $tpc_title) {
                        $message->from(env('NO_REPLAY_EMAIL', $request->comment_email), $request->comment_name);
                        $message->to($site_email);
                        $message->replyTo($request->comment_email, $site_title);
                        $message->subject("NEW Comment on :" . $tpc_title);
                    });
                }
            }
        }

        return "OK";
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function orderSubmit(Request $request)
    {

        $this->validate($request, [
            'order_name' => 'required|string|max:255',
            'order_phone' => 'required',
            'order_qty' => 'required',
            'topic_id' => 'required',
            'order_email' => 'required|email'
        ]);


        $WebsiteSettings = Setting::find(1);
        $site_title_var = "site_title_" . trans('backLang.boxCode');
        $site_email = $WebsiteSettings->site_webmails;
        $site_url = $WebsiteSettings->site_url;
        $site_title = $WebsiteSettings->$site_title_var;

        $Topic = Topic::where('status', 1)->find($request->topic_id);
        if (count((array)$Topic) > 0) {
            $tpc_title_var = "title_" . trans('backLang.boxCode');
            $tpc_title = $WebsiteSettings->$tpc_title_var;

            $Webmail = new Webmail;
            $Webmail->cat_id = 0;
            $Webmail->group_id = null;
            $Webmail->contact_id = null;
            $Webmail->father_id = null;
            $Webmail->title = "ORDER " . ", Qty=" . $request->order_qty . ", " . $Topic->$tpc_title_var;
            $Webmail->details = $request->order_message;
            $Webmail->date = date("Y-m-d H:i:s");
            $Webmail->from_email = $request->order_email;
            $Webmail->from_name = $request->order_name;
            $Webmail->from_phone = $request->order_phone;
            $Webmail->to_email = $WebsiteSettings->site_webmails;
            $Webmail->to_name = $WebsiteSettings->$site_title_var;
            $Webmail->status = 0;
            $Webmail->flag = 0;
            $Webmail->save();


            // SEND Notification Email
            $msg_details = "$tpc_title <br> Qty = " . $request->order_qty . "<hr>" . $request->order_message;
            if ($WebsiteSettings->notify_orders_status) {
                if (env('MAIL_USERNAME') != "") {
                    Mail::send('backEnd.emails.webmail', [
                        'title' => "NEW Order on :" . $tpc_title,
                        'details' => $msg_details,
                        'websiteURL' => $site_url,
                        'websiteName' => $site_title
                    ], function ($message) use ($request, $site_email, $site_title, $tpc_title) {
                        $message->from(env('NO_REPLAY_EMAIL', $request->order_email), $request->order_name);
                        $message->to($site_email);
                        $message->replyTo($request->order_email, $site_title);
                        $message->subject("NEW Comment on :" . $tpc_title);
                    });
                }
            }
        }

        return "OK";
    }
}
