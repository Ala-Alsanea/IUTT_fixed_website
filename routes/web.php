<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WebmailsController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FrontendHomeController;
use App\Http\Controllers\FacultiesHomeController;
use App\Http\Controllers\FacultiesNewsController;
use App\Http\Controllers\SliderFacultyController;
use App\Http\Controllers\PermissionsPageController;
use App\Http\Controllers\CategorieSectionController;
use App\Http\Controllers\UniversityCenterController;
use App\Http\Controllers\WebmasterBannersController;
use App\Http\Controllers\WebmasterSectionsController;
use App\Http\Controllers\WebmasterSettingsController;

if (App::environment('production')) {
    URL::forceScheme('https');
}
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// test

Route::get('/test', function () {
    #$exitCode = Artisan::call('key:generate');
    return 'hi';
});



Route::get('/route-clear', function () {
    #  $exitCode = Artisan::call('config:clear');
    #   $exitCode = Artisan::call('cache:clear');
    #  $exitCode = Artisan::call('config:clear');
    #  $exitCode = Artisan::call('view:clear');


    return 'Routes cache cleared';
});

// Clear config cache:
Route::get('/config-cache', function () {
    # $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache:
Route::get('/clear-cache', function () {

    #  $exitCode = Artisan::call('cache:clear');
    # $exitCode = Artisan::call('config:clear');
    #  $exitCode = Artisan::call('route:clear');
    #   $exitCode = Artisan::call('view:clear');
    //  $exitCode = Artisan::call('optimize');
    //   $exitCode = Artisan::call('dump-autoload');


    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function () {
    #  $exitCode = Artisan::call('view:clear');
    # return 'View cache cleared';
});

// Language Route
Route::post('/lang', array(
    'Middleware' => 'LanguageSwitcher',
    'uses' => [LanguageController::class,'index'],
))->name('lang');
// For Language direct URL link
Route::get('/lang/{lang}', array(
    'Middleware' => 'LanguageSwitcher',
    'uses' => [LanguageController::class,'change'],
))->name('langChange');
// .. End of Language Route

// Backend Routes
Route::middleware(['web'])->group(function () {
    Auth::routes();
});


// default path after login
Route::get('/admin', function () {
    return redirect()->route('adminHome');
});

Route::Group(['prefix' => env('BACKEND_PATH')], function () {



    //    Helper::InitConfigPage();

    // No Permission
    Route::get('/403', function () {
        return view('errors.403');
    })->name('NoPermission');

    // Not Found
    Route::get('/404', function () {
        return view('errors.404');
    })->name('NotFound');

    // Admin Home
    Route::get('', [HomeController::class,'index'])->name('adminHome');
    //Search
    Route::get('/search', [HomeController::class,'search'])->name('adminSearch');
    Route::post('/find', [HomeController::class,'find'])->name('adminFind');
    // FileManager
    Route::get('/media', [HomeController::class,'FileManager'])->name('media');

    // Webmaster
    Route::get('/webmaster', [WebmasterSettingsController::class,'edit'])->name('webmasterSettings');
    Route::post('/webmaster', [WebmasterSettingsController::class,'update'])->name('webmasterSettingsUpdate');

    // Webmaster Banners
    Route::get('/webmaster/banners', [WebmasterBannersController::class,'index'])->name('WebmasterBanners');
    Route::get('/webmaster/banners/create', [WebmasterBannersController::class,'create'])->name('WebmasterBannersCreate');
    Route::post('/webmaster/banners/store', [WebmasterBannersController::class,'store'])->name('WebmasterBannersStore');
    Route::get('/webmaster/banners/{id}/edit', [WebmasterBannersController::class,'edit'])->name('WebmasterBannersEdit');
    Route::post('/webmaster/banners/{id}/update', [WebmasterBannersController::class,'update'])->name('WebmasterBannersUpdate');
    Route::get(
        '/webmaster/banners/destroy/{id}',
        [WebmasterBannersController::class,'destroy']
    )->name('WebmasterBannersDestroy');
    Route::post(
        '/webmaster/banners/updateAll',
        [WebmasterBannersController::class,'updateAll']
    )->name('WebmasterBannersUpdateAll');

    // Webmaster Sections
    Route::get('/webmaster/sections', [WebmasterSectionsController::class,'index'])->name('WebmasterSections');
    Route::get('/webmaster/sections/create', [WebmasterSectionsController::class,'create'])->name('WebmasterSectionsCreate');
    Route::post('/webmaster/sections/store', [WebmasterSectionsController::class,'store'])->name('WebmasterSectionsStore');
    Route::get('/webmaster/sections/{id}/edit', [WebmasterSectionsController::class,'edit'])->name('WebmasterSectionsEdit');
    Route::post(
        '/webmaster/sections/{id}/update',
        [WebmasterSectionsController::class,'update']
    )->name('WebmasterSectionsUpdate');

    Route::post('/webmaster/sections/{id}/seo', [WebmasterSectionsController::class,'seo'])->name('WebmasterSectionsSEOUpdate');

    Route::get(
        '/webmaster/sections/destroy/{id}',
        [WebmasterSectionsController::class,'destroy']
    )->name('WebmasterSectionsDestroy');
    Route::post(
        '/webmaster/sections/updateAll',
        [WebmasterSectionsController::class,'updateAll']
    )->name('WebmasterSectionsUpdateAll');

    // Webmaster Sections :Custom Fields
    Route::get('/webmaster/{webmasterId}/fields', [WebmasterSectionsController::class,'webmasterFields'])->name('webmasterFields');
    Route::get('/{webmasterId}/fields/create', [WebmasterSectionsController::class,'fieldsCreate'])->name('webmasterFieldsCreate');
    Route::post('/webmaster/{webmasterId}/fields/store', [WebmasterSectionsController::class,'fieldsStore'])->name('webmasterFieldsStore');
    Route::get('/webmaster/{webmasterId}/fields/{field_id}/edit', [WebmasterSectionsController::class,'fieldsEdit'])->name('webmasterFieldsEdit');
    Route::post('/webmaster/{webmasterId}/fields/{field_id}/update', [WebmasterSectionsController::class,'fieldsUpdate'])->name('webmasterFieldsUpdate');
    Route::get('/webmaster/{webmasterId}/fields/destroy/{field_id}', [WebmasterSectionsController::class,'fieldsDestroy'])->name('webmasterFieldsDestroy');
    Route::post('/webmaster/{webmasterId}/fields/updateAll', [WebmasterSectionsController::class,'fieldsUpdateAll'])->name('webmasterFieldsUpdateAll');

    // Settings
    Route::get('/settings', [SettingsController::class,'edit'])->name('settings');

    Route::post('/settings', [SettingsController::class,'updateSiteInfo'])->name('settingsUpdateSiteInfo');
    Route::post('/optimizedevel', [SettingsController::class,'optimizedevel']);
    Route::post('/settings/style', [SettingsController::class,'updateSiteStyle'])->name('settingsUpdateSiteStyle');
    Route::post('/settings/status', [SettingsController::class,'updateSiteStatus'])->name('settingsUpdateSiteStatus');
    Route::post('/settings/social', [SettingsController::class,'updateSocialLinks'])->name('settingsUpdateSocialLinks');
    Route::post('/settings/contacts', [SettingsController::class,'updateContacts'])->name('settingsUpdateContacts');

    // Ad. Banners
    Route::get('/banners', [BannersController::class,'index'])->name('Banners');
    Route::get('/banners/create/{sectionId}', [BannersController::class,'create'])->name('BannersCreate');
    Route::post('/banners/store', [BannersController::class,'store'])->name('BannersStore');
    Route::get('/banners/{id}/edit', [BannersController::class,'edit'])->name('BannersEdit');
    Route::post('/banners/{id}/update', [BannersController::class,'update'])->name('BannersUpdate');
    Route::get('/banners/destroy/{id}', [BannersController::class,'destroy'])->name('BannersDestroy');
    Route::post('/banners/updateAll', [BannersController::class,'updateAll'])->name('BannersUpdateAll');

    // Sections
    Route::get('/{webmasterId}/sections', [SectionsController::class,'index'])->name('sections');
    Route::get('/{webmasterId}/sections/create', [SectionsController::class,'create'])->name('sectionsCreate');
    Route::post('/{webmasterId}/sections/store', [SectionsController::class,'store'])->name('sectionsStore');
    Route::get('/{webmasterId}/sections/{id}/edit', [SectionsController::class,'edit'])->name('sectionsEdit');
    Route::post('/{webmasterId}/sections/{id}/update', [SectionsController::class,'update'])->name('sectionsUpdate');
    Route::post('/{webmasterId}/sections/{id}/seo', [SectionsController::class,'seo'])->name('sectionsSEOUpdate');
    Route::get('/{webmasterId}/sections/destroy/{id}', [SectionsController::class,'destroy'])->name('sectionsDestroy');
    Route::post('/{webmasterId}/sections/updateAll', [SectionsController::class,'updateAll'])->name('sectionsUpdateAll');

    // Topics
    Route::get('/{webmasterId}/topics', [TopicsController::class,'index'])->name('topics');
    Route::get('/{webmasterId}/topics/create', [TopicsController::class,'create'])->name('topicsCreate');
    Route::post('/{webmasterId}/topics/store', [TopicsController::class,'store'])->name('topicsStore');
    Route::get('/{webmasterId}/topics/{id}/edit', [TopicsController::class,'edit'])->name('topicsEdit');
    Route::post('/{webmasterId}/topics/{id}/update', [TopicsController::class,'update'])->name('topicsUpdate');
    Route::get('/{webmasterId}/topics/destroy/{id}', [TopicsController::class,'destroy'])->name('topicsDestroy');
    Route::post('/{webmasterId}/topics/updateAll', [TopicsController::class,'updateAll'])->name('topicsUpdateAll');
    // Topics :SEO
    Route::post('/{webmasterId}/topics/{id}/seo', [TopicsController::class,'seo'])->name('topicsSEOUpdate');



    // Topics :Photos


    Route::post('/{webmasterId}/topics/{id}/photos', [TopicsController::class,'photos'])->name('topicsPhotosEdit');
    Route::get(
        '/{webmasterId}/topics/{id}/photos/{photo_id}/destroy',
        [TopicsController::class,'photosDestroy']
    )->name('topicsPhotosDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/photos/updateAll',
        [TopicsController::class,'photosUpdateAll']
    )->name('topicsPhotosUpdateAll');

    Route::post('/{webmasterId}/topics/{id}/mangerphotos', [TopicsController::class,'FileManagerPhotos'])->name('FileManagertopicsPhotos');

    // Topics :Files
    Route::get('/{webmasterId}/topics/{id}/files', [TopicsController::class,'topicsFiles'])->name('topicsFiles');
    Route::get(
        '/{webmasterId}/topics/{id}/files/create',
        [TopicsController::class,'filesCreate']
    )->name('topicsFilesCreate');
    Route::post(
        '/{webmasterId}/topics/{id}/files/store',
        [TopicsController::class,'filesStore']
    )->name('topicsFilesStore');
    Route::get(
        '/{webmasterId}/topics/{id}/files/{file_id}/edit',
        [TopicsController::class,'filesEdit']
    )->name('topicsFilesEdit');
    Route::post(
        '/{webmasterId}/topics/{id}/files/{file_id}/update',
        [TopicsController::class,'filesUpdate']
    )->name('topicsFilesUpdate');
    Route::get(
        '/{webmasterId}/topics/{id}/files/destroy/{file_id}',
        [TopicsController::class,'filesDestroy']
    )->name('topicsFilesDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/files/updateAll',
        [TopicsController::class,'filesUpdateAll']
    )->name('topicsFilesUpdateAll');


    // Topics :Related
    Route::get('/{webmasterId}/topics/{id}/related', [TopicsController::class,'topicsRelated'])->name('topicsRelated');
    Route::get('/relatedLoad/{id}', [TopicsController::class,'topicsRelatedLoad'])->name('topicsRelatedLoad');
    Route::get(
        '/{webmasterId}/topics/{id}/related/create',
        [TopicsController::class,'relatedCreate']
    )->name('topicsRelatedCreate');
    Route::post(
        '/{webmasterId}/topics/{id}/related/store',
        [TopicsController::class,'relatedStore']
    )->name('topicsRelatedStore');
    Route::get(
        '/{webmasterId}/topics/{id}/related/destroy/{related_id}',
        [TopicsController::class,'relatedDestroy']
    )->name('topicsRelatedDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/related/updateAll',
        [TopicsController::class,'relatedUpdateAll']
    )->name('topicsRelatedUpdateAll');
    // Topics :Comments
    Route::get('/{webmasterId}/topics/{id}/comments', [TopicsController::class,'topicsComments'])->name('topicsComments');
    Route::get(
        '/{webmasterId}/topics/{id}/comments/create',
        [TopicsController::class,'commentsCreate']
    )->name('topicsCommentsCreate');
    Route::post(
        '/{webmasterId}/topics/{id}/comments/store',
        [TopicsController::class,'commentsStore']
    )->name('topicsCommentsStore');
    Route::get(
        '/{webmasterId}/topics/{id}/comments/{comment_id}/edit',
        [TopicsController::class,'commentsEdit']
    )->name('topicsCommentsEdit');
    Route::post(
        '/{webmasterId}/topics/{id}/comments/{comment_id}/update',
        [TopicsController::class,'commentsUpdate']
    )->name('topicsCommentsUpdate');
    Route::get(
        '/{webmasterId}/topics/{id}/comments/destroy/{comment_id}',
        [TopicsController::class,'commentsDestroy']
    )->name('topicsCommentsDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/comments/updateAll',
        [TopicsController::class,'commentsUpdateAll']
    )->name('topicsCommentsUpdateAll');
    // Topics :Maps
    Route::get('/{webmasterId}/topics/{id}/maps', [TopicsController::class,'topicsMaps'])->name('topicsMaps');
    Route::get('/{webmasterId}/topics/{id}/maps/create', [TopicsController::class,'mapsCreate'])->name('topicsMapsCreate');
    Route::post('/{webmasterId}/topics/{id}/maps/store', [TopicsController::class,'mapsStore'])->name('topicsMapsStore');
    Route::get('/{webmasterId}/topics/{id}/maps/{map_id}/edit', [TopicsController::class,'mapsEdit'])->name('topicsMapsEdit');
    Route::post(
        '/{webmasterId}/topics/{id}/maps/{map_id}/update',
        [TopicsController::class,'mapsUpdate']
    )->name('topicsMapsUpdate');
    Route::get(
        '/{webmasterId}/topics/{id}/maps/destroy/{map_id}',
        [TopicsController::class,'mapsDestroy']
    )->name('topicsMapsDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/maps/updateAll',
        [TopicsController::class,'mapsUpdateAll']
    )->name('topicsMapsUpdateAll');

    // Contacts Groups
    Route::post('/contacts/storeGroup', [ContactsController::class,'storeGroup'])->name('contactsStoreGroup');
    Route::get('/contacts/{id}/editGroup', [ContactsController::class,'editGroup'])->name('contactsEditGroup');
    Route::post('/contacts/{id}/updateGroup', [ContactsController::class,'updateGroup'])->name('contactsUpdateGroup');
    Route::get('/contacts/destroyGroup/{id}', [ContactsController::class,'destroyGroup'])->name('contactsDestroyGroup');
    // Contacts
    Route::get('/contacts/{group_id?}', [ContactsController::class,'index'])->name('contacts');
    Route::post('/contacts/store', [ContactsController::class,'store'])->name('contactsStore');
    Route::post('/contacts/search', [ContactsController::class,'search'])->name('contactsSearch');
    Route::get('/contacts/{id}/edit', [ContactsController::class,'edit'])->name('contactsEdit');
    Route::post('/contacts/{id}/update', [ContactsController::class,'update'])->name('contactsUpdate');
    Route::get('/contacts/destroy/{id}', [ContactsController::class,'destroy'])->name('contactsDestroy');
    Route::post('/contacts/updateAll', [ContactsController::class,'updateAll'])->name('contactsUpdateAll');

    // WebMails Groups
    Route::post('/webmails/storeGroup', [WebmailsController::class,'storeGroup'])->name('webmailsStoreGroup');
    Route::get('/webmails/{id}/editGroup', [WebmailsController::class,'editGroup'])->name('webmailsEditGroup');
    Route::post('/webmails/{id}/updateGroup', [WebmailsController::class,'updateGroup'])->name('webmailsUpdateGroup');
    Route::get('/webmails/destroyGroup/{id}', [WebmailsController::class,'destroyGroup'])->name('webmailsDestroyGroup');
    // WebMails
    Route::post('/webmails/store', [WebmailsController::class,'store'])->name('webmailsStore');
    Route::post('/webmails/search', [WebmailsController::class,'search'])->name('webmailsSearch');
    Route::get('/webmails/{id}/edit', [WebmailsController::class,'edit'])->name('webmailsEdit');
    Route::get('/webmails/{group_id?}/{wid?}/{stat?}/{contact_email?}', [WebmailsController::class,'index'])->name('webmails');
    Route::post('/webmails/{id}/update', [WebmailsController::class,'update'])->name('webmailsUpdate');
    Route::get('/webmails/destroy/{id}', [WebmailsController::class,'destroy'])->name('webmailsDestroy');
    Route::post('/webmails/updateAll', [WebmailsController::class,'updateAll'])->name('webmailsUpdateAll');

    // Calendar
    Route::get('/calendar', [EventsController::class,'index'])->name('calendar');
    Route::get('/calendar/create', [EventsController::class,'create'])->name('calendarCreate');
    Route::post('/calendar/store', [EventsController::class,'store'])->name('calendarStore');
    Route::get('/calendar/{id}/edit', [EventsController::class,'edit'])->name('calendarEdit');
    Route::post('/calendar/{id}/update', [EventsController::class,'update'])->name('calendarUpdate');
    Route::get('/calendar/destroy/{id}', [EventsController::class,'destroy'])->name('calendarDestroy');
    Route::get('/calendar/updateAll', [EventsController::class,'updateAll'])->name('calendarUpdateAll');
    Route::post('/calendar/{id}/extend', [EventsController::class,'extend'])->name('calendarExtend');

    // Analytics
    Route::get('/ip/{ip_code?}', [AnalyticsController::class,'ip'])->name('visitorsIP');
    Route::post('/ip/search', [AnalyticsController::class,'search'])->name('visitorsSearch');
    Route::post('/analytics/{stat}', [AnalyticsController::class,'filter'])->name('analyticsFilter');
    Route::get('/analytics/{stat?}', [AnalyticsController::class,'index'])->name('analytics');
    Route::get('/visitors', [AnalyticsController::class,'visitors'])->name('visitors');

    // Users & Permissions
    Route::get('/users', [UsersController::class,'index'])->name('users');
    Route::get('/users/create/', [UsersController::class,'create'])->name('usersCreate');
    Route::post('/users/store', [UsersController::class,'store'])->name('usersStore');
    Route::get('/users/{id}/edit', [UsersController::class,'edit'])->name('usersEdit');
    Route::post('/users/{id}/update', [UsersController::class,'update'])->name('usersUpdate');
    Route::get('/users/destroy/{id}', [UsersController::class,'destroy'])->name('usersDestroy');
    Route::post('/users/updateAll', [UsersController::class,'updateAll'])->name('usersUpdateAll');

    Route::get('/users/permissions/create/', [UsersController::class,'permissions_create'])->name('permissionsCreate');
    Route::post('/users/permissions/store', [UsersController::class,'permissions_store'])->name('permissionsStore');
    Route::get('/users/permissions/{id}/edit', [UsersController::class,'permissions_edit'])->name('permissionsEdit');
    Route::post('/users/permissions/{id}/update', [UsersController::class,'permissions_update'])->name('permissionsUpdate');
    Route::get('/users/permissions/destroy/{id}', [UsersController::class,'permissions_destroy'])->name('permissionsDestroy');
    //Route::get('/Privilege', [PermissionsPageController::class,'Privilege')->name('Privilege');

    //Permissions

    Route::get('/Permissions', [PermissionsPageController::class,'index'])->name('Permissions');
    Route::get('/Permissions/create/', [PermissionsPageController::class,'create'])->name('Create');
    Route::post('/Permissions/store', [PermissionsPageController::class,'store'])->name('Store');
    Route::get('/Permissions/{id}/edit', [PermissionsPageController::class,'edit'])->name('Edit');
    Route::post('/Permissions/{id}/update', [PermissionsPageController::class,'update'])->name('Update');
    Route::get('/Permissions/destroy/{id}', [PermissionsPageController::class,'destroy'])->name('Destroy');
    Route::post('/Permissions/updateAll', [PermissionsPageController::class,'updateAll'])->name('PrimationUpdateAll');

    // Menus
    Route::post('/menus/store/parent', [MenusController::class,'storeMenu'])->name('parentMenusStore');
    Route::get('/menus/parent/{id}/edit', [MenusController::class,'editMenu'])->name('parentMenusEdit');
    Route::post('/menus/{id}/update/{ParentMenuId}', [MenusController::class,'updateMenu'])->name('parentMenusUpdate');
    Route::get('/menus/parent/destroy/{id}', [MenusController::class,'destroyMenu'])->name('parentMenusDestroy');

    Route::get('/menus/{ParentMenuId?}', [MenusController::class,'index'])->name('menus');
    Route::get('/menus/create/{ParentMenuId?}', [MenusController::class,'create'])->name('menusCreate');
    Route::post('/menus/store/{ParentMenuId?}', [MenusController::class,'store'])->name('menusStore');
    Route::get('/menus/{id}/edit/{ParentMenuId?}', [MenusController::class,'edit'])->name('menusEdit');
    Route::post('/menus/{id}/update', [MenusController::class,'update'])->name('menusUpdate');
    Route::get('/menus/destroy/{id}', [MenusController::class,'destroy'])->name('menusDestroy');
    Route::post('/menus/updateAll', [MenusController::class,'updateAll'])->name('menusUpdateAll');





    // CategorieSectionMenus
    Route::post('/Catmenus/store/parent', [CategorieSectionController::class,'storeCatMenu'])->name('parentCatMenusStore');
    Route::get('/Catmenus/parent/{id}/edit', [CategorieSectionController::class,'editCatMenu'])->name('parentCatMenusEdit');
    Route::post('/Catmenus/{id}/update/{ParentMenuId}', [CategorieSectionController::class,'updateCatMenu'])->name('parentCatMenusUpdate');
    Route::get('/Catmenus/parent/destroy/{id}', [CategorieSectionController::class,'destroyCatMenu'])->name('parentCatMenusDestroy');

    Route::get('/Catmenus/{ParentMenuId?}', [CategorieSectionController::class,'index'])->name('Catmenus');
    Route::get('/Catmenus/create/{ParentMenuId?}', [CategorieSectionController::class,'create'])->name('CatmenusCreate');
    Route::post('/Catmenus/store/{ParentMenuId?}', [CategorieSectionController::class,'store'])->name('CatmenusStore');
    Route::get('/Catmenus/{id}/edit/{ParentMenuId?}', [CategorieSectionController::class,'edit'])->name('CatmenusEdit');
    Route::post('/Catmenus/{id}/update', [CategorieSectionController::class,'update'])->name('SubCatmenusUpdate');
    Route::get('/Catmenus/destroy/{id}', [CategorieSectionController::class,'destroy'])->name('CatmenusDestroy');
    Route::post('/Catmenus/updateAll', [CategorieSectionController::class,'updateAll'])->name('CatmenusUpdateAll');





    // faculties
    Route::get('/faculties', [FacultyController::class,'index'])->name('faculties');
    Route::get('/faculties/create', [FacultyController::class,'create'])->name('facultiesCreate');
    Route::post('/faculties/store', [FacultyController::class,'store'])->name('facultiesStore');
    Route::get('/faculties/{id}/edit', [FacultyController::class,'edit'])->name('facultiesEdit');
    Route::post('/faculties/{id}/update', [FacultyController::class,'update'])->name('facultiesUpdate');
    Route::get('/faculties/destroy/{id}', [FacultyController::class,'destroy'])->name('facultiesDestroy');
    Route::post('/faculties/updateAll', [FacultyController::class,'updateAll'])->name('facultiesUpdateAll');
    // faculties :SEO
    Route::post('/faculties/{id}/seo', [FacultyController::class,'seo'])->name('facultiesSEOUpdate');


    // faculties
    Route::get('/contentfaculties', [FacultyController::class,'indexcontentfaculties'])->name('contentfaculties');
    Route::get('/contentfaculties/create', [FacultyController::class,'createcontentfaculties'])->name('contentfacultiesCreate');
    Route::post('/contentfaculties/store', [FacultyController::class,'storecontentfaculties'])->name('contentfacultiesStore');
    Route::get('/contentfaculties/{id}/edit', [FacultyController::class,'editcontentfaculties'])->name('contentfacultiesEdit');
    Route::post('/contentfaculties/{id}/update', [FacultyController::class,'updatecontentfaculties'])->name('contentfacultiesUpdate');
    Route::get('/contentfaculties/destroy/{id}', [FacultyController::class,'destroycontentfaculties'])->name('contentfacultiesDestroy');
    Route::post('/contentfaculties/updateAll', [FacultyController::class,'updateAllcontentfaculties'])->name('contentfacultiesUpdateAll');
    // contentfaculties :SEO
    Route::post('/contentfaculties/{id}/seo', [FacultyController::class,'seocontentfaculties'])->name('contentfacultiesSEOUpdate');

    // departments
    Route::get('/departments', [DepartmentController::class,'index'])->name('departments');
    Route::get('/departments/create', [DepartmentController::class,'create'])->name('departmentsCreate');
    Route::post('/departments/store', [DepartmentController::class,'store'])->name('departmentsStore');
    Route::get('/departments/{id}/edit', [DepartmentController::class,'edit'])->name('departmentsEdit');
    Route::post('/departments/{id}/update', [DepartmentController::class,'update'])->name('departmentsUpdate');
    Route::get('/departments/destroy/{id}', [DepartmentController::class,'destroy'])->name('departmentsDestroy');
    Route::post('/departments/updateAll', [DepartmentController::class,'updateAll'])->name('departmentsUpdateAll');
    // departments :SEO
    Route::post('/departments/{id}/seo', [DepartmentController::class,'seo'])->name('departmentsSEOUpdate');


    // departments
    Route::get('/contentdepartments', [DepartmentController::class,'indexcontentdepartment'])->name('contentdepartments');
    Route::get('/contentdepartments/create', [DepartmentController::class,'createcontentdepartment'])->name('contentdepartmentsCreate');
    Route::post('/contentdepartments/store', [DepartmentController::class,'storecontentdepartment'])->name('contentdepartmentsStore');
    Route::get('/contentdepartments/{id}/edit', [DepartmentController::class,'editcontentdepartment'])->name('contentdepartmentsEdit');
    Route::post('/contentdepartments/{id}/update', [DepartmentController::class,'updatecontentdepartment'])->name('contentdepartmentsUpdate');
    Route::get('/contentdepartments/destroy/{id}', [DepartmentController::class,'destroycontentdepartment'])->name('contentdepartmentsDestroy');
    Route::post('/contentdepartments/updateAll', [DepartmentController::class,'updateAllcontentdepartment'])->name('contentdepartmentsUpdateAll');
    // contentdepartments :SEO
    Route::post('/contentdepartments/{id}/seo', [DepartmentController::class,'seocontentdepartment'])->name('contentdepartmentsSEOUpdate');



    // programs
    Route::get('/programs', [ProgramController::class,'index'])->name('programs');
    Route::get('/programs/create', [ProgramController::class,'create'])->name('programsCreate');
    Route::post('/programs/store', [ProgramController::class,'store'])->name('programsStore');
    Route::get('/programs/{id}/edit', [ProgramController::class,'edit'])->name('programsEdit');
    Route::post('/programs/{id}/update', [ProgramController::class,'update'])->name('programsUpdate');
    Route::get('/programs/destroy/{id}', [ProgramController::class,'destroy'])->name('programsDestroy');
    Route::post('/programs/updateAll', [ProgramController::class,'updateAll'])->name('programsUpdateAll');
    // programs :SEO
    Route::post('/programs/{id}/seo', [ProgramController::class,'seo'])->name('programsSEOUpdate');


    // departments
    Route::get('/contentprograms', [ProgramController::class,'indexcontentprogram'])->name('contentprograms');
    Route::get('/contentprograms/create', [ProgramController::class,'createcontentprogram'])->name('contentprogramsCreate');
    Route::post('/contentprograms/store', [ProgramController::class,'storecontentprogram'])->name('contentprogramsStore');
    Route::get('/contentprograms/{id}/edit', [ProgramController::class,'editcontentprogram'])->name('contentprogramsEdit');
    Route::post('/contentprograms/{id}/update', [ProgramController::class,'updatecontentprogram'])->name('contentprogramsUpdate');
    Route::get('/contentprograms/destroy/{id}', [ProgramController::class,'destroycontentprogram'])->name('contentprogramsDestroy');
    Route::post('/contentprograms/updateAll', [ProgramController::class,'updateAllcontentprogram'])->name('contentprogramsUpdateAll');
    // contentprograms :SEO
    Route::post('/contentprograms/{id}/seo', [ProgramController::class,'seocontentprogram'])->name('contentprogramsSEOUpdate');


    // students
    Route::get('/students', [StudentController::class,'index'])->name('students');
    Route::get('/students/create', [StudentController::class,'create'])->name('studentsCreate');
    Route::post('/students/store', [StudentController::class,'store'])->name('studentsStore');
    Route::get('/students/{id}/edit', [StudentController::class,'edit'])->name('studentsEdit');
    Route::post('/students/{id}/update', [StudentController::class,'update'])->name('studentsUpdate');
    Route::get('/students/destroy/{id}', [StudentController::class,'destroy'])->name('studentsDestroy');
    Route::post('/students/updateAll', [StudentController::class,'updateAll'])->name('studentsUpdateAll');






    // universitycenters
    Route::get('/universitycenters', [UniversityCenterController::class,'index'])->name('universitycenters');
    Route::get('/universitycenters/create', [UniversityCenterController::class,'create'])->name('universitycentersCreate');
    Route::post('/universitycenters/store', [UniversityCenterController::class,'store'])->name('universitycentersStore');
    Route::get('/universitycenters/{id}/edit', [UniversityCenterController::class,'edit'])->name('universitycentersEdit');
    Route::post('/universitycenters/{id}/update', [UniversityCenterController::class,'update'])->name('universitycentersUpdate');
    Route::get('/universitycenters/destroy/{id}', [UniversityCenterController::class,'destroy'])->name('universitycentersDestroy');
    Route::post('/universitycenters/updateAll', [UniversityCenterController::class,'updateAll'])->name('universitycentersUpdateAll');
    // universitycenters :SEO
    Route::post('/universitycenters/{id}/seo', [UniversityCenterController::class,'seo'])->name('universitycentersSEOUpdate');



    // contentuniversitycenters
    Route::get('/contentscenters', [UniversityCenterController::class,'indexcontentscenters'])->name('contentscenters');
    Route::get('/contentscenters/create', [UniversityCenterController::class,'createcontentscenters'])->name('contentscentersCreate');
    Route::post('/contentscenters/store', [UniversityCenterController::class,'storecontentscenters'])->name('contentscentersStore');
    Route::get('/contentscenters/{id}/edit', [UniversityCenterController::class,'editcontentscenters'])->name('contentscentersEdit');
    Route::post('/contentscenters/{id}/update', [UniversityCenterController::class,'updatecontentscenters'])->name('contentscentersUpdate');
    Route::get('/contentscenters/destroy/{id}', [UniversityCenterController::class,'destroycontentscenters'])->name('contentscentersDestroy');
    Route::post('/contentscenters/updateAll', [UniversityCenterController::class,'updateAllcontentscenters'])->name('contentscentersUpdateAll');
    // contentscenters :SEO
    Route::post('/contentscenters/{id}/seo', [UniversityCenterController::class,'seocontentscenters'])->name('contentscentersSEOUpdate');






    // Topics
    Route::get('/staff/{section_id}', [StaffController::class,'index'])->name('staff');
    Route::get('/staff/{section_id}/create', [StaffController::class,'create'])->name('staffCreate');
    Route::post('/staff/{section_id}/store', [StaffController::class,'store'])->name('staffStore');
    Route::get('/staff/{section_id}/cat/{id}/edit', [StaffController::class,'edit'])->name('staffEdit');
    Route::post('/staff/{section_id}/cat/{id}/update', [StaffController::class,'update'])->name('staffUpdate');
    Route::get('/staff/{section_id}/cat/destroy/{id}', [StaffController::class,'destroy'])->name('staffDestroy');
    Route::post('/staff/{section_id}/cat/updateAll', [StaffController::class,'updateAll'])->name('staffUpdateAll');



    // programs
    Route::get('/sliderfaculties', [SliderFacultyController::class,'index'])->name('sliderfaculties');
    Route::get('/sliderfaculties/create', [SliderFacultyController::class,'create'])->name('sliderfacultiesCreate');
    Route::post('/sliderfaculties/store', [SliderFacultyController::class,'store'])->name('sliderfacultiesStore');
    Route::get('/sliderfaculties/{id}/edit', [SliderFacultyController::class,'edit'])->name('sliderfacultiesEdit');
    Route::post('/sliderfaculties/{id}/update', [SliderFacultyController::class,'update'])->name('sliderfacultiesUpdate');
    Route::get('/sliderfaculties/destroy/{id}', [SliderFacultyController::class,'destroy'])->name('sliderfacultiesDestroy');
    Route::post('/sliderfaculties/updateAll', [SliderFacultyController::class,'updateAll'])->name('sliderfacultiesUpdateAll');
});



// Frontend Routes
// ../site map
Route::group(['middleware' => ['XSS']], function () {

    Route::get('/', [FrontendHomeController::class,'HomePage'])->name('Home');
    // // ../home url
    Route::get('/home', [FrontendHomeController::class,'HomePage'])->name('HomePage');
    Route::get('/{lang?}/home', [FrontendHomeController::class,'HomePageByLang'])->name('HomePageByLang');



    Route::get('about/{id}',[FrontendHomeController::class,'AboutUs']);
    Route::get('/{lang?}/about/{id}',[FrontendHomeController::class,'AboutUsByLang'] );


    Route::get('university/{name}',[FrontendHomeController::class,'getPageBySection'] )->name('getPageBySection');
    Route::get('/{lang?}/university/{name}',[FrontendHomeController::class,'getPageBySectionbyLang'])->name('getPageBySectionbyLang');



    Route::get('/{lang?}/showdetails/{id}',[FrontendHomeController::class,'GetDetilaInfoTopicBylang']);
    Route::get('/showdetails/{id}',[FrontendHomeController::class,'GetDetilaInfoTopic']);


    Route::get('/admission/{id}',[FrontendHomeController::class,'GetAdmitionStudeis']);
    Route::get('/{lang?}/admission/{id}',[FrontendHomeController::class,'GetAdmitionStudeisbyLang']);
    Route::get('/admission/{page}/{id}',[FrontendHomeController::class,'GetAdmitionStudeiswithid']);
    Route::get('/{lang?}/admission/{page}/{id}',[FrontendHomeController::class,'GetAdmitionStudeiswithidbylang']);

    Route::get('university/academicstaff/{id}',[FrontendHomeController::class,'getacademicstaffBySection'])->name('getacademicstaffBySection');
    Route::get('/{lang?}/university/academicstaff/{id}', [FrontendHomeController::class,'getacademicstaffBySection'])->name('getacademicstaffBySectionByLang');



    Route::get('university/boardtrustees/{id}', [FrontendHomeController::class,'getacademicstaffBySection'])->name('getacademicstaffBySection');
    Route::get('/{lang?}/university/boardtrustees/{id}', [FrontendHomeController::class,'getacademicstaffBySectionByLang'])->name('getacademicstaffBySectionByLang');


    Route::get('university/boardtrustees/previous/{id}', [FrontendHomeController::class,'getacademicstaffPreviousBySection'])->name('getacademicstaffPreviousBySection');
    Route::get('/{lang?}/university/boardtrustees/previous/{id}', [FrontendHomeController::class,'getacademicstaffPreviousBySectionByLang'])->name('getacademicstaffPreviousBySectionByLang');



    Route::get('university/employees/{id}', [FrontendHomeController::class,'getacademicstaffBySection'])->name('getacademicstaffBySection');
    Route::get('/{lang?}/university/employees/{id}', [FrontendHomeController::class,'getacademicstaffBySectionByLang'])->name('getacademicstaffBySectionByLang');


    Route::get('university/iutt/profile/{id}', [FrontendHomeController::class,'GetAcademicstaffDetail']);
    Route::get('/{lang?}/university/iutt/profile/{id}', [FrontendHomeController::class,'GetAcademicstaffDetailByLang']);


    Route::get('/university/lecturertable/{id}', [FrontendHomeController::class,'Getuniversitycenter']);
    Route::get('/{lang?}/university/lecturertable/{id}', [FrontendHomeController::class,'GetuniversitycenterByLang']);
    Route::get('/center/{id}/home', [FrontendHomeController::class,'Getuniversitycenter']);
    Route::get('/{lang?}/center/{id}/home', [FrontendHomeController::class,'GetuniversitycenterByLang']);

    Route::get('/university/center/{id}', [FrontendHomeController::class,'Getuniversitycenter']);
    Route::get('/{lang?}/university/center/{id}', [FrontendHomeController::class,'GetuniversitycenterByLang']);

    Route::get('programs/{id}', [FrontendHomeController::class,'GetPrograms']);
    Route::get('/{lang?}/programs/{id}', [FrontendHomeController::class,'GetProgramsByLang']);

    Route::get('university/photos/details/{id}', [FrontendHomeController::class,'GetphotosDetail']);
    Route::get('/{lang?}/university/photos/details/{id}', [FrontendHomeController::class,'GetphotosDetailByLang']);

    Route::get('/view/{PageName}', [FrontendHomeController::class,'ViewCustomPage']);
    Route::get('/{lang?}/view/{PageName}', [FrontendHomeController::class,'ViewCustomPageByLang']);
    // ..Topics url  ( ex: www.site.com/news/topic/32 )
    Route::get('/news/topic/{id}', [FrontendHomeController::class,'topic'])->name('FrontendTopic');
    Route::get('/{lang?}/news/topic/{id}', [FrontendHomeController::class,'topicByLang'])->name('FrontendTopicByLang');

    // ..Sub category url for Section  ( ex: www.site.com/products/2 )
    Route::get('/news/{cat}', [FrontendHomeController::class,'topics'])->name('FrontendTopicsByCat');
    Route::get('/{lang?}/news/{cat}', [FrontendHomeController::class,'topicsByLang'])->name('FrontendTopicsByCatWithLang');


    Route::get('/news', [FrontendHomeController::class,'topics'])->name('FrontendTopics');
    Route::get('/{lang?}/news', [FrontendHomeController::class,'topicsByLang'])->name('FrontendTopicsByLang');




    Route::get('/sitemap.xml',[SiteMapController::class,'siteMap'])->name('siteMap');
    Route::get('/{lang}/sitemap',[SiteMapController::class,'siteMap'])->name('siteMapByLang');


    // ../subscribe to newsletter submit  (ajax url)
    Route::post('/subscribe', [FrontendHomeController::class,'subscribeSubmit'])->name('subscribeSubmit');
    // ../Comment submit  (ajax url)
    Route::post('/comment', [FrontendHomeController::class,'commentSubmit'])->name('commentSubmit');
    // ../Order submit  (ajax url)
    Route::post('/order', [FrontendHomeController::class,'orderSubmit'])->name('orderSubmit');
    // ..Custom URL for contact us page ( www.site.com/contact )
    Route::get('/contact', [FrontendHomeController::class,'ContactPage'])->name('contactPage');
    Route::get('/{lang?}/contact', [FrontendHomeController::class,'ContactPageByLang'])->name('contactPageByLang');
    // ../contact message submit  (ajax url)
    Route::post('/contact/submit', [FrontendHomeController::class,'ContactPageSubmit'])->name('contactPageSubmit');

    // ..if page by user id ( ex: www.site.com/user )
    Route::get('/user/{id}', [FrontendHomeController::class,'userTopics'])->name('FrontendUserTopics');
    Route::get('/{lang?}/user/{id}', [FrontendHomeController::class,'userTopicsByLang'])->name('FrontendUserTopicsByLang');
    // ../search
    Route::post('/search', [FrontendHomeController::class,'searchTopics'])->name('searchTopics');



    // ..SEO url  ( ex: www.site.com/title-here )
    Route::get('/{seo_url_slug}', [FrontendHomeController::class,'SEO'])->name('FrontendSEO');
    Route::get('/{lang?}/{seo_url_slug}', [FrontendHomeController::class,'SEOByLang'])->name('FrontendSEOByLang');


    //=================
    Route::post('/contact/center/{id}/submit',[UniversityCenterController::class,'CenterPageSubmit'] )->name('CenterPageSubmit');



    //======================================================


    Route::get('/faculties/{faclutyname}/home',[FacultiesHomeController::class,'HomePageFaculty'])->name('FacultyPage');
    Route::get('/{lang?}/faculties/{faclutyname}/home', [FacultiesHomeController::class,'HomePageFacultyByLang'])->name('FacultyPagePageBylang');
    Route::get('/faculty/about/{id}', [FacultiesHomeController::class,'facultyAboutUs']);
    Route::get('/{lang?}/faculty/about/{id}', [FacultiesHomeController::class,'facultyAboutUsByLang']);

    Route::get('{faculty}/deanship', [FacultiesHomeController::class,'facultydeanship']);
    Route::get('/{lang?}/{faculty}/deanship', [FacultiesHomeController::class,'facultydeanshipByLang']);

    Route::get('/faculty/profile/staff/{id}', [FacultiesHomeController::class,'GetstafffacultyDetail']);
    Route::get('/{lang?}/faculty/profile/staff/{id}', [FacultiesHomeController::class,'GetstafffacultyDetailByLang']);

    Route::get('/faculty/programs/{id}', [FacultiesHomeController::class,'GetPrograms']);
    Route::get('/{lang?}/faculty/programs/{id}', [FacultiesHomeController::class,'GetProgramsByLang']);



    Route::get('{faculty}/departments/{id}', [FacultiesHomeController::class,'GetDepartments']);
    Route::get('/{lang?}/{faculty}/departments/{id}', [FacultiesHomeController::class,'GetDepartmentsByLang']);

    //============
    Route::get('/{faculty}/news/faculty/{id}', [FacultiesNewsController::class,'topicfaculty'])->name('FrontendTopicfaculty');
    Route::get('/{lang?}/{faculty}/news/faculty/{id}', [FacultiesNewsController::class,'topicfacultyByLang'])->name('FrontendTopicfacultyByLang');

    Route::get('/{faculty}/news/faculty/{cat}', [FacultiesNewsController::class,'topicsfaculty'])->name('FrontendTopicsfacultyByCat');
    Route::get('/{lang?}/{faculty}/news/faculty/cat/{cat}', [FacultiesNewsController::class,'topicsfacultyByLang'])->name('FrontendTopicsfacultyByCatWithLang');

    Route::get('/{faculty}/news/faculty', [FacultiesNewsController::class,'topicsfaculty'])->name('FrontendTopicsfaculty');
    Route::get('/{lang?}/{faculty}/news/faculty', [FacultiesNewsController::class,'topicsfacultyByLang'])->name('FrontendTopicsfacultyByLang');
    Route::post('/{faculty}/search/faculty', [FacultiesNewsController::class,'searchTopicsfaculty'])->name('searchTopicsFaculty');

    //==================
    Route::get('{faculty}/events', [FacultiesHomeController::class,'facultyevents']);
    Route::get('/{lang?}/{faculty}/events', [FacultiesHomeController::class,'facultyeventsByLang']);

    Route::get('{faculty}/announcements', [FacultiesHomeController::class,'facultyannouncements']);
    Route::get('/{lang?}/{faculty}/announcements', [FacultiesHomeController::class,'facultyannouncementsByLang']);

    Route::get('{faculty}/ourGallery', [FacultiesHomeController::class,'facultyourGallery']);
    Route::get('/{lang?}/{faculty}/ourGallery', [FacultiesHomeController::class,'facultyourGalleryByLang']);
    Route::get('{faculty}/ourGallery/details/{id}', [FacultiesHomeController::class,'facultyourGalleryDetail']);
    Route::get('/{lang?}/{faculty}/ourGallery/details/{id}', [FacultiesHomeController::class,'facultyourGalleryDetailByLang']);

    Route::get('{faculty}/lecturertable', [FacultiesHomeController::class,'facultylecturerstable']);
    Route::get('/{lang?}/{faculty}/lecturertable', [FacultiesHomeController::class,'facultylecturerstableByLang']);




    Route::get('{faculty}/faculty/about/', [FacultiesHomeController::class,'facultyAboutUsPage']);
    Route::get('/{lang?}/{faculty}/faculty/about/', [FacultiesHomeController::class,'facultyAboutUsPageByLang']);

    //=============
});
