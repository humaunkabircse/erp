@extends('layouts.master')
@section('style')
<style>
  .report-item {
    height: 80px;
    width: 200px;
    background-color: red;
    padding-top: 30px;
    text-align: center;
    font-size: 18px;
  }

  .report-item a {
    color: #fff
  }
</style>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/datatable/css')}}/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="">
        <h5>Search Here</h5>
        <form action="{{ route('challan.search') }}" method="POST" class="form-inline" >
      @csrf
            <label>Customer: </label>
            <select class="form-control form-control-sm select2 mb-2 mr-2" name="cus_id" id="cus_id">
              <option selected disabled>Select Customer</option>
              @foreach ($customers as $customer)
              <option value="{{ $customer->id }}">
                {{ $customer->cus_company }}
              </option>
              @endforeach
            </select>
  <label for="inlineFormInputName2">Start Date: </label>
  <input type="date" name="start_date" class="form-control form-control-sm mb-2 mr-2" id="inlineFormInputName2" value="{{date('Y-m-d')}}">

  <label for="inlineFormInputGroupUsername2">End Date: </label>
  <div class="input-group mb-2 mr-2">
    <input type="date" name="end_date" class="form-control form-control-sm" id="inlineFormInputGroupUsername2" value="{{date('Y-m-d')}}">
  </div>
  <button type="submit" class="btn btn-warning mb-2">Search</button>
</form>
      </div>
    </div>
    <div class="col-lg-12 col-md-12 col-12">
     
      @if(!empty($challanDetails))
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div>
          <h4>Challan Report</h4>
          <p>
          Date:
          @foreach($dateRange as $date )
          {{ date('d/m/Y', strtotime($date)) }}
          @if ( ! $loop->last)- @endif
          @endforeach
          </p>
          </div>

          <div>
            @if(!empty($cus_id))
            <a href="{{route('challan.print',['cus_id'=>$cus_id,'start_date'=>$start_date,'end_date'=>$end_date])}}" class="btn btn-primary btn-sm btnprint">Print Preview</a>
            @else
            <a href="{{route('challan.print',['start_date'=>$start_date,'end_date'=>$end_date])}}" class="btn btn-info btn-sm btnprint">Print Preview</a>
            @endif
      
          </div>
        </div>
        <div class="card-body">
          <table id="myTable" class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
            <thead>
              <tr style="background:#395697;color:#fff;font-size:11px;">
                <th>SL#</th>
                <th>Customer</th>
                <th>Challan No</th>
                <th>Challan Date</th>
                <th>Total Item</th>
                <th>Challan Amount</th>
                <th>Discount</th>
                <th>Net Challan Amount</th>
              </tr>
            </thead>
            <tbody>
            @foreach($challanDetails as $item) 
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->cus_company}}</td>
                <td>{{$item->invoice_number}}</td>
                <td>{{$item->invoice_date}}</td>
                <td>{{$item->t_item_qty}}</td>
                <td>{{$item->challan_total}}</td>
                <td>{{$item->discount}}</td>
                <td>{{$item->challan_total-$item->discount}}</td>
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable({
      scrollY: 370,
      scrollX: true,
      scroller: true,
    });
  });
</script>
<!--Select2 support-->
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
<script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>
<!--Select2 cdn support-->
<script type="text/javascript">
  $(".select2").select2();
</script>
<script>
$(document).ready(function() {
      jQuery('.btnprint').printPage();
    });
</script>
@endsection