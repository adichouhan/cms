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

    function createSubCategory(){
        return view('admin.category.subcategory.create');
    }

    function indexCategory(){
        $arrObjCategory=Category::whereNull('parent_id')->get();
        return view('admin.category.list',['arrObjCategory' => $arrObjCategory]);
    }

    function indexSubCategory(){
        $arrObjSubCategory=Category::whereNotNull('parent_id')->get();
        return view('admin.category.subcategory.list',['arrObjSubCategory'=>$arrObjSubCategory]);
    }

    function storeCategory(Request $request){
        $request->validate([
            'category_name'   => 'required',
        ]);

         Category::create([
            'category_title' => $request->category_name
        ]);

        return redirect('admin/category/')->with('message', 'Category Created Successfully');
    }

    function storeSubCategory(Request $request){
        $request->validate([
            'subcategory_name'   => 'required',
            'parent_id'          => 'required',
        ]);
         Category::create([
            'category_title' => $request->subcategory_name,
            'parent_id'      => $request->parent_id
        ]);
        return redirect('admin/subcategory/')->with('message', 'Sub-Category Created Successfully');
    }

    function categoryEdit($id){
        $objCategory = Category::where('id', $id)->whereNull('parent_id')->first();
        if($objCategory){
            return view('admin.category.edit', ['objCategory' => $objCategory]);
        }
        return view('admin.category.create');
    }

    function postCategoryEdit($id, Request $request){
        $request->validate([
            'category_name'   => 'required',
        ]);
        Category::where('id', $id)->whereNull('parent_id')->update([
            'category_title' => $request->category_name
        ]);
        return redirect('admin/category/')->with('message', 'Category Updated Successfully');
    }

    function subCategoryEdit($id){
        $objSubCategory = Category::where('id', $id)->whereNotNull('parent_id')->first();
        if($objSubCategory->count() > 0 ){
            return view('admin.category.subcategory.edit', ['objSubCategory' => $objSubCategory]);
        }
        return view('admin.category.subcategory.create');
    }

    function postSubCategoryEdit($id, Request $request){
        $request->validate([
            'subcategory_name'   => 'required',
            'parent_id'          => 'required',
        ]);
         Category::where('id', $id)->whereNotNull('parent_id')->update([
            'category_title' => $request->subcategory_name,
            'parent_id'      => $request->parent_id
        ]);
        return redirect('admin/subcategory/')->with('message', 'Sub-Category Updated Successfully');
    }

    function categoryDelete($id){
        $objCategory = Category::where('id', $id)->whereNull('parent_id')->get();
        $objCategory->delete();
        return redirect('admin/category/')->with('message', 'Sub-Category deleted Successfully');
    }

    function subCategoryDelete($id){
        $objCategory = Category::where('id', $id)->whereNotNull('parent_id')->get();
        $objCategory->delete();
        return redirect('admin/subcategory/')->with('message', 'Sub-Category deleted Successfully');
    }

    function searchCategory(Request $request){
        $parentId=$request->category_id;
        $subCategory=Category::where('id', $parentId)->whereNotNull('parent_id')->get();
        $output='';
        foreach ($subCategory as $item){
            $output .= '<option value="'.$item["id"].'">'.$item["category_title"].'</option>';
        }
        return $output;
    }
}
