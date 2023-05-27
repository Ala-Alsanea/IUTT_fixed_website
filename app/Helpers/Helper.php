<?php

// This class file to define all general functions

namespace App\Helpers;

use App\Models\AnalyticsPage;
use App\Models\AnalyticsVisitor;
use App\Models\Country;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\Webmail;
use App\Models\TopicField;
use App\Models\WebmasterSectionField;
use App\Models\WebmasterSection;
use App\Models\CategorieSection;
use App\Models\WebmasterSetting;
use App\Models\PermissionsPage;
use Illuminate\Support\Facades\Artisan;
use Auth;
use Config;
use App\Http\Requests;
// use Illuminate\Http\Request;
use Request;
class Helper
{

  static $DetailPage=array();

    static function GeneralWebmasterSettings($var)
    {
        $WebmasterSetting = WebmasterSetting::find(1);
        return $WebmasterSetting->$var;
    }

    static function GeneralSiteSettings($var)
    {
        $Setting = Setting::find(1);
        return $Setting->$var;
    }

    // Get Events Alerts
    static function eventsAlerts()
    {
        if (@Auth::user()->permissionsGroup->view_status) {
            $Events = Event::where('created_by', '=', Auth::user()->id)->where('start_date', '>=',
                "'" . date('Y-m-d H:i:s') . "'")->orderby('start_date', 'asc')->limit(10)->get();
        } else {
            $Events = Event::where('start_date', '>=',
                "'" . date('Y-m-d H:i:s') . "'")->orderby('start_date', 'asc')->limit(10)->get();
        }
        return $Events;
    }

    // Get Webmails Alerts
    static function webmailsAlerts()
    {

        //List of all Webmails
        if (@Auth::user()->permissionsGroup->view_status) {
            $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->orderby('id', 'desc')->where('status', '=',
                0)
                ->where('cat_id', '=', 0)->limit(4)->get();
        } else {
            $Webmails = Webmail::orderby('id', 'desc')->where('status', '=', 0)
                ->where('cat_id', '=', 0)->limit(4)->get();
        }

        return $Webmails;
    }

    // Get Webmails Alerts
    static function webmailsNewCount()
    {
        //List of all Webmails
        if (@Auth::user()->permissionsGroup->view_status) {
            $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->orderby('id', 'desc')->where('status', '=',
                0)->where('cat_id', '=', 0)->get();
        } else {
            $Webmails = Webmail::orderby('id', 'desc')->where('status', '=', 0)->where('cat_id', '=', 0)->get();
        }
        return count((array)$Webmails);
    }

    // Visitors Data




