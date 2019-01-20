<?php

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



Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');






Route::get('/test', function()
{
\App\User::all();

});



// Authentication
Route::group(['middleware' => 'auth'], function ($app) {

    Route::resource('accounts', 'AccountController');
    Route::resource('units', 'UnitController');
    Route::resource('components', 'ComponentController');
    Route::resource('switches', 'SwitchController');



    Route::post('units/{id}/program', 'UnitController@program');
    Route::get('units/{id}/program', 'UnitController@program');


});







Route::get('/charts', function()
{
    return View::make('mcharts');
});

Route::get('/tables', function()
{
    return View::make('table');
});

Route::get('/forms', function()
{
    return View::make('form');
});

Route::get('/grid', function()
{
    return View::make('grid');
});

Route::get('/buttons', function()
{
    return View::make('buttons');
});


Route::get('/icons', function()
{
    return View::make('icons');
});

Route::get('/panels', function()
{
    return View::make('panel');
});

Route::get('/typography', function()
{
    return View::make('typography');
});

Route::get('/notifications', function()
{
    return View::make('notifications');
});

Route::get('/blank', function()
{
    return View::make('blank');
});


Route::get('/documentation', function()
{
    return View::make('documentation');
});