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
          <select name="guard_name" onchange="hi()">
            @foreach ($guard_names as $guard_name)
              <option value="{{ $guard_name }}" {{ ( $guard_name == $roleGuard) ? 'selected' : '' }}> {{ $guard_name}} </option>
            @endforeach 
          </select>
        </div>
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="form-group">
        <label>Team</label>
        <select name="team_id" class="form-control select2"  data-placeholder="Select a Team" id="team_id" style="width: 100%;" onchange="displayVals(this.value)">
          @foreach($guard_names as $guard_name)
            <option value="{{$guard_name}}" {{ ( $guard_name == $roleGuard) ? 'selected' : '' }}>{{$guard_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div id="campaign">
    
    </div>
    {{-- <div class="col-12" id="toshow">
        <div class="input-style-1">
            <label>(*) Permisos</label>
        </div>
        @foreach ($permissions as $permission )
            <div class="form-check checkbox-style checkbox-success mb-20">
                <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $permission->id }}" @if(!empty($rolePermission)) {{ in_array($permission->name, $rolePermission)  ? 'checked' : '' }} @endif>
                <label class="form-check-label" for="checkbox-1">{{ $permission->name }} </label>
            </div>
        @endforeach
    </div> --}}
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
  $('#team_id').on( 'change', function(){ hi(); } );

  function displayVals(data)
  {
    alert('display funciton')
      var option = data;
      $.ajax({
      type: "POST",
      url: "{{ route('permissions.admin.getPermissions') }}",
      data: { 
        guard_name : option ,
        "_token": "{{ csrf_token() }}",
      },
          success:function(campaigns)
          {
              $("#campaign").html(campaigns);
          }
      });
  }

  function hi(){
            alert('hi');
        }

});

  // function displayVals(selectObject) {
  //   alert('display funciton');
  //   var value = selectObject.value;  
  //   if(value == "web"){
  //     $("#toshow").show();
  //   }else{
  //     $("#toshow").hide();
  //   }
  //   console.log(value);
  // }


</script>