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

    Route::get('/add/asset/product', 'AssetProductController@create');
    Route::get('/asset/product', 'AssetProductController@index');
    Route::post('/add/asset/product', 'AssetProductController@store');
    Route::get('/edit/asset/product/{product}', 'AssetProductController@edit');
    Route::post('/edit/asset/product/{product}', 'AssetProductController@update');

    Route::get('/product', 'ProductsController@index');
    Route::get('/add/product', 'ProductsController@create');
    Route::post('/add/product', 'ProductsController@store');
    Route::get('/edit/product/{product}', 'ProductsController@edit');
    Route::post('/edit/product/{product}', 'ProductsController@update');

    Route::get('/documents', 'DocumentController@index');
    Route::get('/documents/create', 'DocumentController@create');
    Route::post('/document/stored', 'DocumentController@store');
    Route::get('/document/edit/{document}', 'DocumentController@edit');
    Route::post('/document/update', 'DocumentController@update');

});

Route::group([ 'namespace' => '\App\Http\Controllers\Admin', 'prefix'=>'admin' ], function() {
    Route::get('/assets', 'AssetsController@index');
    Route::get('/assets/create', 'AssetsController@create');
    Route::post('/create/assets', 'AssetsController@store');
    Route::get('/edit/asset/{asset}', 'AssetsController@edit');
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
