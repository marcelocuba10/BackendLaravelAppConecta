@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Listado de máquinas</h2>
              @can('machine-create')
                <a href="{{ route('machines.create') }}" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
              @endcan 
              <a href="#"><i class="hthtg lni lni-grid-alt"></i></a>
              <a href="#"><i style="margin-left: 23px;" class="hthtg lni lni-list"></i></a>
              <a href="{{route('machines.createPDF',['download'=>'pdf'])}}"><i style="margin-left: 23px;" class="hthtg lni lni-printer"></i></a>
              <div class="select-style-1" style="margin-left: 23px;">
                <label>View metric</label>
                <div class="select-position">
                  <select>
                    <option value="">Status</option>
                    <option value="">Encendido</option>
                    <option value="">Apagado</option>
                    <option value="">Mantenimiento</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-6">
            <div class="breadcrumb-wrapper mb-30">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Listado</li>
                </ol>
              </nav>
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
              <div class="card-style mb-30">
                <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
              <div class="left">
                <div class="dataTable-dropdown">
                  <label>
                      <select class="dataTable-selector">
                          <option value="5">5</option>
                          <option value="10" selected="">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="25">25</option>
                      </select> entries per page
                  </label>
              </div>
              </div>
              <div class="right">
                <div class="table-search d-flex">
                  <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="lni lni-search-alt"></i></button>
                  </form>
                </div>
              </div>
            </div>
                <div class="table-wrapper table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><h6>#</h6></th>
                        <th><h6>Nombre</h6></th>
                        <th><h6>Estado</h6></th>
                        <th><h6>CódigoQR</h6></th>
                        <th><h6>CódigoQR</h6></th>
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
                            <td class="min-width"><p>{{ $machine->name }}</p></td>
                            <td class="min-width">
                              <span class="status-btn @if($machine->status == 'Encendido') success-btn @elseIf($machine->status == 'Apagado') close-btn @elseIf($machine->status == 'Mantenimiento') warning-btn @endif">{{ $machine->status }}</span>
                            </td>
                            <td class="min-width"><p>{{ $machine->codeQR }}</p></td>
                            <td class="min-width"><p>{!! QrCode::size(50)->generate( $machine->codeQR ) !!}</p></td>
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
                  {{ $machines->links() }} <!-- paginacion default -->
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