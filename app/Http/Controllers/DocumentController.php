<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrObjDocuments = Document::all();
        return view('admin.documents.list' ,['arrObjDocuments' => $arrObjDocuments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'expirydate'   => 'required',
        ]);
        $objDocument = new Document();
        $objDocument->name = $request->title;
        $objDocument->expiry_date = $request->expirydate;
        $objDocument->file = $request->file('file')->store('document');
        $objDocument->save();
        return redirect('/admin/documents')->with('message', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $objDocuments = Document::findOrFail($id);
        return view('admin.documents.edit',['objDocuments' => $objDocuments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'expirydate'   => 'required',
        ]);
        $objDocument = Document::findOrFail($request->id);
        $objDocument->name = $request->title;
        $objDocument->expiry_date = $request->expirydate;
        dd($request->all());
        $objDocument->file = $request->file('file')->store('document');
        $objDocument->save();
        return redirect('/admin/documents')->with('message', 'Data Added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
