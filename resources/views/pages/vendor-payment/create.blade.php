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
                    <h3 class="card-title">Vendor Payment Create</h3>
                    <a href="{{ route('vendor.payment.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Vendor Payment list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('vendor.payment.store') }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                                <label>Vendor Name</label>
                                <select class="form-control" name="vendor_id">
                                    <option selected disabled>--Select Vendor--</option>
                                    @foreach($vendors as $vendor)
                                    <option value="{{$vendor->id}}">{{$vendor->vendor_company}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('vendor_id'))
                                <p class="text-danger">{{ $errors->first('vendor_id') }} </p>
                                @endif
                            </div>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                                <label>Payment Mode</label>
                                <select class="form-control" name="pay_mode">
                                    <option selected disabled>--Select Payment Mode--</option>
                                    @foreach($paymentMode as $pmode)
                                    <option value="{{$pmode->id}}">{{$pmode->pay_mode}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('pay_mode'))
                                <p class="text-danger">{{ $errors->first('pay_mode') }} </p>
                                @endif
                            </div>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Check Number</label>
                            <input type="text" class="form-control form-control-sm" name="cheque_no"/>
                            @if($errors->has('cheque_no'))
                            <p class="text-danger">{{ $errors->first('cheque_no') }} </p>
                            @endif
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Check Date</label>
                            <input type="date" class="form-control form-control-sm" name="cheque_date" value="{{date('Y-m-d')}}"/>
                            @if($errors->has('cheque_date'))
                            <p class="text-danger">{{ $errors->first('cheque_date') }} </p>
                            @endif
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                                <label>Bank Name</label>
                                <select class="form-control" name="bank_name_id">
                                    <option selected disabled>--Select Bank Name--</option>
                                    @foreach($bankName as $bank)
                                    <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('bank_name_id'))
                                <p class="text-danger">{{ $errors->first('bank_name_id') }} </p>
                                @endif
                            </div>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Payment Date</label>
                            <input type="date" class="form-control form-control-sm" name="pay_date"  value="{{date('Y-m-d')}}" required/>
                            @if($errors->has('pay_date'))
                            <p class="text-danger">{{ $errors->first('pay_date') }} </p>
                            @endif
                        </div>    
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Payment Amount</label>
                            <input type="number" class="form-control form-control-sm" name="pay_amount" required/>
                            @if($errors->has('pay_amount'))
                            <p class="text-danger">{{ $errors->first('pay_amount') }} </p>
                            @endif
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                      
                            <div class="form-group">
                                <label for="">Payment Note</label>
                                <textarea rows="5" name="pay_note" class="form-control form-control-sm"  placeholder="Write note hare..">
                                {{ old('pay_note') }}
                                </textarea>
                                @if($errors->has('pay_note'))
                                <p class="text-danger">{{ $errors->first('pay_note') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                     <button type="submit" class="btn btn-primary">Save Payment</button>
                    </div>          
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')


@endsection