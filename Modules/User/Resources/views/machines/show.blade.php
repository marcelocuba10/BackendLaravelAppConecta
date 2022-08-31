@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="titlemb-30">
            <h2>Detalle de Máquina Local</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="breadcrumb-wrapper mb-30">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('machines.index_list') }}">Máquinas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalle</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="form-layout-wrapper">
      <div class="row">
        <div class="col-lg-8">
          <div class="card-style mb-30">
            <form method="POST">
              @csrf
              <div class="row">
                <div class="col-6">
                  <div class="input-style-1">
                    <label>Nombre</label>
                    <input type="text" value="{{ $machine->name }}" readonly>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-6">
                  <div class="input-style-1">
                    <label>Cliente</label>
                    <input type="text" value="{{ $machine->customer_name }}" readonly>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-4">
                  <div class="input-style-1">
                    <label>Estado</label>
                    <input type="text" value="{{ $machine->status }}" readonly>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-4">
                  <div class="input-style-1">
                    <label>Potencia Mineración</label>
                    <input type="text" value="{{ $machine->mining_power }}" readonly>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-4">
                  <div class="input-style-1">
                    <label>Standard Hashrate</label>
                    <input type="text" value="{{ $machine->total_power }}" readonly>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-4">
                  <div class="input-style-1">
                    <label>Tiempo Real Hashrate</label>
                    @if ($machine->customer_pool == 'btc.com')
                      @if (!$machine_api)
                        <input type="text" value="Sin Información" readonly>
                      @else
                        <input type="text" value="{{ $machine_api->shares_1m ?? old('shares_1m')}}" readonly>
                      @endif
                    @elseIf($machine->customer_pool == 'antpool.com')
                      @if (!$machine_api)
                        <input type="text" value="Sin Información" readonly>
                      @else
                        <input type="text" value="{{ $machine_api->last10m ?? old('last10m')}}" readonly>
                      @endif
                    @elseIf($machine->customer_pool == 'binance.com')
                      @if (!$machine_api)
                        <input type="text" value="Sin Información" readonly>
                      @else
                        <input type="text" value="{{ $machine_api->last10m ?? old('last10m')}}" readonly>
                      @endif  
                    @elseIf($machine->customer_pool == 'poolin.com')
                      @if (!$machine_api)
                        <input type="text" value="Sin Información" readonly>
                      @else
                        <input type="text" value="{{ $machine_api->last10m ?? old('last10m')}}" readonly>
                      @endif    
                    @endif

                    @if ($machine_api)
                      <span class="form-text m-b-none">Actualizado: {{ $machine_api->created_at ?? old('created_at')}}</span>
                    @endif
                  </div>
                </div>
                <!-- end col -->
                <div class="col-8">
                  <div class="input-style-1">
                    <label>Observación</label>
                    <textarea type="text" value="{{ $machine->observation }}"
                      readonly>{{ $machine->observation }}</textarea>
                  </div>
                </div>
                <!-- end col -->
                {{-- <div class="col-12">
                  <div class="button-groupd-flexjustify-content-centerflex-wrap">
                    <a class="main-btn danger-btn-outline m-2" href="/user/machines/grid_view">Atrás</a>
                  </div>
                </div> --}}
                <div class="col-12">
                  <div class="button-group d-flex justify-content-center flex-wrap">
                    @can('machine-edit')
                      <a class="main-btn success-btn m-2" href="/user/machines/edit/{{ $machine->id }}">Editar</a>
                    @endcan
                    <a class="main-btn danger-btn-outline m-2" href="/user/machines/grid_view" >Atrás</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
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

      @if ($machine_changes)
      <div class="row">
        <div class="col-lg-12">
          <div class="card-style mb-30">
            <div class="table-wrapper table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    {{-- <th><h6>#</h6></th> --}}
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
                    @foreach ($machine_changes as $machine)
                    <tr>
                        {{-- <td class="min-width"><p>{{ ++$i }}</p></td> --}}
                        <td class="min-width"><p>{{ $machine->name }}</p></td>
                        <td class="min-width"><h5 class="text-bold text-dark">{{ $machine->status }}</h5></td>
                        <td class="min-width"><p><i class="lni lni-calendar mr-10"></i>{{ $machine->created_at }}</p></td>
                        <td class="min-width"><p><i class="lni lni-user mr-10"></i>{{ $machine->customer_name }}</p></td>
                        <td class="min-width"><p><i class="lni lni-user mr-10"></i>{{ $machine->user_name }}</p></td>
                        <td class="min-width"><p><i class="lni lni-comments-alt mr-10"></i>{{ $machine->observation }}</p></td>
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
      @else
      <div class="row">
        <div class="col-lg-12">
          <div class="card-style mb-30">
            <div class="table-wrapper table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    {{-- <th><h6>#</h6></th> --}}
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
                    <tr>
                        <td class="min-width"><p></p></td>
                        <td class="min-width"><p></p></td>
                        <td class="min-width"><p></p></td>
                        <td class="min-width"><p></p></td>
                        <td class="min-width"><p></p></td>
                        <td class="min-width"><p></p></td>
                    </tr>
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
      @endif
    </div>
</section>

@endsection