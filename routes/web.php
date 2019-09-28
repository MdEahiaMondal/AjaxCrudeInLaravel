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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('student','StudentController');
Route::get('all/student','StudentController@allStudent');
Route::get('checkbox/ItemDelete','StudentController@CheKDelete')->name('checkbox.ItemDelete');


// create dynamic field Its Route
Route::get('dynamic-field','DynamicFieldController@showForm');
Route::post('dynamic-field','DynamicFieldController@insert')->name('dynamic_field.insert');