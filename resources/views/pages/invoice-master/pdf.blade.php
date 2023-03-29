<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>Invoice</title>
</head>
<body>
<div class="container">
<div class="row">
    <div class="col-md-8 offset-md-2">
    <!-- <a href="{{route('invoice.pdf',$invoiceMasterInfo->id)}}" type="button" class="btn btn-outline-warning btn-sm">Export to Pdf</a> -->
    <div class="row">
        <div class="col-md-2 col-12">
            <div class="navbar-brand">
                <a href="{{route('home')}}"><img src="{{asset('backend')}}/assets/images/logo.png" alt="" width="120px" height="50px"></a>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <h5 class="text-center">MITHEN PLASTIC INDUSTRIES</h5>
            <p class="text-center">Vill: Bevage, Post: Baruipara, Mirpur, Kushtia <br> Email: Mehbuba@methanplastic.com, <br> Web: www.methanplastic.com<br> Cell: +8801955-462558</p>
        </div>
        <div class="col-md-2 col-12">

        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <table class="table table-bordered text-center">
                <tr>
                    <th>Invoice No</th>
                    <td>{{$invoiceMasterInfo->invoice_number}}</td>
                </tr>
                <tr>
                    <th>Invoice Date</th>
                    <td>{{date('d-m-Y', strtotime($invoiceMasterInfo->invoice_date))}}</td>
                </tr>
                <tr>
                    <th>PWD NO</th>
                    <td></td>
                </tr>

            </table>
        </div>
        <div class="col-md-2">
            <span class="myTable">Bill</span>
        </div>
        <div class="col-md-5">
            <table class="table table-bordered text-center">
                <tr>
                    <th style="width:50%">Bill No</th>
                    <td></td>
                </tr>
                <tr>
                    <th style="width:50%">Bill Date</th>
                    <td></td>
                </tr>
                <tr>
                    <th style="width:50%">PWD NO</th>
                    <td></td>
                </tr>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">

            <p>Name/company: {{$customerinfo->name}}</p>


            <p>Address: {{$customerinfo->street}},{{$customerinfo->city}},{{$customerinfo->district}},{{$customerinfo->zip}},{{$customerinfo->country}}</p>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <table class="table table-bordered text-center">
                <tr>
                    <th>SL#</th>
                    <th>Description</th>
                    <th>Quantity(Pcs)</th>
                    <th>Unit Price</th>
                    <th>Total Price(Taka)</th>
                </tr>
               
                @foreach( $invoiceData as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->item_name}}</td>
                    <td>{{$item->item_qty}}</td>
                    <td>{{$item->item_price}}</td>
                    <td class="force">{{$item->item_qty * $item->item_price}}</td>
                   
                </tr>
               
                @endforeach
                <tr>

                    <td colspan="4">Subtotal:</td>
                    <td id="total_forces"></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 col-12">
            In Word (Taka) ----------------------------------------------------------------------------
        </div>
    </div>
    <div class="row mt-5 pt-3">
        <div class="col-md-3 col-12" style="font-size:12px">
            <p>Received By</p>
        </div>
        <div class="col-md-3 col-12" style="font-size:12px">
        <p>Prepared By</p> 
        </div>
        <div class="col-md-3 col-12" style="font-size:12px">
        <p>Recommended</p>
        </div>
        <div class="col-md-3 col-12" style="font-size:12px">
        <p>Authorised Signature</p>
        </div>
    </div>
    </div>
</div>
</div>
<script>
    $(function() {
        var a = 0;
        $('.force').each(function() {
            a += parseInt($(this).text());
        });
        $('#total_forces').text(a);
    });
</script>
</body>
</html>