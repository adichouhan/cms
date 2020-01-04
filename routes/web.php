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
    Route::get('/', function () {return view('admin.dashboard');});

    Route::get('/user', 'UserController@index');
    Route::get('/user/create', 'UserController@create');
    Route::post('/user/stored', 'UserController@store');
    Route::get('/user/edit/{user}', 'UserController@edit');
    Route::post('/user/update/{user}', 'UserController@update');


    Route::get('/complaints', 'AdminComplaintsController@index');
    Route::get('/complaints/create', 'AdminComplaintsController@create');
    Route::post('/complaints/create', 'AdminComplaintsController@store');
    Route::get('/autocomplete/complaint', 'AdminComplaintsController@autocomplete');
    Route::get('/complaints/edit/{complaint}', 'AdminComplaintsController@edit');
    Route::post('/update/complaint/{complaint}', 'AdminComplaintsController@update');


    Route::get('/employee/availability/create', 'EmployeeAvailabilityController@create');
    Route::post('/employee/availability/store', 'EmployeeAvailabilityController@store');


    Route::get('/invoice', 'InvoiceController@index');
    Route::get('/invoice/create', 'InvoiceController@create');
    Route::get('/invoice/getPdf', 'InvoiceController@getPdf');
    Route::post('/invoice/createpdf', 'InvoiceController@createpdf');
    Route::post('/invoice/store', 'InvoiceController@store');
    Route::get('/invoice/edit/{invoice}', 'InvoiceController@edit');
    Route::post('/invoice/update/{invoice}', 'InvoiceController@update');

    Route::get('/quote', 'QuoteController@index');
    Route::get('/quote/create', 'QuoteController@create');
    Route::get('/quote/getPdf', 'QuoteController@getPdf');
    Route::post('/quote/createpdf', 'QuoteController@createpdf');
    Route::post('/quote/store', 'QuoteController@store');
    Route::get('/quote/edit', 'QuoteController@edit');
    Route::post('/quote/edit', 'QuoteController@update');

    Route::get('/product', 'ProductsController@index');
    Route::get('/add/product', 'ProductsController@create');
    Route::post('/add/product', 'ProductsController@store');
    Route::get('/edit/product/{product}', 'ProductsController@edit');
    Route::post('/edit/product/{product}', 'ProductsController@update');

    Route::get('/boq', 'BoqController@index');
    Route::get('/boq/create', 'BoqController@create');
    Route::post('/boq/stored', 'BoqController@store');
    Route::get('/boq/edit/{document}', 'BoqController@edit');
    Route::post('/boq/update/{document}', 'BoqController@update');

    Route::get('/supplier', 'SupplierController@index');
    Route::get('/supplier/create', 'SupplierController@create');
    Route::post('/supplier/stored', 'SupplierController@store');
    Route::get('/supplier/edit/{supplier}', 'SupplierController@edit');
    Route::post('/supplier/update/{supplier}', 'SupplierController@update');

    Route::get('/documents', 'DocumentController@index');
    Route::get('/documents/create', 'DocumentController@create');
    Route::post('/document/stored', 'DocumentController@store');
    Route::get('/document/edit/{document}', 'DocumentController@edit');
    Route::post('/document/update/{document}', 'DocumentController@update');

});

Route::group([ 'namespace' => '\App\Http\Controllers\Admin', 'prefix'=>'admin' ], function() {
    Route::get('/assets', 'AssetsController@index');
    Route::get('/assets/create', 'AssetsController@create');
    Route::post('/assets/store', 'AssetsController@store');
    Route::get('/assets/edit/{asset}', 'AssetsController@edit');
    Route::get('/assets/product/create', 'AssetsController@getProductCreate');
    Route::post('/assets/product/store', 'AssetsController@getProductStrore');


    Route::get('/employee', 'EmployeeController@index');
    Route::get('/employee/create', 'EmployeeController@create');
    Route::post('/employee/store', 'EmployeeController@store');
    Route::get('/employee/edit/{id}', 'EmployeeController@edit');
    Route::post('/employee/update', 'EmployeeController@update');
    Route::get('/employee/delete/{id}', 'EmployeeController@destroy');
});

Route::get('/complaints', function () {
    return view('complaints');
})->middleware('auth');

Route::post('/fetch', 'Controller@fetch');

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
