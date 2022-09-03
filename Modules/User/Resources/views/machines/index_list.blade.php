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
                <a href="{{ route('machines.create') }}" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
              @endcan 
              <a style="margin-left: 17px;" href="/user/machines/grid_view"><i class="hthtg lni lni-grid-alt"></i></a>
              <a style="margin-left: 17px;" href="/user/machines/list"><i class="hthtg lni lni-list"></i></a>
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
                      <ul class="legend3 d-flex align-items-center mb-30">
                        <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-enabled"></span>
                            <div class="text">
                              <form action="{{ route('machines.search_filter_list') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="ACTIVE" type="submit"><p class="text-sm text-dark">Encendido</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-attention"> </span>
                            <div class="text">
                              <form action="{{ route('machines.search_filter_list') }}" method="POST">
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
                              <form action="{{ route('machines.search_filter_list') }}" method="POST">
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
                              <form action="{{ route('machines.search_filter_list') }}" method="POST">
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
                              <form action="{{ route('machines.search_filter_list') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="INACTIVE" type="submit"><p class="text-sm text-dark">Offline</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-disabled"></span>
                            <div class="text">
                              <form action="{{ route('machines.search_filter_list') }}" method="POST">
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
                        <th><h6>Hashrate</h6></th>
                        <th><h6>Acciones</h6></th>
                      </tr>
                      <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($machines as $machine)
                        <tr>
                            <td class="text-sm"><h6 class="text-sm">#{{ ++$i }}</h6></td>
                            <td class="min-width"><h5 class="text-bold text-dark"><a href="/user/machines/{{ $machine->id }}/show">{{ $machine->name }}</a></h5></td>
                            <td class="min-width">
                              <span class="status-btn 
                              @if($machine->status == 'ACTIVE') btn-custom-enabled
                              @elseIf($machine->status == 'Apagado') btn-custom-disabled
                              @elseIf($machine->status == 'Requiere Atención') btn-custom-attention
                              @elseIf($machine->status == 'Mantenimiento') btn-custom-maintenance
                              @elseIf($machine->status == 'Error') btn-custom-error
                              @elseIf($machine->status == 'INACTIVE') btn-custom-offline
                              @endif">
                                {{ $machine->status }}
                              </span>
                            </td>
                            <td class="min-width"><p>{{ $machine->customer_name }}</p></td>
                            <td class="min-width"><p>{{ $machine->mining_power }}</p></td>
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
                        @endforeach
                      <!-- end table row -->
                    </tbody>
                  </table>
                  <!-- end table -->
                  {{-- {{ $machines->links() }} <!-- paginacion default --> --}}

                  @if (isset($filter))
                  {{-- {{ $machines->appends(['sort' =>$filter])->links() }}  --}}
                  {{-- {!! $machines->appends(Request::except('page'))->render() !!} --}}
                    {!! $machines-> appends($filter)->links() !!} <!-- appends envia variable en la paginacion-->
                  @else
                    {!! $machines-> links() !!}    
                  @endif
                </div>
              </div>
              <!-- end card -->
            </div>
            <!-- end col -->
          </div>
        <!-- end row -->
      </div>
      <!-- ========== tables-wrapper end ========== -->
    </div>
    <!-- end container -->
  </section>

@endsection