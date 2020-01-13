<?php

namespace App\Http\Controllers\Admin;


use App\Assets;
use App\AssetsProduct;
use App\Category;
use App\EmployeeAvailability;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $arrObjAssets= Assets::all();
        return view('admin.assets.list', ['arrObjAssets' => $arrObjAssets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data = Category::all();
        $arrObjUser = User::where('activation_status', '1')->get();
        $output = '';
        foreach ($data as $item) {
            $output .= '<option value="' . $item["id"] . '">' . $item["category_title"] . '</option>';
        }
        $arrObjProduct= AssetsProduct::all();
        $arrEmployees = EmployeeAvailability::with('employee')->where('available_status', '1')->where('onWork', '!=', '1')->get();
        return view('admin.assets.create', ['output' => $output, 'arrObjUser' => $arrObjUser, 'arrObjProduct' => $arrObjProduct ,'arrEmployees' => $arrEmployees]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'expdate'   => 'required',
            'priority' => 'required',
            'material'   => 'required',
            'image' => 'required|image|max:2048',
        ]);
        $objAssest = new Assets();
        $objAssest->location = $request->location;
        $objAssest->expected_date = $request->expdate;
        $objAssest->priority = $request->priority;
        $objAssest->maerials = $request->material;
        $objAssest->user_id = auth()->user()->id;
        $objAssest->products  = $request->product;
        $objAssest->image       = $request->file('image')->store('assets');
        $objAssest->save();
        return redirect('admin/assets')->with('success', 'Asset created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Assets $assets)
    {
        $arrObjAssets = Assets::all();
        return view('admin.assets.view_assets',['arrObjAssets' => $arrObjAssets]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $objAssets = Assets::findOrFail($id);
        $objUser=User::where('id', "$objAssets->user_id")->first();
        $arrObjProduct= AssetsProduct::all();
        $arrEmployees=EmployeeAvailability::with('employee')->where('available_status', '1')->where('onWork', '!=', '1')->get();

        return view('admin.assets.edit',['objAssets' => $objAssets , 'arrEmployees'=>$arrEmployees, 'arrObjProduct' => $arrObjProduct ,'type' => 'edit', 'objUser'=>$objUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'expdate'   => 'required',
            'priority' => 'required',
            'material'   => 'required',
            'image' => 'required|image|max:2048',
        ]);
        $objAssest = Assets::findOrFail($request->id);;
        $objAssest->location = $request->location;
        $objAssest->expected_date = $request->expdate;
        $objAssest->priority = $request->priority;
        $objAssest->maerials = $request->material;
        $objAssest->products  = $request->product;
        $objAssest->image       = $request->file('image')->store('assets');
        $objAssest->save();
        return redirect('/view/assets')->with('success', 'Data Added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $data = Assets::findOrFail($id);
        $data->delete();
        return redirect('assets')->with('success', 'Data Added successfully.');
    }


    public function getAssetView(){
        return view('assets');
    }

    public function getProductCreate(){

        return view('admin.assets.Products.add');
    }

    public function getProductStrore(Request $request){
        $data = new AssetsProduct();
        $data->product_name = $request->product_name;
        $data->save();
        return view('assets');
    }

}
