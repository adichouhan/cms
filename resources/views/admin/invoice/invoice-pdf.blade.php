<!doctype html>
<html lang="en">
<head>
    <!-- load bootstrap from a cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Invoice - #123</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            /*background-color: #60A7A6;*/
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="container">
<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <h3>John Doe</h3>
                <pre>
Street 15
123456 City
United Kingdom
<br /><br />
Date: 2018-01-01
Identifier: #uniquehash
Status: Paid
</pre>

            </td>
            <td align="center">
                <img src="/path/to/logo.png" alt="Logo" width="64" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">

                <h3>CompanyName</h3>
                <pre>
                    https://company.com

                    Street 26
                    123456 City
                    United Kingdom
                </pre>
            </td>
        </tr>

    </table>
</div>

    <div class="invoice">
        <h4>Invoice</h4>
        <hr>
        <table>
            <tr>
            <td>Invoice number</td>
            <td>{{$arrMix['invoice_id']}}</td>
            <td>
                @if(isset($arrMix['reciepient']))
                    {{$arrMix['reciepient']}}
                @endif
            </td>
            </tr>
            <tr>
            <td>Invoice Date</td>
            <td>{{$arrMix['invoice_date']}}</td>
            <td></td>
            </tr>
        </table>
    </div>


<br/>

<div class="">

    <table class="w-100 table text-center ">
        <thead>
        <tr>
            <th scope="col">Item</th>
            <th scope="col">Unit cost</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>

        @foreach( json_decode(json_decode($arrMix['invoice'])) as $index => $invoice)
            <tr>
                <td scope="row">{{ $invoice->product }}</td>
                <td>{{$invoice->unit}}</td>
                <td >{{$invoice->quantity}}</td>
                <td>{{$invoice->total}}</td>
                <?php
                    $subtotal ='';
                $subtotal=+$invoice->total;
                ?>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td >Total</td>
                <td  class="gray">{{$subtotal}}</td>
            </tr>
        </tfoot>
    </table>
</div>
</div>

</body>
</html>
