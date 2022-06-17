@csrf
<div class="form-group  row"><label class="col-sm-2 col-form-label">*Name</label>
    <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Enter name" autocomplete="off" value="{{ $partner->name ?? old('name') }}">
    </div>
</div>
<div class="form-group  row"><label class="col-sm-2 col-form-label">*UserName</label>
    <div class="col-sm-10">
        <input type="text" name="username" class="form-control" placeholder="Enter username" autocomplete="off" value="{{ $partner->username ?? old('username') }}">
    </div>
</div>
<div class="form-group  row"><label class="col-sm-2 col-form-label">*Email</label>
    <div class="col-sm-10">
        <input type="text" name="email" class="form-control" placeholder="Enter email" autocomplete="off" value="{{ $partner->email ?? old('email') }}">
    </div>
</div>
<div class="form-group  row"><label class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
        <input type="password" name="password" class="form-control" placeholder="Enter password" autocomplete="off" value="">
        <span class="form-text m-b-none">Leave blank if you don't want to change the password</span>
    </div>
</div>
<div class="form-group  row"><label class="col-sm-2 col-form-label">Confirm Password</label>
    <div class="col-sm-10">
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" autocomplete="off" value="">
        <span class="form-text m-b-none">Leave blank if you don't want to change the password</span>
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <div class="col-sm-4 col-sm-offset-2">
        <a class="btn btn-white btn-sm" href="{{ route('partners.index') }}" >Cancelar</a>
        <button class="btn btn-primary btn-sm" type="submit">Guardar Cambios</button>
    </div>
</div>