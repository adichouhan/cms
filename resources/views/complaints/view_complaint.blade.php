@extends('layouts.app')
@section('content')

        <div class="text-center">
                <div class="text-center"><h3>View Booked Complaints</h3></div>
            </div>

        <div class="row pt-5">
            <div class="col-2"></div>
            <div class="col-8">

                <table id="example2" class="table table-bordered table-striped dataTable" role="grid"
                       aria-describedby="example1_info">
                    <table id="example2" class="table table-bordered table-striped dataTable" role="grid"
                           aria-describedby="example1_info">
                        <thead><tr>
                        <th>Complaint ID</th>
                        <th>Complaints</th>
                        <th>Location</th>
                        <th>Expected Date</th>
                        <th>Priority</th>
                        <th>Material</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @if($arrObjComplaints->count() > 0)
                            @foreach($arrObjComplaints as $objComplaint)
                                <tr>
                                    <td>{{$objComplaint->id}}</td>
                                    <td>
                                        @if(json_decode($objComplaint->complaints) != NULL || json_decode($objComplaint->complaints) != '')
                                            @foreach(json_decode($objComplaint->complaints) as $index =>$objComplain)

                                                <?php
                                                $category = \App\Category::where('id', $objComplain->main)->first();
                                                $subCategory = \App\SubCategory::where('id', $objComplain->sub)
                                                    ->first();
                                                ?>
                                                <div>{{$index}}.<span>Category :</span>{{isset($category->category_title)?$category->category_title:''}}</div>
                                                <div><span>Sub Category :</span>{{isset($subCategory->subcategory_title)?$subCategory->subcategory_title:''}}</div>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{$objComplaint->location}}</td>
                                    <td>{{$objComplaint->expected_date}}</td>
                                    <td>{{$objComplaint->priority}}</td>
                                    <td>{{$objComplaint->maerials}}</td>
                                    <td>
                                        <a href="/complaints/edit/{{$objComplaint->id}}" class="btn btn-primary">Edit</a>
                                        <form action="" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                    <tr>
                        <td colspan="7" class="text-center">No Records Found</td>
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
