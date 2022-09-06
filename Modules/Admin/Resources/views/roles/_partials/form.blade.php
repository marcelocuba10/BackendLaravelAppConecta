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
          <select name="guard_name" id="guard_name">
            @foreach ($guard_names as $guard_name)
              <option value="{{ $guard_name }}" {{ ( $guard_name == $roleGuard) ? 'selected' : '' }}> {{ $guard_name}} </option>
            @endforeach 
          </select>
        </div>
      </div>
    </div>
    <!-- end col -->
    
    <div class="col-12" id="toshow">
      <div class="input-style-1">
          <label>(*) Permisos</label>
      </div>
      <!-- show content javascript -->
      <div id="permissions">
      </div>
    </div>
    <!-- end col -->

    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
        <a class="main-btn danger-btn-outline m-2" href="/admin/ACL/roles">Atrás</a>
      </div>
    </div>
</div>

<script>
$(document).ready(function(){

  // when starting, it captures the value of the select, to then perform the query
  var guard_name = document.getElementById("guard_name").value;
  $.ajax({
      type: "POST",
      url: "{{ route('permissions.admin.getPermissions') }}",
      data: { 
        guard_name : guard_name,
        "_token": "{{ csrf_token() }}",
      },
        success:function(permissions)
        {
          $("#permissions").html(permissions);
        }
    });

    // call the function when an event is generated in the select
    $('#guard_name').on( 'change', function(){ 
    guard_name = document.getElementById("guard_name").value;
    $.ajax({
      type: "POST",
      url: "{{ route('permissions.admin.getPermissions') }}",
      data: { 
        guard_name : guard_name,
        "_token": "{{ csrf_token() }}",
      },
        success:function(permissions)
        {
          $("#permissions").html(permissions);
        }
    });
  });
});

</script>