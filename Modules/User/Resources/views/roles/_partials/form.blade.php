@csrf
<div class="row">
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Nombre</label>
        <input type="text" name="name" value="{{ $role->name ?? old('name') }}" class="bg-transparent" placeholder="Ingrese Nombre">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
        <div class="input-style-1">
          <label>Guard</label>
          <input type="text" name="guard_name" value="{{ $role->guard_name ?? old('guard_name') }}" readonly>
        </div>
    </div>
    <!-- end col -->
    <div class="col-12">
        <div class="input-style-1">
            <label>(*) Permisos</label>
        </div>
        @foreach ($permissions as $permission )
            <div class="form-check checkbox-style checkbox-success mb-20">
                <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $permission->id }}" @if(!empty($rolePermission)) {{ in_array($permission->name, $rolePermission)  ? 'checked' : '' }} @endif>
                <label class="form-check-label" for="checkbox-1">{{ $permission->name }} </label>
            </div>
        @endforeach
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
        <a class="main-btn danger-btn-outline m-2" href="{{ route('roles.index') }}">Cancelar</a>
      </div>
    </div>
</div>
