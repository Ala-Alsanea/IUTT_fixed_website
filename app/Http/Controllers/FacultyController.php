<?php

namespace App\Http\Controllers;

use App\Models\AttachFile;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Map;
use App\Models\Photo;
use App\Models\Faculty; 
use App\Models\Section;  
use App\Models\ContentSection;  
use App\Models\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class FacultyController extends Controller
{
    private $uploadPath = "uploads/Facultys/";

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
        

          $Faculties= Faculty::orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.faculties.index", compact("Faculties"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
         

            return view("backEnd.faculties.create");
       
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
       
          
            
   $row_no = Faculty::max('row_no')+1;
           
 $audioFileFinalName="";
$videoFileFinalName = "";
          


          

            // create new Faculty
            $Faculty = new Faculty;

            // Save Faculty details
        
            
            $Faculty->row_no = $row_no;
            $Faculty->title_ar = $request->title_ar;
            $Faculty->title_en = $request->title_en;

            $Faculty->details_ar = $request->details_ar;
            $Faculty->details_en = $request->details_en;
            $Faculty->url_link = $request->url_link;
            $Faculty->date = $request->date;
            if (@$request->expire_date != "") {
                $Faculty->expire_date = $request->expire_date;
            }
          

            $Faculty->photo_file = Helper::FilterImagePath($request->photo_file);
            $Faculty->attach_file = Helper::FilterImagePath($request->attach_file); 
            $Faculty->logo = Helper::FilterImagePath($request->logo);
            $Faculty->logo2 = Helper::FilterImagePath($request->logo2);
            $Faculty->banner = Helper::FilterImagePath($request->banner);
            $Faculty->banner1 = Helper::FilterImagePath($request->banner1);
            $Faculty->banner2 = Helper::FilterImagePath($request->banner2);
            $Faculty->banner3 = Helper::FilterImagePath($request->banner3);
            $Faculty->icon = $request->icon;
            $Faculty->addres_ar = $request->addres_ar;
            $Faculty->addres_en = $request->addres_en;
            $Faculty->phone = $request->phone;
            $Faculty->fax = $request->fax;
            $Faculty->email = $request->email; 
    
            $Faculty->webmaster_id =0; 
            $Faculty->created_by = Auth::user()->id;
            $Faculty->visits = 0;
            $Faculty->status = 1;

            // Meta title
            $Faculty->seo_title_ar = $request->title_ar;
            $Faculty->seo_title_en = $request->title_en;

            // URL Slugs
            $slugs = Helper::URLSlug($request->title_ar, $request->title_en, "Faculty", 0);
            $Faculty->seo_url_slug_ar = $slugs['slug_ar'];
            $Faculty->seo_url_slug_en = $slugs['slug_en'];

            // Meta Description
            $Faculty->seo_description_ar = mb_substr(strip_tags(stripslashes($request->details_ar)), 0, 165, 'UTF-8');
            $Faculty->seo_description_en = mb_substr(strip_tags(stripslashes($request->details_en)), 0, 165, 'UTF-8');


            $Faculty->save();
  

            return redirect()->action('FacultyController@index',$Faculty->id)->with('doneMessage',
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
        
          
        $Facultys = Faculty::find($id);
            if (count((array)$Facultys) > 0) {
                //Faculty Facultys Details
              
                return view("backEnd.faculties.edit",compact("Facultys"));
            } else {
                return redirect()->action('FacultyController@index');
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
            $Faculty = Faculty::find($id);
            if (count((array)$Faculty) > 0) {


            


                // Start of Upload Files
                $formFileName = "photo_file";
                 $fileFinalName = "";
             
              
                // End of Upload Files
            

          
            
                $Faculty->title_ar = $request->title_ar;
                $Faculty->title_en = $request->title_en;
                $Faculty->details_ar = $request->details_ar;
                $Faculty->details_en = $request->details_en;
                $Faculty->date = $request->date;
                if (@$request->expire_date != "" || $Faculty->date != "") {
                    $Faculty->expire_date = @$request->expire_date;
                }

                if ($request->photo_delete == 1) {
                    // Delete photo_file
                    if ($Faculty->photo_file != "") {
                        File::delete($this->getUploadPath() . $Faculty->photo_file);
                    }

                    $Faculty->photo_file = "";
                }
 

                $Faculty->photo_file = Helper::FilterImagePath($request->photo_file);
                $Faculty->attach_file = Helper::FilterImagePath($request->attach_file);
                  $Faculty->logo = Helper::FilterImagePath($request->logo);
            $Faculty->logo2 = Helper::FilterImagePath($request->logo2);
               $Faculty->banner = Helper::FilterImagePath($request->banner);
                $Faculty->banner1 = Helper::FilterImagePath($request->banner1);
            $Faculty->banner2 = Helper::FilterImagePath($request->banner2);
            $Faculty->banner3 = Helper::FilterImagePath($request->banner3);
            $Faculty->icon = $request->icon;
            $Faculty->addres_ar = $request->addres_ar;
            $Faculty->addres_en = $request->addres_en;
            $Faculty->phone = $request->phone;
            $Faculty->fax = $request->fax;
            $Faculty->email = $request->email; 
                $Faculty->icon = $request->icon;
               
                $Faculty->attach_file = $request->attach_file;
     
                $Faculty->status = $request->status;
                $Faculty->url_link = $request->url_link;
                
                $Faculty->updated_by = Auth::user()->id;
                $Faculty->save();

              

                return redirect()->action('FacultyController@index', $id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('FacultyController@index');
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
        $Faculty = Faculty::find($id);
            if (count((array)$Faculty) > 0) {
                // Delete a Faculty photo
                if ($Faculty->photo_file != "") {
                    File::delete($this->getUploadPath() . $Faculty->photo_file);
                }
                if ($Faculty->attach_file != "") {
                    File::delete($this->getUploadPath() . $Faculty->attach_file);
                }
                if ($Faculty->audio_file != "") {
                    File::delete($this->getUploadPath() . $Faculty->audio_file);
                }
                if ($Faculty->video_type == 0 && $Faculty->video_file != "") {
                    File::delete($this->getUploadPath() . $Faculty->video_file);
                }
               
               // Map::where('Faculty_id', $Faculty->id)->delete();
               
                $Faculty->delete();
                return redirect()->action('FacultyController@index')->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('FacultyController@index');
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
                    $Faculty = Faculty::find($rowId);
                    if (count((array)$Faculty) > 0) {
                        $row_no_val = "row_no_" . $rowId;
                        $Faculty->row_no = $request->$row_no_val;
                        $Faculty->save();
                    }
                }

            } elseif ($request->action == "activate") {
                Faculty::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                Faculty::wherein('id', $request->ids)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {
                // Check Permissions
                if (!@Auth::user()->permissionsGroup->delete_status) {
                    return Redirect::to(route('NoPermission'))->send();
                }
                // Delete Facultys photo
                $Facultys = Faculty::wherein('id', $request->ids)->get();
                foreach ($Facultys as $Faculty) {
                    if ($Faculty->photo_file != "") {
                        File::delete($this->getUploadPath() . $Faculty->photo_file);
                    }
                    if ($Faculty->attach_file != "") {
                        File::delete($this->getUploadPath() . $Faculty->attach_file);
                    }
                    if ($Faculty->audio_file != "") {
                        File::delete($this->getUploadPath() . $Faculty->audio_file);
                    }
                    if ($Faculty->video_type == 0 && $Faculty->video_file != "") {
                        File::delete($this->getUploadPath() . $Faculty->video_file);
                    }
                }

             
 
 
                Map::wherein('Faculty_id', $request->ids)
                    ->delete();
              

                //Remove Facultys
                Faculty::wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('FacultyController@index')->with('doneMessage',
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
            $Faculty = Faculty::find($id);
            if (count((array)$Faculty) > 0) {

                $Faculty->seo_title_ar = $request->seo_title_ar;
                $Faculty->seo_title_en = $request->seo_title_en;
                $Faculty->seo_description_ar = $request->seo_description_ar;
                $Faculty->seo_description_en = $request->seo_description_en;
                $Faculty->seo_keywords_ar = $request->seo_keywords_ar;
                $Faculty->seo_keywords_en = $request->seo_keywords_en;
                $Faculty->updated_by = Auth::user()->id;

                //URL Slugs
                $slugs = Helper::URLSlug($request->seo_url_slug_ar, $request->seo_url_slug_en, "Faculty", $id);
                $Faculty->seo_url_slug_ar = $slugs['slug_ar'];
                $Faculty->seo_url_slug_en = $slugs['slug_en'];

                $Faculty->save();
                return redirect()->action('FacultyController@edit',$id)->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('FacultyController@index');
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
    function FacultysMaps($webmasterId, $id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count((array)$WebmasterSection) > 0) {
            return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('activeTab', 'maps');
        } else {
            return redirect()->route('NotFound');
        }
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
            return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('activeTab',
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


            $next_nor_no = Map::where('Faculty_id', '=', $id)->max('row_no');
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
            $Map->Faculty_id = $id;
            $Map->status = 1;
            $Map->created_by = Auth::user()->id;
            $Map->save();

            return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('doneMessage',
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
                return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('activeTab',
                    'maps')->with('mapST', 'edit')->with('Map', $Map);
            } else {
                return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('activeTab', 'maps');
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
                return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'maps');
            } else {
                return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('activeTab', 'maps');
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
                return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('doneMessage',
                    trans('backLang.deleteDone'))->with('activeTab', 'maps');
            } else {
                return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('activeTab', 'maps');
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
            return redirect()->action('FacultyController@edit', [$webmasterId, $id])->with('doneMessage',
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
    public function indexcontentfaculties()
    {
        // Check Permissions
        

          $contentsections= ContentSection::where('key_content','faculty')->orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.contentfaculties.index", compact("contentsections"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function createcontentfaculties()
    {
         
         

            return view("backEnd.contentfaculties.create");
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function storecontentfaculties(Request $request)
    {
       
           
            
   $row_no = ContentSection::where('key_content','faculty')->max('row_no')+1;
           
 $audioFileFinalName="";
$videoFileFinalName = "";
          

 
            // create new ContentSection
            $ContentSection = new ContentSection;

            // Save ContentSection details
        
            
            $ContentSection->faculty_id =$request->faculty_id;
            $ContentSection->row_no = $row_no; 
            $ContentSection->father_id =0;
            $ContentSection->title_ar = $request->title_ar;
            $ContentSection->title_en = $request->title_en;

            $ContentSection->details_ar = $request->details_ar;
            $ContentSection->details_en = $request->details_en;
            $ContentSection->url_link = $request->url_link; 
              $ContentSection->catagoryes = $request->catagoryes;  
             $ContentSection->key_content ='faculty';  
           
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
  

            return redirect()->action('FacultyController@indexcontentfaculties',$ContentSection->id)->with('doneMessage',
                trans('backLang.addDone'));
      
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function editcontentfaculties($id)
    {
        
          
        $contentsections = ContentSection::find($id);
            if (count((array)$contentsections) > 0) {
                //ContentSection contentsections Details
              
                return view("backEnd.contentfaculties.edit",compact("contentsections"));
            } else {
                return redirect()->action('FacultyController@indexcontentfaculties');
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
    public function updatecontentfaculties(Request $request,$id)
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
             $ContentSection->father_id =0;
              $ContentSection->icon = $request->icon;  
              $ContentSection->catagoryes = $request->catagoryes;  
              $ContentSection->key_content ='faculty';  
                 
                $ContentSection->attach_file = $request->attach_file; 
                $ContentSection->status = $request->status;
                $ContentSection->url_link = $request->url_link;
                
                $ContentSection->updated_by = Auth::user()->id;
                $ContentSection->save();

              

                return redirect()->action('FacultyController@indexcontentfaculties', $id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('FacultyController@indexcontentfaculties');
            }
       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function destroycontentfaculties($id)
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
                return redirect()->action('FacultyController@indexcontentfaculties')->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('FacultyController@indexcontentfaculties');
            }
      
    }


    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[],$webmasterId
     * @return \Illuminate\Http\Response
     */
    public function updateAllcontentfaculties(Request $request)
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
                ContentSection::where('key_content','faculty')->wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('FacultyController@indexcontentfaculties')->with('doneMessage',
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
    function seocontentfaculties(Request $request, $id)
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
                return redirect()->action('FacultyController@editcontentfaculties',$id)->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('FacultyController@indexcontentfaculties');
            }
      
    }

    
 

}



             
 