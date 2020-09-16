@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-12 text-center">
                <div>Please select the service you want to book</div>
                <div class="mt-5 mr-5">
                    <button type="button" class="btn btn-primary btn-lg   mr-4"><a href="/my-complaints" class="text-white">Maintenance Complaints</a></button>
                    <button type="button" class="btn btn-secondary btn-lg  ml-4"><a href="/my-assets" class="text-white">Asset Request</a></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <div class="mt-4 mr-4">
                    <button type="button" class="btn btn-secondary btn-lg "><a href="/others" class="text-white">Others</a></button>
                </div>
            </div>
        </div>
    </div>
@stop























































































