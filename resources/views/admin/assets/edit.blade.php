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
                        <input type="text" value="{{$objUser->name}}" readonly>
                        <input type="hidden" value="{{$objUser->id}}"  name="user">
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
                        <input type="datetime" class="form-control" name="expdate"
                               id="date" placeholder="" value="{{$objAssets->date}}">
                    </div>

                    <div class="form-group">
                        <label for="material">Material(if any)</label>
                        <input type="text" class="form-control"
                               name="material" id="material" placeholder="" value="{{$objAssets->material}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">photo upload</label>
                         <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" >
                        <input type="file" name="image" value="{{ isset($objAssets->image)?$objAssets->image:'' }}"/>
                        <img src="{{asset($objAssets->image)}}" class="img-thumbnail" width="100"/>
                        <input type="hidden" name="hidden_image" value="{{ $objAssets->image }}"/>
                    </div>

                    <button type="button"  class="btn btn-primary" onclick="myFunction()">Accept</button>
                    <button type="button" class="btn btn-primary reject" onclick="reject()">Reject</button>

                    <div class="form-group" id="reject" style="display:none">
                        <label for="rejectreason">Reject Reason</label>
                        <input type="text" class="form-control"
                               value="{{isset($$objAssets->rejectReason)?$$objAssets->rejectReason:''}}"
                               name="rejectreason" id="rejectreason" placeholder="">
                    </div>
                    <div id="accept" style="display: none">
                        <div class="form-group col-md-4">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option
                                    value="booked" {{(isset($$objAssets->status) && $$objAssets->priority=='booked')? 'selected':'' }}>
                                    Booked
                                </option>
                                <option
                                    value="processed" {{(isset($$objAssets->priority) && $$objAssets->priority=='processed')? 'selected':'' }}>
                                    Processed
                                </option>
                                <option
                                    value="ongoing" {{(isset($$objAssets->priority) && $$objAssets->priority=='ongoing')? 'selected':'' }}>
                                    OnGoing
                                </option>
                                <option
                                    value="completed" {{(isset($$objAssets->priority) && $$objAssets->priority=='completed')? 'selected':'' }}>
                                    Completed
                                </option>
                                <option
                                    value="rejected" {{(isset($$objAssets->priority) && $$objAssets->priority=='rejected')? 'selected':'' }}>
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
            $(document).on('keyup', '.search', function () {
                var type = $(this).data('type');
                var query = $(this).val();

                if (query != '') {
                    $.ajax({
                        url: "/fetch",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "type": type,
                            'query': query
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
                console.log('type')
                console.log(type)
                var htmlComplaint = '';
                htmlComplaint += '<ul class="dropdown-menu" style="display:block; position:relative">';

                if (type == 'user') {
                    data.forEach(function (user) {
                        htmlComplaint += '<li class="user" data-id="' + user.id + '">' + user.name + '</li> ';
                        $('#userList').children().remove();
                        $('#userList').append(htmlComplaint);
                    })
                }
                if (type == 'assetProduct') {

                    data.forEach(function (product) {
                        htmlComplaint += '<li class="product" data-id="' + product.id + '">' + product.product_name + '</li> ';
                        $('#assetProductList').children().remove();
                        $('#assetProductList').append(htmlComplaint);
                    })
                }
            }

            $(document).on('click', 'li.user', function () {
                $('#user').val($(this).text());
                $('#userId').val($(this).data('id'));
                $('#userList').fadeOut();
            });

            $(document).on('click', 'li.product', function () {
                $('#product').val($(this).text());
                $('#productId').val($(this).data('id'));
                $('#assetProductList').fadeOut();
            });
        });
    </script>

@stop




