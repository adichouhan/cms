<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $objUser = new User();
            $objUser->name=$request->name;
            $objUser->password=$request->password;
            $objUser->email=$request->email;
            $objUser->save();
            redirect('/login')->with('You are registered successfully. You can logged in after verification');
    }
}
