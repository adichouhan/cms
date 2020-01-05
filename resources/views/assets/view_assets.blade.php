@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-2">Go Back</div>
            <div class="col-8 text-center">
                <div class=""><h3>View Booked Assets</h3></div>
                <div>please check options below</div>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row pt-5">
            <div class="col-2"></div>
            <div class="col-8">

                <table>
                    <tr>
                        <th>Asset ID</th>
                        <th>Products</th>
                        <th>Location</th>
                        <th>Expected Date</th>
                        <th>Priority</th>
                        <th>Material</th>
                        <th>Action</th>
                    </tr>
                    @foreach($arrObjAssets as $objAsset)
                        <tr>
                            <td>{{$objAsset->id}}</td>
                            <td>{{$objAsset->product}} </td>
                            <td>{{$objAsset->location}}</td>
                            <td>{{$objAsset->expected_date}}</td>
                            <td>{{$objAsset->priority}}</td>
                            <td>{{$objAsset->maerials}}</td>
                            <td>
                                <a href="{{url('edit/asset',$objAsset->id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{url('delete/asset',$objAsset->id)}}" class="btn btn-dark">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-2"></div>
        </div>
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
