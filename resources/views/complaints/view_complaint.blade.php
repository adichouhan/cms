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
                        <th>Complaint ID</th>
                        <th>Complaints</th>
                        <th>Location</th>
                        <th>Expected Date</th>
                        <th>Priority</th>
                        <th>Material</th>
                        <th>Action</th>
                    </tr>
                    @foreach($arrObjComplaints as $objComplaint)
                    <tr>
                        <td>{{$objComplaint->id}}</td>
                        <td>    @if(json_decode($objComplaint->complaints) != null || json_decode($objComplaint->complaints) != '')
                                @foreach(json_decode($objComplaint->complaints) as $index =>$objComplain)
                                    {{$index}}
                                    <?php
                                    $category=\App\Category::where('id', $objComplain->main)->first();
                                    $subCategory=\App\SubCategory::where('id', $objComplain->sub)->first();
                                    ?>
                                    {{$category->category_title}}:{{$subCategory->subcategory_title}}
                                @endforeach
                            @endif
                        </td>
                        <td>{{$objComplaint->location}}</td>
                        <td>{{$objComplaint->expected_date}}</td>
                        <td>{{$objComplaint->priority}}</td>
                        <td>{{$objComplaint->maerials}}</td>
                        <td>
                            <a href="{{ route('contacts.edit',$contact->id)}}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('contacts.destroy', $contact->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
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
