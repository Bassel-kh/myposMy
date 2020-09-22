<?php

use Illuminate\Support\Facades\Route;

//////////////////////////////////////// Dashboard ///////////////////////////////////////////////////////
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]],
    function(){
        Route::prefix('dashboard')-> name('dashboard.') ->group(function (){

            Route::get('/index', 'DashboardController@index')->name('index');


            // User Routes
            Route::resource('users' , 'UserController')->except(['show']);

            // laratrust Routes
                // Permissions
                Route::resource('permissions', 'LaratrustControllers\PermissionController');
                Route::resource('permissionsAjax', 'LaratrustControllers\AjaxPermissionController');
                Route::resource('permissionsReAjax', 'LaratrustControllers\ReAjaxPermissionController')->except(['edit']);
                Route::get('permissionsReAjax/{id}/edit/', 'LaratrustControllers\ReAjaxPermissionController@edit');

                // Roles
                Route::resource('roles', 'LaratrustControllers\RoleController');
                Route::resource('rolesReAjax', 'LaratrustControllers\ReAjaxRoleController')->except(['edit']);
                Route::get('rolesReAjax/{id}/edit/', 'LaratrustControllers\ReAjaxRoleController@edit');

                // Teams

                Route::resource('teamsReAjax', 'LaratrustControllers\ReAjaxTeamController')->except(['edit']);
                Route::get('teamsReAjax/{id}/edit/', 'LaratrustControllers\ReAjaxTeamController@edit');
                // Users
                Route::resource('userTest', 'LaratrustControllers\UserTestController');
                Route::resource('userTestAjax', 'LaratrustControllers\UserTestAjaxController');

//            Route::resource('usersLara', 'LaratrustControllers\UserLaraController');
//                Route::get('usersLara/{id}/edit/', 'LaratrustControllers\UserLaraController@edit');

                //RolesAssignmentController
//             Route::resource('/roles_assignment', 'LaratrustControllers\RolesAssignmentController')
//                ->only(['index', 'edit', 'update']);

//            Route::resource('permissions' , 'LaratrustController');

            // Error404
            Route::get('/dash_Error_404', function (){
                return view('pages.dashboard_404');
            });
        }); // end of dashboard route

    });// end of localization

////////////////////////// End Dashboard //////////////////////////////////////

Route::prefix('dashboard')->name('dashboard.')->group( function () {

    Route::get('/check', function () {
        return 'This is Dashboard';
    });
});
