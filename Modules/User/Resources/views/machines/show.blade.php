@extends('user::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Detalle Máquina</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                <a href="/user/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                <a href="{{ route('machines.index') }}">Máquinas</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Detalle Máquina</li>
                            </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========== title-wrapper end ========== -->
            <div class="form-layout-wrapper">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="card-style mb-30">
                      <form method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Nombre</label>
                                <input type="text" value="{{ $machine->name }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Estado</label>
                                <input type="text" value="{{ $machine->status }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Cliente</label>
                                <input type="text" value="{{ $machine->customer_name }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Observación</label>
                                <textarea type="text" value="{{ $machine->observation }}" readonly>{{ $machine->observation }}</textarea>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-groupd-flexjustify-content-centerflex-wrap">
                                    <a class="main-btn danger-btn-outline m-2" href="{{ route('machines.index') }}">Back</a>
                                </div>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
                  <!-- end col -->
                  <div class="col-lg-4">
                    <div class="card-style mb-30">
                      <div style="text-align: center">
                        {!! QrCode::size(300)->generate( $codeQR ) !!}           
                        <div class="input-style-1" style="margin-top: 30px">
                          <input style="text-align: center" type="text" name="codeQR" value="{{ $machine->codeQR }}" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Col -->
            </div>
        </div>
    </section>

@endsection  
