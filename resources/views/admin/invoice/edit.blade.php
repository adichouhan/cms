@extends('admin.admin_template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                <form method="post" action="{{ url('/admin/invoice/update/'.$objInvoice->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="invoice_id">Product name</label>
                            <input type="text" class="form-control" name="invoice_id"
                                   id="invoice_id" required value="{{$objInvoice->invoice_id}}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="invoice-date">Invoice Date</label>
                            <input type="date" required class="form-control" name="invoice_date"
                                   id="invoice-date" value="{{$objInvoice->invoice_date}}" placeholder="">
                        </div>
                        @if(isset($objInvoice->complaint))
                        <div class="form-group col-md-4">
                            <label for="complaint">Complaint</label>
                            <input type="text" class="form-control" required name="complaint"
                                   id="complaint" placeholder="Complaint" value="{{isset($objInvoice->complaint)?$objInvoice->complaint:''}}">
                        </div>
                        @endif

                        @if(isset($objInvoice->assets))
                            <label for="assets">Assets</label>
                            <input type="text" class="form-control"
                                   id="assets_text" placeholder="Assets" >
                            <input type="hidden" class="form-control"  name="assets"
                                   id="assets" placeholder="Assets">
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
                            @foreach(json_decode($objInvoice->invoice) as $index => $invoice)
                            <tr>
                                <td><input name="invoice[{{$index}}][product]" class="form-control item_product" value="{{$invoice->product}}" data-sub_category_id="0"/></td>
                                <td><input type="number" name="invoice[{{$index}}][unit]"  data-count="0"  value="{{$invoice->unit}}" class="form-control item_unit calculate price" id="item_sub_category0"  /></td>'
                                <td><input type="number" name="invoice[{{$index}}][quantity]" data-count="0" id="calctotal0" value="{{$invoice->quantity}}" class="form-control qty item_quantity calculate" /></td>
                                <td>
                                    <input type="number" name="invoice[{{$index}}][total]" class="form-control item_total" readonly value="36" /></td>
                                <td><button type="button" class="add btn btn-primary">Add</button>
                                    <button type="button" class="remove btn btn-primary">Remove</button>
                                </td>
                            </tr>
                            @endforeach
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
			var count = {!! count(json_decode($objInvoice->invoice))>0?count(json_decode($objInvoice->invoice)):0 !!};

			$(document).on('click', '.add', function () {
				count++;
				var html = '';
				html += '<tr class="addedSection">';
				html += '<td><select name="invoice[' + count + '][product]" class="form-control item_product" data-product_id="' + count + '"><option value="check2">check2</option></select></td>';
				html += '<td><input type="number" name="invoice[' + count + '][unit]" id="unit${count}" data-count="' + count + '" class="form-control item_unit calculate price" id="item_sub_category' + count + '" value="12"/></td>';
				html += '<td><input type="number" name="invoice[' + count + '][quantity]" id="quantity${count}" data-count="' + count + '" class="form-control item_quantity calculate qty" value="6"/></td>';
				html += '<td><input type="number     " name="invoice[' + count + '][total]" class="form-control item_total" value="144" readonly/><div class="showtotal"></div></td>';
				html += '<td><button type="button" id="[' + count + ']" class="btn btn-danger btn-xs add">Add</button><button type="button" class="btn btn-danger btn-xs remove">Remove</button></td></tr>';
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


