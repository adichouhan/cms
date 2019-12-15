@extends('admin.admin_template')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-7">
            <?php
            $arrComplaint=[];
            if(!empty($objComplaints->complaints)){
                foreach (json_decode($objComplaints->complaints) as $complaint){
                    array_push($arrComplaint, $complaint);
                }
            }

            dd($output);

            ?>

            <form method="post" action="{{ url('register/complaint/') }}" enctype="multipart/form-data">
                <div class="box-body">
                    @csrf
                    <div>
                        <div id="addsection">
                            @foreach($arrComplaint as $index=>$complaint)
                                <div><select name="complaint['.index.'][main]" class="form-control item_category" data-sub_category_id="'+count+'"><option value="">Select Category</option>{!! $output !!}</select></td>

                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark add" >Add Issue</button>

                    <div class="form-group">
                        <label for="location">Location(Branch Name)*</label>
                        <input type="text" class="form-control" id="location" value="{{isset($objComplaints->location)?$objComplaints->location:''}}" name="location" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Priority</label>
                        <select id="inputState" class="form-control" name="priority">
                            <option value="low" {{(isset($objComplaints->priority) && $objComplaints->priority=='low')? 'selected':'' }}>Low</option>
                            <option value="medium" {{(isset($objComplaints->priority) && $objComplaints->priority=='medium')? 'selected':'' }}>Medium</option>
                            <option value="high" {{(isset($objComplaints->priority) && $objComplaints->priority=='high')? 'selected':'' }}>High</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Expected Date</label>
                        <input type="datetime-local" class="form-control" name="expdate" value="{{isset($objComplaints->expected_date)?$objComplaints->expected_date:''}}" id="date" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="material">Material(if any)</label>
                        <input type="text" class="form-control" value="{{isset($objComplaints->expected_date)?$objComplaints->expected_date:''}}"   name="material" id="material" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">photo upload</label>
{{--                        <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" >--}}
                        <input type="file" name="image" value="{{ $objComplaints->image }}"   />
                        <img src="{{asset($objComplaints->image)}}" class="img-thumbnail" width="100" />
                        <input type="hidden" name="hidden_image" value="{{ $objComplaints->image }}" />
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var count = 0;

        $(document).on('click', '.add', function(){
            count++;
            var html = '';

            html += '<div><select name="complaint['+count+'][main]" class="form-control item_category" data-sub_category_id="'+count+'"><option value="">Select Category</option>{!! $output !!}</select></td>';
            html += '<div><select name="complaint['+count+'][sub]" class="form-control item_sub_category" id="item_sub_category'+count+'"><option value="">Select Sub Category</option></select></div>';
            html += '<div class="addedSection"><input type="text" name="complaint['+count+'][name]" class="form-control item_name" />';
            html += '<div><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-minus"></span></button></div>';
            $('#addsection').append(html);
        });

        $(document).on('click', '.remove', function(){
            // $(this).closest('.addedSection').remove();
            $("div.addedSection").first().remove()
        });

        $(document).on('change', '.item_category', function(){
            var category_id = $(this).val();
            console.log(category_id);
            var sub_category_id = $(this).data('sub_category_id');
            $.ajax({
                url:"/fill_sub_category",
                method:"POST",
                data:{"_token": "{{ csrf_token() }}",
                    "category_id":category_id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data)
                {
                    var html = '<option value="">Select Sub Category</option>';
                    html += data;
                    $('#item_sub_category'+sub_category_id).html(html);
                }
            })
        });
        $('#insert_form').on('submit', function(event){
            event.preventDefault();
            var error = '';
            $('.item_name').each(function(){
                var count = 1;
                if($(this).val() == '')
                {
                    error += '<p>Enter Item name at '+count+' Row</p>';
                    return false;
                }
                count = count + 1;
            });

            $('.item_category').each(function(){
                var count = 1;

                if($(this).val() == '')
                {
                    error += '<p>Select Item Category at '+count+' row</p>';
                    return false;
                }

                count = count + 1;

            });


            $('.item_sub_category').each(function(){

                var count = 1;

                if($(this).val() == '')
                {
                    error += '<p>Select Item Sub category '+count+' Row</p> ';
                    return false;
                }

                count = count + 1;

            });

            var form_data = $(this).serialize();

            if(error == '')
            {
                $.ajax({
                    url:"insert.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        if(data == 'ok')
                        {
                            $('#item_table').find('tr:gt(0)').remove();
                            $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
                        }
                    }
                });
            }
            else
            {
                $('#error').html('<div class="alert alert-danger">'+error+'</div>');
            }
        });
    });
</script>
@stop


