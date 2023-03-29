@extends('layouts.master')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card card-primary">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Item Edit</h3>
                    <a href="{{ route('items.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Item list</a>
                </div>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('items.update',$editItem->id) }}" method="POST">
                @csrf
                <div class="card-body" style="background-color:#F7F7F7">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Item Name</label>
                                <input type="text" name="item_name" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$editItem->item_name }}" placeholder="Enter Name">
                                @if($errors->has('item_name'))
                                <p class="text-danger">{{ $errors->first('item_name') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea rows="5" name="item_desc" class="form-control form-control-sm" placeholder="Write description hare..">
                                {{$editItem->item_desc }}
                                </textarea>
                                @if($errors->has('item_desc'))
                                <p class="text-danger">{{ $errors->first('item_desc') }} </p>
                                @endif
                            </div>
                         
                            <div class="form-group">
                                <label for="exampleInputEmail1">Item Last Purchase Price :</label>
                                <p id=last_perch_price></p>
                            </div>
                              
                            <div class="form-group">
                                <label>Category</label>
                                <select id="cat_id" class="form-control form-control-sm" name="cat_id">
                                <option selected disabled>--select category--</option>
                                @foreach(\App\Models\Category::where('is_parent','1')->get() as $cat)
                                    <option value="{{$cat->id}}" {{$editItem->cat_id == $cat->id ?'selected':''}}>{{$cat->item_cat_name}}</option>
                                @endforeach
                                </select>
                            </div>
                                <div class="form-group d-none" id="child_cat_div">
                                    <label>Child Category</label>
                                    <select id="child_cat_id" class="form-control form-control-sm" name="child_cat_id">
                                    <!-- <option selected disabled>Select child category</option> -->
                                    
                                    </select>
                                </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                        <div class="form-group">
                                <label>Item Unit</label>
                                <select class="form-control form-control-sm" name="item_unit">
                                    <option selected disabled> Select item unit</option>
                                    @foreach(\App\Models\ItemUnit::all() as $unit)
                                    <option value="{{$unit->id}}" {{$editItem->item_unit == $unit->id ?'selected':''}}> {{$unit->unit_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('item_unit'))
                                <p class="text-danger">{{ $errors->first('item_unit') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Item Group</label>
                                <select class="form-control form-control-sm" name="item_group">
                                    <option selected disabled> Select item group</option>
                                    @foreach(\App\Models\ItemGroup::all() as $group)
                                    <option value="{{$group->id}}" {{$editItem->item_group == $group->id ?'selected':''}}>{{$group->item_group_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('item_group'))
                                <p class="text-danger">{{ $errors->first('item_group') }} </p>
                                @endif
                            </div>
                               <div class="form-group">
                                <label for="exampleInputEmail1">item Price</label>
                                <input type="text" name="item_price" class="form-control form-control-sm" id="exampleInputEmail1" value="{{$editItem->item_price}}" placeholder="Enter Price">
                                @if($errors->has('item_price'))
                                <p class="text-danger">{{ $errors->first('item_price') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Terms & Condition</label>
                                <select class="form-control form-control-sm" name="terms_and_conditions">
                                    <option selected disabled> Select terms and conditions</option>
                                    @foreach(\App\Models\Terms::all() as $term)
                                    <option value="{{$term->id}}" {{$editItem->terms_and_conditions == $term->id ?'selected':''}}>{{$term->term_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('terms_and_conditions'))
                                <p class="text-danger">{{ $errors->first('terms_and_conditions') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control form-control-sm" name="status">
                                    <option value="active" {{ $editItem->status=='active'?'selected' : '' }}>
                                        Active</option>
                                    <option value="inactive" {{$editItem->status=='inactive'?'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                @if($errors->has('status'))
                                <p class="text-danger">{{ $errors->first('status') }} </p>
                                @endif
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Update Item</button>
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
        $('#vendor_description').summernote({
            height: 100,
        });
    });
</script>

<script>
  var child_cat_id = {{ $editItem->child_cat_id }};

  $('#cat_id').change(function(){
    var cat_id = $(this).val();
    // alert(cat_id);
    if(cat_id != null){
      $.ajax({
        url:"{{route('category.child')}}",
        type:"POST",
        data:{
            _token:'{{ csrf_token() }}',
            id:cat_id,
        },
        // dataType: 'JSON',
        // contentType: false,
        // cache: false,
        // processData: false,
        success:function(response){
          var html_option = "<option value=''>--child Category--</option>";
          if(response.status){
            $('#child_cat_div').removeClass('d-none');
            $.each(response.data,function(id,item_cat_name){
                html_option += "<option value='"+id+"' "+(child_cat_id==id?'selected':'')+">"+item_cat_name+"</option>";
            });
          }else{
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }

      });
    }
  });
if(child_cat_id !=null){
  $('#cat_id').change();
}

</script>
@endsection