<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes(['register'=>false]);

    Route::get('/home', 'HomeController@index')->name('home');
    ////////////////////////////////////////////////////////////////////////////

});
///////////////////////////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function(){
        Route::prefix('dashboard')->namespace('Dashboard')-> name('dashboard.') ->group(function (){


            Route::get('/index', 'DashboardController@index')->name('index');


            // User Routes
            Route::resource('users' , 'UserController')->except(['show']);

            // laratrust Routes
            Route::resource('permissions' , 'LaratrustController');

            // Error404
            Route::get('/dash_Error_404', function (){
                return view('pages.dashboard_404');
            });
        }); // end of dashboard route

});// end of localization

///////////////////// Start Test ///////////////////
Route::namespace('Test')->group(function () {


    Route::get('tabledit', 'TableditController@index');

    Route::post('tabledit/action', 'TableditController@action')->name('tabledit.action');
});
//////////////////// End Test ///////////////////

//////////////// Error pages ////////////////////
Route::get('/Error_404', function (){
    return view('pages.404');
});


