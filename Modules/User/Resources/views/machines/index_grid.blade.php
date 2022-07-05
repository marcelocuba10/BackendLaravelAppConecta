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
          <div class="right">
            <div class="table-search d-flex" style="margin-top: -35px;float: right;">
              <form action="{{ route('machines.search_gridview') }}" method="POST">
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
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Encendido" type="submit"><p class="text-sm text-dark">Encendido</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-attention"> </span>
                      <div class="text">
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
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
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
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
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
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
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Deshabilitado" type="submit"><p class="text-sm text-dark">Deshabilitado</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-disabled"></span>
                      <div class="text">
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
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
              @if ($filter != 'Todos' && $filter != null)
              <ul class="legend3 d-flex align-items-center mb-30">
                <li>
                  <div class="d-flex">
                    <div class="text">
                      <form action="{{ route('machines.search_gridview') }}" method="POST">
                        @csrf
                        <button class="btn-group-status" name="filter" value="Todos" type="submit"><p class="text-sm text-dark"><i class="lni lni-close"></i>&nbsp; Quitar Filtros</p></button>
                      </form> 
                    </div>
                  </div>
                </li>
              </ul>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div id="grid">
            @foreach ($machines as $machine)
              <a href="{{ route('machines.edit', $machine->id) }}">
                <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $machine->name }}" 
                  class="
                  @if($machine->status == 'Encendido') bg-card-enabled 
                  @elseIf($machine->status == 'Apagado') bg-card-disabled
                  @elseIf($machine->status == 'Requiere Atención') bg-card-attention
                  @elseIf($machine->status == 'Mantenimiento') bg-card-maintenance
                  @elseIf($machine->status == 'Error') bg-card-error
                  @elseIf($machine->status == 'Deshabilitado') bg-card-offline 
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