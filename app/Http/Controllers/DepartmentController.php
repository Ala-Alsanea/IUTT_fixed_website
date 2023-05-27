<?php

namespace App\Http\Controllers;

use App\Models\AttachFile;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Map;
use App\Models\Photo;
use App\Models\Department; 
use App\Models\ContentSection; 
use App\Models\Section;  
use App\Models\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class DepartmentController extends Controller
{
    private $uploadPath = "uploads/Departments/";

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
        

          $Departments= Department::orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.departments.index", compact("Departments"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
         

            return view("backEnd.departments.create");
       
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
       
          
            
   $row_no = Department::max('row_no')+1;
           
 $audioFileFinalName="";
$videoFileFinalName = "";
          


          
            // create new Department
            $Department = new Department;

            // Save Department details
        
            
            $Department->faculty_id =$request->faculty_id;
            $Department->row_no = $row_no;
            $Department->title_ar = $request->title_ar;
            $Department->title_en = $request->title_en;

            $Department->details_ar = $request->details_ar;
            $Department->details_en = $request->details_en;
            $Department->url_link = $request->url_link;
            $Department->date = $request->date;
            if (@$request->expire_date != "") {
                $Department->expire_date = $request->expire_date;
            }
            
         
 

            $Department->photo_file = Helper::FilterImagePath($request->photo_file);
            $Department->attach_file = Helper::FilterImagePath($request->attach_file);
            $Department->audio_file = Helper::FilterImagePath($request->audio_file);
            $Department->banner = Helper::FilterImagePath($request->banner);
            $Department->admitionbanner = Helper::FilterImagePath($request->admitionbanner); 
            $Department->icon = $request->icon;
           
            $Department->webmaster_id = 0; 
            $Department->created_by = Auth::user()->id;
            $Department->visits = 0;
            $Department->status = 1;

            // Meta title
            $Department->seo_title_ar = $request->title_ar;
            $Department->seo_title_en = $request->title_en;

            // URL Slugs
            $slugs = Helper::URLSlug($request->title_ar, $request->title_en, "Department", 0);
            $Department->seo_url_slug_ar = $slugs['slug_ar'];
            $Department->seo_url_slug_en = $slugs['slug_en'];

            // Meta Description
            $Department->seo_description_ar = mb_substr(strip_tags(stripslashes($request->details_ar)), 0, 165, 'UTF-8');
            $Department->seo_description_en = mb_substr(strip_tags(stripslashes($request->details_en)), 0, 165, 'UTF-8');


            $Department->save();
  

            return redirect()->action('DepartmentController@index',$Department->id)->with('doneMessage',
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
        
          
        $Departments = Department::find($id);
            if (count((array)$Departments) > 0) {
                //Department Departments Details
              
                return view("backEnd.departments.edit",compact("Departments"));
            } else {
                return redirect()->action('DepartmentController@index');
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
            $Department = Department::find($id);
            if (count((array)$Department) > 0) {

   

          
            
                $Department->title_ar = $request->title_ar;
                $Department->title_en = $request->title_en;
                $Department->details_ar = $request->details_ar;
                $Department->details_en = $request->details_en;
                $Department->date = $request->date;
                if (@$request->expire_date != "" || $Department->date != "") {
                    $Department->expire_date = @$request->expire_date;
                }

                if ($request->photo_delete == 1) {
                    // Delete photo_file
                    if ($Department->photo_file != "") {
                        File::delete($this->getUploadPath() . $Department->photo_file);
                    }

                    $Department->photo_file = "";
                }

           if (isset($request->refrence_id)) {
                $Department->refrence_id = $request->refrence_id;
            }

                $Department->photo_file = Helper::FilterImagePath($request->photo_file);
                $Department->attach_file = Helper::FilterImagePath($request->attach_file);
                 $Department->admitionbanner = Helper::FilterImagePath($request->admitionbanner);
                 $Department->banner = Helper::FilterImagePath($request->banner);
          
             $Department->faculty_id =$request->faculty_id;
            $Department->icon = $request->icon; 
            
                $Department->icon = $request->icon; 
                $Department->attach_file = $request->attach_file;
            
                $Department->status = $request->status;
                $Department->url_link = $request->url_link;
                
                $Department->updated_by = Auth::user()->id;
                $Department->save();

              

                return redirect()->action('DepartmentController@index', $id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('DepartmentController@index');
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
        $Department = Department::find($id);
            if (count((array)$Department) > 0) { 
               
                $Department->delete();
                return redirect()->action('DepartmentController@index')->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('DepartmentController@index');
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
                    $Department = Department::find($rowId);
                    if (count((array)$Department) > 0) {
                        $row_no_val = "row_no_" . $rowId;
                        $Department->row_no = $request->$row_no_val;
                        $Department->save();
                    }
                }

            } elseif ($request->action == "activate") {
                Department::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                Department::wherein('id', $request->ids)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {
                // Check Permissions
                if (!@Auth::user()->permissionsGroup->delete_status) {
                    return Redirect::to(route('NoPermission'))->send();
                }
                // Delete Departments photo
                $Departments = Department::wherein('id', $request->ids)->get();
                foreach ($Departments as $Department) {
                    if ($Department->photo_file != "") {
                        File::delete($this->getUploadPath() . $Department->photo_file);
                    }
                    if ($Department->attach_file != "") {
                        File::delete($this->getUploadPath() . $Department->attach_file);
                    }
                    if ($Department->audio_file != "") {
                        File::delete($this->getUploadPath() . $Department->audio_file);
                    }
                    if ($Department->video_type == 0 && $Department->video_file != "") {
                        File::delete($this->getUploadPath() . $Department->video_file);
                    }
                }

             
  
              

                //Remove Departments
                Department::wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('DepartmentController@index')->with('doneMessage',
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
            $Department = Department::find($id);
            if (count((array)$Department) > 0) {

                $Department->seo_title_ar = $request->seo_title_ar;
                $Department->seo_title_en = $request->seo_title_en;
                $Department->seo_description_ar = $request->seo_description_ar;
                $Department->seo_description_en = $request->seo_description_en;
                $Department->seo_keywords_ar = $request->seo_keywords_ar;
                $Department->seo_keywords_en = $request->seo_keywords_en;
                $Department->updated_by = Auth::user()->id;

                //URL Slugs
                $slugs = Helper::URLSlug($request->seo_url_slug_ar, $request->seo_url_slug_en, "Department", $id);
                $Department->seo_url_slug_ar = $slugs['slug_ar'];
                $Department->seo_url_slug_en = $slugs['slug_en'];

                $Department->save();
                return redirect()->action('DepartmentController@edit',$id)->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('DepartmentController@index');
            }
      
    }

    
 

// Maps Functions

    /**
     * Show all Maps.
     *
     * @param  int $webmasterId
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function DepartmentsMaps($id)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $webmasterId
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function mapsCreate($webmasterId, $id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count((array)$WebmasterSection) > 0) {
            // Check Permissions
            if (!@Auth::user()->permissionsGroup->add_status) {
                return Redirect::to(route('NoPermission'))->send();
            }
            return redirect()->action('DepartmentController@edit', [$webmasterId, $id])->with('activeTab',
                'maps')->with('mapST', 'create');
        } else {
            return redirect()->route('NotFound');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public
    function mapsStore(Request $request, $webmasterId, $id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count((array)$WebmasterSection) > 0) {
            //
            $this->validate($request, [
                'longitude' => 'required',
                'longitude' => 'required'
            ]);


            $next_nor_no = Map::where('Department_id', '=', $id)->max('row_no');
            if ($next_nor_no < 1) {
                $next_nor_no = 1;
            } else {
                $next_nor_no++;
            }

            $Map = new Map;
            $Map->row_no = $next_nor_no;
            $Map->longitude = $request->longitude;
            $Map->latitude = $request->latitude;
            $Map->title_ar = $request->title_ar;
            $Map->title_en = $request->title_en;
            $Map->details_ar = $request->details_ar;
            $Map->details_en = $request->details_en;
            $Map->icon = $request->icon;
            $Map->Department_id = $id;
            $Map->status = 1;
            $Map->created_by = Auth::user()->id;
            $Map->save();

            return redirect()->action('DepartmentController@edit', [$webmasterId, $id])->with('doneMessage',
                trans('backLang.saveDone'))->with('activeTab', 'maps');
        } else {
            return redirect()->route('NotFound');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @param  int $map_id
     * @return \Illuminate\Http\Response
     */
    public
    function mapsEdit($webmasterId, $id, $map_id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count((array)$WebmasterSection) > 0) {
            // Check Permissions
            if (!@Auth::user()->permissionsGroup->edit_status) {
                return Redirect::to(route('NoPermission'))->send();
            }

            $Map = Map::find($map_id);
            if (count((array)$Map) > 0) {
                return redirect()->action('DepartmentController@edit', [$webmasterId, $id])->with('activeTab',
                    'maps')->with('mapST', 'edit')->with('Map', $Map);
            } else {
                return redirect()->action('DepartmentController@edit', [$webmasterId, $id])->with('activeTab', 'maps');
            }
        } else {
            return redirect()->route('NotFound');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $webmasterId
     * @param  int $map_id
     * @return \Illuminate\Http\Response
     */
    public
    function mapsUpdate(Request $request, $webmasterId, $id, $map_id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count((array)$WebmasterSection) > 0) {
            //
            $Map = Map::find($map_id);
            if (count((array)$Map) > 0) {


                $this->validate($request, [
                    'longitude' => 'required',
                    'longitude' => 'required'
                ]);
                $Map->longitude = $request->longitude;
                $Map->latitude = $request->latitude;
                $Map->title_ar = $request->title_ar;
                $Map->title_en = $request->title_en;
                $Map->details_ar = $request->details_ar;
                $Map->details_en = $request->details_en;
                $Map->icon = $request->icon;
                $Map->status = $request->status;
                $Map->updated_by = Auth::user()->id;
                $Map->save();
                return redirect()->action('DepartmentController@edit', [$webmasterId, $id])->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'maps');
            } else {
                return redirect()->action('DepartmentController@edit', [$webmasterId, $id])->with('activeTab', 'maps');
            }
        } else {
            return redirect()->route('NotFound');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @param  int $map_id
     * @return \Illuminate\Http\Response
     */
    public
    function mapsDestroy($webmasterId, $id, $map_id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count((array)$WebmasterSection) > 0) {
            // Check Permissions
            if (!@Auth::user()->permissionsGroup->delete_status) {
                return Redirect::to(route('NoPermission'))->send();
            }
            //
            $Map = Map::find($map_id);
            if (count((array)$Map) > 0) {
                $Map->delete();
                return redirect()->action('DepartmentController@edit', [$webmasterId, $id])->with('doneMessage',
                    trans('backLang.deleteDone'))->with('activeTab', 'maps');
            } else {
                return redirect()->action('DepartmentController@edit', [$webmasterId, $id])->with('activeTab', 'maps');
            }
        } else {
            return redirect()->route('NotFound');
        }
    }


    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[],$webmasterId
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function mapsUpdateAll(Request $request, $webmasterId, $id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count((array)$WebmasterSection) > 0) {
            //
            if ($request->action == "order") {
                foreach ($request->row_ids as $rowId) {
                    $Map = Map::find($rowId);
                    if (count((array)$Map) > 0) {
                        $row_no_val = "row_no_" . $rowId;
                        $Map->row_no = $request->$row_no_val;
                        $Map->save();
                    }
                }
            } elseif ($request->action == "activate") {
                Map::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                Map::wherein('id', $request->ids)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {

                // Check Permissions
                if (!@Auth::user()->permissionsGroup->delete_status) {
                    return Redirect::to(route('NoPermission'))->send();
                }

                Map::wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('DepartmentController@edit', [$webmasterId, $id])->with('doneMessage',
                trans('backLang.saveDone'))->with('activeTab', 'maps');
        } else {
            return redirect()->route('NotFound');
        }
    }
 


   /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function indexcontentdepartment()
    {
        // Check Permissions
        

          $contentsections= ContentSection::where('key_content','department')->orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.contentdepartments.index", compact("contentsections"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function createcontentdepartment()
    {
         
         

            return view("backEnd.contentdepartments.create");
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function storecontentdepartment(Request $request)
    {
       
           
            
   $row_no = ContentSection::where('key_content','department')->max('row_no')+1;
           
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
             $ContentSection->key_content ='department';  
           
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
  

            return redirect()->action('DepartmentController@indexcontentdepartment',$ContentSection->id)->with('doneMessage',
                trans('backLang.addDone'));
      
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function editcontentdepartment($id)
    {
        
          
        $contentsections = ContentSection::find($id);
            if (count((array)$contentsections) > 0) {
                //ContentSection contentsections Details
              
                return view("backEnd.contentdepartments.edit",compact("contentsections"));
            } else {
                return redirect()->action('DepartmentController@indexcontentdepartment');
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
    public function updatecontentdepartment(Request $request,$id)
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
              $ContentSection->key_content ='department';  
                 
                $ContentSection->attach_file = $request->attach_file; 
                $ContentSection->status = $request->status;
                $ContentSection->url_link = $request->url_link;
                
                $ContentSection->updated_by = Auth::user()->id;
                $ContentSection->save();

              

                return redirect()->action('DepartmentController@indexcontentdepartment', $id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('DepartmentController@indexcontentdepartment');
            }
       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function destroycontentdepartment($id)
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
                return redirect()->action('DepartmentController@indexcontentdepartment')->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('DepartmentController@indexcontentdepartment');
            }
      
    }


    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[],$webmasterId
     * @return \Illuminate\Http\Response
     */
    public function updateAllcontentdepartment(Request $request)
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
                ContentSection::where('key_content','department')->wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('DepartmentController@indexcontentdepartment')->with('doneMessage',
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
    function seocontentdepartment(Request $request, $id)
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
                return redirect()->action('DepartmentController@editcontentdepartment',$id)->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('DepartmentController@indexcontentdepartment');
            }
      
    }

    
 


  
}



             
 