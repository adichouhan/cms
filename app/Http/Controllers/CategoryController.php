<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function bookForm(){
       $data = Category::all();
        return view('Book_Complaint',['data' => $data]);
    }
}
