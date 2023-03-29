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

    @if(empty($collectionDetails))
      <div class="">
        <h5>Search Here</h5>
  <form action="{{ route('collection.search') }}" method="POST" class="form-inline" >
      @csrf
  <label for="inlineFormInputName2">Start Date: </label>
  <input type="date" name="start_date" class="form-control form-control-sm mb-2 mr-sm-2" id="inlineFormInputName2" value="{{date('Y-m-d')}}">

  <label for="inlineFormInputGroupUsername2">End Date: </label>
  <div class="input-group mb-2 mr-sm-2">
    <input type="date" name="end_date" class="form-control form-control-sm" id="inlineFormInputGroupUsername2" value="{{date('Y-m-d')}}">
  </div>
  <button type="submit" class="btn btn-warning mb-2">Submit</button>
</form>
      </div>
@endif

    </div>
    <div class="col-lg-12 col-md-12 col-12">
     
      @if(!empty($collectionDetails))
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div>
          <h4>Collection Report</h4>
          Date:
          @foreach($dateRange as $date )
          {{ date('d/m/Y', strtotime($date)) }}
          @if ( ! $loop->last)- @endif
          @endforeach
          </div>
          <div>
          <a href="{{route('collection.print',['start_date'=>$start_date,'end_date'=>$end_date])}}" class="btn btn-primary btn-sm btnprint">Print Preview</a>
          </div>
          
        
        </div>
        <div class="card-body">
          <table id="myTable" class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
            <thead>
            <tr style="background:#395697;color:#fff;font-size:11px;">
                <th>SL#</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Cheque No</th>
                <th>Pay Mode</th>
                <th>Bank Name</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>

            @foreach($collectionDetails as $item) 
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date('d-m-Y', strtotime($item->pay_date))}}</td>
                <td>{{$item->cus_company}}</td>
                <td>{{$item->cheque_no}}</td>
                <td>{{$item->pay_mode}}</td>
                <td>{{$item->bank_name}}</td>
                <td>{{$item->pay_amount}}</td>
              </tr>
             @endforeach            
            </tbody>
          </table>
        </div>
      </div>
        @else
        <p>Report Display after search</p>
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