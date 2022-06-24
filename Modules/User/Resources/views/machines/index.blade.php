@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Listado de presencia laboral</h2>
              @can('report-create')
                <a href="{{ route('reports.create') }}" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
              @endcan  
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
                        <th><h6>Apellidos</h6></th>
                        <th><h6>Email</h6></th>
                        <th><h6>Phone</h6></th>
                        <th><h6>Fecha</h6></th>
                        <th><h6>Horario Entrada</h6></th>
                        <th><h6>Horario Salida</h6></th>
                        <th><h6>Acciones</h6></th>
                      </tr>
                      <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        <tr>
                            <td class="min-width"><p>{{ ++$i }}</p></td>
                            <td class="min-width"><p>{{ $report->name }}</p></td>
                            <td class="min-width"><p>{{ $report->last_name }}</p></td>
                            <td class="min-width"><p>{{ $report->email }}</p></td>
                            <td class="min-width"><p>{{ $report->phone }}</p></td>
                            <td class="min-width"><p>{{ $report->date }}</p></td>
                            <td class="min-width">
                              <a target="_blank" href="https://maps.google.com/?q={{ $report->address_latitude_in }},{{ $report->address_longitude_in }}&ll={{ $report->address_latitude_in }},{{ $report->address_longitude_in }}&z=17">
                                <span class="status-btn success-btn">
                                  <i class="lni lni-move"></i> {{ $report->check_in_time }}
                                </span>
                              </a>
                            </td>
                            @if ($report->check_out_time)
                            <td class="min-width">
                              <a target="_blank" href="https://maps.google.com/?q={{ $report->address_latitude_out }},{{ $report->address_longitude_out }}&ll={{ $report->address_latitude_out }},{{ $report->address_longitude_out }}&z=17">
                                <span class="status-btn secondary-btn">
                                  <i class="lni lni-move"></i> {{ $report->check_out_time }}
                                </span>
                              </a>
                            </td>
                            @else
                            <td class="min-width">
                                <span class="status-btn warning-btn">
                                  <i class="lni lni-alarm-clock"></i> Pendiente
                                </span>
                            </td>
                            @endif
                            <td class="text-right">
                                <div class="btn-group">
                                    <div class="action">
                                      <a href="{{ route('reports.show', $report->id) }}">
                                          <button class="text-active">
                                              <i class="lni lni-eye"></i>
                                          </button>
                                      </a>
                                    </div>
                                    @can('report-edit')
                                    <div class="action">
                                        <a href="{{ route('reports.edit', $report->id) }}">
                                            <button class="text-info">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('report-delete')
                                    <form method="POST" action="{{ route('reports.destroy', $report->id) }}">
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
                  {{ $reports->links() }} <!-- paginacion default -->
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