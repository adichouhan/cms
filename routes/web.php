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

});


Route::get('{filename}', function ($filename)
{
    return Image::make(storage_path( $filename))->response();
});

Route::get('/complaints', function () {
    return view('complaints');
})->middleware('auth');

Route::get('/assets', function () {
    return view('assets');
})->middleware('auth');


Route::get('/service', function () {
    return view('service_book');
})->middleware('auth');

Route::get('/book', 'CategoryController@bookForm');

Route::post('/register/complaint', 'ComplaintController@postComplaints');

Route::get('/view_complaints', 'ComplaintController@getViewComplaints');

//Route::get('/view_complaints', function () {
//    return view('complaints.view_complaint');
//});

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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
