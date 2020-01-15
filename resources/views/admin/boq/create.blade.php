@extends('admin.admin_template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">

                <form method="post" action="{{ url('/admin/boq/store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Product Name</label>
                        <input type="text" class="form-control" id="title" name="product_name"
                               placeholder="Enter title..">
                    </div>

                    <div class="form-group">
                        <label for="productunit">Product Unit</label>
                        <input type="number" class="form-control" name="product_unit"
                               id="productunit" >
                    </div>

                    <div class="form-group">
                        <label for="productrate">Product Rate</label>
                        <input type="number" class="form-control" name="product_rate"
                               id="productrate" >
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary" >Submit</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
@stop


