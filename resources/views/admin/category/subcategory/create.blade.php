@extends('admin.admin_template')
@section('content')
    <div class="box-body">
    <form method="post" action="{{ url('admin/subcategory/store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Category Name*</label>
                <input type="text"  id="name" required name="category_name" >
            </div>

        <div class="form-group">
            <label for="category">Users</label>
            <input type="text" id="category" data-type="category" class="form-control search">
            <input type="hidden" id="categoryId" class="form-control search" name="parent_id">
            <div id="categoryList"></div>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>


    <script>
        $(document).on('keyup', '.search', function () {
            var type = $(this).data('type');
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
            var htmlComplaint = '';
            htmlComplaint += '<ul class="dropdown-menu" style="display:block; position:relative">';

            if(type=='category'){
                data.forEach(function (category) {
                    htmlComplaint +='<li class="category" data-id="'+ category.id+'">'+ category.category_title+'</li> ';
                    $('#categoryList').children().remove();
                    $('#categoryList').append(htmlComplaint);
                })
            }
        }

        $(document).on('click', 'li.user', function(){
            $('#category').val($(this).text());
            $('#categoryId').val($(this).data('id'));
            $('#categoryList').fadeOut();
        });
    </script>
@stop
