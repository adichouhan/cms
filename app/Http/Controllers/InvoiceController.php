<?php

namespace App\Http\Controllers;

use App\Invoice;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
       $arrObjInvoices=Invoice::all();
       return view('admin.invoice.list', ['arrObjInvoices'=>$arrObjInvoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $invoiceIdCount = Invoice::withTrashed()->get()->count();
        return  view('admin.invoice.add', ['id' => ++$invoiceIdCount]);
    }

    public function createPdf(Request $request)
    {
        $arrMix=[];
        $arrMix['invoice_id'] = $request->invoice_id;
        $arrMix['invoice_date'] = $request->invoice_date;
        $arrMix['invoice']      = $request->invoice;
        $arrMix['sub_total']      = $request->sub_total;

        if($request->complaint){
            $arrMix['complaint'] = $request->complaint;
        }else{
            $arrMix['asset'] = $request->asset;
        }
        return view('admin.invoice.invoice-pdf', ['arrMix'=>$arrMix]);
        $pdf = PDF::loadView('admin.invoice.invoice-pdf', ['arrMix'=>$arrMix]);
        return $pdf->stream('medium.pdf');

    }

    public function getPdf($type = 'stream')
    {
        return view('admin.invoice.invoice-pdf');
        $pdf = app('dompdf.wrapper')->loadView('admin.invoice.invoice-pdf', ['order' => $this]);

        if ($type == 'stream') {
            return $pdf->stream('invoice.pdf');
        }

        if ($type == 'download') {
            return $pdf->download('invoice.pdf');
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objInvoice = new Invoice();
        $objInvoice->invoice_id=$request->invoice_id;
        $objInvoice->invoice_date=$request->invoice_date;
        if($request->complaint){
            $objInvoice->complaint=$request->complaint;
        }else{
            $objInvoice->asset=$request->asset;
        }
        $objInvoice->invoice=json_encode($request->invoice);
        $objInvoice->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $objInvoice=Invoice::findorfail($id);
        return view('admin.invoice.edit',['objInvoice'=>$objInvoice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $objInvoice = Invoice::findorfail($id);
        $objInvoice->invoice_id=$request->invoice_id;
        $objInvoice->invoice_date=$request->invoice_date;
        if($request->complaint){
            $objInvoice->complaint=$request->complaint;
        }else{
            $objInvoice->asset=$request->asset;
        }
        $objInvoice->invoice=json_encode($request->invoice);
        $objInvoice->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
