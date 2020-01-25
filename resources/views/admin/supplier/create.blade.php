@extends('admin.admin_template')
@section('content')
    <div class="container card">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Supplier Form</h3>
            </div>
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
            <form method="post" autocomplete="off" action="{{ url('/admin/supplier/store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="supplier">Supplier Name</label>
                    <input type="text" class="form-control" name="name"
                           id="supplier" placeholder="Enter name here...">
                </div>
                <div class="form-group">
                    <label for="email">Supplier Email Id</label>
                    <input type="email" class="form-control" name="email_id"
                           id="email" placeholder="Ex. name@gmail.com">
                </div>
                <br>

                <div class="form-group">
                    <label for="extra_data">Extra Data</label>
                    <textarea type="text" class="form-control" name="extra_data"
                           id="extra_data" placeholder="Extra Data...."></textarea>
                </div>
                <br>

                <div class="form-group">
                    <label for="mobile_no">Supplier Mobile Number</label>
                    <input type="text" class="form-control" name="mobile_no"
                           id="mobile_no" placeholder="Enter mobile no here...">
                </div>
                <br>
                <div class="form-group">
                    <button type="submit"  class="btn btn-primary" >Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
