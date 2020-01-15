@extends('admin.admin_template')
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Employee Form</h3>
        </div>

        <!-- /.box-header -->
        <!-- form start -->

        <form  method="post" autocomplete="off" action="{{ url('/admin/employee/update') }}"  enctype="multipart/form-data">
            @csrf
            <input type="hidden"  id="id" name="id"  value="{{$objEmployee->id}}">
            <div class="box-body">
                <div class="form-group">
                    <label for="employeename" class="col-sm-2 control-label">Employee Name</label>

                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{isset($objEmployee->name)?$objEmployee->name:''}}" id="employeename" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label>Select</label>
                    <select class="form-control" name="role">
                        <option value="{{isset($objEmployee->role) && $objEmployee->role == 'manager'?'selected':''}}">Manager</option>
                        <option value="{{isset($objEmployee->role) && $objEmployee->role == 'employee'?'selected':''}}">Employee</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Employee Email Id</label>
                    <input type="email" class="form-control" name="email_id" value="{{$objEmployee->email_id}}"
                           id="email" placeholder="Ex. name@gmail.com">
                </div>
                <br>
                <div class="form-group">
                    <label for="mobile_no">Employee Mobile Number</label>
                    <input type="text" class="form-control" name="mobile_no" value="{{$objEmployee->mobile_no}}"
                           id="mobile_no" placeholder="enter name here...">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button  class="btn btn-outline-success">Update</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection
