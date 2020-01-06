@extends('admin.admin_template')
@section('content')
    <div class="container">
    <div class="box-body card">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
    <form method="post" action="{{ url('admin/category/store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Category Name*</label>
                <input type="text"  id="name" required name="category_name" >
            </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
            </div>
        </div>
    </div>
    </div>
@stop
