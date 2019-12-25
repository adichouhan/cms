<?php

namespace App\Http\Controllers;

use App\Challan;
use Illuminate\Http\Request;

class ChallanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $arrObjInvoices=Challan::all();
        return view('admin.delivery.list', ['arrObjInvoices'=>$arrObjInvoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $invoiceIdCount = Challan::withTrashed()->get()->count();
        return  view('admin.delivery.add', ['id' => ++$invoiceIdCount]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $objChallan = new Challan();
        $objChallan->challan_id=$request->challan_id;
        $objChallan->challan_date=$request->challan_date;
        if($request->complaint){
            $objChallan->complaint=$request->complaint;
        }else{
            $objChallan->asset=$request->asset;
        }
        $objChallan->challan=json_encode($request->challan);
        $objChallan->save();
        $this->createPdf($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function show(Challan $challan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function edit(Challan $challan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challan $challan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Challan  $challan
     * @return \Illuminate\Http\Response
     * -----
     */
    public function destroy(Challan $challan)
    {

    }
}
