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
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                <form method="post" action="{{ url('/admin/invoice/store') }}" enctype="multipart/form-data">
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

                        <div class="col-md-2 btn complaint">Add Complaint</div>
                        <div class="col-md-2 btn assets">Add Assets</div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4" id="complaint" style="display: none">
                            <label for="complaint">Complaint</label>
                            <input type="text" class="form-control search" data-type="complaint"
                                   id="complaint_text"  placeholder="Complaint" />
                            <div id="complaintList"></div>
                            <input type="hidden" class="form-control"   name="complaint"
                                   id="complaintVal" placeholder="Complaint" />
                        </div>
                        <div class="form-group col-md-4" id="assets"  style="display: none">
                            <label for="asset">Assets</label>
                            <input type="text" class="form-control search" data-type="asset"
                                                                    id="assets_text" placeholder="Assets">
                            <input type="hidden" class="form-control"  name="assets"
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
                                <td><input type="hidden" name="invoice[0][product]" class="form-control item_product" />
                                    <input type="text"  class="form-control item_product" data-type="product" data-count="0"/>
                                    <div id="invoiceList0"></div>
                                </td>
                                <td><input type="number" name="invoice[0][unit]"  class="form-control item_unit calculate price" id="unit0" value="3" /></td>
                                <td><input type="number" name="invoice[0][quantity]" data-count="0" id="quantity0" class="form-control qty item_quantity calculate" value="12"/></td>
                                <td>
                                    <input type="number" name="invoice[0][total]" class="form-control item_total" readonly value="36" /></td>
                                <td><button type="button" class="add btn btn-primary">Add</button>
                                    <button type="button" class="remove btn btn-primary">Remove</button>
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
                                    <input type="number" name='sub_total' placeholder='0.00' class="form-control total_amount" id="sub_total" readonly/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <a href="/admin/quote/createpdf" class="form_submit btn btn-primary" >Create Pdf</a>

                        <button class="form_submit btn btn-primary" >Save</button>
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
                html += '<td><input type="hidden" name="invoice[' + count + '][product]" class="form-control item_product" data-type="product" data-count="'+count+'" id="product'+count+'"><input type="text"  class="form-control item_product" id="producttext'+count+'" ><div id="invoiceList'+count+'"></td>';
                html += '<td><input type="number" name="invoice[' + count + '][unit]"   class="form-control item_unit calculate price" id="unit'+count+'" value="12"/></td>';
                html += '<td><input type="number" name="invoice[' + count + '][quantity]"   class="form-control item_quantity calculate qty" id="quantity'+count+'" value="6"/></td>';
                html += '<td><input type="number" name="invoice[' + count + '][total]" class="form-control item_total" value="144" readonly/><div class="showtotal"></div></td>';
                html += '<td><button type="button" id="[' + count + ']" class="btn btn-danger btn-xs add">Add</button><button type="button" class="btn btn-danger btn-xs remove">Remove</button></td></tr>';
                $('tbody').append(html);
            });

            $('#item_table tbody').on('keyup change',function(){
                calc();
            });
            $('#tax').on('keyup change',function(){
                calc_total();
            });

            $(document).on('keyup', '.search', function () {
                var type = $(this).data('type');
                var count = $(this).data('count');
                var query = $(this).val();

                if(query != '') {
                	console.log('lksdfkllksad');
                	console.log(type);
                	console.log(count);
                	console.log(query);
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
                            console.log('data')
                            console.log(data)
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

			}

            $(document).on('click', 'li.comp', function(){
                $('#complaint_text').val($(this).text());
                $('#complaintVal').val($(this).data('id'));
                $('#complaintList').fadeOut();
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


