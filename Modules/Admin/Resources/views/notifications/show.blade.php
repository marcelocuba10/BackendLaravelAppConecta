@extends('admin::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Detalle del Aviso</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="/admin/notifications/">Notificaciones</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detalle Aviso</li>
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
                                <label>Título</label>
                                <input type="text" name="title" value="{{ $notification->title ?? old('title') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Fecha</label>
                                <input type="text" name="date" value="{{ $notification->date ?? old('date') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Mensaje</label>
                                <textarea rows="5" name="subject" readonly>{{ $notification->subject ?? old('subject') }}</textarea>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-groupd-flexjustify-content-centerflex-wrap">
                                    <a class="main-btn danger-btn-outline m-2" href="/admin/notifications">Atrás</a>
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
