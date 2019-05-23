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


Route::get('/', 'NoteController@index')->name('home');

//Api for note
Route::group(['middleware'=> ['web']], function() {
	Route::resource('post', 'NoteController');
	Route::post('api/addNote', 'NoteController@addNote')->name('addNote'); 
	Route::post('api/updateNote', 'NoteController@updateNote')->name('updateNote');
	Route::post('api/deleteNote', 'NoteController@deleteNote')->name('deleteNote');
});

//Api for todo
Route::group(['middleware'=> ['web']], function() {
	Route::resource('post', 'TodoController');
	Route::post('api/addTodo', 'TodoController@addTodo')->name('addTodo'); 
	Route::post('api/updateTodo', 'TodoController@updateTodo')->name('updateTodo');
	Route::post('api/deleteTodo', 'TodoController@deleteTodo')->name('deleteTodo');
});


