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
                    <h3 class="card-title">Agent Edit</h3>
                    <a href="{{ route('agent.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i>Agent list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('agent.update',$agent->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Agent Name</label>
                            <input type="text" class="form-control form-control-sm" name="agent_fullname" value="{{$agent->agent_fullname}}"/>
                            @if($errors->has('agent_fullname'))
                            <p class="text-danger">{{ $errors->first('agent_fullname') }} </p>
                            @endif
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Agent Address</label>
                            <textarea type="text" rows="5" class="form-control form-control-sm" name="agent_address">
                            {{$agent->agent_address}}
                            </textarea>
                            @if($errors->has('agent_address'))
                            <p class="text-danger">{{ $errors->first('agent_address') }} </p>
                            @endif
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Agent Contact</label>
                            <input type="text" class="form-control form-control-sm" name="agent_contact" value="{{$agent->agent_contact}}"/>
                            @if($errors->has('agent_contact'))
                            <p class="text-danger">{{ $errors->first('agent_contact') }} </p>
                            @endif
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <label for="">Agent Email</label>
                            <input type="text" class="form-control form-control-sm" name="agent_email" value="{{$agent->agent_email}}"/>
                            @if($errors->has('agent_email'))
                            <p class="text-danger">{{ $errors->first('agent_email') }} </p>
                            @endif
                        </div>
                        
                    </div>
                     <div class="row">
                     <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="active" {{ $agent->status=='active'?'selected' : '' }}>
                                        Active</option>
                                    <option value="inactive" {{ $agent->status=='inactive'?'selected' : '' }}>
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
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')


@endsection