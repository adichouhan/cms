@extends('admin.admin_template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">

                <form method="post" action="{{ url('/admin/edit/assets/') }}" enctype="multipart/form-data">
                    @csrf
                    <button type="button" class="btn btn-dark add">Add Issue</button>
                    <div class="form-group">
                        <label for="inputState">Users</label>
                        <select id="inputState" class="form-control" name="user">
                            @foreach($arrObjUser as $objUser)
                                <option
                                    value="{{$objUser->id}}" >
                                    {{$objUser->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputState">Users</label>
                        <select id="inputState" class="form-control" name="user">
                            @foreach($arrObjProduct as $objProduct)
                                <option
                                    value="{{$objProduct->id}}" >
                                    {{$objProduct->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location">Location(Branch Name)*</label>
                        <input type="text" class="form-control" id="location"
                               name="location"
                               placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Priority</label>
                        <select id="inputState" class="form-control" name="priority">
                            <option
                                value="low" >
                                Low
                            </option>
                            <option
                                value="medium" >
                                Medium
                            </option>
                            <option
                                value="high" >
                                High
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Expected Date</label>
                        <input type="datetime-local" class="form-control" name="expdate"
                               id="date" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="material">Material(if any)</label>
                        <input type="text" class="form-control"
                               name="material" id="material" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">photo upload</label>
                        {{--                        <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" >--}}
                        <input type="file" name="image" value="{{ $objComplaints->image }}"/>
                        <img src="{{asset($objComplaints->image)}}" class="img-thumbnail" width="100"/>
                        <input type="hidden" name="hidden_image" value="{{ $objComplaints->image }}"/>
                    </div>

                    <button type="button"  class="btn btn-primary" onclick="myFunction()">Accept</button>
                    <button type="button" class="btn btn-primary reject" onclick="reject()">Reject</button>

                    <div class="form-group" id="reject" style="display:none">
                        <label for="rejectreason">Reject Reason</label>
                        <input type="text" class="form-control"
                               value="{{isset($objComplaints->rejectReason)?$objComplaints->rejectReason:''}}"
                               name="rejectreason" id="rejectreason" placeholder="">
                    </div>
                    <div id="accept" style="display: none">
                        <div class="form-group col-md-4">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option
                                    value="booked" {{(isset($objComplaints->status) && $objComplaints->priority=='booked')? 'selected':'' }}>
                                    Booked
                                </option>
                                <option
                                    value="processed" {{(isset($objComplaints->priority) && $objComplaints->priority=='processed')? 'selected':'' }}>
                                    Processed
                                </option>
                                <option
                                    value="ongoing" {{(isset($objComplaints->priority) && $objComplaints->priority=='ongoing')? 'selected':'' }}>
                                    OnGoing
                                </option>
                                <option
                                    value="completed" {{(isset($objComplaints->priority) && $objComplaints->priority=='completed')? 'selected':'' }}>
                                    Completed
                                </option>
                                <option
                                    value="rejected" {{(isset($objComplaints->priority) && $objComplaints->priority=='rejected')? 'selected':'' }}>
                                    Rejected
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputState">Assigned To</label>
                            <select id="inputState" class="form-control" name="assignedto">
                                @foreach($arrEmployees as $employees)
                                    <option
                                        value="employee" {{(isset($employees->id))? 'selected':'' }}>
                                        {{$employees->employee->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary" >Submit</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
@stop


