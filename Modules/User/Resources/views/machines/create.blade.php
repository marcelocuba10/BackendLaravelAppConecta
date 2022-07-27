@extends('user::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="titlemb-30">
                            <h2>Registrar Nueva Máquina</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                    <a href="/user/dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                    <a href="{{ route('machines.index_list') }}">Máquinas</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Nueva Máquina</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->
            <div class="form-layout-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="{{ route('machines.store') }}">
                            @include('user::machines._partials.form')
                        </form>
                    </div>
                </div>
            </div>
    </section>

@endsection  
