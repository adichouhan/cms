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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'gst_no' => 'required',
        ]);
        $objUser                        = new User();
        $objUser->name                  = $request->name;
        $objUser->password              = bcrypt($request->password);
        $objUser->email                 = $request->email;
        $objUser->gst_no                = $request->gst_no;

        if($request->has('activation_status')){
            $objUser->activation_status     = $request->activation_status;
        }
        $objUser->save();
        return redirect('/login')->with('message', 'Registered Successfully');
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
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'gst_no' => 'required',
        ]);
        $objUser                        = User::findOrFail($id);
        $objUser->name                  = $request->name;
        $objUser->password              = bcrypt($request->password);
        $objUser->email                 = $request->email;
        $objUser->gst_no                = $request->gst_no;
        $objUser->activation_status     = $request->activation_status;
        $objUser->save();
        return redirect('/admin/user')->with('User Updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param    $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $objEmployee = User::findorfail($id);
        $objEmployee->delete();
        return redirect('/admin/user')->with('User deleted successfully');
    }
}
