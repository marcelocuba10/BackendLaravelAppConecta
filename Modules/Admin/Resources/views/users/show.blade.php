@extends('admin::tema.app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Detail User</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('users.index') }}">Users</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('users.show', $user->id) }}"><b>Detail User</b></a>
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
                            <input type="text" readonly name="name" class="form-control" autocomplete="off" value="{{ $user->name ?? old('name') }}">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">*UserName</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="username" class="form-control" autocomplete="off" value="{{ $user->username ?? old('username') }}">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">*Email</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="email" class="form-control" autocomplete="off" value="{{ $user->email ?? old('email') }}">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">*Role Assigned</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="role" class="form-control" autocomplete="off" value="{{ $userRole }}">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a class="btn btn-white btn-sm" href="{{ route('users.index') }}" >Back</a>  

                            <form style="display: inline-table;" method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection