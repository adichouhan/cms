<?php

namespace App\Http\Controllers;

use App\Challan;
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
        return redirect('/admin/challan/')->with('message', 'Challan Created Successfully.');
    }

    public function createPdf(Request $request)
    {
        $arrMix=[];
        $arrMix['challan_id'] = $request->challan_id;
        $arrMix['challan_date'] = $request->challan_date;
        $arrMix['challan']      = $request->challan;
        $arrMix['sub_total']      = $request->sub_total;

        if($request->complaint){
            $arrMix['complaint'] = $request->complaint;
        }else{
            $arrMix['asset'] = $request->asset;
        }
//        return view('admin.invoice.invoice-pdf', ['arrMix'=>$arrMix]);
        $pdf = PDF::loadView('admin.delivery.delivery-pdf', ['arrMix'=>$arrMix]);
        return $pdf->download('Challan'.$request->challan_id.'.pdf');

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
