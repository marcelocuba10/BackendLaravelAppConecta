@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title mb-30">
                <h2>Información del Cliente</h2>
            </div>
        </div>
        <div class="col-md-6">
          <div class="breadcrumb-wrapper mb-30">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="/user/customers">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalle Cliente</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="invoice-wrapper">
      <div class="row">
        <div class="col-12 off-mobile">
          <div class="invoice-card card-style mb-30" style="padding: 15px 15px;">
            <div class="invoice-address">

              <div class="address-item">
                <p class="text-sm">
                  <span class="text-sm">Cliente:</span>
                  <span class="text-sm text-bold">{{ $customer->name ?? old('name') }} {{ $customer->last_name ?? old('last_name') }}</span>
                </p>
                <p class="text-sm">
                  <span class="text-sm">Máquinas Registradas:</span>
                  <span class="text-sm text-bold">{{ count($machines) }}</span>
                </p>
                <p class="text-sm">
                  <span class="text-sm">Teléfono:</span>
                  <span class="text-sm text-medium">{{ $customer->phone ?? old('phone') }}</span>
                </p>
                <p class="text-sm">
                  <span class="text-sm">Dirección:</span>
                  <span class="text-sm text-medium">{{ $customer->address ?? old('address') }}</span>
                </p>
                <p class="text-sm">
                  <span class="text-sm">Email:</span>
                  <span class="text-sm text-medium">{{ $customer->email ?? old('email') }}</span>
                </p>
              </div>

              <div class="address-item">
                <p class="text-sm">
                  <span class="text-sm">Doc Identidad:</span>
                  <span class="text-sm text-medium">{{ $customer->doc_id ?? old('doc_id') }}</span>
                </p>
                <p class="text-sm">
                  <span class="text-sm">Pool:</span>
                  <span class="text-sm text-bold">{{ $customer->pool ?? old('pool') }}</span>
                </p>
                <p class="text-sm">
                  <span class="text-sm">Actualizado:</span>
                  <span class="text-sm text-bold">{{ $customer->updated_at ?? old('updated_at') }} </span>
                </p>
                @if ($customer->pool == "btc.com")
                  <p class="text-sm">
                    <span class="text-sm">Unidad Hashrate:</span>
                    <span class="text-sm text-bold">{{ $customer->shares_unit ?? old('shares_unit') }}</span>
                  </p>
                @endif
                @if ($customer->pool == "antpool.com")
                  <p class="text-sm">
                    <span class="text-sm">Total Hashrate Local (TH):</span>
                    <span class="text-sm text-bold">{{ $total_hash_local ?? old('total_hash_local') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Total Hashrate Pool (TH):</span>
                    <span class="text-sm text-bold">{{ substr($total_hash_pool,0,7) ?? old('total_hash_pool') }}</span>
                  </p>
                @endif
              </div>

              @if ($customer->pool == "btc.com")
                <div class="address-item">
                  <p class="text-sm">
                    <span class="text-sm">Total Máquinas Pool:</span>
                    <span class="text-sm text-bold">{{ $customer->workers_total ?? old('workers_total') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Máquinas Activas:</span>
                    <span class="text-sm text-bold">{{ $customer->workers_active ?? old('workers_active') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Máquinas Inactivas:</span>
                    <span class="text-sm text-bold">{{ $customer->workers_inactive ?? old('workers_inactive') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Máquinas Apagadas:</span>
                    <span class="text-sm text-bold">{{ $customer->workers_dead ?? old('workers_dead') }}</span>
                  </p>
                </div>
              @endIf

              @if ($customer->pool == "antpool.com")
                <div class="address-item">
                  <p class="text-sm">
                    <span class="text-sm">Total Máquinas Pool:</span>
                    <span class="text-sm text-bold">{{ $customer->totalWorkerNum ?? old('totalWorkerNum') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Máquinas Activas:</span>
                    <span class="text-sm text-bold">{{ $customer->activeWorkerNum ?? old('activeWorkerNum') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Máquinas Inactivas:</span>
                    <span class="text-sm text-bold">{{ $customer->inactiveWorkerNum ?? old('inactiveWorkerNum') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Máquinas Apagadas:</span>
                    <span class="text-sm text-bold">{{ $customer->invalidWorkerNum ?? old('invalidWorkerNum') }}</span>
                  </p>
                </div>
              @endIf

              @if ($customer->pool == "btc.com")
                <div class="address-item" style="margin-left: -65px;">
                  <p class="text-sm">
                    <span class="text-sm">1Min Hashrate:</span>
                    <span class="text-sm text-bold">{{ $customer->shares_1m ?? old('shares_1m') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">5Min Hashrate:</span>
                    <span class="text-sm text-bold">{{ $customer->shares_5m ?? old('shares_5m') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">1h Hashrate:</span>
                    <span class="text-sm text-bold">{{ $customer->shares_1h ?? old('shares_1h') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">24hr Hashrate:</span>
                    <span class="text-sm text-bold">{{ $customer->shares_1d ?? old('shares_1d') }}</span>
                  </p>
                </div>
              @endif

              @if ($customer->pool == "antpool.com")
                <div class="address-item" style="margin-left: -65px;">
                  <p class="text-sm">
                    <span class="text-sm">10Min Hashrate (TH):</span>
                    <span class="text-sm text-bold">{{ substr($customer->hsLast10m,0,5) ?? old('hsLast10m') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">1h Hashrate (TH):</span>
                    <span class="text-sm text-bold">{{ substr($customer->hsLast1h,0,5) ?? old('hsLast1h') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">24hr Hashrate (TH):</span>
                    <span class="text-sm text-bold">{{ substr($customer->hsLast1d,0,8) ?? old('hsLast1d') }}</span>
                  </p>
                </div>
              @endif

            </div>
          </div>
          <!-- End Card -->
        </div>

        <div class="col-lg-6 on-mobile">
          <div class="tab-style-2 card-style mb-30">
            <nav class="nav" id="nav-tab">
              <button id="tab-2-1" data-bs-toggle="tab" data-bs-target="#tabContent-2-1" class="active">
                <i class="lni lni-stats-up"></i>
              </button>
              <button id="tab-2-2" data-bs-toggle="tab" data-bs-target="#tabContent-2-2">
                <i class="lni lni-graph"></i>
              </button>
              <button id="tab-2-3" data-bs-toggle="tab" data-bs-target="#tabContent-2-3">
                <i class="lni lni-postcard"></i>
              </button>
              <button id="tab-2-4" data-bs-toggle="tab" data-bs-target="#tabContent-2-4">
                <i class="lni lni-postcard"></i>
              </button>
            </nav>
            <div class="tab-content" id="nav-tabContent2">
              <div class="tab-pane fade active show" id="tabContent-2-1">
                @if ($customer->pool == "btc.com")
                  <div class="address-item">
                    <p class="text-sm">
                      <span class="text-sm">Total Máquinas Pool:</span>
                      <span class="text-sm text-bold">{{ $customer->workers_total ?? old('workers_total') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">Máquinas Activas:</span>
                      <span class="text-sm text-bold">{{ $customer->workers_active ?? old('workers_active') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">Máquinas Inactivas:</span>
                      <span class="text-sm text-bold">{{ $customer->workers_inactive ?? old('workers_inactive') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">Máquinas Apagadas:</span>
                      <span class="text-sm text-bold">{{ $customer->workers_dead ?? old('workers_dead') }}</span>
                    </p>
                  </div>
                @endIf

                @if ($customer->pool == "antpool.com")
                  <div class="address-item">
                    <p class="text-sm">
                      <span class="text-sm">Total Máquinas Pool:</span>
                      <span class="text-sm text-bold">{{ $customer->totalWorkerNum ?? old('totalWorkerNum') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">Máquinas Activas:</span>
                      <span class="text-sm text-bold">{{ $customer->activeWorkerNum ?? old('activeWorkerNum') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">Máquinas Inactivas:</span>
                      <span class="text-sm text-bold">{{ $customer->inactiveWorkerNum ?? old('inactiveWorkerNum') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">Máquinas Apagadas:</span>
                      <span class="text-sm text-bold">{{ $customer->invalidWorkerNum ?? old('invalidWorkerNum') }}</span>
                    </p>
                  </div>
                @endIf
              </div>
              <div class="tab-pane fade" id="tabContent-2-2">
                @if ($customer->pool == "btc.com")
                  <div class="address-item">
                    <p class="text-sm">
                      <span class="text-sm">1Min Hashrate:</span>
                      <span class="text-sm text-bold">{{ $customer->shares_1m ?? old('shares_1m') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">5Min Hashrate:</span>
                      <span class="text-sm text-bold">{{ $customer->shares_5m ?? old('shares_5m') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">1h Hashrate:</span>
                      <span class="text-sm text-bold">{{ $customer->shares_1h ?? old('shares_1h') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">24hr Hashrate:</span>
                      <span class="text-sm text-bold">{{ $customer->shares_1d ?? old('shares_1d') }}</span>
                    </p>
                  </div>
                @endif

                @if ($customer->pool == "antpool.com")
                  <div class="address-item">
                    <p class="text-sm">
                      <span class="text-sm">10Min Hashrate (TH):</span>
                      <span class="text-sm text-bold">{{ substr($customer->hsLast10m,0,5) ?? old('hsLast10m') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">1h Hashrate (TH):</span>
                      <span class="text-sm text-bold">{{ substr($customer->hsLast1h,0,5) ?? old('hsLast1h') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">24hr Hashrate (TH):</span>
                      <span class="text-sm text-bold">{{ substr($customer->hsLast1d,0,8) ?? old('hsLast1d') }}</span>
                    </p>
                  </div>
                @endif
              </div>
              <div class="tab-pane fade" id="tabContent-2-3">
                <div class="address-item">
                  <p class="text-sm">
                    <span class="text-sm">Cliente:</span>
                    <span class="text-sm text-bold">{{ $customer->name ?? old('name') }} {{ $customer->last_name ?? old('last_name') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Máquinas Registradas:</span>
                    <span class="text-sm text-bold">{{ count($machines) }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Teléfono:</span>
                    <span class="text-sm text-medium">{{ $customer->phone ?? old('phone') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Dirección:</span>
                    <span class="text-sm text-medium">{{ $customer->address ?? old('address') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Email:</span>
                    <span class="text-sm text-medium">{{ $customer->email ?? old('email') }}</span>
                  </p>
                </div>
              </div>
              <div class="tab-pane fade" id="tabContent-2-4">
                <div class="address-item">
                  <p class="text-sm">
                    <span class="text-sm">Doc Identidad:</span>
                    <span class="text-sm text-medium">{{ $customer->doc_id ?? old('doc_id') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Pool:</span>
                    <span class="text-sm text-bold">{{ $customer->pool ?? old('pool') }}</span>
                  </p>
                  <p class="text-sm">
                    <span class="text-sm">Actualizado:</span>
                    <span class="text-sm text-bold">{{ $customer->updated_at ?? old('updated_at') }} </span>
                  </p>
                  @if ($customer->pool == "btc.com")
                    <p class="text-sm">
                      <span class="text-sm">Unidad Hashrate:</span>
                      <span class="text-sm text-bold">{{ $customer->shares_unit ?? old('shares_unit') }}</span>
                    </p>
                  @endif
                  @if ($customer->pool == "antpool.com")
                    <p class="text-sm">
                      <span class="text-sm">Total Hashrate Local (TH):</span>
                      <span class="text-sm text-bold">{{ $total_hash_local ?? old('total_hash_local') }}</span>
                    </p>
                    <p class="text-sm">
                      <span class="text-sm">Total Hashrate Pool (TH):</span>
                      <span class="text-sm text-bold">{{ substr($total_hash_pool,0,7) ?? old('total_hash_pool') }}</span>
                    </p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <!-- End card -->
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
  </div>
</section>

<section class="section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card-style mb-30">
          <div id="container"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title mb-30">
                <h2>Rendimiento de Máquinas</h2>
            </div>
        </div>
      </div>
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="form-layout-wrapper">
      <div class="card-style activity-card mb-30">
        <div class="row">
          <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
            <div class="left col-md-9">
              <div id="legend3">
                <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                  <li>
                    <div class="d-flex">
                      <span class="bg-color success-bg"> </span>
                      <div class="text">
                        <p class="text-sm text-success">
                          <span class="text-dark">Work</span>&nbsp; 100%
                          <i class="lni lni-arrow-up"></i>
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color warning-bg"></span>
                      <div class="text">
                        <p class="text-sm text-danger">
                          <span class="text-dark">Work</span>&nbsp; -10 & -40%
                          <i class="lni lni-arrow-down"></i>
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-attention-2"></span>
                      <div class="text">
                        <p class="text-sm text-danger">
                          <span class="text-dark">Work</span>&nbsp; -50%
                          <i class="lni lni-arrow-down"></i>
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-disabled"></span>
                      <div class="text">
                        <p class="text-sm text-danger">
                          <span class="text-dark">Offline</span>&nbsp; 0%
                          <i class="lni lni-arrow-down"></i>
                        </p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="right">
              @if (isset($filter))
              <ul class="legend3 d-flex align-items-center mb-30">
                <li>
                  <div class="d-flex">
                    <div class="text">
                      <form action="/user/machines/search_gridview" method="POST">
                        @csrf
                        <button class="btn-group-status" name="filter" value="" type="submit"><p class="text-sm text-dark"><i class="lni lni-close"></i>&nbsp; Quitar Filtros</p></button>
                      </form> 
                    </div>
                  </div>
                </li>
              </ul>
              @endif
            </div>
          </div>

            <div class="card-style-3 mb-30">
              <div class="card-content">
                  @if ($customer->pool == "btc.com")
                    <div id="grid">
                      @foreach($machines as $machine)
                        <a href="/user/machines/{{$machine->id}}/show">
                          <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $machine->name }}" 
                            class="
                            @if(strtolower($machine->status) == 'active') bg-card-enabled 
                            @elseIf($machine->status == 'Apagado') bg-card-disabled
                            @elseIf($machine->status == 'Requiere Atención') bg-card-attention
                            @elseIf($machine->status == 'Mantenimiento') bg-card-maintenance
                            @elseIf($machine->status == 'Error') bg-card-error
                            @elseIf(strtolower($machine->status) == 'inactive') bg-card-offline 
                            @endif">
                            <p class="text-sm  text-white" style="margin-top: 10px;">{{ Str::limit($machine->name, 3) }}</p>
                          </div>
                        </a> 
                      @endforeach
                    </div>
                  @endif
                  
                  @if ($customer->pool == "antpool.com")
                    <div id="grid">
                      @foreach($machines as $machine)
                        @foreach ($machines_api as $machines_api_item)
                          @if (strtolower($machines_api_item->worker)  === strtolower($machine->name)  )
                            @php
                              $machineStatus = '';
                              $percent = $machine->total_power * 0.10;
                              $percentFourty = $machine->total_power * 0.40;
                              $percentFifty = $machine->total_power * 0.50;

                              $total_power_percent_ten = $machine->total_power - $percent;
                              $total_power_percent_fourty = $machine->total_power - $percentFourty;
                              $total_power_percent_fifty = $machine->total_power - $percentFifty;
                            @endphp

                            @if($machines_api_item->last10m == 0)
                                @php
                                  $machineStatus = "bg-card-disabled";   
                                @endphp
                              @else
                              {{-- If machine working 100% or more, show card color green --}}
                              @if ($machines_api_item->last10m >= $machine->total_power || $machines_api_item->last10m >= $total_power_percent_ten)
                                @php
                                  $machineStatus = "bg-card-enabled";       
                                @endphp    
                              {{-- If machine working -50% or more, show card color orange --}}
                              @elseIf ($machines_api_item->last10m <= $total_power_percent_fifty && $machines_api_item->last10m > 0)
                                @php
                                  $machineStatus = "bg-card-attention-2";        
                                @endphp
                              {{-- If machine working -10% and -40% or more, show card color yellow --}}   
                              @elseIf ($machines_api_item->last10m <= $total_power_percent_ten || $machines_api_item->last10m <= $total_power_percent_fourty && $machines_api_item->last10m > 0 && $machines_api_item->last10m >= $total_power_percent_fifty)
                                @php
                                  $machineStatus = "bg-card-attention";        
                                @endphp
                              {{-- If machine not working with result 0.00 or undefined, card color dark --}}       
                              @else
                                @php
                                  $machineStatus = "bg-card-dark";   
                                @endphp 
                              @endif    
                            @endif

                            <a href="/user/machines/{{$machine->id}}/show">
                              <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $machine->name }}" class="{{ $machineStatus }}">
                                <p class="text-sm  text-white" style="margin-top: 10px;">{{ Str::limit($machine->name, 3) }}</p>
                              </div>
                            </a> 
                          @endif
                        @endforeach
                      @endforeach
                    </div> 
                  @endif
              </div>
            </div>
        </div>
      <!-- end row -->
    </div>
  </div>
</section>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    // var total_hash_pool_graph = <?php 
    //   $data = json_encode($total_hash_pool_graph);
    //   echo str_replace('"', '', $data);
    // ?>;
    
    var total_hash_local = <?php echo str_replace('"', '', $total_hash_local); ?>;

    var machine_api_pool = <?php echo json_encode($customer->pool); ?>;

    Highcharts.chart('container', {
    chart: {
        type: 'spline',
        scrollablePlotArea: {
            minWidth: 600,
            scrollPositionX: 1
        }
    },
    title: {
        text: 'Gráfico HashRate Pool',
        align: 'left'
    },
    subtitle: {
        text: machine_api_pool,
        align: 'left'
    },
    xAxis: {
        type: 'datetime',
        labels: {
            overflow: 'justify'
        }
    },
    yAxis: {
        title: {
            text: 'HashRate (TH/s)'
        },
        minorGridLineWidth: 0,
        gridLineWidth: 1,
        alternateGridColor: null,
        plotBands: [{ 
            from: 0,
            to: total_hash_local,
            color: 'rgba(68, 170, 213, 0.1)',
            label: {
                text: '',
                style: {
                    color: '#606060'
                }
            }
        }]
    },
    tooltip: {
        valueSuffix: ' TH/s'
    },
    plotOptions: {
        spline: {
            lineWidth: 4,
            states: {
                hover: {
                    lineWidth: 5
                }
            },
            marker: {
                enabled: false,
            },

            pointInterval: 180000, // one hour
            pointStart: Date.UTC(2022, 8, 15, 0, 0, 0)
        }
    },
    series: [{
        name: 'HashRate Standard ' + total_hash_local + ' (TH/s)',
        // data: [13.5,13.5,13.5,13.5,13.5,13.5,13.5,13.5,13.5]

    }, {
        name: 'HashRate Pool',
        color: '#00b17b',
        data: [1113.5,6005.5,13.5,13.5,13.5,13.5,13.5,13.5,13.5],
    }],
    navigation: {
        menuItemStyle: {
            fontSize: '10px'
        }
    }
});

</script>

@endsection 
