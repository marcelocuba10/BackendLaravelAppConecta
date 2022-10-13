@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Máquinas Local</h2>
              @can('machine-create')
                <a href="{{ route('machines.create') }}" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i></a>
              @endcan 
              <div class="off-mobile">
                <a style="margin-left: 17px;" href="/user/machines/grid_view" data-toggle="tooltip" data-placement="bottom" title="Vista modo cuadrícula"><i class="hthtg lni lni-grid-alt"></i></a>
                <a style="margin-left: 17px;" href="/user/machines/list"><i class="hthtg lni lni-list" data-toggle="tooltip" data-placement="bottom" title="Vista modo lista"></i></a>
                {{-- @if(count($machines) > 0)
                  <a style="margin-left: 17px;" href="{{route('machines.createPDF',['download'=>'pdf'])}}" target="_blank"><i class="hthtg lni lni-printer"></i></a>
                @endif --}}
                <a style="margin-left: 17px;" href="/user/machines/import-csv"><i class="hthtg lni lni-upload" data-toggle="tooltip" data-placement="bottom" title="Importar Datos CSV"></i></a>
                <a style="margin-left: 17px;" href="{{ url('/user/machines/export-csv') }}"><i class="hthtg lni lni-download" data-toggle="tooltip" data-placement="bottom" title="Exportar Datos CSV"></i></a>
              </div>

              <div class="on-mobile">
                <div class="button-group-m">
                  <a href="/user/machines/grid_view" title="Vista modo cuadricula">Vista Cuadrícula</a>
                  <a href="/user/machines/list" title="Vista modo lista" class="active">Vista Lista</a>
                </div>
              </div>
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-4">
            <div class="right">
              <div class="table-search d-flex st-input-search">
                <form action="{{ route('machines.search_filter_list') }}" method="POST">
                  @csrf
                  <input style="background-color: #fff;" type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Buscar..">
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

      <!-- ========== tables-wrapper start ========== -->
      <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
              <div class="card-style activity-card mb-30">
                <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                  <div class="left">
                    <div id="legend3">
                      <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                        <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-enabled"></span>
                            <div class="text">
                              {{-- <form action="/user/machines/filter_gridview" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Active" type="submit"><p class="text-sm text-dark">Work 100%</p></button>
                              </form>  --}}
                              <button class="btn-group-status" name="filter" value="Active" type="text"><p class="text-sm text-dark">Work 100%</p></button>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-disabled"></span>
                            <div class="text">
                              {{-- <form action="/user/machines/filter_gridview" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Inactive" type="submit"><p class="text-sm text-dark">Offline</p></button>
                              </form>  --}}
                              <button class="btn-group-status" name="filter" value="Inactive" type="text"><p class="text-sm text-dark">Offline</p></button>
                            </div>
                          </div>
                        </li>
                        {{-- <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-disabled"></span>
                            <div class="text">
                              <form action="/user/machines/filter_gridview" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Apagado" type="submit"><p class="text-sm text-dark">Apagado</p></button>
                              </form> 
                            </div>
                          </div>
                        </li> --}}
                        <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-attention"> </span>
                            <div class="text">
                              {{-- <form action="/user/machines/filter_gridview" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Requiere Atención" type="submit"><p class="text-sm text-dark">Work -10 to -40%</p></button>
                              </form>  --}}
                              <button class="btn-group-status" name="filter" value="Requiere Atención" type="text"><p class="text-sm text-dark">Work -10 to -40%</p></button>
                            </div>
                          </div>
                        </li>
                        {{-- <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-maintenance"></span>
                            <div class="text">
                              <form action="/user/machines/filter_gridview" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Mantenimiento" type="submit"><p class="text-sm text-dark">Mantenimiento</p></button>
                              </form> 
                            </div>
                          </div>
                        </li> --}}
                        <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-attention-2"> </span>
                            <div class="text">
                              {{-- <form action="/user/machines/filter_gridview" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Error" type="submit"><p class="text-sm text-dark">Work -50%</p></button>
                              </form>  --}}
                              <button class="btn-group-status" name="filter" value="Error" type="text"><p class="text-sm text-dark">Work -50%</p></button>
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
                            <form action="{{ route('machines.search_filter_list') }}" method="POST">
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
                <div class="table-wrapper table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><h6>#</h6></th>
                        <th><h6>Nombre</h6></th>
                        <th><h6>Estado</h6></th>
                        <th><h6>Cliente</h6></th>
                        <th><h6>Potencia</h6></th>
                        <th><h6>Standard Hashrate</h6></th>
                        <th><h6>Pool Hashrate</h6></th>
                        <th><h6>Acciones</h6></th>
                      </tr>
                      <!-- end table row-->
                    </thead>
                    <tbody>

                      @foreach($machines as $machine)
                        @foreach ($machines_api as $machines_api_item)
                            @if (strtolower($machines_api_item->worker) === strtolower($machine->name))
                              @php
                                $machineStatus = '';
                                $machineStatusTitle = '';

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
                                  $machineStatusTitle = 'Inactive';   
                                @endphp
                              @else
                                {{-- If machine working 100% or more, show card color green --}}
                                @if ($machines_api_item->last10m >= $machine->total_power || $machines_api_item->last10m >= $total_power_percent_ten)
                                  @php
                                    $machineStatus = "bg-card-enabled";   
                                    $machineStatusTitle = 'Active';      
                                  @endphp    
                                {{-- If machine working -50% or more, show card color orange --}}
                                @elseIf ($machines_api_item->last10m <= $total_power_percent_fifty && $machines_api_item->last10m > 0)
                                @php
                                  $machineStatus = "bg-card-attention-2"; 
                                  $machineStatusTitle = 'Requires Attention';          
                                @endphp
                                {{-- If machine working -10% and -40% or more, show card color yellow --}}   
                                @elseIf ($machines_api_item->last10m <= $total_power_percent_ten || $machines_api_item->last10m <= $total_power_percent_fourty && $machines_api_item->last10m > 0 && $machines_api_item->last10m >= $total_power_percent_fifty)
                                  @php
                                    $machineStatus = "bg-card-attention";   
                                    $machineStatusTitle = 'Requires Attention';     
                                  @endphp
                                {{-- If machine not working with result 0.00 or undefined, card color dark --}}       
                                @else
                                  @php
                                    $machineStatus = "bg-card-dark";   
                                    $machineStatusTitle = 'Inactive';
                                  @endphp 
                                @endif    
                              @endif
                              
                              <tr>
                                <td class="text-sm"><h6 class="text-sm">{{ ++$i }}</h6></td>
                                <td class="min-width"><h5 class="text-bold text-dark"><a href="/user/machines/{{ $machine->id }}/show">{{ $machine->name }}</a></h5></td>
                                <td class="min-width">
                                  <span class="status-btn {{ $machineStatus }}">
                                    {{ $machineStatusTitle }}
                                  </span>
                                </td>
                                <td class="min-width"><p>{{ $machine->customer_name }}</p></td>
                                <td class="min-width"><p>{{ $machine->mining_power }}</p></td>
                                <td class="min-width"><p style="color: #07a30e;font-weight: 500;">{{ $machine->total_power }}</p></td>
                                <td class="min-width"><p style="color: #4A6CF7;font-weight: 500;">{{ $machines_api_item->last10m }}</p></td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <div class="action">
                                          <a href="{{ route('machines.show', $machine->id) }}">
                                              <button class="text-active">
                                                  <i class="lni lni-eye"></i>
                                              </button>
                                          </a>
                                        </div>
                                        @can('machine-edit')
                                        <div class="action">
                                            <a href="{{ route('machines.edit', $machine->id) }}">
                                                <button class="text-info">
                                                    <i class="lni lni-pencil"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('machine-delete')
                                        <form method="POST" action="{{ route('machines.destroy', $machine->id) }}">
                                            @csrf
                                            <div class="action">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="text-danger">
                                                  <i class="lni lni-trash-can"></i>
                                                </button>
                                            </div>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                              </tr>
 
                            @endif
                        @endforeach
                      @endforeach



                        {{-- @foreach ($machines as $machine)
                          <tr>
                            <td class="text-sm"><h6 class="text-sm">#{{ ++$i }}</h6></td>
                            <td class="min-width"><h5 class="text-bold text-dark"><a href="/user/machines/{{ $machine->id }}/show">{{ $machine->name }}</a></h5></td>
                            <td class="min-width">
                              <span class="status-btn 
                              @if(strtolower($machine->status) == 'active') btn-custom-enabled
                              @elseIf($machine->status == 'Apagado') btn-custom-disabled
                              @elseIf($machine->status == 'Requiere Atención') btn-custom-attention
                              @elseIf($machine->status == 'Mantenimiento') btn-custom-maintenance
                              @elseIf($machine->status == 'Error') btn-custom-error
                              @elseIf(strtolower($machine->status) == 'inactive') btn-custom-offline
                              @endif">
                                {{ $machine->status }}
                              </span>
                            </td>
                            <td class="min-width"><p>{{ $machine->customer_name }}</p></td>
                            <td class="min-width"><p>{{ $machine->mining_power }}</p></td>
                            <td class="min-width"><p>{{ $machine->total_power }}</p></td>
                            <td class="min-width"><p>{{ $machine->total_power }}</p></td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <div class="action">
                                      <a href="{{ route('machines.show', $machine->id) }}">
                                          <button class="text-active">
                                              <i class="lni lni-eye"></i>
                                          </button>
                                      </a>
                                    </div>
                                    @can('machine-edit')
                                    <div class="action">
                                        <a href="{{ route('machines.edit', $machine->id) }}">
                                            <button class="text-info">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('machine-delete')
                                    <form method="POST" action="{{ route('machines.destroy', $machine->id) }}">
                                        @csrf
                                        <div class="action">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="text-danger">
                                              <i class="lni lni-trash-can"></i>
                                            </button>
                                        </div>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                          </tr>
                        @endforeach --}}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection