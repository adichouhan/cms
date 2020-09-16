@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create AssetProduct</div>
                    <div class="card-body">
                        <form method="post" action="{{ url('admin/asset/product/store') }}" enctype="multipart/form-data">
                            <div class="box-body">
                                @csrf
                                <div class="form-group">
                                    <label for="product_name">Product Name*</label>
                                    <input type="text"  class="form-control" id="product_name" name="product_name" >
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
