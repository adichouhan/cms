@extends('admin.admin_template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Complaints</h3>
        </div>
        <div align="left">
            <a href="{{ url('admin/category/create') }}" class="btn btn-info">Add category</a>
            <a href="{{ url('admin/subcategory/') }}" class="btn btn-info">SubCategory</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width: 160px;">Category ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Category Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($arrObjCategory as $objCategory)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$objCategory->id}}</td>
                                    <td>
                                        {{$objCategory->category_title}}
                                    </td>
                                    <td>
                                        <a href="{{url('admin/category/edit/'.$objCategory->id)}}"
                                           class="btn btn-primary">Edit</a>
                                        <a href="{{url('admin/category/delete/'.$objCategory->id)}}"
                                           class="btn btn-primary">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

