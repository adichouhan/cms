@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($type == 'edit')
                    <form method="post" autocomplete="off" action="{{ url('update/asset') }}" enctype="multipart/form-data">
                        <div class="box-body">
                            @csrf
                            <input type="hidden"  id="id" name="id"  value="{{$objAssets->id}}">
                            <div class="form-group">
                                <label for="product">Product</label>
                                <input type="text" id="product" data-type="assetProduct" class="form-control search">
                                <input type="hidden" id="productId" class="form-control search" name="product">
                                <div id="assetProductList"></div>
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
                            </div>

                            <div class="form-group">
                                <label for="date">Expected Date</label>
                                <input type="datetime" class="form-control" name="expdate" id="date" placeholder=""  value="{{$objAssets->expected_date}}">
                            </div>

                            <div class="form-group">
                                <label for="material">Materials</label>
                                <input type="text" class="form-control"  name="material" id="material" placeholder="" value="{{$objAssets->maerials}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlFile1">Example file input</label>
                                <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                                <img src="{{url('/images/'.$objAssets->image)}}" class="img-thumbnail" width="100"/>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                @else
                    <form method="post"  autocomplete="off" action="{{ url('register/asset') }}" enctype="multipart/form-data">
                        <div class="box-body">
                            @csrf
                            <div class="form-group">
                                <label for="product">Product</label>
                                <input type="text" id="product" data-type="assetProduct" class="form-control search">
                                <input type="hidden" id="productId" class="form-control search" name="product">
                                <div id="assetProductList"></div>
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
                                <input type="datetime" class="form-control" name="expdate" id="date" placeholder="">
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


