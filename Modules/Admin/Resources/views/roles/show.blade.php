@extends('admin::layouts.adminLTE.app')
@section('content')

<section class="section">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="titlemb-30">
                        <h2>Detalle del Rol</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="/admin/ACL/roles">Roles</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detalle del Rol</li>
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
                                <div class="col-4">
                                    <div class="input-style-1">
                                        <label>Nombre</label>
                                        <input type="text" value="{{ $role->name }}" readonly>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div class="input-style-1">
                                      <label>Rol de Sistema</label>
                                      @foreach ($keys as $key)
                                        @if ($key[0] == $role->system_role)
                                          <input type="text" value="{{ $key[1] ?? old('system_role') }}" readonly >
                                        @endif
                                      @endforeach 
                                    </div>
                                  </div>
                                  <!-- end col -->
                                <div class="col-4">
                                    <div class="input-style-1">
                                        <label>Guard</label>
                                        <input type="text" value="{{ $role->guard_name }}" readonly>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>(*) Permisos</label>
                                    </div>
                                    @foreach ($rolePermission as $permission )
                                        <div class="form-check checkbox-style checkbox-success mb-20">
                                            <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $permission}}" checked onclick="return false;">
                                            <label class="form-check-label" for="checkbox-1">{{ $permission }} </label>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="button-groupd-flexjustify-content-centerflex-wrap">
                                        <a class="main-btn danger-btn-outline m-2" href="/admin/ACL/roles">Atrás</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</section>

@endsection  
