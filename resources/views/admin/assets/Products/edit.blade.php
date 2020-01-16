@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit AssetProduct</div>
                    <div class="card-body">
<form method="post" action="{{ url('admin/asset/edit/product/'.$objAssetProduct->id) }}" enctype="multipart/form-data">
    <div class="box-body">
        @csrf
        <div class="form-group">
            <label for="name">Product Name*</label>
        <input type="text"  id="id" name="product_name" {{isset($objAssetProduct->product_name)?$objAssetProduct->product_name:''}} >
        </div>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
