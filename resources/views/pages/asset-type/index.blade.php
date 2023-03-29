@extends('layouts.master')
@section('style')
 <!-- DataTables -->
 <link rel="stylesheet" href="{{asset('backend/datatable/css')}}/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Asset</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  
      <form action="{{route('asset.type.store')}}" method="post">
          @csrf
      <div class="modal-body">
        <div class="form-group mb-3">
            <label for="">Asset Type Name</label>
            <input type="text" class="form-control" name="asset_type_name"/>
            @if($errors->has('asset_type_name'))
            <p class="text-danger">{{ $errors->first('asset_type_name') }} </p>
            @endif
        </div>
        <div class="form-group mb-3">
            <label for="">Asset Type Shortcode</label>
            <input type="text" class="form-control" name="asset_type_sortcode"/>
            @if($errors->has('asset_type_sortcode'))
            <p class="text-danger">{{ $errors->first('asset_type_sortcode') }} </p>
            @endif
        </div>
        <div class="form-group mb-3">
            <label for="">Asset Type Note</label>
            <textarea type="text" rows="5" class="form-control" name="asset_type_note">
            </textarea>
            @if($errors->has('asset_type_note'))
            <p class="text-danger">{{ $errors->first('asset_type_note') }} </p>
            @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btnclose" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--End Add Student Modal -->
<!--Edit Student Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Asset Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('update-asset-type')}}" Method="POST">
          @csrf
          @method('put')
          <input type="hidden" name="asset_type_id" id="asset_type_id" />
      <div class="modal-body">
        <div class="form-group mb-3">
            <label for="">Asset Type Name</label>
            <input type="text" class="form-control" id="asset_type_name" name="asset_type_name" required/>
            @if($errors->has('asset_type_name'))
            <p class="text-danger">{{ $errors->first('asset_type_name') }} </p>
            @endif
        </div>
        <div class="form-group mb-3">
            <label for="">Description</label>
            <input type="text" class="form-control" id="asset_type_sortcode" name="asset_type_sortcode"/>
            @if($errors->has('asset_type_sortcode'))
            <p class="text-danger">{{ $errors->first('asset_type_sortcode') }} </p>
            @endif
        </div>
        <div class="form-group mb-3">
            <label for="">Type Note</label>
            <textarea type="text" rows="5" class="form-control" name="asset_type_note" id="asset_type_note">
            </textarea>
            @if($errors->has('asset_type_note'))
            <p class="text-danger">{{ $errors->first('asset_type_note') }} </p>
            @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--End Edit Student Modal -->
<!--Delete Student Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Student Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('delete-term')}}" Method="POST">
          @csrf
          @method('DELETE')
          <input type="hidden" name="delete_term_id" id="deleting_term_id" />
          <p class="text-center pt-3">Are you sure to delete data?</p>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-danger">Yes Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--End Delete Student Modal -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show myalert" role="alert">
            <strong>Success!</strong> {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>       
        @endif
            <div class="card-header d-flex justify-content-between">
                    <h4>Asset Type List</h4>
                    <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fas fa-plus-circle"></i> Add New</button>
                    
                </div>
                <div class="card-body">
                <table id="myTable" class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
                        <thead>
                            <tr style="background:#395697;color:#fff;font-size:12px;">
                                <th>SL#</th>
                                <th>Asset Type Name</th>
                                <th>Asset Type Shortcode</th>
                                <th>Asset Type Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
						          <tbody> 
                        @foreach($assetTypes as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->asset_type_name}}</td>
                                <td>{{$item->asset_type_sortcode}}</td>
                                <td>{{$item->asset_type_note}}</td>
                                <td>
                                <button type="button" value="{{$item->id}}" class="btn btn-outline-primary btn-sm editbtn"><i class="fas fa-edit"></i></button>
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
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function() {
            $('.myalert').fadeOut('fast');
        }, 2000);
    });
</script>
<script type="text/javascript">
@if (count($errors) > 0)
    $('#exampleModal').modal('show');
@endif
</script>
<script type="text/javascript">
   $(document).on('click','.btnclose',function(){
      @if (count($errors) > 0)
          $('#exampleModal').modal('hide');
      @endif
   });
</script>

<script>            
    $(document).on('click','.editbtn',function(){
        var asset_type_id = $(this).val();
       $('#editModal').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });     
       $.ajax({
            type:"GET",
            url:"{{route('asset.type.edit')}}",
            dataType: "json",
            data:{
              'asset_type_id':asset_type_id,
            },
            success:function(response){
                $('#asset_type_name').val(response.assetType.asset_type_name);
                $('#asset_type_sortcode').val(response.assetType.asset_type_sortcode);
                $('#asset_type_note').val(response.assetType.asset_type_note);
                $('#asset_type_id').val(asset_type_id);
            }
       });

    });    
</script>
<script>
    $(document).on('click','.dltbtn',function(){
        var term_id = $(this).val();
    $('#deleteModal').modal('show');
    $('#deleting_term_id').val(term_id);
    $.ajax({
            type:"GET",
            url:"delete-term/",
            dataType: "json",
            success:function(response){
               
            }
       });   
    });
</script>

@endsection