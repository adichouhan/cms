@extends('admin.admin_template')

@section('content')
    <div class="container ">
        <div class="justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Create Employee Availabity</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Employee Availability Status</h3>
                            </div>

                            <!-- /.box-header -->
                            <!-- form start -->
                            <form method="post" action="{{url('/admin/employee/availability/edit/'.$objEmployeeAvailability->id)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <select class="form-control" name="employee" required>
                                            <option>Select Employee</option>
                                            @foreach($arrEmployee as $employee)
                                                <option @if($objEmployeeAvailability->employee_id == $employee->id) selected="selected"  @endif value={{$employee->id}}>{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="available_status">Available Status</label>
                                        <select id="available_status" class="form-control" name="available_status" required>
                                            <option>Select Availability</option>
                                            <option @if($objEmployeeAvailability->available_status == 1) selected="selected" @endif value=1>Available</option>
                                            <option  @if($objEmployeeAvailability->available_status == 0) selected="selected" @endif value=0>UnAvailable</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="onwork_status">OnWork Status</label>
                                        <select class="form-control" id="onwork_status" name="onwork_status" required>
                                            <option>Select Employee is Onwork</option>
                                            <option  @if($objEmployeeAvailability->onWork == 1) selected="selected" @endif value=1 >yes</option>
                                            <option @if($objEmployeeAvailability->onWork == 0) selected="selected" @endif value=0 >no</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button class="btn btn-default">Submit</button>
                                </div>
                                <!-- /.box-footer -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

