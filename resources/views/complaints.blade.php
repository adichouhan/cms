@extends('layouts.app')
@section('content')

        <div class="text-center">
                <div><h3>Maintenance Complaints</h3></div>
            <div class="col-2"></div>
        </div>
        <div class="row pt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <a href="/register/complaint" class="text-white btn btn-primary btn-lg btn-block">Book Complaint/Maintenance call</a>
                <a href="/complaints" class="text-white btn btn-secondary btn-lg btn-block">View booked complaints</a>
                <a href="/complaint/invoices"  class="text-white btn btn-primary btn-lg btn-block">View Bills/Invoices</a>
                <a href="/complaint/quotes"  class="text-white btn btn-secondary btn-lg btn-block">View Quotation </a>
                <a href=""  class="text-white btn btn-primary btn-lg btn-block">Other Request</a>
                <a href=""  class="text-white btn btn-secondary btn-lg btn-block">Bulk order</a>
            </div>
            <div class="col-3"></div>
        </div>
@stop
