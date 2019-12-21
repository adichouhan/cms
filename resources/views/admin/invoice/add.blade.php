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
                                   id="product_name" required placeholder="Product name">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="invoice-date">Invoice Date</label>
                            <input type="datetime-local"required class="form-control" name="invoice_date"
                                   id="invoice-date" placeholder="">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="complaint">Complaint</label>
                            <input type="text" class="form-control" required name="complaint"
                                   id="complaint" placeholder="Complaint">
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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><select name="invoice[0][product]" class="form-control item_product" data-sub_category_id="0"><option value="check">check</option></select></td>
                                <td><input type="number" name="invoice[' + count + '][unit]" class="form-control item_sub_category" id="item_sub_category' + count + '" /></td>'
                                <td><input type="number" name="invoice[' + count + '][quantity]" class="form-control item_name" /></td>
                                <td><input type="number" name="invoice[' + count + '][total]" class="form-control item_total" /></td>
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
                                <div class="col-6">
                                    Total
                                </div>
                                <div class="col-6 total">

                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary" >Save</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>


    <script>
        $(document).ready(function () {
            var count = 1;

            $(document).on('click', '.item_add', function () {
                console.log(this)
                count++;
                var html = '';
                html += '<tr class="addedSection">';
                html += '<td><select name="invoice[' + count + '][product]" class="form-control item_product" data-product_id="' + count + '"><option value="">Select Category</option></select></td>';
                html += '<td><input type="number" name="invoice[' + count + '][unit]" class="form-control item_sub_category" id="item_sub_category' + count + '" /></td>';
                html += '<td><input type="number" name="invoice[' + count + '][quantity]" class="form-control item_name" /></td>';
                html += '<td><input type="number" name="invoice[' + count + '][total]" class="form-control item_total" /></td>';
                html += '<td><button type="button" class="btn btn-danger btn-xs add">Add</button><button type="button" class="btn btn-danger btn-xs remove">Remove</button></td></tr>';
                $('tbody').append(html);
            });

            $(document).on('click', '.remove', function () {
                $(this).closest('.addedSection').remove();
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


