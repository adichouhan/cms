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
    Route::get('/complaints/edit/{complaint}', 'AdminComplaintsController@edit');
    Route::post('/update/complaint/{complaint}', 'AdminComplaintsController@update');
    Route::get('/employee/create', 'EmployeeController@create');
    Route::post('/employee/store', 'EmployeeController@store');
    Route::get('/employee/availability/create', 'EmployeeAvailabilityController@create');
    Route::post('/employee/availability/store', 'EmployeeAvailabilityController@store');
    Route::get('/employee', 'EmployeeController@index');

    Route::get('/add/asset/product', 'AssetProductController@store');
    Route::get('/documents', 'DocumentController@index');
    Route::get('/documents/create', 'DocumentController@create');
    Route::post('/documents/create', 'DocumentController@store');
    Route::get('/documents/edit/{document}', 'DocumentController@edit');
    Route::post('/documents/edit/{document}', 'DocumentController@update');

});

Route::get('/complaints', function () {
    return view('complaints');
})->middleware('auth');

Route::get('/register/user/create', 'RegisterController@create')->middleware('auth');

Route::post('/register/user/create', 'RegisterController@store')->middleware('auth');


Route::get('/', function () {
    return view('service_book');
})->middleware('auth');

Route::get('/book', 'CategoryController@bookForm')->middleware('auth');

Route::post('/register/complaint', 'ComplaintController@postComplaints')->middleware('auth');

Route::get('/register/complaint', 'ComplaintController@create')->middleware('auth');

Route::get('/view_complaints', 'ComplaintController@getViewComplaints')->middleware('auth');

Route::get('/complaints/edit/{complaint}', 'ComplaintController@edit')->middleware('auth');

Route::post('/update/complaint/{complaint}', 'ComplaintController@update')->middleware('auth');

Route::get('/mycomplaints', 'ComplaintController@getComplaintsView')->middleware('auth');

Route::get('/assets', 'AssetsController@index')->middleware('auth');

Route::get('/book_asset', 'AssetsController@create')->middleware('auth');

Route::post('/register/asset', 'AssetsController@store')->middleware('auth');

Route::get('/edit/asset/{asset}', 'AssetsController@edit')->middleware('auth');

Route::get('/delete/asset/{asset}', 'AssetsController@destroy')->middleware('auth');

Route::post('/update/asset', 'AssetsController@update')->middleware('auth');

Route::get('/view/assets', 'AssetsController@show')->middleware('auth');

Route::get('/myassets', 'AssetsController@getAssetView')->middleware('auth');


Route::get('/admin', function () {
    return view('admin.admin_template');
})->middleware('auth');

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
