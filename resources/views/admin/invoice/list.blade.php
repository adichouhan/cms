@extends('admin.admin_template')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Invoice</h3>
    </div>

    <div align="left">
        <a href="{{ url('admin/invoice/create') }}" class="btn btn-info">Add New Invoice</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
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
                                aria-label="Browser: activate to sort column ascending" style="width: 207px;">Download/View
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                aria-label="Browser: activate to sort column ascending" style="width: 207px;">Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($arrObjInvoices as  $objInvoice)
                                <tr>
                                    <td>{{$objInvoice->id}}</td>
                                    <td>{{isset($objInvoice->complaint)?$objInvoice->complaint:'NA'}}</td>
                                    <td>{{isset($objInvoice->asset)?$objInvoice->asset:'NA'}}</td>
                                    <td>{{$objInvoice->invoice_date}}</td>
                                    <td>
                                        <a href="{{url("/admin/invoice/view/".$objInvoice->id)}}" class="btn btn-primary">View</a>
                                        <a href="{{url("/admin/invoice/download/".$objInvoice->id)}}" class="btn btn-primary">Download</a>
                                    </td>
                                    <td>
                                        <a href="{{url('admin/invoice/edit/'.$objInvoice->id)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('admin/invoice/delete/'.$objInvoice->id)}}" class="btn btn-danger"> Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
