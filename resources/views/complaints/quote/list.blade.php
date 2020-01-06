@extends('layouts.default')
@section('content')
<!-- /.card-header -->
<div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length"
                                                                                        aria-controls="example1"
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
                            aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                            style="width: 160px;">Invoice ID
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="Browser: activate to sort column ascending" style="width: 207px;">Complaint
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="Browser: activate to sort column ascending" style="width: 207px;">Asset
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="Browser: activate to sort column ascending" style="width: 207px;">Invoice Date
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="Browser: activate to sort column ascending" style="width: 207px;">Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($arrObjQuotes->count()>0)
                    @foreach($arrObjQuotes as  $objQuotes)
                        <tr>
                            <td>{{$objQuotes->id}}</td>
                            <td>{{isset($objQuotes->complaint)?$objInvoice->complaint:'NA'}}</td>
                            <td>{{isset($objQuotes->asset)?$objInvoice->asset:'NA'}}</td>
                            <td>{{$objQuotes->invoice_date}}</td>
                            <td>
                                <a href="{{url('quotes/view/'.$objQuotes->id)}}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center"> No Records found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    @stop
