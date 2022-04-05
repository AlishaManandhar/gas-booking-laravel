<form action="{{$route}}" method="post">
    @csrf
    @if(isset($order))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" class="form-control" value="{{isset($order) ? $order->quantity : old('quantity')}}">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="location" id="address" class="form-control" value="{{isset($order) ? $order->location : old('location')}}">
    </div>
    <input type="hidden" name="product_id" value="{{isset($order) ? $order->product->id : $productId}}">
    <input type="hidden" name="price" value="{{isset($order) ? $order->product->price : $price}}">
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
    <button type="submit" class="btn btn-primary mt-3"> {{$buttonText}}</button>
</form>
