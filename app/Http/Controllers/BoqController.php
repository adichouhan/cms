<?php

namespace App\Http\Controllers;

use App\Boq;
use Illuminate\Http\Request;

class BoqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $arrObjBoq = Boq::all();
        return view('admin.boq.list', ['arrObjBoq'=>$arrObjBoq]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.boq.create');
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
            'product_name'   => 'required',
            'product_unit' => 'required',
            'product_rate' => 'required',
        ]);
            $objBoq= new Boq();
            $objBoq->product_name=$request->product_name;
            $objBoq->product_unit=$request->product_unit;
            $objBoq->product_rate=$request->product_rate;
            $objBoq->save();
            return redirect('/admin/boq')->with('message', 'Boq Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Boq  $boq
     * @return \Illuminate\Http\Response
     */
    public function show(Boq $boq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Boq  $boq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objBoq = Boq::findorfail($id);
        return view('admin.boq.edit', ['objBoq'=>$objBoq]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Boq  $boq
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'product_name'   => 'required',
            'product_unit' => 'required',
            'product_rate' => 'required',
        ]);
        $objBoq = Boq::findorfail($id);
        $objBoq->product_name=$request->product_name;
        $objBoq->product_unit=$request->product_unit;
        $objBoq->product_rate=$request->product_rate;
        $objBoq->save();
        return redirect('/admin/boq')->with('message', 'Boq Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Boq  $boq
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
       $objBoq= Boq::findOrFail($id);
       $objBoq->delete();
        return redirect('/admin/boq')->with('message', 'Boq Deleted Successfully');
    }
}
