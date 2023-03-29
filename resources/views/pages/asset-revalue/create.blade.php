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
                    <h3 class="card-title">Asset Revalue</h3>
                    <a href="{{ route('asset.revalue.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Asset Revalue list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('asset.revalue.store') }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="form-group">
                                <label>Asset Name</label>
                                <select class="form-control" id="asset_name" name="asset_id">
                                    <option selected disabled>Select Asset name</option>
                                    @foreach($assetRegisterItems as $item)
                                    <option value="{{$item->id}}">{{$item->asset_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('asset_id'))
                                <p class="text-danger">{{ $errors->first('asset_id') }} </p>
                                @endif
                            </div> 
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                          <div class="asset_info">
                              <p><strong>Asset Type: </strong><span id="type"></span></p>
                              <p><strong>Asset Origin: </strong><span id="origin"></span></p>
                          </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                      
                            <div class="form-group">
                                <label for="">Asset Revalue Note</label>
                                <textarea rows="5" name="asset_revalue_note" class="form-control form-control-sm"  placeholder="Write note hare..">
                                {{ old('asset_revalue_note') }}
                                </textarea>
                                @if($errors->has('asset_revalue_note'))
                                <p class="text-danger">{{ $errors->first('asset_revalue_note') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asset Revalue Date</label>
                                <input type="date" name="asset_revalue_date" class="form-control form-control-sm" id="exampleInputEmail1" value="{{date('Y-m-d')}}" placeholder="Enter purshase date">
                                @if($errors->has('asset_relvalue_date'))
                                <p class="text-danger">{{ $errors->first('asset_relvalue_date') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asset Revalue Price</label>
                                <input type="number" name="asset_revalue_price" class="form-control form-control-sm" id="exampleInputEmail1" value="{{ old('asset_relvalue_price') }}" placeholder="Enter Price">
                                @if($errors->has('asset_relvalue_price'))
                                <p class="text-danger">{{ $errors->first('asset_relvalue_price') }} </p>
                                @endif
                            </div>                           
                        </div>
                    </div>          
                    <button type="submit" class="btn btn-primary">Submit</button>
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