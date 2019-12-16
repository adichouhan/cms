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


Route::group([ 'prefix' => 'admin' ], function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::get('/complaints', 'AdminComplaintsController@index');
    Route::get('/complaints/create', 'AdminComplaintsController@create');
    Route::get('/complaints/edit/{complaint}', 'AdminComplaintsController@edit');
    Route::post('/update/complaint/{complaint}', 'AdminComplaintsController@update');
    Route::get('/employee/create', 'EmployeeController@create');
    Route::post('/employee/store', 'EmployeeController@store');
    Route::get('/employee/availability/create', 'EmployeeAvailabilityController@create');
    Route::post('/employee/availability/store', 'EmployeeAvailabilityController@store');
    Route::get('/employee', 'EmployeeController@index');

    Route::get('/add/asset/product', 'AssetProductController@store');
    Route::get('/assets/create', 'AssetProductController@create ');


});

Route::group([ 'namespace' => '\App\Http\Controllers\Admin' ], function() {

    Route::get('/assets', 'AssetsController@index');
    Route::get('/assets/create', 'AssetsController@create');

});



Route::get('/complaints', function () {
    return view('complaints');
});

Route::get('/register/user/create', 'RegisterController@create');
Route::post('/register/user/create', 'RegisterController@store');


Route::get('/', function () {
    return view('service_book');
});

Route::get('/book', 'CategoryController@bookForm');

Route::post('/register/complaint', 'ComplaintController@postComplaints');
Route::get('/register/complaint', 'ComplaintController@create');
Route::get('/view_complaints', 'ComplaintController@getViewComplaints');
Route::get('/complaints/edit/{complaint}', 'ComplaintController@edit');
Route::post('/update/complaint/{complaint}', 'ComplaintController@update');
Route::get('/mycomplaints', 'ComplaintController@getComplaintsView');

Route::get('/assets', 'AssetsController@index');
Route::get('/book_asset', 'AssetsController@create');
Route::post('/register/asset', 'AssetsController@store');
Route::get('/edit/asset/{asset}', 'AssetsController@edit');
Route::get('/delete/asset/{asset}', 'AssetsController@destroy');
Route::post('/update/asset', 'AssetsController@update');
Route::get('/view/assets', 'AssetsController@show');
Route::get('/myassets', 'AssetsController@getAssetView');


Route::get('/admin', function () {
    return view('admin.admin_template');
});

Route::post('fill_sub_category',  function(\Illuminate\Http\Request $request){
     $parent_category=$request->category_id;
     $subCategory=\App\SubCategory::where('parent_id', $parent_category)->get();
    $output='';
    foreach ($subCategory as $item){
        $output .= '<option value="'.$item["id"].'">'.$item["subcategory_title"].'</option>';
    }
    return $output;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
