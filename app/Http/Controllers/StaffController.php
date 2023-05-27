<?php

namespace App\Http\Controllers;

use App\Models\AttachFile;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Map;
use App\Models\Photo;
use App\Models\Staff; 
use App\Models\Section;  
use App\Models\ContentSection;  
use App\Models\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class StaffController extends Controller
{
    private $uploadPath = "uploads/staff/";

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
    public function index($section_id)
    {
        // Check Permissions
       // 
    $SectionDetail = Section::where('status', 1)->orderby('row_no', 'asc')->find($section_id);
          $Topics= Staff::where('section_id',$section_id)->orderby('row_no','asc')->paginate(env('BACKEND_PAGINATION'));
            return view("backEnd.staff.index", compact("Topics","section_id","SectionDetail"));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function create($section_id)
    {
         
         
$SectionDetail = Section::where('status', 1)->orderby('row_no', 'asc')->find($section_id);
            return view("backEnd.staff.create", compact("section_id","SectionDetail"));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$section_id)
    {
       
          
            
   $row_no = Staff::max('row_no')+1;
           
 $audioFileFinalName="";
$videoFileFinalName = "";
          

 
            // create new Staff
            $Staff = new Staff;

            // Save Staff details
        
            
            $Staff->faculty_id =$request->faculty_id;
            $Staff->father_id =$request->father_id;
            $Staff->row_no = $row_no;
            $Staff->title_ar = $request->title_ar;
            $Staff->title_en = $request->title_en;
 
            $Staff->qualification_ar = $request->qualification_ar;
            $Staff->qualification_en = $request->qualification_en;
            $Staff->postion_ar = $request->postion_ar;
            $Staff->postion_en = $request->postion_en;
            $Staff->address_ar = $request->address_ar;
            $Staff->address_en = $request->address_en;
            $Staff->email = $request->email;
            $Staff->major_ar = $request->major_ar;
            $Staff->major_en = $request->major_en; 
            $Staff->publications_ar = $request->publications_ar;
            $Staff->publications_en = $request->publications_en;
            $Staff->Experiences_ar = $request->Experiences_ar;
            $Staff->Experiences_en = $request->Experiences_en;
            $Staff->Courses_ar = $request->Courses_ar;
            $Staff->Courses_en = $request->Courses_en;
            $Staff->Activities_ar = $request->Activities_ar;
            $Staff->Activities_en = $request->Activities_en;
             $Staff->level_view = $request->level_view;
           
           
            $Staff->photo_file = Helper::FilterImagePath($request->photo_file);
            $Staff->attach_file = Helper::FilterImagePath($request->attach_file); 
             
            $Staff->webmaster_id =0; 
            $Staff->section_id =$request->section_id; 
            $Staff->previous_emp =$request->previous_emp; 
            $Staff->created_by = Auth::user()->id;
            $Staff->visits = 0;
            $Staff->status = 1;

            // Meta title
            $Staff->seo_title_ar = $request->title_ar;
            $Staff->seo_title_en = $request->title_en;

            // URL Slugs
            $slugs = Helper::URLSlug($request->title_ar, $request->title_en, "Staff", 0);
            $Staff->seo_url_slug_ar = $slugs['slug_ar'];
            $Staff->seo_url_slug_en = $slugs['slug_en'];

            // Meta Description
            $Staff->seo_description_ar = mb_substr(strip_tags(stripslashes($request->details_ar)), 0, 165, 'UTF-8');
            $Staff->seo_description_en = mb_substr(strip_tags(stripslashes($request->details_en)), 0, 165, 'UTF-8');


            $Staff->save();
  

            return redirect()->action('StaffController@index',$section_id)->with('doneMessage',
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
    public function edit($section_id,$id)
    {
        
       $SectionDetail = Section::where('status', 1)->orderby('row_no', 'asc')->find($section_id);
        $Topics = Staff::find($id);
            if (count((array)$Topics) > 0) {
                //Staff staff Details
              
                return view("backEnd.staff.edit",compact("Topics","section_id","SectionDetail"));
            } else {
                return redirect()->action('StaffController@index', $section_id);
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
    public function update(Request $request,$section_id,$id)
    {
       
            //
            $Staff = Staff::find($id);
            if (count((array)$Staff) > 0) {


           
          
            
                $Staff->title_ar = $request->title_ar;
                $Staff->title_en = $request->title_en;
             
               
                 $Staff->section_id =$request->section_id; 
            

                $Staff->photo_file = Helper::FilterImagePath($request->photo_file);
                $Staff->attach_file = Helper::FilterImagePath($request->attach_file);  
           
             $Staff->faculty_id =$request->faculty_id;
             $Staff->father_id =$request->father_id;
            
                $Staff->status = $request->status;
                 $Staff->qualification_ar = $request->qualification_ar;
            $Staff->qualification_en = $request->qualification_en;
            $Staff->postion_ar = $request->postion_ar;
            $Staff->postion_en = $request->postion_en;
            $Staff->address_ar = $request->address_ar;
            $Staff->address_en = $request->address_en;
            $Staff->email = $request->email;
            $Staff->major_ar = $request->major_ar;
            $Staff->major_en = $request->major_en;
            $Staff->publications_ar = $request->publications_ar;
            $Staff->publications_en = $request->publications_en;
            $Staff->Experiences_ar = $request->Experiences_ar;
            $Staff->Experiences_en = $request->Experiences_en;
            $Staff->Courses_ar = $request->Courses_ar;
            $Staff->Courses_en = $request->Courses_en;
            $Staff->Activities_ar = $request->Activities_ar;
            $Staff->Activities_en = $request->Activities_en;
             $Staff->level_view = $request->level_view;
             $Staff->previous_emp = $request->previous_emp;
                
                $Staff->updated_by = Auth::user()->id;
                $Staff->save();

              

                return redirect()->action('StaffController@index', $section_id)->with('doneMessage',
                    trans('backLang.saveDone'));
            } else {
                return redirect()->action('StaffController@index', $section_id);
            }
       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function destroy($section_id,$id)
    {
        $Staff = Staff::find($id);
            if (!empty($Staff)) {
                // Delete a Staff photo
                if ($Staff->photo_file != "") {
                    File::delete($this->getUploadPath() . $Staff->photo_file);
                }
                if ($Staff->attach_file != "") {
                    File::delete($this->getUploadPath() . $Staff->attach_file);
                }
                if ($Staff->audio_file != "") {
                    File::delete($this->getUploadPath() . $Staff->audio_file);
                }
                if ($Staff->video_type == 0 && $Staff->video_file != "") {
                    File::delete($this->getUploadPath() . $Staff->video_file);
                }
               
               
               
                $Staff->delete();
                return redirect()->action('StaffController@index', $section_id)->with('doneMessage',
                    trans('backLang.deleteDone'));
            } else {
                return redirect()->action('StaffController@index', $section_id);
            }
      
    }


    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[],$webmasterId
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request,$section_id)
    {
        
            //
            if ($request->action == "order") {
                foreach ($request->row_ids as $rowId) {
                    $Staff = Staff::find($rowId);
                    if (count((array)$Staff) > 0) {
                        $row_no_val = "row_no_" . $rowId;
                        $Staff->row_no = $request->$row_no_val;
                        $Staff->save();
                    }
                }

            } elseif ($request->action == "activate") {
                Staff::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                Staff::wherein('id', $request->ids)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {
                // Check Permissions
                if (!@Auth::user()->permissionsGroup->delete_status) {
                    return Redirect::to(route('NoPermission'))->send();
                }
                // Delete staff photo
                $staff = Staff::wherein('id', $request->ids)->get();
                foreach ($staff as $Staff) {
                    if ($Staff->photo_file != "") {
                        File::delete($this->getUploadPath() . $Staff->photo_file);
                    }
                    if ($Staff->attach_file != "") {
                        File::delete($this->getUploadPath() . $Staff->attach_file);
                    }
                    if ($Staff->audio_file != "") {
                        File::delete($this->getUploadPath() . $Staff->audio_file);
                    }
                    if ($Staff->video_type == 0 && $Staff->video_file != "") {
                        File::delete($this->getUploadPath() . $Staff->video_file);
                    }
                }

             
  
              

                //Remove staff
                Staff::wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('StaffController@index', $section_id)->with('doneMessage',
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
    function seo(Request $request,$section_id,$id)
    {
      
            //
            $Staff = Staff::find($id);
            if (count((array)$Staff) > 0) {

                $Staff->seo_title_ar = $request->seo_title_ar;
                $Staff->seo_title_en = $request->seo_title_en;
                $Staff->seo_description_ar = $request->seo_description_ar;
                $Staff->seo_description_en = $request->seo_description_en;
                $Staff->seo_keywords_ar = $request->seo_keywords_ar;
                $Staff->seo_keywords_en = $request->seo_keywords_en;
                $Staff->updated_by = Auth::user()->id;

                //URL Slugs
                $slugs = Helper::URLSlug($request->seo_url_slug_ar, $request->seo_url_slug_en, "Staff", $id);
                $Staff->seo_url_slug_ar = $slugs['slug_ar'];
                $Staff->seo_url_slug_en = $slugs['slug_en'];

                $Staff->save();
                return redirect()->action('StaffController@edit',[$section_id,$id])->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'seo');
            } else {
                return redirect()->action('StaffController@index', $section_id);
            }
      
    }

    
 
 
  

  
}



             
 