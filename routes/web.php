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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/projects/{project}', 'ProjectController@show')->name('project');
Route::post('/projects', 'ProjectController@create');

Route::post('/issues', 'IssueController@create');
Route::put('/issues/{issue}', 'IssueController@update');
Route::delete('/issues/{issue}', 'IssueController@destroy');
