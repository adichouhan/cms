@extends('admin.admin_template')
@section('content')
<form method="post"autocomplete="off"  action="{{ url('admin/edit/product/'.$objProduct->id) }}" enctype="multipart/form-data">
    <div class="box-body">
        @csrf
        <input type="text"  id="id" name="asset_name" {{isset($objProduct->product_name)?$objProduct->product_name:''}} >
        <div class="form-group">
            <label for="name">Product Name*</label>
            <input type="text"  id="name" value="{{isset($objProduct->product_name)?$objProduct->product_name:''}}" name="product_name" >
        </div>
        <div class="form-group">
            <label for="unit">Product Unit*</label>
            <input type="number"  id="unit"  value="{{isset($objProduct->product_unit)?$objProduct->product_unit:''}}" name="product_unit" >
        </div>
        <div class="form-group">
            <label for="cost">Product Cost*</label>
            <input type="number"  id="cost"  value="{{isset($objProduct->product_cost)?$objProduct->product_cost:''}}" name="product_cost" >
        </div>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
@stop
