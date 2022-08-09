@extends('user::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Detalle Cliente</h2>
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
                                <a href="/user/customers">Clientes</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Detalle Cliente</li>
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
                                <input type="text" value="{{ $customer->name ?? old('name') }}" name="name" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Teléfono</label>
                                <input type="text" value="{{ $customer->phone ?? old('phone') }}" name="phone" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Dirección</label>
                                    <input type="text" value="{{ $customer->address ?? old('address') }}" name="address" readonly>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                  <label>Access Key</label>
                                  <input type="text" name="access_key" value="{{ $customer->access_key ?? old('access_key') }}" readonly>
                                </div>
                             </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                  <label>Puid</label>
                                  <input type="text" name="puid" value="{{ $customer->puid ?? old('puid') }}" readonly>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-groupd-flexjustify-content-centerflex-wrap">
                                    <a class="main-btn danger-btn-outline m-2" href="/user/customers">Back</a>
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
