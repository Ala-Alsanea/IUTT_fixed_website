<?php

namespace App\Http\Controllers;

 

use App\Http\Requests;
use App\Models\CategorieSection;
use App\Models\WebmasterSection;
use App\Models\PermissionsPage;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class CategorieSectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        // if (@Auth::user()->permissions != 0 && Auth::user()->permissions != 1) {
        //     return Redirect::to(route('NoPermission'))->send();
        // }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ParentMenuId = 0)
    {

          $CatMenus=array();
          //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if ($ParentMenuId > 0) {
            $EditedMenu = CategorieSection::find($ParentMenuId);
            $CatMenus = CategorieSection::where('Father_id', $ParentMenuId)->orderby('row_no',
                'asc')->paginate(env('BACKEND_PAGINATION'));
        } else {
            $MenusCount = CategorieSection::where('Father_id', '0')->count();

            if ($MenusCount > 0) {
                $Menusfirst = CategorieSection::orderby('row_no', 'asc')->find(21);
                
                $CatMenus = CategorieSection::where('Father_id', $Menusfirst->Cat_id)->orderby('row_no',
                    'asc')->paginate(env('BACKEND_PAGINATION'));
                
                $EditedMenu = CategorieSection::find($Menusfirst->Cat_id);

            } else {
                $CatMenus = CategorieSection::where('Father_id', '0')->orderby('row_no', 'asc')->paginate(env('BACKEND_PAGINATION'));

                $EditedMenu = "";
            }
        }
        //Parent Menus

        $ParentMenus = CategorieSection::where('Father_id', '0')->orderby('row_no', 'asc')->get();

        return view("backEnd.CategorieSection", compact("CatMenus", "GeneralWebmasterSections", "ParentMenus", "EditedMenu"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create($ParentMenuId = 0)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //Father Menus
        $FatherMenus = CategorieSection::where('Father_id', $ParentMenuId)->where('CatType', 0)->orderby('row_no', 'asc')->get();

        return view("backEnd.CategorieSection.create",
            compact("GeneralWebmasterSections", "EditedMenu", "ParentMenuId", "FatherMenus"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request, $ParentMenuId)
    {
        //
        // $next_nor_no = CategorieSection::where('Father_id', $ParentMenuId)->max('row_no')+1;
        // if ($next_nor_no < 1) {
        //     $next_nor_no = 1;
        // } else {
        //     $next_nor_no++;
        // }

         $next_nor_no = CategorieSection::where('Father_id', $ParentMenuId);
         $father = $ParentMenuId;
        if ($request->Father_id > 0) {
            $father = $request->Father_id;
             $next_nor_no->where('Father_id', $father);
        }
        $row_no=$next_nor_no->max('row_no')+1;
        $Menu = new CategorieSection;
        $Menu->row_no = $row_no; 
        $Menu->Father_id = $father;
        $Menu->CatTitle_ar = $request->CatTitle_ar;
        $Menu->CatTitle_en = $request->CatTitle_en;
        $Menu->CatType = $request->CatType;
        $Menu->Catlink = $request->Catlink;
        $Menu->CatIcon = $request->CatIcon;
        $Menu->Subcat_id = $request->Subcat_id;
        $Menu->CatStatus ='Active';
        $Menu->created_by =  Auth::user()->id;
        $Menu->save();

        return redirect()->action('CategorieSectionController@index', $request->ParentMenuId)->with('ParentMenuId',
            $ParentMenuId)->with('doneMessage2', trans('backLang.addDone'));
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeCatMenu(Request $request)
    {
        //
        $next_nor_no = CategorieSection::where('Father_id', "0")->max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }

        $Menu = new CategorieSection;
        $Menu->row_no = $next_nor_no;
        $Menu->Father_id = 0;
        $Menu->CatTitle_ar = $request->CatTitle_ar;
        $Menu->CatTitle_en = $request->CatTitle_en;
        $Menu->created_by =  Auth::user()->id;
        $Menu->CatStatus ='Active';
        $Menu->save();

        return redirect()->action('CategorieSectionController@index');
    }


   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorieSection  $categorieSection
     * @return \Illuminate\Http\Response
     */
  public function edit($id, $ParentMenuId)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //Father Menus
        $FatherMenus = CategorieSection::where('Father_id', $ParentMenuId)->where('CatType', 0)->where('Cat_id', "!=", $id)->orderby('row_no', 'asc')->get();

        $CatMenus = CategorieSection::find($id);
        if (count((array)$CatMenus) > 0) {
            return view("backEnd.CategorieSection.edit",
                compact("CatMenus", "GeneralWebmasterSections", "ParentMenuId", "FatherMenus"));
        } else {
            return redirect()->action('CategorieSectionController@index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategorieSection  $categorieSection
     * @return \Illuminate\Http\Response
     */
    public function editCatMenu($id)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        $Menus = CategorieSection::find($id);
        if (count((array)$Menus) > 0) {
            return redirect()->action('CategorieSectionController@index', $id)->with('EditCatMenu', "Yes");
        } else {
            return redirect()->action('CategorieSectionController@index');
        }
    }

     public function update(Request $request, $id)
    {
        //
        $Menu = CategorieSection::find($id);
        if (count((array)$Menu) > 0) {

            $Menu->Father_id = $request->Father_id;
            $Menu->CatTitle_ar = $request->CatTitle_ar;
            $Menu->CatTitle_en = $request->CatTitle_en;
            $Menu->CatType = $request->CatType;
            $Menu->Catlink = $request->Catlink;
            $Menu->CatIcon = $request->CatIcon;
            $Menu->Subcat_id = $request->Subcat_id;
            $Menu->CatStatus = $request->CatStatus;
            $Menu->updated_by =  Auth::user()->id;
            $Menu->save();
            return redirect()->action('CategorieSectionController@index',
                ["id" => $id, "ParentMenuId" => $request->ParentMenuId])->with('doneMessage2',
                trans('backLang.saveDone'));
        } else {
            return redirect()->action('CategorieSectionController@index');
        }
    }

     public function updateCatMenu(Request $request, $Cat_id)
    {
        //
        $Menu = CategorieSection::find($Cat_id);
        if (count((array)$Menu) > 0) {
            $Menu->CatTitle_ar = $request->CatTitle_ar;
            $Menu->CatTitle_en = $request->CatTitle_en;
            $Menu->updated_by =  Auth::user()->id;
            $Menu->save();
            return redirect()->action('CategorieSectionController@index',
                ["id" => $Cat_id, "ParentMenuId" => $request->ParentMenuId])->with('doneMessage2',
                trans('backLang.saveDone'));
        } else {
            return redirect()->action('CategorieSectionController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorieSection  $categorieSection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $Menu = CategorieSection::find($id);
        if (count((array)$Menu) > 0) {
            $Menu->delete();
            return redirect()->action('CategorieSectionController@index')->with('doneMessage', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('CategorieSectionController@index');
        }
    }


    public function destroyCatMenu($id)
    {
        //
        $Menu = CategorieSection::find($id);
        if (count((array)$Menu) > 0) {
            $subMenus = CategorieSection::where('Father_id', $Menu->Cat_id)->get();
            foreach ($subMenus as $subMenu) {
                CategorieSection::where('Father_id', $subMenu->Cat_id)->delete();
            }
            CategorieSection::where('Father_id', $Menu->Cat_id)->delete();
            $Menu->delete();
            return redirect()->action('CategorieSectionController@index')->with('doneMessage2', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('CategorieSectionController@index');
        }
    }



     public function updateAll(Request $request)
    {
        
        //
        if ($request->action == "order") {
            foreach ($request->row_ids as $rowId) {
                $Menu = CategorieSection::find($rowId);
                if (count((array)$Menu) > 0) {
                    $row_no_val = "row_no_" . $rowId;
                    $Menu->row_no = $request->$row_no_val;
                    $Menu->save();
                }
            }

        } elseif ($request->action == "activate") {
            CategorieSection::wherein('Cat_id', $request->ids)
                ->update(['CatStatus' => 'Active']);

        } elseif ($request->action == "block") {
            CategorieSection::wherein('Cat_id', $request->ids)
                ->update(['CatStatus' =>'Disabled']);

        } elseif ($request->action == "delete") { 
          PermissionsPage::wherein('Page_id', $request->ids)->delete();
         CategorieSection::wherein('Father_id', $request->ids)->delete();
          CategorieSection::wherein('Cat_id', $request->ids)
             ->delete();

        }
        return redirect()->action('CategorieSectionController@index', $request->ParentMenuId)->with('doneMessage2',
            trans('backLang.saveDone'));
    }
}
