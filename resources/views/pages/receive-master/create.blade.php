@extends('layouts.master')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Receive Create</h3>
                    <a href="{{ route('receive.master.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Receive list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
           <!-- Textual inputs start -->

                        <div class="card" style="background-color:#F7F7F7">
                            <div class="card-body">
                                <!-- <h3 class="header-title">Receive Item
                                    <a class="btn btn-success btn-sm float-right" href="{{ route('receive.type.index') }}">
                                        <i class="fa fa-list">Receive List</i></a>
                                </h3> -->
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-12">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label>Receive Type</label>
                                                    <select class="form-control form-control-sm select2" name="rec_type_id" id="rec_type_id">
                                                        <option selected disabled>Select Receive Type</option>
                                                        @foreach ($receiveTypes as $receiveType)
                                                            <option value="{{ $receiveType->id }}">
                                                                {{ $receiveType->receive_type_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-12">

                                                    <div class="form-group">
                                                            <label>Vendor</label>
                                                            <select class="form-control form-control-sm select2" name="vendor_id" id="vendor_id">
                                                                <option selected disabled>Select Vendor</option>
                                                                @foreach ($vendors as $vendor)
                                                                    <option value="{{ $vendor->id }}">
                                                                    {{ $vendor->vendor_company }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label>Invoice Number</label>
                                                    @php
                                                    $rec_id = \App\Models\ReceiveMaster::latest()->first();
                                                    if($rec_id){
                                                    $invoice_number = 'REC-'.'0'.$rec_id->id+1;
                                                    }else{
                                                    $invoice_number = 'REC-'.'01';
                                                    }
                                                    @endphp
                                                <input class="form-control form-control-sm" type="text" name="rec_invoice_number" id="rec_invoice_number" value="{{$invoice_number}}" readonly>
                                                </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <input class="form-control form-control-sm datepicker" type="date" name="rec_date" value="{{date('Y-m-d')}}" id="rec_date"/>
                                                </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12">
                                                <div class="form-group">
                                                    <label>Received By</label>
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="rec_by" id="rec_by">
                                                </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12">
                                                <div class="form-group">
                                                <label>Discount</label>
                                                <input class="form-control form-control-sm" type="number"
                                                    name="discount" id="discount">
                                                </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12">
                                                <div class="form-group">
                                                <label>Adjustment Quantity</label>
                                                <input class="form-control form-control-sm" type="number"
                                                    name="adjustment_qty" id="adjustment_qty">
                                                </div>
                                                </div>

                                            </div>

                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Received Note</label>
                                        <textarea class="form-control form-control-sm" rows="5" type="text"
                                            name="rec_note" id="rec_note">
                                        </textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Item Name</label>
                                        <select class="form-control form-control-sm select2" name="item_id" id="item_id">
                                            <option selected disabled>Select Item</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->item_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                <input type="hidden" name="item_name" id="item_name" />
                                    <div class="form-group col-md-2">
                                        <label>Qty</label>
                                        <input class="form-control form-control-sm" type="text"
                                            name="item_qty" id="item_qty"/>
                                    </div>
                                    <div class="form-group col-md-2">
                                    <label>Price</label>
                                    <input class="form-control form-control-sm" type="text"
                                        name="item_price" id="item_price"/>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Total Price</label>
                                        <input class="form-control form-control-sm" type="text"
                                            name="total_price" id="total_price"/>
                                    </div>

                                    <div class="form-group col-md-2" style="padding-top:28px;">
                                        <a class="btn btn-primary btn-sm addeventmore font-italic"><i
                                                class="fa fa-plus-circle"></i> Add item</a>
                                    </div>
                                </div>

                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <form action="{{ route('receive.master.store') }}" method="POST" id="myForm">
                                    @csrf
                                    <table class="table-sm table-bordered text-center" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Item Qty</th>
                                                <th>Item Price</th>
                                                <th>Total Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addRow" class="addRow">

                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm" id="storebutton">Submit</button>
                                    </div>
                                </form>
                            </div>

                    </div>
                    <!-- Textual inputs end -->
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#vendor_description').summernote({
            height: 100,
        });
    });
