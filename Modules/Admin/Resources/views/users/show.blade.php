@extends('admin::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Detalle Usuario</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="/admin/users">Usuarios</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detalle Usuario</li>
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
                                <input type="text" value="{{ $user->name ?? old('name') }}" name="name" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Apellidos</label>
                                <input type="text" value="{{ $user->last_name ?? old('last_name') }}" name="last_name" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                    <label>Email</label>
                                    <input type="email" readonly value="{{ $user->email ?? old('email') }}" name="email">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Teléfono</label>
                                <input type="text" name="phone" id="phone" value="{{ $user->phone ?? old('phone') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Rol Asignado</label>
                                <input type="text" name="userRole" value="{{ $userRole ?? old('userRole') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Doc Identidad</label>
                                <input type="text" name="ci" value="{{ $user->ci ?? old('ci') }}"readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                              <div class="input-style-1">
                                <label>Dirección</label>
                                <input type="text" name="address" value="{{ $user->address ?? old('address') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-groupd-flexjustify-content-centerflex-wrap">
                                    <a class="main-btn danger-btn-outline m-2" href="/admin/users">Atrás</a>
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
