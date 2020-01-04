<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function bookForm(){
       $data = Category::all();
        $output='';
       foreach ($data as $item){
           $output .= '<option value="'.$item["id"].'">'.$item["category_title"].'</option>';
       }
        return view('Book_Complaint',['output' => $output,'type' => '']);
    }

    function createCategory(){
        return view('admin.category.create');
    }

    function storeCategory(Request $request){

        $objCategory = new Category();
        $objCategory->category_title = $request->category_name;
        $objCategory->save();
        return redirect('admin/category/create');
    }

    function createSubCategory(){
        return view('admin.category.subcategory.create');
    }

    function storeSubCategory(Request $request){

        $objCategory = new Category();
        $objCategory->subcategory_title = $request->category_name;
        $objCategory->parent_id         = $request->parent_id;
        $objCategory->save();
        return redirect('admin/category/create');
    }
}
