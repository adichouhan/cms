@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                <?php
                $count = 0;
                $arrComplaint = [];
                if (!empty($objComplaints->complaints)) {
                    foreach (json_decode($objComplaints->complaints) as $complaint) {
                        array_push($arrComplaint, $complaint);
                    }
                }
                ?>
                    <form method="post" action="{{ url('update/complaint') }}" enctype="multipart/form-data">
                        <div class="box-body">
                            @csrf

                            @foreach($arrComplaint as $index=>$complaint)
                                <?php

                                $count++;
                                $data = \App\Category::all();
                                $selectedCat = '';
                                foreach ($data as $item) {
                                    $selectedCat .= '<option value="' . $item["id"] . '"';
                                    if ($complaint->main == $item["id"]) {
                                        $selectedCat .= 'selected >' . $item["category_title"] . '</option>';
                                    } else {
                                        $selectedCat .= '>' . $item["category_title"] . '</option>';
                                    }

                                }

                                $data = \App\SubCategory::where('parent_id', $complaint->main)->get();

                                $selectedSubCat = '';
                                foreach ($data as $item) {
                                    $selectedSubCat .= '<option value="' . $item["id"] . '"';
                                    if ($complaint->sub == $item["id"]) {
                                        $selectedSubCat .= 'selected >' . $item["subcategory_title"] . '</option>';
                                    } else {
                                        $selectedSubCat .= '>' . $item["subcategory_title"] . '</option>';
                                    }
                                }

                                ?>
                            <div>
                                <div id="addsection">
                                    <div class="form-group">
                                    <select name="complaint[{{$count}}][main]"
                                            class="form-control item_category"
                                            data-sub_category_id="{{$count}}">
                                        <option value="">Select Category</option>{!! $selectedCat !!}</select>
                                    </div>
                                    <div class="form-group"><select name="complaint[{{$count}}][sub]" class="form-control item_sub_category"
                                                 id="item_sub_category{{$count}}">
                                            <option value="">Select Sub Category</option>{!! $selectedSubCat !!}</select>
                                    </div>

                                    <div class="form-group"><input type="text" name="complaint[{{$count}}][name]"
                                                class="form-control item_name"/></div>
                                    <div>
                                    <div class="form-group">
                                        <button type="button" name="remove" class="btn btn-danger btn-xs remove">Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div id="addsection">
                            </div>

                            <button type="button" class="btn btn-dark add" >Add Issue</button>
                            <div class="form-group">
                                <label for="location">Location(Branch Name)*</label>
                                <input type="text" class="form-control" id="location" {{isset($objComplaints->location)?$objComplaints->location:''}} name="location" placeholder="" value="{{$objComplaints->location}}">
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
                                <input type="datetime" class="form-control" name="expdate" id="date" placeholder=""  value="{{date("m/d/Y h:i:s A ",strtotime($objComplaints->expected_date))}}">
                            </div>
                            <div class="form-group">
                                <label for="material">Materials</label>
                                <input type="text" class="form-control"  name="material" id="material" placeholder="" value="{{$objComplaints->maerials}}">
                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlFile1">Image Upload</label>
                                <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
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
                html += '<div class="addedSection"> <div  class="form-group"><input type="text" name="complaint['+count+'][name]" class="form-control item_name" /> </div>';
                html += '<div  class="form-group"><select name="complaint['+count+'][main]" class="form-control item_category" data-sub_category_id="'+count+'"><option value="">Select Category</option>{!! $output !!}</select></td> </div>';
                html += '<div  class="form-group"><select name="complaint['+count+'][sub]" class="form-control item_sub_category" id="item_sub_category'+count+'"><option value="">Select Sub Category</option></select></div>';
                html += '<div  class="form-group"><button type="button" name="remove" class="btn btn-danger btn-xs remove">Remove</button></div></div>';
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
