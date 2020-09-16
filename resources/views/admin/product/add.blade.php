@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Create Products</div>
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
                        <form method="post" autocomplete="off" action="{{ url('admin/product/store') }}"
                              enctype="multipart/form-data">
                            <div class="box-body">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Product Name*</label>
                                    <input type="text" class="form-control" id="name" name="product_name">
                                </div>
                                <div class="form-group">
                                    <label for="unit">Product Unit*</label>
                                    <input type="number" class="form-control" id="unit" name="product_unit">
                                </div>
                                <div class="form-group">
                                    <label for="cost">Product Cost*</label>
                                    <input type="number" class="form-control" id="cost" name="product_cost">
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
