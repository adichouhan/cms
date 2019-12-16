@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                @if($type == 'edit')
                    <form method="post" action="{{ url('update/asset') }}" enctype="multipart/form-data">
                        <div class="box-body">
                            @csrf
                            <input type="hidden"  id="id" name="id"  value="{{$objAssets->id}}">
                            <div class="form-group col-md-4">
                                <label for="inputState">Select Products</label>
                                <select id="inputState" class="form-control" name="product">
                                    <option value="low">product 1</option>
                                    <option value="medium">product 2</option>
                                    <option value="high">product 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">Location(Branch Name)*</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="" value="{{$objAssets->location}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Priority</label>
                                <select id="inputState" class="form-control" name="priority">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>}
                            <div class="form-group">
                                <label for="date">Expected Date</label>
                                <input type="datetime-local" class="form-control" name="expdate" id="date" placeholder=""  value="{{$objAssets->expected_date}}">
                            </div>
                            <div class="form-group">
                                <label for="material">Materials</label>
                                <input type="text" class="form-control"  name="material" id="material" placeholder="" value="{{$objAssets->maerials}}">
                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlFile1">Example file input</label>
                                <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                @else
                    <form method="post" action="{{ url('register/asset') }}" enctype="multipart/form-data">
                        <div class="box-body">
                            @csrf
                            <div class="form-group col-md-4">
                                <label for="inputState">Select Products</label>
                                <select id="inputState" class="form-control" name="product">
                                    <option value="low">product 1</option>
                                    <option value="medium">product 2</option>
                                    <option value="high">product 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">Location(Branch Name)*</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Priority</label>
                                <select id="inputState" class="form-control" name="priority">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date">Expected Date</label>
                                <input type="datetime-local" class="form-control" name="expdate" id="date" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="material">Material</label>
                                <input type="text" class="form-control"  name="material" id="material" placeholder="">
                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlFile1">Example file input</label>
                                <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                @endif
            </div>
            <div class="col-3"></div>
        </div>
    </div>

@stop


