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
            Route::resource('permissions', 'LaratrustControllers\PermissionController');
            Route::resource('permissionsAjax', 'LaratrustControllers\AjaxPermissionController');
            Route::resource('permissionsReAjax', 'LaratrustControllers\ReAjaxPermissionController');
            Route::get('permissionsReAjax/{id}/edit/', 'LaratrustControllers\ReAjaxPermissionController@edit');


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
