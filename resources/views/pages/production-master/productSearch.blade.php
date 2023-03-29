@extends('layouts.master')
@section('style')

@endsection
@section('content')


    <div class="row">
    <div class="col-lg-6 col-md-6 col-12 offset-md-3">
    <h4>Select Product For Production</h4>
        <form action="{{route('product.search')}}" method="GET">
            @csrf
            <div class="input-group">
                    <select class="form-control select2" name="item_id" id="item_id">
                        <option selected disabled>Select Item</option>
                        @foreach ($items as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->item_name }}
                        </option>
                        @endforeach
                       
                    </select>
                    
                   
            </div>
            <div>
                @if($errors->has('item_id'))
                <p class="text-danger">{{ $errors->first('item_id') }} </p>
                @endif   
            </div>
            <button type="submit" class="btn btn-outline-primary mt-2">Next Step</button>
            <a href="{{route('production.master.index')}}" class="btn btn-outline-primary mt-2">Go Back </a>

        </form>
    </div>
</div>

@endsection
@section('scripts')
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
<script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>


<script type="text/javascript">
    $(".select2").select2();
</script>
@endsection