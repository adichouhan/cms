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
        return view('Book_Complaint',['output' => $output]);
    }
}
