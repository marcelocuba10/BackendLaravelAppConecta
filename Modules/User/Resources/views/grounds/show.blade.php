@extends('tema.app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Detail Order</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('orders.index') }}">Orders</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('orders.show', $order->id) }}"><b>Detail Order</b></a>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="title" class="form-control" placeholder="Enter title" autocomplete="off" value="{{ $order->title ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="description" class="form-control" placeholder="Enter description" autocomplete="off" value="{{ $order->description ?? '' }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a class="btn btn-white btn-sm" href="{{ route('orders.index') }}" >Cancel</a>  

                            <form style="display: inline-table;" method="POST" action="{{ route('orders.delete', $order->id) }}">
                                @csrf
                                <!-- en mi route utilizo Route::delete(); -->
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