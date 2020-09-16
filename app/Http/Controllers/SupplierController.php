<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $arrObjSupplier=Supplier::all();
        return view('admin.supplier.list', ['arrObjSupplier'=>$arrObjSupplier]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email_id' => 'required',
            'mobile_no'   => 'required',
        ]);

        $objEmployee = new Supplier();
        $objEmployee->name = $request->name;
        $objEmployee->email_id = $request->email_id;
        $objEmployee->mobile_no = $request->mobile_no;
        $objEmployee->save();
        return redirect('admin/supplier')->with('message', 'Supplier Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $objSupplier = Supplier::findorfail($id);
        return view('/admin/supplier/edit', ['objSupplier'=>$objSupplier]);
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
        $request->validate([
            'name' => 'required',
            'email_id' => 'required',
            'mobile_no'   => 'required',
        ]);

        $objEmployee = Supplier::findorfail($request->id)->first();
        $objEmployee->name = $request->name;
        $objEmployee->email_id = $request->email_id;
        $objEmployee->mobile_no = $request->mobile_no;
        $objEmployee->save();
        return redirect('/admin/supplier')->with('Supplier Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $objEmployee = Supplier::findorfail($id);
        $objEmployee->delete();
        return redirect('/admin/supplier')->with('Supplier deleted successfully');
    }
}
