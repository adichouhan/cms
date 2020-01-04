@extends('admin.admin_template')
@section('content')
    <script>
        function myFunction() {
            console.log('here')
            $('#reject').css({ display: "none" });
            $('#accept').css({ display: "block" });
        }
        function reject() {
            console.log('there')
            $('#accept').css({ display: "none" });
            $('#reject').css({ display: "block" });
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                <?php
                $count = 0;
                $arrComplaint = [];
                if (!empty($objComplaints->complaints)) {
                    foreach (json_decode($objComplaints->complaints) as $complaint) {
                        array_push($arrComplaint, $complaint);
                    }
                }
                ?>

                <form method="post" action="{{ url('/admin/update/complaint/'.$objComplaints->id) }}" enctype="multipart/form-data">
                    <div class="box-body">
                        @csrf

                        @foreach($arrComplaint as $index=>$complaint)
                            <?php
                            $count++;
                            $data = \App\Category::all();
                            $selectedCat = '';
                            foreach ($data as $item) {
                                $selectedCat .= '<option value="' . $item["id"] . '"';
                                if ($complaint->main == $item["id"]) {
                                    $selectedCat .= 'selected >' . $item["category_title"] . '</option>';
                                } else {
                                    $selectedCat .= '>' . $item["category_title"] . '</option>';
                                }

                            }

                            $data = \App\SubCategory::where('parent_id', $complaint->main)->get();

                            $selectedSubCat = '';
                            foreach ($data as $item) {
                                $selectedSubCat .= '<option value="' . $item["id"] . '"';
                                if ($complaint->sub == $item["id"]) {
                                    $selectedSubCat .= 'selected >' . $item["subcategory_title"] . '</option>';
                                } else {
                                    $selectedSubCat .= '>' . $item["subcategory_title"] . '</option>';
                                }

                            }

                            ?>
                            <div class="addedSection">
                                <select name="complaint[{{$count}}][main]"
                                                              class="form-control item_category"
                                                              data-sub_category_id="{{$count}}">
                                    <option value="">Select Category</option>{!! $selectedCat !!}</select>
                                <div><select name="complaint[{{$count}}][sub]" class="form-control item_sub_category"
                                             id="item_sub_category{{$count}}">
                                        <option value="">Select Sub Category</option>{!! $selectedSubCat !!}</select>
                                </div>

                                <div><input type="text" name="complaint[{{$count}}][name]"
                                            class="form-control item_name"/></div>
                                <div>
                                    <button type="button" name="remove" class="btn btn-danger btn-xs remove">Remove
                                    </button>
                                </div>
                            </div>
                                @endforeach

                            <div id="addsection">
                            </div>
                    </div>
                    <div class="form-group">
                    <button type="button" class="btn btn-dark add">Add Issue</button>
                    </div>
                        <div class="form-group">
                        <input type="text" value="{{$objUser->name}}" readonly>
                        <input type="hidden" value="{{$objUser->id}}"  name="user">
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
                                value="low" {{(isset($objComplaints->priority) && $objComplaints->priority=='low')? 'selected':'' }}>
                                Low
                            </option>
                            <option
                                value="medium" {{(isset($objComplaints->priority) && $objComplaints->priority=='medium')? 'selected':'' }}>
                                Medium
                            </option>
                            <option
                                value="high" {{(isset($objComplaints->priority) && $objComplaints->priority=='high')? 'selected':'' }}>
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
<div class="form-group">
                    <button type="button"  class="btn btn-primary" onclick="myFunction()">Accept</button>
                    <button type="button" class="btn btn-primary reject" onclick="reject()">Reject</button>
</div>
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
                                    value="{{$employees->id}}" {{(isset($objComplaints->employee_id) && $objComplaints->employee_id== $employees->id)? 'selected':'' }}>
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
            var count = {!! count($arrComplaint)>0?count($arrComplaint):0 !!};

            $(document).on('click', '.add', function () {
                count++;
                var html = '';

                html += '<div class="addedSection"><div class="form-group"></div><select name="complaint[' + count + '][main]" class="form-control item_category" data-sub_category_id="' + count + '"><option value="">Select Category</option>{!! $output !!}</select></div></td>';
                html += '<div class="form-group"><select name="complaint[' + count + '][sub]" class="form-control item_sub_category" id="item_sub_category' + count + '"><option value="">Select Sub Category</option></select></div>';
                html += '<div class="form-group"><input type="text" name="complaint[' + count + '][name]" class="form-control item_name" /></div>';
                html += '<div class="form-group"><button type="button" name="remove" class="btn btn-danger btn-xs remove">Remove</button></div>';
                $("#addsection").append(html);
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


