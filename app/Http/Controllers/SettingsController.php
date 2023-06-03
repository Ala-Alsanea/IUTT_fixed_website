<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Setting;
use App\Models\WebmasterSection;
use Illuminate\Support\Facades\Artisan;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class SettingsController extends Controller
{
    // Define Default Settings ID
    private $id = 1;
    private $uploadPath = "uploads/settings/";

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0 && Auth::user()->permissions != 1) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    public function edit()
    {
        //

        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count((array)$Setting) > 0) {
            return view("backEnd.settings.settings", compact("Setting", "GeneralWebmasterSections"));

        } else {
            return redirect()->route('adminHome');
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id = 1 for default settings
     * @return \Illuminate\Http\Response
     */
    public function updateSiteInfo(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count((array)$Setting) > 0) {

            $Setting->site_title_ar = $request->site_title_ar;
            $Setting->site_title_en = $request->site_title_en;
            $Setting->site_desc_ar = $request->site_desc_ar;
            $Setting->site_desc_en = $request->site_desc_en;
            $Setting->site_keywords_ar = $request->site_keywords_ar;
            $Setting->site_keywords_en = $request->site_keywords_en;
            $Setting->site_webmails = $request->site_webmails;
            $Setting->notify_messages_status = $request->notify_messages_status;
            $Setting->notify_comments_status = $request->notify_comments_status;
            $Setting->notify_orders_status = $request->notify_orders_status;
            $Setting->site_url = $request->site_url;
            $Setting->updated_by = Auth::user()->id;
            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('infoTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }
  public function optimizedevel(Request $request)
  {
            Artisan::call('config:clear');
            Artisan::call('cache:clear'); 
            Artisan::call('view:clear');
              if (isset($request->artisan)) {
                   Artisan::call($request->artisan);
              }
              
            Artisan::call('route:clear');

  }
    public function updateSiteStatus(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count((array)$Setting) > 0) {

            $Setting->site_status = $request->site_status;
            $Setting->close_msg = $request->close_msg;

            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('statusTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }

    public function updateSiteStyle(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count((array)$Setting) > 0) {

            

            $Setting->style_logo_en =  Helper::FilterImagePath($request->style_logo_en);
            $Setting->style_logo_ar =  Helper::FilterImagePath($request->style_logo_ar);
            $Setting->style_logo_w_ar =  Helper::FilterImagePath($request->style_logo_w_ar);
            $Setting->style_logo_w_en =  Helper::FilterImagePath($request->style_logo_w_en);
            $Setting->style_fav =  Helper::FilterImagePath($request->style_fav);
            $Setting->style_apple =  Helper::FilterImagePath($request->style_apple);
            $Setting->style_color1 = $request->style_color1;
            $Setting->style_color2 = $request->style_color2;
            $Setting->style_type = $request->style_type;
            $Setting->style_bg_type = $request->style_bg_type;
            $Setting->style_bg_pattern = $request->style_bg_pattern;
            $Setting->style_bg_color = $request->style_bg_color;
         
             $Setting->style_bg_image =  Helper::FilterImagePath($request->style_bg_image);
            $Setting->style_subscribe = $request->style_subscribe;
            $Setting->style_footer = $request->style_footer;
       
             $Setting->style_footer_bg =  Helper::FilterImagePath($request->style_footer_bg);
            $Setting->style_preload = $request->style_preload;
            $Setting->updated_by = Auth::user()->id;
            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('styleTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }

    // update tab of site status

    public function getUploadPath()
    {
        return $this->uploadPath;
    }


    // update tab of Style Settings

    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = Config::get('app.APP_URL') . $uploadPath;
    }

    // update tab of social links

    public function updateSocialLinks(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count((array)$Setting) > 0) {

            $Setting->social_link1 = $request->social_link1;
            $Setting->social_link2 = $request->social_link2;
            $Setting->social_link3 = $request->social_link3;
            $Setting->social_link4 = $request->social_link4;
            $Setting->social_link5 = $request->social_link5;
            $Setting->social_link6 = $request->social_link6;
            $Setting->social_link7 = $request->social_link7;
            $Setting->social_link8 = $request->social_link8;
            $Setting->social_link9 = $request->social_link9;
            $Setting->social_link10 = $request->social_link10;
            $Setting->updated_by = Auth::user()->id;
            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('socialTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }

    // update tab of contacts
    public function updateContacts(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count((array)$Setting) > 0) {

            $Setting->contact_t1_ar = $request->contact_t1_ar;
            $Setting->contact_t1_en = $request->contact_t1_en;
            $Setting->contact_t3 = $request->contact_t3;
            $Setting->contact_t4 = $request->contact_t4;
            $Setting->contact_t5 = $request->contact_t5;
            $Setting->contact_t6 = $request->contact_t6;
            $Setting->contact_t7_ar = $request->contact_t7_ar;
            $Setting->contact_t7_en = $request->contact_t7_en;
            $Setting->updated_by = Auth::user()->id;
            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('contactsTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }
}
