@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Category</div>
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

                                <form method="post" action="{{ url('admin/category/edit/'.$objCategory->id) }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Category Name*</label>
                                        <input type="text"  id="name" required value="{{isset($objCategory->category_title) ? $objCategory->category_title : ''}}" name="category_name" >
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
@stop
