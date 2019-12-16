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
        <button type="button" class="btn btn-primary btn-lg btn-block"><a href="/">Book Complaint/Maintenance call</button>
        <button type="button" class="btn btn-secondary btn-lg btn-block">View booked complaints</button>
        <button type="button" class="btn btn-primary btn-lg btn-block">View Bills/Invoices</button>
        <button type="button" class="btn btn-secondary btn-lg btn-block">View Quotation </button>
        <button type="button" class="btn btn-primary btn-lg btn-block">Other Request</button>
        <button type="button" class="btn btn-secondary btn-lg btn-block">Bulk order</button>
               </div>
            <div class="col-3"></div>
        </div>
    </div>
@stop
