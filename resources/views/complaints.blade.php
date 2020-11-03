@extends('layouts.app')
@section('content')

        {{--<div class="text-center">--}}
                {{--<div><h3>Maintenance Complaints</h3></div>--}}
            {{--<div class="col-2"></div>--}}
        {{--</div>--}}
        {{--<div class="row pt-5">--}}
            {{--<div class="col-3"></div>--}}
            {{--<div class="col-6">--}}
                {{--<a href="/register/complaint" class="text-white btn btn-primary btn-lg btn-block">Book Complaint/Maintenance call</a>--}}
                {{--<a href="/complaints" class="text-white btn btn-secondary btn-lg btn-block">View booked complaints</a>--}}
                {{--<a href="/complaint/invoices"  class="text-white btn btn-primary btn-lg btn-block">View Bills/Invoices</a>--}}
                {{--<a href="/complaint/quotes"  class="text-white btn btn-secondary btn-lg btn-block">View Quotation </a>--}}
                {{--<a href=""  class="text-white btn btn-primary btn-lg btn-block">Other Request</a>--}}
                {{--<a href=""  class="text-white btn btn-secondary btn-lg btn-block">Bulk order</a>--}}
            {{--</div>--}}
            {{--<div class="col-3"></div>--}}
        {{--</div>--}}

        <section id="tabs">
            <div class="container">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <a href="/register/complaint" class="link" id="book_maintenance">Book Complaint/Maintenance call</a>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <a href="/complaints" class="link" id="view_booked">View booked complaints</a>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <a href="/complaint/invoices" class="link" id="view_bills">View Bills/Invoices</a>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <a href="/complaint/quotes" class="link" id="view_quotation">View Quotation</a>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <a href="#" class="link" id="other_request">Other Request</a>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <a href="#" class="link" id="bulk_order">Bulk order</a>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider text-center">
            <img class="img-fluid" src="img/line.png"><br>
            <h4 class="mt-2"><b>Please select the service you want to book</b></h4>
        </div>

        <div class="service_book">
            <div class="container text-center">
                <div class="row mt-5 mb-4">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">
                        <a href="/my-complaints" id="maintain_img"><img class="img-fluid img1" src="img/Maintenance-Complaints.png"  style="display: none;">
                            <img class="img-fluid imgw1" src="img/Maintenance-Complaints_w (1).png"></a>

                        <p><b>Maintenance Complaints</b></p>
                    </div>

                    <div class="col-md-2">
                        <a href="/my-assets" id="asset_img"><img class="img-fluid img2" src="img/Asset-Request (1).png">
                            <img class="img-fluid imgw2" src="img/Asset-Request_w.png" style="display: none;"></a>
                        <p><b>Asset Request</b></p>
                    </div>

                    <div class="col-md-2">
                        <a href="#" id="contact_img"><img class="img-fluid img3" src="img/Contact-Us.png">
                            <img class="img-fluid imgw3" src="img/Contact-Us_w.png" style="display: none;"></a>
                        <p><b>Contact Us</b></p>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            $("a.link").click(function () {
                $("a.link").css({ "background-color": "#fff", "color": "#000" });
                $(this).css({ "background-color": "#FDBF42", "color": "#000" });
            });
            // $(".img1").click(function(){
            //     $(this).attr("src", "images/Maintenance-Complaints_w (1).png");
            // });
            $("#maintain_img").click(function() {
                $(this).find('img').toggle();
            });
            $("#asset_img").click(function() {
                $(this).find('img').toggle();
            });
            $("#contact_img").click(function() {
                $(this).find('img').toggle();
            });

        </script>
@stop
