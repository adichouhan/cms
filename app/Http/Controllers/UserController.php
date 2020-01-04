<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $arrObjUsers = User::all();
        return view('admin.user.list', ['arrObjUsers'=>$arrObjUsers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $objUser                        = new User();
        $objUser->name                  = $request->name;
        $objUser->password              = bcrypt($request->password);
        $objUser->email                 = $request->email;
        $objUser->activation_status     = $request->activation_status;
        $objUser->save();
        return redirect()->back()->with('notice', 'User Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $objUser = User::findorfail($id);

        return view('admin.user.edit', ['objUser'=>$objUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Supplier $supplier)
    {
        $objUser                        = User::findOrFail($request->id);
        $objUser->name                  = $request->name;
        $objUser->password              = bcrypt($request->password);
        $objUser->email                 = $request->email;
        $objUser->activation_status     = $request->activation_status;
        $objUser->save();
        return redirect()->back()->with('User Updated successfully');
    }

}
