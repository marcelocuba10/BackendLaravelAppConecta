@extends('admin::tema.app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit {{ $title }}</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('permissions.index') }}">{{ $title }}s</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('permissions.edit', $permission->id) }}"><b>Edit {{ $title }}</b></a>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PUT') <!-- menciono el metodo PUT, ya que en mi route utilzo Route::put(); -->
                        @include('admin::admin.permissions._partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection