@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
    <form>
        <div>
            <div id="addsection"></div>
        </div>
        <button type="button" class="btn btn-dark add" >Add Issue</button>

        <div class="form-group">
            <label for="location">Location(Branch Name)*</label>
            <input type="text" class="form-control" id="location" placeholder="">
        </div>
        <div class="form-group col-md-4">
            <label for="inputState">Priority</label>
            <select id="inputState" class="form-control">
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" placeholder="">
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="datetime-local" class="form-control" id="location" placeholder="">
        </div>


        <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
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
                html += '<div><input type="text" name="item_name_issue[]" class="form-control item_name" />';
                html += '<select name="item_category_issue[]" class="form-control item_category" data-sub_category_id="'+count+'"><option value="">Select Category</option></select></td>';
                html += '<select name="item_sub_category_issue[]" class="form-control item_sub_category" id="item_sub_category'+count+'"><option value="">Select Sub Category</option></select>';
                html += '<button type="button" name="remove" class="btn btn-danger btn-xs remove">+</button></div>';
                $('#addsection').append(html);
            });

            $(document).on('click', '.remove', function(event){
                $(this).parent().remove();
            });

            $(document).on('change', '.item_category', function(){
                var category_id = $(this).val();
                var sub_category_id = $(this).data('sub_category_id');
               var arrjava =
                    var html = '<option value="">Select Sub1 Category</option>';
                    var html = '<option value="">$row->category_title</option>';
                    html += data;
                    $('#item_sub_category' + sub_category_id).html(html);
                }
                // $.ajax({
                //     url:"fill_sub_category.php",
                //     method:"POST",
                //     data:{category_id:category_id},
                //     success:function(data)
                //     {
                //         var html = '<option value="">Select Sub1 Category</option>';
                //         html += data;
                //         $('#item_sub_category'+sub_category_id).html(html);
                //     }
                // })
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


