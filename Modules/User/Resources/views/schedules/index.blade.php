@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Listado de presencia laboral</h2>
              @can('schedule-create')
                <a href="{{ route('schedules.create') }}" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
              @endcan  
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-4">
            <div class="right">
              <div class="table-search d-flex" style="margin-top: -35px;float: right;">
                <form action="/user/schedules/search">
                  <input style="background-color: #fff;" id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar funcionario..">
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
              <div class="card-style mb-30">
                <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
              <div class="left">
                {{-- <div class="dataTable-dropdown">
                  <label>
                      <select class="dataTable-selector">
                          <option value="5">5</option>
                          <option value="10" selected="">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="25">25</option>
                      </select> entries per page
                  </label>
                </div> --}}
              </div>
              <div class="right">
              </div>
            </div>
                <div class="table-wrapper table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="sm"><h6></h6></th>
                        <th class="lg"><h6>Nombre</h6></th>
                        <th class="md"><h6>Fecha</h6></th>
                        <th class="md"><h6>Horario Entrada</h6></th>
                        <th class="md"><h6>Horario Salida</h6></th>
                        <th class="md"><h6>Acciones</h6></th>
                      </tr>
                      <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                        <tr>
                            <td class="min-width"><h6 class="text-sm">#{{ ++$i }}</h6></td>
                            <td class="min-width"><p>{{ $schedule->name }}</p></td>
                            <td class="min-width"><p><i class="lni lni-calendar mr-10"></i>{{ $schedule->date }}</p></td>
                            <td class="min-width">
                              <a target="_blank" href="https://maps.google.com/?q={{ $schedule->address_latitude_in }},{{ $schedule->address_longitude_in }}&ll={{ $schedule->address_latitude_in }},{{ $schedule->address_longitude_in }}&z=17">
                                <span class="status-btn success-btn">
                                  <i class="lni lni-move"></i> {{ $schedule->check_in_time }}
                                </span>
                              </a>
                            </td>
                            @if ($schedule->check_out_time)
                            <td class="min-width">
                              <a target="_blank" href="https://maps.google.com/?q={{ $schedule->address_latitude_out }},{{ $schedule->address_longitude_out }}&ll={{ $schedule->address_latitude_out }},{{ $schedule->address_longitude_out }}&z=17">
                                <span class="status-btn secondary-btn">
                                  <i class="lni lni-move"></i> {{ $schedule->check_out_time }}
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
                                      <a href="{{ route('schedules.show', $schedule->id) }}">
                                          <button class="text-active">
                                              <i class="lni lni-eye"></i>
                                          </button>
                                      </a>
                                    </div>
                                    @can('schedule-delete')
                                    <form method="POST" action="{{ route('schedules.destroy', $schedule->id) }}">
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
                  @if (isset($search))
                    {!! $schedules-> appends($search)->links() !!} <!-- appends envia variable en la paginacion-->
                  @else
                    {!! $schedules-> links() !!}    
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