</script> -->
<script src="{{ asset('backend/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/handlebars.min.js') }}"></script>
<!--Select2 support-->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
<script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>
<!--Select2 cdn support-->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<script type="text/javascript">
        $(".select2").select2();
</script>
<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_item" id="delete_item">
        <input type="hidden" name= "rec_type_id" value="@{{ rec_type_id }}">
        <input type="hidden" name= "vendor_id" value="@{{ vendor_id }}">
        <input type="hidden" name= "rec_invoice_number" value="@{{ rec_invoice_number }}">
        <input type="hidden" name= "rec_date" value="@{{ rec_date }}">
        <input type="hidden" name= "rec_by" value="@{{ rec_by }}">
        <input type="hidden" name= "discount" value="@{{ discount }}">
        <input type="hidden" name= "adjustment_qty" value="@{{ adjustment_qty }}">
        <input type="hidden" name= "rec_note" value="@{{ rec_note }}">
        <input type="hidden" name= "item_id[]" value="@{{ item_id }}">
        <td>
            <input type="hidden" name= "item_name[]" class="form-control form-control-sm" value="@{{ item_name }}">
            @{{ item_name }}
        </td>
        <td>
            <input type="hidden" name= "item_qty[]" class="form-control form-control-sm" value="@{{ item_qty }}">
            @{{ item_qty }}
        </td>
        <td>
            <input type="hidden" name= "item_price[]" class="form-control form-control-sm" value="@{{ item_price }}">
            @{{ item_price }}
        </td>
        <td>
            <input type="hidden" class="form-control form-control-sm" value="">
            @{{ total_price }}
        </td>
        <td><i class="btn btn-danger btn-xs fa fa-window-close removeeventmore"></i></td>
    </tr>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".addeventmore", function() {
            var rec_type_id = $('#rec_type_id').val();
            var vendor_id = $('#vendor_id').val();
            var rec_invoice_number = $('#rec_invoice_number').val();
            var rec_date = $('#rec_date').val();
            var rec_by = $('#rec_by').val();
            var discount = $('#discount').val();
            var adjustment_qty = $('#adjustment_qty').val();
            var rec_note = $('#rec_note').val();

            var item_id = $('#item_id').val();
            var item_name = $('#item_name').val();
            var item_qty = $('#item_qty').val();
            var item_price = $('#item_price').val();
            var total_price = $('#total_price').val();

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                rec_type_id: rec_type_id,
                vendor_id:vendor_id,
                rec_invoice_number: rec_invoice_number,
                rec_date: rec_date,
                rec_by: rec_by,
                discount: discount,
                adjustment_qty: adjustment_qty,
                rec_note: rec_note,
                item_id: item_id,
                item_name: item_name,
                item_qty: item_qty,
                item_price: item_price,
                total_price: total_price,
            };
            var html = template(data);
            $("#addRow").append(html);
        });
        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest(".delete_item").remove();
        });

    });
</script>
<script type="text/javascript">
$(function(){
    $(document).on("keyup","#item_qty",function(){
        var item_qty = $(this).val();
        var item_price = $("#item_price").val();
        var total_price = item_qty * item_price;
        $("#total_price").val(total_price);
    });
});
$(function(){
    $(document).on("keyup","#item_price",function(){
        var item_price = $(this).val();
        var item_qty = $("#item_qty").val();
        var total_price = item_qty * item_price;
        $("#total_price").val(total_price);
    });
});

$(document).ready(function() {
       $(document).on('change','#item_id',function(){
        var item_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       $.ajax({
            type:"GET",
            url:"{{route('item.name.info')}}",
            data:{
                'item_id' :item_id,
            },
            dataType: "json",
            success:function(response){
                $('#item_name').val(response.item_info.item_name);
                $('#item_price').val(response.item_info.item_price);
            }
       });
       });
    });
</script>

@endsection
