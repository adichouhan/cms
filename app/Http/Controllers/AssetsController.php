<?php

namespace App\Http\Controllers;

use App\Assets;
use App\Category;
use App\Complaint;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('assets');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assetes.book_asset',['type' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $objAssest = new Assets();
        $objAssest->location = $request->location;
        $objAssest->expected_date = $request->expdate;
        $objAssest->priority = $request->priority;
        $objAssest->maerials = $request->material;
        $objAssest->user_id = auth()->user()->id;
        $objAssest->products  = '';
        $objAssest->image       = $request->file('image')->store('assets');
        $objAssest->save();
        return redirect('assets')->with('success', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function show(Assets $assets)
    {
        $arrObjAssets = Assets::all();
        return view('assetes.view_assets',['arrObjAssets' => $arrObjAssets]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objAssets = Assets::findOrFail($id);

        return view('assetes.book_asset',['objAssets' => $objAssets ,'type' => 'edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $objAssest = Assets::findOrFail($request->id);;
        $objAssest->location = $request->location;
        $objAssest->expected_date = $request->expdate;
        $objAssest->priority = $request->priority;
        $objAssest->maerials = $request->material;
        $objAssest->products  = '';
        $objAssest->image       = $request->file('image')->store('assets');
        $objAssest->save();
        return redirect('/view/assets')->with('success', 'Data Added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Assets::findOrFail($id);
        $data->delete();
        return redirect('assets')->with('success', 'Data Added successfully.');
    }


    public function getAssetView(){
        return view('assets');
    }
}
