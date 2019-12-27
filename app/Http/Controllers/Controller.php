<?php

namespace App\Http\Controllers;

use App\Assets;
use App\AssetsProduct;
use App\Complaint;
use App\Products;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fetch(Request $request)
    {
        $modelType=$request->type;
        $term = $request->query;
        if($modelType = 'complaint'){
            $objModel=Complaint::where('name', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType = 'asset'){
            $objModel=Assets::where('name', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType = 'assetProduct'){
            $objModel=AssetsProduct::where('name', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType = 'product'){
            $objModel=Products::where('name', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType = 'user'){
            $objModel=User::where('name', 'LIKE', '%' . $term . '%')->get();
        }


    }
}
