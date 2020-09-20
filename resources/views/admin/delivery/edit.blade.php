@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class=" justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Edit Delivery Challan</div>
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
                <form method="post" autocomplete="off" action="{{ url('/delivery/update/'.$objChallan->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="invoice_id">Product name</label>
                            <input type="text" class="form-control" name="challan_id"
                                   id="invoice_id" required value="{{$objChallan->challan_id}}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="invoice-date">Invoice Date</label>
                            <input type="date" required class="form-control" name="challan_date"
                                   id="invoice-date" value="{{isset($objChallan->challan_date)?($objChallan->challan_date):''}}" placeholder="">
                        </div>

                        <div class="form-group col-md-4" id="complaint" >
                            <label for="supplier">Supplier</label>
                            <input type="text" class="form-control search" data-type="supplier"
                                   id="supplier_text" value="{{ isset($objCompOrAsset)?$objCompOrAsset->title:''}}"  placeholder="Supplier...." />
                            <div id="supplierList"></div>
                            <input type="hidden" class="form-control" name="supplier"
                                   id="supplier" value="{{ isset($objChallan) ? $objChallan->id:''}}" placeholder="Complaint" />
                        </div>
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
                            @foreach(json_decode($objChallan->challan , true) as $index => $challan)
                                <div class="addedSection">
                                <tr>
                                    <td><input name="challan[{{$index}}][product]" class="search form-control item_product" value="{{ $challan['product'] }}" /></td>
                                    <td><input type="number" name="challan[{{$index}}][unit]"  data-count="0"  value="{{ $challan['unit'] }}" class="form-control item_unit calculate price" id="item_sub_category0"  /></td>
                                    <td><button type="button" class="add btn btn-primary">Add</button>
                                        <button type="button" class="remove btn btn-danger">Remove</button>
                                    </td>
                                </tr>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>

                    <div class="form-group">
                        <button class="form_submit btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var count = {!! count(json_decode($objChallan->challan))>0?count(json_decode($objChallan->challan)):0 !!};

            $(document).on('click', '.add', function () {
                count++;
                var html = '';
                html += '<tr class="addedSection">';
                html += '<td><input type="text" name="challan[' + count + '][product]" class="form-control item_product search" data-type="product" data-count="'+count+'" id="product'+count+'"><div id="productList'+count+'"></td>';
                html += '<td><input type="number" name="challan[' + count + '][unit]"   class="form-control item_unit calculate price" id="unit'+count+'"/></td>';
                html += '<td><button type="button" id="[' + count + ']" class="btn btn-primary add">Add</button><button type="button" class="btn btn-danger  remove">Remove</button></td></tr>';
                $('tbody').append(html);
            });

            $('#item_table tbody').on('keyup change blur',function(){
                calc();
            });
            $('#tax').on('keyup change blur',function(){
                calc_total();
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
                htmlComplaint += '<ul class="dropdown-menu" style="display:block; position:relative; min-width: 200px">';

                if(type =='product'){
                    var productListId = '#productList'+dataCount;
                    $(productListId).fadeIn();
                    if(data.length>0){
                        data.forEach(function (product) {
                            htmlComplaint += '<li class="product"  data-id="' + product.id + '" data-unit="' + product.product_unit + '" data-cost="' + product.product_cost + '">' + product.product_name + '</li> ';
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
                        data.forEach(function (supplier) {
                            htmlComplaint += '<li class="supplier" data-id="'+ supplier.id + '">' + supplier.name + '</li> ';
                        })
                    }else{
                        htmlComplaint +='<li class="supplier"><a href="/admin/supplier/create">Add Supplier</a></li> ';
                    }
                    $('#supplierList').children().remove();
                    $('#supplierList').append(htmlComplaint);

                }


                htmlComplaint += '</ul>'
                calc();
            }

            $(document).on('click', 'li.supplier', function () {
                $('#supplier_text').val($(this).text());
                $('#supplier').val($(this).data('id'));
                $('#supplierList').fadeOut();
            });

            $(document).on('click', 'li.product' , function () {
                $('#product_text'+dataCount).val($(this).text());
                $('#product'+dataCount).val($(this).data('id'));
                $('#unit'+dataCount).val($(this).data('unit'));
                $('#productList'+dataCount).fadeOut();
            });

            $('#item_table tbody').on('keyup change',function(){
                calc();
            });

            $('#tax').on('keyup change',function(){
                calc_total();
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