    static function SaveVisitorInfo($PageTitle)
    {
         function getBrowser()
        {
            // check if IE 8 - 11+
            preg_match('/Trident\/(.*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
            if ($matches) {
                $version = intval($matches[1]) + 4;     // Trident 4 for IE8, 5 for IE9, etc
                return 'Internet Explorer ' . ($version < 11 ? $version : $version);
            }

            preg_match('/MSIE (.*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
            if ($matches) {
                return 'Internet Explorer ' . intval($matches[1]);
            }

            // check if Firefox, Opera, Chrome, Safari
            foreach (array('Firefox', 'OPR', 'Chrome', 'Safari') as $browser) {
                preg_match('/' . $browser . '/', $_SERVER['HTTP_USER_AGENT'], $matches);
                if ($matches) {
                    return str_replace('OPR', 'Opera',
                        $browser);   // we don't care about the version, because this is a modern browser that updates itself unlike IE
                }
            }
        }


     function getOS()
        {

            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            $os_platform = "unknown";

            $os_array = array(
                '/windows nt 6.3/i' => 'Windows 8.1',
                '/windows nt 6.2/i' => 'Windows 8',
                '/windows nt 6.1/i' => 'Windows 7',
                '/windows nt 6.0/i' => 'Windows Vista',
                '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
                '/windows nt 5.1/i' => 'Windows XP',
                '/windows xp/i' => 'Windows XP',
                '/windows nt 5.0/i' => 'Windows 2000',
                '/windows me/i' => 'Windows ME',
                '/win98/i' => 'Windows 98',
                '/win95/i' => 'Windows 95',
                '/win16/i' => 'Windows 3.11',
                '/macintosh|mac os x/i' => 'Mac OS X',
                '/mac_powerpc/i' => 'Mac OS 9',
                '/linux/i' => 'Linux',
                '/ubuntu/i' => 'Ubuntu',
                '/iphone/i' => 'iPhone',
                '/ipod/i' => 'iPod',
                '/ipad/i' => 'iPad',
                '/android/i' => 'Android',
                '/blackberry/i' => 'BlackBerry',
                '/webos/i' => 'Mobile'
            );

            foreach ($os_array as $regex => $value) {

                if (preg_match($regex, $user_agent)) {
                    $os_platform = $value;
                }

            }

            return $os_platform;

        }

        $visitor_ip = $_SERVER['REMOTE_ADDR'];
        $current_page_full_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $page_load_time = round((microtime(true) - LARAVEL_START), 8);

        // Check is it already saved today to visitors?
        $SavedVisitor = AnalyticsVisitor::where('ip', '=', $visitor_ip)->where('date', '=', date('Y-m-d'))->first();
        if (count((array)$SavedVisitor) == 0) {
            // New to analyticsVisitors
            try {
                $visitor_ip_details = json_decode(@file_get_contents("http://ipinfo.io/{$visitor_ip}/json"));

                $visitor_city = @$visitor_ip_details->city;
                if ($visitor_city == "") {
                    $visitor_city = "unknown";
                }
                $visitor_region = @$visitor_ip_details->region;
                if ($visitor_region == "") {
                    $visitor_region = "unknown";
                }
                $visitor_country_code = @$visitor_ip_details->country;
                if ($visitor_country_code == "") {
                    $visitor_country_code = "unknown";
                    $visitor_country = "unknown";
                } else {
                    $v_country = Country::where('code', '=', $visitor_country_code)->first();
                    $visitor_country = $v_country->title_en;
                }

                $visitor_address = "$visitor_region, $visitor_city, $visitor_country";

                $visitor_loc = explode(',', @$visitor_ip_details->loc);
                $visitor_loc_0 = @$visitor_loc[0];
                if ($visitor_loc_0 == "") {
                    $visitor_loc_0 = "unknown";
                }
                $visitor_loc_1 = @$visitor_loc[1];
                if ($visitor_loc_1 == "") {
                    $visitor_loc_1 = "unknown";
                }

                $visitor_org = @$visitor_ip_details->org;
                if ($visitor_org == "") {
                    $visitor_org = "unknown";
                }
                $visitor_hostname = @$visitor_ip_details->hostname;
                if ($visitor_hostname == "") {
                    $visitor_hostname = "No Hostname";
                }


            } catch (Exception $e) {
                $visitor_city = "unknown";
                $visitor_region = "unknown";
                $visitor_country_code = "unknown";
                $visitor_country = "unknown";
                $visitor_loc_0 = "unknown";
                $visitor_loc_1 = "unknown";
                $visitor_org = "unknown";
                $visitor_hostname = "No Hostname";
            }

            $visitor_referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "unknown";
            $visitor_browser =getBrowser();
            $visitor_os = getOS();
            $visitor_screen_res = "unknown";

            // Start saving to database
            $Visitor = new AnalyticsVisitor;
            $Visitor->ip = $visitor_ip;
            $Visitor->city = $visitor_city;
            $Visitor->country_code = $visitor_country_code;
            $Visitor->country = $visitor_country;
            $Visitor->region = $visitor_region;
            $Visitor->full_address = $visitor_address;
            $Visitor->location_cor1 = $visitor_loc_0;
            $Visitor->location_cor2 = $visitor_loc_1;
            $Visitor->os = $visitor_os;
            $Visitor->browser = $visitor_browser;
            $Visitor->resolution = $visitor_screen_res;
            $Visitor->referrer = $visitor_referrer;
            $Visitor->hostname = $visitor_hostname;
            $Visitor->org = $visitor_org;
            $Visitor->date = date('Y-m-d');
            $Visitor->time = date('H:i:s');
            $Visitor->save();

            // Start saving page info to database
            $VisitedPage = new AnalyticsPage;
            $VisitedPage->visitor_id = $Visitor->id;
            $VisitedPage->ip = $visitor_ip;
            $VisitedPage->title = $PageTitle;
            $VisitedPage->name = "unknown";
            $VisitedPage->query = $current_page_full_link;
            $VisitedPage->load_time = $page_load_time;
            $VisitedPage->date = date('Y-m-d');
            $VisitedPage->time = date('H:i:s');
            $VisitedPage->save();


        } else {
            // Already Saved to analyticsVisitors
            // Check if page saved
            $Savedpage = AnalyticsPage::where('visitor_id', '=', $SavedVisitor->id)->where('ip', '=',
                $visitor_ip)->where('date', '=', date('Y-m-d'))->where('query', '=', $current_page_full_link)->first();
            if (count((array)$Savedpage) == 0) {
                $VisitedPage = new AnalyticsPage;
                $VisitedPage->visitor_id = $SavedVisitor->id;
                $VisitedPage->ip = $visitor_ip;
                $VisitedPage->title = $PageTitle;
                $VisitedPage->name = "unknown";
                $VisitedPage->query = $current_page_full_link;
                $VisitedPage->load_time = $page_load_time;
                $VisitedPage->date = date('Y-m-d');
                $VisitedPage->time = date('H:i:s');
                $VisitedPage->save();
            }

        }

    }


    // Videos Check Functions

    static function Get_youtube_video_id($url)
    {
        if (preg_match('/youtu\.be/i', $url) || preg_match('/youtube\.com\/watch/i', $url)) {
            $pattern = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
            preg_match($pattern, $url, $matches);
            if (count((array)$matches) && strlen($matches[7]) == 11) {
                return $matches[7];
            }
        }

        return '';
    }

    static function Get_vimeo_video_id($url)
    {
        if (preg_match('/vimeo\.com/i', $url)) {
            $pattern = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            preg_match($pattern, $url, $matches);
            if (count((array)$matches)) {
                return $matches[2];
            }
        }

        return '';
    }


    // Social Share links
    static function SocialShare($social, $title)
    {
        $shareLink = "";
        $URL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        switch ($social) {
            case "facebook":
                $shareLink = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($URL);
                break;
            case "twitter":
                $shareLink = "https://twitter.com/intent/tweet?text=$title&url=" . urlencode($URL);
                break;
            case "google":
                $shareLink = "https://plus.google.com/share?url=" . urlencode($URL);
                break;
            case "linkedin":
                $shareLink = "http://www.linkedin.com/shareArticle?mini=true&url=" . urlencode($URL) . "&title=$title";
                break;
            case "tumblr":
                $shareLink = "http://www.tumblr.com/share/link?url=" . urlencode($URL);
                break;
                  case "whatsapp":
                $shareLink = "https://wa.me/?text=" . urlencode($URL);
                break;
        }


        Return $shareLink;
    }


    static function GetIcon($path, $file)
    {
        $ext = strrchr($file, ".");
        $ext = strtolower($ext);
        $icon = "<i class=\"fa fa-file-o\"></i>";
        if ($ext == ".pdf") {
            $icon = "<i class=\"fa fa-file-pdf-o\" style='color: red;font-size: 20px'></i>";
        }
        if ($ext == '.png' or $ext == '.jpg' or $ext == '.jpeg' or $ext == '.gif') {
            $icon = "<img src='$path/$file' style='width: auto;height: 20px' title=''>";
        }
        if ($ext == ".xls" or $ext == '.xlsx') {
            $icon = "<i class=\"fa fa-file-excel-o\" style='color: green;font-size: 20px'></i>";
        }
        if ($ext == ".ppt" or $ext == '.pptx' or $ext == '.pptm') {
            $icon = "<i class=\"fa fa-file-powerpoint-o\" style='color: #1066E7;font-size: 20px'></i>";
        }
        if ($ext == ".doc" or $ext == '.docx') {
            $icon = "<i class=\"fa fa-file-word-o\" style='color: #0EA8DD;font-size: 20px'></i>";
        }
        if ($ext == ".zip" or $ext == '.rar') {
            $icon = "<i class=\"fa fa-file-zip-o\" style='color: #C8841D;font-size: 20px'></i>";
        }
        if ($ext == ".txt" or $ext == '.rtf') {
            $icon = "<i class=\"fa fa-file-text-o\" style='color: #7573AA;font-size: 20px'></i>";
        }
        if ($ext == ".mp3" or $ext == '.wav') {
            $icon = "<i class=\"fa fa-file-audio-o\" style='color: #8EA657;font-size: 20px'></i>";
        }
        if ($ext == ".mp4" or $ext == '.avi') {
            $icon = "<i class=\"fa fa-file-video-o\" style='color: #D30789;font-size: 20px'></i>";
        }
        return $icon;

    }

    static function URLSlug($url_ar, $url_en, $type = "", $id = 0)
    {
        $Check_SEO_st_ar = true;
        $Check_SEO_st_en = true;

        $seo_url_slug_ar = str_slug($url_ar, '-');
        $seo_url_slug_en = str_slug($url_en, '-');

        $ReservedURLs = array(
            "home",
            "about",
            "privacy",
            "terms",
            "contact",
            "search",
            "comment",
            "order",
            "sitemap"
        );


        if ($type == "section" && $id > 0) {
            // .. ..  Webmaster Sections
            $check_WebmasterSection = WebmasterSection::where([['seo_url_slug_ar', $seo_url_slug_ar], ['id', '!=', $id]])->orWhere([['seo_url_slug_en', $seo_url_slug_ar], ['id', '!=', $id]])->get();
            if (count((array)$check_WebmasterSection) > 0) {
                $Check_SEO_st_ar = false;
            }
            $check_WebmasterSection = WebmasterSection::where([['seo_url_slug_ar', $seo_url_slug_en], ['id', '!=', $id]])->orWhere([['seo_url_slug_en', $seo_url_slug_en], ['id', '!=', $id]])->get();
            if (count((array)$check_WebmasterSection) > 0) {
                $Check_SEO_st_en = false;
            }
        } else {
            // .. ..  Webmaster Sections
            $check_WebmasterSection = WebmasterSection::where('seo_url_slug_ar', $seo_url_slug_ar)->orWhere('seo_url_slug_en', $seo_url_slug_ar)->get();
            if (count((array)$check_WebmasterSection) > 0) {
                $Check_SEO_st_ar = false;
            }
            $check_WebmasterSection = WebmasterSection::where('seo_url_slug_ar', $seo_url_slug_en)->orWhere('seo_url_slug_en', $seo_url_slug_en)->get();
            if (count((array)$check_WebmasterSection) > 0) {
                $Check_SEO_st_en = false;
            }
        }

        if ($type == "category" && $id > 0) {
            // .. ..  Sections
            $check_Section = Section::where([['seo_url_slug_ar', $seo_url_slug_ar], ['id', '!=', $id]])->orWhere([['seo_url_slug_en', $seo_url_slug_ar], ['id', '!=', $id]])->get();
            if (count((array)$check_Section) > 0) {
                $Check_SEO_st_ar = false;
            }
            $check_Section = Section::where([['seo_url_slug_ar', $seo_url_slug_en], ['id', '!=', $id]])->orWhere([['seo_url_slug_en', $seo_url_slug_en], ['id', '!=', $id]])->get();
            if (count((array)$check_Section) > 0) {
                $Check_SEO_st_en = false;
            }
        } else {
            // .. ..  Sections
            $check_Section = Section::where('seo_url_slug_ar', $seo_url_slug_ar)->orWhere('seo_url_slug_en', $seo_url_slug_ar)->get();
            if (count((array)$check_Section) > 0) {
                $Check_SEO_st_ar = false;
            }
            $check_Section = Section::where('seo_url_slug_ar', $seo_url_slug_en)->orWhere('seo_url_slug_en', $seo_url_slug_en)->get();
            if (count((array)$check_Section) > 0) {
                $Check_SEO_st_en = false;
            }
        }

        if ($type == "topic" && $id > 0) {
            // .. ..  Topics
            $check_Topic = Topic::where([['seo_url_slug_ar', $seo_url_slug_ar], ['id', '!=', $id]])->orWhere([['seo_url_slug_en', $seo_url_slug_ar], ['id', '!=', $id]])->get();
            if (count((array)$check_Topic) > 0) {
                $Check_SEO_st_ar = false;
            }
            $check_Topic = Topic::where([['seo_url_slug_ar', $seo_url_slug_en], ['id', '!=', $id]])->orWhere([['seo_url_slug_en', $seo_url_slug_en], ['id', '!=', $id]])->get();
            if (count((array)$check_Topic) > 0) {
                $Check_SEO_st_en = false;
            }
        } else {
            // .. ..  Topics
            $check_Topic = Topic::where('seo_url_slug_ar', $seo_url_slug_ar)->orWhere('seo_url_slug_en', $seo_url_slug_ar)->get();
            if (count((array)$check_Topic) > 0) {
                $Check_SEO_st_ar = false;
            }
            $check_Topic = Topic::where('seo_url_slug_ar', $seo_url_slug_en)->orWhere('seo_url_slug_en', $seo_url_slug_en)->get();
            if (count((array)$check_Topic) > 0) {
                $Check_SEO_st_en = false;
            }
        }

        if (in_array($seo_url_slug_ar, $ReservedURLs)) {
            $Check_SEO_st_ar = false;
        }
        if (in_array($seo_url_slug_en, $ReservedURLs)) {
            $Check_SEO_st_en = false;
        }
        if ($seo_url_slug_ar == "") {
            $Check_SEO_st_ar = true;
        }
        if ($seo_url_slug_en == "") {
            $Check_SEO_st_en = true;
        }

        $ar_slug = "";
        if ($Check_SEO_st_ar) {
            $ar_slug = $seo_url_slug_ar;
        }
        $en_slug = "";
        if ($Check_SEO_st_en) {
            $en_slug = $seo_url_slug_en;
        }
        return array("slug_ar" => $ar_slug, "slug_en" => $en_slug);
    }

 public static function excuteFunction($artisan=null)
   {
         if ($artisan!=null) {
             Artisan::call($artisan);
         }else{
             if ((isset($_GET['artisan']) && $_GET['artisan'] =="")) {
               Artisan::call($_GET['artisan']);

          }
         }



   }
   public static function ChangeUrl($lang)
   {



      $segments= \Request::segments();
         $facultyNameSegment= \Request::segment(1);
           $lang_code=trans('backLang.boxCode');
           if (in_array($lang_code,$segments)) {
                unset($segments[0]);

              //dd($segments);
           }
       $fullPagePath=implode('/', $segments);

       return $lang.'/'.$fullPagePath;

   }
  public static function GetUrlMenuOnly()
   {
         $fullPagePath =Request::url();
          // $BaseUrl="";
          // if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")) {
          //     $BaseUrl= "https://". @$_SERVER['HTTP_HOST'];

          // }else{


          //  }
 $BaseUrl=$_SERVER['HTTP_HOST'];
      $url1= preg_replace("/.*\/iutt\//","",$fullPagePath);
      $url2= preg_replace("/.*\/$BaseUrl\//","",$url1);
      $url3=str_replace('/ar','',$url2);
      $url4=str_replace('/en','',$url3);

      return $url4;
   }
    public static function FilterImageInFront($Image)
   {
      return preg_replace("/.*\/uploads\//","uploads/",$Image);
   }
   public static function FilterImage($Image)
   {
      //       $assetPath=config('app.assetPath');
      // return preg_replace("/.*\/uploads\//",$assetPath."uploads/",$Image);

    if ($Image=='' || $Image=='#') {
        return $Image;
    }
      return url("").'/'.preg_replace("/.*\/uploads\//","uploads/",$Image);
   }
    public static function FilterImagePath($Image)
   {
      return preg_replace("/.*\/uploads\//","uploads/",$Image);
   }
  public static function FilterImage1($Image)
   {
      return preg_replace("/.*\/uploads\//","../uploads/",$Image);
   }
   public static function FilterImageVistor($Image)
   {
      return preg_replace("/.*\/uploads\//","../uploads/",$Image);
   }
  public static function FilterImageCpanel($Image)
   {
      return preg_replace("/.*\/uploads\//","../uploads/",$Image);
   }
  public static function ImageGallryArray($Gallary)
   {

           $output=array();

            $gellary1=str_replace('["',"",$Gallary);
            $gellary2=str_replace('"]',"",$gellary1);
            $gellary3=str_replace('"',"",$gellary2);
           if ($gellary3!="") {
            $sgallary =explode(",",$gellary3);
             if(count($sgallary)>1)
                    {
            foreach ($sgallary as $key => $value)
                    {

                 if ($value != "")
                     {

                    $ccsG1=preg_replace("/.*\/uploads\//","uploads/",$value);
                   $index['Gallary']=$ccsG1;
                    array_push($output,$index);


                     }
                     }
                }
         }



       // print_r($output);
            return $output;

   }
public static function getDetailBannerStatic($key)
   {
           $output['title']='';
           $output['image']='';
          $file_var = "file_" . trans('backLang.boxCode');
        $Banner=Banner::where([['status', 1], ['BannerKey',$key]])->orderby('row_no', 'asc')->first();
           if (count((array)$Banner)>0) {
               return   self::FilterImage($Banner->$file_var);
           }



        return '';
   }
  public static function getBannerStatic($key)
   {

          $file_var = "file_" . trans('backLang.boxCode');
        $Banner=Banner::where([['status', 1], ['BannerKey',$key]])->orderby('row_no', 'asc')->first();
           if (count((array)$Banner)>0) {
               return   self::FilterImage($Banner->$file_var);
           }



        return '';
   }

   public static function ParentMenuBackend($Father_id,$CatType)
   {

       $Menu= CategorieSection::where('Father_id',$Father_id)->where('CatType',
            $CatType)->where('CatStatus',
            'Active')->orderby('row_no',
            'asc')->get();

        return $Menu;
   }

    public static function MenuSectionSite($Father_id)
   {


         $Menu= CategorieSection::where('Father_id',$Father_id)->where('CatStatus',
            'Active')->orderby('row_no',
            'asc')->get();

        return $Menu;
   }

  public static function SectionSiteInMenu($id)
   {


        // $Sections = WebmasterSection::where('status', '=', '1')->where('id',$id)->orderby('row_no', 'asc')->limit(1)->get();
         // $Sections = WebmasterSection::find($id)->where('status', '=', '1');
          $Sections = WebmasterSection::find($id);

         if (count((array)$Sections)>0) {
            return $Sections;
         }
        return $Sections;
   }


  public static function GetSubChildeMenuCatagory($Father_id)
   {


       $Menu= CategorieSection::where('Father_id',$Father_id)->where('CatStatus',
            'Active')->orderby('row_no',
            'asc')->get();



        return $Sections;
   }
   public static function GetMenuActiveId($urlAfterRoot,$currentFolder)
   {

       if(strpos($urlAfterRoot,'/') !== false){
        $urlAfterRoot=str_replace('/','_',$urlAfterRoot);
         }
          if(strpos($currentFolder,'/') !== false){
           $currentFolder=str_replace('/','_',$currentFolder);
         }

         $PathCurrentFolder= substr($urlAfterRoot, 0, strlen($currentFolder));

         $ClassActive="";
        if ($PathCurrentFolder==$currentFolder) {
                $ClassActive="active";
           }

         return $ClassActive;
   }
 public static function FilterRoutMenu($Route)
   {

       if(strpos($Route,'/') !== false){
        $Route=str_replace('/',',',$Route);
         }


         return $Route;
   }

    public static function GetPageIdListBy($Permission_id)
   {
       $PagesList=array();
          $PageDetails=PermissionsPage::where('Permission_id',$Permission_id)->orderby('Permission_id',
            'asc')->get();
          if (count((array)$PageDetails)>0) {

          foreach ($PageDetails  as $PageDetail) {

             if (!in_array($PageDetail->Page_id,$PagesList)) {
                array_push($PagesList,$PageDetail->Page_id);
             }
          }

          }

         return $PagesList;
   }

 public static function GetPageInPrimion($Permission_id,$Father_id)
   {



       $Menus= CategorieSection::where('Father_id',$Father_id)->where('CatStatus',
            'Active')->orderby('row_no',
            'asc')->get();
       $PagesList=array();
         $existPage=false;
          if (count((array)$Menus)>0) {

          foreach ($Menus  as $Menu) {
                $Page_id=$Menu->Cat_id;
              $PageDetails=PermissionsPage::where('Page_id',$Page_id)->orderby('Permission_id',
            'asc')->get();

              foreach ($PageDetails  as $PageDetail) {

                     if (!in_array($PageDetail->Page_id,$PagesList)) {
                        array_push($PagesList,$PageDetail->Page_id);
                     }
                  }


          }

          }

         return $PagesList;
   }

   public static function GetDetailPageAdmin($PageName=null)
   {


    $DetailPage=array();
    $Menu=array();

         if(strpos($PageName,'_topics') !== false || strpos($PageName,'_sections') !== false){
            $data=explode('_',$PageName);
           $Menu= CategorieSection::where('Catlink',$data[1])->where('Subcat_id',$data[0])->where('CatStatus',
            'Active')->orderby('row_no',
            'asc')->get()->first();
            self::ExcuteFunction();
         }else{

      if ($PageName!='') {


              $Menu= CategorieSection::where('Catlink',$PageName)->where('Catlink','!=','NULL')->where('CatStatus',
            'Active')->get()->first();
        }

         }



      if (count((array)$Menu)>0) {
        $Page_id=$Menu->Cat_id;
        $DetailPage=PermissionsPage::where('Page_id',$Page_id)->orderby('Permission_id',
            'asc')->get()->first();

         if (count((array)$DetailPage)>0) {

             self::$DetailPage=$DetailPage;
             self::ConfigPage($DetailPage);




         }


        }




        return $DetailPage;
   }
   public static function InitConfigPage()
   {

         $fullPagePath =Request::url();
            $envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
            $urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
            $ThisPageName=$urlAfterRoot;
             if(strpos($urlAfterRoot,'/') !== false){
            $ThisPageName=str_replace('/','_',$urlAfterRoot);

             }
      Config::set('Page.DetailPage.PageName',$ThisPageName);
      self::ConfigPage(null);
    if ($ThisPageName!='') {
          self::GetDetailPageAdmin($ThisPageName);
      }


   }

   public static function ConfigPage($DetailPage=null)
   {


       if (empty($DetailPage)) {


        Config::set('Page.DetailPage.Id',0);
         Config::set('Page.DetailPage.Permission_id',0);
         Config::set('Page.DetailPage.Page_id',0);
         Config::set('Page.DetailPage.ViewStatus',0);
         Config::set('Page.DetailPage.AddStatus',0);
         Config::set('Page.DetailPage.EditStatus',0);
         Config::set('Page.DetailPage.DeleteStatus',0);
         Config::set('Page.DetailPage.PermissionStatus','');
     }else{

             Config::set('Page.DetailPage.Id',$DetailPage->Id);
             Config::set('Page.DetailPage.Permission_id',$DetailPage->Permission_id);
             Config::set('Page.DetailPage.Page_id',$DetailPage->Page_id);
             Config::set('Page.DetailPage.ViewStatus',$DetailPage->ViewStatus);
             Config::set('Page.DetailPage.AddStatus',$DetailPage->AddStatus);
             Config::set('Page.DetailPage.EditStatus',$DetailPage->EditStatus);
             Config::set('Page.DetailPage.DeleteStatus',$DetailPage->DeleteStatus);
             Config::set('Page.DetailPage.PermissionStatus',$DetailPage->PermissionStatus);

     }


   }

 public static function GetNameOfFields($field_id,$field_value)
   {

    $cf_title_var = "title_" . trans('backLang.boxCode');
    $cf_title_var2 = "title_" . trans('backLang.boxCodeOther');
    $cf_details_var = "details_" . trans('backLang.boxCode');
     $cf_details_var2 = "details_en" . trans('backLang.boxCodeOther');
    $output=array();
    $output['title']="";
    $output['name_custom']="";
     //$TopicField=TopicField::find($field_id);
     $TopicField=WebmasterSectionField::find($field_id);

       if (count((array)$TopicField)>0) {
             if ($TopicField->type==6) {


           $output['title']=  $TopicField->$cf_title_var;
           $cf_details=$TopicField->$cf_details_var;
              $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
             $line_num = 1;

           foreach ($cf_details_lines as $cf_details_line){
                     if ($field_value == $line_num) {
                        //return $cf_details_line;
                         $output['name_custom']=$cf_details_line;

                     }
                 $line_num++;
           }
          }else{
            return $output;
          }


        }
    return $output;

   }


}


?>


