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

// Route::get('/', function () {
//     return view('home');
// });


Route::get('/', 'ActivityController@index')->name('home');

Route::group(['middleware'=> ['web']], function() {
	Route::resource('post', 'ActivityController');
	Route::post('/addActivity', 'ActivityController@addActivity')->name('addActivity'); 
	Route::post('/updateActivity', 'ActivityController@updateProduct')->name('updateActivity');
	Route::post('/deleteActivity', 'ActivityController@deleteProduct')->name('deleteActivity');
});

