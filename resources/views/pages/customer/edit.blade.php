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
                    <h3 class="card-title">Customer Edit</h3>
                    <a href="{{ route('customer.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Customer list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('customer.update',$customer->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <!-- @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
@if($errors->count()==1)
                    {{ $errors->first() }}
@else
                    <ul>
@foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
@endforeach
                    </ul>
@endif
                </div>
@endif-->
        @if(session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Ophs!</strong> {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>       
        @endif
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Customer Name</label>
                                <input type="text" name="name" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$customer->name}}" placeholder="Enter Name">
                                @if($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Name</label>
                                <input type="text" name="cus_company" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$customer->cus_company}}" placeholder="Company Name">
                                @if($errors->has('cus_company'))
                                <p class="text-danger">{{ $errors->first('cus_company') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">website</label>
                                <input type="text" name="cus_website" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$customer->cus_website}}" placeholder="Enter website">
                                @if($errors->has('cus_website'))
                                <p class="text-danger">{{ $errors->first('cus_website') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="summernote" name="description" placeholder="Write description hare..">
                                {{$customer->description}}
                                </textarea>
                                @if($errors->has('description'))
                                <p class="text-danger">{{ $errors->first('description') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$customer->contact_number}}" placeholder="Write Contact number">
                                @if($errors->has('contact_number'))
                                <p class="text-danger">{{ $errors->first('contact_number') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$customer->email}}" placeholder="Email">
                                @if($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vat Number</label>
                                <input type="text" name="vat_number" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$customer->vat_number}}" placeholder="Enter Vat Number">
                                @if($errors->has('vat_number'))
                                <p class="text-danger">{{ $errors->first('vat_number') }} </p>
                                @endif
                            </div>
                        </div>

                    </div>
                    <h5>Customer Info:</h5>
                    <hr />
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" name="country" class="form-control form-control-sm" id="country" value="{{$customer->country}}" placeholder="Country Name">
                                @if($errors->has('country'))
                                <p class="text-danger">{{ $errors->first('country') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="district">District</label>
                                <input type="text" name="district" class="form-control form-control-sm" id="district" value="{{$customer->district}}" placeholder="District Name">
                                @if($errors->has('district'))
                                <p class="text-danger">{{ $errors->first('district') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input type="text" name="zip" value="{{$customer->zip}}" class="form-control form-control-sm" id="zip" placeholder="Enter zip code">
                                @if($errors->has('zip'))
                                <p class="text-danger">{{ $errors->first('zip') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="form-group">
                                <label for="street">Street</label>
                                <input type="text" id="street" name="street" value="{{$customer->street}}" class="form-control"> 
                                @if($errors->has('street'))
                                <p class="text-danger">{{ $errors->first('street') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" value="{{$customer->city}}" class="form-control form-control-sm" id="city" placeholder="City Name">
                                @if($errors->has('city'))
                                <p class="text-danger">{{ $errors->first('city') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h5>Billing Info:</h5>
                    <hr />
                    <div id="check-diff-billing">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="billing_country">Country</label>
                                    <input type="text" id="billing_country" value="{{$customer->billing_country}}" name="billing_country" class="form-control form-control-sm" placeholder="Country Name">
                                    @if($errors->has('country'))
                                    <p class="text-danger">{{ $errors->first('country') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="billing_district">District</label>
                                    <input type="text" id="billing_district" name="billing_district" value="{{$customer->billing_district}}" class="form-control form-control-sm" placeholder="District Name">
                                    @if($errors->has('district'))
                                    <p class="text-danger">{{ $errors->first('district') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="billing_zip">Zip</label>
                                    <input type="text" id="billing_zip" name="billing_zip" value="{{$customer->billing_zip}}" class="form-control form-control-sm" placeholder="Enter zip code">
                                    @if($errors->has('billing_zip'))
                                    <p class="text-danger">{{ $errors->first('billing_zip') }} </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-12">
                                <div class="form-group">
                                    <label for="billing_street">Street</label>
                                    <input type="text" id="billing_street" name="billing_street" value=" {{$customer->billing_street}}" class="form-control">
                                    @if($errors->has('billing_street'))
                                    <p class="text-danger">{{ $errors->first('billing_street') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="billing_city">City</label>
                                    <input type="text" id="billing_city" name="billing_city" value=" {{$customer->billing_city}}" class="form-control form-control-sm" placeholder="City Name">
                                    @if($errors->has('billing_city'))
                                    <p class="text-danger">{{ $errors->first('billing_city') }} </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5>Shipping Info:</h5>
                   
                    <hr />
                    <div id="check-diff-shipping">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="shipping_country">Country</label>
                                    <input type="text" id="shipping_country" name="shipping_country" value="{{$customer->shipping_country}}" class="form-control form-control-sm" placeholder="Country Name">
                                    @if($errors->has('shipping_country'))
                                    <p class="text-danger">{{ $errors->first('shipping_country') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="shipping_district">District</label>
                                    <input type="text" id="shipping_district" name="shipping_district" value="{{$customer->shipping_district}}" class="form-control form-control-sm" placeholder="District Name">
                                    @if($errors->has('shipping_district'))
                                    <p class="text-danger">{{ $errors->first('shipping_district') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="shipping_zip">Zip</label>
                                    <input type="text" id="shipping_zip" name="shipping_zip" value="{{$customer->shipping_zip}}" class="form-control form-control-sm" placeholder="Enter zip code">
                                    @if($errors->has('shipping_zip'))
                                    <p class="text-danger">{{ $errors->first('shipping_zip') }} </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-12">
                                <div class="form-group">
                                    <label for="shipping_street">Street</label>
                                    <input type="text" id="shipping_street" name="shipping_street" value="{{$customer->shipping_street}}" class="form-control">
                                    @if($errors->has('shipping_street'))
                                    <p class="text-danger">{{ $errors->first('shipping_street') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="shipping_city">City</label>
                                    <input type="text" id="shipping_city" name="shipping_city" value="{{$customer->shipping_city}}" class="form-control form-control-sm" placeholder="City Name">
                                    @if($errors->has('shipping_city'))
                                    <p class="text-danger">{{ $errors->first('shipping_city') }} </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- select -->
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
        $('#description').summernote({
            height: 100,
        });
    });
</script>
@endsection