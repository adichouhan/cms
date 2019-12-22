@extends('admin.admin_template')
@section('content')
<form method="post" action="{{ url('admin/asset/product/store') }}" enctype="multipart/form-data">
    <div class="box-body">
        @csrf
        <input type="text" id="product_name" name="product_name" >
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
@stop
