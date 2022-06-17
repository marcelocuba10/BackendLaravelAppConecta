@extends('admin::tema.app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>My Account</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('users.show.profile', $user->id) }}">Profile</a>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="widget-head-color-box navy-bg p-lg text-center">
                <div class="m-b-md">
                    <h2 class="font-bold no-margins">
                        {{ $user->name }}
                    </h2>
                    <small>User ID: {{ $user->id}}</small>
                </div>
                <img src="http://webapplayers.com/inspinia_admin-v2.9.4/img/a4.jpg" class="rounded-circle circle-border m-b-md" alt="profile">
                <div>
                    <span>100 Tweets</span> |
                    <span>350 Following</span> |
                    <span>610 Followers</span>
                </div>
            </div>
            <div class="widget-text-box">
                <h4 class="media-heading">Alex Smith</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <div class="text-right">
                    <a href="" class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                    <a href="" class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Personal Information</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="get">
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Name</label>
                                <div class="col-lg-10"><p class="form-control-static">{{ $user->name }}</p></div>
                            </div>
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Username</label>
                                <div class="col-lg-10"><p class="form-control-static">{{ $user->username }}</p></div>
                            </div>
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Phone</label>
                                <div class="col-lg-10"><p class="form-control-static">+595 099494944</p></div>
                            </div>
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Email</label>
                                <div class="col-lg-10"><p class="form-control-static">{{ $user->email }}</p></div>
                            </div>
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Address</label>
                                <div class="col-lg-10"><p class="form-control-static">Av mensu 2342</p></div>
                            </div>
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Gender</label>
                                <div class="col-lg-10"><p class="form-control-static">male</p></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a href="{{ route('users.edit.profile', $user->id) }}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-pencil" aria-hidden="true"></i> Update Information</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection