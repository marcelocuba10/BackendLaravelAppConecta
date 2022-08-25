@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
            <div class="titlemb-30">
                <h2>Detalle Cliente: {{ $customer->name }}</h2>
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
    <div class="form-layout-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="tab-style-2 card-style mb-30">
            <nav class="nav" id="nav-tab">
              <button id="tab-2-2" class="main-btn deactive-btn active" data-bs-toggle="tab" data-bs-target="#tabContent-2-2">
                <i class="lni lni-graph mr-10"></i>Información de Máquinas
              </button>
              <button id="tab-2-1" class="main-btn deactive-btn" data-bs-toggle="tab" data-bs-target="#tabContent-2-1">
                <i class="lni lni-user mr-10"></i>Información Básica
              </button>
            </nav>
            <div class="tab-content" id="nav-tabContent2">
              <div class="tab-pane fade " id="tabContent-2-1">
                <div class="row">
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Nombre</label>
                      <input type="text" value="{{ $customer->name ?? old('name') }}" name="name" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Teléfono</label>
                      <input type="text" value="{{ $customer->phone ?? old('phone') }}" name="phone" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Dirección</label>
                      <input type="text" value="{{ $customer->address ?? old('address') }}" name="address" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Pool Name</label>
                      <input type="text" name="pool" value="{{ $customer->pool ?? old('pool') }}" >
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Access Key (btc.com)</label>
                      <input type="text" name="access_key" value="{{ $customer->access_key ?? old('access_key') }}" >
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Puid (btc.com)</label>
                      <input type="text" name="puid" value="{{ $customer->puid ?? old('puid') }}">
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>UserId (antpool.com)</label>
                      <input type="text" name="userIdPool" value="{{ $customer->userIdPool ?? old('userIdPool') }}">
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Api Key (antpool.com)</label>
                      <input type="text" name="apiKey" value="{{ $customer->apiKey ?? old('apiKey') }}" >
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-4">
                    <div class="input-style-1">
                      <label>Secret Api Key (antpool.com)</label>
                      <input type="text" name="secretKey" value="{{ $customer->secretKey ?? old('secretKey') }}" >
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-12">
                    <div class="button-groupd-flexjustify-content-centerflex-wrap">
                      <a class="main-btn danger-btn-outline m-2" href="/user/customers">Atrás</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade active show" id="tabContent-2-2">
                <div class="row">
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>workers_total</label>
                      <input type="text" value="{{ $customer->workers_total }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>workers_active</label>
                      <input type="text" value="{{ $customer->workers_active }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>workers_inactive</label>
                      <input type="text" value="{{ $customer->workers_inactive }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>workers_dead</label>
                      <input type="text" value="{{ $customer->workers_dead }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>shares_1m</label>
                      <input type="text" value="{{ $customer->shares_1m }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>shares_5m</label>
                      <input type="text" value="{{ $customer->shares_5m }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>shares_15m</label>
                      <input type="text" value="{{ $customer->shares_15m }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-3">
                    <div class="input-style-1">
                      <label>shares_1d</label>
                      <input type="text" value="{{ $customer->shares_1d }}" readonly>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-12">
                    <div class="button-groupd-flexjustify-content-centerflex-wrap">
                      <a class="main-btn danger-btn-outline m-2" href="/user/customers">Atrás</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- <section class="section">
  <div class="container-fluid">
    <!-- Chart Card Wrapper Start -->
    <div class="chart-card-wrapper">
      <div class="row" style="display: none">
        <div class="col-lg-7">
          <div class="card-style mb-30">
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="Chart1" style="width: 846px; height: 400px; display: block;" width="846" height="400" class="chartjs-render-monitor"></canvas>
            </div>
            <!-- End Chart -->
          </div>
        </div>
        <!-- End Col -->
        <div class="col-lg-5">
          <div class="card-style mb-30">
            <div class="title d-flex justify-content-between">
              <div class="left">
                <h6 class="text-medium mb-20">Bar Chart</h6>
              </div>
            </div>
            <!-- End Title -->
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="Chart4" style="width: 100%; height: 400px; display: block;" width="579" height="400" class="chartjs-render-monitor"></canvas>
            </div>
            <!-- End Chart -->
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
      <div class="row">
        <div class="col-lg-7" style="margin: auto">
          <div class="card-style">
            <div class="title d-flex align-items-center justify-content-between">
              <div class="left">
                <h6 class="text-medium mb-20">Line Chart</h6>
              </div>
            </div>
            <!-- End Title -->
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="Chart3" style="width: 846px; height: 400px; display: block;" width="846" height="400" class="chartjs-render-monitor"></canvas>
            </div>
          </div>
        </div>
        <!-- End Col -->
        <div class="col-lg-5" style="display: none">
          <div class="card-style mb-30">
            <div class="title d-flex justify-content-between">
              <div class="left">
                <h6 class="text-medium mb-20">Bar Chart</h6>
              </div>
            </div>
            <!-- End Title -->
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="Chart2" style="width: 100%; height: 400px; display: block;" width="579" height="400" class="chartjs-render-monitor"></canvas>
            </div>
            <!-- End Chart -->
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->

      <!-- End Row -->
    </div>
    <!-- Chart Card Wrapper End -->
  </div>
  <!-- end container -->
