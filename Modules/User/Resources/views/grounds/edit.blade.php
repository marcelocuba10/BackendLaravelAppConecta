@extends('user::tema.app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Editar Cancha</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('grounds.index') }}">Canchas</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('grounds.edit', $ground->id) }}"><b>Editar Cancha</b></a>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <form method="POST" action="{{ route('grounds.update', $ground->id) }}">
                        @csrf
                        @method('PUT') <!-- menciono el metodo PUT, ya que en mi route utilzo Route::put(); -->
                        @include('user::grounds._partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection