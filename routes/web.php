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


Route::group([ 'prefix' => 'admin' , 'middleware' => 'admin'], function() {

    Route::get('/', 'Controller@dashboard');

    Route::get('/category/create',       'CategoryController@createCategory');
    Route::get('/category/edit/{id}',    'CategoryController@categoryEdit');
    Route::get('/category',              'CategoryController@indexCategory');
    Route::post('/category/store',       'CategoryController@storeCategory');
    Route::post('/category/edit/{id}',   'CategoryController@postCategoryEdit');
    Route::get('/category/delete/{id}', 'CategoryController@categoryDelete');

    Route::get('/subcategory/create',      'CategoryController@createSubCategory');
    Route::get('/subcategory',             'CategoryController@indexSubCategory');
    Route::get('/subcategory/edit/{id}',   'CategoryController@subCategoryEdit');
    Route::post('/subcategory/store',      'CategoryController@storeSubCategory');
    Route::post('/subcategory/edit/{id}',  'CategoryController@postSubCategoryEdit');
    Route::get('/subcategory/delete/{id}','CategoryController@subCategoryDelete');

    Route::get('/user',                 'UserController@index');
    Route::get('/user/create',          'UserController@create');
    Route::post('/user/store',          'UserController@store');
    Route::get('/user/edit/{user}',     'UserController@edit');
    Route::get('/user/delete/{user}',   'UserController@delete');
    Route::post('/user/update/{user}',  'UserController@update');

    Route::get('/complaints',                           'AdminComplaintsController@index');
    Route::get('/complaints/create',                    'AdminComplaintsController@create');
    Route::post('/complaints/create',                   'AdminComplaintsController@store');
    Route::get('/autocomplete/complaint',               'AdminComplaintsController@autocomplete');
    Route::get('/complaints/edit/{complaint}',          'AdminComplaintsController@edit');
    Route::get('/complaints/delete/{complaint}',        'AdminComplaintsController@destroy');
    Route::post('/update/complaint/{complaint}',        'AdminComplaintsController@update');

    Route::get('/employee/availability/',               'EmployeeAvailabilityController@index');
    Route::get('/employee/availability/create',         'EmployeeAvailabilityController@create');
    Route::get('/employee/availability/edit/{id}',      'EmployeeAvailabilityController@edit');
    Route::post('/employee/availability/edit/{id}',     'EmployeeAvailabilityController@update');
    Route::get('/employee/availability/delete/{id}',    'EmployeeAvailabilityController@delete');
    Route::post('/employee/availability/store',         'EmployeeAvailabilityController@store');

    Route::get('/invoice',                      'InvoiceController@index');
    Route::get('/invoice/view/{id}',            'InvoiceController@viewPdf');
    Route::get('/invoice/download/{id}',        'InvoiceController@downloadPdf');
    Route::get('/invoice/create',               'InvoiceController@create');
    Route::post('/invoice/store',               'InvoiceController@store');
    Route::get('/invoice/edit/{invoice}',       'InvoiceController@edit');
    Route::get('/invoice/delete/{invoice}',     'InvoiceController@destroy');
    Route::post('/invoice/update/{invoice}',    'InvoiceController@update');

    Route::get('/delivery',                     'ChallanController@index');
    Route::get('/delivery/create',              'ChallanController@create');
    Route::get('/delivery/view/{id}',           'ChallanController@viewPdf');
    Route::get('/delivery/download/{id}',       'ChallanController@downloadPdf');
    Route::post('/delivery/store',              'ChallanController@store');
    Route::get('/delivery/edit/{invoice}',      'ChallanController@edit');
    Route::get('/delivery/delete/{invoice}',    'ChallanController@delete');
    Route::post('/delivery/update/{invoice}',   'ChallanController@update');

    Route::get('/quote',                        'QuoteController@index');
    Route::get('/quote/create',                 'QuoteController@create');
    Route::get('/quote/view/{id}',              'QuoteController@viewPdf');
    Route::get('/quote/download/{id}',          'QuoteController@downloadPdf');
    Route::post('/quote/store',                 'QuoteController@store');
    Route::get('/quote/edit/{id}',              'QuoteController@edit');
    Route::post('/quote/delete/{id}',           'QuoteController@destroy');
    Route::post('/quote/update/{id}',             'QuoteController@update');

    Route::get('/products',                     'ProductsController@index');
    Route::get('/product/create',               'ProductsController@create');
    Route::post('/product/store',               'ProductsController@store');
    Route::get('/product/edit/{product}',       'ProductsController@edit');
    Route::get('/product/delete/{product}',     'ProductsController@destroy');
    Route::post('/product/edit/{product}',      'ProductsController@update');

    Route::get('/boq', 'BoqController@index');
    Route::get('/boq/create',                   'BoqController@create');
    Route::post('/boq/store',                   'BoqController@store');
    Route::get('/boq/edit/{document}',          'BoqController@edit');
    Route::get('/boq/delete/{document}',        'BoqController@destroy');
    Route::post('/boq/edit/{document}',         'BoqController@update');

    Route::get('/supplier',                     'SupplierController@index');
    Route::get('/supplier/create',              'SupplierController@create');
    Route::post('/supplier/store',              'SupplierController@store');
    Route::get('/supplier/edit/{supplier}',     'SupplierController@edit');
    Route::get('/supplier/delete/{supplier}',   'SupplierController@destroy');
    Route::post('/supplier/update',             'SupplierController@update');

    Route::get('/documents',                    'DocumentController@index');
    Route::get('/documents/create',             'DocumentController@create');
    Route::post('/document/stored',             'DocumentController@store');
    Route::get('/document/edit/{document}',     'DocumentController@edit');
    Route::get('/document/delete/{document}',   'DocumentController@destroy');
    Route::post('/document/update/{document}',  'DocumentController@update');

    Route::get('/asset/product/create',         'AssetProductController@create');
    Route::post('/asset/product/store',         'AssetProductController@store');
});

