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
                    <h4>Asset Revalue List</h4>
                    <a type="button" class="btn btn-primary float-end" href="{{route('asset.revalue.create')}}"><i class="fas fa-plus-circle"></i> Add New</a>
                    
                </div>
                <div class="card-body" style="overflow-x:scroll">
                <table id="myTable" class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
                        <thead>
                            <tr style="background:#395697;color:#fff;font-size:12px;">
                                <th>SL#</th>
                                <th>Asset Name</th>
                                <th>Revalue Date</th>
                                <th>Revalue Price</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
						<tbody> 
                        @foreach($assetRevalues as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{\App\Models\AssetRegister::where('id',$item->asset_id)->value('asset_name')}}</td>
                                <td>{{$item->asset_revalue_date}}</td>
                                <td>{{$item->asset_revalue_price}}</td>
                                <td>{{$item->asset_revalue_note}}</td>
                                <td>
                                <a href="{{route('asset.revalue.edit',$item->id)}}" type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
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