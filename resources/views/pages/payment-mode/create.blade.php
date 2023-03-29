@extends('layouts.master')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-8 col-md-8 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Payment Mode Create</h3>
                    <a href="{{ route('payment.mode.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Payment Mode list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('payment.mode.store') }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Payment Mode</label>
                            <input type="text" class="form-control form-control-sm" name="pay_mode"/>
                            @if($errors->has('pay_mode'))
                            <p class="text-danger">{{ $errors->first('pay_mode') }} </p>
                            @endif
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Payment Number</label>
                            <input type="text" class="form-control form-control-sm" name="pay_number"/>
                            @if($errors->has('pay_number'))
                            <p class="text-danger">{{ $errors->first('pay_number') }} </p>
                            @endif
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                      
                            <div class="form-group">
                                <label for="">Payment Note</label>
                                <textarea rows="4" name="pay_note" class="form-control form-control-sm"  placeholder="Write note hare..">
                                {{ old('pay_note') }}
                                </textarea>
                                @if($errors->has('pay_note'))
                                <p class="text-danger">{{ $errors->first('pay_note') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                     <div class="row">
                     <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="active" {{ old('status')=='active'?'selected' : '' }}>
                                        Active</option>
                                    <option value="inactive" {{ old('status')=='inactive'?'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                @if($errors->has('status'))
                                <p class="text-danger">{{ $errors->first('status') }} </p>
                                @endif
                            </div>                            
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>          
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')


@endsection