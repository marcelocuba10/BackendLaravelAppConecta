@csrf
<div class="row">
  <div class="col-lg-8">
    <div class="card-style mb-30">
      <div class="row">
        <div class="col-sm-6">
          <div class="input-style-1">
            <label>(*) Nombre</label>
            <input style="text-transform: uppercase" type="text" name="name" value="{{ $machine->name ?? old('name') }}" class="bg-transparent">
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
          <a class="main-btn danger-btn-outline m-2" href="/user/machines/grid_view">Cancelar</a>
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
          <input style="text-align: center" type="text" name="codeQR" value="{{ $machine->codeQR ?? $codeQR}}" readonly>
        </div>
      </div>
    </div>
  </div>
  <!-- End Col -->
</div>
<!-- End Row -->

<div class="row">
  <div class="title-wrapper pt-30">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="title mb-30">
          <h2>Histórico de la máquina</h2>
        </div>
      </div>
      <!-- end col -->
      <div class="col-md-6">
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card-style mb-30">
      <div class="table-wrapper table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th><h6>#</h6></th>
              <th><h6>Nombre</h6></th>
              <th><h6>Estado</h6></th>
              <th><h6>Fecha</h6></th>
              <th><h6>Cliente</h6></th>
              <th><h6>Funcionario</h6></th>
              <th><h6>Observación</h6></th>
            </tr>
            <!-- end table row-->
          </thead>
          <tbody>
              @foreach ($machines as $machine)
              <tr>
                  <td class="min-width"><p>{{ ++$i }}</p></td>
                  <td class="min-width"><h5 class="text-bold text-dark"><a href="{{ route('machines.edit', $machine->id) }}">{{ $machine->name }}</a></h5></td>
                  <td class="min-width">
                    <span class="status-btn 
                    @if($machine->status == 'Encendido') success-btn
                    @elseIf($machine->status == 'Apagado') gray-btn-custom
                    @elseIf($machine->status == 'Requiere Atención') warning-btn
                    @elseIf($machine->status == 'Mantenimiento') primary-btn
                    @elseIf($machine->status == 'Error') danger-btn
                    @elseIf($machine->status == 'Deshabilitado') dark-btn
                    @endif">
                      {{ $machine->status }}
                    </span>
                  </td>
                  <td class="min-width"><p>{{ $machine->created_at }}</p></td>
                  <td class="min-width"><p>{{ $machine->customer_name }}</p></td>
                  <td class="min-width"><p>{{ $machine->user_name }}</p></td>
                  <td class="min-width"><p>{{ $machine->observation }}</p></td>
              </tr>
              @endforeach
            <!-- end table row -->
          </tbody>
        </table>
        <!-- end table -->
      </div>
    </div>
    <!-- end card -->
  </div>
  <!-- end col -->
</div>
<!-- end row -->