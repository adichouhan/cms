@extends('admin.admin_template')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                <form method="post" action="{{ url('/admin/quote/createpdf') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="quote_id">Product name</label>
                            <input type="text" class="form-control" name="quote_id"
                                   id="quote_id" required value="{{$objQuote->quote_id}}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="quote-date">Quote Date</label>
                            <input type="date" required class="form-control" name="quote_date"
                                   id="quote-date" value="{{$objQuote->date}}" placeholder="">
                        </div>

                        @if(isset($objQuote->complaint))
                            <div class="form-group col-md-4">
                                <label for="complaint">Complaint</label>
                                <input type="text" class="form-control search" data-type="complaint"
                                       id="complaint_text" value="{{$objCompOrAsset->name}}"  placeholder="Complaint" />
                                <div id="complaintList"></div>
                                <input type="hidden" class="form-control"   name="complaint"
                                       id="complaintVal" value="{{$objCompOrAsset->id}}" placeholder="Complaint" />
                            </div>
                        @endif

                        @if(isset($objQuote->assets))
                            <div class="form-group col-md-4">
                                <label for="assets">Assets</label>
                                <input type="text" class="form-control"
                                       id="assets_text" value="{{$objCompOrAsset->name}}" placeholder="Assets" >

                                <input type="hidden" class="form-control"  value="{{$objCompOrAsset->id}}" name="assets"
                                       id="assets" placeholder="Assets">
                            </div>
                        @endif
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
                            @foreach(json_decode($objQuote->quote) as $index => $invoice)
                                <tr>
                                    <td><input name="quote[{{$index}}][product]" class="form-control item_product" value="{{$invoice->product}}" data-sub_category_id="0"/></td>
                                    <td><input type="number" name="quote[{{$index}}][unit]"  data-count="0"  value="{{$invoice->unit}}" class="form-control item_unit calculate price" id="item_sub_category0"  /></td>'
                                    <td><input type="number" name="quote[{{$index}}][quantity]" data-count="0" id="calctotal0" value="{{$invoice->quantity}}" class="form-control qty item_quantity calculate" /></td>
                                    <td>
                                        <input type="number" name="quote[{{$index}}][total]" class="form-control item_total" readonly value="36" /></td>
                                    <td><button type="button" class="add btn btn-primary">Add</button>
                                        <button type="button" class="remove btn btn-primary">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-dark add">Add Issue</button>
                    <div class="row">
                        <div class="col-7"></div>
                        <div class="form-group col-5" id="quote-total">
                            <div class="row">
                                <div class="col-6 quote_total">
                                    Sub Total
                                </div>
                                <div class="col-6 total">
                                    <input type="number" name='sub_total' placeholder='0.00' class="form-control total_amount" id="sub_total" readonly/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <button class="form_submit btn btn-primary" >Save</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>

    <script>
        $(document).ready(function () {
            var count = 0;
            var dataCount='';


            $(document).on('click', '.add', function () {
                count++;
                var html = '';
                html += '<tr class="addedSection">';
                html += '<td><input type="text" name="quote[' + count + '][product]" class="form-control item_product search" data-type="product" data-count="'+count+'" id="product'+count+'"><div id="productList'+count+'"></td>';
                html += '<td><input type="number" name="quote[' + count + '][unit]"   class="form-control item_unit calculate price" id="unit'+count+'"/></td>';
                html += '<td><input type="number" name="quote[' + count + '][quantity]"   class="form-control item_quantity calculate qty" id="quantity'+count+'" /></td>';
                html += '<td><input type="number" name="quote[' + count + '][total]" class="form-control item_total" id="total'+count+'" readonly/></td>';
                html += '<td><button type="button" id="[' + count + ']" class="btn btn-danger btn-xs add">Add</button><button type="button" class="btn btn-danger btn-xs remove">Remove</button></td></tr>';
                $('tbody').append(html);
            });


            $('#tax').on('keyup change',function(){
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
                htmlComplaint += '<ul class="dropdown-menu" style="display:block; position:relative">';

                if(type =='complaint'){
                    data.forEach(function (complaints) {
                        htmlComplaint +='<li class="comp" data-id="'+ complaints.id+'">'+ complaints.complaints_unique+'</li> ';
                        $('#complaintList').append(htmlComplaint);
                    })
                }

                if(type =='asset'){
                    data.forEach(function (assets) {
                        htmlComplaint +='<li class="asset" data-id="'+ assets.id+'">'+ assets.assets_unique+'</li> ';
                        $('#assetList').append(htmlComplaint);
                    })
                }

                if(type =='product'){
                    var productListId = '#productList'+dataCount;
                    $(productListId).fadeIn();

                    data.forEach(function (product) {
                        htmlComplaint +='<li class="product" data-id="'+ product.id+'" data-unit="'+product.product_unit+'" data-cost="'+product.product_cost+'">'+ product.product_name+'</li> ';
                        var listId = '#productList'+dataCount;
                        $(listId).children().remove();
                        $(listId).append(htmlComplaint);
                    })
                }

                htmlComplaint += '</ul>'
                calc();
            }

            $(document).on('keyup change blur', '#item_table tbody',function(){
                calc();
            });

            $(document).on('click', 'li.comp', function(){
                $('#complaint_text').val($(this).text());
                $('#complaintVal').val($(this).data('id'));
                $('#complaintList').fadeOut();
            });

            $(document).on('click', 'li.asset', function(){
                $('#asset_text').val($(this).text());
                $('#asset').val($(this).data('id'));
                $('#assetList').fadeOut();
            });

            $(document).on('click', 'li.product', function(){
                var productId = '#product'+dataCount;
                var unitId = '#unit'+dataCount;
                var costId = '#quantity'+dataCount;
                var totalId = '#total'+dataCount;
                var productListId = '#productList'+dataCount;
                $(productId).val($(this).text());
                var unit =$(this).data('unit')
                var cost =$(this).data('cost')
                var total=parseInt(unit)*parseInt(cost);
                $(unitId).val(unit)
                $(costId).val(cost)
                $(totalId).val(total)
                $(productListId).fadeOut();
                calc()
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


