@csrf
<div class="row">
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Nombre</label>
        <input type="text" placeholder="Ingrese Nombre" class="bg-transparent" value="{{ $permission->name ?? old('name') }}" name="name">
        <span class="form-text m-b-none">Exemplo: role-sa-list, role-sa-create, role-sa-edit, role-sa-delete</span>
      </div>
    </div>
    <!-- end col -->
    @if ($guard_name)
      <div class="col-6">
        <div class="input-style-1">
            <label>Guard</label>
            <input type="text" value="{{ $guard_name ?? old('guard_name')}}" readonly>
        </div>
      </div>
    @else
      <div class="col-6">
        <div class="input-style-1">
            <label>Guard</label>
            <input type="text" value="{{ $permission->guard_name ?? old('guard_name')}}" readonly>
        </div>
      </div> 
    @endif
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
        <a class="main-btn danger-btn-outline m-2" href="/admin/ACL/permissions">Atrás</a>
      </div>
    </div>
</div>