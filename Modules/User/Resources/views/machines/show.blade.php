@extends('user::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Detail Report</h2>
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
                                <a href="{{ route('reports.index') }}">Reportes</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Detail Report</li>
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
                                <label>First Name</label>
                                <input type="text" value="{{ $report->name ?? old('name') }}" name="name" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Last Name</label>
                                <input type="text" value="{{ $report->last_name ?? old('last_name') }}" name="last_name" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $report->email ?? old('email') }}" readonly>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Date</label>
                                <input type="text" name="date" value="{{ $report->date ?? old('date') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Hora de entrada</label>
                                <input type="text" name="check_in_time" value="{{ $report->check_in_time ?? old('check_in_time') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Hora de salida</label>
                                <input type="text" name="check_out_time" value="{{ $report->check_out_time ?? old('check_out_time') }}"readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-groupd-flexjustify-content-centerflex-wrap">
                                    <a class="main-btn danger-btn-outline m-2" href="{{ route('reports.index') }}">Back</a>
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
