@extends('admin.admin_template')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Sub-Category</div>
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
                    <form method="post" action="{{ url('admin/subcategory/edit/'.$objSubCategory->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">SubCategory Name*</label>
                            <input type="text"  id="name" class="form-control" required value="{{@isset($objSubCategory->category_title) ? $objSubCategory->category_title : ''}}" name="subcategory_name" >
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" id="category" data-type="category" class="search form-control">
                            <input type="hidden" id="categoryId" class="search" name="parent_id">
                            <div id="categoryList"></div>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
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

        $(document).on('click', 'li.category', function(){
            $('#category').val($(this).text());
            $('#categoryId').val($(this).data('id'));
            $('#categoryList').fadeOut();
        });
    </script>
@stop
