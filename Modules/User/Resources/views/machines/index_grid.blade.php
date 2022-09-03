@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="title d-flex align-items-center flex-wrap mb-30">
            <h2 class="mr-40">Máquinas Local</h2>
            @can('machine-create')
            <a href="/user/machines/create" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
            @endcan
            <a style="margin-left: 17px;" href="/user/machines/grid_view" title="Vista modo cuadricula"><i class="hthtg lni lni-grid-alt"></i></a>
            <a style="margin-left: 17px;" href="/user/machines/list" title="Vista modo lista"><i class="hthtg lni lni-list"></i></a>
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
              <form action="/user/machines/search_gridview" method="POST">
                @csrf
                <input style="background-color: #fff;" id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar cliente..">
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
                        <form action="/user/machines/filter_gridview" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="active" type="submit"><p class="text-sm text-dark">Activo</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-attention"> </span>
                      <div class="text">
                        <form action="/user/machines/filter_gridview" method="POST">
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
                        <form action="/user/machines/filter_gridview" method="POST">
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
                        <form action="/user/machines/filter_gridview" method="POST">
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
                        <form action="/user/machines/filter_gridview" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="inactive" type="submit"><p class="text-sm text-dark">Inactivo</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-disabled"></span>
                      <div class="text">
                        <form action="/user/machines/filter_gridview" method="POST">
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
                      <form action="/user/machines/search_gridview" method="POST">
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

          @if(count($machines) > 0)
            @foreach($customers as $customer)
              <div class="card-style-3 mb-30">
                <div class="card-content">
                  <h4><a href="/user/customers/show/{{ $customer->id }}">Cliente: {{ $customer->name }}</a></h4>
                    <div id="grid">
                      @foreach($machines as $machine)
                        @if ( $machine->customer_id == $customer->id)
                          <a href="/user/machines/{{$machine->id}}/show">
                            <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $machine->name }}" 
                              class="
                              @if($machine->status == 'ACTIVE') bg-card-enabled 
                              @elseIf($machine->status == 'Apagado') bg-card-disabled
                              @elseIf($machine->status == 'Requiere Atención') bg-card-attention
                              @elseIf($machine->status == 'Mantenimiento') bg-card-maintenance
                              @elseIf($machine->status == 'Error') bg-card-error
                              @elseIf($machine->status == 'INACTIVE') bg-card-offline 
                              @endif">
                              <p class="text-sm  text-white" style="margin-top: 10px;">{{ Str::limit($machine->name, 3) }}</p>
                            </div>
                          </a> 
                        @endif
                      @endforeach
                    </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      <!-- end row -->
    </div>
  </div>
</section>
@endsection