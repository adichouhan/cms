@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-2">Go Back</div>
            <div class="col-8 text-center">
                <div class=""><h3>View Booked Complaints</h3></div>
                <div>please check options below</div>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row pt-5">
            <div class="col-2"></div>
            <div class="col-8">

                <table>
                    <tr>
                        <th>Compleint ID</th>
                        <th>Compleints</th>
                        <th>Location</th>
                        <th>Expected Date</th>
                        <th>Priority</th>
                        <th>Material</th>
                        <th>Action</th>
                    </tr>
                    @foreach($arrObjComplaints as $objComplaint)
                    <tr>
                        <td>{{$objComplaint->id}}</td>
                        <td>
                            @if(json_decode($objComplaint->complaints) != null || json_decode($objComplaint->complaints) != '')
                                @foreach(json_decode($objComplaint->complaints) as $index =>$objComplaints)
                                    <div>{{$index}} {{$objComplaints->name}}{{$objComplaints->main}}{{$objComplaints->sub}}</div>

                                @endforeach
                            @endif
                        </td>
                        <td>{{$objComplaint->location}}</td>
                        <td>{{$objComplaint->expected_date}}</td>
                        <td>{{$objComplaint->priority}}</td>
                        <td>{{$objComplaint->maerials}}</td>
                        <td><a href="{{url('edit',$objComplaint->id)}}" class="btn btn-warning" title="Edit product"><i
                                    class="fa fa-edit"></i></a>
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
