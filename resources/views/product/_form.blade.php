<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control mb-3" value="{{isset($product) ? $product["name"] :old('name')}}">
    @error('name');
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="price">Price</label>
    <input type="number" name="price" id="price" class="form-control mb-3"  value="{{isset($product) ? $product["price"] : old('price')}}">
    @error('price');
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10" class="form-control mb-3">{{isset($product) ? $product["description"] : old('description')}}</textarea>
    @error('description');
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" id="image" class="form-control">
    @error('image');
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>
