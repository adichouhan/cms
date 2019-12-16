@extends('admin.admin_template')
@section('content')
<form method="post" action="{{ url('admin/add/product') }}" enctype="multipart/form-data">
    <div class="box-body">
        @csrf
        <input type="text"  id="id" name="product_name" >
        <input type="number"  id="id" name="product_unit" >
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
@stop
