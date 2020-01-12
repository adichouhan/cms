<?php

namespace App\Http\Controllers;

use App\Assets;
use App\Complaint;
use App\Quote;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $arrObjInvoices=Quote::all();
        return view('admin.quote.list', ['arrObjInvoices'=>$arrObjInvoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $quoteIdCount = Quote::withTrashed()->get()->count();
        return  view('admin.quote.add', ['id' => ++$quoteIdCount]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $objQuote = new Quote();
        $objQuote->quote_id=$request->quote_id;
        $objQuote->quote_date=$request->quote_date;
        if($request->complaint){
            $objQuote->complaint=$request->complaint;
        }else{
            $objQuote->asset=$request->asset;
        }
        $objQuote->quote=json_encode($request->quote);
        $objQuote->save();

        $this->createPdf($request);
        return redirect('admin/quotes')->with('message', 'Quotes Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        //
    }

    public function createPdf(Request $request)
    {
        $arrMix=[];
        $arrMix['quote_id']     = $request->quote_id;
        $arrMix['quote_date']   = $request->quote_date;
        $arrMix['quote']        = $request->quote;
        $arrMix['sub_total']    = $request->sub_total;

        if($request->complaint){
            $arrMix['complaint'] = $request->complaint;
        }else{
            $arrMix['asset']     = $request->asset;
        }
//        return view('admin.quote.invoice-pdf', ['arrMix'=>$arrMix]);
        $pdf = PDF::loadView('admin.quote.invoice-pdf', ['arrMix'=>$arrMix]);
        return $pdf->download('Quote'.$request->quote_id.'.pdf');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $objQuote=Quote::findorfail($id);
        if($objQuote->complaint){
            $objCompOrAsset =  Complaint::where($objQuote->complaint)->get();
        }
        if($objQuote->asset){
            $objCompOrAsset = Assets::where($objQuote->asset)->get();
        }
        return view('admin.quote.edit',['objQuote'=>$objQuote, 'objCompOrAsset'=> $objCompOrAsset]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $objQuote = Quote::findorfail($id);
        $objQuote->quote_id=$request->quote_id;
        $objQuote->quote_date=$request->quote_date;
        if($request->complaint){
            $objQuote->complaint=$request->complaint;
        }else{
            $objQuote->asset=$request->asset;
        }
        $objQuote->quote=json_encode($request->quote);
        $objQuote->save();
        $this->createPdf($request);
        return redirect('admin/quotes')->with('message', 'Quotes Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
