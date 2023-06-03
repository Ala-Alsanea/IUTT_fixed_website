<?php

// if (App::environment('production')) {
//     URL::forceScheme('https');
// }
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
    'uses' => 'LanguageController@index',
))->name('lang');
// For Language direct URL link
Route::get('/lang/{lang}', array(
    'Middleware' => 'LanguageSwitcher',
    'uses' => 'LanguageController@change',
))->name('langChange');
// .. End of Language Route

// Backend Routes
Auth::routes();

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
    Route::get('', 'HomeController@index')->name('adminHome');
    //Search
    Route::get('/search', 'HomeController@search')->name('adminSearch');
    Route::post('/find', 'HomeController@find')->name('adminFind');
    // FileManager
    Route::get('/media', 'HomeController@FileManager')->name('media');

    // Webmaster
    Route::get('/webmaster', 'WebmasterSettingsController@edit')->name('webmasterSettings');
    Route::post('/webmaster', 'WebmasterSettingsController@update')->name('webmasterSettingsUpdate');

    // Webmaster Banners
    Route::get('/webmaster/banners', 'WebmasterBannersController@index')->name('WebmasterBanners');
    Route::get('/webmaster/banners/create', 'WebmasterBannersController@create')->name('WebmasterBannersCreate');
    Route::post('/webmaster/banners/store', 'WebmasterBannersController@store')->name('WebmasterBannersStore');
    Route::get('/webmaster/banners/{id}/edit', 'WebmasterBannersController@edit')->name('WebmasterBannersEdit');
    Route::post('/webmaster/banners/{id}/update', 'WebmasterBannersController@update')->name('WebmasterBannersUpdate');
    Route::get(
        '/webmaster/banners/destroy/{id}',
        'WebmasterBannersController@destroy'
    )->name('WebmasterBannersDestroy');
    Route::post(
        '/webmaster/banners/updateAll',
        'WebmasterBannersController@updateAll'
    )->name('WebmasterBannersUpdateAll');

    // Webmaster Sections
    Route::get('/webmaster/sections', 'WebmasterSectionsController@index')->name('WebmasterSections');
    Route::get('/webmaster/sections/create', 'WebmasterSectionsController@create')->name('WebmasterSectionsCreate');
    Route::post('/webmaster/sections/store', 'WebmasterSectionsController@store')->name('WebmasterSectionsStore');
    Route::get('/webmaster/sections/{id}/edit', 'WebmasterSectionsController@edit')->name('WebmasterSectionsEdit');
    Route::post(
        '/webmaster/sections/{id}/update',
        'WebmasterSectionsController@update'
    )->name('WebmasterSectionsUpdate');

    Route::post('/webmaster/sections/{id}/seo', 'WebmasterSectionsController@seo')->name('WebmasterSectionsSEOUpdate');

    Route::get(
        '/webmaster/sections/destroy/{id}',
        'WebmasterSectionsController@destroy'
    )->name('WebmasterSectionsDestroy');
    Route::post(
        '/webmaster/sections/updateAll',
        'WebmasterSectionsController@updateAll'
    )->name('WebmasterSectionsUpdateAll');

    // Webmaster Sections :Custom Fields
    Route::get('/webmaster/{webmasterId}/fields', 'WebmasterSectionsController@webmasterFields')->name('webmasterFields');
    Route::get('/{webmasterId}/fields/create', 'WebmasterSectionsController@fieldsCreate')->name('webmasterFieldsCreate');
    Route::post('/webmaster/{webmasterId}/fields/store', 'WebmasterSectionsController@fieldsStore')->name('webmasterFieldsStore');
    Route::get('/webmaster/{webmasterId}/fields/{field_id}/edit', 'WebmasterSectionsController@fieldsEdit')->name('webmasterFieldsEdit');
    Route::post('/webmaster/{webmasterId}/fields/{field_id}/update', 'WebmasterSectionsController@fieldsUpdate')->name('webmasterFieldsUpdate');
    Route::get('/webmaster/{webmasterId}/fields/destroy/{field_id}', 'WebmasterSectionsController@fieldsDestroy')->name('webmasterFieldsDestroy');
    Route::post('/webmaster/{webmasterId}/fields/updateAll', 'WebmasterSectionsController@fieldsUpdateAll')->name('webmasterFieldsUpdateAll');

    // Settings
    Route::get('/settings', 'SettingsController@edit')->name('settings');

    Route::post('/settings', 'SettingsController@updateSiteInfo')->name('settingsUpdateSiteInfo');
    Route::post('/optimizedevel', 'SettingsController@optimizedevel');
    Route::post('/settings/style', 'SettingsController@updateSiteStyle')->name('settingsUpdateSiteStyle');
    Route::post('/settings/status', 'SettingsController@updateSiteStatus')->name('settingsUpdateSiteStatus');
    Route::post('/settings/social', 'SettingsController@updateSocialLinks')->name('settingsUpdateSocialLinks');
    Route::post('/settings/contacts', 'SettingsController@updateContacts')->name('settingsUpdateContacts');

    // Ad. Banners
    Route::get('/banners', 'BannersController@index')->name('Banners');
    Route::get('/banners/create/{sectionId}', 'BannersController@create')->name('BannersCreate');
    Route::post('/banners/store', 'BannersController@store')->name('BannersStore');
    Route::get('/banners/{id}/edit', 'BannersController@edit')->name('BannersEdit');
    Route::post('/banners/{id}/update', 'BannersController@update')->name('BannersUpdate');
    Route::get('/banners/destroy/{id}', 'BannersController@destroy')->name('BannersDestroy');
    Route::post('/banners/updateAll', 'BannersController@updateAll')->name('BannersUpdateAll');

    // Sections
    Route::get('/{webmasterId}/sections', 'SectionsController@index')->name('sections');
    Route::get('/{webmasterId}/sections/create', 'SectionsController@create')->name('sectionsCreate');
    Route::post('/{webmasterId}/sections/store', 'SectionsController@store')->name('sectionsStore');
    Route::get('/{webmasterId}/sections/{id}/edit', 'SectionsController@edit')->name('sectionsEdit');
    Route::post('/{webmasterId}/sections/{id}/update', 'SectionsController@update')->name('sectionsUpdate');
    Route::post('/{webmasterId}/sections/{id}/seo', 'SectionsController@seo')->name('sectionsSEOUpdate');
    Route::get('/{webmasterId}/sections/destroy/{id}', 'SectionsController@destroy')->name('sectionsDestroy');
    Route::post('/{webmasterId}/sections/updateAll', 'SectionsController@updateAll')->name('sectionsUpdateAll');

    // Topics
    Route::get('/{webmasterId}/topics', 'TopicsController@index')->name('topics');
    Route::get('/{webmasterId}/topics/create', 'TopicsController@create')->name('topicsCreate');
    Route::post('/{webmasterId}/topics/store', 'TopicsController@store')->name('topicsStore');
    Route::get('/{webmasterId}/topics/{id}/edit', 'TopicsController@edit')->name('topicsEdit');
    Route::post('/{webmasterId}/topics/{id}/update', 'TopicsController@update')->name('topicsUpdate');
    Route::get('/{webmasterId}/topics/destroy/{id}', 'TopicsController@destroy')->name('topicsDestroy');
    Route::post('/{webmasterId}/topics/updateAll', 'TopicsController@updateAll')->name('topicsUpdateAll');
    // Topics :SEO
    Route::post('/{webmasterId}/topics/{id}/seo', 'TopicsController@seo')->name('topicsSEOUpdate');



    // Topics :Photos


    Route::post('/{webmasterId}/topics/{id}/photos', 'TopicsController@photos')->name('topicsPhotosEdit');
    Route::get(
        '/{webmasterId}/topics/{id}/photos/{photo_id}/destroy',
        'TopicsController@photosDestroy'
    )->name('topicsPhotosDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/photos/updateAll',
        'TopicsController@photosUpdateAll'
    )->name('topicsPhotosUpdateAll');

    Route::post('/{webmasterId}/topics/{id}/mangerphotos', 'TopicsController@FileManagerPhotos')->name('FileManagertopicsPhotos');

    // Topics :Files
    Route::get('/{webmasterId}/topics/{id}/files', 'TopicsController@topicsFiles')->name('topicsFiles');
    Route::get(
        '/{webmasterId}/topics/{id}/files/create',
        'TopicsController@filesCreate'
    )->name('topicsFilesCreate');
    Route::post(
        '/{webmasterId}/topics/{id}/files/store',
        'TopicsController@filesStore'
    )->name('topicsFilesStore');
    Route::get(
        '/{webmasterId}/topics/{id}/files/{file_id}/edit',
        'TopicsController@filesEdit'
    )->name('topicsFilesEdit');
    Route::post(
        '/{webmasterId}/topics/{id}/files/{file_id}/update',
        'TopicsController@filesUpdate'
    )->name('topicsFilesUpdate');
    Route::get(
        '/{webmasterId}/topics/{id}/files/destroy/{file_id}',
        'TopicsController@filesDestroy'
    )->name('topicsFilesDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/files/updateAll',
        'TopicsController@filesUpdateAll'
    )->name('topicsFilesUpdateAll');


    // Topics :Related
    Route::get('/{webmasterId}/topics/{id}/related', 'TopicsController@topicsRelated')->name('topicsRelated');
    Route::get('/relatedLoad/{id}', 'TopicsController@topicsRelatedLoad')->name('topicsRelatedLoad');
    Route::get(
        '/{webmasterId}/topics/{id}/related/create',
        'TopicsController@relatedCreate'
    )->name('topicsRelatedCreate');
    Route::post(
        '/{webmasterId}/topics/{id}/related/store',
        'TopicsController@relatedStore'
    )->name('topicsRelatedStore');
    Route::get(
        '/{webmasterId}/topics/{id}/related/destroy/{related_id}',
        'TopicsController@relatedDestroy'
    )->name('topicsRelatedDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/related/updateAll',
        'TopicsController@relatedUpdateAll'
    )->name('topicsRelatedUpdateAll');
    // Topics :Comments
    Route::get('/{webmasterId}/topics/{id}/comments', 'TopicsController@topicsComments')->name('topicsComments');
    Route::get(
        '/{webmasterId}/topics/{id}/comments/create',
        'TopicsController@commentsCreate'
    )->name('topicsCommentsCreate');
    Route::post(
        '/{webmasterId}/topics/{id}/comments/store',
        'TopicsController@commentsStore'
    )->name('topicsCommentsStore');
    Route::get(
        '/{webmasterId}/topics/{id}/comments/{comment_id}/edit',
        'TopicsController@commentsEdit'
    )->name('topicsCommentsEdit');
    Route::post(
        '/{webmasterId}/topics/{id}/comments/{comment_id}/update',
        'TopicsController@commentsUpdate'
    )->name('topicsCommentsUpdate');
    Route::get(
        '/{webmasterId}/topics/{id}/comments/destroy/{comment_id}',
        'TopicsController@commentsDestroy'
    )->name('topicsCommentsDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/comments/updateAll',
        'TopicsController@commentsUpdateAll'
    )->name('topicsCommentsUpdateAll');
    // Topics :Maps
    Route::get('/{webmasterId}/topics/{id}/maps', 'TopicsController@topicsMaps')->name('topicsMaps');
    Route::get('/{webmasterId}/topics/{id}/maps/create', 'TopicsController@mapsCreate')->name('topicsMapsCreate');
    Route::post('/{webmasterId}/topics/{id}/maps/store', 'TopicsController@mapsStore')->name('topicsMapsStore');
    Route::get('/{webmasterId}/topics/{id}/maps/{map_id}/edit', 'TopicsController@mapsEdit')->name('topicsMapsEdit');
    Route::post(
        '/{webmasterId}/topics/{id}/maps/{map_id}/update',
        'TopicsController@mapsUpdate'
    )->name('topicsMapsUpdate');
    Route::get(
        '/{webmasterId}/topics/{id}/maps/destroy/{map_id}',
        'TopicsController@mapsDestroy'
    )->name('topicsMapsDestroy');
    Route::post(
        '/{webmasterId}/topics/{id}/maps/updateAll',
        'TopicsController@mapsUpdateAll'
    )->name('topicsMapsUpdateAll');

    // Contacts Groups
    Route::post('/contacts/storeGroup', 'ContactsController@storeGroup')->name('contactsStoreGroup');
    Route::get('/contacts/{id}/editGroup', 'ContactsController@editGroup')->name('contactsEditGroup');
    Route::post('/contacts/{id}/updateGroup', 'ContactsController@updateGroup')->name('contactsUpdateGroup');
    Route::get('/contacts/destroyGroup/{id}', 'ContactsController@destroyGroup')->name('contactsDestroyGroup');
    // Contacts
    Route::get('/contacts/{group_id?}', 'ContactsController@index')->name('contacts');
    Route::post('/contacts/store', 'ContactsController@store')->name('contactsStore');
    Route::post('/contacts/search', 'ContactsController@search')->name('contactsSearch');
    Route::get('/contacts/{id}/edit', 'ContactsController@edit')->name('contactsEdit');
    Route::post('/contacts/{id}/update', 'ContactsController@update')->name('contactsUpdate');
    Route::get('/contacts/destroy/{id}', 'ContactsController@destroy')->name('contactsDestroy');
    Route::post('/contacts/updateAll', 'ContactsController@updateAll')->name('contactsUpdateAll');

    // WebMails Groups
    Route::post('/webmails/storeGroup', 'WebmailsController@storeGroup')->name('webmailsStoreGroup');
    Route::get('/webmails/{id}/editGroup', 'WebmailsController@editGroup')->name('webmailsEditGroup');
    Route::post('/webmails/{id}/updateGroup', 'WebmailsController@updateGroup')->name('webmailsUpdateGroup');
    Route::get('/webmails/destroyGroup/{id}', 'WebmailsController@destroyGroup')->name('webmailsDestroyGroup');
    // WebMails
    Route::post('/webmails/store', 'WebmailsController@store')->name('webmailsStore');
    Route::post('/webmails/search', 'WebmailsController@search')->name('webmailsSearch');
    Route::get('/webmails/{id}/edit', 'WebmailsController@edit')->name('webmailsEdit');
    Route::get('/webmails/{group_id?}/{wid?}/{stat?}/{contact_email?}', 'WebmailsController@index')->name('webmails');
    Route::post('/webmails/{id}/update', 'WebmailsController@update')->name('webmailsUpdate');
    Route::get('/webmails/destroy/{id}', 'WebmailsController@destroy')->name('webmailsDestroy');
    Route::post('/webmails/updateAll', 'WebmailsController@updateAll')->name('webmailsUpdateAll');

    // Calendar
    Route::get('/calendar', 'EventsController@index')->name('calendar');
    Route::get('/calendar/create', 'EventsController@create')->name('calendarCreate');
    Route::post('/calendar/store', 'EventsController@store')->name('calendarStore');
    Route::get('/calendar/{id}/edit', 'EventsController@edit')->name('calendarEdit');
    Route::post('/calendar/{id}/update', 'EventsController@update')->name('calendarUpdate');
    Route::get('/calendar/destroy/{id}', 'EventsController@destroy')->name('calendarDestroy');
    Route::get('/calendar/updateAll', 'EventsController@updateAll')->name('calendarUpdateAll');
    Route::post('/calendar/{id}/extend', 'EventsController@extend')->name('calendarExtend');

    // Analytics
    Route::get('/ip/{ip_code?}', 'AnalyticsController@ip')->name('visitorsIP');
    Route::post('/ip/search', 'AnalyticsController@search')->name('visitorsSearch');
    Route::post('/analytics/{stat}', 'AnalyticsController@filter')->name('analyticsFilter');
    Route::get('/analytics/{stat?}', 'AnalyticsController@index')->name('analytics');
    Route::get('/visitors', 'AnalyticsController@visitors')->name('visitors');

    // Users & Permissions
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create/', 'UsersController@create')->name('usersCreate');
    Route::post('/users/store', 'UsersController@store')->name('usersStore');
    Route::get('/users/{id}/edit', 'UsersController@edit')->name('usersEdit');
    Route::post('/users/{id}/update', 'UsersController@update')->name('usersUpdate');
    Route::get('/users/destroy/{id}', 'UsersController@destroy')->name('usersDestroy');
    Route::post('/users/updateAll', 'UsersController@updateAll')->name('usersUpdateAll');

    Route::get('/users/permissions/create/', 'UsersController@permissions_create')->name('permissionsCreate');
    Route::post('/users/permissions/store', 'UsersController@permissions_store')->name('permissionsStore');
    Route::get('/users/permissions/{id}/edit', 'UsersController@permissions_edit')->name('permissionsEdit');
    Route::post('/users/permissions/{id}/update', 'UsersController@permissions_update')->name('permissionsUpdate');
    Route::get('/users/permissions/destroy/{id}', 'UsersController@permissions_destroy')->name('permissionsDestroy');
    //Route::get('/Privilege', 'PermissionsPageController@Privilege')->name('Privilege');

    //Permissions

    Route::get('/Permissions', 'PermissionsPageController@index')->name('Permissions');
    Route::get('/Permissions/create/', 'PermissionsPageController@create')->name('Create');
    Route::post('/Permissions/store', 'PermissionsPageController@store')->name('Store');
    Route::get('/Permissions/{id}/edit', 'PermissionsPageController@edit')->name('Edit');
    Route::post('/Permissions/{id}/update', 'PermissionsPageController@update')->name('Update');
    Route::get('/Permissions/destroy/{id}', 'PermissionsPageController@destroy')->name('Destroy');
    Route::post('/Permissions/updateAll', 'PermissionsPageController@updateAll')->name('PrimationUpdateAll');

    // Menus
    Route::post('/menus/store/parent', 'MenusController@storeMenu')->name('parentMenusStore');
    Route::get('/menus/parent/{id}/edit', 'MenusController@editMenu')->name('parentMenusEdit');
    Route::post('/menus/{id}/update/{ParentMenuId}', 'MenusController@updateMenu')->name('parentMenusUpdate');
    Route::get('/menus/parent/destroy/{id}', 'MenusController@destroyMenu')->name('parentMenusDestroy');

    Route::get('/menus/{ParentMenuId?}', 'MenusController@index')->name('menus');
    Route::get('/menus/create/{ParentMenuId?}', 'MenusController@create')->name('menusCreate');
    Route::post('/menus/store/{ParentMenuId?}', 'MenusController@store')->name('menusStore');
    Route::get('/menus/{id}/edit/{ParentMenuId?}', 'MenusController@edit')->name('menusEdit');
    Route::post('/menus/{id}/update', 'MenusController@update')->name('menusUpdate');
    Route::get('/menus/destroy/{id}', 'MenusController@destroy')->name('menusDestroy');
    Route::post('/menus/updateAll', 'MenusController@updateAll')->name('menusUpdateAll');





    // CategorieSectionMenus
    Route::post('/Catmenus/store/parent', 'CategorieSectionController@storeCatMenu')->name('parentCatMenusStore');
    Route::get('/Catmenus/parent/{id}/edit', 'CategorieSectionController@editCatMenu')->name('parentCatMenusEdit');
    Route::post('/Catmenus/{id}/update/{ParentMenuId}', 'CategorieSectionController@updateCatMenu')->name('parentCatMenusUpdate');
    Route::get('/Catmenus/parent/destroy/{id}', 'CategorieSectionController@destroyCatMenu')->name('parentCatMenusDestroy');

    Route::get('/Catmenus/{ParentMenuId?}', 'CategorieSectionController@index')->name('Catmenus');
    Route::get('/Catmenus/create/{ParentMenuId?}', 'CategorieSectionController@create')->name('CatmenusCreate');
    Route::post('/Catmenus/store/{ParentMenuId?}', 'CategorieSectionController@store')->name('CatmenusStore');
    Route::get('/Catmenus/{id}/edit/{ParentMenuId?}', 'CategorieSectionController@edit')->name('CatmenusEdit');
    Route::post('/Catmenus/{id}/update', 'CategorieSectionController@update')->name('SubCatmenusUpdate');
    Route::get('/Catmenus/destroy/{id}', 'CategorieSectionController@destroy')->name('CatmenusDestroy');
    Route::post('/Catmenus/updateAll', 'CategorieSectionController@updateAll')->name('CatmenusUpdateAll');





    // faculties
    Route::get('/faculties', 'FacultyController@index')->name('faculties');
    Route::get('/faculties/create', 'FacultyController@create')->name('facultiesCreate');
    Route::post('/faculties/store', 'FacultyController@store')->name('facultiesStore');
    Route::get('/faculties/{id}/edit', 'FacultyController@edit')->name('facultiesEdit');
    Route::post('/faculties/{id}/update', 'FacultyController@update')->name('facultiesUpdate');
    Route::get('/faculties/destroy/{id}', 'FacultyController@destroy')->name('facultiesDestroy');
    Route::post('/faculties/updateAll', 'FacultyController@updateAll')->name('facultiesUpdateAll');
    // faculties :SEO
    Route::post('/faculties/{id}/seo', 'FacultyController@seo')->name('facultiesSEOUpdate');


    // faculties
    Route::get('/contentfaculties', 'FacultyController@indexcontentfaculties')->name('contentfaculties');
    Route::get('/contentfaculties/create', 'FacultyController@createcontentfaculties')->name('contentfacultiesCreate');
    Route::post('/contentfaculties/store', 'FacultyController@storecontentfaculties')->name('contentfacultiesStore');
    Route::get('/contentfaculties/{id}/edit', 'FacultyController@editcontentfaculties')->name('contentfacultiesEdit');
    Route::post('/contentfaculties/{id}/update', 'FacultyController@updatecontentfaculties')->name('contentfacultiesUpdate');
    Route::get('/contentfaculties/destroy/{id}', 'FacultyController@destroycontentfaculties')->name('contentfacultiesDestroy');
    Route::post('/contentfaculties/updateAll', 'FacultyController@updateAllcontentfaculties')->name('contentfacultiesUpdateAll');
    // contentfaculties :SEO
    Route::post('/contentfaculties/{id}/seo', 'FacultyController@seocontentfaculties')->name('contentfacultiesSEOUpdate');

    // departments
    Route::get('/departments', 'DepartmentController@index')->name('departments');
    Route::get('/departments/create', 'DepartmentController@create')->name('departmentsCreate');
    Route::post('/departments/store', 'DepartmentController@store')->name('departmentsStore');
    Route::get('/departments/{id}/edit', 'DepartmentController@edit')->name('departmentsEdit');
    Route::post('/departments/{id}/update', 'DepartmentController@update')->name('departmentsUpdate');
    Route::get('/departments/destroy/{id}', 'DepartmentController@destroy')->name('departmentsDestroy');
    Route::post('/departments/updateAll', 'DepartmentController@updateAll')->name('departmentsUpdateAll');
    // departments :SEO
    Route::post('/departments/{id}/seo', 'DepartmentController@seo')->name('departmentsSEOUpdate');


    // departments
    Route::get('/contentdepartments', 'DepartmentController@indexcontentdepartment')->name('contentdepartments');
    Route::get('/contentdepartments/create', 'DepartmentController@createcontentdepartment')->name('contentdepartmentsCreate');
    Route::post('/contentdepartments/store', 'DepartmentController@storecontentdepartment')->name('contentdepartmentsStore');
    Route::get('/contentdepartments/{id}/edit', 'DepartmentController@editcontentdepartment')->name('contentdepartmentsEdit');
    Route::post('/contentdepartments/{id}/update', 'DepartmentController@updatecontentdepartment')->name('contentdepartmentsUpdate');
    Route::get('/contentdepartments/destroy/{id}', 'DepartmentController@destroycontentdepartment')->name('contentdepartmentsDestroy');
    Route::post('/contentdepartments/updateAll', 'DepartmentController@updateAllcontentdepartment')->name('contentdepartmentsUpdateAll');
    // contentdepartments :SEO
    Route::post('/contentdepartments/{id}/seo', 'DepartmentController@seocontentdepartment')->name('contentdepartmentsSEOUpdate');



    // programs
    Route::get('/programs', 'ProgramController@index')->name('programs');
    Route::get('/programs/create', 'ProgramController@create')->name('programsCreate');
    Route::post('/programs/store', 'ProgramController@store')->name('programsStore');
    Route::get('/programs/{id}/edit', 'ProgramController@edit')->name('programsEdit');
    Route::post('/programs/{id}/update', 'ProgramController@update')->name('programsUpdate');
    Route::get('/programs/destroy/{id}', 'ProgramController@destroy')->name('programsDestroy');
    Route::post('/programs/updateAll', 'ProgramController@updateAll')->name('programsUpdateAll');
    // programs :SEO
    Route::post('/programs/{id}/seo', 'ProgramController@seo')->name('programsSEOUpdate');


    // departments
    Route::get('/contentprograms', 'ProgramController@indexcontentprogram')->name('contentprograms');
    Route::get('/contentprograms/create', 'ProgramController@createcontentprogram')->name('contentprogramsCreate');
    Route::post('/contentprograms/store', 'ProgramController@storecontentprogram')->name('contentprogramsStore');
    Route::get('/contentprograms/{id}/edit', 'ProgramController@editcontentprogram')->name('contentprogramsEdit');
    Route::post('/contentprograms/{id}/update', 'ProgramController@updatecontentprogram')->name('contentprogramsUpdate');
    Route::get('/contentprograms/destroy/{id}', 'ProgramController@destroycontentprogram')->name('contentprogramsDestroy');
    Route::post('/contentprograms/updateAll', 'ProgramController@updateAllcontentprogram')->name('contentprogramsUpdateAll');
    // contentprograms :SEO
    Route::post('/contentprograms/{id}/seo', 'ProgramController@seocontentprogram')->name('contentprogramsSEOUpdate');


    // students
    Route::get('/students', 'StudentController@index')->name('students');
    Route::get('/students/create', 'StudentController@create')->name('studentsCreate');
    Route::post('/students/store', 'StudentController@store')->name('studentsStore');
    Route::get('/students/{id}/edit', 'StudentController@edit')->name('studentsEdit');
    Route::post('/students/{id}/update', 'StudentController@update')->name('studentsUpdate');
    Route::get('/students/destroy/{id}', 'StudentController@destroy')->name('studentsDestroy');
    Route::post('/students/updateAll', 'StudentController@updateAll')->name('studentsUpdateAll');






    // universitycenters
    Route::get('/universitycenters', 'UniversityCenterController@index')->name('universitycenters');
    Route::get('/universitycenters/create', 'UniversityCenterController@create')->name('universitycentersCreate');
    Route::post('/universitycenters/store', 'UniversityCenterController@store')->name('universitycentersStore');
    Route::get('/universitycenters/{id}/edit', 'UniversityCenterController@edit')->name('universitycentersEdit');
    Route::post('/universitycenters/{id}/update', 'UniversityCenterController@update')->name('universitycentersUpdate');
    Route::get('/universitycenters/destroy/{id}', 'UniversityCenterController@destroy')->name('universitycentersDestroy');
    Route::post('/universitycenters/updateAll', 'UniversityCenterController@updateAll')->name('universitycentersUpdateAll');
    // universitycenters :SEO
    Route::post('/universitycenters/{id}/seo', 'UniversityCenterController@seo')->name('universitycentersSEOUpdate');



    // contentuniversitycenters
    Route::get('/contentscenters', 'UniversityCenterController@indexcontentscenters')->name('contentscenters');
    Route::get('/contentscenters/create', 'UniversityCenterController@createcontentscenters')->name('contentscentersCreate');
    Route::post('/contentscenters/store', 'UniversityCenterController@storecontentscenters')->name('contentscentersStore');
    Route::get('/contentscenters/{id}/edit', 'UniversityCenterController@editcontentscenters')->name('contentscentersEdit');
    Route::post('/contentscenters/{id}/update', 'UniversityCenterController@updatecontentscenters')->name('contentscentersUpdate');
    Route::get('/contentscenters/destroy/{id}', 'UniversityCenterController@destroycontentscenters')->name('contentscentersDestroy');
    Route::post('/contentscenters/updateAll', 'UniversityCenterController@updateAllcontentscenters')->name('contentscentersUpdateAll');
    // contentscenters :SEO
    Route::post('/contentscenters/{id}/seo', 'UniversityCenterController@seocontentscenters')->name('contentscentersSEOUpdate');






    // Topics
    Route::get('/staff/{section_id}', 'StaffController@index')->name('staff');
    Route::get('/staff/{section_id}/create', 'StaffController@create')->name('staffCreate');
    Route::post('/staff/{section_id}/store', 'StaffController@store')->name('staffStore');
    Route::get('/staff/{section_id}/cat/{id}/edit', 'StaffController@edit')->name('staffEdit');
    Route::post('/staff/{section_id}/cat/{id}/update', 'StaffController@update')->name('staffUpdate');
    Route::get('/staff/{section_id}/cat/destroy/{id}', 'StaffController@destroy')->name('staffDestroy');
    Route::post('/staff/{section_id}/cat/updateAll', 'StaffController@updateAll')->name('staffUpdateAll');



    // programs
    Route::get('/sliderfaculties', 'SliderFacultyController@index')->name('sliderfaculties');
    Route::get('/sliderfaculties/create', 'SliderFacultyController@create')->name('sliderfacultiesCreate');
    Route::post('/sliderfaculties/store', 'SliderFacultyController@store')->name('sliderfacultiesStore');
    Route::get('/sliderfaculties/{id}/edit', 'SliderFacultyController@edit')->name('sliderfacultiesEdit');
    Route::post('/sliderfaculties/{id}/update', 'SliderFacultyController@update')->name('sliderfacultiesUpdate');
    Route::get('/sliderfaculties/destroy/{id}', 'SliderFacultyController@destroy')->name('sliderfacultiesDestroy');
    Route::post('/sliderfaculties/updateAll', 'SliderFacultyController@updateAll')->name('sliderfacultiesUpdateAll');
});



