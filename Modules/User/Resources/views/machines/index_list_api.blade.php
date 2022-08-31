@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Listado Máquinas Pool</h2>
              <a style="margin-left: 17px;" href="/user/machines/grid_view_api"><i class="hthtg lni lni-grid-alt"></i></a>
              <a style="margin-left: 17px;" href="/user/machines/list_api"><i class="hthtg lni lni-list"></i></a>
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-4">
            <div class="right">
              <div class="table-search d-flex" style="margin-top: -35px;float: right;">
                <form action="{{ route('machines.search_filter_list_api') }}" method="POST">
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
                              <form action="{{ route('machines.search_filter_list_api') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" id="filter" name="filter" value="active" type="submit"><p class="text-sm text-dark">Activo</p></button>
                              </form> 
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <span class="bg-color bg-card-offline"></span>
                            <div class="text">
                              <form action="{{ route('machines.search_filter_list_api') }}" method="POST">
                                @csrf
                                <button class="btn-group-status" id="filter" name="filter" value="inactive" type="submit"><p class="text-sm text-dark">Inactivo</p></button>
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
                            <form action="{{ route('machines.search_filter_list_api') }}" method="POST">
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
                        <th><h6>1Min Hashrate </h6></th>
                        <th><h6>10Min Hashrate</h6></th>
                        <th><h6>1h Hashrate</h6></th>
                        <th><h6>1d Hashrate</h6></th>
                      </tr>
                      <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($machines_api as $machine)
                        <tr>
                            <td class="text-sm"><h6 class="text-sm">#{{ ++$i }}</h6></td>
                            @if ($machine->customer_pool == "btc.com")
                              <td class="min-width"><h5 class="text-bold text-dark"><a href="/user/machines/{{ $machine->id }}/show_api">{{ $machine->worker_name }}</a></h5></td>
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
                            @endif
                            @if ($machine->customer_pool == "antpool.com")
                              <td class="min-width"><h5 class="text-bold text-dark"><a href="/user/machines/{{ $machine->id }}/show_api">{{ $machine->worker }}</a></h5></td>
                              <td class="min-width">
                                <p>No Disponible</p>
                              </td>
                            @endif
                            <td class="min-width"><p>{{ $machine->customer_name }}</p></td>
                            <td class="min-width"><p>{{ $machine->shares_1m }}</p></td>
                            <td class="min-width"><p>{{ $machine->last10m }}</p></td>
                            @if ($machine->customer_pool == "btc.com")
                              <td class="min-width"><p>{{ $machine->shares_1h }}</p></td>
                              <td class="min-width"><p>{{ $machine->shares_1d }}</p></td>
                            @endif
                            @if ($machine->customer_pool == "antpool.com")
                              <td class="min-width"><p>{{ $machine->last1h }}</p></td>
                              <td class="min-width"><p>{{ $machine->last1d }}</p></td>
                            @endif
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
                    {!! $machines_api-> appends($filter)->links() !!} <!-- appends envia variable en la paginacion-->
                  @else
                    {!! $machines_api-> links() !!}    
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