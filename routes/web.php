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

use Illuminate\Support\Facades\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('student','StudentController');
Route::get('all/student','StudentController@allStudent');
Route::get('checkbox/ItemDelete','StudentController@CheKDelete')->name('checkbox.ItemDelete');


// create dynamic field Its Route
Route::get('dynamic-field','DynamicFieldController@showForm');
Route::post('dynamic-field','DynamicFieldController@insert')->name('dynamic_field.insert');


// customer Route
Route::get('customers','CustomerController@getIndex')->name('get.customer');
Route::get('customer/data','CustomerController@getData')->name('get.customer.data');
Route::post('customer/store','CustomerController@postStore')->name('customer.store');
Route::post('customer/update','CustomerController@postUpdate')->name('customer.update');
Route::post('customer/delete','CustomerController@postDelete')->name('customer.delete');


// friends route with ajax and datatables
Route::resource('friends','FriendController');


/*Route::post('mamuns/post/{id}', function (){
    return response()->json(\request('id'));
})->name('mamuns.post');

// it will use in javascript ajax url or route
var url = '{{ route("mamuns.post", "") }}/'+id;*/


/*Route::post('mamuns/post/{id}/update', function (){
    return response()->json(\request('id'));
})->name('mamuns.post');*/
// it will use in javascript ajax url or route
/*var url = '{{ url("mamuns/post") }}/'+id+'/update';


