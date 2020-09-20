<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $arrObjProduct=Products::all();
        return view('admin.product.list', ['arrObjProduct'=>$arrObjProduct]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_unit'   => 'required',
            'product_cost'   => 'required',
        ]);
        $objProduct=new Products();
        $objProduct->product_name=$request->product_name;
        $objProduct->product_unit=$request->product_unit;
        $objProduct->product_cost=$request->product_cost;
        $objProduct->save();
        return redirect('admin/products')->with('message', 'Products Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products $products
     * @return void
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $objProduct=Products::findorfail($id);
        return view('admin.product.edit', ['objProduct' => $objProduct]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_unit' => 'required',
        ]);
        $objProduct=Products::findorfail($id);
        $objProduct->product_name=$request->product_name;
        $objProduct->product_unit=$request->product_unit;
        $objProduct->save();
        return redirect('admin/products')->with('message', 'Products Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $objProduct=Products::findorfail($id);
        $objProduct->delete();
        return redirect('admin/products')->with('message', 'Products deleted Successfully');
    }
}
