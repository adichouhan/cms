@extends('layouts.app')
@section('content')

            <div class="text-center">
                <div class=""><h3>AssetsRequest</h3></div>
            </div>

           <div class="row pt-5">
            <div class="col-3"></div>
            <div class="col-6">
            <a href="/book-asset" class="btn btn-primary btn-lg btn-block">Book New Asset Request</a>
            <a href="/view/assets" class="btn btn-secondary btn-lg btn-block">View Booked Asset Request</a>
            <a href="/assets/invoices" type="button" class="btn btn-primary btn-lg btn-block">View Bills/Invoices</a>
            <a href="/assets/quotes" type="button" class="btn btn-secondary btn-lg btn-block">View Quotation </a>
            <a href="#" type="button" class="btn btn-primary btn-lg btn-block">Other Request</a>
            <a href="#" type="button" class="btn btn-secondary btn-lg btn-block">Bulk order</a>
               </div>
            <div class="col-3"></div>
        </div>
@stop
