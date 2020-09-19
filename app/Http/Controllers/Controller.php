<?php

namespace App\Http\Controllers;

use App\Assets;
use App\AssetsProduct;
use App\Boq;
use App\Category;
use App\Complaint;
use App\Employee;
use App\Products;
use App\Supplier;
use App\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fetch(Request $request)
    {
        $modelType=$request['type'];
        $term = $request['query'];

        if($modelType == 'complaint'){
            $objModel=Complaint::where('complaints_unique', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType == 'asset'){
            $objModel=Assets::where('assets_unique', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType == 'assetProduct'){
            $objModel=AssetsProduct::where('product_name', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType == 'product'){
            $objModel=Products::where('product_name', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType == 'user'){
            $objModel=User::where('name', 'LIKE', '%' . $term . '%')->where('activation_status', 1)->get();
        }

        if($modelType == 'employee'){
            $objModel=Employee::where('name', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType == 'category'){
            $objModel=Category::where('category_title', 'LIKE', '%' . $term . '%')->whereNull('parent_id')->get();
        }

        if($modelType == 'supplier'){
            $objModel=Supplier::where('name', 'LIKE', '%' . $term . '%')->get();
        }

        if($modelType == 'boq'){
            $objModel=Boq::where('product_name', 'LIKE', '%' . $term . '%')->get();
        }
        return response()->json($objModel);
    }

    public function displayImage($pathname, $filename)
    {
        $path = storage_path('app/'.$pathname.'/'.$filename);

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;

    }

    public function dashboard()
    {
            $objComplaint= Complaint::orderBy('id', 'desc')->take(10)->get();
            $objAsset= Assets::orderBy('id', 'desc')->take(10)->get();
        return view('admin.layout.dashboard', ['arrObjComplaints'=>$objComplaint, 'arrObjAssets'=>$objAsset,]);
    }

}
