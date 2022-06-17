@extends('user::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Detail Funcionario</h2>
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
                                <a href="{{ route('users.index') }}">Funcionarios</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail Funcionario
                                </li>
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
                                <label>(*) First Name</label>
                                <input type="text" value="{{ $user->name ?? old('name') }}" name="name" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>(*) Last Name</label>
                                <input type="text" value="{{ $user->last_name ?? old('last_name') }}" name="last_name" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                    <label>(*) Email</label>
                                    <input type="email" readonly value="{{ $user->email ?? old('email') }}" name="email">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ $user->phone ?? old('phone') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                              <div class="input-style-1">
                                <label>Address</label>
                                <input type="text" name="address" value="{{ $user->address ?? old('address') }}" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                              <div class="input-style-1">
                                <label>Cedula Identidad</label>
                                <input type="text" name="ci" value="{{ $user->ci ?? old('ci') }}"readonly>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="input-style-1">
                                <label>Birthday</label>
                                <input type="text" id="date" name="birthday" value="{{ $user->birthday ?? old('birthday') }}" placeholder="DD/MM/YYYY" readonly>
                              </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-groupd-flexjustify-content-centerflex-wrap">
                                    @can('user-delete') 
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="main-btn primary-btn btn-hover m-2">
                                          Delete user
                                        </button>
                                    </form>
                                    @endcan
                                    <a class="main-btn danger-btn-outline m-2" href="{{ route('users.index') }}" >Back</a>
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
