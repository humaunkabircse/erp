<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
       
    <title>Invoice</title>
    <style>
        .signature{
            margin-top:130px;
            display:flex;
        }
        .signature .item-1{
        margin-right:70px
        }
        .signature .item-2{
        margin-right:70px
        }
        .signature .item-3{
        margin-right:70px
        }
        .invoice{
            text-align:center;
            font-size:26px;
        }
        .in_word{
            margin-top:30px;
        }


    </style>
</head>
<body>
<!-- DataTables -->
<!-- <link rel="stylesheet" href="{{asset('backend/datatable/css')}}/jquery.dataTables.min.css"> -->

<div class="container">

  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">    
      <div class="card">
        <div class="card-header">
          <h4>Received Report</h4>
          <p>
          Date:
          @foreach($dateRange as $date )
          {{ date('d/m/Y', strtotime($date)) }}
          @if ( ! $loop->last)- @endif
          @endforeach
          </p>
        </div>
        <div class="card-body">
          <table class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
            <thead>
              <tr style="background:#395697;color:#fff;font-size:11px;">
                <th style="text-align:center">SL#</th>
                <th style="text-align:center">Vendor</th>
                <th style="text-align:center">Received Date</th>
                <th style="text-align:center">Total Qty</th>
                <th style="text-align:center">Amount</th>
              </tr>
            </thead>
            <tbody>
            @foreach($receivePrintDetails as $item) 
              <tr class="text-center">
                <td>{{$loop->iteration}}</td>
                <td>{{$item->vendor_company}}</td>
                <td>{{$item->rec_date}}</td>
                <td>{{$item->item_qty}}</td>
                <td>{{$item->item_price}}</td>
              </tr>
             @endforeach 
            </tbody>
          </table>
        </div>
      </div>



    </div>
  </div>
</div>
<!-- 
<script src="{{ asset('backend/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{asset('backend/datatable/js')}}/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable({
      scrollY: 370,
      scrollX: true,
      scroller: true,
    });
  });
</script> -->
<!--Select2 support-->
<!-- <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
<script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script> -->
<script src="{{asset('backend')}}/assets/js/jquery.printPage.js"></script>  
<!--Select2 cdn support-->
<!-- <script type="text/javascript">
  $(".select2").select2();
</script> -->

</body>

</html>