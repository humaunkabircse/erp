<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
       
    <title>Challan</title>
    <style>
        .signature{
            margin-top:130px;
            display:flex;
            
        }

        .signature .item-1{
        margin-right:50px;
        width:23%
        }
        .signature .item-2{
        margin-right:50px;
        width:23%
        }
        .signature .item-3{
        margin-right:50px;
        width:23%
        }
        .signature .item-4{
        width:26%
        }
        .invoice{
            text-align:center;
            font-size:26px;
        }
        .in_word{
            margin-top:30px;
        } 
        .clearfix{
            margin-bottom:300px
        }
        .challan{
            width:20%;
            margin-left:240px;
            background-color:#333!important;
            padding:2px 5px;
            /* border:1px solid #333;
            border-radius:5px; */
            text-align:center;
            font-size:26px;
        }

    </style>
</head>
<body>
<div class="container">
           <!-- <div class="row">
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
            </div> -->

            <div class="row">
                <div class="col-md-12 col-12 pb-2">     
                    <h2 class="text-center" style="text-align:center">METHAN PLASTIC INDUSTRIES</h2>
                    <p class="text-center" style="text-align:center">Vill: Bevage, Post: Baruipara, Mirpur, Kushtia <br> Email: Mehbuba@methanplastic.com, <br> Web: www.methanplastic.com<br> Cell: +8801955-462558</p>
                </div>
               
                <div class="challan">Challan</div>
              
                <div class="col-md-12 col-12">
                    <table class="table table-bordered text-center" style="width:100%">
                        <tr>
                            <th style="width:30%">Customer Name</th>
                            <td style="width:70%;text-align:left" colspan="2">{{$customerinfo->cus_company}}</td>
                        </tr>
                        <tr style="width:25%">
                            <th style="width:30%">Address</th>
                            <td style="width:70%;text-align:left" colspan="2">{{$customerinfo->street}},{{$customerinfo->city}},{{$customerinfo->district}},{{$customerinfo->zip}},{{$customerinfo->country}}</td>
                        </tr>
                        <tr>
                            <th style="width:30%">Purchase Order No</th>
                            <td style="width:35%"></td>
                            <td style="width:35%;text-align:left">Challan No: {{$invoiceMasterInfo->invoice_number}}</td>
                        </tr>
                        <tr>
                            <th style="width:30%">Date</th>
                            <td style="width:35%"></td>
                            <td style="width:35%;text-align:left">Challan Date: {{date('d-m-Y', strtotime($invoiceMasterInfo->invoice_date))}}</td>
                        </tr>

                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 col-12">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th style="text-align:center">SL#</th>
                            <th style="text-align:center">Description</th>
                            <th style="text-align:center">Quantity(Pcs)</th>
                        </tr>
                        @foreach( $invoiceData as $item)
                        <tr>
                            <td width="10%">{{$loop->iteration}}</td>
                            <td width="30%">{{$item->item_name}}</td>
                            <td width="20%">{{$item->item_qty}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            


</div>

<div class="container mt-5">
<div class="row pt-3 signature">
                <div class="col-lg-3 col-md-3 col-12 item-1" style="font-size:12px">
                    <p>Received By</p>
                </div>
                <div class="col-lg-3 col-md-3 col-12 item-2" style="font-size:12px">
                    <p>Prepared By</p>
                </div>
                <div class="col-lg-3 col-md-3 col-12 item-3" style="font-size:12px">
                    <p>Recommended</p>
                </div>
                <div class="col-lg-3 col-md-3 col-12 item-4" style="font-size:12px">
                    <p>Authorised Signature</p>
                </div>
            </div>
</div>


<script>
    /**
 * jQuery printPage Plugin
 * @version: 1.0
 * @author: Cedric Dugas, http://www.position-absolute.com
 * @licence: MIT
 * @desciption: jQuery page print plugin help you print your page in a better way
 */

 
  
</script> 
</body>

</html>