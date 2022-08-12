@extends('admin::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Detalle de Facturación</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item" aria-current="page"><a href="/admin/financial/">Financiero</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detalle Facturación</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========== title-wrapper end ========== -->
            <div class="form-layout-wrapper">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card-style mb-30">
                      <form method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Nombre</label>
                                <input type="text" name="user_id" value="{{ $finance->user_id ?? old('user_id') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                  <label>Nombre</label>
                                  <input type="text" name="plan_id" value="{{ $finance->plan_id ?? old('plan_id') }}" readonly>
                                </div>
                              </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                  <label>Fecha de Facturación</label>
                                  <input type="text" name="exp_date_plan" value="{{ $finance->exp_date_plan ?? old('exp_date_plan') }}" readonly>
                                </div>
                              </div>
                              <!-- end col -->
                            <div class="col-12">
                                <div class="button-groupd-flexjustify-content-centerflex-wrap">
                                    <a class="main-btn danger-btn-outline m-2" href="/admin/financial">Atrás</a>
                                </div>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection  
