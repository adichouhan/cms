<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Complaint;
use App\EmployeeAvailability;
use App\Http\Controllers\Controller;
use App\User;
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $arrObjUser = User::where('activation_status','1')->get();
        $data = Category::all();
        $output='';
        foreach ($data as $item){
            $output .= '<option value="'.$item["id"].'">'.$item["category_title"].'</option>';
        }

        $arrObjEmployee=EmployeeAvailability::with('employee')->where('available_status','==', 1)->get();
        dd($arrObjEmployee);
        return view('admin.complaints.create',['arrObjUser' => $arrObjUser, 'arrObjEmployees'=>$arrObjEmployee, 'output'=>$output]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'location'  => 'required',
            'expdate'   => 'required',
            'priority'  => 'required',
            'material'  => 'required',
            'image'     => 'required|image|max:2048',
        ]);
        $count = Complaint::all()->count();
        $objComplaints = new Complaint();
        $objComplaints->location = $request->location;
        $objComplaints->expected_date = $request->expdate;
        $objComplaints->complaints_unique = 'comp_'.$count;
        $objComplaints->priority = $request->priority;
        $objComplaints->maerials = $request->material;
        $objComplaints->user_id  = $request->user;
        $objComplaints->complaints = json_encode($request->get('complaint'));
        $objComplaints->image = $request->file('image')->store('complaint');
        $objComplaints->save();
        redirect()->back();
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
        $objUser=User::where('id', "$complaint->user_id")->first();

        $arrEmployees=EmployeeAvailability::with('employee')->where('available_status', '1')->where('onWork', '!=', '1')->get();

        return view('admin.complaints.edit', ['objComplaints' => $complaint, 'output' =>$output, 'arrEmployees'=>$arrEmployees, 'objUser'=>$objUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Complaint  $complaint
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'location' => 'required',
            'expdate'   => 'required',
            'priority' => 'required',
            'material'   => 'required',
            'image' => 'required|image|max:2048',
        ]);

        $objComplaints = Complaint::findOrFail($id);
        $objComplaints->location = $request->location;
        $objComplaints->expected_date = $request->expdate;
        $objComplaints->priority = $request->priority;
        $objComplaints->maerials = $request->material;
        $objComplaints->user_id  = $request->user;
        $objComplaints->employee_id  = $request->assignedto;
        $objComplaints->complaints = json_encode($request->get('complaint'));
        if($request->file('image')){
            $objComplaints->image = $request->file('image')->store('complaint');
        }
        $objComplaints->save();
        return redirect()->back()->with('Complaints Updated');
    }

}
