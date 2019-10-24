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



//live search Route
Route::get('liveSearch','LiveSearchController@index');
Route::get('liveSearch/action','LiveSearchController@action')->name('live_search.action');


/*................start dynamicdependent select field Route............*/
// part(1)
Route::get('dynamicdependent','DynamicDependentController@index');
Route::post('dynamicdependent/fetch','DynamicDependentController@fetch')->name('dynamicdependent.fetch');

// part(2)
Route::get('dynamicdependentpart2','DynamicDependentController@Dynamicfieldpart2');
Route::post('select/fieldItem','DynamicDependentController@fieldItem')->name('select.fieldItem');

/*................end dynamicdependent select field Route............*/


// profile Route
Route::get('profiles','ProfileController@index')->name('profile.index');
Route::post('profile','ProfileController@store')->name('profile_ajax_crude.store');
Route::get('profile/{id}/edit','ProfileController@edit');
Route::post('profile/update','ProfileController@update')->name('profile.update');
Route::delete('profile/delete/{id}','ProfileController@delete')->name('profile.delete');


// category Controller Route
Route::get('categories/form','CategoryController@showForm')->name('categories.form');
Route::resource('categories','CategoryController');


// post and Comment
Route::post('posts/like','PostController@postLike')->name('post.like');
Route::post('posts/dislike','PostController@postDislike')->name('post.dislike');
Route::resource('posts','PostController');
Route::resource('comments','CommentController');



Route::get('jquery-tree-view',array('as'=>'jquery.treeview','uses'=>'TreeController@treeView'));




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
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
