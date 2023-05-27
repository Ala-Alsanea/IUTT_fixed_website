<?php

namespace App\Http\Controllers;

use App\Models\AttachFile;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Map;
use App\Models\Photo;
use App\Models\ContentSection; 
use App\Models\Section;  
use App\Models\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class ContentSectionController extends Controller
{
    private $uploadPath = "uploads/contentsections/";

    // Define Default Variables

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check Permissions
        

          $contentsections= ContentSection::orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.contentsections.index", compact("contentsections"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
         

            return view("backEnd.contentsections.create");
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
          
            
   $row_no = ContentSection::max('row_no')+1;
           
 $audioFileFinalName="";
$videoFileFinalName = "";
          

 
            // create new ContentSection
            $ContentSection = new ContentSection;

            // Save ContentSection details
        
            
            $ContentSection->faculty_id =$request->faculty_id;
            $ContentSection->row_no = $row_no;
            $ContentSection->title_ar = $request->title_ar;
            $ContentSection->title_en = $request->title_en;

            $ContentSection->details_ar = $request->details_ar;
            $ContentSection->details_en = $request->details_en;
            $ContentSection->url_link = $request->url_link; 
            
           
            $ContentSection->photo_file = Helper::FilterImagePath($request->photo_file);
            $ContentSection->attach_file = Helper::FilterImagePath($request->attach_file); 
              
             $ContentSection->banner = Helper::FilterImagePath($request->banner);
            $ContentSection->icon = $request->icon;  
            $ContentSection->webmaster_id =0; 
            $ContentSection->created_by = Auth::user()->id;
            $ContentSection->visits = 0;
            $ContentSection->status = 1;

            // Meta title
            $ContentSection->seo_title_ar = $request->title_ar;
            $ContentSection->seo_title_en = $request->title_en;

            // URL Slugs
            $slugs = Helper::URLSlug($request->title_ar, $request->title_en, "ContentSection", 0);
            $ContentSection->seo_url_slug_ar = $slugs['slug_ar'];
            $ContentSection->seo_url_slug_en = $slugs['slug_en'];

            // Meta Description
            $ContentSection->seo_description_ar = mb_substr(strip_tags(stripslashes($request->details_ar)), 0, 165, 'UTF-8');
            $ContentSection->seo_description_en = mb_substr(strip_tags(stripslashes($request->details_en)), 0, 165, 'UTF-8');


            $ContentSection->save();
  

            return redirect()->action('ContentSectionController@index', [$webmasterId, $ContentSection->id])->with('doneMessage',
                trans('backLang.addDone'));
      
    }

    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = Config::get('app.APP_URL') . $uploadPath;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
          
        $contentsections = ContentSection::find($id);
            if (count((array)$contentsections) > 0) {
                //ContentSection contentsections Details
              
                return view("backEnd.contentsections.edit",compact("contentsections"));
            } else {
                return redirect()->action('ContentSectionController@index');
            }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       
            //
            $ContentSection = ContentSection::find($id);
            if (count((array)$ContentSection) > 0) {


           
          
            
                $ContentSection->title_ar = $request->title_ar;
                $ContentSection->title_en = $request->title_en;
                $ContentSection->details_ar = $request->details_ar;
                $ContentSection->details_en = $request->details_en;
                
               

                $ContentSection->photo_file = Helper::FilterImagePath($request->photo_file);
                $ContentSection->attach_file = Helper::FilterImagePath($request->attach_file); 
                  
                 $ContentSection->banner = Helper::FilterImagePath($request->banner);
           
             $ContentSection->faculty_id =$request->faculty_id;
            $ContentSection->icon = $request->icon;  
                 
                $ContentSection->attach_file = $request->attach_file; 
                $ContentSection->status = $request->status;
                $ContentSection->url_link = $request->url_link;
                
                $ContentSection->updated_by = Auth::user()->id;
                $ContentSection->save();

              

                return redirect()->action('ContentSectionController@index', $id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('ContentSectionController@index');
            }
       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ContentSection = ContentSection::find($id);
            if (count((array)$ContentSection) > 0) {
                // Delete a ContentSection photo
                if ($ContentSection->photo_file != "") {
                    File::delete($this->getUploadPath() . $ContentSection->photo_file);
                }
                if ($ContentSection->attach_file != "") {
                    File::delete($this->getUploadPath() . $ContentSection->attach_file);
                }
                if ($ContentSection->audio_file != "") {
                    File::delete($this->getUploadPath() . $ContentSection->audio_file);
                }
                if ($ContentSection->video_type == 0 && $ContentSection->video_file != "") {
                    File::delete($this->getUploadPath() . $ContentSection->video_file);
                }
               
                Map::where('ContentSection_id', $ContentSection->id)->delete();
               
                $ContentSection->delete();
                return redirect()->action('ContentSectionController@index')->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('ContentSectionController@index');
            }
      
    }


    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[],$webmasterId
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
        
            //
            if ($request->action == "order") {
                foreach ($request->row_ids as $rowId) {
                    $ContentSection = ContentSection::find($rowId);
                    if (count((array)$ContentSection) > 0) {
                        $row_no_val = "row_no_" . $rowId;
                        $ContentSection->row_no = $request->$row_no_val;
                        $ContentSection->save();
                    }
                }

            } elseif ($request->action == "activate") {
                ContentSection::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                ContentSection::wherein('id', $request->ids)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {
                // Check Permissions
                if (!@Auth::user()->permissionsGroup->delete_status) {
                    return Redirect::to(route('NoPermission'))->send();
                }
                // Delete contentsections photo
               

             
  
              

                //Remove contentsections
                ContentSection::wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('ContentSectionController@index')->with('doneMessage',
                trans('backLang.saveDone'));
       
    }


    /**
     * Update SEO tab
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */

    public
    function seo(Request $request, $id)
    {
      
            //
            $ContentSection = ContentSection::find($id);
            if (count((array)$ContentSection) > 0) {

                $ContentSection->seo_title_ar = $request->seo_title_ar;
                $ContentSection->seo_title_en = $request->seo_title_en;
                $ContentSection->seo_description_ar = $request->seo_description_ar;
                $ContentSection->seo_description_en = $request->seo_description_en;
                $ContentSection->seo_keywords_ar = $request->seo_keywords_ar;
                $ContentSection->seo_keywords_en = $request->seo_keywords_en;
                $ContentSection->updated_by = Auth::user()->id;

                //URL Slugs
                $slugs = Helper::URLSlug($request->seo_url_slug_ar, $request->seo_url_slug_en, "ContentSection", $id);
                $ContentSection->seo_url_slug_ar = $slugs['slug_ar'];
                $ContentSection->seo_url_slug_en = $slugs['slug_en'];

                $ContentSection->save();
                return redirect()->action('ContentSectionController@edit',$id)->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('ContentSectionController@index');
            }
      
    }

    
 
 
 
  
}



             
 