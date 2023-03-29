@extends('layouts.master')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-8 col-md-8 offset-md-2 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Stock Adjustment Edit</h3>
                    <a href="{{ route('stock.adjustment.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i>Adjustment list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('stock.adjustment.update',$stockAdjustment->id) }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">

                    <div class="form-group row">
                    @php
                    $stock_id = \App\Models\StockAdjustment::latest()->first();
                    if($stock_id){
                        $stock_number = 'ST-ADJ-'.'0'.$stock_id->id+1;
                    }else{
                        $stock_number = 'ST-ADJ-'.'01';
                    }
                    
                    @endphp
                        <label for="staticName" class="col-md-5 col-form-label">Stock Adjustment Number:</label>
                        <div class="col-md-7">
                            <input type="text" id="staticName" class="form-control form-control-sm" name="stock_adjustment_Number"  value="{{$stockAdjustment->stock_adjustment_Number}}" readonly />
                        </div>


                    </div>
                    <div class="form-group row">

                        <label for="staticName" class="col-md-5 col-form-label">Item Name:</label>
                        <div class="col-md-7">
                            <select id="staticName" class="form-control form-control-sm" name="item_id" required>
                                <option selected disabled>Select Customer</option>
                            @foreach($items as $item)
                                <option value="{{$item->id}}" {{$stockAdjustment->item_id==$item->id?'selected':''}}>{{$item->item_name}}</option>
                            @endforeach
                            </select>

                            @if($errors->has('item_id'))
                            <p class="text-danger">{{ $errors->first('item_id') }} </p>
                            @endif
                        </div>


                    </div>
                    <div class="form-group row">

                        <label for="staticName" class="col-md-5 col-form-label"> Stock Adjustment Date:</label>
                        <div class="col-md-7">
                            <input type="date" id="staticName" class="form-control form-control-sm" name="stock_adjustment_date" value="{{$stockAdjustment->stock_adjustment_date}}" required />

                            @if($errors->has('stock_adjustment_date'))
                            <p class="text-danger">{{ $errors->first('stock_adjustment_date') }} </p>
                            @endif
                        </div>


                        </div>


                    <div class="form-group row">
                        <label for="adjustmentQty" class="col-md-5 col-form-label">Adjustment Add Qty:</label>
                        <div class="col-md-7">
                            <input type="text" id="adjustmentQty" class="form-control form-control-sm" name="stock_adjustment_addition_qty" value="{{$stockAdjustment->stock_adjustment_addition_qty}}"/>
                            @if($errors->has('stock_adjustment_addition_qty'))
                            <p class="text-danger">{{ $errors->first('stock_adjustment_addition_qty') }} </p>
                            @endif
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="adjustmentsqty" class="col-md-5 col-form-label">Adjustment Subtruaction Qty:</label>
                        <div class="col-md-7">
                            <input type="text" id="adjustmentsqty" class="form-control form-control-sm" name="stock_adjustment_subtraction_qty" value="{{$stockAdjustment->stock_adjustment_subtraction_qty}}"/>
                            @if($errors->has('stock_adjustment_subtraction_qty'))
                            <p class="text-danger">{{ $errors->first('stock_adjustment_subtraction_qty') }} </p>
                            @endif
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="staticShortName" class="col-md-5 col-form-label">Stock Adjustment Purpose:</label>
                        <div class="col-md-7">
                            <textarea  class="form-control form-control-sm" type="text" name="stock_adjustment_purpose" rows="3">
                            {{$stockAdjustment->stock_adjustment_purpose}}
                            </textarea>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </div>

        </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('scripts')


@endsection