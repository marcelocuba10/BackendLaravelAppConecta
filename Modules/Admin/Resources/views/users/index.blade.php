@extends('admin::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Usuarios</h2>
              @can('user-sa-create')
                <a href="/admin/users/create" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
              @endcan  
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-4">
            <div class="right">
              <div class="table-search d-flex" style="margin-top: -35px;float: right;">
                <form action="/admin/users/search">
                  <input style="background-color: #fff;" id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar usuario..">
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
                      </select> items por pgina
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
                        <th class="sm"><h6 class="text-sm text-medium"></h6></th>
                        <th class="md"><h6>Nombre</h6></th>
                        <th class="md"><h6>Apellidos</h6></th>
                        <th class="md"><h6>Teléfono</h6></th>
                        <th class="md"><h6>Email</h6></th>
                        <th class="md"><h6>Acciones</h6></th>
                      </tr>
                      <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="min-width"><h6 class="text-sm">#{{ ++$i }}</h6></td>
                            <td class="min-width"><p>{{ $user->name }}</p></td>
                            <td class="min-width"><p>{{ $user->last_name }}</p></td>
                            <td class="min-width"><p><i class="lni lni-phone mr-10"></i>{{ $user->phone }}</p></td>
                            <td class="min-width"><p><i class="lni lni-envelope mr-10"></i>{{ $user->email }}</p></td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <div class="action">
                                        <a href="/admin/users/show/{{$user->id}}">
                                            <button class="text-active">
                                                <i class="lni lni-eye"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @can('user-sa-edit')
                                    @if ($currentUserId != $user->id)
                                      <div class="action">
                                          <a href="/admin/users/edit/{{$user->id}}">
                                              <button class="text-info">
                                                  <i class="lni lni-pencil"></i>
                                              </button>
                                          </a>
                                      </div>
                                    @endif  
                                    @endcan
                                    {{-- @can('user-sa-delete')
                                    <form method="POST" action="/admin/users/delete/{{$user->id}}">
                                        @csrf
                                        <div class="action">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="text-danger">
                                              <i class="lni lni-trash-can"></i>
                                            </button>
                                        </div>
                                    </form>
                                    @endcan --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      <!-- end table row -->
                    </tbody>
                  </table>
                  <!-- end table -->
                  @if (isset($search))
                    {!! $users-> appends($search)->links() !!} <!-- appends envia variable en la paginacion-->
                  @else
                    {!! $users-> links() !!}    
                  @endif
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

@endsection