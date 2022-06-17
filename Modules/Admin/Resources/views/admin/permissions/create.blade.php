@extends('admin::tema.app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Create new permission</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('permissions.index') }}">Permissions</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('permissions.create') }}"><b>New Permission</b></a>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <form method="POST" action="{{ route('permissions.store') }}">
                        @include('admin::admin.permissions._partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection