@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-2">Go Back</div>
            <div class="col-8 text-center">
                <div class=""><h3>Maintenance Complaints</h3></div>
                <div>please check options below</div>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row pt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <button type="button" class="btn btn-primary btn-lg btn-block"><a href="/register/complaint" class="text-white">Book Complaint/Maintenance call</a></button>
                <button type="button" class="btn btn-secondary btn-lg btn-block"><a href="/view_complaints" class="text-white">View booked complaints</a></button>
        <button type="button" class="btn btn-primary btn-lg btn-block"><a href="/complaint/invoices"  class="text-white">View Bills/Invoices</a></button>
                <button type="button" class="btn btn-secondary btn-lg btn-block"><a href="/complaint/quotes"  class="text-white">View Quotation </a></button>
        <button type="button" class="btn btn-primary btn-lg btn-block">Other Request</button>
        <button type="button" class="btn btn-secondary btn-lg btn-block">Bulk order</button>
               </div>
            <div class="col-3"></div>
        </div>
    </div>
@stop
