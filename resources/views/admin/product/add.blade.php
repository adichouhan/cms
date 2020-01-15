@extends('admin.admin_template')
@section('content')
<form method="post" autocomplete="off" action="{{ url('admin/product/store') }}" enctype="multipart/form-data">
    <div class="box-body">
        @csrf
        <div class="form-group">
            <label for="name">Product Name*</label>
            <input type="text"  id="name" name="product_name" >
        </div>
        <div class="form-group">
            <label for="unit">Product Unit*</label>
            <input type="number"  id="unit" name="product_unit" >
        </div>
        <div class="form-group">
            <label for="cost">Product Cost*</label>
            <input type="number"  id="cost" name="product_cost" >
        </div>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
@stop
