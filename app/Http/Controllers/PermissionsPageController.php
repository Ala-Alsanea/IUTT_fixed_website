<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Permissions;
use App\Models\User;
use App\Models\CategorieSection;
use App\Models\WebmasterSection;
use App\Models\PermissionsPage;
use App\Models\ContentSection; 
use Auth;
use File;
use Illuminate\Config; 
use Redirect;

class PermissionsPageController extends Controller
{
     private $uploadPath = "uploads/users/";

    // Define Default Variables

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0 && Auth::user()->permissions != 1) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $Users = User::where('created_by', '=', Auth::user()->id)->orwhere('id', '=', Auth::user()->id)->orderby('id',
                'asc')->paginate(env('BACKEND_PAGINATION'));
           
              $Permissions = Permissions::where('created_by', '=', Auth::user()->id)->orderby('id', 'asc')->paginate(env('BACKEND_PAGINATION'));
        } else {
            $Users = User::orderby('id', 'asc')->paginate(env('BACKEND_PAGINATION'));
            $Permissions = Permissions::orderby('id', 'asc')->paginate(env('BACKEND_PAGINATION'));
        }
        return view("backEnd.Permissions", compact("Users", "Permissions", "GeneralWebmasterSections"));
    }

       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $MenuSections = CategorieSection::where('CatStatus', '=', 'Active')->where('CatType', '!=',0)->orderby('Father_id', 'asc')->get();
        // General END

        return view("backEnd.Permissions.create", compact("GeneralWebmasterSections","MenuSections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate($request, [
            'name' => 'required'
        ]);

      

          $Permission_id = Permissions::max('id');
        if ($Permission_id < 1) {
            $Permission_id = 1;
        } else {
            $Permission_id++;
        }
        $data_sections_values = "";
        if (@$request->data_sections != "") {
            foreach ($request->data_sections as $key => $val) {
                $data_sections_values = $val . "," . $data_sections_values;
            }
            $data_sections_values = substr($data_sections_values, 0, -1);
        }
       $data_sections_values =implode(',',array_unique($request->data_sections)); 
        $Permissions = new Permissions;
        $Permissions->name = $request->name;
        $Permissions->id = $Permission_id; 
        $Permissions->view_status = ($request->ViewStatus) ? "1" : "1";
        $Permissions->add_status = ($request->view_status) ? "1" : "1";
        $Permissions->edit_status = ($request->edit_status) ? "1" : "1";
        $Permissions->delete_status = ($request->delete_status) ? "1" : "1";
        $Permissions->analytics_status = ($request->analytics_status) ? "1" : "0";
        $Permissions->inbox_status = ($request->inbox_status) ? "1" : "0";
        $Permissions->newsletter_status = ($request->newsletter_status) ? "1" : "0";
        $Permissions->calendar_status = ($request->calendar_status) ? "1" : "0";
        $Permissions->banners_status = ($request->banners_status) ? "1" : "0";
        $Permissions->settings_status = ($request->settings_status) ? "1" : "0";
        $Permissions->webmaster_status = ($request->webmaster_status) ? "1" : "0";
        $Permissions->data_sections = $data_sections_values;
        $Permissions->status = true;
        $Permissions->save();

         $MenuSection=$request->MenuSection;
         $Addarray=$request->AddStatus;
         $Editarray=$request->EditStatus;
         $Deletearray=$request->DeleteStatus;

          if (count((array)$MenuSection)>0) {

          	foreach ($MenuSection as $key => $Page_id) {
          	


      $CategorieSection=CategorieSection::find($Page_id);  
              if (!empty($CategorieSection)) {
                  $Father_id=$CategorieSection->Father_id;
                  $PermissionsPageF = PermissionsPage::where('Permission_id',$Permission_id)->where('Page_id',$Father_id)->first();
                  if (empty($PermissionsPageF)) {
                      $PermissionsPage_id = PermissionsPage::max('Id')+1;
                        $Q=new PermissionsPage;
                        $Q->Page_id = $Father_id;
                        $Q->Id = $PermissionsPage_id;
                        $Q->Permission_id = $Permission_id;
                        $Q->ViewStatus =1; 
                        $Q->AddStatus =0;
                        $Q->EditStatus =0;
                        $Q->DeleteStatus =0;
                        $Q->PermissionStatus ='Active';
                        $Q->created_by =Auth::user()->id;
                        $Q->save();
                  }else{ 
                    
                        $PermissionsPageF->ViewStatus =1; 
                        $PermissionsPageF->AddStatus =0;
                        $PermissionsPageF->EditStatus =0;
                        $PermissionsPageF->DeleteStatus =0;
                        $PermissionsPageF->PermissionStatus ='Active';
                        $PermissionsPageF->created_by =Auth::user()->id;
                        $PermissionsPageF->save();
                  }


              }

           $PermissionsPage_id = PermissionsPage::max('Id')+1;
        

        $PermissionsPage=new PermissionsPage;
        $PermissionsPage->Page_id = $Page_id;
        $PermissionsPage->Id = $PermissionsPage_id;
        $PermissionsPage->Permission_id = $Permission_id;
          $AddStatus=1; 
         if (!in_array($Page_id,$request->AddStatus)) { 
             $AddStatus=0; 
         }
 
           $EditStatus=1; 
         if (!in_array($Page_id,$request->EditStatus)) {
             $EditStatus=0;
             
         }
           $DeleteStatus=1; 
         if (!in_array($Page_id,$request->DeleteStatus)) {
             $DeleteStatus=0;
             
         }

        $PermissionsPage->AddStatus =$AddStatus;
        $PermissionsPage->EditStatus = $EditStatus;
        $PermissionsPage->DeleteStatus = $DeleteStatus;
        $PermissionsPage->ViewStatus =1;
        $PermissionsPage->PermissionStatus ='Active';
        $PermissionsPage->created_by =Auth::user()->id;
         $PermissionsPage->save();


          	}
            

          }
       

        return redirect()->action('PermissionsPageController@index')->with('doneMessage', trans('backLang.addDone'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $Permissions = Permissions::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Permissions = Permissions::find($id);
        }
        if (count((array)$Permissions) > 0) {
            return view("backEnd.Permissions.edit", compact("Permissions", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('PermissionsPageController@index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  //
        $Permissions = Permissions::find($id);

        if (count((array)$Permissions) > 0) {

          // print_r($request->data_sections);
          // exit();
            $this->validate($request, [
                'name' => 'required'
            ]);

            $data_sections_values = "";
            // if (@$request->data_sections != "") {
            //     foreach ($request->data_sections as $key => $val) {
            //         $data_sections_values = $val . "," . $data_sections_values;
            //     }
            //     $data_sections_values = substr($data_sections_values, 0, -1);
            // }
            $data_sections_values =implode(',',array_unique($request->data_sections)); 
             $Permissions->name = $request->name;
           $Permissions->view_status = ($request->view_status) ? "1" : "0";
           $Permissions->add_status = ($request->add_status) ? "1" : "1";
           $Permissions->edit_status = ($request->edit_status) ? "1" : "1";
           $Permissions->delete_status = ($request->delete_status) ? "1" : "1";
            $Permissions->analytics_status = ($request->analytics_status) ? "1" : "0";
           $Permissions->inbox_status = ($request->inbox_status) ? "1" : "0";
           $Permissions->newsletter_status = ($request->newsletter_status) ? "1" : "0";
            $Permissions->calendar_status = ($request->calendar_status) ? "1" : "0";
            $Permissions->banners_status = ($request->banners_status) ? "1" : "0";
            $Permissions->settings_status = ($request->settings_status) ? "1" : "0";
            $Permissions->webmaster_status = ($request->webmaster_status) ? "1" : "0";
            $Permissions->data_sections = $data_sections_values;
            $Permissions->status = $request->status;
             // $Permissions->save();
            if ($id != 1) {
                $Permissions->save();
            }

          $PermissionsPageId=$request->PermissionsPageId;
         $MenuSection=$request->MenuSection;
         $Addarray=$request->AddStatus;
         $Editarray=$request->EditStatus;
         $Deletearray=$request->DeleteStatus;
         $PageList=$request->Pages_id;
          $Permission_id=$id;

       // echo count($request->AddStatus).'<br>';
       // echo count($request->EditStatus).'<br>';
       // echo count($request->DeleteStatus).'<br>';
       // echo count($request->MenuSection).'<br>';
       // echo count($request->PermissionsPage).'<br>';
       // $CountAdd=count($request->AddStatus);
       // $CountEdit=count($request->EditStatus);
       // $CountDelete=count($request->DeleteStatus);
       
    
          if (count($MenuSection)>0) {

          	foreach ($MenuSection as $Index => $Page_id) {
          	
            
           //$PermissionsPage_id =$PermissionsPageId[$Index]; 
           //$Page_id =$PageList[$key]; 
              $CategorieSection=CategorieSection::find($Page_id);  
              if (!empty($CategorieSection)) {
                  $Father_id=$CategorieSection->Father_id;
                  $PermissionsPageF = PermissionsPage::where('Permission_id',$Permission_id)->where('Page_id',$Father_id)->first();
                  if (empty($PermissionsPageF)) {
                      $PermissionsPage_id = PermissionsPage::max('Id')+1;
                        $Q=new PermissionsPage;
                        $Q->Page_id = $Father_id;
                        $Q->Id = $PermissionsPage_id;
                        $Q->Permission_id = $Permission_id;
                        $Q->ViewStatus =1; 
                        $Q->AddStatus =0;
                        $Q->EditStatus =0;
                        $Q->DeleteStatus =0;
                        $Q->PermissionStatus ='Active';
                        $Q->created_by =Auth::user()->id;
                        $Q->save();
                  }else{ 

                        $PermissionsPageF->ViewStatus =1; 
                        $PermissionsPageF->AddStatus =0;
                        $PermissionsPageF->EditStatus =0;
                        $PermissionsPageF->DeleteStatus =0;
                        $PermissionsPageF->PermissionStatus ='Active';
                        $PermissionsPageF->created_by =Auth::user()->id;
                        $PermissionsPageF->save();
                  }


              }
               
            $PermissionsPage = PermissionsPage::where('Permission_id',$Permission_id)->where('Page_id',$Page_id)->first();
             
            if (empty($PermissionsPage)) {

            	  
            	     $PermissionsPage_id = PermissionsPage::max('Id')+1; 
				        $PermissionsPage=new PermissionsPage;
				        $PermissionsPage->Page_id = $Page_id;
				        $PermissionsPage->Id = $PermissionsPage_id;
				        $PermissionsPage->Permission_id = $Permission_id;
				        $PermissionsPage->ViewStatus =1;

                         $AddStatus=1; 
                         if (!in_array($Page_id,$request->AddStatus)) { 
                             $AddStatus=0; 
                         }
                 
                           $EditStatus=1; 
                         if (!in_array($Page_id,$request->EditStatus)) {
                             $EditStatus=0;
                             
                         }
                           $DeleteStatus=1; 
                         if (!in_array($Page_id,$request->DeleteStatus)) {
                             $DeleteStatus=0;
                             
                         }
        
				        $PermissionsPage->AddStatus =$AddStatus;
				        $PermissionsPage->EditStatus = $EditStatus;
				        $PermissionsPage->DeleteStatus = $DeleteStatus;
				        $PermissionsPage->PermissionStatus ='Active';
				        $PermissionsPage->created_by =Auth::user()->id;
				         $PermissionsPage->save();

            }else{

        $AddStatus=1; 
         if (!in_array($Page_id,$request->AddStatus)) { 
             $AddStatus=0; 
         }
 
           $EditStatus=1; 
         if (!in_array($Page_id,$request->EditStatus)) {
             $EditStatus=0;
             
         }
           $DeleteStatus=1; 
         if (!in_array($Page_id,$request->DeleteStatus)) {
             $DeleteStatus=0;
             
         }
        
       PermissionsPage::where('Permission_id',$Permission_id)->where('Page_id',$Page_id)->update(["AddStatus"=>$AddStatus,"EditStatus"=>$EditStatus,"DeleteStatus"=>$DeleteStatus,"PermissionStatus"=>'Active']);
  



            }
       


          	}
          }


           
      return redirect()->action('PermissionsPageController@edit', $id)->with('doneMessage',
              trans('backLang.saveDone'));
        } else {
            return redirect()->action('PermissionsPageController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
    	  //
        if (@Auth::user()->permissionsGroup->view_status) {
            $Permissions = PermissionsPage::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Permissions = PermissionsPage::find($id);
        }
        if (count((array)$Permissions) > 0 && $id != 1) {

            $Permissions->delete();
            return redirect()->action('PermissionsPageController@index')->with('doneMessage', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('PermissionsPageController@index');
        }
    }
 

    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[]
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
        

          if ($request->action == "order") {
            foreach ($request->Permission as $rowId) {
                // $Permissions = Permissions::find($rowId);
                // if (count((array)$Permissions) > 0) {
                //     $row_no_val = "row_no_" . $rowId;
                //     $Menu->row_no = $request->$row_no_val;
                //     $Menu->save();
                // }
            } 
        } elseif ($request->action == "deletePrimiton") { 
          PermissionsPage::wherein('Id', $request->PagesListId)->delete(); 
          
        } elseif ($request->action == "delete") { 
          PermissionsPage::wherein('Permission_id', $request->ids)->delete();
         Permissions::wherein('id', $request->ids)->delete();
          

        }
        return redirect()->action('PermissionsPageController@index')->with('doneMessage2',
            trans('backLang.saveDone'));
    }


    
 
 
}
