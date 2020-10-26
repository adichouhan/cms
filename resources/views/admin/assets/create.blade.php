@extends('admin.admin_template')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Create Asset</div>
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
                        <form method="post" action="{{ url('/admin/assets/store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title </label>
                                <input type="text" class="form-control"
                                       name="title" id="title" required placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="user">Users</label>
                                <input type="text" id="user" data-type="user" class="form-control search">
                                <input type="hidden" id="userId" class="form-control search" name="user">
                                <div id="userList"></div>
                            </div>


                            <div class="form-group">
                                <label for="product">Product</label>
                                <input type="text" id="product_0" data-type="assetProduct" name="product[0][name]" data-count="0" class="form-control search">
                                <input type="hidden" id="productId_0" class="form-control search" name="product[0][id]">
                                <div id="assetProductList_0"></div>
                            </div>

                            <div id="addsection">
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary add">Add Product</button>
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
                                <div class="form-group">
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

                                <div class="form-group">
                                    <label for="inputState">Assigned To</label>
                                    <select id="inputState" class="form-control" name="assignedto">
                                        @foreach($arrEmployees as $employees)
                                            <option
                                                value="employee"}}>
                                                {{$employees->employee->name}}
                                            </option>
                                        @endforeach
                                        @if($arrEmployees->count() == 0)
                                                <option  value="">
                                                    No Employee Available
                                                </option>
                                        @endif

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
            var count= 0;
            var countList='';
            var productId = ''
            var productcont='';
            var productIdcont='';

            $(document).on('click', '.add', function () {
                count++
                var html = '';
                html += '<div class="addedSection"><div class="form-group"><label for="product">Product</label><input type="text" id="product_'+count+'" name="product['+count+'][name]"  data-type="assetProduct"  data-count="'+count+'"  class="form-control search">'
                html += '<input type="hidden" id="productId_'+count+'" class="form-control search" name="product['+count+'][id]">'
                html += '<div id="assetProductList_'+count+'"></div></div>';
                html += '<div class="form-group"><button type="button" name="remove" class="btn btn-danger remove">Remove</button></div></div>';
                $('#addsection').append(html);
            });

            $(document).on('keyup click', '.search', function () {
                var type = $(this).data('type');
                var query = $(this).val();
                countList = $(this).data('count');
                 productcont="#product_"+countList;
                 productIdcont="#productId_"+countList;
                $(productIdcont).val('');

                productId='#assetProductList_'+countList
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

            $(document).on('click', '.remove', function () {
                count--
                $(this).closest('.addedSection').remove();
                // $("div.addedSection").first().remove()
            });

            function autocomplete(type, data) {
                var htmlComplaint = '';
                htmlComplaint += '<ul class="dropdown-menu" style="display:block; position:relative">';

                if (type == 'user') {
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
                if (type == 'assetProduct') {
                    $(productId).fadeIn();
                    if(data.length>0) {
                        data.forEach(function (product) {
                            htmlComplaint += '<li class="product" data-id="' + product.id + '">' + product.product_name + '</li> ';

                        })
                    }else{
                        htmlComplaint += '<li class="product"><a href="/admin/asset/product/create">Add New Asset Product</a></li> ';
                    }
                    $('#assetProductList_'+countList).children().remove();
                    $('#assetProductList_'+countList).append(htmlComplaint);

                }
            }


            $(document).on('blur', productcont, function () {
               $(productId).fadeOut();
            });

            $(document).on('blur', '#user', function () {
                $('#userList').fadeOut();
            });
            $(document).on('click', 'li.user', function () {
                $('#user').val($(this).text());
                $('#userId').val($(this).data('id'));
                $('#userList').fadeOut();
            });

            $(document).on('click', 'li.product', function () {
                var productcont="#product_"+countList;
                var productIdcont="#productId_"+countList;
                $(productcont).val($(this).text());
                $(productIdcont).val($(this).data('id'));
                $('#assetProductList_'+countList).fadeOut();
            });
        });
    </script>
@stop
