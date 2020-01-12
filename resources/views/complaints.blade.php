@extends('layouts.app')
@section('content')

        <div class="text-center">
                <div><h3>Maintenance Complaints</h3></div>
            <div class="col-2"></div>
        </div>
        <div class="row pt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <button type="button" class="btn btn-primary btn-lg btn-block"><a href="/register/complaint" class="text-white">Book Complaint/Maintenance call</a></button>
                <button type="button" class="btn btn-secondary btn-lg btn-block"><a href="/complaints" class="text-white">View booked complaints</a></button>
        <button type="button" class="btn btn-primary btn-lg btn-block"><a href="/complaint/invoices"  class="text-white">View Bills/Invoices</a></button>
                <button type="button" class="btn btn-secondary btn-lg btn-block"><a href="/complaint/quotes"  class="text-white">View Quotation </a></button>
        <button type="button" class="btn btn-primary btn-lg btn-block">Other Request</button>
        <button type="button" class="btn btn-secondary btn-lg btn-block">Bulk order</button>
               </div>
            <div class="col-3"></div>
        </div>

@stop
