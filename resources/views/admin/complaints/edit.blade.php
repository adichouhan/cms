@extends('admin.admin_template')
@section('content')
    <script>
        function accept() {
            $('#reject').css({ display: "none" });
            $('#accept').css({ display: "block" });
        }
        function reject() {
            $('#accept').css({ display: "none" });
            $('#reject').css({ display: "block" });
        }
    </script>
    <div class="container ">
        <div class="justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Edit Complaint</div>
                    <div class="card-body">
                        <?php
                        $count = 0;
                        $arrComplaint = [];
                        if (!empty($objComplaints->complaints)) {
                            foreach (json_decode($objComplaints->complaints) as $complaint) {
                                array_push($arrComplaint, $complaint);
                            }
                        }
                        ?>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" autocomplete="off" action="{{ url('/admin/update/complaint/'.$objComplaints->id) }}" enctype="multipart/form-data">
                            <div class="box-body">
                                @csrf

                                <div class="form-group">
                                    <label for="title">Title </label>
                                    <input type="text" class="form-control"
                                           name="title" value="{{ $objComplaints->title }}" id="title" required placeholder="">
                                </div>

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

                                    $data = \App\Category::where('parent_id', $complaint->main)->get();

                                    $selectedSubCat = '';
                                    foreach ($data as $item) {
                                        $selectedSubCat .= '<option value="' . $item["id"] . '"';
                                        if ($complaint->sub == $item["id"]) {
                                            $selectedSubCat .= 'selected >' . $item["category_title"] . '</option>';
                                        } else {
                                            $selectedSubCat .= '>' . $item["category_title"] . '</option>';
                                        }

                                    }

                                    ?>
                                    <div class="addedSection">
                                        <div class="form-group"><select  required name="complaint[{{$count}}][main]"
                                                                         class="form-control item_category"
                                                                         data-sub_category_id="{{$count}}">
                                                <option value="">Select Category</option>{!! $selectedCat !!}</select>
                                        </div>
                                        <div class="form-group"><select name="complaint[{{$count}}][sub]" class="form-control item_sub_category"
                                                                        id="item_sub_category{{$count}}">
                                                <option value="">Select Sub Category</option>{!! $selectedSubCat !!}</select>
                                        </div>
                                        <div class="form-group"><input type="text" name="complaint[{{$count}}][others]"
                                                                    value="{{  $complaint->others }}"   class="form-control item_name"/></div>

                                        <div class="form-group">
                                            <button type="button" name="remove" class="btn btn-danger remove">Remove
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
                                <label for="user">Users</label>
                                <input type="text"  class="form-control search" id="user" value="{{isset($objUser->name) ? $objUser->name : $objUser->name}}" readonly>
                                <input type="hidden" class="form-control search"  id="userId" value="{{isset($objUser->id) ? $objUser->id : $objUser->id}}"  name="user">
                                <div id="userList"></div>

                            </div>
                            <div class="form-group">
                                <label for="location">Location(Branch Name)*</label>
                                <input type="text" class="form-control" id="location"
                                       value="{{ isset($objComplaints->location) ? $objComplaints->location : ''}}" name="location"
                                       placeholder="">
                            </div>

                            <div class="form-group">
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
                                       value="{{\Carbon\Carbon::parse($objComplaints->expected_date)->format('Y-m-d\TH:i')}}"
                                       id="date" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="material">Material(if any)</label>
                                <input type="text" class="form-control"
                                       value="{{ isset($objComplaints->materials)?$objComplaints->materials:''}}"
                                       name="material" id="material" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlFile1">Photo upload</label>
                                <input type="file" name="image" value="{{ isset($objComplaints->image)?$objComplaints->image:'' }}"/>
                                <img src="{{url('/images/'.$objComplaints->image)}}" class="img-thumbnail" width="100"/>
                            </div>

                            <div class="form-group">
                                <button type="button"  class="btn btn-primary" onclick="accept()">Accept</button>
                                <button type="button" class="btn btn-primary reject" onclick="reject()">Reject</button>
                            </div>
                            <div class="form-group" id="reject" style="display:none">
                                <label for="rejectreason">Reject Reason</label>
                                <input type="text" class="form-control"
                                       value="{{ isset($objComplaints->reject_reason) ? $objComplaints->reject_reason : ''}}"
                                       name="rejectreason" id="rejectreason" placeholder="">
                            </div>
                            <div id="accept" style="display: none">
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="work_status">
                                        <option  value="booked" {{(isset($objComplaints->work_status) && $objComplaints->work_status=='booked')? 'selected':'' }}>
                                            Booked
                                        </option>
                                        <option value="processed" {{(isset($objComplaints->work_status) && $objComplaints->work_status=='processed')? 'selected':'' }}>
                                            Processed
                                        </option>
                                        <option value="ongoing" {{(isset($objComplaints->work_status) && $objComplaints->work_status=='ongoing')? 'selected':'' }}>
                                            OnGoing
                                        </option>
                                        <option value="completed" {{(isset($objComplaints->work_status) && $objComplaints->work_status=='completed')? 'selected':'' }}>
                                            Completed
                                        </option>
                                        <option value="rejected" {{(isset($objComplaints->work_status) && $objComplaints->work_status=='rejected')? 'selected':'' }}>
                                            Rejected
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Assigned To</label>
                                    <select id="inputState" class="form-control" name="assignedto">
                                        @foreach($arrEmployees as $employees)
                                            <option value="{{$employees->id}}" {{(isset($objComplaints->employee_id) && $objComplaints->employee_id == $employees->id)? 'selected':'' }}>
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
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var count = {!! count($arrComplaint)>0?count($arrComplaint):0 !!};

            $(document).on('click', '.add', function () {
                count++;
                var html = '';
                html += '<div class="addedSection"> <div class="form-group"><select required name="complaint[' + count + '][main]" class="form-control item_category" data-sub_category_id="' + count + '"><option value="">Select Category</option>{!! $output !!}</select></td></div>';
                html += '<div class="form-group"><select name="complaint[' + count + '][sub]" class="form-control item_sub_category" id="item_sub_category' + count + '"><option value="">Select Sub Category</option></select></div>';
                html += '<div class="form-group"><input type="text" name="complaint[' + count + '][others]" class="form-control item_name" /></div>';
                html += '<div class="form-group"><button type="button" name="remove" class="btn btn-danger remove">Remove</button></div></div>';
                $('#addsection').append(html);
            });

            $(document).on('click', '.remove', function () {
                $(this).closest('.addedSection').remove();
                // $("div.addedSection").first().remove()
            });


            $(document).on('keyup', '.search', function () {
                var type = $(this).data('type');
                var query = $(this).val();

                if(query != '') {
                    $.ajax({
                        url: "/fetch",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "type": type,
                            'query':query
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            autocomplete(type, data);
                        }
                    })

                }
            });

            function autocomplete(type, data) {
                var htmlComplaint = '';
                htmlComplaint += '<ul class="dropdown-menu" style="display:block; position:relative">';

                if(type == 'user'){
                    if(data.length>0) {
                        data.forEach(function (user) {
                            htmlComplaint += '<li class="user" data-id="' + user.id + '">' + user.name + '</li> ';
                        })
                    }else{
                        htmlComplaint += '<li class="user"><a href="/admin/user/create">Add New User</a></li> ';
                    }
                    $('#userList').children().remove();
                    $('#userList').append(htmlComplaint);
                }
            }

            $(document).on('click', 'li.user', function(){
                $('#user').val($(this).text());
                $('#userId').val($(this).data('id'));
                $('#userList').fadeOut();
            });

            $(document).on('change', '.item_category', function () {
                var category_id = $(this).val();

                var sub_category_id = $(this).data('sub_category_id');
                $.ajax({
                    url: "/search-category",
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
        });
    </script>
@stop


