@extends('admin.admin_template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Delivery Challan</h3>
        </div>
        <div class="left">
            <a href="{{ url('admin/delivery/create') }}" class="btn btn-info">Add New </a>
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
                                    style="width: 160px;">Challan ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 207px;">Challan Date
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 207px;">Download/View Challan
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 207px;">Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($arrObjChallan as  $objChallan)
                                <tr>
                                    <td>{{$objChallan->id}}</td>
                                    <td>{{$objChallan->challan_date}}</td>
                                    <td>
                                        <a href="{{url("/admin/delivery/view/".$objChallan->id)}}" class="btn btn-dark">View</a>
                                        <a href="{{url("/admin/delivery/download/".$objChallan->id)}}" class="btn btn-dark">Download</a>
                                    </td>
                                    <td>
                                        <a href="{{url('admin/delivery/edit/'.$objChallan->id)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('admin/delivery/delete/'.$objChallan->id)}}" class="btn btn-danger">
                                         Delete
                                        </a>
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
