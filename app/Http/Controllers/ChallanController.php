<?php

namespace App\Http\Controllers;

use App\Challan;
use App\Quote;
use Barryvdh\DomPDF\Facade as PDF;
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
        $arrObjChallan=Challan::all();
        return view('admin.delivery.list', ['arrObjChallan'=>$arrObjChallan]);
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
        $request->validate([
            'challan_id'      => 'required',
            'challan_date'    => 'required',
            'challan'          => 'required',
        ]);
        $objChallan = new Challan();
        $objChallan->challan_id=$request->challan_id;
        $objChallan->challan_date=$request->challan_date;
        $objChallan->supplier_id=$request->supplier;
        $objChallan->challan=json_encode($request->challan);
        $objChallan->save();
        $this->createPdf($request);
        return redirect('/admin/delivery/')->with('message', 'Challan Created Successfully.');
    }

    public function downloadPdf($id, Request $request)
    {
        $objChallan=Challan::findorfail($id);
        $arrMix=[];
        $arrMix['challan_id']       = $objChallan->challan_id;
        $arrMix['challan_date']     = $objChallan->challan_date;
        $arrMix['challan']          = json_encode($objChallan->challan);
        $pdf = PDF::loadView('admin.delivery.delivery-pdf', ['arrMix'=>$arrMix]);
        return $pdf->download('Challan'.$request->challan_id.'.pdf');

    }

    public function viewPdf($id,$type = 'stream')
    {
        $objChallan=Challan::findorfail($id);
        $arrMix=[];
        $arrMix['challan_id']       = $objChallan->challan_id;
        $arrMix['challan_date']     = $objChallan->challan_date;
        $arrMix['challan']          = json_encode($objChallan->challan);
        return view('admin.delivery.delivery-pdf', ['arrMix'=>$arrMix]);
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id,Challan $challan)
    {
        $objInvoice=Challan::findorfail($id);
        return view('admin.delivery.edit',['objInvoice'=>$objInvoice]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'challan_id'   => 'required',
            'challan_date'          => 'required',
            'challan'          => 'required',
        ]);
        $objChallan = Challan::findorfail($id);
        $objChallan->challan_id=$request->challan_id;
        $objChallan->challan_date=$request->challan_date;
        $objChallan->supplier_id=$request->supplier;
        $objChallan->challan=json_encode($request->challan);
        $objChallan->save();
        $this->createPdf($request);
        return redirect('/admin/delivery/')->with('message', 'Challan Created Successfully.');
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
