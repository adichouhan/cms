@extends('admin.admin_template')
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Employee Form</h3>
        </div>

        <form method="post" autocomplete="off" action="{{ url('/admin/employee/store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date">Employee Name</label>
                <input type="text" class="form-control" name="name"
                       id="date" placeholder="enter name here...">
            </div>
            <br>
            <div class="form-group col-md-4">
                <label for="inputState">Employee Role</label>
                <select id="inputState" class="form-control" name="role">
                    <option value="" >select role</option>
                    <option value="employee" >Employee</option>
                    <option value="manager" >Manager</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="date">Employee Email Id</label>
                <input type="email" class="form-control" name="email_id"
                       id="email" placeholder="Ex. name@gmail.com">
            </div>
            <br>
            <div class="form-group">
                <label for="mobile_no">Employee Mobile Number</label>
                <input type="text" class="form-control" name="mobile_no"
                       id="mobile_no" placeholder="enter name here...">
            </div>
            <br>
            <div class="form-group">
                <button type="submit"  class="btn btn-primary" >Submit</button>
            </div>

        </form>
    </div>
    @endsection
