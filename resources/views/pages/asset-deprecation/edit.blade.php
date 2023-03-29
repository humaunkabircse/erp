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
                    <h3 class="card-title">Asset Deprecation Edit</h3>
                    <a href="{{ route('asset.deprecation.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Asset Deprecation list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('asset.deprecation.update',$assetDeprecation->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-12">
                          <div class="asset_info">
                                <p><strong>Asset Name: </strong><span>{{$info->asset_name}}</span></p>
                              <p><strong>Asset Type: </strong><span>{{$info->asset_type_name}}</span></p>
                              <p><strong>Asset Origin: </strong><span>{{$info->asset_origin}}</span></p>
                          </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                      
                            <div class="form-group">
                                <label for="">Asset Deprecation Note</label>
                                <textarea rows="9" name="asset_deprecation_note" class="form-control form-control-sm"  placeholder="Write note hare..">
                                {{ $assetDeprecation->asset_deprecation_note }}
                                </textarea>
                                @if($errors->has('asset_deprecation_note'))
                                <p class="text-danger">{{ $errors->first('asset_deprecation_note') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asset Deprecation Date</label>
                                <input type="date" name="asset_deprecation_date" value="{{ $assetDeprecation->asset_deprecation_date }}" class="form-control form-control-sm" id="exampleInputEmail1">
                                @if($errors->has('asset_deprecation_date'))
                                <p class="text-danger">{{ $errors->first('asset_deprecation_date') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asset Deprecation Reason</label>
                                <input type="number" name="asset_deprecation_value" value="{{ $assetDeprecation->asset_deprecation_value }}" class="form-control form-control-sm" id="exampleInputEmail1">
                                @if($errors->has('asset_deprecation_value'))
                                <p class="text-danger">{{ $errors->first('asset_deprecation_value') }} </p>
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
<script type="text/javascript">
    $(document).ready(function() {
       $(document).on('change','#asset_name',function(){
        var asset_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });     
       $.ajax({
            type:"GET",
            url:"{{route('asset.info')}}",
            data:{
                'asset_id' :asset_id,
            },
            dataType: "json",
            success:function(response){
                $('#type').html(response.info.asset_type_name);
                $('#origin').html(response.info.asset_origin);
            }
       });
       });
    });
</script>
@endsection