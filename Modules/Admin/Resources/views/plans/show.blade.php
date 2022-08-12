@extends('admin::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Detalle del Plan</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item" aria-current="page"><a href="/admin/plans/">Plan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detalle Plan</li>
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
                                <input type="text" name="name" value="{{ $plan->name ?? old('name') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Precio</label>
                                <input type="text" name="price" value="{{ number_format($plan->price, 0) }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-groupd-flexjustify-content-centerflex-wrap">
                                    <a class="main-btn danger-btn-outline m-2" href="/admin/plans">Atrás</a>
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
