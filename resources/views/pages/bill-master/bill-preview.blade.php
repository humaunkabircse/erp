@extends('layouts.master')
@section('style')
<style>
    .report-item {
        height: 80px;
        width: 200px;
        background-color: red;
        padding-top: 30px;
        text-align: center;
        font-size: 18px;
    }

    .report-item a {
        color: #fff
    }

</style>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/datatable/css')}}/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h4>Bill Details</h4>
                    </div>
                    <div>
                    <a href="{{route('bill.print',$id)}}" class="btn btn-warning btn-sm btnprint"><i class="fa fa-print" aria-hidden="true"></i></a>
                    </div>
                  
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 col-12">

                        <table class="table table-bordered text-center">                          
                            <tr>
                                <th style="width:30%">Invoice No:</th>
                                <td style="width:35%;text-align:left">{{$invoice->invoice_number}}</td>
                            </tr>
                            <tr>
                                <th style="width:30%">Invoice Date:</th>
                                <td style="width:35%;text-align:left">
                                    {{date('d-m-Y', strtotime($invoice->invoice_date))}}</td>
                            </tr>
                        </table>
                        </div>
                        <div class="col-md-2 col-12">
                                <p class="text-center bg-dark p-2 mt-4 text-white">Bill</p>
                        </div>
                        <div class="col-md-5 col-12">

                        <table class="table table-bordered text-center"> 
                            <tr style="width:25%">
                                <th style="width:30%">BIll No:</th>
                                <td style="width:70%;text-align:left" colspan="2">{{$billMasterInfo->bill_number}}</td>
                            </tr>
                            <tr>
                                <th style="width:30%">Bill Date:</th>
                                <td style="width:35%;text-align:left">
                                    {{date('d-m-Y', strtotime($billMasterInfo->bill_date))}}</td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                    <p class="mb-3">Name/Company :{{$customerinfo->cus_company}}</p>
                    <p>Address: {{$customerinfo->district}}, {{$customerinfo->country}}</p>
                    </div>
                    <table class="display table-bordered table-striped text-center"
                        style="border-color:white;font-size:12px;" width="100%">
                        <thead>
                            <tr style="background:#395697;color:#fff;font-size:11px;">
                                <th>SL#</th>
                                <th>Item Name</th>
                                <th>Item Qty</th>
                                <th>Unit Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $total_amount=0;
                            @endphp
                            @foreach($billDetails as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->item_name}}</td>
                                <td>{{$item->item_qty}}</td>
                                <td>{{$item->item_price}}</td>
                                <td>{{$item->item_qty * $item->item_price}}</td>
                            </tr>
                            @php
                            $total_amount +=$item->item_qty * $item->item_price
                            @endphp
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total:</td>
                                <td>{{$total_amount}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- <script src="{{ asset('backend/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{asset('backend/datatable/js')}}/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable({
            scrollY: 370,
            scrollX: true,
            scroller: true,
        });
    });

</script>
<!--Select2 support-->
<!-- <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
<script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script> -->
<!--Select2 cdn support-->
<!-- <script type="text/javascript">
    $(".select2").select2();

</script> -->
<script>
    $(document).ready(function () {
        jQuery('.btnprint').printPage();
    });

</script>
@endsection
