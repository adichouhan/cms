@extends('admin.admin_template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Asset</div>
                    <div class="card-body">
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
                        <select id="product" data-type="assetProduct" name="product[]" class="form-control product-multi" multiple="multiple">
                        </select>
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
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {

        $('.product-multi').select2();

        $(document).on('keyup click blur', '.search', function () {
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
            if (type == 'assetProduct') {
                if(data.length>0) {
                data.forEach(function (product) {
                    htmlComplaint += '<option class="product" data-id="' + product.id + '">' + product.product_name + '</option> ';
                })
                }else{
                    htmlComplaint += '<li class="product"><a href="/admin/asset/product/create">Add New Asset Product</a></li> ';
                }

                $('#product').children().remove();
                $('#product').append(htmlComplaint);

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
