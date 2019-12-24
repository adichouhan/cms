<?php
namespace App\Http\Controllers;

use App\AseetsProduct;
use App\Assets;
use App\AssetsProduct;
use App\Category;
use App\Complaint;
use Illuminate\Http\Request;

class AssetProductController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.assets.Products.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'asset_name' => 'required',
        ]);
        $objAssetProduct=new AssetsProduct();
        $objAssetProduct->asset_product=$request->asset_name;
        $objAssetProduct->save();
        redirect()->back()->with('Asset Product created successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $objAssetProduct=AssetsProduct::where('id. $id')->get();
         return view('admin.assets.Products.edit', ['objAssetProduct' => $objAssetProduct]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request){
        $request->validate([
            'asset_name' => 'required',
        ]);
        $objAssetProduct=AssetsProduct::findOrFail($request->id);
        $objAssetProduct->asset_product=$request->asset_name;
        $objAssetProduct->save();
        redirect()->back()->with('Asset Product updated successfully');
    }



}
