@extends('admin.admin_template')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Employee Availability Status</h3>
        </div>

        <!-- /.box-header -->
        <!-- form start -->
        <form  method="post" action="/admin/employee/availability/store"  enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Employee</label>
                    <select class="form-control" name="employee" required>
                        <option>Select Employee</option>
                        @foreach($arrEmployee as $employee)
                            <option value={{$employee->id}}>{{$employee->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Availble Status</label>
                    <select class="form-control" name="available_status" required>
                        <option>Select Availability</option>
                        <option value=1>Available</option>
                        <option value=0>UnAvailable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>OnWork Status</label>
                    <select class="form-control" name="onwork_status" required>
                        <option>Select isOnwork</option>
                        <option value=1>yes</option>
                        <option value=0>no</option>
                    </select>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button  class="btn btn-default">Submit</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection

