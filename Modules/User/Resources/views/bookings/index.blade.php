@extends('user::tema.app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Lista de Reservas</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/user/dashboard">Inicio</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="/user/bookings">Reservas</a>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <a href="/user/bookings/create/" class="btn btn-primary btn-xs btn_list_options"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Reserva</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="html5buttons">
                                <div class="dt-buttons btn-group flex-wrap"> <button
                                        class="btn btn-white btn-sm buttons-copy buttons-html5" tabindex="0"
                                        aria-controls="DataTables_Table_0" type="button"><span>Copy</span></button>
                                    <button class="btn btn-white btn-sm buttons-csv buttons-html5" tabindex="0"
                                        aria-controls="DataTables_Table_0" type="button"><span>CSV</span></button>
                                    <button class="btn btn-white btn-sm buttons-excel buttons-html5" tabindex="0"
                                        aria-controls="DataTables_Table_0" type="button"><span>Excel</span></button>
                                    <button class="btn btn-white btn-sm buttons-pdf buttons-html5" tabindex="0"
                                        aria-controls="DataTables_Table_0" type="button"><span>PDF</span></button>
                                    <button class="btn btn-white btn-sm buttons-print" tabindex="0"
                                        aria-controls="DataTables_Table_0" type="button"><span>Print</span></button>
                                </div>
                            </div>
                            
                            <div class="dataTables_length" id="DataTables_Table_0_length">
                                <label>Show 
                                    <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries
                                </label>
                            </div>

                            <!-- Filtro de busqueda -->

                            <form action="#" method="POST">
                                @csrf
                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label>Search: 
                                        <input type="search" name="filter" class="form-control form-control-sm" value="#" aria-controls="DataTables_Table_0">
                                    </label>
                                    <button class="btn btn-success btn-xs btn_list_options" type="submit" style="margin-top: -5px">Filtrar</button>
                                </div>
                            </form>

                            <table class="table table-striped table-bordered table-hover dataTable"
                                id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" aria-label="Name: activate to sort column ascending"
                                            style="width: 299px;">Cod Cancha</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" aria-label="Name: activate to sort column ascending"
                                            style="width: 299px;">Agendamiento</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" aria-label="Description: activate to sort column ascending"
                                            style="width: 207px;">Estado</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                            colspan="1" aria-label="Description: activate to sort column ascending"
                                            style="width: 207px;">Total</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1"
                                        style="width: 150px;">Acciones</th>    
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($bookings as $booking)
                                    <tr class="gradeA odd" role="row">
                                        <td>{{ $booking->ground_id }}</td>
                                        <td>{{ $booking->appointment }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>{{ number_format((double)$booking->total, 3, '.', ''); }} GS</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-secondary btn-xs btn_list_options">
                                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-success btn-xs btn_list_options">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary btn-xs btn_list_options">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <form method="POST" action="{{ route('bookings.destroy',$booking->id) }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-danger btn-xs btn_list_options show_confirm" data-toggle="tooltip" title='Eliminar'><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $bookings->links() }} <!-- paginacion default -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection