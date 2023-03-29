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
                    <h3 class="card-title">Payment Edit</h3>
                    <a href="{{ route('payment.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Payment list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('payment.update',$payment->id) }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                                <label>Customer Name</label>
                                <select class="form-control" name="cus_id">
                                    <option selected disabled>--Select Customer--</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}"{{$payment->cus_id==$customer->id?'selected':''}}>{{$customer->cus_company}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('cus_id'))
                                <p class="text-danger">{{ $errors->first('cus_id') }} </p>
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
                                    <option value="{{$pmode->id}}"{{$payment->pay_mode==$pmode->id?'selected':''}}>{{$pmode->pay_mode}}</option>
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
                            <input type="text" class="form-control form-control-sm" name="cheque_no" value="{{$payment->cheque_no}}"/>
                            @if($errors->has('cheque_no'))
                            <p class="text-danger">{{ $errors->first('cheque_no') }} </p>
                            @endif
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Check Date</label>
                            <input type="date" class="form-control form-control-sm" name="cheque_date" value="{{$payment->cheque_date}}" />
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
                                    <option value="{{$bank->id}}"{{$payment->bank_name_id==$bank->id?'selected':''}}>{{$bank->bank_name}}</option>
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
                            <input type="date" class="form-control form-control-sm" name="pay_date" value="{{$payment->pay_date}}"/>
                            @if($errors->has('pay_date'))
                            <p class="text-danger">{{ $errors->first('pay_date') }} </p>
                            @endif
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                                <label>Payment Receive By</label>
                                <select class="form-control" name="pay_receive_by">
                                    <option selected disabled>--Select Receive--</option>
                                    @foreach($agents as $agent)
                                    <option value="{{$agent->id}}"{{$payment->pay_receive_by==$agent->id?'selected':''}}>{{$agent->agent_fullname}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('pay_receive_by'))
                                <p class="text-danger">{{ $errors->first('pay_receive_by') }} </p>
                                @endif
                            </div>                        
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Payment Amount</label>
                            <input type="number" class="form-control form-control-sm" name="pay_amount" value="{{$payment->pay_amount}}"/>
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
                                {{ $payment->pay_note }}
                                </textarea>
                                @if($errors->has('pay_note'))
                                <p class="text-danger">{{ $errors->first('pay_note') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                     <button type="submit" class="btn btn-primary">Update Payment</button>
                    </div>          
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')


@endsection