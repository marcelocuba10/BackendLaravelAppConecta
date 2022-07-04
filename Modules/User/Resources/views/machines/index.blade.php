@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Listado de máquinas</h2>
              @can('machine-create')
                <a href="{{ route('machines.create') }}" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
              @endcan 
              <a href="/user/machines/grid_view"><i class="hthtg lni lni-grid-alt"></i></a>
              <a href="/user/machines"><i style="margin-left: 23px;" class="hthtg lni lni-list"></i></a>
              <a href="{{route('machines.createPDF',['download'=>'pdf'])}}"><i style="margin-left: 23px;" class="hthtg lni lni-printer"></i></a>
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-4">
            <div class="right">
              <div class="table-search d-flex" style="margin-top: -35px;float: right;">
                <form action="{{ route('machines.search_list') }}" method="POST">
                  @csrf
                  <input style="background-color: #fff;" type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Buscar por cliente...">
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
                            <span class="bg-color secondary-bg"></span>
                            <div class="text">
                              <form action="{{ route('machines.search_list') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Todos" type="submit"><p class="text-sm text-dark">Todos</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color info-bg"></span>
                            <div class="text">
                              <form action="{{ route('machines.search_list') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Encendido" type="submit"><p class="text-sm text-dark">Encendido</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color dark-bg"></span>
                            <div class="text">
                              <form action="{{ route('machines.search_list') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Apagado" type="submit"><p class="text-sm text-dark">Apagado</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color warning-bg"> </span>
                            <div class="text">
                              <form action="{{ route('machines.search_list') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Requiere Atención" type="submit"><p class="text-sm text-dark">Requiere Atención</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color primary-bg"></span>
                            <div class="text">
                              <form action="{{ route('machines.search_list') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Mantenimiento" type="submit"><p class="text-sm text-dark">Mantenimiento</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color danger-bg"> </span>
                            <div class="text">
                              <form action="{{ route('machines.search_list') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Error" type="submit"><p class="text-sm text-dark">Error</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color gray-bg-custom"></span>
                            <div class="text">
                              <form action="{{ route('machines.search_list') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" name="filter" value="Deshabilitado" type="submit"><p class="text-sm text-dark">Deshabilitado</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="right">
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
                        <th><h6>Funcionario</h6></th>
                        <th><h6>Observación</h6></th>
                        <th><h6>Acciones</h6></th>
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
                            <td class="min-width"><p>{{ $machine->customer_name }}</p></td>
                            <td class="min-width"><p>{{ $machine->user_name }}</p></td>
                            <td class="min-width"><p>{{ $machine->observation }}</p></td>
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