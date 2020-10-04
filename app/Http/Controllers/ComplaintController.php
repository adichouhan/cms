<?php

namespace App\Http\Controllers;

use App\Category;
use App\Complaint;
use App\Invoice;
use App\Quote;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('complaints.front.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data = Category::all()->where('parent_id', '==', NULL);
        $output = '';
        foreach ($data as $item) {
            $output .= '<option value="' . $item["id"] . '">' . $item["category_title"] . '</option>';
        }
        return view('front.complaints.create', ['output' => $output]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postComplaints(Request $request)
    {
        $request->validate([
            'title'     => 'required|unique:complaints',
            'location' => 'required',
            'expdate'   => 'required',
            'complaint'   => 'required',
        ]);
        $count = Complaint::all()->count();
        $objComplaints = new Complaint();
        $objComplaints->title = $request->title;
        $objComplaints->location = $request->location;
        $objComplaints->complaints_unique = 'comp_'.$count;
        $objComplaints->expected_date = $request->expdate;
        $objComplaints->priority = $request->priority;
        $objComplaints->materials = $request->material;
        $objComplaints->user_id  = auth()->user()->id;
        $objComplaints->complaints = json_encode($request->get('complaint'));
        if($request->hasFile('image')){
            $objComplaints->image = $request->file('image')->store('complaint');
        }
        $objComplaints->save();
        return redirect('/complaints')->with('message', 'Complaints Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Complaint $complaint
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getViewComplaints()
    {
        $userId = auth()->user()->id;
        $arrObjComplaints = Complaint::where('user_id', $userId)->get();
        return view('front.complaints.list', ['arrObjComplaints' => $arrObjComplaints]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditComplain($id)
    {
        $objComplaint = Complaint::findOrFail($id);
        $data = Category::all();
        $output = '';
        foreach ($data as $item) {
            $output .= '<option value="' . $item["id"] . '">' . $item["category_title"] . '</option>';
        }
        return view('front.complaints.edit', ['output' => $output, 'objComplaints' => $objComplaint, 'type' => 'edit']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'title'     => 'required|unique:complaints,title,'.$id,
            'location' => 'required',
            'expdate'   => 'required',
            'complaint'   => 'required',
        ]);
        $objComplaints = Complaint::findorfail($id);
        $objComplaints->location = $request->location;
        $objComplaints->expected_date = $request->expdate;
        $objComplaints->priority = $request->priority;
        $objComplaints->materials = $request->material;
        $objComplaints->user_id = auth()->user()->id;
        $objComplaints->complaints = json_encode($request->get('complaint'));
        if($request->hasFile('image')){
            $objComplaints->image = $request->file('image')->store('complaint');
        }
        $objComplaints->save();
        return redirect('complaints/')->with('message', 'Complaint Updated Successfully.');
    }

    public function getComplaintsView()
    {
        return view('complaints');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $objComplaints = Complaint::findorfail($id);
        $objComplaints->delete();
        return redirect('complaints/')->with('message', 'Complaint Deleted Successfully.');
    }

    /**
     *Invoices list
     */
    public function invoices()
    {
        $arrObjInvoices  = Invoice::whereHas('getUserComplaints')->get();
        return view('front.complaints.invoice.list', ['arrObjInvoices'  =>  $arrObjInvoices]);
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
        $pdf = PDF::loadView('admin.invoice.invoice-pdf', ['arrMix'=>$arrMix]);
        return $pdf->download('Invoice'.$arrObjInvoices->invoice_id.'.pdf');
    }

    /**
     *Invoices list
     */
    public function invoicesShow($id)
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
        $arrObjQuotes=Quote::whereHas('getUserComplaints')->get();
        return view('front.complaints.quote.list', ['arrObjQuotes'=>$arrObjQuotes]);
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
        $pdf = PDF::loadView('admin.quote.quote-pdf', ['arrMix'=>$arrMix]);

        return $pdf->download('Quote'.$arrObjQuotes->quote_id.'.pdf');
    }


    /**
     *Invoices list
     */
    public function quotesShow($id)
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
