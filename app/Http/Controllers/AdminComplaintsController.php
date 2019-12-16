<?php

namespace App\Http\Controllers;

use App\Category;
use App\Complaint;
use App\Employee;
use App\EmployeeAvailability;
use Illuminate\Http\Request;

class AdminComplaintsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $arrObjComplaints = Complaint::all();
        return view('admin.complaints.complaint_view',['arrObjComplaints' => $arrObjComplaints]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\View\View
     */
    public function edit(Complaint $complaint)
    {
        $data = Category::all();

        $output='';
        foreach ($data as $item){
            $output .= '<option value="'.$item["id"].'">'.$item["category_title"].'</option>';
        }

        $arrEmployees=EmployeeAvailability::with('employee')->where('available_status', '1')->where('onWork', '!=', '1')->get();

        return view('admin.complaints.edit', ['objComplaints' => $complaint, 'output' =>$output, 'arrEmployees'=>$arrEmployees]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        dd($request->all());
    }

}
