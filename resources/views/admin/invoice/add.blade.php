@extends('admin.admin_template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                <form method="post" action="{{ url('/admin/invoice/create') }}" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="product_name">Product name</label>
                            <input type="text" class="form-control" name="product_name"
                                   id="product_name" placeholder="Product name">
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="invoice-date">Invoice Date</label>
                            <input type="datetime-local" class="form-control" name="invoice_date"
                                   id="invoice-date" placeholder="">
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="invoice-date">Complaint</label>
                            <input type="text" class="form-control" name="invoice_date"
                                   id="invoice-date" placeholder="Complaint">
                        </div>
                    </div>
                    
                    @csrf
                    <div class="box-body">
                        <table class="table table-bordered" id="item_table">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Unit</th>
                                <th>Cost</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><select name="invoice[0][product]" class="form-control item_category" data-sub_category_id="0"><option value="">Select Category</option></select></td>
                                <td><select name="invoice[0][product]" class="form-control item_category" data-sub_category_id="0"><option value="">Select Category</option></select></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-dark add">Add Issue</button>
                    
                    
                    <div class="form-group" id="invoice-total">
                    
                    </div>
                    
                    <br>
                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary" >Submit</button>
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
				html += '<tr>';
				html += '<td><select name="invoice[' + count + '][product]" class="form-control item_category" data-sub_category_id="' + count + '"><option value="">Select Category</option></select></td>';
				html += '<td><input type="number" name="invoice[' + count + '][unit]" class="form-control item_sub_category" id="item_sub_category' + count + '" /></td>';
				html += '<td ><input type="number" name="invoice[' + count + '][quantity]" class="form-control item_name" /></td>';
				html += '<td ><input type="number" name="invoice[' + count + '][total]" class="form-control item_total" /></td>';
				html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove">Remove</button></td></tr>';
				$('tbody').append(html);
			});
			
			$(document).on('click', '.remove', function () {
				$(this).closest('.addedSection').remove();
				// $("div.addedSection").first().remove()
			});
			
			
			$(document).on('change', '.item_category', function () {
				var category_id = $(this).val();
				console.log(category_id);
				var sub_category_id = $(this).data('sub_category_id');
				$.ajax({
					url: "/fill_sub_category",
					method: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						"category_id": category_id
					},
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function (data) {
						var html = '<option value="">Select Sub Category</option>';
						html += data;
						$('#item_sub_category' + sub_category_id).html(html);
					}
				})
			});
			$('#insert_form').on('submit', function (event) {
				event.preventDefault();
				var error = '';
				$('.item_name').each(function () {
					var count = 1;
					if ($(this).val() == '') {
						error += '<p>Enter Item name at ' + count + ' Row</p>';
						return false;
					}
					count = count + 1;
				});
				
				$('.item_category').each(function () {
					var count = 1;
					
					if ($(this).val() == '') {
						error += '<p>Select Item Category at ' + count + ' row</p>';
						return false;
					}
					
					count = count + 1;
					
				});
				
				
				$('.item_sub_category').each(function () {
					
					var count = 1;
					
					if ($(this).val() == '') {
						error += '<p>Select Item Sub category ' + count + ' Row</p> ';
						return false;
					}
					
					count = count + 1;
					
				});
				
				var form_data = $(this).serialize();
				
				if (error == '') {
					$.ajax({
						url: "insert.php",
						method: "POST",
						data: form_data,
						success: function (data) {
							if (data == 'ok') {
								$('#item_table').find('tr:gt(0)').remove();
								$('#error').html('<div class="alert alert-success">Item Details Saved</div>');
							}
						}
					});
				} else {
					$('#error').html('<div class="alert alert-danger">' + error + '</div>');
				}
			});
		});
    </script>
@stop


