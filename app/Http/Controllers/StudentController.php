<?php

namespace App\Http\Controllers;

use App\Models\AttachFile;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Map;
use App\Models\Photo;
use App\Models\Student; 
use App\Models\Section;  
use App\Models\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class StudentController extends Controller
{
    private $uploadPath = "uploads/students/";

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
        

          $students= Student::orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.students.index", compact("students"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
         

            return view("backEnd.students.create");
       
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
       
          
            
   $row_no = Student::max('row_no')+1;
           
 $audioFileFinalName="";
$videoFileFinalName = "";
          

 
            // create new Student
            $Student = new Student;

            // Save Student details
        
            
            $Student->faculty_id =$request->faculty_id;
            $Student->row_no = $row_no;
            $Student->title_ar = $request->title_ar;
            $Student->title_en = $request->title_en; 
           
            $Student->photo_file = Helper::FilterImagePath($request->photo_file); 
            $Student->created_by = Auth::user()->id;
            $Student->visits = 0;
            $Student->status = 1;  

            $Student->save();
  

            return redirect()->action('StudentController@index',$Student->id)->with('doneMessage',
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
        
          
        $students = Student::find($id);
            if (count((array)$students) > 0) {
                //Student students Details
              
                return view("backEnd.students.edit",compact("students"));
            } else {
                return redirect()->action('StudentController@index');
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
            $Student = Student::find($id);
            if (count((array)$Student) > 0) {


           
          
            
                $Student->title_ar = $request->title_ar;
                $Student->title_en = $request->title_en;
                
              
      

                $Student->photo_file = Helper::FilterImagePath($request->photo_file);
              
             $Student->faculty_id =$request->faculty_id; 
                $Student->status = $request->status;
             
                
                $Student->updated_by = Auth::user()->id;
                $Student->save();

              

                return redirect()->action('StudentController@index', $id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('StudentController@index');
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
        $Student = Student::find($id);
            if (count((array)$Student) > 0) {
              
                $Student->delete();
                return redirect()->action('StudentController@index')->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('StudentController@index');
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
                    $Student = Student::find($rowId);
                    if (count((array)$Student) > 0) {
                        $row_no_val = "row_no_" . $rowId;
                        $Student->row_no = $request->$row_no_val;
                        $Student->save();
                    }
                }

            } elseif ($request->action == "activate") {
                Student::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                Student::wherein('id', $request->ids)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {
              

             
  
              

                //Remove students
                Student::wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('StudentController@index')->with('doneMessage',
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
            $Student = Student::find($id);
            if (count((array)$Student) > 0) {

                $Student->seo_title_ar = $request->seo_title_ar;
                $Student->seo_title_en = $request->seo_title_en;
                $Student->seo_description_ar = $request->seo_description_ar;
                $Student->seo_description_en = $request->seo_description_en;
                $Student->seo_keywords_ar = $request->seo_keywords_ar;
                $Student->seo_keywords_en = $request->seo_keywords_en;
                $Student->updated_by = Auth::user()->id;

                //URL Slugs
                $slugs = Helper::URLSlug($request->seo_url_slug_ar, $request->seo_url_slug_en, "Student", $id);
                $Student->seo_url_slug_ar = $slugs['slug_ar'];
                $Student->seo_url_slug_en = $slugs['slug_en'];

                $Student->save();
                return redirect()->action('StudentController@edit',$id)->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('StudentController@index');
            }
      
    }

    
 
 
 
  
}



             
 