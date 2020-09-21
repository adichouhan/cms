@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Create Boq</div>
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
                        <form method="post" action="{{ url('/admin/boq/store') }}" autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Product Name</label>
                                <input type="text" class="form-control" id="title" name="product_name"
                                       placeholder="Enter title..">
                            </div>

                            <div class="form-group">
                                <label for="productunit">Product Unit</label>
                                <input type="number" class="form-control" name="product_unit"
                                       id="productunit">
                            </div>

                            <div class="form-group">
                                <label for="productrate">Product Rate</label>
                                <input type="number" class="form-control" name="product_rate"
                                       id="productrate">
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


