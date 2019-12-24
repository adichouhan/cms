<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrObjEmployee = Employee::all();
        return view('admin.employee.list',['arrObjEmployee' => $arrObjEmployee]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
       return view('admin.employee.create');
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
            'name' => 'required',
            'role'   => 'required',
            'email_id' => 'required',
            'mobile_no'   => 'required',
        ]);

        $objEmployee = new Employee();
        $objEmployee->name = $request->name;
        $objEmployee->role = $request->role;
        $objEmployee->email_id = $request->email_id;
        $objEmployee->mobile_no = $request->mobile_no;
        $objEmployee->save();

        return redirect('admin/employee')->with('Employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objEmployee = Employee::findorfail($id);
        return view('/admin/employee/edit', ['objEmployee'=>$objEmployee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'role'   => 'required',
            'email_id' => 'required',
            'mobile_no'   => 'required',
        ]);
        $objEmployee = Employee::findorfail($request->id);
        $objEmployee->name = $request->name;
        $objEmployee->role = $request->role;
        $objEmployee->email_id = $request->email_id;
        $objEmployee->mobile_no = $request->mobile_no;
        $objEmployee->save();
        return redirect('/admin/employee')->with('Employee created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objEmployee = Employee::findorfail($id);
        $objEmployee->delete();
        return redirect('/admin/employee')->with('Employee created successfully');
    }


}
