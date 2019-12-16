@extends('admin.admin_template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Complaints</h3>
        </div>
        <div align="left">
            <a href="{{ url('admin/complaints/create') }}" class="btn btn-info">Add New </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 160px;">Compleint ID</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">Complaints</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 183px;">Location</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 135px;">Expected Date</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">Priority</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">Material</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($arrObjComplaints as $objComplaints)
                                <tr role="row" class="odd">
                                <td class="sorting_1">{{$objComplaints->id}}</td>
                                <td>    @if(json_decode($objComplaints->complaints) != null || json_decode($objComplaints->complaints) != '')
                                        @foreach(json_decode($objComplaints->complaints) as $index =>$objComplaint)
                                            {{$index}}
                                                <?php
                                                    $category=\App\Category::where('id', $objComplaint->main)->first();
                                                    $subCategory=\App\SubCategory::where('id', $objComplaint->sub)->first();
                                                ?>
                                                {{$category->category_title}}:{{$subCategory->subcategory_title}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{$objComplaints->location}}</td>
                                <td>{{$objComplaints->expected_date}}</td>
                                <td>{{$objComplaints->priority}}</td>
                                <td>{{$objComplaints->maerials}}</td>
                                <td>
                                    <a href="{{url('admin/complaints/edit/'.$objComplaints->id)}}" class="btn btn-primary">Edit</a>
                                    <form action="{{url('admin/complaints/delete/'.$objComplaints->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                                </tr>
                                    @endforeach

                            </tbody>

                        </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

