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
        <h5 class="modal-title" id="exampleModalLabel">Add Type</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('receive.type.store')}}" method="POST">
          @csrf
      <div class="modal-body">
        <div class="form-group mb-3">
            <label for="">Type Name</label>
            <input type="text" class="form-control" name="receive_type_name"/>
            @if($errors->has('receive_type_name'))
            <p class="text-danger">{{ $errors->first('receive_type_name') }} </p>
            @endif
        </div>
        <div class="form-group mb-3">
            <label for="">Type Note</label>
            <textarea type="text" rows="5" class="form-control" name="receive_type_note">

            </textarea>
            @if($errors->has('receive_type_note'))
            <p class="text-danger">{{ $errors->first('receive_type_note') }} </p>
            @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Receive Type</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('update-receive-type')}}" Method="POST">
          @csrf
          @method('put')
          <input type="hidden" name="receive_type_id" id="receive_type_id" />
      <div class="modal-body">
        <div class="form-group mb-3">
            <label for="">Type Nmae</label>
            <input type="text" class="form-control" id="receive_type_name" name="receive_type_name"/>
        </div>
        <div class="form-group mb-3">
            <label for="">Type Note</label>
            <textarea type="text" rows="5" class="form-control" id="receive_type_note" name="receive_type_note">

            </textarea>
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
                    <h4>Receive Type List</h4>
                    <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fas fa-plus-circle"></i> Add Type</button>
                    
                </div>
                <div class="card-body">
                <table id="myTable" class="display table-bordered table-striped text-center" style="border-color:white;font-size:12px;" width="100%">
                        <thead>
                            <tr style="background:#395697;color:#fff;font-size:12px;">
                                <th>SL#</th>
                                <th>Type Name</th>
                                <th>Type Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
						          <tbody> 
                        @foreach($receivetypes as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->receive_type_name}}</td>
                                <td>{{$item->receive_type_note}}</td>
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
   $(document).on('click','.btnclose',function(){
      @if (count($errors) > 0)
          $('#exampleModal').modal('hide');
      @endif
   });
</script>

<script>            
    $(document).on('click','.editbtn',function(){
        var receive_type_id = $(this).val();
       $('#editModal').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });     
       $.ajax({
            type:"GET",
            url:"edit-receive-type/"+receive_type_id,
            dataType: "json",
            success:function(response){
                $('#receive_type_name').val(response.receiveType.receive_type_name);
                $('#receive_type_note').val(response.receiveType.receive_type_note);
                $('#status').val(response.receiveType.status);
                $('#receive_type_id').val(receive_type_id);
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