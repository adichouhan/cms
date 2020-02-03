+@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Delivery Challan</div>
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
                <form method="post" autocomplete="off" action="{{ url('/admin/delivery/store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="challan_id">Challan Id</label>
                            <input type="text" class="form-control" name="challan_id"
                                   id="challan_id" required value="{{$id}}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="challan-date">Challan Date</label>
                            <input type="datetime-local" required class="form-control" name="challan_date"
                                   id="challan-date" placeholder="">
                        </div>

                        <div class="form-group col-md-4" id="complaint">
                            <label for="supplier">Supplier</label>
                            <input type="text" class="form-control search" data-type="supplier"
                                   id="supplier_text"  placeholder="Supplier...." />
                            <div id="supplierList"></div>
                            <input type="hidden" class="form-control" name="supplier"
                                   id="supplier" placeholder="Supplier" />
                        </div>


                    <div class="box-body">
                        <table class="table table-bordered" id="item_table">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="text" name="challan[0][product]" class="form-control item_product search"
                                           data-type="boq" data-count="0" id="product0"                                    />
                                    <div id="productList0"></div>
                                </td>
                                <td><input type="number" name="challan[0][unit]"  class="form-control item_unit calculate price" id="unit0"  /></td>
                                 <td>
                                   <button type="button" class="add btn  btn-xs btn-primary">Add</button>
                                    <button type="button" class="remove btn  btn-xs btn-primary">Remove</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    <br>
                    <div class="form-group">
                        <button type="submit" class="form_submit btn btn-primary" >Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var count = 1;
            $(document).on('click', '.add', function () {
                count++;
                var html = '';
                html += '<tr class="addedSection">';
                html += '<td><input type="text" name="challan[' + count + '][product]" class="form-control item_product search" data-type="product" data-count="'+count+'" id="product'+count+'"><div id="productList'+count+'"></td>';
                html += '<td><input type="number" name="challan[' + count + '][unit]"   class="form-control item_unit calculate price" id="unit'+count+'"/></td>';
                html += '<td><button type="button" id="[' + count + ']" class="btn btn-primary btn-xs add">Add</button><button type="button" class="btn btn-primary btn-xs remove">Remove</button></td></tr>';
                $('tbody').append(html);
            });

            $(document).on('keyup', '.search', function () {
                var type = $(this).data('type');
                dataCount = $(this).data('count');
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
                var htmlComplaint='';
                htmlComplaint += '<ul class="dropdown-menu" style="display:block; position:relative">';

                if(type =='product'){
                    var productListId = '#productList'+dataCount;
                    $(productListId).fadeIn();
                    if(data.length>0){
                    data.forEach(function (product) {
                        htmlComplaint += '<li class="product" data-id="' + product.id + '" data-unit="' + product.product_unit + '" data-cost="' + product.product_cost + '">' + product.product_name + '</li> ';
                    })
                    }else{
                            htmlComplaint +='<li class="product"><a href="/admin/product/create">Add Product</a></li> ';
                        }
                        var listId = '#productList'+dataCount;
                        $(listId).children().remove();
                        $(listId).append(htmlComplaint);
                }

                if(type =='supplier'){
                    $('#supplierList').fadeIn();
                    if(data.length>0){
                        data.forEach(function (product) {
                            htmlComplaint += '<li class="supplier" data-id="' + supplier.id + '">' + supplier.name + '</li> ';
                        })
                    }else{
                        htmlComplaint +='<li class="supplier"><a href="/admin/suppler/create">Add Supplier</a></li> ';
                    }
                    $('#supplierList').children().remove();
                    $('#supplierList').append(htmlComplaint);

                }


                htmlComplaint += '</ul>'
                calc();
            }

            $('#item_table tbody').on('keyup change',function(){
                calc();
            });
            $('#tax').on('keyup change',function(){
                calc_total();
            });

            $('.add_complaint').on('click', function () {
                $('#add_complaint').css("display", "block");
                $('#add_asset').css("display", "none");
            });

            $('.add_asset').on('click', function () {
                $('#add_asset').css("display", "block");
                $('#add_complaint').css("display", "none");
            });

            function calc()
            {
                $('#item_table tbody tr').each(function(i, element) {
                    var html = $(this).html();
                    if(html!='')
                    {
                        var qty = $(this).find('.qty').val();
                        var price = $(this).find('.price').val();
                        $(this).find('.item_total').val(qty*price);

                        calc_total();
                    }
                });
            }

            $( "#complaint" ).autocomplete({

                source: function(request, response) {
                    $.ajax({
                        url: "{{url('/autocomplete/complaint/')}}",
                        data: {
                            term : request.term
                        },
                        dataType: "json",
                        success: function(data){
                            var resp = $.map(data,function(obj){
                                return obj.name;
                            });

                            response(resp);
                        }
                    });
                },
                minLength: 1
            });

            function calc_total()
            {
                total=0;
                $('.item_total').each(function() {
                    total += parseInt($(this).val());
                });
                $('#sub_total').val(total.toFixed(2));
                tax_sum=total/100*$('#tax').val();
                $('#tax_amount').val(tax_sum.toFixed(2));
                $('#total_amount').val((tax_sum+total).toFixed(2));
            }

            $(document).on('click', '.remove', function () {
                $(this).closest('.addedSection').remove();
            });


        });
    </script>
@stop


