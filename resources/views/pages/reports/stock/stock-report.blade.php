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

<!-- DataTables -->
<!-- <link rel="stylesheet" href="{{asset('backend/datatable/css')}}/jquery.dataTables.min.css"> -->
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <div class="card">
        <div class="card-header">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h4>Stock Report</h4> Date:{{ $current_date }}
                </div>
                <div>
                  <a href="{{route('stock.print')}}" class="btn btn-primary btn-sm btnprint">Print Preview</a>
                </div>
            </div>
          <div>
        </div>

        <div class="card-body">
          <table class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
            <thead>
              <tr style="background:#395697;color:#fff;font-size:16px; padding:10px">
                <th>SL#</th>
                <th>Item Name</th>
                <th>Stock Qty</th>
              </tr>
            </thead>
            <tbody>
            @foreach($stockDetails as $item)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->item_name}}</td>
                <td>{{($item->item_qty + $item->stock_adjustment_addition_qty + $item->prod_qty)}}</td>
              </tr>
             @endforeach

             {{-- <td>{{($item->receive_item_qty+$item->rm_used_item_qty)-($item->inv_item_qty+$item->gp_item_qty)}}</td> --}}

            </tbody>
          </table>
        </div>
      </div>



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
