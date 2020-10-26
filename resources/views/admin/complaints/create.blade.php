@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Create Complaint</div>
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
                    <form method="post" autocomplete="off" action="{{ url('/admin/complaints/create') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <label for="title">Title </label>
                            <input type="text" class="form-control"
                                   name="title" id="title" required placeholder="">
                        </div>

                            <div id="addsection">
                            </div>

                        <button type="button" class="btn btn-primary add">Add Issue</button>

                        <div class="form-group">
                            <label for="user">Users</label>
                            <input type="text" id="user" data-type="user" class="form-control search">
                            <input type="hidden" id="userId" class="form-control search" name="user">
                            <div id="userList"></div>
                        </div>

                        <div class="form-group">
                            <label for="location">Location(Branch Name)*</label>
                            <input type="text" class="form-control" id="location"
                                   name="location"
                                   placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Priority</label>
                            <select id="inputState" class="form-control" name="priority">
                                <option>
                                    Select Priority
                                </option>
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
                            <label for="exampleFormControlFile1">Photo upload</label>
                            <input type="file" name="image" />
                        </div>

                        <div id="accept" >
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option value="">
                                        Select Status
                                    </option>
                                    <option
                                        value="booked">
                                        Booked
                                    </option>
                                    <option
                                        value="processed" >
                                        Processed
                                    </option>
                                    <option
                                        value="ongoing" >
                                        OnGoing
                                    </option>
                                    <option
                                        value="completed" >
                                        Completed
                                    </option>
                                    <option
                                        value="rejected" >
                                        Rejected
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">

                                <label for="inputState">Assigned To</label>
                                <select id="inputState" class="form-control" name="assignedto">
                                    <option value="">
                                        Select Employee
                                    </option>
                                    @foreach($arrObjEmployees as $employees)
                                        <option
                                            value="{{$employees->id}}">
                                            {{ $employees->employee->name}}
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
			var count = 0;

			$(document).on('click', '.add', function () {
				count++;
				var html = '';
				html += '<div class="addedSection"> <div class="form-group"><select required name="complaint[' + count + '][main]" class="form-control item_category" data-sub_category_id="' + count + '"><option value="">Select Category</option>{!! $output !!}</select></td></div>';
				html += '<div class="form-group"><select  name="complaint[' + count + '][sub]" class="form-control item_sub_category" id="item_sub_category' + count + '"><option value="">Select Sub Category</option></select></div>';
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

                if(type='user'){
                    $('#userList').fadeIn();
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


