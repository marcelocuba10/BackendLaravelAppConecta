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
          <label>(*) Contraseña</label>
          <input type="password" name="password" class="bg-transparent">
          @if ($user)
            <span class="form-text m-b-none">Déjelo en blanco si no desea cambiar la contraseña</span>
          @endif
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
          <label>(*) Confirmar Contraseña</label>
          <input type="password" name="confirm_password" class="bg-transparent">
          @if ($user)
            <span class="form-text m-b-none">Déjelo en blanco si no desea cambiar la contraseña</span>
          @endif
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Rol</label>
        <input type="text" value="Admin" name="roles" readonly >
      </div>
    </div>
    <!-- end col -->
    @if ($currentUserRole == 'SuperAdmin')
      <div class="col-6">
        <div class="select-style-1">
          <label>(*) Status</label>
          <div class="select-position">
            <select name="idMaster">
              @foreach ($status as $value)
                <option value="{{ $value[0] }}" {{ ( $value[0] == $idMaster) ? 'selected' : '' }}> {{ $value[1] }} </option>
              @endforeach 
            </select>
          </div>
        </div>
      </div>
    @else
      <div class="col-6">
        <div class="input-style-1">
          <label>(*) Status</label>
          @foreach ($status as $value)
            @if ($value[0] == $idMaster)
              <input type="text" value="{{ $value[1] ?? old('idMaster') }}" name="idMaster" readonly >
            @endif
          @endforeach 
        </div>
      </div>
    @endif
    <!-- end col -->
    @if ($currentUserRole == 'SuperAdmin')
      <div class="col-6">
        <div class="select-style-1">
          <label>(*) Planes</label>
          <div class="select-position">
            <select name="plan_id">
              @foreach ($plans as $plan)
                <option value="{{ $plan->id }}" {{ ( $plan->id == $userPlan) ? 'selected' : '' }}> {{ $plan->name }} </option>
              @endforeach 
            </select>
          </div>
        </div>
      </div>
    @else
      <div class="col-6">
        <div class="input-style-1">
          <label>(*) Plan Asignado</label>
          @foreach ($plans as $plan)
            @if( $plan->id == $userPlan)
              <input type="text" value="{{ $plan->name }}" name="plan_id" readonly>   
            @endif   
          @endforeach 
        </div>
      </div>
    @endif  
    <!-- end col -->
    @if ($currentUserRole == 'SuperAdmin')
      <div class="col-4">
        <div class="select-style-1">
          <label>(*) Fecha de Facturación</label>
          <div class="select-position">
            <select name="exp_date_plan">
              @foreach ($days as $day)
                <option value="{{ $day }}" {{ ( $day == $user_exp_date_plan) ? 'selected' : '' }}> {{ $day }} </option>
              @endforeach 
            </select>
          </div>
        </div>
      </div>
    @else
      <div class="col-4">
        <div class="input-style-1">
          <label>(*) Fecha de Facturación</label>
          <input type="text" value="{{ $user->exp_date_plan }}" name="exp_date_plan" readonly>   
        </div>
      </div>
    @endif   
    <!-- end col -->
    <div class="col-4">
      <div class="input-style-1">
        <label>Teléfono</label>
        <input type="text" name="phone" id="phone" value="{{ $user->phone ?? old('phone') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-4">
      <div class="input-style-1">
        <label>(*) Doc Identidad</label>
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
        <a class="main-btn danger-btn-outline m-2" href="/admin/customers">Atrás</a>
      </div>
    </div>
</div>