@extends('admin.admin_template')
@section('content')
    <button class="btn btn-primary"></button>
    <div class="box-body">
    <form method="post" action="{{ url('admin/category/store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Category Name*</label>
                <input type="text"  id="name" required name="category_name" >
            </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>
@stop
