<?php

namespace App\Http\Controllers;

use App\Models\AttachFile;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Map;
use App\Models\Photo;
use App\Models\Program; 
use App\Models\Section;  
use App\Models\ContentSection;  
use App\Models\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class ProgramController extends Controller
{
    private $uploadPath = "uploads/programs/";

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
        

          $programs= Program::orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.programs.index", compact("programs"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
         

            return view("backEnd.programs.create");
       
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
       
          
            
   $row_no = Program::max('row_no')+1;
           
 $audioFileFinalName="";
$videoFileFinalName = "";
          

 
            // create new Program
            $Program = new Program;

            // Save Program details
        
            
            $Program->faculty_id =$request->faculty_id;
            $Program->row_no = $row_no;
            $Program->title_ar = $request->title_ar;
            $Program->title_en = $request->title_en;

            $Program->details_ar = $request->details_ar;
            $Program->details_en = $request->details_en;
            $Program->url_link = $request->url_link;
            $Program->date = $request->date;
            if (@$request->expire_date != "") {
                $Program->expire_date = $request->expire_date;
            }
           
            $Program->photo_file = Helper::FilterImagePath($request->photo_file);
            $Program->attach_file = Helper::FilterImagePath($request->attach_file); 
                $Program->admitionbanner = Helper::FilterImagePath($request->admitionbanner);
                 $Program->banner = Helper::FilterImagePath($request->banner);
            $Program->icon = $request->icon;  
            $Program->webmaster_id =0; 
            $Program->created_by = Auth::user()->id;
            $Program->visits = 0;
            $Program->status = 1;

            // Meta title
            $Program->seo_title_ar = $request->title_ar;
            $Program->seo_title_en = $request->title_en;

            // URL Slugs
            $slugs = Helper::URLSlug($request->title_ar, $request->title_en, "Program", 0);
            $Program->seo_url_slug_ar = $slugs['slug_ar'];
            $Program->seo_url_slug_en = $slugs['slug_en'];

            // Meta Description
            $Program->seo_description_ar = mb_substr(strip_tags(stripslashes($request->details_ar)), 0, 165, 'UTF-8');
            $Program->seo_description_en = mb_substr(strip_tags(stripslashes($request->details_en)), 0, 165, 'UTF-8');


            $Program->save();
  

            return redirect()->action('ProgramController@index',$Program->id)->with('doneMessage',
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
        
          
        $programs = Program::find($id);
            if (count((array)$programs) > 0) {
                //Program programs Details
              
                return view("backEnd.programs.edit",compact("programs"));
            } else {
                return redirect()->action('ProgramController@index');
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
            $Program = Program::find($id);
            if (count((array)$Program) > 0) {


           
          
            
                $Program->title_ar = $request->title_ar;
                $Program->title_en = $request->title_en;
                $Program->details_ar = $request->details_ar;
                $Program->details_en = $request->details_en;
                $Program->date = $request->date;
                if (@$request->expire_date != "" || $Program->date != "") {
                    $Program->expire_date = @$request->expire_date;
                }

                if ($request->photo_delete == 1) {
                    // Delete photo_file
                    if ($Program->photo_file != "") {
                        File::delete($this->getUploadPath() . $Program->photo_file);
                    }

                    $Program->photo_file = "";
                }

           if (isset($request->refrence_id)) {
                $Program->refrence_id = $request->refrence_id;
            }

                $Program->photo_file = Helper::FilterImagePath($request->photo_file);
                $Program->attach_file = Helper::FilterImagePath($request->attach_file); 
                  $Program->admitionbanner = Helper::FilterImagePath($request->admitionbanner);
                 $Program->banner = Helper::FilterImagePath($request->banner);
           
             $Program->faculty_id =$request->faculty_id;
            $Program->icon = $request->icon; 
                $Program->icon = $request->icon;
                 
                $Program->attach_file = $request->attach_file; 
                $Program->status = $request->status;
                $Program->url_link = $request->url_link;
                
                $Program->updated_by = Auth::user()->id;
                $Program->save();

              

                return redirect()->action('ProgramController@index', $id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('ProgramController@index');
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
        $Program = Program::find($id);
            if (count((array)$Program) > 0) {
               
               
                $Program->delete();
                return redirect()->action('ProgramController@index')->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('ProgramController@index');
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
                    $Program = Program::find($rowId);
                    if (count((array)$Program) > 0) {
                        $row_no_val = "row_no_" . $rowId;
                        $Program->row_no = $request->$row_no_val;
                        $Program->save();
                    }
                }

            } elseif ($request->action == "activate") {
                Program::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                Program::wherein('id', $request->ids)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {
                // Check Permissions
                if (!@Auth::user()->permissionsGroup->delete_status) {
                    return Redirect::to(route('NoPermission'))->send();
                }
                // Delete programs photo
                $programs = Program::wherein('id', $request->ids)->get();
                foreach ($programs as $Program) {
                    if ($Program->photo_file != "") {
                        File::delete($this->getUploadPath() . $Program->photo_file);
                    }
                    if ($Program->attach_file != "") {
                        File::delete($this->getUploadPath() . $Program->attach_file);
                    }
                    if ($Program->audio_file != "") {
                        File::delete($this->getUploadPath() . $Program->audio_file);
                    }
                    if ($Program->video_type == 0 && $Program->video_file != "") {
                        File::delete($this->getUploadPath() . $Program->video_file);
                    }
                }

             
  
              

                //Remove programs
                Program::wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('ProgramController@index')->with('doneMessage',
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
            $Program = Program::find($id);
            if (count((array)$Program) > 0) {

                $Program->seo_title_ar = $request->seo_title_ar;
                $Program->seo_title_en = $request->seo_title_en;
                $Program->seo_description_ar = $request->seo_description_ar;
                $Program->seo_description_en = $request->seo_description_en;
                $Program->seo_keywords_ar = $request->seo_keywords_ar;
                $Program->seo_keywords_en = $request->seo_keywords_en;
                $Program->updated_by = Auth::user()->id;

                //URL Slugs
                $slugs = Helper::URLSlug($request->seo_url_slug_ar, $request->seo_url_slug_en, "Program", $id);
                $Program->seo_url_slug_ar = $slugs['slug_ar'];
                $Program->seo_url_slug_en = $slugs['slug_en'];

                $Program->save();
                return redirect()->action('ProgramController@edit',$id)->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('ProgramController@index');
            }
      
    }

    
 
 
 

   /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function indexcontentprogram()
    {
        // Check Permissions
        

          $contentsections= ContentSection::where('key_content','program')->orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.contentprograms.index", compact("contentsections"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function createcontentprogram()
    {
         
         

            return view("backEnd.contentprograms.create");
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function storecontentprogram(Request $request)
    {
       
           
            
   $row_no = ContentSection::where('key_content','program')->max('row_no')+1;
           
 $audioFileFinalName="";
$videoFileFinalName = "";
          

 
            // create new ContentSection
            $ContentSection = new ContentSection;

            // Save ContentSection details
        
            
            $ContentSection->faculty_id =$request->faculty_id;
            $ContentSection->row_no = $row_no; 
            $ContentSection->father_id = $request->father_id;
            $ContentSection->title_ar = $request->title_ar;
            $ContentSection->title_en = $request->title_en;

            $ContentSection->details_ar = $request->details_ar;
            $ContentSection->details_en = $request->details_en;
            $ContentSection->url_link = $request->url_link; 
              $ContentSection->catagoryes = $request->catagoryes;  
             $ContentSection->key_content ='program';  
           
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
  

            return redirect()->action('ProgramController@indexcontentprogram',$ContentSection->id)->with('doneMessage',
                trans('backLang.addDone'));
      
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function editcontentprogram($id)
    {
        
          
        $contentsections = ContentSection::find($id);
            if (count((array)$contentsections) > 0) {
                //ContentSection contentsections Details
              
                return view("backEnd.contentprograms.edit",compact("contentsections"));
            } else {
                return redirect()->action('ProgramController@indexcontentprogram');
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
    public function updatecontentprogram(Request $request,$id)
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
             $ContentSection->father_id =$request->father_id;
              $ContentSection->icon = $request->icon;  
              $ContentSection->catagoryes = $request->catagoryes;  
              $ContentSection->key_content ='program';  
                 
                $ContentSection->attach_file = $request->attach_file; 
                $ContentSection->status = $request->status;
                $ContentSection->url_link = $request->url_link;
                
                $ContentSection->updated_by = Auth::user()->id;
                $ContentSection->save();

              

                return redirect()->action('ProgramController@indexcontentprogram', $id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('ProgramController@indexcontentprogram');
            }
       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function destroycontentprogram($id)
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
               
               
            
               
                $ContentSection->delete();
                return redirect()->action('ProgramController@indexcontentprogram')->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('ProgramController@indexcontentprogram');
            }
      
    }


    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[],$webmasterId
     * @return \Illuminate\Http\Response
     */
    public function updateAllcontentprogram(Request $request)
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
                ContentSection::where('key_content','program')->wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('ProgramController@indexcontentprogram')->with('doneMessage',
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
    function seocontentprogram(Request $request, $id)
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
                return redirect()->action('ProgramController@editcontentprogram',$id)->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('ProgramController@indexcontentprogram');
            }
      
    }


  
}



             
 