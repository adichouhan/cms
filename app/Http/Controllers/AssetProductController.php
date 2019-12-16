<?php
namespace App\Http\Controllers;

use App\AseetsProduct;
use App\Assets;
use App\Category;
use App\Complaint;
use Illuminate\Http\Request;

class AssetProductController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $objAssetProduct=new AseetsProduct();
        $objAssetProduct->asset_product=$request->asset_name;
        $objAssetProduct->save();

    }

}
