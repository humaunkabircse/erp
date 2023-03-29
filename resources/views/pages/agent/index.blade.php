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
                    <h4>Agent List</h4>
                    <a type="button" class="btn btn-primary float-end" href="{{route('agent.create')}}"><i class="fas fa-plus-circle"></i> Add New</a>
                    
                </div>
                <div class="card-body" style="overflow-x:scroll">
                <table id="myTable" class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
                        <thead>
                            <tr style="background:#395697;color:#fff;font-size:14px;">
                                <th>SL#</th>
                                <th>Agent Fullname</th>
                                <th>Agent Address</th>
                                <th>Agent Contact</th>
                                <th>Agent Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
						<tbody> 
                        @foreach($agents as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->agent_fullname}}</td>
                                <td>{{$item->agent_address}}</td>
                                <td>{{$item->agent_contact}}</td>
                                <td>{{$item->agent_email}}</td>
                                <td>
                                @if($item->status == 'active')
                                <span class="badge badge-success p-1">{{$item->status}}</span>
                                @else
                                <span class="badge badge-warning p-1">{{$item->status}}</span>
                                @endif
                                </td>
                                <td>
                                <a href="{{route('agent.edit',$item->id)}}" type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
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