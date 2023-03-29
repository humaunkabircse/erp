@extends('layouts.master')
@section('style')

@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Production Create</h3>
                    <a href="{{ route('production.master.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Production list</a>
                </div>
            </div>
            <div class="card-body">
            <form action="{{route('production.master.store')}}" method="POST">
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
                                @if($getItem)
                                <tr>
                                    @php
                                    $production_id = \App\Models\ProductionMaster::latest()->first();
                                    if($production_id){
                                    $batch_number = 'PBN-'.'0'.$production_id->id;
                                    }else{
                                    $batch_number = 'PBN-'.'01';
                                    }
                                    @endphp
                                    <td width="15%">
                                   
                                    <input type="text" class="form-control form-control-sm" name="batch_number" value="{{$batch_number}}" readonly>
                                    </td>
                                    <td width="25%">
                                    <input type="text" class="form-control form-control-sm" value="{{$getItem->item_name}}" readonly>
                                    </td>
                                    <input type="hidden" name="item_id" value="{{$getItem->id}}">
                                    <td width="15%"><input type="date" class="form-control form-control-sm" name="production_date" value="{{ date('Y-m-d') }}">
                                    @if($errors->has('production_date'))
                                <p class="text-danger">{{ $errors->first('production_date') }} </p>
                                @endif
                                </td>
                                    <td width="10%"><input type="text" class="form-control form-control-sm prod_qty" name="prod_qty" id="prod_qty"></td>
                                    <td width="15%"><input type="number" class="form-control form-control-sm" name="item_price" id="item_price" value="{{$getItem->item_price}}" readonly></td>
                                    <td width="15%"><input class="form-control form-control-sm" type="text" id="total_price" readonly></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                    @if($getItemRm)
                        <table class="table table-bordered text-center" id="tableContent">

                            <thead>
                                <tr>
                                    <th>RM Name</th>
                                    <th>RM Qty</th>
                                    <th>Rm Unit</th>
                                    <th>RM Price</th>
                                    <th>Wastage</th>
                                    <th>Total Rm Qty</th>
                                    <th>Total Wastage</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                @foreach($getItemRm as $rmItem)
                                <tr class="itemrow">
                                    <input type="hidden" name="rm_item_id[]" value="{{$rmItem->used_item_id}}">
                                    <td width="30%"><input type="text" class="form-control form-control-sm" value="{{\App\Models\Items::where('id',$rmItem->used_item_id)->value('item_name')}}"></td>
                                    <td width="10%">
                                    <input type="number" name="rm_item_qty[]" id="rm_item_qty" class="form-control form-control-sm rm_item_qty" value="{{$rmItem->used_item_qty}}" readonly>  
                                    </td>
                                    <td><input type="text" class="form-control form-control-sm" value=" {{$rmItem->used_item_unit}}"></td>
                                    <td>
                                    <input type="text" name="rm_item_price[]" id="rm_item_price" class="form-control form-control-sm" value="{{\App\Models\Items::where('id',$rmItem->used_item_id)->value('item_price')}}" readonly> 
                                    </td>
                                    <td width="10%"><input type="text" name="wastage_quantity[]" id="wastage_quantity" class="form-control form-control-sm wastage_quantity" value="{{$rmItem->wastage_quantity}}"></td>

                                    <td width="15%"><input type="text" id="total_rm_qty" class="form-control form-control-sm total_rm_qty" value="" readonly></td>

                                    <td width="15%"><input type="text" id="total_wastage_qty" class="form-control form-control-sm total_wastage_qty" value="" readonly></td>
                                </tr>
                                @endforeach
                           
                            </tbody>

                        </table>
                        @endif
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
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
$(document).on("keyup","#item_price",function(){
        var item_price = $(this).val();
        var prod_qty = $("#prod_qty").val();
        var total_price = prod_qty * item_price;
        $("#total_price").val(total_price);
    });
// $("#alldata").keyup(function() {
// var share = this.value;
//  $('tr.itemrow').each(function () {
//   $(this).find('.price1').each(function(){
//    var tdval = $(this).text();
//    $(".result").text(share * tdval);
//   });     
//  });
// });

$(function(){
    $(document).on("keyup","#prod_qty",function(){
        // var prod_qty = $(this).val();
            $('tr.itemrow').each(function () {
                $(this).find('.rm_item_qty').each(function(){
                    var rm_qty = $(this).val();
                    var prod_qty = $('#prod_qty').val();
                    var total_rm = prod_qty * rm_qty;
                    var rm_wastage =  $('.wastage_quantity').val()
                    var total_wastage_qty = prod_qty * rm_wastage;
                    $(".total_rm_qty").val(total_rm);
                    $(".total_wastage_qty").val(total_wastage_qty);

                }); 

                // var rm_qty =  $('#rm_item_qty').val()
                // var rm_wastage =  $('#wastage_quantity').val()
                // var total_rm = parseFloat(rm_qty) + parseFloat(rm_wastage);
                // var total_rm_qty = prod_qty * total_rm;
                // var total_wastage_qty = prod_qty * rm_wastage;
                // $("#total_rm_qty").val(total_rm_qty);
                // $("#total_wastage_qty").val(total_wastage_qty);
        });       
    });
    // $(document).on("keyup","#wastage_quantity",function(){
    //     var rm_wastage = $(this).val();
    //         $("#tableContent tbody").each(function () {
    //             var rm_qty =  $('#rm_item_qty').val();
    //             var rm_price =  $('#rm_item_price').val();
    //             var prod_qty =  $('#prod_qty').val();
    //             var total_rm = parseFloat(rm_qty) + parseFloat(rm_wastage);
    //             var total_rm_qty = prod_qty * total_rm;
    //             var total_wastage_qty = prod_qty * rm_wastage;
    //             $("#total_rm_qty").val(total_rm_qty);
    //             $("#total_wastage_qty").val(total_wastage_qty);
                
    //     });       
    // });
 

});
//rm used
// $(function(){
//     $(document).on("keyup","#rm_item_qty",function(){
//         var rm_item_qty = $(this).val();
//         var rm_item_price = $("#rm_item_price").val();
//         var rm_total_price = rm_item_qty * rm_item_price;
//         $("#rm_total_price").val(rm_total_price);
//     });
// });
// $(function(){
//     $(document).on("keyup","#rm_item_price",function(){
//         var rm_item_price = $(this).val();
//         var rm_item_qty = $("#rm_item_qty").val();
//         var rm_total_price = rm_item_qty * rm_item_price;
//         $("#rm_total_price").val(rm_total_price);
//     });
// });


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