</section> --}}


<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-6">
            <div class="titlemb-30">
                <h2>Comparacion de Máquinas</h2>
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
                <ul class="legend3 d-flex align-items-center mb-30">
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-enabled"></span>
                      <div class="text">
                        <form action="#" method="">
                          @csrf
                          <button class="btn-group-status" name="filter" value="active" type="submit"><p class="text-sm text-dark">Activo</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-attention"> </span>
                      <div class="text">
                        <form action="#" method="">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Requiere Atención" type="submit"><p class="text-sm text-dark">Requiere Atención</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-error"> </span>
                      <div class="text">
                        <form action="#" method="#">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Error" type="submit"><p class="text-sm text-dark">Error</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-maintenance"></span>
                      <div class="text">
                        <form action="#" method="#">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Mantenimiento" type="submit"><p class="text-sm text-dark">Mantenimiento</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-offline"></span>
                      <div class="text">
                        <form action="#" method="#">
                          @csrf
                          <button class="btn-group-status" name="filter" value="inactive" type="submit"><p class="text-sm text-dark">Inactivo</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-disabled"></span>
                      <div class="text">
                        <form action="#" method="#">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Apagado" type="submit"><p class="text-sm text-dark">Apagado</p></button>
                        </form> 
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
                            @if($machine->status == 'ACTIVE') bg-card-enabled 
                            @elseIf($machine->status == 'Apagado') bg-card-disabled
                            @elseIf($machine->status == 'Requiere Atención') bg-card-attention
                            @elseIf($machine->status == 'Mantenimiento') bg-card-maintenance
                            @elseIf($machine->status == 'Error') bg-card-error
                            @elseIf($machine->status == 'INACTIVE') bg-card-offline 
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
                                $machineStatus='';
                                $percent = $machine->total_power * 0.10;
                                $total_power_percent = $machine->total_power - $percent;
                              @endphp
                              @if ($machines_api_item->last10m > 0)
                                @php
                                  $machineStatus = "bg-card-enabled";        
                                @endphp    
                        
                              @elseIf ($machines_api_item->last10m < $total_power_percent && $machines_api_item->last10m > 0)
                                @php
                                  $machineStatus = "bg-card-attention";        
                                @endphp  
                              @else
                                @php
                                  $machineStatus = "bg-card-disabled";   
                                @endphp  
                                {{-- <a href="/user/machines/{{$machine->id}}/show">
                                  <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $machine->name }}" 
                                    class="
                                    @if($machine->status == 'ACTIVE') bg-card-enabled 
                                    @elseIf($machine->status == 'Apagado') bg-card-disabled
                                    @elseIf($machine->status == 'Requiere Atención') bg-card-attention
                                    @elseIf($machine->status == 'Mantenimiento') bg-card-maintenance
                                    @elseIf($machine->status == 'Error') bg-card-error
                                    @elseIf($machine->status == 'INACTIVE') bg-card-offline 
                                    @endif">
                                    <p class="text-sm  text-white" style="margin-top: 10px;">{{ Str::limit($machine->name, 3) }}</p>
                                  </div>
                                </a>  --}}
                              @endif 
                              <a href="/user/machines/{{$machine->id}}/show">
                                <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $machine->name }}" 
                                  class=" {{ $machineStatus }}">
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
