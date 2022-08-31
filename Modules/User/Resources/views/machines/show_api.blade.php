@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="titlemb-30">
            <h2>Detalle Máquina - Pool {{ $machine->customer_pool }}</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="breadcrumb-wrapper mb-30">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="/user/machines/list_api">Máquinas</a></li>
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
        <div class="col-lg-12">
          <div class="card-style mb-30">
            <form method="POST">
              @csrf
              <div class="row">
                <div class="col-4">
                  <div class="input-style-1">
                    <label>Cliente</label>
                    <input type="text" value="{{ $machine->customer_name }}" readonly>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-4">
                  <div class="input-style-1">
                    <label>Máquina</label>
                    <input type="text" value="{{ $machine->worker_name }} {{ $machine->worker }}" readonly>
                  </div>
                </div>
                <!-- end col -->
                @if ($machine->customer_pool == "antpool.com")
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>10Min Hashrate</label>
                      <input type="text" value="{{ $machine->last10m }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>30Min Hashrate</label>
                      <input type="text" value="{{ $machine->last30m }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>1h Hashrate</label>
                      <input type="text" value="{{ $machine->last1h }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>24hr Hashrate</label>
                      <input type="text" value="{{ $machine->last1d }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                @endif
                @if ($machine->customer_pool == "btc.com")
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Status</label>
                      <input type="text" value="{{ $machine->status }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>1Min Hashrate</label>
                      <input type="text" value="{{ $machine->shares_1m }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>15Min Hashrate</label>
                      <input type="text" value="{{ $machine->shares_15m }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>1h Hashrate</label>
                      <input type="text" value="{{ $machine->shares_1h }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>24Hr Hashrate</label>
                      <input type="text" value="{{ $machine->shares_1d }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Primer tiempo compartido</label>
                      <input type="text" value="{{ date('m/d/Y', $machine->first_share_time ) }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Último tiempo compartido</label>
                      <input type="text" value="{{  date('m/d/Y', $machine->last_share_time ) }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Agente Minero</label>
                      <input type="text" value="{{ $machine->miner_agent }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                @endif

                <div class="col-12">
                  <div class="button-groupd-flexjustify-content-centerflex-wrap">
                    <a class="main-btn danger-btn-outline m-2" href="/user/machines/grid_view_api">Atrás</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Row -->
    </div>
</section>

@endsection