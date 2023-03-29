@extends('layouts.master')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/datatable/css')}}/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Invoice List</h4>
                    <a type="button" class="btn btn-primary float-end" href="{{route('invoice.master.create')}}"><i class="fas fa-plus-circle"></i> Add New</a>

                </div>
                <div class="card-body" style="overflow-x:scroll">
                    <table id="myTable" class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
                        <thead>
                            <tr style="background:#395697;color:#fff;font-size:12px;">
                                <th>SL#</th>
                                <th>Customer Name</th>
                                <th>Invoice No.</th>
                                <th>Invoice Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoiceMasters as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{\App\Models\Customer::where('id',$item->cus_id)->value('cus_company')}}</td>
                                <td>{{$item->invoice_number}}</td>
                                <td>{{$item->invoice_date}}</td>
                                <td>
                                    <a href="{{route('invoice.master.edit',$item->id)}}" type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="{{route('invoice.master.view',$item->id)}}" type="button" class="btn btn-outline-warning btn-sm"><i class="fas fa-eye"></i></a>
                                    <!-- <a href="{{route('invoice.pdf',$item->id)}}" type="button" class="btn btn-outline-warning btn-sm"><i class="fas fa-download">Export Pdf</i></a> -->
                                    
                                </td>
                               
                                    
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('backend/datatable/js')}}/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable({
            scrollY: 370,
            scrollX: true,
            scroller: true,
        });
    });
</script>


@endsection