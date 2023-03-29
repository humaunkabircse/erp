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
                    <h3 class="card-title">Asset Register</h3>
                    <a href="{{ route('asset.register.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Asset Register list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('asset.register.update',$assetRegister->id) }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asset Name</label>
                                <input type="text" name="asset_name" value="{{$assetRegister->asset_name}}" class="form-control form-control-sm" id="exampleInputEmail1" value="{{ old('asset_name') }}" placeholder="Enter Name">
                                @if($errors->has('asset_name'))
                                <p class="text-danger">{{ $errors->first('asset_name') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Asset Type</label>
                                <select class="form-control" name="asset_type">
                                    <option selected disabled>Select Type</option>
                                    @foreach(\App\Models\AssetType::all() as $item)
                                    <option value="{{$item->id}}" {{$assetRegister->asset_type==$item->id?'selected':''}}>{{$item->asset_type_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('asset_type'))
                                <p class="text-danger">{{ $errors->first('asset_type') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Purchase Date</label>
                                <input type="date" name="asset_purshase_date" value="{{$assetRegister->asset_purshase_date}}" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Enter purshase date">
                                @if($errors->has('asset_purshase_date'))
                                <p class="text-danger">{{ $errors->first('asset_purshase_date') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="form-group">
                                <label for="description">Asset Note</label>
                                <textarea class="form-control form-controm-sm" rows="5" name="asset_note" placeholder="Write note hare..">
                                {{$assetRegister->asset_note}}
                                </textarea>
                                @if($errors->has('asset_note'))
                                <p class="text-danger">{{ $errors->first('asset_note') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asset Origin</label>
                                <input type="text" name="asset_origin" class="form-control form-control-sm" id="exampleInputEmail1"  value="{{$assetRegister->asset_origin}}" placeholder="Write origin here..">
                                @if($errors->has('asset_origin'))
                                <p class="text-danger">{{ $errors->first('asset_origin') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asset Price</label>
                                <input type="number" name="asset_price" class="form-control form-control-sm" id="exampleInputEmail1" value="{{ $assetRegister->asset_price}}" placeholder="Enter Price">
                                @if($errors->has('asset_price'))
                                <p class="text-danger">{{ $errors->first('asset_price') }} </p>
                                @endif
                            </div>                           
                        </div>
                    </div>          
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 100,
        });
    });
</script>
@endsection