@extends('admin::tema.app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Create new Partner</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('partners.index') }}">Partners</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('partners.create') }}"><b>New Partner</b></a>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <form method="POST" action="{{ route('partners.store') }}">
                        @include('admin::partners._partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection