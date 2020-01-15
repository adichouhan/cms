@extends('admin.admin_template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                <form method="post" action="{{ url('/admin/assets/store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="user">Users</label>
                        <input type="text" id="user" data-type="user" class="form-control search">
                        <input type="hidden" id="userId" class="form-control search" name="user">
                        <div id="userList"></div>
                    </div>

                    <div class="form-group">
                        <label for="product">Product</label>
                        <input type="text" id="product" data-type="assetProduct" class="form-control search">
                        <input type="hidden" id="productId" class="form-control search" name="product">
                        <div id="assetProductList"></div>
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
                        <input type="file" name="image" />
                    </div>

                    <div id="accept" >
                        <div class="form-group col-md-4">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option
                                    value="booked" >
                                    Booked
                                </option>
                                <option
                                    value="processed">
                                    Processed
                                </option>
                                <option
                                    value="ongoing">
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
