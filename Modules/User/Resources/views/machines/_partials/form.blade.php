@csrf
<div class="row">
  <div class="col-lg-8">
    <div class="card-style mb-30">
      <div class="row">
        <div class="col-sm-6">
          <div class="input-style-1">
            <label>(*) Nombre</label>
            <input type="text" name="name" value="{{ $machine->name ?? old('name') }}" class="bg-transparent">
          </div>
        </div>
        <!-- end col -->
        <div class="col-sm-6">
          <div class="select-style-1">
            <label>(*) Estado</label>
            <div class="select-position">
              @if ($machine)
                <select name="status">
                  @foreach ($status as $item)
                      <option value="{{ $item }}" {{ ( $item === $machine->status) ? 'selected' : '' }}> {{ $item}} </option>
                  @endforeach 
                </select> 
              @else
                <select name="status">
                  @foreach ($status as $item)
                      <option value="{{ $item }}"> {{ $item}} </option>
                  @endforeach 
                </select> 
              @endif
            </div>
          </div>
        </div>
      </div>
      <!-- end col -->
      <div class="col-12">
        <div class="select-style-1">
          <label>(*) Cliente</label>
          <div class="select-position">
            @if($machine)
            <select name="customer_id">
              @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}" {{ ( $customer->id == $machine->customer_id) ? 'selected' : '' }}> {{ $customer->name}} </option>
              @endforeach 
            </select>
            @else
            <select name="customer_id">
              @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}"> {{ $customer->name}} </option>
              @endforeach 
            </select>
            @endIf
          </div>
        </div>
      </div>
      <!-- end col -->
      <div class="col-12">
        <div class="input-style-1">
          <label>Observación</label>
          <textarea type="text" name="observation" value="{{ $machine->observation ?? old('observation') }}" class="bg-transparent">{{ $machine->observation ?? old('observation') }}</textarea>
        </div>
      </div>
      <!-- end col -->
      <div class="col-12">
        <div class="button-group d-flex justify-content-center flex-wrap">
          <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
          <a class="main-btn danger-btn-outline m-2" href="{{ route('machines.index') }}">Cancelar</a>
        </div>
      </div>
    </div>
    <!-- end card -->
  </div>
  <!-- end col -->
  <div class="col-lg-4">
    <div class="card-style mb-30">
      <div style="text-align: center">
        {!! QrCode::size(300)->generate( $codeQR ) !!}           
        <div class="input-style-1" style="margin-top: 30px">
          <input style="text-align: center" type="text" name="codeQR" value="{{ $machine->codeQR }}" readonly>
        </div>
      </div>
    </div>
  </div>
  <!-- End Col -->
</div>