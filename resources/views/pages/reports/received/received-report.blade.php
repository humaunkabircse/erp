@extends('layouts.master')
@section('style')
<style>
    table tr {
        height: 19px !important
    }

    .myTable {
        background: #333;
        padding: 5px 15px;
        border: 1px solid #333;
        border-radius: 10px;
        text-align: center;
        color: #fff;
        margin-left:10px;
    }


table tr{
    line-height: 0.5;  
}

</style>
</style>
<!-- DataTables -->
<!-- <link rel="stylesheet" href="{{asset('backend/datatable/css')}}/jquery.dataTables.min.css"> -->
@endsection
@section('content')
<div class="container">
  <div class="row">
  <div class="col-lg-12 col-md-12 col-12">
    @if(empty($receiveDetails))
    <form action="{{ route('received.search') }}" method="POST">
          @csrf
  <div class="form-row align-items-center">
    <div class="col-sm-3 my-1">
    <label>Vendor</label>
            <select class="form-control" name="vendor_id" id="vendor_id">
              <option selected disabled>Select Vendor</option>
              @foreach ($vendors as $vendor)
              <option value="{{ $vendor->id }}">
                {{ $vendor->vendor_company }}
              </option>
              @endforeach
            </select>
    </div>
    <div class="col-sm-3 my-1">
    <label for="exampleInputEmail1">Start Date</label>
            <input type="date" name="start_date" class="form-control" id="exampleInputEmail1" value="{{date('Y-m-d')}}">
    </div>
    <div class="col-sm-3 my-1">
    <label for="exampleInputEmail1">End Date</label>
            <input type="date" name="end_date" class="form-control" id="exampleInputEmail1" value="{{date('Y-m-d')}}">
    </div>
    <div class="col-auto my-1">
    <button type="submit" class="btn btn-warning">Search</button>
    </div>
  </div>
</form>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">    
      @if(!empty($receiveDetails))
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div>
          <h4>Received Report</h4>
          Date:
          @foreach($dateRange as $date )
          {{ date('d/m/Y', strtotime($date)) }}
          @if ( ! $loop->last)- @endif
          @endforeach
          </div>
          <div>
          <a href="{{route('received.print',['vendor_id'=>$vendor_id,'start_date'=>$start_date,'end_date'=>$end_date])}}" class="btn btn-primary btn-sm btnprint">Print Preview</a>
          </div>
          <!-- <form action="{{route('received.print')}}" method="POST">
          @csrf
  <div class="form-row align-items-center">
    <div class="col-sm-3 my-1">
    <input type="hidden" name="vendor_id" class="form-control" id="vendor_id" value="{{$vendor_id}}">
    </div>
    <div class="col-sm-3 my-1">
            <input type="hidden" name="start_date" class="form-control" id="start_date" value="{{$start_date}}">
    </div>
    <div class="col-sm-3 my-1">
            <input type="hidden" name="end_date" class="form-control" id="end_date" value="{{$end_date}}">
    </div>
    <div class="col-auto my-1">
    <button type="submit" class="btn btn-warning btnprint">Print</button>
    </div>
  </div>
</form> -->
        </div>
       
        <div class="card-body">
          <table class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
            <thead>
              <tr style="background:#395697;color:#fff;font-size:11px;">
                <th>SL#</th>
                <th>Vendor</th>
                <th>Received Date</th>
                <th>Received Ref</th>
                <th>Total Qty</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
            @foreach($receiveDetails as $item) 
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->vendor_company}}</td>
                <td>{{$item->rec_date}}</td>
                <td>{{$item->rec_by}}</td>
                <td>{{$item->item_qty}}</td>
                <td>{{$item->item_price}}</td>
              </tr>
             @endforeach 
            </tbody>
          </table>
        </div>
      </div>
@else
<p class="text-center">Report Display after search</p>
@endif


    </div>
  </div>
</div>
@endsection
@section('scripts')
<!-- <script src="{{ asset('backend/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{asset('backend/datatable/js')}}/jquery.dataTables.min.js"></script> -->
<script>
$(document).ready(function() {
      jQuery('.btnprint').printPage();

    });
</script>
<!-- <script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable({
      scrollY: 370,
      scrollX: true,
      scroller: true,
    });
  });
</script>

<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
<script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>

<script type="text/javascript">
  $(".select2").select2();
</script> -->

@endsection