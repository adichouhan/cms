@extends('layouts.app')
@section('content')

        <div class="row ">
            <div class="col-12 text-center">
                <h3>View Booked Assets</h3>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row pt-5">
            <div class="col-2"></div>
            <div class="col-8">

                <table id="example2" class="table table-bordered table-striped dataTable" role="grid"
                       aria-describedby="example1_info">
                    <table id="example2" class="table table-bordered table-striped dataTable" role="grid"
                           aria-describedby="example1_info">
                        <tr>
                        <th>Asset ID</th>
                        <th>Products</th>
                        <th>Location</th>
                        <th>Expected Date</th>
                        <th>Priority</th>
                        <th>Material</th>
                        <th>Action</th>
                    </tr>
                    @if($arrObjAssets->count() > 0)
                    @foreach($arrObjAssets as $objAsset)
                        <tr>
                            <td>{{$objAsset->id}}</td>
                            <td>{{$objAsset->title}} </td>
                            <td>{{$objAsset->location}}</td>
                            <td>{{$objAsset->expected_date}}</td>
                            <td>{{$objAsset->priority}}</td>
                            <td>{{$objAsset->materials}}</td>
                            <td>
                                <a href="{{url('edit/asset',$objAsset->id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{url('delete/asset',$objAsset->id)}}" class="btn btn-danger">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7">No Records Found</td>
                    </tr>
                        @endif
                </table>

            </div>
            <div class="col-2"></div>
        </div>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
@stop
