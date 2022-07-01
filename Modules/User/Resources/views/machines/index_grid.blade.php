@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
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
            <a href="{{route('machines.createPDF',['download'=>'pdf'])}}"><i style="margin-left: 23px;"class="hthtg lni lni-printer"></i></a>
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-4">
          <div class="breadcrumb-wrapper mb-30">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vista Cuadrícula</li>
              </ol>
            </nav>
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
                      <span class="bg-color info-bg"></span>
                      <div class="text">
                        <p class="text-sm text-dark">Encendido</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color dark-bg"></span>
                      <div class="text">
                        <p class="text-sm text-dark">Apagado</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color warning-bg"> </span>
                      <div class="text">
                        <p class="text-sm text-dark">Requiere Atención</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color primary-bg"></span>
                      <div class="text">
                        <p class="text-sm text-dark">Mantenimiento</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color danger-bg"> </span>
                      <div class="text">
                        <p class="text-sm text-dark">Error</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color gray-bg-custom"></span>
                      <div class="text">
                        <p class="text-sm text-dark">Deshabilitado</p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="right col-md-3">
              <div class="table-search d-flex" style="margin-top: -35px;">
                <form action="#">
                  <input type="text" placeholder="Buscar por cliente...">
                  <button><i class="lni lni-search-alt"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div id="grid">
            @foreach ($machines as $machine)
              <a href="{{ route('machines.edit', $machine->id) }}">
                <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $machine->name }}" 
                  class="
                  @if($machine->status == 'Encendido') success-bg 
                  @elseIf($machine->status == 'Apagado') dark-bg 
                  @elseIf($machine->status == 'Requiere Atención') warning-bg
                  @elseIf($machine->status == 'Mantenimiento') primary-bg
                  @elseIf($machine->status == 'Error') danger-bg
                  @elseIf($machine->status == 'Deshabilitado') gray-bg-custom 
                  @endif">
                  <p class="text-sm  text-white" style="margin-top: 10px;">{{ Str::limit($machine->name, 5) }}</p>
                </div>
              </a>  
            @endforeach
          </div>
        </div>
      </div>
      <!-- end row -->
    </div>
  </div>
</section>
@endsection