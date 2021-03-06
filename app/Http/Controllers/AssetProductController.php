<?php
namespace App\Http\Controllers;

use App\AssetsProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetProductController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('admin.assets.Products.list');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.assets.products.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $request->validate([
            'product_name' => 'required',
        ]);
        $objAssetProduct=new AssetsProduct();
        $objAssetProduct->product_name=$request->product_name;
        $objAssetProduct->save();
        return redirect('/admin/assets')->with('message','Asset Product created successfully');
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request){
        $request->validate([
            'asset_name' => 'required',
        ]);
        $objAssetProduct=AssetsProduct::findOrFail($request->id);
        $objAssetProduct->asset_product=$request->asset_name;
        $objAssetProduct->save();
        return redirect('/admin/assets')->with('message','Asset Product updated successfully');
    }


    public function delete($id){
        $objAssetProduct=AssetsProduct::findOrFail($id);
        $objAssetProduct->delete();
       return  redirect('/admin/assets')->with('message', 'Asset Product deleted successfully');
    }

}
