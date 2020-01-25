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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Asset</div>
                    <div class="card-body">
                        <?php
                        $count = 0;
                        $arrProduct = [];
                        if (!empty($objAssets->products)) {
                            foreach (json_decode($objAssets->products) as $product) {
                                array_push($arrProduct, $product);
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
                <form method="post" action="{{ url('/admin/edit/assets/') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="user">Users</label>
                        <input type="text" id="user" data-type="user" value="{{isset($objUser->name)??$objUser->name}}" class="form-control search">
                        <input type="hidden" id="userId" class="form-control search" value="{{isset($objUser->id)??$objUser->id}}" name="user">
                        <div id="userList"></div>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-dark add">Add Product</button>
                    </div>
                    @foreach($arrProduct as $index=>$objProduct)
                        <?php
                        $objDetail=\App\AssetsProduct::find($objProduct);
                        ?>
                        <div class="form-group">
                            <label for="product">Product</label>
                            <input type="text" id="product_{{$index}}" data-type="assetProduct" data-count="{{$index}}" class="form-control search" value="{{$objDetail->product_name}}">
                            <input type="hidden" id="productId_{{$index}}" class="form-control search" value="{{$objProduct}}" name="product[{{$index}}]">
                            <div id="assetProductList_{{$index}}"></div>
                        </div>
                    @endforeach

                    <div id="addsection">
                    </div>

                    <div class="form-group">
                        <label for="location">Location(Branch Name)*</label>
                        <input type="text" class="form-control" id="location"
                               name="location" value="{{$objAssets->location}}"
                               placeholder="">
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

                    <div class="form-group">
                        <button type="button"  class="btn btn-primary" onclick="myFunction()">Accept</button>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary reject" onclick="reject()">Reject</button>
                    </div>

                    <div class="form-group" id="reject" style="display:none">
                        <label for="rejectreason">Reject Reason</label>
                        <input type="text" class="form-control"
                               value="{{isset($objAssets->rejectReason)?$objAssets->rejectReason:''}}"
                               name="rejectreason" id="rejectreason" placeholder="">
                    </div>
                    <div id="accept" style="display: none">
                        <div class="form-group col-md-4">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option
                                    value="booked" {{(isset($objAssets->status) && $objAssets->priority=='booked')? 'selected':'' }}>
                                    Booked
                                </option>
                                <option
                                    value="processed" {{(isset($objAssets->priority) && $objAssets->priority=='processed')? 'selected':'' }}>
                                    Processed
                                </option>
                                <option
                                    value="ongoing" {{(isset($objAssets->priority) && $objAssets->priority=='ongoing')? 'selected':'' }}>
                                    OnGoing
                                </option>
                                <option
                                    value="completed" {{(isset($objAssets->priority) && $objAssets->priority=='completed')? 'selected':'' }}>
                                    Completed
                                </option>
                                <option
                                    value="rejected" {{(isset($objAssets->priority) && $objAssets->priority=='rejected')? 'selected':'' }}>
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
                                        {{isset($employees->employee->name)}}
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




