@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Bom Edit</h3>
                    <a href="{{ route('bom.master.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Bom list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
           <!-- Textual inputs start -->
           <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h3 class="header-title">Receive Item
                                    <a class="btn btn-success btn-sm float-right" href="{{ route('receive.type.index') }}">
                                        <i class="fa fa-list">Receive List</i></a>
                                </h3> -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <select class="form-control form-control-sm select2" name="prod_item_id" id="prod_item_id" disabled>
                                            <option selected disabled>Select Item</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}" {{$bomMaster->prod_item_id==$item->id?'selected':''}}>
                                                    {{ $item->item_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    </div>  
                                </div>
                                <hr/>
                                <div class="row">
                                <div class="form-group col-md-3 col-12">
                                    <label>Material Item Name</label>
                                    <select class="form-control form-control-sm select2" name="used_item_id" id="used_item_id">
                                        <option selected disabled>Select Item</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->item_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                    <input type="hidden" name="used_item_name" id="used_item_name" />  
                                    <div class="form-group col-md-3 col-12">
                                        <label for="">Material Item Quantity</label>
                                        <input type="number" class="form-control form-control-sm" id="used_item_qty" name="used_item_qty" placeholder="Enter Item Quantity"/>
                                        @if($errors->has('used_item_qty'))
                                        <p class="text-danger">{{ $errors->first('used_item_qty') }} </p>
                                        @endif
                                    </div> 
                                    <div class="form-group col-md-3 col-12">
                                        <label>Material Item Unit</label>
                                        <input type="text" class="form-control form-control-sm" id="used_item_unit" name="used_item_unit"/>
                                    </div>
                                    <div class="form-group col-md-2 col-12">
                                    <label for="">Wastage Qty</label>
                                    <input type="number" class="form-control form-control-sm" id="wastage_quantity" name="wastage_quantity"/>
                                    @if($errors->has('wastage_quantity'))
                                    <p class="text-danger">{{ $errors->first('wastage_quantity') }} </p>
                                    @endif
                                </div> 
                                    
                                    <div class="form-group col-md-1" style="padding-top:28px;">
                                        <a class="btn btn-primary btn-sm addeventmore font-italic"><i
                                                class="fa fa-plus-circle"></i> Add</a>
                                    </div>
                                </div>
                               
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <form action="{{ route('bom.master.update',$bomMaster->id) }}" method="POST" id="myForm">
                                    @csrf
                                    <table class="table-sm table-bordered text-center" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Item Qty</th>
                                                <th>Item Unit</th>
                                                <th>Item Wastage</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addRow" class="addRow">
                                        @foreach(\App\Models\BomDetails::where('bom_master_id',$bomMaster->id)->get() as $item)
                                        <tr class="delete_item">
                                            <td width="30%">
                                                <input type="hidden" name="used_item_id[]" value="{{$item->used_item_id}}" />{{\App\Models\Items::where('id',$item->used_item_id)->value('item_name')}}

                                            </td>
                                            <td width="15%"><input type="hidden" name="used_item_qty[]" value="{{$item->used_item_qty}}" />
                                                {{$item->used_item_qty}}
                                            </td>
                                            <td width="10%"><input type="hidden" name="used_item_unit[]" value="{{$item->used_item_unit}}" />
                                                {{$item->used_item_unit}}
                                            </td>
                                            <td width="15%"><input type="hidden" name="wastage_quantity[]" value="{{$item->wastage_quantity}}" />
                                                {{$item->wastage_quantity}}
                                            </td>
                                            <td width="10%"><i class="btn btn-danger btn-xs fa fa-window-close removeeventmore"></i></td>

                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm" id="storebutton">Update</button>
                                    </div>
                                </form>
                            </div>
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
        <input type="hidden" name= "prod_item_id" value="@{{ prod_item_id }}">
        <input type="hidden" name= "used_item_id[]" value="@{{ used_item_id }}">
        <td>
            <input type="hidden" name= "used_item_name[]" class="form-control form-control-sm" value="@{{ used_item_name }}">
            @{{ used_item_name }}
        </td>
        <td>
            <input type="hidden" name= "used_item_qty[]" class="form-control form-control-sm" value="@{{ used_item_qty }}">
            @{{ used_item_qty }}
        </td>
        <td>
            <input type="hidden" name= "used_item_unit[]" class="form-control form-control-sm" value="@{{ used_item_unit }}">
            @{{ used_item_unit }}
        </td>
        <td>
            <input type="hidden" name= "wastage_quantity[]" class="form-control form-control-sm" value="@{{ wastage_quantity }}">
            @{{ wastage_quantity }}
        </td>
        <td><i class="btn btn-danger btn-xs fa fa-window-close removeeventmore"></i></td>
    </tr>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".addeventmore", function() {
            var prod_item_id = $('#prod_item_id').val();

            var used_item_id = $('#used_item_id').val();
            var used_item_name = $('#used_item_name').val();
            var used_item_qty = $('#used_item_qty').val();
            var used_item_unit = $('#used_item_unit').val();
            var wastage_quantity = $('#wastage_quantity').val();

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {             
                prod_item_id: prod_item_id,

                used_item_id: used_item_id,
                used_item_name: used_item_name,
                used_item_qty: used_item_qty,
                used_item_unit: used_item_unit,
                wastage_quantity: wastage_quantity,
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
$(document).ready(function() {
       $(document).on('change','#used_item_id',function(){
        var item_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });     
       $.ajax({
            type:"GET",
            url:"{{route('item.unit.name.info')}}",
            data:{
                'item_id' :item_id,
            },
            dataType: "json",
            success:function(response){
                $('#used_item_name').val(response.item_info.item_name);
                $('#used_item_unit').val(response.itemUnitName.unit_name);
            }
       });
       });
    });
</script>

@endsection