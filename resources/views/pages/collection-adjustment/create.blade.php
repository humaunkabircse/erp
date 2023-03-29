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
                    <h3 class="card-title">Adjustment Create</h3>
                    <a href="{{ route('collection.adjustment.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i>Adjustment list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('collection.adjustment.store') }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">

                    <div class="form-group row">
                    @php
                    $collection_id = \App\Models\CollectionAdjustment::latest()->first();
                    if($collection_id){
                        $collection_number = 'COL-ADJ-'.'0'.$collection_id->id+1;
                    }else{
                        $collection_number = 'COL-ADJ-'.'01';
                    }
                    
                    @endphp
                        <label for="staticName" class="col-md-4 col-form-label">Collection Number</label>
                        <div class="col-md-8">
                            <input type="text" id="staticName" class="form-control form-control-sm" name="collection_adjustment_number"  value="{{$collection_number}}" readonly />
                        </div>


                    </div>
                    <div class="form-group row">

                        <label for="staticName" class="col-md-4 col-form-label">Customer Name</label>
                        <div class="col-md-8">
                            <select id="staticName" class="form-control form-control-sm" name="cus_id" required>
                                <option selected disabled>Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->cus_company}}</option>
                            @endforeach
                            </select>

                            @if($errors->has('cus_id'))
                            <p class="text-danger">{{ $errors->first('cus_id') }} </p>
                            @endif
                        </div>


                    </div>
                    <div class="form-group row">

                        <label for="staticName" class="col-md-4 col-form-label">Adjustment Date</label>
                        <div class="col-md-8">
                            <input type="date" id="staticName" class="form-control form-control-sm" name="collection_adjustment_date" value="{{date('Y-m-d')}}" required />

                            @if($errors->has('collection_adjustment_date'))
                            <p class="text-danger">{{ $errors->first('collection_adjustment_date') }} </p>
                            @endif
                        </div>


                        </div>


                    <div class="form-group row">
                        <label for="adjustmentAmount" class="col-md-4 col-form-label">Adjustment Amount</label>
                        <div class="col-md-8">
                            <input type="text" id="adjustmentAmount" class="form-control form-control-sm" name="collection_adjustment_amount" required />
                            @if($errors->has('collection_adjustment_amount'))
                            <p class="text-danger">{{ $errors->first('collection_adjustment_amount') }} </p>
                            @endif
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="staticShortName" class="col-md-4 col-form-label">Adjustment Purpose</label>
                        <div class="col-md-8">
                            <textarea  class="form-control form-control-sm" type="text" name="collection_adjustment_purpose" rows="5">

                            </textarea>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>

        </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('scripts')


@endsection