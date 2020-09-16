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
//Route::namespace('dashboard') ->group(function () {
////    Route::resource('permissionsReAjax', 'LaratrustControllers\ReAjaxPermissionController');
////    Route::get('permissionsReAjax/{id}/edit/', 'LaratrustControllers\ReAjaxPermissionController@edit');
//
//});
