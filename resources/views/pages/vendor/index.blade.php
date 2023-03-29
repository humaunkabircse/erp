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
                    <h4>Vendor List</h4>
                    <a type="button" class="btn btn-primary float-end" href="{{route('vendor.create')}}"><i class="fas fa-plus-circle"></i> Add Vendor</a>
                    
                </div>
                <div class="card-body" style="overflow-x:scroll">
                <table id="myTable" class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
                        <thead>
                            <tr style="background:#395697;color:#fff;font-size:12px;">
                                <th>SL#</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Contact Number</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                        </thead>
						<tbody> 
                        @foreach($vendors as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->vendor_name}}</td>
                                <td>{{$item->vendor_company}}</td>
                                <td>{{$item->vendor_contact_number}}</td>
                                <td>{{$item->vendor_country}}</td>
                                <td>
                                <a href="{{route('vendor.edit',$item->id)}}" type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
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
  $(document).ready( function () {
    $('#myTable').DataTable({
      scrollY:     370,
      scrollX:     true,
      scroller:    true,
    });
} );
</script>


@endsection