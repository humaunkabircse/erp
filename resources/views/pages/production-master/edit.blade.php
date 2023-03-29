@extends('layouts.master')
@section('style')

@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Production Edit</h3>
                    <a href="{{ route('production.master.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Production list</a>
                </div>
            </div>
            <div class="card-body">
            <form action="{{route('production.master.update',$productItem->id)}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <table class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Batch Number</th>
                                    <th>Item Name</th>
                                    <th>Production Date</th>
                                    <th>qty</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td width="15%">
                                    <input type="text" class="form-control form-control-sm" name="batch_number" value="{{$productItem->batch_number}}">
                                    </td>
                                    <td width="25%"> 
                                    <input type="text" class="form-control form-control-sm" value="{{\App\Models\Items::where('id',$productItem->item_id)->value('item_name')}}">
                                    </td>
                                    <td width="15%"><input type="date" class="form-control form-control-sm" name="production_date" value="{{$productItem->production_date}}"></td>
                                    <td width="10%"><input type="text" class="form-control form-control-sm" name="prod_qty" id="prod_qty" value="{{$productItem->prod_qty}}"></td>
                                    <td width="15%"><input type="number" class="form-control form-control-sm" name="item_price" id="item_price" value="{{$productItem->item_price}}" readonly></td>
                                    <td width="15%"><input class="form-control form-control-sm" type="text" id="total_price" value="{{$productItem->item_price*$productItem->prod_qty}}" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                
                        <table class="table table-bordered text-center" id="tableContent">

                            <thead>
                                <tr>
                                    <th>RM Name</th>
                                    <th>RM Qty</th>
                                    <th>Unit</th>
                                    <th>RM Price</th>
                                    <th>Wastage</th>
                                    <th>Total_rm_qty</th>
                                    <th>Total Wastage</th>
                                </tr>
                            </thead>
                            <tbody>
        
                @foreach($rawMaterials as $rmItem)
                <tr>
                    <input type="hidden" name="rm_item_id[]" value="{{$rmItem->rm_item_id}}">
                    <td width="30%">
                    <input type="text" class="form-control form-control-sm" value="{{\App\Models\Items::where('id',$rmItem->rm_item_id)->value('item_name')}}"> 
                    </td>
                    @php
                    $bomDetails= \App\Models\BomDetails::where('used_item_id',$rmItem->rm_item_id)->first();
                    @endphp
                    <td width="10%">
                    <input type="number" name="rm_item_qty[]" id="rm_item_qty" class="form-control form-control-sm" value="{{$bomDetails->used_item_qty}}" readonly>  
                    </td>
                    @php
                    $item_id= \App\Models\Items::where('id',$rmItem->rm_item_id)->first();
                    @endphp
                    <td><input type="text" class="form-control form-control-sm" value="{{\App\Models\ItemUnit::where('id',$item_id->item_unit)->value('unit_name')}}"></td>
                    <td>
                    <input type="text" name="rm_item_price[]" id="rm_item_price" class="form-control form-control-sm" value="{{$rmItem->rm_item_price}}" readonly> 
                    </td>
                    <td width="10%"><input type="text" name="wastage_quantity[]" id="wastage_quantity" class="form-control form-control-sm" value="{{$bomDetails->wastage_quantity}}"></td>
                    <td width="15%"><input type="text" id="total_rm_qty" class="form-control form-control-sm" value="{{$rmItem->total_rm_item_qty}}" readonly></td>
                    <td width="15%"><input type="text" id="total_wastage_qty" class="form-control form-control-sm" value="{{$rmItem->total_wastage_qty}}" readonly></td>
                </tr>
                @endforeach
                           
                            </tbody>

                        </table>
                        
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </div>
                    
                </div>
            </div>
            </form>

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
<!-- <script src="{{ asset('backend/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/handlebars.min.js') }}"></script> -->
<!--Select2 support-->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
<script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>
<!--Select2 cdn support-->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<script type="text/javascript">
    $(".select2").select2();
</script>

<script type="text/javascript">
$(function(){
    $(document).on("keyup","#prod_qty",function(){
        var prod_qty = $(this).val();
        var item_price = $("#item_price").val();
        var total_price = prod_qty * item_price;
        $("#total_price").val(total_price);
    });
});

$(function(){
    $(document).on("keyup","#prod_qty",function(){
        var prod_qty = $(this).val();
        var rm_qty   = $('#rm_item_qty').closest('tr').val();
        var wastage_quantity   = $('#wastage_quantity').closest('tr').val();
        var total_rm_qty = prod_qty *(rm_qty + wastage_quantity);
        $("#total_rm_qty").val(total_rm_qty);
        
    });
    $(document).on("keyup","#prod_qty",function(){
        var prod_qty = $(this).val();
        var wastage_quantity   = $('#wastage_quantity').closest('tr').val();
        var total_ws_qty = prod_qty * wastage_quantity;
        $("#total_wastage_qty").val(total_ws_qty);       
    });
    $(document).on("keyup","#wastage_quantity",function(){
        var wastage_quantity = $(this).closest('tr').val();
        var prod_qty   = $('#prod_qty').val();
        var total_ws_qty = prod_qty * wastage_quantity;
        $("#total_wastage_qty").val(total_ws_qty);       
    });

    // $(document).on("keyup","#item_price",function(){
    //     var item_price = $(this).val();
    //     var prod_qty = $("#prod_qty").val();
    //     var total_price = prod_qty * item_price;
    //     $("#total_price").val(total_price);
    // });
});
//rm used
$(function(){
    $(document).on("keyup","#rm_item_qty",function(){
        var rm_item_qty = $(this).val();
        var rm_item_price = $("#rm_item_price").val();
        var rm_total_price = rm_item_qty * rm_item_price;
        $("#rm_total_price").val(rm_total_price);
    });
});
$(function(){
    $(document).on("keyup","#rm_item_price",function(){
        var rm_item_price = $(this).val();
        var rm_item_qty = $("#rm_item_qty").val();
        var rm_total_price = rm_item_qty * rm_item_price;
        $("#rm_total_price").val(rm_total_price);
    });
});


$(document).ready(function() {
    $(document).on('change',"#item_id",function(){
        var item_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });     
       $.ajax({
            type:"GET",
            url:"{{route('rm.item.info')}}",
            data:{
                'item_id' :item_id,
            },
            dataType: "json",
            success:function(response){
                $('#rm_item_name').val(response.rm_item_name.item_name);
                $('#rm_item_id').val(response.rm_item_info.used_item_id);
                $('#rm_item_qty').val(response.rm_item_info.used_item_qty);
            }
       });
       });

    });
</script>

@endsection