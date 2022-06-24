@extends('user::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                  <div class="col-md-6">
                    <div class="title mb-30">
                      <h2>Form Elements</h2>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                      <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="#0">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item"><a href="#0">Pages</a></li>
                          <li class="breadcrumb-item active" aria-current="page">
                            Clients
                          </li>
                        </ol>
                      </nav>
                    </div>
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->
              </div>
              <div class="form-layout-wrapper">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card-style mb-30">
                        {!! QrCode::size(300)->generate('Codigo ID registro maquina aqui') !!}
                    </div>
                    <!-- end card -->
                    <div class="card-style mb-30">
                      <h6 class="mb-15">Sign up Form</h6>
                      <p class="text-sm mb-25">
                        Start creating the best possible user experience for you
                        customers.
                      </p>
                      <form action="#">
                        <div class="row">
                          <div class="col-12">
                            <div class="input-style-1">
                              <label> Name</label>
                              <input type="text" placeholder="Name">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Email</label>
                              <input type="email" placeholder="Email">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Password</label>
                              <input type="password" placeholder="Password">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="form-check checkbox-style mb-30">
                              <input class="form-check-input" type="checkbox" value="" id="checkbox-not-robot">
                              <label class="form-check-label" for="checkbox-not-robot">
                                I am not a Robot</label>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="
                                button-group
                                d-flex
                                justify-content-center
                                flex-wrap
                              ">
                              <button class="
                                  main-btn
                                  primary-btn
                                  btn-hover
                                  w-100
                                  text-center
                                ">
                                Sign Up
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- end row -->
                      </form>
                    </div>
                    <!-- end card -->
                    <div class="card-style mb-30">
                      <h6 class="mb-25">Time and Date</h6>
                      <div class="input-style-1">
                        <label>Date</label>
                        <input type="date">
                      </div>
                      <!-- end input -->
                      <div class="input-style-2">
                        <input type="date">
                        <span class="icon"><i class="lni lni-chevron-down"></i></span>
                      </div>
                      <!-- end input -->
                      <div class="input-style-2">
                        <input type="time">
                      </div>
                      <!-- end input -->
                    </div>
                    <!-- end card -->
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->
              </div>
        </div>
    </section>
@endsection