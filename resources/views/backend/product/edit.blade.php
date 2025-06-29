@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.update',$product->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$product->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='{{$product->is_featured}}' {{(($product->is_featured) ? 'checked' : '')}}> Yes                        
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>
        @php 
          $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
        // dd($sub_cat_info);

        @endphp
        {{-- {{$product->child_cat_id}} --}}
        <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any sub category--</option>
              
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{$product->price}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">Discount(%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"  value="{{$product->discount}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="size">Size</label>
          <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">--Select any size--</option>
              @foreach($items as $item)              
                @php 
                $data=explode(',',$item->size);
                // dd($data);
                @endphp
                
              <option value="30 (XS)" @if( in_array( "30 (XS)",$data ) ) selected @endif >30 (XS)</option>

              <option value="32 (XS)" @if( in_array( "32 (XS)",$data ) ) selected @endif >32 (XS)</option>
              <option value="32 (S)" @if( in_array( "32 (S)",$data ) ) selected @endif>32 (S)</option>

              <option value="34 (S)" @if( in_array( "34 (S)",$data ) ) selected @endif >34 (S)</option>
              <option value="34 (M)" @if( in_array( "34 (M)",$data ) ) selected @endif >34 (M)</option>
              
              <option value="36 (S)" @if( in_array( "36 (S)",$data ) ) selected @endif >36 (S)</option>
              <option value="36 (M)" @if( in_array( "36 (M)",$data ) ) selected @endif >36 (M)</option>
              <option value="36 (L)" @if( in_array( "36 (L)",$data ) ) selected @endif>36 (L)</option>
              
              <option value="38 (M)" @if( in_array( "38 (M)",$data ) ) selected @endif >38 (M)</option>
              <option value="38 (L)" @if( in_array( "38 (L)",$data ) ) selected @endif>38 (L)</option>
              
              <option value="40 (L)" @if( in_array( "40 (L)",$data ) ) selected @endif >40 (L)</option>
              <option value="40 (XL)" @if( in_array( "40 (XL)",$data ) ) selected @endif >40 (XL)</option>
              
              <option value="42 (L)" @if( in_array( "42 (L)",$data ) ) selected @endif >42 (L)</option>
              <option value="42 (XL)" @if( in_array( "42 (XL)",$data ) ) selected @endif >42 (XL)</option>
              
              <option value="one-size" @if( in_array( "one-size",$data ) ) selected @endif>One Size</option>


              @endforeach
          </select>
        </div>

        <!-- Add this in edit.blade.php after the size field -->
        <div class="form-group">
            <label for="color">Color</label>
            <select name="color[]" class="form-control selectpicker" multiple data-live-search="true">
                <option value="">--Select any color--</option>
                @foreach($items as $item)              
                    @php 
                    $colors = explode(',', $item->color ?? '');
                    @endphp
                    <option value="Red" @if(in_array("Red", $colors)) selected @endif>Red</option>
                    <option value="Blue" @if(in_array("Blue", $colors)) selected @endif>Blue</option>
                    <option value="Black" @if(in_array("Black", $colors)) selected @endif>Black</option>
                    <option value="Pink" @if(in_array("Black", $colors)) selected @endif>Pink</option>
                    <option value="White" @if(in_array("White", $colors)) selected @endif>White</option>
                    <option value="Green" @if(in_array("Green", $colors)) selected @endif>Green</option>
                    <option value="Yellow" @if(in_array("Yellow", $colors)) selected @endif>Yellow</option>
                    <option value="Purple" @if(in_array("Purple", $colors)) selected @endif>Purple</option>
                    <option value="Orange" @if(in_array("Orange", $colors)) selected @endif>Orange</option>
                    <option value="Grey" @if(in_array("Grey", $colors)) selected @endif>Grey</option>
                    <option value="Brown" @if(in_array("Brown", $colors)) selected @endif>Brown</option>
                    <!-- New Colors -->
                    <option value="Chocolate Brown" @if(in_array("Chocolate Brown", $colors)) selected @endif>Chocolate Brown</option>
                    <option value="Coffee Brown" @if(in_array("Coffee Brown", $colors)) selected @endif>Coffee Brown</option>
                    <option value="Multicolour" @if(in_array("Multicolour", $colors)) selected @endif>Multicolour</option>
                    <option value="Hot Pink" @if(in_array("Hot Pink", $colors)) selected @endif>Hot Pink</option>
                    <option value="Navy Blue" @if(in_array("Navy Blue", $colors)) selected @endif>Navy Blue</option>
                    <option value="Khaki" @if(in_array("Khaki", $colors)) selected @endif>Khaki</option>
                    <option value="Lilac Purple" @if(in_array("Lilac Purple", $colors)) selected @endif>Lilac Purple</option>
                    <option value="Apricot" @if(in_array("Apricot", $colors)) selected @endif>Apricot</option>
                    <option value="Maroon" @if(in_array("Maroon", $colors)) selected @endif>Maroon</option>
                    <option value="Dark Grey" @if(in_array("Dark Grey", $colors)) selected @endif>Dark Grey</option>
                    <option value="Baby Pink" @if(in_array("Baby Pink", $colors)) selected @endif>Baby Pink</option>
                    <option value="Yellow Gold" @if(in_array("Yellow Gold", $colors)) selected @endif>Yellow Gold</option>
                    <option value="Silver" @if(in_array("Silver", $colors)) selected @endif>Silver</option>
                    <option value="Gold" @if(in_array("Gold", $colors)) selected @endif>Gold</option>
                    <option value="Burgundy" @if(in_array("Burgundy", $colors)) selected @endif>Burgundy</option>
                    <option value="Coffin" @if(in_array("Coffin", $colors)) selected @endif>Coffin</option>
                    <option value="Beige" @if(in_array("Beige", $colors)) selected @endif>Beige</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
          <label for="brand_id">Brand</label>
          <select name="brand_id" class="form-control">
              <option value="">--Select Brand--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">Condition</label>
          <select name="condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default" {{(($product->condition=='default')? 'selected':'')}}>Default</option>
              <option value="new" {{(($product->condition=='new')? 'selected':'')}}>New</option>
              <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{$product->stock}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                  <i class="fas fa-image"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Inactive</option>
        </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div> 
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>

  // Retrieve the prefix from the environment variable
  const fileManagerPrefix = @json(env('FILEMANAGER_PREFIX'));
   // $('#lfm').filemanager('image');
    $('#lfm').filemanager('image', {prefix: fileManagerPrefix});

    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail Description.....",
          tabsize: 2,
          height: 150
      });
    });
</script>

<script>
  var  child_cat_id='{{$product->child_cat_id}}';
        // alert(child_cat_id);
        $('#cat_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success:function(response){
                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--Select any one--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected ' : '')+">"+title+"</option>";
                                });
                            }
                            else{
                                console.log('no response data');
                            }
                        }
                        else{
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);

                    }
                });
            }
            else{

            }

        });
        if(child_cat_id!=null){
            $('#cat_id').change();
        }
</script>
@endpush