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
                    <h3 class="card-title">Vendor Edit</h3>
                    <a href="{{ route('vendor.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Vendor list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('vendor.update',$vendor->id) }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vendor Name</label>
                                <input type="text" name="vendor_name" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$vendor->vendor_name}}">
                                @if($errors->has('vendor_name'))
                                <p class="text-danger">{{ $errors->first('vendor_name') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Name</label>
                                <input type="text" name="vendor_company" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$vendor->vendor_company}}">
                                @if($errors->has('vendor_company'))
                                <p class="text-danger">{{ $errors->first('vendor_company') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">website <span style="color:#0069D9;font-size:12px">(Optional)</span></label>
                                <input type="text" name="vendor_website" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$vendor->vendor_website}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Number</label>
                                <input type="text" name="vendor_contact_number" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$vendor->vendor_contact_number}}">
                                @if($errors->has('vendor_contact_number'))
                                <p class="text-danger">{{ $errors->first('vendor_contact_number') }} </p>
                                @endif
                            </div>
                            </div>
                             <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email <span style="color:#0069D9;font-size:12px">(Optional)</span></label>
                                <input type="text" name="email" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$vendor->email}}" placeholder="Email">
                            </div>
                             </div>
                             <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vat Number <span style="color:#0069D9;font-size:12px">(Optional)</span></label>
                                <input type="text" name="vendor_vat_number" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$vendor->vendor_vat_number }}">
                            </div>
                             </div>
                        </div>

                   
                    <h5>Vendor Info:</h5>
                    <hr />
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" name="vendor_country" class="form-control form-control-sm" id="vendor_country" value="{{$vendor->vendor_country }}">
                                @if($errors->has('vendor_country'))
                                <p class="text-danger">{{ $errors->first('vendor_country') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="district">District</label>
                                <input type="text" name="vendor_district" class="form-control form-control-sm" id="vendor_district" value="{{$vendor->vendor_district }}">
                                @if($errors->has('vendor_district'))
                                <p class="text-danger">{{ $errors->first('vendor_district') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input type="text" name="vendor_zip" class="form-control form-control-sm" id="vendor_zip" value="{{$vendor->vendor_zip }}">
                                @if($errors->has('vendor_zip'))
                                <p class="text-danger">{{ $errors->first('vendor_zip') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="form-group">
                                <label for="street">Street</label>
                                <input type="text" id="vendor_street" name="vendor_street" class="form-control" value="{{$vendor->vendor_street }}">
                                @if($errors->has('vendor_street'))
                                <p class="text-danger">{{ $errors->first('vendor_street') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="vendor_city" class="form-control form-control-sm" id="vendor_city" value="{{$vendor->vendor_city }}">
                                @if($errors->has('vendor_city'))
                                <p class="text-danger">{{ $errors->first('vendor_city') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
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
        $('#vendor_description').summernote({
            height: 100,
        });
    });
</script>
@endsection