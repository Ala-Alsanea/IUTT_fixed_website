<?php

namespace App\Http\Controllers;

use App\Models\AttachFile;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Map;
use App\Models\Photo;
use App\Models\SliderFaculty; 
use App\Models\Section;  
use App\Models\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class SliderFacultyController extends Controller
{
    private $uploadPath = "uploads/sliderfaculties/";

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
        

          $sliderfaculties= SliderFaculty::orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.sliderfaculties.index", compact("sliderfaculties"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
         

            return view("backEnd.sliderfaculties.create");
       
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
       
          
            
   $row_no = SliderFaculty::max('row_no')+1;
           
 $audioFileFinalName="";
$videoFileFinalName = "";
          

 
            // create new SliderFaculty
            $SliderFaculty = new SliderFaculty;

            // Save SliderFaculty details
        
            
            $SliderFaculty->faculty_id =$request->faculty_id;
            $SliderFaculty->row_no = $row_no;
            $SliderFaculty->title_ar = $request->title_ar;
            $SliderFaculty->title_en = $request->title_en; 
            $SliderFaculty->details_en = $request->details_en;
            $SliderFaculty->details_ar = $request->details_ar; 
            $SliderFaculty->photo_file = Helper::FilterImagePath($request->photo_file); 
            $SliderFaculty->created_by = Auth::user()->id;
            $SliderFaculty->visits = 0;
            $SliderFaculty->status = 1;  

            $SliderFaculty->save();
  

            return redirect()->action('SliderFacultyController@index', $SliderFaculty->id)->with('doneMessage',
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
        
          
        $sliderfaculties = SliderFaculty::find($id);
            if (count((array)$sliderfaculties) > 0) {
                //SliderFaculty sliderfaculties Details
              
                return view("backEnd.sliderfaculties.edit",compact("sliderfaculties"));
            } else {
                return redirect()->action('SliderFacultyController@index');
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
            $SliderFaculty = SliderFaculty::find($id);
            if (count((array)$SliderFaculty) > 0) {


           
          
            
                $SliderFaculty->title_ar = $request->title_ar;
                $SliderFaculty->title_en = $request->title_en;
                
              
                 $SliderFaculty->details_en = $request->details_en;
            $SliderFaculty->details_ar = $request->details_ar; 

                $SliderFaculty->photo_file = Helper::FilterImagePath($request->photo_file);
              
             $SliderFaculty->faculty_id =$request->faculty_id; 
                $SliderFaculty->url_link = $request->url_link;
                $SliderFaculty->status = $request->status;
             
                
                $SliderFaculty->updated_by = Auth::user()->id;
                $SliderFaculty->save();

              

                return redirect()->action('SliderFacultyController@index', $id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('SliderFacultyController@index');
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
        $SliderFaculty = SliderFaculty::find($id);
            if (count((array)$SliderFaculty) > 0) {
               
               
                $SliderFaculty->delete();
                return redirect()->action('SliderFacultyController@index')->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('SliderFacultyController@index');
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
                    $SliderFaculty = SliderFaculty::find($rowId);
                    if (count((array)$SliderFaculty) > 0) {
                        $row_no_val = "row_no_" . $rowId;
                        $SliderFaculty->row_no = $request->$row_no_val;
                        $SliderFaculty->save();
                    }
                }

            } elseif ($request->action == "activate") {
                SliderFaculty::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                SliderFaculty::wherein('id', $request->ids)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {
              

             
  
              

                //Remove sliderfaculties
                SliderFaculty::wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('SliderFacultyController@index')->with('doneMessage',
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
            $SliderFaculty = SliderFaculty::find($id);
            if (count((array)$SliderFaculty) > 0) {

                $SliderFaculty->seo_title_ar = $request->seo_title_ar;
                $SliderFaculty->seo_title_en = $request->seo_title_en;
                $SliderFaculty->seo_description_ar = $request->seo_description_ar;
                $SliderFaculty->seo_description_en = $request->seo_description_en;
                $SliderFaculty->seo_keywords_ar = $request->seo_keywords_ar;
                $SliderFaculty->seo_keywords_en = $request->seo_keywords_en;
                $SliderFaculty->updated_by = Auth::user()->id;

                //URL Slugs
                $slugs = Helper::URLSlug($request->seo_url_slug_ar, $request->seo_url_slug_en, "SliderFaculty", $id);
                $SliderFaculty->seo_url_slug_ar = $slugs['slug_ar'];
                $SliderFaculty->seo_url_slug_en = $slugs['slug_en'];

                $SliderFaculty->save();
                return redirect()->action('SliderFacultyController@edit',$id)->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('SliderFacultyController@index');
            }
      
    }

    
 
 
 
  
}



             
 