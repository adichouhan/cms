@extends('admin.admin_template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Assets Request</h3>
        </div>
        <div>
            <a href="{{ url('admin/assets/create') }}" class="btn btn-info">Add New </a>
        </div>

        <div>
            <a href="{{ url('admin/asset/product/create') }}" class="btn btn-info">Add New Product </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="example1_length"><label>Show
                                <select name="example1_length" aria-controls="example1"
                                        class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                                                                 class="form-control form-control-sm"
                                                                                                 placeholder=""
                                                                                                 aria-controls="example1"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width: 160px;">Assets ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 207px;">
                                    Assets
                                </th>
    
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 207px;">
                                    Assets Unique ID
                                </th>
                                
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 183px;">
                                    Location
                                </th>
                                
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending"
                                    style="width: 135px;">Expected Date
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Priority
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Material
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 95px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($arrObjAssets as $objasset)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$objasset->id}}</td>
                                    <td>
                                        {{$objasset->products}}
                                    </td>
                                    <td>
                                        {{$objasset->assets_unique}}
                                    </td>
                                    <td>{{$objasset->location}}</td>
                                    <td>{{$objasset->expected_date}}</td>
                                    <td>{{$objasset->priority}}</td>
                                    <td>{{$objasset->maerials}}</td>
                                    <td>
                                        <a href="{{url('admin/complaints/edit/'.$objasset->id)}}"
                                           class="btn btn-primary">Edit</a>
                                        <form action="{{url('admin/complaints/delete/'.$objasset->id)}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10
                            of 57 entries
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="example1_previous"><a
                                        href="#" aria-controls="example1" data-dt-idx="0" tabindex="0"
                                        class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="example1"
                                       data-dt-idx="1" tabindex="0"
                                       class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                          data-dt-idx="2" tabindex="0"
                                                                          class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                          data-dt-idx="3" tabindex="0"
                                                                          class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                          data-dt-idx="4" tabindex="0"
                                                                          class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                          data-dt-idx="5" tabindex="0"
                                                                          class="page-link">5</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                          data-dt-idx="6" tabindex="0"
                                                                          class="page-link">6</a></li>
                                <li class="paginate_button page-item next" id="example1_next">
                                    <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

