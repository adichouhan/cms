@extends('layouts.app')
@section('content')
<!-- /.card-header -->
<div class="card container">
    <div class="card-header">
        <h3 class="card-title">Assets Invoice</h3>
    </div>
<div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
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
                    @if($arrObjInvoices->count()>0)
                    @foreach($arrObjInvoices as  $objInvoice)
                        <tr>
                            <td>{{$objInvoice->id}}</td>
                            <td>{{ $objInvoice->getUserAssets()->first('title')->title }}</td>
                            <td>{{$objInvoice->invoice_date}}</td>
                            <td>
                                <a href="{{url('assets/invoice/view/'.$objInvoice->id)}}" target="_blank" class="btn btn-primary">View</a>
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
</div>
@stop
