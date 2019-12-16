@extends('admin.admin_template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">

                <form method="post" action="{{ url('/admin/create/complaint/') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div id="addsection">
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark add">Add Issue</button>
                    <div class="form-group">
                        <label for="inputState">Users</label>
                        <select id="inputState" class="form-control" name="user">
                            @foreach($arrObjUser as $objUser)
                            <option
                                value="{{$objUser->id}}" >
                                {{$objUser->name}}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="location">Location(Branch Name)*</label>
                        <input type="text" class="form-control" id="location"
                               value="{{isset($objComplaints->location)?$objComplaints->location:''}}" name="location"
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
                               value="{{isset($objComplaints->expected_date)?strtotime($objComplaints->expected_date):''}}"
                               id="date" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="material">Material(if any)</label>
                        <input type="text" class="form-control"
                               value="{{isset($objComplaints->maerials)?$objComplaints->maerials:''}}"
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


    <script>
        $(document).ready(function () {
            var count = 0;

            $(document).on('click', '.add', function () {
                count++;
                var html = '';

                html += '<div class="addedSection"><select name="complaint[' + count + '][main]" class="form-control item_category" data-sub_category_id="' + count + '"><option value="">Select Category</option>{!! $output !!}</select></td>';
                html += '<div><select name="complaint[' + count + '][sub]" class="form-control item_sub_category" id="item_sub_category' + count + '"><option value="">Select Sub Category</option></select></div>';
                html += '<div ><input type="text" name="complaint[' + count + '][name]" class="form-control item_name" /></div>';
                html += '<div><button type="button" name="remove" class="btn btn-danger btn-xs remove">Remove</button></div>';
                $('#addsection').append(html);
            });

            $(document).on('click', '.remove', function () {
                $(this).closest('.addedSection').remove();
                // $("div.addedSection").first().remove()
            });

            $(document).on('click', '.accept', function () {

                },

                $(document).on('click', '.reject', function () {
                        console.log('there')
                        $('#accept').css({ display: "none" });
                        $('#reject').css({ display: "block" });
                    },

                    $(document).on('change', '.item_category', function () {
                        var category_id = $(this).val();
                        console.log(category_id);
                        var sub_category_id = $(this).data('sub_category_id');
                        $.ajax({
                            url: "/fill_sub_category",
                            method: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "category_id": category_id
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                var html = '<option value="">Select Sub Category</option>';
                                html += data;
                                $('#item_sub_category' + sub_category_id).html(html);
                            }
                        })
                    });
            $('#insert_form').on('submit', function (event) {
                event.preventDefault();
                var error = '';
                $('.item_name').each(function () {
                    var count = 1;
                    if ($(this).val() == '') {
                        error += '<p>Enter Item name at ' + count + ' Row</p>';
                        return false;
                    }
                    count = count + 1;
                });

                $('.item_category').each(function () {
                    var count = 1;

                    if ($(this).val() == '') {
                        error += '<p>Select Item Category at ' + count + ' row</p>';
                        return false;
                    }

                    count = count + 1;

                });


                $('.item_sub_category').each(function () {

                    var count = 1;

                    if ($(this).val() == '') {
                        error += '<p>Select Item Sub category ' + count + ' Row</p> ';
                        return false;
                    }

                    count = count + 1;

                });

                var form_data = $(this).serialize();

                if (error == '') {
                    $.ajax({
                        url: "insert.php",
                        method: "POST",
                        data: form_data,
                        success: function (data) {
                            if (data == 'ok') {
                                $('#item_table').find('tr:gt(0)').remove();
                                $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
                            }
                        }
                    });
                } else {
                    $('#error').html('<div class="alert alert-danger">' + error + '</div>');
                }
            });
        });
    </script>
@stop


