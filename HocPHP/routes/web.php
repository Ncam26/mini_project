<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HocPhpController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\HocThemPHP;


Route::get('/', function () {
    return view('home');
});

Route::get('/welcome', function () {
    return view('welcome');
});
Route::prefix('hocphp')->controller(HocPhpController::class)->group(function () {
    // Define the route for the HocPHP index page
    Route::get('/', 'index')->name('hocphp.index');
    // Define the route for getting a specific HocPHP data by ID
    Route::get('/edit/{id}', 'getHocPHP')->name('hocphp.show');
    // Define the routes for adding, updating, and deleting HocPHP data
    route::get('/add', 'addHocPHP')->name('hocphp.add');
    //Define the route for fix add
    Route::post('/add', 'addHocPHP')->name('hocphp.add');
    Route::put('/update', 'updateHocPHP')->name('hocphp.update');
    Route::delete('/delete/{id}', 'deleteHocPHP')->name('hocphp.delete');
});
Route::prefix('Admin')->controller(HocThemPHP::class)->group(function () {
    // Define the route for the Admin index page
Route::resource('hocphp', HocThemPHP::class);

});
