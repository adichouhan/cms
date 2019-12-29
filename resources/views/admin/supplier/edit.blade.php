@extends('admin.admin_template')
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Employee Form</h3>
        </div>

        <!-- /.box-header -->
        <!-- form start -->

        <form  method="post" action="{{ url('/admin/supplier/update') }}"  enctype="multipart/form-data">
            @csrf
            <input type="hidden"  id="id" name="id"  value="{{$objSupplier->id}}">
            <div class="box-body">
                <div class="form-group">
                    <label for="suppliername" class="col-sm-2 control-label">Supplier Name</label>

                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{isset($objSupplier->name)?$objSupplier->name:''}}" id="suppliername" placeholder="Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Supplier Email Id</label>
                    <input type="email" class="form-control" name="email_id" value="{{$objSupplier->email_id}}"
                           id="email" placeholder="Ex. name@gmail.com">
                </div>
                <br>
                <div class="form-group">
                    <label for="mobile_no">Supplier Mobile Number</label>
                    <input type="text" class="form-control" name="mobile_no" value="{{$objSupplier->mobile_no}}"
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