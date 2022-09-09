@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="title d-flex align-items-center flex-wrap mb-30">
            <h2 class="mr-40">Máquinas Local</h2>
            @can('machine-create')
            <a href="/user/machines/create" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
            @endcan
            <a style="margin-left: 17px;" href="/user/machines/grid_view" title="Vista modo cuadricula"><i class="hthtg lni lni-grid-alt"></i></a>
            <a style="margin-left: 17px;" href="/user/machines/list" title="Vista modo lista"><i class="hthtg lni lni-list"></i></a>
            {{-- @if(count($machines) > 0)
              <a style="margin-left: 17px;" href="{{route('machines.createPDF',['download'=>'pdf'])}}" target="_blank"><i class="hthtg lni lni-printer"></i></a>
            @endif --}}
            <a style="margin-left: 17px;" href="/user/machines/import-csv" title="Importar csv"><i class="hthtg lni lni-upload"></i></a>
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-4">
          <div class="right">
            <div class="table-search d-flex" style="margin-top: -35px;float: right;">
              <form action="/user/machines/search_gridview" method="POST">
                @csrf
                <input style="background-color: #fff;" id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar">
                <button type="submit"><i class="lni lni-search-alt"></i></button>
              </form>    
            </div>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
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
                        <form action="/user/machines/filter_gridview" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Active" type="submit"><p class="text-sm text-dark">Activo</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-offline"></span>
                      <div class="text">
                        <form action="/user/machines/filter_gridview" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Inactive" type="submit"><p class="text-sm text-dark">Inactivo</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-disabled"></span>
                      <div class="text">
                        <form action="/user/machines/filter_gridview" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Apagado" type="submit"><p class="text-sm text-dark">Apagado</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-attention"> </span>
                      <div class="text">
                        <form action="/user/machines/filter_gridview" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Requiere Atención" type="submit"><p class="text-sm text-dark">Requiere Atención</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-maintenance"></span>
                      <div class="text">
                        <form action="/user/machines/filter_gridview" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Mantenimiento" type="submit"><p class="text-sm text-dark">Mantenimiento</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-error"> </span>
                      <div class="text">
                        <form action="/user/machines/filter_gridview" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Error" type="submit"><p class="text-sm text-dark">Error</p></button>
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

          @if(count($machines) > 0)
            @foreach($customers as $customer)
              @php
                $total_machines = 0;
                $count_active = 0;
                $count_inactive = 0;
                $count_warning = 0;
                $count_dead = 0;
              @endphp
              <div class="card-style-3 mb-30" style="border: 1px solid #817c7c36;padding: 20px 10px;">
                <div class="card-content">
                  <div class="title d-flex flex-wrap pl-10 pr-30 mb-10 align-items-center justify-content-between">
                      <h6><a href="/user/customers/show/{{ $customer->id }}">Cliente: {{ $customer->name }}</a> | {{ $customer->pool }}</h6>
                  </div>

                  @foreach($machines as $machine)
                    @if ($machine->customer_id == $customer->id)
                      @php
                        $total_machines += 1;
                      @endphp
                      @if (strtolower($machine->status) == 'active')
                        @php
                            $count_active += 1;
                        @endphp
                      @elseIf (strtolower($machine->status) == 'inactive')
                        @php
                          $count_inactive += 1;
                        @endphp
                      @elseIf ($machine->status == 'Requiere Atención')
                        @php
                          $count_warning += 1;
                        @endphp
                      @elseIf ($machine->status == 'Apagado')
                        @php
                          $count_dead += 1;
                        @endphp
                      @endif
                    @endif
                  @endforeach

                  @if ($customer->pool == "btc.com")
                    @if ($customer->access_key && $customer->puid)
                      <div id="legend4">
                          <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                              <li>
                                  <div class="d-flex">
                                      <div class="text">
                                          <p class="text-sm text-active">
                                              <span class="text-dark">Total Máquinas</span>&nbsp;({{ $total_machines }})
                                          </p>
                                      </div>
                                  </div>
                              </li>
                              <li>
                                  <div class="d-flex">
                                      <div class="text">
                                          <p class="text-sm text-custom-enabled">
                                              <span class="text-dark">Activas</span>&nbsp;({{ $count_active }})<i class="lni lni-arrow-up"></i>
                                          </p>
                                      </div>
                                  </div>
                              </li>
                              <li>
                                  <div class="d-flex">
                                      <div class="text">
                                          <p class="text-sm text-gray">
                                              <span class="text-dark">Inactivas</span>&nbsp;({{ $count_inactive }})<i class="lni lni-arrow-down"></i>
                                          </p>
                                      </div>
                                  </div>
                              </li>
                              <li>
                                  <div class="d-flex">
                                      <div class="text">
                                          <p class="text-sm text-gray">
                                              <span class="text-dark">Apagadas</span>&nbsp;({{ $count_dead }})<i class="lni lni-arrow-down"></i>
                                          </p>
                                      </div>
                                  </div>
                              </li>
                              <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm" style="color:#FFC107">
                                            <span class="text-dark">Requiere Atención</span>&nbsp;({{ $count_warning }})<i class="lni lni-arrow-down"></i>
                                        </p>
                                    </div>
                                </div>
                              </li>
                          </ul>
                      </div>
                    @else
                      <div id="legend4">
                          <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                              <li>
                                  <div class="d-flex">
                                      <div class="text">
                                          <p class="text-sm text-active">
                                              <span class="text-dark">Sin información disponible, revise los datos de registro.</span>
                                          </p>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                    @endif
                  @endif

                  @if ($customer->pool == "antpool.com")
                    @if ($customer->userIdPool && $customer->apiKey && $customer->secretKey)
                        <div id="legend4">
                            <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                                <li>
                                    <div class="d-flex">
                                        <div class="text">
                                            <p class="text-sm text-active">
                                                <span class="text-dark">Total Máquinas</span>&nbsp;({{ $total_machines }})
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="text">
                                            <p class="text-sm text-custom-enabled">
                                                <span class="text-dark">Total Activas</span>&nbsp;({{ $count_active }})<i class="lni lni-arrow-up"></i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="text">
                                            <p class="text-sm text-gray">
                                                <span class="text-dark">Total Inactivas</span>&nbsp;({{ $count_inactive }})<i class="lni lni-arrow-down"></i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                {{-- <li>
                                    <div class="d-flex">
                                        <div class="text">
                                            <p class="text-sm text-gray">
                                                <span class="text-dark">Total Apagadas</span>&nbsp;({{ $customer->count_dead }})<i class="lni lni-arrow-down"></i>
                                            </p>
                                        </div>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    @else
                        <div id="legend4">
                            <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                                <li>
                                    <div class="d-flex">
                                        <div class="text">
                                            <p class="text-sm text-active">
                                                <span class="text-dark">Sin información disponible, revise los datos de registro.</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endif
                  @endif

                  <div id="grid">
                    @foreach($machines as $machine)
                      @if ($machine->customer_id == $customer->id)
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
                            <p class="text-sm text-white" style="margin-top: 10px;">{{ Str::limit($machine->name, 3) }}</p>
                          </div>
                        </a> 
                      @endif
                    @endforeach
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="alert-box primary-alert" style="width: max-content;">
              <div class="alert">
                  <p class="text-medium">Sin datos encontrados con el nombre <b>{{ $search }}</b></p>
              </div>
            </div>
          @endif
        </div>
      <!-- end row -->
    </div>
  </div>
</section>
@endsection