@csrf
<div class="row">
    <div class="col-4">
      <div class="input-style-1">
        <label>(*) Nombre</label>
        <input type="text" name="name" value="{{ $role->name ?? old('name') }}" class="bg-transparent" placeholder="Ingrese Nombre">
      </div>
    </div>
    <!-- end col -->
    <div class="col-4">
      <div class="select-style-1">
        <label>(*) Rol de Sistema</label>
        <div class="select-position">
          <select name="system_role">
            @foreach ($keys as $key)
              <option value="{{ $key[0] }}" {{ ( $key[0] == $system_role) ? 'selected' : '' }}> {{ $key[1] }} </option>
            @endforeach 
          </select>
        </div>
      </div>
    </div>
    <!-- end col -->
    <div class="col-4">
      <div class="select-style-1">
        <label>(*) Guard</label>
        <div class="select-position">
          <select name="guard_name">
            @foreach ($guard_names as $guard_name)
              <option value="{{ $guard_name }}" {{ ( $guard_name == $roleGuard) ? 'selected' : '' }}> {{ $guard_name}} </option>
            @endforeach 
          </select>
        </div>
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
        <a class="main-btn danger-btn-outline m-2" href="/admin/ACL/roles">Atrás</a>
      </div>
    </div>
</div>
