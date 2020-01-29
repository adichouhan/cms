@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                <form method="post" autocomplete="off" action="{{ url('/delivery/update/'.$objInvoice->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="invoice_id">Product name</label>
                            <input type="text" class="form-control" name="challan_id"
                                   id="invoice_id" required value="{{$objInvoice->challan_id}}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="invoice-date">Invoice Date</label>
                            <input type="date" required class="form-control" name="challan_date"
                                   id="invoice-date" value="{{isset($objInvoice->challan_date)?($objInvoice->challan_date):''}}" placeholder="">
                        </div>

                        <div class="form-group col-md-4" id="complaint" style="display: none">
                            <label for="supplier">Supplier</label>
                            <input type="text" class="form-control search" data-type="supplier"
                                   id="supplier_text"  placeholder="Supplier...." />
                            <div id="supplierList"></div>
                            <input type="hidden" class="form-control" name="supplier"
                                   id="supplier" placeholder="Complaint" />
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
                            @foreach(json_decode($objInvoice->challan) as $index => $invoice)
                                <tr>
                                    <td><input name="challan[{{$index}}][product]" class="form-control item_product" value="{{$invoice->product}}" data-sub_category_id="0"/></td>
                                    <td><input type="number" name="challan[{{$index}}][unit]"  data-count="0"  value="{{$invoice->unit}}" class="form-control item_unit calculate price" id="item_sub_category0"  /></td>'
                                    <td><button type="button" class="add btn btn-primary">Add</button>
                                        <button type="button" class="remove btn btn-primary">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="form_submit btn btn-primary" >Save</button>
                    </div>
                </form>
            </div>
        </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var count = {!! count(json_decode($objInvoice->challan))>0?count(json_decode($objInvoice->challan)):0 !!};

            $(document).on('click', '.add', function () {
                count++;
                var html = '';
                html += '<tr class="addedSection">';
                html += '<td><input type="text" name="challan[' + count + '][product]" class="form-control item_product search" data-type="product" data-count="'+count+'" id="product'+count+'"><div id="productList'+count+'"></td>';
                html += '<td><input type="number" name="challan[' + count + '][unit]"   class="form-control item_unit calculate price" id="unit'+count+'"/></td>';
                html += '<td><button type="button" id="[' + count + ']" class="btn btn-primary btn-xs add">Add</button><button type="button" class="btn btn-primary btn-xs remove">Remove</button></td></tr>';
                $('tbody').append(html);
            });

            $('#item_table tbody').on('keyup change blur',function(){
                calc();
            });
            $('#tax').on('keyup change blur',function(){
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
                                //console.log(obj.city_name);
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


