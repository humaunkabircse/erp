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
                    <h4>Category List</h4>
                    <a type="button" class="btn btn-primary float-end" href="{{route('category.create')}}"><i class="fas fa-plus-circle"></i> Add New</a>
                    
                </div>


                <div class="card-body" style="overflow-x:scroll">
              <table id="myTable" class="display" width="100%">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Is_Parent</th>
                    <th>Parent_id</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($categories as $item)
                  <tr>
                    <td> {{$loop->iteration}}</td>
                    <td>{{$item->item_cat_name}}</td>
                    <td>{{$item->is_parent === 1 ?'Yes' : 'No'}}</td>
                    <td>{{\App\Models\Category::where('id',$item->parent_id)->value('item_cat_name')??'No Parent'}}</td>
                    <td>
                      <a class="btn btn-xs btn-outline-warning float-left" href="{{route('category.edit',$item->id)}}"><i class="fas fa-edit"></i></a>
                      
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