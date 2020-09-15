@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Employee Availabilty</div>
                    <div class="card-body">
        <!-- form start -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form  method="post" autocomplete="off" action="{{ url('/admin/employee/update') }}"  enctype="multipart/form-data">
            @csrf
            <input type="hidden"  id="id" name="id"  value="{{$objEmployee->id}}">
            <div class="box-body">
                <div class="form-group">
                    <label for="employeename" class="col-sm-2 control-label">Employee Name</label>

                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{isset($objEmployee->name)?$objEmployee->name:''}}"  id="employeename" placeholder="Enter name here..">
                    </div>
                </div>
                <div class="form-group">
                    <label>Select</label>
                    <select class="form-control" name="role">
                        <option value="" >select role</option>
                        <option value="employee" {{isset($objEmployee->role) && $objEmployee->role == 'employee' ? 'selected':''}} >Employee</option>
                        <option value="manager" {{isset($objEmployee->role) && $objEmployee->role == 'manager'  ? 'selected':''}} >Manager</option>
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
                    <input type="number" class="form-control" name="mobile_no" value="{{$objEmployee->mobile_no}}"
                           id="mobile_no"  min="10" placeholder="Enter Mobile number here...">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button  class="btn btn-primary">Update</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection
