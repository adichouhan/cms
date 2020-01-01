@extends('admin.admin_template')
@section('content')
<form method="post" action="{{ url('admin/asset/product/store') }}" enctype="multipart/form-data">
    <div class="box-body">
        @csrf
        <div class="form-group">
            <label for="name">Product Name*</label>
           <input type="text" id="product_name" name="product_name" >
        </div>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
@stop
