@extends('layouts.master')
@section('style')

<style>
.report-item{
    height:80px;
    width:200px;
    background-color:red;
    padding-top:30px;
    text-align: center;
    font-size:18px;
}
.report-item a{ 
    color:#fff
}
</style>
 <!-- DataTables -->
 <link rel="stylesheet" href="{{asset('backend/datatable/css')}}/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-12 mb-3">
            <div class="report-item bg-primary">
            <a href="{{route('received.report')}}">Received Report</a> 
            </div>        
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-3">
            <div class="report-item bg-primary">
            <a href="{{route('challan.report')}}">Challan Report</a> 
            </div>        
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-3">
            <div class="report-item bg-primary">
            <a href="{{route('gatepass.report')}}">Gate Pass Report</a> 
            </div>        
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-3">
            <div class="report-item bg-primary">
            <a href="{{route('payment.report')}}">Payment Report</a> 
            </div>        
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-3">
            <div class="report-item bg-primary">
            <a href="{{route('expenses.report')}}">Expenses Report</a> 
            </div>        
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-3">
            <div class="report-item bg-primary">
            <a href="{{route('collection.report')}}">Collection Report</a> 
            </div>        
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-3">
            <div class="report-item bg-primary">
            <a href="{{route('production.report')}}">Production Report</a> 
            </div>        
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-3">
            <div class="report-item bg-primary">
                <a href="{{route('stock.report')}}">Stock Report</a> 
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('backend/datatable/js')}}/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#myTable').DataTable({
      scrollY:     370,
      scrollX:     true,
      scroller:    true,
    });
} );
</script>


@endsection