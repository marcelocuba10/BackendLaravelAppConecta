@csrf
<div class="row">
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Nombre</label>
        <input type="text" name="name" value="{{ $customer->name ?? old('name') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Apellidos</label>
        <input type="text" name="last_name" value="{{ $customer->last_name ?? old('last_name') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-3">
      <div class="input-style-1">
        <label>Doc Identidad</label>
        <input type="text" name="doc_id" value="{{ $customer->doc_id ?? old('doc_id') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-3">
      <div class="input-style-1">
        <label>Teléfono</label>
        <input type="text" name="phone" value="{{ $customer->phone ?? old('phone') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Dirección</label>
        <input type="text" name="address" value="{{ $customer->address ?? old('address') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Email</label>
        <input type="text" name="email" value="{{ $customer->email ?? old('email') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-3">
      <div class="input-style-1">
        <label>(*) Cantidad Máquinas</label>
        <input type="number" min="0" name="total_machines" value="{{ $customer->total_machines ?? old('total_machines') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-sm-3">
      <div class="select-style-1">
        <label>Pool Name</label>
        <div class="select-position">
          @if ($customer)
            <select name="pool" id="pool">
              @foreach ($pools_options as $pool)
                  <option value="{{ $pool }}" {{ ( $pool === $customer->pool) ? 'selected' : '' }}> {{ $pool }} </option>
              @endforeach 
            </select> 
          @else
            <select name="pool" id="pool">
              @foreach ($pools_options as $pool)
                  <option value="{{ $pool }}"> {{ $pool}} </option>
              @endforeach 
            </select> 
          @endif
        </div>
      </div>
    </div>
    <!-- end col -->
    <div class="col-6" id="access_key">
      <div class="input-style-1">
        <label>Access Key (btc.com)</label>
        <input type="text" name="access_key" value="{{ $customer->access_key ?? old('access_key') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6" id="puid">
      <div class="input-style-1">
        <label>Puid (btc.com)</label>
        <input type="text" name="puid" value="{{ $customer->puid ?? old('puid') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-4" id="userIdPool">
      <div class="input-style-1">
        <label>UserId (antpool.com)</label>
        <input type="text" name="userIdPool" value="{{ $customer->userIdPool ?? old('userIdPool') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-4" id="apiKey">
      <div class="input-style-1">
        <label>Api Key (antpool.com)</label>
        <input type="text" name="apiKey" value="{{ $customer->apiKey ?? old('apiKey') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-4" id="secretKey">
      <div class="input-style-1">
        <label>Secret Key (antpool.com)</label>
        <input type="text" name="secretKey" value="{{ $customer->secretKey ?? old('secretKey') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
        <a class="main-btn danger-btn-outline m-2" href="/user/customers">Atrás</a>
      </div>
    </div>
</div>

<script>

  $(document).ready(function(){
  
    // when starting, it captures the value of the select, to then perform the query
    var pool = document.getElementById("pool").value;
    if(pool == "btc.com"){
      document.getElementById('access_key').style.display = 'initial';
      document.getElementById('puid').style.display = 'initial';

      document.getElementById('userIdPool').style.display = 'none';
      document.getElementById('apiKey').style.display = 'none';
      document.getElementById('secretKey').style.display = 'none';
    }

    if(pool == "antpool.com"){
      document.getElementById('access_key').style.display = 'none';
      document.getElementById('puid').style.display = 'none';

      document.getElementById('userIdPool').style.display = 'initial';
      document.getElementById('apiKey').style.display = 'initial';
      document.getElementById('secretKey').style.display = 'initial';
    }
  
    // call the function when an event is generated in the select
    $('#pool').on( 'change', function(){ 
        pool = document.getElementById("pool").value;

        if(pool == "btc.com"){
          document.getElementById('access_key').style.display = 'initial';
          document.getElementById('puid').style.display = 'initial';

          document.getElementById('userIdPool').style.display = 'none';
          document.getElementById('apiKey').style.display = 'none';
          document.getElementById('secretKey').style.display = 'none';
        }

        if(pool == "antpool.com"){
          document.getElementById('access_key').style.display = 'none';
          document.getElementById('puid').style.display = 'none';

          document.getElementById('userIdPool').style.display = 'initial';
          document.getElementById('apiKey').style.display = 'initial';
          document.getElementById('secretKey').style.display = 'initial';
        }
    });
  });
  
</script>