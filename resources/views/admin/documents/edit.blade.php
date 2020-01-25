@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Documents</div>
                    <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" autocomplete="off" action="{{ url('admin/document/update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden"  id="id" name="id"  value="{{$objDocuments->id}}">
                    <div class="form-group">
                        <label for="title">Document Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{isset($objDocuments->name)?$objDocuments->name:''}}"
                               placeholder="Enter title..">
                    </div>
                    <div class="form-group">
                        <label for="expirydate">Expiry Date</label>
                        <input type="datetime-local" class="form-control" name="expirydate" value="{{$objDocuments->expiry_date}}"
                               id="expirydate" >
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Select File</label>
                        {{--                        <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" >--}}
                        <input type="file" name="file" />
                    </div>

                    <br>
                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary" >Submit</button>
                    </div>

                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
@stop


