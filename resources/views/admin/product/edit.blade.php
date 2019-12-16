@extends('admin.admin_template')
@section('content')
<form method="post" action="{{ url('admin/edit/product/'.$objProduct->id) }}" enctype="multipart/form-data">
    <div class="box-body">
        @csrf
        <input type="text"  id="id" name="asset_name" {{isset($objProduct->product_name)?$objProduct->product_name:''}} >
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
    @stop
