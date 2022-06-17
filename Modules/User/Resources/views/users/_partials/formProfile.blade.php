@csrf
<div class="row">
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) First Name</label>
        <input type="text" class="bg-transparent" value="{{ $user->name ?? old('name') }}" name="name">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Last Name</label>
        <input type="text" class="bg-transparent" value="{{ $user->last_name ?? old('last_name') }}" name="last_name">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
        <div class="input-style-1">
            <label>(*) Email</label>
            <input type="email" {{ ( $user ) ? 'readonly' : '' }} class="{{ (!$user) ? 'bg-transparent' : ''}}" value="{{ $user->email ?? old('email') }}" name="email">
        </div>
    </div>
    <!-- end col -->
    <div class="col-6">
        <div class="input-style-1">
            <label>Password</label>
            <input type="password" name="password" class="bg-transparent">
            <span class="form-text m-b-none">Leave blank if you don't want to change the password</span>
        </div>
    </div>
    <!-- end col -->
    <div class="col-6">
        <div class="input-style-1">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="bg-transparent">
            <span class="form-text m-b-none">Leave blank if you don't want to change the password</span>
        </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Phone Number</label>
        <input type="text" name="phone" id="phone" value="{{ $user->phone ?? old('phone') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="input-style-1">
        <label>Address</label>
        <input type="text" name="address" value="{{ $user->address ?? old('address') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Cedula Identidad</label>
        <input type="text" name="ci" value="{{ $user->ci ?? old('ci') }}" class="bg-transparent">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="input-style-1">
        <label>Birthday</label>
        <input type="text" id="date" name="birthday" value="{{ $user->birthday ?? old('birthday') }}" placeholder="DD/MM/YYYY" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Save</button>
        <a class="main-btn danger-btn-outline m-2" href="{{ route('users_.show.profile',$user->id) }}">Cancel</a>
      </div>
    </div>
</div>