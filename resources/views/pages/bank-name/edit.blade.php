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
                    <h3 class="card-title">Bank Name Edit</h3>
                    <a href="{{ route('bank.name.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Bank Name list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('bank.name.update',$bankName->id) }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">

                    <div class="form-group row">

                        <label for="staticName" class="col-md-3 col-form-label">Bank Name</label>
                        <div class="col-md-9">
                            <input type="text" id="staticName" class="form-control form-control-sm" name="bank_name" value="{{$bankName->bank_name}}"/>

                            @if($errors->has('bank_name'))
                            <p class="text-danger">{{ $errors->first('bank_name') }} </p>
                            @endif
                        </div>


                    </div>


                    <div class="form-group row">
                        <label for="staticShortName" class="col-md-3 col-form-label">Bank Short Name</label>
                        <div class="col-md-9">
                            <input type="text" id="staticShortName" class="form-control form-control-sm" name="bank_short_name" value="{{$bankName->bank_short_name}}"/>
                            @if($errors->has('bank_short_name'))
                            <p class="text-danger">{{ $errors->first('bank_short_name') }} </p>
                            @endif
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