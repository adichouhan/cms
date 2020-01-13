@extends('admin.admin_template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Supplier List</h3>
        </div>
        <div>
            <a href="{{ url('admin/supplier/create') }}" class="btn btn-info">Add New </a>
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
                                    style="width: 160px;">Supplier ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 207px;">
                                    Supplier Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                    style="width: 135px;">Supplier Email Id
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Supplier Contact No
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($arrObjSupplier as $data)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$data->id}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email_id}}</td>
                                    <td>{{$data->mobile_no}}</td>
                                    <td>
                                        <a href="{{url('admin/supplier/edit/'.$data->id)}}"
                                           class="btn btn-primary"><i class="fa fa-edit">Edit</i></a>
                                        <a href="{{url('admin/supplier/delete/'.$data->id)}}"
                                           class="btn btn-dark"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

