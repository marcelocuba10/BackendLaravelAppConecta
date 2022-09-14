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
          <!-- end card -->
        </div>
        <!-- ENd Col -->
      </div>
      <!-- End Row -->
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

<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/Chart.min.js"></script>
<script src="/assets/js/apexcharts.min.js"></script>
<script src="/assets/js/dynamic-pie-chart.js"></script>
<script src="/assets/js/moment.min.js"></script>
<script src="/assets/js/fullcalendar.js"></script>
<script src="/assets/js/jvectormap.min.js"></script>
<script src="/assets/js/world-merc.js"></script>
<script src="/assets/js/polyfill.js"></script>
<script src="/assets/js/quill.min.js"></script>
<script src="/assets/js/datatable.js"></script>
<script src="/assets/js/Sortable.min.js"></script>
<script src="/assets/js/main.js"></script>

<script>
  // =========== chart one start
  var ctx1 = document.getElementById("Chart1").getContext("2d");
  var chart1 = new Chart(ctx1, {
    // The type of chart we want to create
    type: "line", // also try bar or other graph types

    // The data for our dataset
    data: {
      labels: [
        "Jan",
        "Fab",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
      // Information about the dataset
      datasets: [
        {
          label: "",
          backgroundColor: "transparent",
          borderColor: "#4A6CF7",
          data: [
            600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
          ],
          pointBackgroundColor: "transparent",
          pointHoverBackgroundColor: "#4A6CF7",
          pointBorderColor: "transparent",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 5,
          pointBorderWidth: 5,
          pointRadius: 8,
          pointHoverRadius: 8,
        },
      ],
    },

    // Configuration options
    options: {
      tooltips: {
        callbacks: {
          labelColor: function (tooltipItem, chart) {
            return {
              backgroundColor: "rgba(104, 110, 255, .0)",
            };
          },
        },
        intersect: false,
        backgroundColor: "#F3F6F8",
        titleFontColor: "#8F92A1",
        titleFontSize: 12,
        bodyFontColor: "#171717",
        bodyFontStyle: "bold",
        bodyFontSize: 16,
        multiKeyBackground: "transparent",
        displayColors: false,
        xPadding: 30,
        yPadding: 10,
        bodyAlign: "center",
        titleAlign: "center",
      },

      title: {
        display: false,
      },
      legend: {
        display: false,
      },

      scales: {
        yAxes: [
          {
            gridLines: {
              display: false,
              drawTicks: false,
              drawBorder: false,
            },
            ticks: {
              padding: 35,
              max: 1200,
              min: 0,
            },
          },
        ],
        xAxes: [
          {
            gridLines: {
              drawBorder: false,
              color: "rgba(143, 146, 161, .1)",
              zeroLineColor: "rgba(143, 146, 161, .1)",
            },
            ticks: {
              padding: 20,
            },
          },
        ],
      },
    },
  });
  // =========== chart one end

  // =========== chart two start
  var ctx2 = document.getElementById("Chart2").getContext("2d");
  var chart2 = new Chart(ctx2, {
    // The type of chart we want to create
    type: "bar", // also try bar or other graph types
    // The data for our dataset
    data: {
      labels: [
        "Jan",
        "Fab",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
      // Information about the dataset
      datasets: [
        {
          label: "",
          backgroundColor: "#4A6CF7",
          barThickness: 6,
          maxBarThickness: 8,
          data: [
            600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
          ],
          pointBackgroundColor: "#F3F6F8",
          pointHoverBackgroundColor: "#5243AA",
          pointBorderColor: "#F3F6F8",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 5,
          pointBorderWidth: 5,
          pointRadius: 8,
          pointHoverRadius: 8,
        },
      ],
    },
    // Configuration options
    options: {
      borderColor: "#F3F6F8",
      borderWidth: 15,
      backgroundColor: "#F3F6F8",
      tooltips: {
        callbacks: {
          labelColor: function (tooltipItem, chart) {
            return {
              backgroundColor: "rgba(104, 110, 255, .0)",
            };
          },
        },
        intersect: false,
        backgroundColor: "#F3F6F8",
        titleFontColor: "#8F92A1",
        titleFontSize: 12,
        bodyFontColor: "#171717",
        bodyFontStyle: "bold",
        bodyFontSize: 16,
        multiKeyBackground: "transparent",
        displayColors: false,
        xPadding: 30,
        yPadding: 10,
        bodyAlign: "center",
        titleAlign: "center",
      },

      title: {
        display: false,
      },
      legend: {
        display: false,
      },

      scales: {
        yAxes: [
          {
            gridLines: {
              display: false,
              drawTicks: false,
              drawBorder: false,
            },
            ticks: {
              padding: 35,
              max: 1200,
              min: 0,
            },
          },
        ],
        xAxes: [
          {
            gridLines: {
              display: false,
              drawBorder: false,
              color: "rgba(143, 146, 161, .1)",
              zeroLineColor: "rgba(143, 146, 161, .1)",
            },
            ticks: {
              padding: 20,
            },
          },
        ],
      },
    },
  });
  // =========== chart two end

  // =========== chart three start
  var ctx3 = document.getElementById("Chart3").getContext("2d");
  var chart3 = new Chart(ctx3, {
    // The type of chart we want to create
    type: "line", // also try bar or other graph types

    // The data for our dataset
    data: {
      labels: [
        "Jan",
        "Fab",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
      // Information about the dataset
      datasets: [
        {
          label: "Revenue",
          backgroundColor: "transparent",
          borderColor: "#5243AA",
          data: [80, 120, 110, 100, 130, 150, 115, 145, 140, 130, 160, 210],
          pointBackgroundColor: "transparent",
          pointHoverBackgroundColor: "#5243AA",
          pointBorderColor: "transparent",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 3,
          pointBorderWidth: 5,
          pointRadius: 5,
          pointHoverRadius: 8,
        },
        {
          label: "Profit",
          backgroundColor: "transparent",
          borderColor: "#686EFF",
          data: [
            120, 160, 150, 140, 165, 210, 135, 155, 170, 140, 130, 200,
          ],
          pointBackgroundColor: "transparent",
          pointHoverBackgroundColor: "#686EFF",
          pointBorderColor: "transparent",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 3,
          pointBorderWidth: 5,
          pointRadius: 5,
          pointHoverRadius: 8,
        },
        {
          label: "Order",
          backgroundColor: "transparent",
          borderColor: "#FF8730",
          data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
          pointBackgroundColor: "transparent",
          pointHoverBackgroundColor: "#FF8730",
          pointBorderColor: "transparent",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 3,
          pointBorderWidth: 5,
          pointRadius: 5,
          pointHoverRadius: 8,
        },
      ],
    },

    // Configuration options
    options: {
      tooltips: {
        callbacks: {
          labelColor: function (tooltipItem, chart) {
            return {
              backgroundColor: "rgba(104, 110, 255, 1)",
            };
          },
        },
        intersect: false,
        backgroundColor: "#fbfbfb",
        titleFontColor: "#8F92A1",
        titleFontSize: 16,
        titleFontFamily: "Inter",
        titleFontStyle: "400",
        bodyFontColor: "#171717",
        bodyFontSize: 16,
        multiKeyBackground: "transparent",
        displayColors: false,
        xPadding: 30,
        yPadding: 15,
        borderColor: "rgba(143, 146, 161, .1)",
        borderWidth: 1,
        title: false,
      },

      title: {
        display: false,
      },

      layout: {
        padding: {
          top: 0,
        },
      },

      legend: false,

      scales: {
        yAxes: [
          {
            gridLines: {
              display: false,
              drawTicks: false,
              drawBorder: false,
            },
            ticks: {
              padding: 35,
              max: 300,
              min: 50,
            },
          },
        ],
        xAxes: [
          {
            gridLines: {
              drawBorder: false,
              color: "rgba(143, 146, 161, .1)",
              zeroLineColor: "rgba(143, 146, 161, .1)",
            },
            ticks: {
              padding: 20,
            },
          },
        ],
      },
    },
  });
  // =========== chart three end
  // ================== chart four start
  var ctx4 = document.getElementById("Chart4").getContext("2d");
      var chart4 = new Chart(ctx4, {
        // The type of chart we want to create
        type: "bar", // also try bar or other graph types
        // The data for our dataset
        data: {
          labels: ["Jan", "Fab", "Mar", "Apr", "May", "Jun"],
          // Information about the dataset
          datasets: [
            {
              label: "",
              backgroundColor: "#4A6CF7",
              barThickness: "flex",
              maxBarThickness: 8,
              data: [600, 700, 1000, 700, 650, 800],
              pointBackgroundColor: "#F3F6F8",
              pointHoverBackgroundColor: "#5243AA",
              pointBorderColor: "#F3F6F8",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 5,
              pointBorderWidth: 5,
              pointRadius: 8,
              pointHoverRadius: 8,
            },
            {
              label: "",
              backgroundColor: "#EB5757",
              barThickness: "flex",
              maxBarThickness: 8,
              data: [690, 740, 720, 1120, 876, 900],
              pointBackgroundColor: "#F3F6F8",
              pointHoverBackgroundColor: "#5243AA",
              pointBorderColor: "#F3F6F8",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 5,
              pointBorderWidth: 5,
              pointRadius: 8,
              pointHoverRadius: 8,
            },
          ],
        },
        // Configuration options
        options: {
          borderColor: "#F3F6F8",
          borderWidth: 15,
          backgroundColor: "#F3F6F8",
          tooltips: {
            callbacks: {
              labelColor: function (tooltipItem, chart) {
                return {
                  backgroundColor: "rgba(104, 110, 255, .0)",
                };
              },
            },
            intersect: false,
            backgroundColor: "#F3F6F8",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 10,
            bodyAlign: "center",
            titleAlign: "center",
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [
              {
                gridLines: {
                  display: false,
                  drawTicks: false,
                  drawBorder: false,
                },
                ticks: {
                  padding: 35,
                  max: 1200,
                  min: 0,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  display: false,
                  drawBorder: false,
                  color: "rgba(143, 146, 161, .1)",
                  zeroLineColor: "rgba(143, 146, 161, .1)",
                },
                ticks: {
                  padding: 20,
                },
              },
            ],
          },
        },
      });
      // =========== chart four end

      // ================== chart polarChart1 start
      var ctxRadarChart1 = document
        .getElementById("radarChart1")
        .getContext("2d");
      var radarChart1 = new Chart(ctxRadarChart1, {
        // The type of chart we want to create
        type: "radar", // also try bar or other graph types
        // The data for our dataset
        data: {
          labels: ["Mon", "Thu", "Wed", "Tus", "Fri", "Sta"],
          // Information about the dataset
          datasets: [
            {
              label: "Level 1",
              backgroundColor: "rgba(235, 87, 87, .3)",
              pointBorderColor: "rgba(235, 87, 87, 1)",
              pointBackgroundColor: "rgba(235, 87, 87, 1)",
              borderColor: "rgba(235, 87, 87, 1)",
              pointRadius: 4,
              borderWidth: 2,
              data: [480, 300, 420, 340, 380, 290],
            },
            {
              label: "Level 2",
              backgroundColor: "rgba(47, 128, 237, .3)",
              pointBorderColor: "rgba(47, 128, 237, 1)",
              pointBackgroundColor: "rgba(47, 128, 237, 1)",
              borderColor: "rgba(47, 128, 237, 1)",
              pointRadius: 4,
              borderWidth: 2,
              data: [200, 450, 330, 400, 270, 370],
            },
          ],
        },
        // Configuration options
        options: {
          borderColor: "#F3F6F8",
          borderWidth: 15,
          backgroundColor: "#F3F6F8",
          tooltips: {
            intersect: false,
            backgroundColor: "#F3F6F8",
            titleFontFamily: "Inter",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontFamily: "Inter",
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            xPadding: 30,
            yPadding: 10,
            bodyAlign: "center",
            titleAlign: "center",
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [
              {
                gridLines: {
                  display: false,
                  drawTicks: false,
                  drawBorder: false,
                },
                ticks: {
                  display: false,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  display: false,
                  drawBorder: false,
                },
                ticks: {
                  display: false,
                },
              },
            ],
          },
        },
      });
      // =========== chart polarChart1 end

      // ================== chart polarChart1 start
      const ctxPieChart1 = document
        .getElementById("pieChart1")
        .getContext("2d");
      const pieChart1 = new Chart(ctxPieChart1, {
        // The type of chart we want to create
        type: "doughnut",
        // The data for our dataset
        data: {
          labels: ["Speed", "Reliability", "Safety", "Comport"],
          // Information about the dataset
          datasets: [
            {
              data: [10, 20, 25, 20],
              backgroundColor: ["#EB5757", "#F2C94C", "#219653", "#4A6CF7"],
            },
          ],
        },
        // Configuration options
        options: {
          cutoutPercentage: 60,
          borderColor: "#F3F6F8",
          borderWidth: 15,
          backgroundColor: "#F3F6F8",
          tooltips: {
            backgroundColor: "#F3F6F8",
            titleFontFamily: "Inter",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontFamily: "Inter",
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            bodyAlign: "center",
            titleAlign: "center",
            xPadding: 15,
            yPadding: 12,
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [
              {
                gridLines: {
                  display: false,
                  drawTicks: false,
                  drawBorder: false,
                },
                ticks: {
                  display: false,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  display: false,
                  drawBorder: false,
                },
                ticks: {
                  display: false,
                },
              },
            ],
          },
        },
      });
      // =========== chart polarChart1 end

      // ================== chart polarChart1 start
      const ctxPolarChart1 = document
        .getElementById("polarChart1")
        .getContext("2d");
      const polarChart1 = new Chart(ctxPolarChart1, {
        // The type of chart we want to create
        type: "polarArea",
        // The data for our dataset
        data: {
          labels: ["Speed", "Reliability", "Safety", "Comport"],
          // Information about the dataset
          datasets: [
            {
              data: [15, 20, 25, 20],
              backgroundColor: ["#f2994a", "#d50100", "#4a6cf7", "#f7c800"],
            },
          ],
        },
        // Configuration options
        options: {
          tooltips: {
            intersect: false,
            backgroundColor: "#F3F6F8",
            bodyFontFamily: "Inter",
            titleFontFamily: "Inter",
            titleFontColor: "#8F92A1",
            titleFontSize: 12,
            bodyFontColor: "#171717",
            bodyFontStyle: "bold",
            bodyFontSize: 16,
            multiKeyBackground: "transparent",
            displayColors: false,
            bodyAlign: "center",
            titleAlign: "center",
          },

          title: {
            display: false,
          },
          legend: {
            display: false,
          },

          scales: {
            yAxes: [
              {
                gridLines: {
                  display: false,
                  drawTicks: false,
                  drawBorder: false,
                },
                ticks: {
                  display: false,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  display: false,
                  drawBorder: false,
                },
                ticks: {
                  display: false,
                },
              },
            ],
          },
        },
      });
      // =========== chart polarChart1 end

      //============ doughnutChart1 start
      const doughnutChart1 = new ApexCharts(
        document.querySelector("#doughnutChart1"),
        (options = {
          series: [83, 67, 55, 44],
          chart: {
            height: 350,
            type: "radialBar",
            fontFamily: "Inter",
          },

          plotOptions: {
            radialBar: {
              dataLabels: {
                name: {
                  fontSize: "22px",
                },
                value: {
                  fontSize: "16px",
                },
                total: {
                  show: true,
                  label: "Total",
                  formatter: function (w) {
                    return 249;
                  },
                },
              },
              hollow: {
                size: "40%",
              },
              track: {
                strokeWidth: "100%",
                margin: 10,
              },
            },
          },
          stroke: {
            lineCap: "round",
          },
          labels: ["Desktop", "Tablet", "Mobile", "Others"],
          colors: ["#4a6cf7", "#f2994a", "#d50100", "#f7c800"],
        })
      );
      doughnutChart1.render();
      //============ doughnutChart1 end
  </script>


@endsection  
