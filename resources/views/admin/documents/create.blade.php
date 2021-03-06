@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Create Documents</div>
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
                <form method="post" autocomplete="off" action="{{ url('/admin/document/stored') }}" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label for="title">Document Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Enter title..">
                    </div>
                    <div class="form-group">
                        <label for="expirydate">Expiry Date</label>
                        <input type="datetime-local" class="form-control" name="expirydate"
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


