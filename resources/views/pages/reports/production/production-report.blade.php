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
    <div class="col-lg-3 col-md-3 col-12">
      <div class="">
        <h5>Search Here</h5>
        <form action="{{ route('production.search') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Start Date</label>
            <input type="date" name="start_date" class="form-control form-control-sm" id="exampleInputEmail1" value="{{date('Y-m-d')}}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">End Date</label>
            <input type="date" name="end_date" class="form-control form-control-sm" id="exampleInputEmail1" value="{{date('Y-m-d')}}">
          </div>

          <!-- /.card-body -->

          <div>
            <button type="submit" class="btn btn-warning btn-block">Search</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-9 col-md-9 col-12">

      @if(!empty($productionDetails))
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div>
          <h4>Production Report</h4>
          Date:
          @foreach($dateRange as $date )
          {{ date('d/m/Y', strtotime($date)) }}
          @if ( ! $loop->last)- @endif
          @endforeach
          </div>
          <div>
            <a href="{{route('production.print',['start_date'=>$start_date,'end_date'=>$end_date])}}" class="btn btn-primary btn-sm btnprint">Print Preview</a>
          </div>


        </div>
        <div class="card-body">
          <table id="myTable" class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
            <thead>
            <tr style="background:#395697;color:#fff;font-size:11px;">
                <th>SL#</th>
                <th>Date</th>
                <th>Item Name</th>
                <th>Item Qty</th>
                <th>Item Price</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @php
              $total=0;
              @endphp
            @foreach($productionDetails as $item)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date('d-m-Y', strtotime($item->production_date))}}</td>
                <td>{{$item->item_name}}</td>
                <td>{{$item->prod_qty}}</td>
                <td>{{$item->item_price}}</td>
                <td>{{$item->prod_qty * $item->item_price}}</td>
              </tr>
              @php
              $s_total = $item->prod_qty * $item->item_price;
              $total += $s_total;
              @endphp
             @endforeach
             <tr>
               <td colspan="5">Total:</td>
               <td>{{$total}}</td>
             </tr>
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
