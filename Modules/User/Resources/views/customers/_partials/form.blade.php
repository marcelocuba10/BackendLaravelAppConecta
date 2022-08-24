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
        <label>Teléfono</label>
        <input type="text" id="phone" name="phone" value="{{ $customer->phone ?? old('phone') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-5">
      <div class="input-style-1">
        <label>Dirección</label>
        <input type="text" name="address" value="{{ $customer->address ?? old('address') }}" class="bg-transparent">
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
    <div class="col-sm-4">
      <div class="select-style-1">
        <label>Pool Name</label>
        <div class="select-position">
          @if ($customer)
            <select name="pool">
              @foreach ($pools_options as $pool)
                  <option value="{{ $pool }}" {{ ( $pool === $customer->pool) ? 'selected' : '' }}> {{ $pool }} </option>
              @endforeach 
            </select> 
          @else
            <select name="pool">
              @foreach ($pools_options as $pool)
                  <option value="{{ $pool }}"> {{ $pool}} </option>
              @endforeach 
            </select> 
          @endif
        </div>
      </div>
    </div>
    <!-- end col -->
    <div class="col-4">
      <div class="input-style-1">
        <label>Access Key (btc.com)</label>
        <input type="text" name="access_key" value="{{ $customer->access_key ?? old('access_key') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-4">
      <div class="input-style-1">
        <label>Puid (btc.com)</label>
        <input type="text" name="puid" value="{{ $customer->puid ?? old('puid') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-4">
      <div class="input-style-1">
        <label>UserId (antpool.com)</label>
        <input type="text" name="userIdPool" value="{{ $customer->userIdPool ?? old('userIdPool') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-4">
      <div class="input-style-1">
        <label>Api Key (antpool.com)</label>
        <input type="text" name="apiKey" value="{{ $customer->apiKey ?? old('apiKey') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-4">
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