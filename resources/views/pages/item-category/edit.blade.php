@extends('layouts.master')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-8 col-md-8 offset-md-2 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Category Edit</h3>
                    <a href="{{ route('category.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Category list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('category.update',$editCategory->id) }}" method="POST">
                @csrf
                <div class="card-body">
                @if($errors->any())
                  <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @if($errors->count()==1)
                        {{ $errors->first()}}
                        @else
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                  </div>
                  @endif
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name<span class="text-danger">*</span></label>
                    <input type="text" name="item_cat_name" class="form-control" id="exampleInputEmail1" value="{{$editCategory->item_cat_name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Description</label>
                    <textarea id="summernote" name="item_cat_desc" placeholder="Summary write here...">
                       {{$editCategory->item_cat_desc}}
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Is_Parent <span class="text-danger">*</span>:</label>
                    <input id="is_parent" type="checkbox" name="is_parent" value="1" {{$editCategory->is_parent==1?'checked':''}}> Yes
                    <label for="is_parent"></label>
                  </div>
                  <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 {{$editCategory->is_parent==1?'d-none':''}}" id="parent_cat_div">
                      <!-- select -->
                      <div class="form-group">
                        <label>Parent Category</label>
                        <select class="form-control" name="parent_id">
                          <option selected disabled>--Parent Category--</option>
                          @foreach($parent_cats as $p_cats)
                          <option value="{{$p_cats->id}}" {{$p_cats->id==$editCategory->parent_id ? 'selected' :''}}>{{$p_cats->item_cat_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success btn-sm">Update Category</button>
                </div>
              </form>





        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 100,
        });
    });
</script>
<script>
$('#is_parent').change(function(e){
    e.preventDefault();
    var is_checked = $('#is_parent').prop('checked');
    
    if(is_checked){
        $('#parent_cat_div').addClass('d-none');
    }else{
        $('#parent_cat_div').removeClass('d-none');
        $('#parent_cat_div').val();
    }
});

</script>
@endsection