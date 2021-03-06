@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Listado de Clientes</h2>
              @can('customer-create')
                <a href="{{ route('customers.create') }}" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
              @endcan  
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-4">
            <div class="right">
              <div class="table-search d-flex" style="margin-top: -35px;float: right;">
                <form action="#" id="search-form">
                  @csrf
                  <input style="background-color: #fff;" class="search" id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar cliente..">

                  <div id="results" style="z-index: 2;position: absolute;background-color: #fff;height: 300px;overflow: auto;">
                  </div>

                </form>  
              </div>
            </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>

      <!-- ========== title-wrapper end ========== -->

      <!-- ========== tables-wrapper start ========== -->
      <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
              <div class="card-style mb-30">
                <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
              <div class="left">
                {{-- <div class="dataTable-dropdown">
                  <label>
                      <select class="dataTable-selector">
                          <option value="5">5</option>
                          <option value="10" selected="">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="25">25</option>
                      </select> entries per page
                  </label>
                </div> --}}
              </div>
              <div class="right">
              </div>
            </div>
                <div class="table-wrapper table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><h6>#</h6></th>
                        <th><h6>Nombre</h6></th>
                        <th><h6>Tel??fono</h6></th>
                        <th><h6>M??quinas</h6></th>
                        <th><h6>Direcci??n</h6></th>
                        <th><h6>Acciones</h6></th>
                      </tr>
                      <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td class="min-width"><p>{{ ++$i }}</p></td>
                            <td class="min-width"><p>{{ $customer->name }}</p></td>
                            <td class="min-width"><p>{{ $customer->phone }}</p></td>
                            <td class="min-width"><p>{{ $customer->total_machines }}</p></td>
                            <td class="min-width"><p>{{ $customer->address }}</p></td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <div class="action">
                                      <a href="{{ route('customers.show', $customer->id) }}">
                                          <button class="text-active">
                                              <i class="lni lni-eye"></i>
                                          </button>
                                      </a>
                                    </div>
                                    @can('customer-edit')
                                    <div class="action">
                                        <a href="{{ route('customers.edit', $customer->id) }}">
                                            <button class="text-info">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('customer-delete')
                                    <form method="POST" action="{{ route('customers.destroy', $customer->id) }}">
                                        @csrf
                                        <div class="action">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="text-danger">
                                              <i class="lni lni-trash-can"></i>
                                            </button>
                                        </div>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      <!-- end table row -->
                    </tbody>
                  </table>
                  <!-- end table -->
                  {{ $customers->links() }} <!-- paginacion default -->
                </div>
              </div>
              <!-- end card -->
            </div>
            <!-- end col -->
          </div>
        <!-- end row -->
      </div>
      <!-- ========== tables-wrapper end ========== -->
    </div>
    <!-- end container -->
  </section>

  <script>
    $(function ()
    {
        'use strict';
        $(document).on('keyup', '#search-form .search', function ()
        {
            if($(this).val().length > 0)
            {
                var search = $(this).val();
                $.get("{{ route('posts.search') }}", {search: search}, function (data)
                {
                    $('#results').html(data);
                });
                return;
            }
            $('#results').empty();
        });
  
        $(document).on('click', '.post-link', function ()
        {
            var postId = $(this).data('id');
            //alert(postId);
            $.get("{{ url('user/posts/show') }}", {id: postId}, function (res)
            {
                $('#results').empty();
                $('.search').val('');
                $('#post').html(res);
            });
        });
    });
  </script>

@endsection