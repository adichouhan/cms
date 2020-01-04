
@extends('admin.admin_template')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Products</h3>
    </div>
    <div class="left">
        <a href="{{ url('admin/product/create') }}" class="btn btn-info">Add New </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length"
                                                                                            aria-controls="example1"
                                                                                            class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries</label></div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                                                             class="form-control form-control-sm"
                                                                                             placeholder=""
                                                                                             aria-controls="example1"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-striped dataTable" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                                style="width: 160px;">Product ID
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending" style="width: 207px;">Product Name
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending" style="width: 207px;">Product Unit
                            </th>
{{--                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"--}}
{{--                                aria-label="Browser: activate to sort column ascending" style="width: 207px;">Action--}}
{{--                            </th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($arrObjProduct as  $assetProduct)
                                <tr>
                                    <td>{{$assetProduct->id}}</td>
                                    <td>{{$assetProduct->product_name}}</td>
                                    <td>{{$assetProduct->product_unit}}</td>
{{--                                    <td>--}}
{{--                                        <a href="{{url('admin/product/edit/'.$assetProduct->id)}}" class="btn btn-primary">Edit</a>--}}
{{--                                        <form action="{{url('admin/product/delete/'.$assetProduct->id)}}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button class="btn btn-danger" type="submit">Delete</button>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
