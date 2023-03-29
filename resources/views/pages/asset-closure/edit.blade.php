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
                    <h3 class="card-title">Asset Closure Edit</h3>
                    <a href="{{ route('asset.closure.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Asset Closure list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('asset.closure.update',$assetClosure->id) }}" method="POST">
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
                                <label for="">Asset Closure Note</label>
                                <textarea rows="5" name="asset_closure_note" class="form-control form-control-sm"  placeholder="Write note hare..">
                                {{ $assetClosure->asset_closure_note }}
                                </textarea>
                                @if($errors->has('asset_closure_note'))
                                <p class="text-danger">{{ $errors->first('asset_closure_note') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asset Closure Date</label>
                                <input type="date" name="asset_closure_date" value="{{ $assetClosure->asset_closure_date }}" class="form-control form-control-sm" id="exampleInputEmail1">
                                @if($errors->has('asset_closure_date'))
                                <p class="text-danger">{{ $errors->first('asset_closure_date') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asset closure Reason</label>
                                <select class="form-control form-control-sm" name="asset_closure_reason">
                                    <option selected disabled>Select Reason</option>
                                    <option value="lost" {{$assetClosure->asset_closure_reason=='lost' ? 'selected':''}}>Lost</option>
                                    <option value="destroyed" {{$assetClosure->asset_closure_reason=='destroyed' ? 'selected':''}}>Destroyed</option>
                                    <option value="soled" {{$assetClosure->asset_closure_reason=='soled' ? 'selected':''}}>Soled</option>
                                    <option value="burned" {{$assetClosure->asset_closure_reason=='burned' ? 'selected':''}}>Burned</option>
                                    <option value="expired" {{$assetClosure->asset_closure_reason=='expired' ? 'selected':''}}>Expired</option>
                                    <option value="others" {{$assetClosure->asset_closure_reason=='others' ? 'selected':''}}>Others</option>
                                </select>   
                                @if($errors->has('asset_closure_reason'))
                                <p class="text-danger">{{ $errors->first('asset_closure_reason') }} </p>
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