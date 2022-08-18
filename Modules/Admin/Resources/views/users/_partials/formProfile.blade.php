@csrf
<div class="row">
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Nombre</label>
        <input type="text" class="bg-transparent" value="{{ $user->name ?? old('name') }}" name="name">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Apellidos</label>
        <input type="text" class="bg-transparent" value="{{ $user->last_name ?? old('last_name') }}" name="last_name">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
        <div class="input-style-1">
            <label>(*) Email</label>
            <input type="email" class="bg-transparent" value="{{ $user->email ?? old('email') }}" name="email">
        </div>
    </div>
    <!-- end col -->
    <div class="col-6">
        <div class="input-style-1">
          <label>Rol Asignado</label>
          <input type="text" value="{{ $userRole ?? old('userRole') }}" name="roles" readonly >
        </div>
    </div>
    <!-- end col -->
    <div class="col-6">
        <div class="input-style-1">
            <label>Contraseña</label>
            <input type="password" name="password" class="bg-transparent">
            @if ($user)
              <span class="form-text m-b-none">Déjelo en blanco si no desea cambiar la contraseña</span>
            @endif
        </div>
    </div>
    <!-- end col -->
    <div class="col-6">
        <div class="input-style-1">
            <label>Confirmar Contraseña</label>
            <input type="password" name="confirm_password" class="bg-transparent">
            @if ($user)
              <span class="form-text m-b-none">Déjelo en blanco si no desea cambiar la contraseña</span>
            @endif
        </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Teléfono</label>
        <input type="text" name="phone" id="phone" value="{{ $user->phone ?? old('phone') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Doc Identidad</label>
        <input type="text" name="ci" value="{{ $user->ci ?? old('ci') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="input-style-1">
        <label>Dirección</label>
        <input type="text" name="address" value="{{ $user->address ?? old('address') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
        <a class="main-btn danger-btn-outline m-2" href="/admin/users/profile/{{$user->id}}">Atrás</a>
      </div>
    </div>
</div>