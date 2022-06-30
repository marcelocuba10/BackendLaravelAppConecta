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
              <a href="{{ route('machines.create') }}" class="main-btn success-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
            @endcan 
            <a href="/user/machines/grid_view"><i class="hthtg lni lni-grid-alt"></i></a>
            <a href="/user/machines"><i style="margin-left: 23px;" class="hthtg lni lni-list"></i></a>
            <a href="{{route('machines.createPDF',['download'=>'pdf'])}}"><i style="margin-left: 23px;" class="hthtg lni lni-printer"></i></a>
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
                <span class="bg-color danger-bg"></span>
                <div class="text">
                  <p class="text-sm text-dark">Apagado</p>
                </div>
              </div>
            </li>
            <li>
              <div class="d-flex">
                <span class="bg-color primary-bg"> </span>
                <div class="text">
                  <p class="text-sm text-dark">Actualizando</p>
                </div>
              </div>
            </li>
            <li>
              <div class="d-flex">
                <span class="bg-color warning-bg"></span>
                <div class="text">
                  <p class="text-sm text-dark">Mantenimiento</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="row">
          @foreach ($machines as $machine)
          <div class="col-xl-1 col-lg-1 col-sm-1">
            <a href="{{ route('machines.edit', $machine->id) }}">
              <div class="icon-card-grid mb-30  @if($machine->status == 'Encendido') info-bg @elseIf($machine->status == 'Apagado') danger-bg @elseIf($machine->status == 'Mantenimiento') warning-bg @endif">
                <p class="text-sm  text-white">
                  {{ $machine->name }}
                </p>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      <!-- end row -->
    </div>
  </div>
</section>
@endsection