// Frontend Routes
// ../site map
Route::group(['middleware' => ['XSS']], function () {

    Route::get('/', 'FrontendHomeController@HomePage')->name('Home');
    // // ../home url
    Route::get('/home', 'FrontendHomeController@HomePage')->name('HomePage');
    Route::get('/{lang?}/home', 'FrontendHomeController@HomePageByLang')->name('HomePageByLang');



    Route::get('about/{id}', 'FrontendHomeController@AboutUs');
    Route::get('/{lang?}/about/{id}', 'FrontendHomeController@AboutUsByLang');


    Route::get('university/{name}', 'FrontendHomeController@getPageBySection')->name('getPageBySection');
    Route::get('/{lang?}/university/{name}', 'FrontendHomeController@getPageBySectionbyLang')->name('getPageBySectionbyLang');



    Route::get('/{lang?}/showdetails/{id}', 'FrontendHomeController@GetDetilaInfoTopicBylang');
    Route::get('/showdetails/{id}', 'FrontendHomeController@GetDetilaInfoTopic');


    Route::get('/admission/{id}', 'FrontendHomeController@GetAdmitionStudeis');
    Route::get('/{lang?}/admission/{id}', 'FrontendHomeController@GetAdmitionStudeisbyLang');
    Route::get('/admission/{page}/{id}', 'FrontendHomeController@GetAdmitionStudeiswithid');
    Route::get('/{lang?}/admission/{page}/{id}', 'FrontendHomeController@GetAdmitionStudeiswithidbylang');

    Route::get('university/academicstaff/{id}', 'FrontendHomeController@getacademicstaffBySection')->name('getacademicstaffBySection');
    Route::get('/{lang?}/university/academicstaff/{id}', 'FrontendHomeController@getacademicstaffBySection')->name('getacademicstaffBySectionByLang');



    Route::get('university/boardtrustees/{id}', 'FrontendHomeController@getacademicstaffBySection')->name('getacademicstaffBySection');
    Route::get('/{lang?}/university/boardtrustees/{id}', 'FrontendHomeController@getacademicstaffBySectionByLang')->name('getacademicstaffBySectionByLang');


    Route::get('university/boardtrustees/previous/{id}', 'FrontendHomeController@getacademicstaffPreviousBySection')->name('getacademicstaffPreviousBySection');
    Route::get('/{lang?}/university/boardtrustees/previous/{id}', 'FrontendHomeController@getacademicstaffPreviousBySectionByLang')->name('getacademicstaffPreviousBySectionByLang');



    Route::get('university/employees/{id}', 'FrontendHomeController@getacademicstaffBySection')->name('getacademicstaffBySection');
    Route::get('/{lang?}/university/employees/{id}', 'FrontendHomeController@getacademicstaffBySectionByLang')->name('getacademicstaffBySectionByLang');


    Route::get('university/iutt/profile/{id}', 'FrontendHomeController@GetAcademicstaffDetail');
    Route::get('/{lang?}/university/iutt/profile/{id}', 'FrontendHomeController@GetAcademicstaffDetailByLang');


    Route::get('/university/lecturertable/{id}', 'FrontendHomeController@Getuniversitycenter');
    Route::get('/{lang?}/university/lecturertable/{id}', 'FrontendHomeController@GetuniversitycenterByLang');
    Route::get('/center/{id}/home', 'FrontendHomeController@Getuniversitycenter');
    Route::get('/{lang?}/center/{id}/home', 'FrontendHomeController@GetuniversitycenterByLang');

    Route::get('/university/center/{id}', 'FrontendHomeController@Getuniversitycenter');
    Route::get('/{lang?}/university/center/{id}', 'FrontendHomeController@GetuniversitycenterByLang');

    Route::get('programs/{id}', 'FrontendHomeController@GetPrograms');
    Route::get('/{lang?}/programs/{id}', 'FrontendHomeController@GetProgramsByLang');

    Route::get('university/photos/details/{id}', 'FrontendHomeController@GetphotosDetail');
    Route::get('/{lang?}/university/photos/details/{id}', 'FrontendHomeController@GetphotosDetailByLang');

    Route::get('/view/{PageName}', 'FrontendHomeController@ViewCustomPage');
    Route::get('/{lang?}/view/{PageName}', 'FrontendHomeController@ViewCustomPageByLang');
    // ..Topics url  ( ex: www.site.com/news/topic/32 )
    Route::get('/news/topic/{id}', 'FrontendHomeController@topic')->name('FrontendTopic');
    Route::get('/{lang?}/news/topic/{id}', 'FrontendHomeController@topicByLang')->name('FrontendTopicByLang');

    // ..Sub category url for Section  ( ex: www.site.com/products/2 )
    Route::get('/news/{cat}', 'FrontendHomeController@topics')->name('FrontendTopicsByCat');
    Route::get('/{lang?}/news/{cat}', 'FrontendHomeController@topicsByLang')->name('FrontendTopicsByCatWithLang');


    Route::get('/news', 'FrontendHomeController@topics')->name('FrontendTopics');
    Route::get('/{lang?}/news', 'FrontendHomeController@topicsByLang')->name('FrontendTopicsByLang');




    Route::get('/sitemap.xml', 'SiteMapController@siteMap')->name('siteMap');
    Route::get('/{lang}/sitemap', 'SiteMapController@siteMap')->name('siteMapByLang');


    // ../subscribe to newsletter submit  (ajax url)
    Route::post('/subscribe', 'FrontendHomeController@subscribeSubmit')->name('subscribeSubmit');
    // ../Comment submit  (ajax url)
    Route::post('/comment', 'FrontendHomeController@commentSubmit')->name('commentSubmit');
    // ../Order submit  (ajax url)
    Route::post('/order', 'FrontendHomeController@orderSubmit')->name('orderSubmit');
    // ..Custom URL for contact us page ( www.site.com/contact )
    Route::get('/contact', 'FrontendHomeController@ContactPage')->name('contactPage');
    Route::get('/{lang?}/contact', 'FrontendHomeController@ContactPageByLang')->name('contactPageByLang');
    // ../contact message submit  (ajax url)
    Route::post('/contact/submit', 'FrontendHomeController@ContactPageSubmit')->name('contactPageSubmit');

    // ..if page by user id ( ex: www.site.com/user )
    Route::get('/user/{id}', 'FrontendHomeController@userTopics')->name('FrontendUserTopics');
    Route::get('/{lang?}/user/{id}', 'FrontendHomeController@userTopicsByLang')->name('FrontendUserTopicsByLang');
    // ../search
    Route::post('/search', 'FrontendHomeController@searchTopics')->name('searchTopics');



    // ..SEO url  ( ex: www.site.com/title-here )
    Route::get('/{seo_url_slug}', 'FrontendHomeController@SEO')->name('FrontendSEO');
    Route::get('/{lang?}/{seo_url_slug}', 'FrontendHomeController@SEOByLang')->name('FrontendSEOByLang');


    //=================
    Route::post('/contact/center/{id}/submit', 'UniversityCenterController@CenterPageSubmit')->name('CenterPageSubmit');



    //======================================================


    Route::get('/faculties/{faclutyname}/home', 'FacultiesHomeController@HomePageFaculty')->name('FacultyPage');
    Route::get('/{lang?}/faculties/{faclutyname}/home', 'FacultiesHomeController@HomePageFacultyByLang')->name('FacultyPagePageBylang');
    Route::get('/faculty/about/{id}', 'FacultiesHomeController@facultyAboutUs');
    Route::get('/{lang?}/faculty/about/{id}', 'FacultiesHomeController@facultyAboutUsByLang');

    Route::get('{faculty}/deanship', 'FacultiesHomeController@facultydeanship');
    Route::get('/{lang?}/{faculty}/deanship', 'FacultiesHomeController@facultydeanshipByLang');

    Route::get('/faculty/profile/staff/{id}', 'FacultiesHomeController@GetstafffacultyDetail');
    Route::get('/{lang?}/faculty/profile/staff/{id}', 'FacultiesHomeController@GetstafffacultyDetailByLang');

    Route::get('/faculty/programs/{id}', 'FacultiesHomeController@GetPrograms');
    Route::get('/{lang?}/faculty/programs/{id}', 'FacultiesHomeController@GetProgramsByLang');



    Route::get('{faculty}/departments/{id}', 'FacultiesHomeController@GetDepartments');
    Route::get('/{lang?}/{faculty}/departments/{id}', 'FacultiesHomeController@GetDepartmentsByLang');

    //============
    Route::get('/{faculty}/news/faculty/{id}', 'FacultiesNewsController@topicfaculty')->name('FrontendTopicfaculty');
    Route::get('/{lang?}/{faculty}/news/faculty/{id}', 'FacultiesNewsController@topicfacultyByLang')->name('FrontendTopicfacultyByLang');

    Route::get('/{faculty}/news/faculty/{cat}', 'FacultiesNewsController@topicsfaculty')->name('FrontendTopicsfacultyByCat');
    Route::get('/{lang?}/{faculty}/news/faculty/cat/{cat}', 'FacultiesNewsController@topicsfacultyByLang')->name('FrontendTopicsfacultyByCatWithLang');

    Route::get('/{faculty}/news/faculty', 'FacultiesNewsController@topicsfaculty')->name('FrontendTopicsfaculty');
    Route::get('/{lang?}/{faculty}/news/faculty', 'FacultiesNewsController@topicsfacultyByLang')->name('FrontendTopicsfacultyByLang');
    Route::post('/{faculty}/search/faculty', 'FacultiesNewsController@searchTopicsfaculty')->name('searchTopicsFaculty');

    //==================
    Route::get('{faculty}/events', 'FacultiesHomeController@facultyevents');
    Route::get('/{lang?}/{faculty}/events', 'FacultiesHomeController@facultyeventsByLang');

    Route::get('{faculty}/announcements', 'FacultiesHomeController@facultyannouncements');
    Route::get('/{lang?}/{faculty}/announcements', 'FacultiesHomeController@facultyannouncementsByLang');

    Route::get('{faculty}/ourGallery', 'FacultiesHomeController@facultyourGallery');
    Route::get('/{lang?}/{faculty}/ourGallery', 'FacultiesHomeController@facultyourGalleryByLang');
    Route::get('{faculty}/ourGallery/details/{id}', 'FacultiesHomeController@facultyourGalleryDetail');
    Route::get('/{lang?}/{faculty}/ourGallery/details/{id}', 'FacultiesHomeController@facultyourGalleryDetailByLang');

    Route::get('{faculty}/lecturertable', 'FacultiesHomeController@facultylecturerstable');
    Route::get('/{lang?}/{faculty}/lecturertable', 'FacultiesHomeController@facultylecturerstableByLang');




    Route::get('{faculty}/faculty/about/', 'FacultiesHomeController@facultyAboutUsPage');
    Route::get('/{lang?}/{faculty}/faculty/about/', 'FacultiesHomeController@facultyAboutUsPageByLang');

    //=============
});
