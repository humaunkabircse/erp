@extends('layouts.master')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-8 col-md-8  offset-md-2 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Expences Category create</h3>
                    <a href="{{ route('expenses.category.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Expences Category list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('expenses.category.store') }}" method="POST">
                @csrf
                <div class="card-body" style="background:#F7F7F7">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Expenses Category Name</label>
                            <input type="text" class="form-control" name="expenses_cat_name"/>
                            @if($errors->has('expenses_cat_name'))
                            <p class="text-danger">{{ $errors->first('expenses_cat_name') }} </p>
                            @endif
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                      
                            <div class="form-group">
                                <label for="">Expenses Category Note</label>
                                <textarea rows="5" name="expenses_cat_note" class="form-control form-control-sm"  placeholder="Write note hare..">
                                {{ old('asset_deprecation_note') }}
                                </textarea>
                                @if($errors->has('expenses_cat_note'))
                                <p class="text-danger">{{ $errors->first('expenses_cat_note') }} </p>
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