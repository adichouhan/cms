+@extends('admin.admin_template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                <form method="post" action="{{ url('/admin/quote/store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="invoice_id">Product name</label>
                            <input type="text" class="form-control" name="quote_id"
                                   id="invoice_id" required value="{{$id}}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="invoice-date">Quote Date</label>
                            <input type="date" required class="form-control" name="quote_date"
                                   id="invoice-date" placeholder="">
                        </div>
                        <div class="add_complaint">Add complaint</div>
                        <div class="add_assets">Add asset</div>
                        <div id="add_complaint" style="display:none" class="form-group col-md-4">
                            <label for="complaint">Complaint</label>
                            <input type="text" class="form-control" required name="complaint"
                                   id="complaint" placeholder="Complaint">
                        </div>
                        <div id="add_asset" style="display:none" class="form-group col-md-4">
                            <label for="complaint">Complaint</label>
                            <input type="text" class="form-control" required name="complaint"
                                   id="complaint" placeholder="Complaint">
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
                                <td><input name="quote[0][product]" class="form-control item_product" data-sub_category_id="0"/></td>
                                <td><input type="number" name="quote[0][unit]"  data-count="0" class="form-control item_unit calculate price" id="item_sub_category0" value="3" /></td>
                                <td><input type="number" name="quote[0][quantity]" data-count="0" id="calctotal0" class="form-control qty item_quantity calculate" value="12"/></td>
                                <td>
                                    <input type="number" name="quote[0][total]" class="form-control item_total" readonly value="36" /></td>
                                <td><button type="button" class="add btn btn-primary">Add</button>
                                    <button type="button" class="remove btn btn-primary">Remove</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-dark add">Add Issue</button>
                    <div class="row">
                        <div class="col-7"></div>
                        <div class="form-group col-5" id="invoice-total">
                            <div class="row">
                                <div class="col-6 invoice_total">
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
                       <button type="submit" class="form_submit btn btn-primary" >Save</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>


    <script>
        $(document).ready(function () {
            var count = 1;

            $(document).on('click', '.add', function () {
                count++;
                var html = '';
				html += '<tr class="addedSection">';
				html += '<td><input type="hidden" name="quote[' + count + '][product]" class="form-control item_product" id="product'+count+'"><input type="text" name="quote[' + count + '][product]" class="form-control item_product" id="producttext'+count+'" ></td>';
				html += '<td><input type="number" name="quote[' + count + '][unit]"   class="form-control item_unit calculate price" id="unit'+count+'" value="12"/></td>';
				html += '<td><input type="number" name="quote[' + count + '][quantity]"   class="form-control item_quantity calculate qty" id="quantity'+count+'" value="6"/></td>';
				html += '<td><input type="number" name="quote[' + count + '][total]" class="form-control item_total" value="144" readonly/><div class="showtotal"></div></td>';
				html += '<td><button type="button" id="[' + count + ']" class="btn btn-danger btn-xs add">Add</button><button type="button" class="btn btn-danger btn-xs remove">Remove</button></td></tr>';
				$('tbody').append(html);
            });

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