Route::group([ 'namespace' => '\App\Http\Controllers\Admin', 'prefix'=>'admin'], function() {
    Route::get('/assets',                        'AssetsController@index');
    Route::get('/assets/create',                 'AssetsController@create');
    Route::post('/assets/store',                 'AssetsController@store');
    Route::get('/assets/edit/{asset}',           'AssetsController@edit');
    Route::post('/assets/edit/{asset}',          'AssetsController@update');
    Route::get('/assets/delete/{asset}',         'AssetsController@destroy');

    Route::get('/employee',                      'EmployeeController@index');
    Route::get('/employee/create',               'EmployeeController@create');
    Route::post('/employee/store',               'EmployeeController@store');
    Route::get('/employee/edit/{id}',            'EmployeeController@edit');
    Route::get('/employee/delete/{id}',          'EmployeeController@destroy');
    Route::post('/employee/update',              'EmployeeController@update');
    Route::get('/employee/delete/{id}',          'EmployeeController@destroy');
});

Route::group(['middleware' => 'auth'],              function() {
    Route::get('/complaints',                       function () { return view('complaints'); });

    Route::post('/fetch',                           'Controller@fetch');
    Route::get('/images/{pathname}/{filename}',     'Controller@displayImage');
    Route::get('/book',                             'CategoryController@bookForm');

    Route::post('/register/complaint',              'ComplaintController@postComplaints');
    Route::get('/register/complaint',               'ComplaintController@create');
    Route::get('/complaints/',                      'ComplaintController@getViewComplaints');
    Route::get('/complaints/edit/{complaint}',      'ComplaintController@getEditComplain');
    Route::post('complaint/update/{complaint}',     'ComplaintController@update');
    Route::get('complaints/delete/{complaint}',     'ComplaintController@destroy');
    Route::get('/my-complaints',                    'ComplaintController@getComplaintsView');
    Route::get('complaint/invoices',                'ComplaintController@invoices');

    Route::get('complaint/invoice/view/{id}',      'ComplaintController@invoicesShow');

    Route::get('complaint/invoice/download/{id}',   'ComplaintController@invoicesDownload');
    Route::get('complaint/quotes',                  'ComplaintController@quotes');
    Route::get('complaint/quotes/view/{id}',        'ComplaintController@quotesShow');
    Route::get('complaint/quotes/download/{id}',    'ComplaintController@quotesDownload');

    Route::get('/assets',                           'AssetsController@index');
    Route::get('/book-asset',                       'AssetsController@create');
    Route::post('/register/asset',                  'AssetsController@store');
    Route::get('/edit/asset/{asset}',               'AssetsController@edit');
    Route::get('/delete/asset/{asset}',             'AssetsController@destroy');
    Route::post('/update/asset',                    'AssetsController@update');
    Route::get('/view/assets',                      'AssetsController@show');
    Route::get('/my-assets',                        'AssetsController@getAssetView');
    Route::get('assets/invoices',                   'AssetsController@invoices');

    Route::get('assets/invoice/view/{id}',         'AssetsController@invoiceView');
    Route::get('assets/invoices/download/{id}',    'AssetsController@invoicesDownload');
    Route::get('assets/quotes',                    'AssetsController@quotes');
    Route::get('assets/quotes/view/{id}',          'AssetsController@quotesShow');
    Route::get('assets/quotes/download/{id}',      'AssetsController@quotesDownload');

    Route::post('search-category',                  'CategoryController@searchSubCategory');
    Route::get('/', function () {return view('service_book');});

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
