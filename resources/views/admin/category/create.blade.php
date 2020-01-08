@extends('admin.admin_template')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Category</h3>
        </div>
        <div align="left">
            <a href="{{ url('admin/subcategory/create') }}" class="btn btn-info">Add New Subcategory</a>
        </div>
        <div class="card-body">
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
