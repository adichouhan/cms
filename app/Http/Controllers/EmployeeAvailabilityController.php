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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
       $arrEmployee=Employee::all();
       return view('admin.employee.availability_status', ['arrEmployee'=>$arrEmployee]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objAvailability=new EmployeeAvailability();
        $objAvailability->employee_id=$request->employee;
        $objAvailability->status=$request->employee;
        $objAvailability->onWork=$request->onwork_status;
        $objAvailability->save();
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
    public function edit(EmployeeAvailability $employeeAvailability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeAvailability  $employeeAvailability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeAvailability $employeeAvailability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeAvailability  $employeeAvailability
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeAvailability $employeeAvailability)
    {
        //
    }
}
