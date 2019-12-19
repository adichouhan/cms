@extends('admin.admin_template')
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Employee Form</h3>
        </div>
        
        <!-- /.box-header -->
        <!-- form start -->
        <form  method="post" action="/admin/employee/edit"  enctype="multipart/form-data">
            @csrf
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
            
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button  class="btn btn-default">Submit</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection
