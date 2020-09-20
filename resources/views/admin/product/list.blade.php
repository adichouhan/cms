
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
                                aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                                style="width: 160px;">Product ID
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending" style="width: 207px;">
                                Product Name
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending" style="width: 207px;">
                                Product Unit
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending" style="width: 207px;">
                                Product Costs
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending" style="width: 207px;">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($arrObjProduct as  $assetProduct)
                                <tr>
                                    <td>{{$assetProduct->id}}</td>
                                    <td>{{$assetProduct->product_name}}</td>
                                    <td>{{$assetProduct->product_unit}}</td>
                                    <td>{{$assetProduct->product_cost}}</td>
                                    <td>
                                        <a href="{{url('admin/product/edit/'.$assetProduct->id)}}" class="m-2 btn btn-primary">Edit</a>
                                        <a href="{{url('admin/product/delete/'.$assetProduct->id)}}" class="m-2 btn btn-danger">Delete</a>

                                    </td>
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
