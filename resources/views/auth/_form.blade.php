<div class="form-group mb-3">
    <label for="fname">Firstname</label>
    <input type="text" name="firstname" id="fname" class="form-control" value="{{ old('firstname') }}">
    @error('firstname')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="name">Lastname</label>
    <input type="text" name="lastname" id="name" class="form-control" value="{{ old('lastname') }}">
    @error('lastname')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control">
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="password_confirmation">Password Confirmation</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    @error('password_confirmation')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="address">Address</label>
    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
    @error('address')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="phone">Phone</label>
    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
    @error('phone')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
