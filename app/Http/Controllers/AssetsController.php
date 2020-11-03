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
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

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

        $objAssetProduct = '';
        $arrMixProduct = $request->product;
        $request->validate([
            'title'     => 'required|unique:assets',
            'location' => 'required',
            'expdate'   => 'required',
            'priority' => 'required',
            'image'     => 'image|max:2048',
        ]);

        foreach ($arrMixProduct  as $key => $product){
            if(!$product['id']){
                $objAssetProduct = AssetsProduct::create(['product_name'=> $product['name']]);
                $arrMixProduct[$key]['id'] = ''.$objAssetProduct->id. '';
            }
        }

        $count = Assets::all()->count();
        $objAsset = new Assets();
        $objAsset->title = $request->title;
        $objAsset->location = $request->location;
        $objAsset->assets_unique = 'asset_'.$count;
        $objAsset->expected_date = $request->expdate;
        $objAsset->priority = $request->priority;
        $objAsset->materials = $request->material;
        $objAsset->user_id = auth()->user()->id;
        $objAsset->products  = json_encode(collect($arrMixProduct)->pluck('id'));
        if($request->hasFile('image')) {
            $objAsset->image = $request->file('image')->store('assets');
        }
        $objAsset->save();
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
        $objAssetProduct = '';
        $arrMixProduct = $request->product;
        $request->validate([
            'title'     => 'required|unique:assets,title,'.$request->id,
            'expdate'   => 'required',
            'priority' => 'required',
            'product' => 'required',
            'image'     => 'image|max:2048',
        ]);
        foreach ($arrMixProduct  as $key => $product){

            if(!$product['id']){
                $objAssetProduct = AssetsProduct::create(['product_name'=> $product['name']]);
                $arrMixProduct[$key]['id'] = ''.$objAssetProduct->id. '';
            }
        }
        $objAsset                      = Assets::findOrFail($request->id);
        $objAsset->title               = $request->title;
        $objAsset->location            = $request->location;
        $objAsset->expected_date       = $request->expdate;
        $objAsset->priority            = $request->priority;
        $objAsset->materials           = $request->material;
        $objAsset->products  = json_encode(collect($arrMixProduct)->pluck('id'));
        if($request->file('image')) {
            $objAsset->image = $request->file('image')->store('assets');
        }
        $objAsset->save();
        return redirect('/assets')->with('message', 'Assets Added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
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
