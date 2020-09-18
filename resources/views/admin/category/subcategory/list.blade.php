@extends('admin.admin_template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sub Category List</h3>
        </div>
        <div align="row">
            <div class="col-md-10 col-sm-10"></div>
            <div class="col-md-2 col-sm-2">
            <a href="{{ url('admin/subcategory/create') }}" class="btn btn-info pull-right">Add Sub-Category</a>

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
                                    style="width: 160px;">Sub-Category ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Sub-Category Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Parent Category Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                   Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($arrObjSubCategory as $objSubCategory)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$objSubCategory->id}}</td>
                                    <td>
                                        {{$objSubCategory->category_title}}
                                    </td>
                                    <td>
                                    @if(isset($objSubCategory->parent_id))
                                    <?php
                                        $objParentCategory=\App\Category::where('id', $objSubCategory->parent_id)->first();
                                        ?>
                                        {{isset($objParentCategory->category_title)?$objParentCategory->category_title:'NA'}}
                                            @else
                                        'NA'
                                            @endif
                                    </td>
                                    <td>
                                        <a href="{{url('admin/subcategory/edit/'.$objSubCategory->id)}}"
                                           class="btn btn-primary">Edit</a>
                                        <a href="{{url('admin/subcategory/delete/'.$objSubCategory->id)}}"
                                           class="btn btn-danger">Delete</a>
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

