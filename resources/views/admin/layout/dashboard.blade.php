@extends('admin.admin_template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Complaints</h3>
        </div>
        <div align="left">
            <a href="{{ url('admin/complaints/create') }}" class="btn btn-info">Add New </a>
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
                                    style="width: 100px;">Complaint ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 207px;">
                                    Complaints
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 150px;">
                                    Location
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                    style="width: 135px;">Expected Date
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 80px;">
                                    Priority
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Material
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 250px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($arrObjComplaints->count()>0)
                                @foreach($arrObjComplaints as $objComplaints)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{$objComplaints->id}}</td>
                                        <td>
                                         {{$objComplaints->title}}
                                        </td>
                                        <td>{{$objComplaints->location}}</td>
                                        <td>{{$objComplaints->expected_date}}</td>
                                        <td>{{$objComplaints->priority}}</td>
                                        <td>{{$objComplaints->materials}}</td>
                                        <td>
                                            <a href="{{url('admin/complaints/edit/'.$objComplaints->id)}}"
                                               class="btn btn-primary">Edit</a>
                                            <a class="btn btn-danger"  href="{{url('admin/complaints/delete/'.$objComplaints->id)}}"
                                            >Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center"> No Records found</td>
                                </tr>
                            @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 100px;">Assets ID
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" style="width: 207px;">
                                        Assets
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending" style="width: 183px;">
                                        Location
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending"
                                        style="width: 135px;">Expected Date
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                        Priority
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                        Material
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" style="width:200px;">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($arrObjAssets->count()>0)
                                    @foreach($arrObjAssets as $objasset)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{$objasset->id}}</td>
                                            <td>
                                                {{$objasset->title}}
                                            </td>
                                            <td>{{$objasset->location}}</td>
                                            <td>{{$objasset->expected_date}}</td>
                                            <td>{{$objasset->priority}}</td>
                                            <td>{{$objasset->materials}}</td>
                                            <td>
                                                <a href="{{url('admin/assets/edit/'.$objasset->id)}}"
                                                   class="btn btn-primary">Edit</a>
                                                <a href="{{url('admin/assets/delete/'.$objasset->id)}}"
                                                   class="btn btn-danger">Delete</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center"> No Records found</td>
                                    </tr>
                                @endif
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
        </div>
        <!-- /.card-body -->

    </div>
@endsection

