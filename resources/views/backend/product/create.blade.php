@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="is_featured">Is Featured</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes                        
        </div>
              {{-- {{$categories}} --}}

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group d-none" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any category--</option>
              {{-- @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
              @endforeach --}}
          </select>
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price(PKR) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">Discount(%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"  value="{{old('discount')}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="size">Size</label>
          <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">--Select any size--</option>
              <option value="30 (XS)">30 (XS)</option>

              <option value="32 (XS)">32 (XS)</option>
              <option value="32 (S)">32 (S)</option>
              
              <option value="34 (S)">34 (S)</option>
              <option value="34 (M)">34 (M)</option>
              
              <option value="36 (S)">36 (S)</option>
              <option value="36 (M)">36 (M)</option>
              <option value="36 (L)">36 (L)</option>
              
              <option value="38 (M)">38 (M)</option>
              <option value="38 (L)">38 (L)</option>
              
              <option value="40 (L)">40 (L)</option>
              <option value="40 (XL)">40 (XL)</option>
              
              <option value="42 (L)">42 (L)</option>
              <option value="42 (XL)">42 (XL)</option>
              
              <option value="one-size">One Size</option>
          </select>
        </div>

        <div class="form-group">
          <label for="color">Color</label>
          <select name="color[]" class="form-control selectpicker" multiple data-live-search="true">
              <option value="">--Select any color--</option>
              <option value="Red">Red</option>
              <option value="Blue">Blue</option>
              <option value="Black">Black</option>
              <option value="Pink">Pink</option>
              <option value="White">White</option>
              <option value="Green">Green</option>
              <option value="Yellow">Yellow</option>
              <option value="Purple">Purple</option>
              <option value="Orange">Orange</option>
              <option value="Grey">Grey</option>
              <option value="Brown">Brown</option>
              <!-- New Colors -->
              <option value="Chocolate Brown">Chocolate Brown</option>
              <option value="Coffee Brown">Coffee Brown</option>
              <option value="Multicolour">Multicolour</option>
              <option value="Hot Pink">Hot Pink</option>
              <option value="Navy Blue">Navy Blue</option>
              <option value="Khaki">Khaki</option>
              <option value="Lilac Purple">Lilac Purple</option>
              <option value="Apricot">Apricot</option>
              <option value="Maroon">Maroon</option>
              <option value="Dark Grey">Dark Grey</option>
              <option value="Baby Pink">Baby Pink</option>
              <option value="Yellow Gold">Yellow Gold</option>
              <option value="Silver">Silver</option>
              <option value="Gold">Gold</option>
              <option value="Burgundy">Burgundy</option>
              <option value="Coffin">Coffin</option>
              <option value="Beige">Beige</option>

          </select>
      </div>

        <div class="form-group">
          <label for="brand_id">Brand</label>
          {{-- {{$brands}} --}}

          <select name="brand_id" class="form-control">
              <option value="">--Select Brand--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}">{{$brand->title}}</option>
             @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="condition">Condition</label>
          <select name="condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default">Default</option>
              <option value="new">New</option>
              <option value="hot">Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{old('stock')}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
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
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
   var route_prefix = "{{ asset('laravel-filemanager') }}";
    $('#lfm').filemanager('image', {prefix: route_prefix});

    
    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
    // $('select').selectpicker();

</script>

<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Select sub category----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
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
  })
</script>
@endpush