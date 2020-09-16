@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                        <form method="post" autocomplete="off" action="{{ url('/admin/employee/store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="date">Employee Name</label>
                                <input type="text" class="form-control" name="name"
                                       id="date" placeholder="Enter name here...">
                            </div>
                            <br>
                            <div class="form-group">
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
                                <input type="number" class="form-control" name="mobile_no"
                                       id="mobile_no" min="10" placeholder="Enter Mobile number here...">
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit"  class="btn btn-primary" >Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
