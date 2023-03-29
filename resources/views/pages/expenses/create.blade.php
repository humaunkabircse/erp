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
                    <h3 class="card-title">Expenses Create</h3>
                    <a href="{{ route('expenses.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Expences list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="form-group">
                                <label for="">Expenses Name</label>
                                <input type="text" class="form-control" name="expenses_name" placeholder="Write Expense Name"/>
                                @if($errors->has('expenses_name'))
                                <p class="text-danger">{{ $errors->first('expenses_name') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Expenses Amount</label>
                                <input type="text" class="form-control" name="expenses_amount" placeholder="Enter Amount"/>
                                @if($errors->has('expenses_amount'))
                                <p class="text-danger">{{ $errors->first('expenses_amount') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Expenses Date</label>
                                <input type="date" class="form-control" name="expenses_date" value="{{date('Y-m-d')}}"/>
                                @if($errors->has('expenses_date'))
                                <p class="text-danger">{{ $errors->first('expenses_date') }} </p>
                                @endif
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label>Expenses Category</label>
                                <select class="form-control" name="expenses_category">
                                    <option selected disabled>--Select Category--</option>
                                    @foreach($expensesCategory as $item)
                                    <option value="{{$item->id}}">{{$item->expenses_cat_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('expenses_category'))
                                <p class="text-danger">{{ $errors->first('expenses_category') }} </p>
                                @endif
                            </div> 
                            <div class="form-group">
                                <label>Customer ID</label>
                                <select class="form-control" name="cust_id">
                                    <option selected disabled>--Select Customer--</option>
                                    @foreach($customers as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('cust_id'))
                                <p class="text-danger">{{ $errors->first('cust_id') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Payment Mode</label>
                                <select class="form-control" name="pay_mode">
                                    <option selected disabled>--Select Payment--</option>
                                    @foreach($paymentMode as $item)
                                    <option value="{{$item->id}}">{{$item->pay_mode}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('pay_mode'))
                                <p class="text-danger">{{ $errors->first('pay_mode') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Payment Tax</label>
                                <input type="number" class="form-control" name="pay_tax"/>
                                @if($errors->has('pay_tax'))
                                <p class="text-danger">{{ $errors->first('pay_tax') }} </p>
                                @endif
                            </div>  

                        </div>
                        
                    </div>

                     <button type="submit" class="btn btn-primary">Submit</button>
                </div>          
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')


@endsection