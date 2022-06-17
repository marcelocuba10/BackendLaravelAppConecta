@extends('admin::tema.app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Detail Partner</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('partners.index') }}">Partners</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('partners.show', $partner->id) }}"><b>Detail Partner</b></a>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">*Name</label>
                        <div class="col-sm-10">
                            <input type="text"  readonly name="name" class="form-control" placeholder="Enter name" autocomplete="off" value="{{ $partner->name ?? old('name') }}">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">*UserName</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="username" class="form-control" placeholder="Enter username" autocomplete="off" value="{{ $partner->username ?? old('username') }}">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">*Email</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="email" class="form-control" placeholder="Enter email" autocomplete="off" value="{{ $partner->email ?? old('email') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a class="btn btn-white btn-sm" href="{{ route('partners.index') }}" >Back</a> 
                            @can('user-delete') 
                            <form style="display: inline-table;" method="POST" action="{{ route('partners.destroy', $partner->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                            @endcan
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection