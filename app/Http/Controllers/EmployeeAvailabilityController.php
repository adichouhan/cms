<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeAvailability;
use Illuminate\Http\Request;

class EmployeeAvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objEmployeeAvailability =  EmployeeAvailability::all();
        return view('admin.employee.availability.list', ['arrObjEmployee'=>$objEmployeeAvailability]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
       $arrEmployee = Employee::all();
       return view('admin.employee.availability.create', ['arrEmployee'=>$arrEmployee]);
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
            'employee' => 'required',
        ]);
        $objAvailability = new EmployeeAvailability();
        $objAvailability->employee_id=$request->employee;
        $objAvailability->available_status=$request->available_status;
        $objAvailability->onWork=$request->onwork_status;
        $objAvailability->save();
        return redirect('/admin/employee/availability')->with('message', 'Employee Availability created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeAvailability  $employeeAvailability
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeAvailability $employeeAvailability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeAvailability  $employeeAvailability
     * @return \Illuminate\Http\Response
     */
    public function edit($id, EmployeeAvailability $employeeAvailability)
    {
        $arrEmployee = Employee::all();
        $objEmployeeAvailability =  EmployeeAvailability::where('id', $id)->first();

        if(!$objEmployeeAvailability){
            return redirect('/admin/employee/availability');
        }

        return view('admin.employee.availability.edit', ['arrEmployee'=>$arrEmployee, 'objEmployeeAvailability' => $objEmployeeAvailability]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeAvailability  $employeeAvailability
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $objEmployeeAvailability =  EmployeeAvailability::where('id', $id)->first();
        $request->validate([
            'employee' => 'required',
        ]);
        $objEmployeeAvailability->employee_id=$request->employee;
        $objEmployeeAvailability->available_status=$request->available_status;
        $objEmployeeAvailability->onWork=$request->onwork_status;
        $objEmployeeAvailability->save();
        return redirect('/admin/employee/availability')->with('message', 'Employee Availability created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeAvailability  $employeeAvailability
     * @return \Illuminate\Http\Response
     */
    public function delete($id, EmployeeAvailability $employeeAvailability)
    {
        $objEmployeeAvailability =  EmployeeAvailability::where('id', $id)->first();
        if(!$objEmployeeAvailability){
            return redirect('/admin/employee/availability');
        }

        $objEmployeeAvailability->delete();

    }
}
