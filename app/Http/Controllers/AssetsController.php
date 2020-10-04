<?php

namespace App\Http\Controllers;

use App\Assets;
use App\AssetsProduct;
use App\Category;
use App\Complaint;
use App\Invoice;
use App\Quote;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $arrObjAssets = Assets::all();
        return view('front.assets.list',['arrObjAssets' => $arrObjAssets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $arrObjProduct= AssetsProduct::all();
        return view('front.assets.create',['type' => '', 'arrObjProduct'=>$arrObjProduct]);
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
            'title'     => 'required|unique:assets',
            'location' => 'required',
            'expdate'   => 'required',
            'priority' => 'required',
        ]);
        $count = Assets::all()->count();
        $objAssest = new Assets();
        $objAssest->title = $request->title;
        $objAssest->location = $request->location;
        $objAssest->assets_unique = 'asset_'.$count;
        $objAssest->expected_date = $request->expdate;
        $objAssest->priority = $request->priority;
        $objAssest->materials = $request->material;
        $objAssest->user_id = auth()->user()->id;
        $objAssest->products  = json_encode($request->product);
        $objAssest->image       = $request->file('image')->store('assets');
        $objAssest->save();
        return redirect('assets')->with('message', 'Assets Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function show(Assets $assets)
    {
        $userId          = auth()->user()->id;
        $arrObjAssets = Assets::where('user_id', $userId)->get();
        return view('front.assets.list',['arrObjAssets' => $arrObjAssets]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $objAssets = Assets::findOrFail($id);
        $arrObjProduct= AssetsProduct::all();
        return view('front.assets.create',['objAssets' => $objAssets ,'arrObjProduct' =>$arrObjProduct,'type' => 'edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'     => 'required|unique:assets,title,'.$request->id,
            'expdate'   => 'required',
            'priority' => 'required',
            'product' => 'required',
        ]);
        $objAssest                      = Assets::findOrFail($request->id);
        $objAssest->title               = $request->title;
        $objAssest->location            = $request->location;
        $objAssest->expected_date       = $request->expdate;
        $objAssest->priority            = $request->priority;
        $objAssest->materials            = $request->material;
        $objAssest->products            = $request->product;
        if($request->file('image')) {
            $objAssest->image = $request->file('image')->store('assets');
        }
        $objAssest->save();
        return redirect('/assets')->with('message', 'Assets Added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $data = Assets::findOrFail($id);
        $data->delete();
        return redirect('/assets')->with('success', 'Assets  successfully Deleted.');
    }

    public function getAssetView(){
        return view('assets');
    }

    /**
     *Invoices list
     */
    public function invoices()
    {
        $arrObjInvoices=Invoice::whereHas('getUserAssets')->get();
        return view('front.assets.invoice.list', ['arrObjInvoices' => $arrObjInvoices]);
    }

    /**
     *Invoices list
     */
    public function invoiceDownload($id)
    {
        $arrObjInvoices=Invoice::findorfail($id);
        $arrMix=[];
        $arrMix['invoice_id']   = $arrObjInvoices->invoice_id;
        $arrMix['invoice_date'] = $arrObjInvoices->invoice_date;
        $arrMix['invoice']      = $arrObjInvoices->invoice;
        $arrMix['sub_total']    = $arrObjInvoices->sub_total;

        if($arrObjInvoices->complaint){
            $arrMix['complaint'] = $arrObjInvoices->complaint;
        }else{
            $arrMix['asset'] = $arrObjInvoices->asset;
        }
//        return view('admin.invoice.invoice-pdf', ['arrMix'=>$arrMix]);
        $pdf = PDF::loadView('admin.invoice.invoice-pdf', ['arrMix'=>$arrMix]);
        return $pdf->download('Invoice'.$arrObjInvoices->invoice_id.'.pdf');
    }

    /**
     *Invoices list
     */
    public function invoiceView($id)
    {
        $arrObjInvoices=Invoice::findorfail($id);
        $arrMix=[];
        $arrMix['invoice_id']   = $arrObjInvoices->invoice_id;
        $arrMix['invoice_date'] = $arrObjInvoices->invoice_date;
        $arrMix['invoice']      = $arrObjInvoices->invoice;
        $arrMix['sub_total']    = $arrObjInvoices->sub_total;

        if($arrObjInvoices->complaint){
            $arrMix['complaint'] = $arrObjInvoices->complaint;
        }else{
            $arrMix['asset'] = $arrObjInvoices->asset;
        }

        return view('admin.invoice.invoice-pdf', ['arrMix'=>$arrMix]);
    }

    /**
     *Invoices list
     */
    public function quotes()
    {
        $arrObjQuotes=Quote::whereHas('getUserAssets')->get();
        return view('front.assets.quote.list', ['arrObjQuotes'=>$arrObjQuotes]);
    }

    /**
     *Invoices list
     */
    public function quotesDownload($id)
    {
        $arrObjQuotes=Quote::findorfail($id);
        $arrMix=[];
        $arrMix['quote_id']     = $arrObjQuotes->quote_id;
        $arrMix['quote_date']   = $arrObjQuotes->quote_date;
        $arrMix['quote']        = $arrObjQuotes->quote;
        $arrMix['sub_total']    = $arrObjQuotes->sub_total;

        if($arrObjQuotes->complaint){
            $arrMix['complaint'] = $arrObjQuotes->complaint;
        }else{
            $arrMix['asset']     = $arrObjQuotes->asset;
        }
//        return view('admin.quote.invoice-pdf', ['arrMix'=>$arrMix]);
        $pdf = PDF::loadView('admin.quote.quote-pdf', ['arrMix'=>$arrMix]);
        return $pdf->download('Quote'.$arrObjQuotes->quote_id.'.pdf');
    }

    /**
     *Invoices list
     */
    public function quotesView($id)
    {
        $arrObjQuotes=Quote::findorfail($id);
        $arrMix=[];
        $arrMix['quote_id']     = $arrObjQuotes->quote_id;
        $arrMix['quote_date']   = $arrObjQuotes->quote_date;
        $arrMix['quote']        = $arrObjQuotes->quote;
        $arrMix['sub_total']    = $arrObjQuotes->sub_total;

        if($arrObjQuotes->complaint){
            $arrMix['complaint'] = $arrObjQuotes->complaint;
        }else{
            $arrMix['asset']     = $arrObjQuotes->asset;
        }
        return view('admin.quote.quote-pdf', ['arrMix'=>$arrMix]);
    }
}
