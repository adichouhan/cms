@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Boq</div>
                    <div class="card-body">
                <form method="post" action="{{ url('/admin/boq/edit'.$objBoq->id) }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Product Name</label>
                        <input type="text" class="form-control" id="title" name="product_name"
                              value="{{isset($objBoq->product_name)?$objBoq->product_name:''}}" placeholder="Enter title..">
                    </div>

                    <div class="form-group">
                        <label for="productunit">Product Unit</label>
                        <input value="{{$objBoq->product_unit?$objBoq->product_unit:''}}" type="number" class="form-control" name="product_unit"
                               id="productunit" >
                    </div>

                    <div class="form-group">
                        <label for="productrate">Product Rate</label>
                        <input value="{{$objBoq->product_rate?$objBoq->product_rate:''}}" type="number" class="form-control" name="product_rate"
                               id="productrate" >
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary" >Submit</button>
                    </div>

                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
@stop


