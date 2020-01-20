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
                                <input type="text" id="product" data-type="assetProduct" value="{{isset($objAssets->product)??$objAssets->product}}" class="form-control search">
                                <input type="hidden" id="productId" class="form-control search" value="{{isset($objAssets->id)??$objAssets->id}}" name="product">
                                <div id="assetProductList"></div>
                            </div>

                            <div class="form-group">
                                <label for="location">Location(Branch Name)*</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="" value="{{$objAssets->location}}">
                            </div>

                            <div class="form-group">
                                <label for="inputState">Priority</label>
                                <select id="inputState" class="form-control" name="priority">
                                    <option
                                        value="low"  {{(isset($objAssets->priority) && $objAssets->priority=='low')? 'selected':'' }}>
                                        Low
                                    </option>
                                    <option
                                        value="medium" {{(isset($objAssets->priority) && $objAssets->priority=='medium')? 'selected':'' }}>
                                        Medium
                                    </option>
                                    <option
                                        value="high" {{(isset($objAssets->priority) && $objAssets->priority=='high')? 'selected':'' }}>
                                        High
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date">Expected Date</label>
                                <input type="datetime" class="form-control" name="expdate"
                                       id="date" placeholder="" value="{{date("m-d-Y h:i:s",strtotime(isset($objAssets->expected_date)?$objAssets->expected_date:''))}}">
                            </div>

                            <div class="form-group">
                                <label for="material">Material(if any)</label>
                                <input type="text" class="form-control"
                                       name="material" id="material" placeholder="" value="{{isset($objAssets->maerials)?$objAssets->maerials:''}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlFile1">photo upload</label>
                                <input type="file" name="image" value="{{ isset($objAssets->image)?$objAssets->image:'' }}"/>
                                @if($objAssets->image)
                                    <img src="{{url('/images/'.$objAssets->image)}}" class="img-thumbnail" width="100"/>
                                @endif
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

            var count= {!! count($arrProduct) !!};
            var countList='';
            var productId='';
            $(document).on('click', '.add', function () {
                count++
                var html = '';
                html += '<div class="form-group addedSection"><label for="product">Product</label><input type="text" id="product_'+count+'" data-type="assetProduct"  data-count="'+count+'"  class="form-control search">'
                html += '<input type="hidden" id="productId_'+count+'" class="form-control search" name="product['+count+']">'
                html += '<div id="assetProductList_'+count+'"></div>';
                html += '<div class="form-group"><button type="button" name="remove" class="btn btn-danger btn-xs remove">Remove</button></div></div>';
                $('#addsection').append(html);
            });

            $(document).on('keyup', '.search', function () {
                var type = $(this).data('type');
                var query = $(this).val();
                countList = $(this).data('count');

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
                var productcont="#product_"+count;
                var productIdcont="#productId_"+count;
                $(productcont).val($(this).text());
                $(productIdcont).val($(this).data('id'));
                $(productId).fadeOut();
            });
        });
    </script>
@stop


