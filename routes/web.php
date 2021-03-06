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
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('projects', 'ProjectController');
Route::post('projects/adduser/{id}', 'ProjectController@addUser');

Route::resource('project/{project_id}/comment', 'CommentController');

Route::get('profiel', 'ProfileController@show')->name('profile.show');
Route::get('profiel/bewerken', 'ProfileController@edit')->name('profile.edit');
Route::post('profiel/update', 'ProfileController@update')->name('profile.update');
