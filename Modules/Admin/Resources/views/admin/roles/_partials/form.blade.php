@csrf
<div class="form-group  row"><label class="col-sm-2 col-form-label">*Name</label>
    <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Enter name" autocomplete="off" value="{{ $role->name ?? old('name') }}">
    </div>
</div>

<div class="form-group  row"><label class="col-sm-2 col-form-label">*Permisos</label>
    <div class="col-sm-10">
        @foreach ($permissions as $permission )
            <div class="i-checks">
                <label>
                    <!-- guardo en array ya que se puede marcar mas de un valor -->
                    <input name="permission[]" type="checkbox" value="{{ $permission->id }}" @if(!empty($rolePermission)) {{ in_array($permission->name, $rolePermission)  ? 'checked' : '' }} @endif><i></i> {{ $permission->name }} 
                </label>
            </div>
        @endforeach
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <div class="col-sm-4 col-sm-offset-2">
        <a class="btn btn-white btn-sm" href="{{ route('roles.index') }}" >Cancelar</a>
        <button class="btn btn-primary btn-sm" type="submit">Guardar Cambios</button>
    </div>
</div>