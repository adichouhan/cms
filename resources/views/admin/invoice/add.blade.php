@extends('admin.admin_template')
@section('content')
    <script>
        $(document).on('click', '.assets', function () {
            console.log('lksdf')
            $('#assets').css('display', 'block');
            $('#complaint').css('display', 'none');
        });

        $(document).on('click', '.complaint', function () {
            $('#complaint').css('display', 'block');
            $('#assets').css('display', 'none');
        });
    </script>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Create Invoice</div>
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
                        <form method="post" autocomplete="off" action="{{ url('/admin/invoice/store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="invoice_id">Invoice Id</label>
                                    <input type="text" class="form-control" name="invoice_id"
                                           id="invoice_id" required value="{{$id}}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="invoice-date">Invoice Date</label>
                                    <input type="date" required class="form-control" name="invoice_date"
                                           id="invoice-date" placeholder="">
                                </div>
                                <div class="col-md-2 pt-4">
                                <button type="button" class=" btn btn-primary  complaint">Add Complaint</button>
                                </div>
                                <div class="col-md-2 pt-4">
                                <button  type="button" class=" btn btn-primary  assets">Add Assets</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4" id="complaint" style="display: none">
                                    <label for="complaint">Complaint</label>
                                    <input type="text" class="form-control search" data-type="complaint"
                                           id="complaint_text" placeholder="Complaint"/>
                                    <div id="complaintList"></div>
                                    <input type="hidden" class="form-control" name="complaint"
                                           id="complaintVal" placeholder="Complaint"/>
                                </div>
                                <div class="form-group col-md-4" id="assets" style="display: none">
                                    <label for="asset">Assets</label>
                                    <input type="text" class="form-control search" data-type="asset"
                                           id="assets_text" placeholder="Assets">
                                    <div id="assetList"></div>
                                    <input type="hidden" class="form-control" name="assets"
                                           id="asset" placeholder="Assets">
                                </div>
                            </div>

                            <div class="box-body">
                                <table class="table table-bordered" id="item_table">
                                    <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Unit</th>
                                        <th>Cost</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" name="invoice[0][product]"
                                                   class="form-control item_product search"
                                                   data-type="boq" data-count="0" id="product0"/>
                                            <div id="productList0"></div>
                                        </td>
                                        <td><input type="number" name="invoice[0][unit]"
                                                   class="form-control item_unit calculate price" id="unit0"/></td>
                                        <td><input type="number" name="invoice[0][quantity]" data-count="0"
                                                   id="quantity0" class="form-control qty item_quantity calculate"/>
                                        </td>
                                        <td>
                                            <input type="number" name="invoice[0][total]"
                                                   class="form-control item_total" id="total0" readonly/></td>
                                        <td>
                                            <button type="button" class="add m-2 btn btn-primary">Add</button>
                                            <button type="button" class="remove m-2 btn btn-danger">Remove</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-7"></div>
                                <div class="form-group col-5" id="invoice-total">
                                    <div class="row">
                                        <div class="col-6 invoice_total">
                                            Sub Total
                                        </div>
                                        <div class="col-6 total">
                                            <input type="number" name='sub_total' placeholder='0.00'
                                                   class="form-control total_amount" id="sub_total" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="form-group">
                                {{--                        <a href="/admin/quote/createpdf" class="form_submit btn btn-primary" >Create Pdf</a>--}}

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
            var count = 0;
            var dataCount = '';


            $(document).on('click', '.add', function () {
                count++;
                var html = '';
                html += '<tr class="addedSection">';
                html += '<td><input type="text" name="invoice[' + count + '][product]" class="form-control item_product search" data-type="boq" data-count="' + count + '" id="product' + count + '"><div id="productList' + count + '"></td>';
                html += '<td><input type="number" name="invoice[' + count + '][unit]"   class="form-control item_unit calculate price" id="unit' + count + '"/></td>';
                html += '<td><input type="number" name="invoice[' + count + '][quantity]"   class="form-control item_quantity calculate qty" id="quantity' + count + '" /></td>';
                html += '<td><input type="number" name="invoice[' + count + '][total]" class="form-control item_total" id="total' + count + '" readonly/></td>';
                html += '<td><button type="button" id="[' + count + ']" class="btn btn-primary m-2 add">Add</button><button type="button" class="btn btn-danger remove">Remove</button></td></tr>';
                $('tbody').append(html);
            });


            $('#tax').on('keyup change', function () {
                calc_total();
            });

            $(document).on('keyup', '.search', function () {
                var type = $(this).data('type');
                dataCount = $(this).data('count');
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

                if (type == 'complaint') {
                    if (data.length > 0) {
                        data.forEach(function (complaints) {
                            htmlComplaint += '<li class="comp" data-id="' + complaints.id + '">' + complaints.title + '</li> ';
                        })
                    } else {
                        htmlComplaint += '<li class="comp" ><a href="/admin/complaints/create">Create New Complaints </a> </li> ';
                    }

                    $('#complaintList').children().remove();
                    $('#complaintList').append(htmlComplaint);

                }

                if (type == 'asset') {
                    if (data.length > 0) {
                        data.forEach(function (assets) {
                            htmlComplaint += '<li class="asset" data-id="' + assets.id + '">' + assets.title + '</li> ';
                        })
                    } else {
                        htmlComplaint += '<li class="asset" data-id="' + assets.id + '"><a href="/admin/asset/create"> Create New Asset</a> </li> ';
                    }
                    $('#assetList').children().remove();
                    $('#assetList').append(htmlComplaint);

                }

                if (type == 'boq') {
                    var productListId = '#productList' + dataCount;
                    $(productListId).fadeIn();
                    if (data.length > 0) {
                        data.forEach(function (product) {
                            htmlComplaint += '<li class="product" data-id="' + product.id + '" data-unit="' + product.product_unit + '" data-cost="' + product.product_cost + '">' + product.product_name + '</li> ';
                        })
                    } else {
                        htmlComplaint += '<li class="product" data-id="' + product.id + '" data-unit="' + product.product_unit + '" data-cost="' + product.product_cost + '"><a href="/admin/boq/creaete">Create Product</a></li> ';
                    }
                    var listId = '#productList' + dataCount;

                    $(listId).children().remove();
                    $(listId).append(htmlComplaint);

                }

                htmlComplaint += '</ul>'
                calc();
            }

            $(document).on('keyup change blur', '#item_table tbody', function () {
                calc();
            });

            $(document).on('click', 'li.comp', function () {
                $('#complaint_text').val($(this).text());
                $('#complaintVal').val($(this).data('id'));
                $('#complaintList').fadeOut();
            });

            $(document).on('click', 'li.asset', function () {
                $('#asset_text').val($(this).text());
                $('#asset').val($(this).data('id'));
                $('#assetList').fadeOut();
            });

            $(document).on('click', 'li.product', function () {
                var productId = '#product' + dataCount;
                var unitId = '#unit' + dataCount;
                var costId = '#quantity' + dataCount;
                var totalId = '#total' + dataCount;
                var productListId = '#productList' + dataCount;
                $(productId).val($(this).text());
                var unit = $(this).data('unit')
                var cost = $(this).data('cost')
                var total = parseInt(unit) * parseInt(cost);
                $(unitId).val(unit)
                $(costId).val(cost)
                $(totalId).val(total)
                $(productListId).fadeOut();
                calc()
                calc_total();

            });

            function calc() {
                $('#item_table tbody tr').each(function (i, element) {
                    var html = $(this).html();
                    if (html != '') {
                        var qty = $(this).find('.qty').val();
                        var price = $(this).find('.price').val();
                        $(this).find('.item_total').val(qty * price);

                        calc_total();
                    }
                });
            }


            function calc_total() {
                total = 0;
                $('.item_total').each(function () {
                    total += parseInt($(this).val());
                });
                $('#sub_total').val(total.toFixed(2));
                tax_sum = total / 100 * $('#tax').val();
                $('#tax_amount').val(tax_sum.toFixed(2));
                $('#total_amount').val((tax_sum + total).toFixed(2));
            }

            $(document).on('click', '.remove', function () {
                $(this).closest('.addedSection').remove();
            });
        });
    </script>
@stop


