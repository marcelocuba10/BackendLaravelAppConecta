@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Permisos</h2>
              @can('permission-create')
                <a href="{{ route('permissions.create') }}" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo Permiso</a>
              @endcan  
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-6">
            <div class="breadcrumb-wrapper mb-30">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                </ol>
              </nav>
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
                        <div class="dataTable-dropdown">
                            <label>
                                <select class="dataTable-selector">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select> entries per page
                            </label>
                        </div>
                    </div>
                    <div class="right">
                        <div class="table-search d-flex">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><h6>#</h6></th>
                        <th><h6>Name</h6></th>
                        <th><h6>Guard Name</h6></th>
                        <th><h6>Action</h6></th>
                      </tr>
                      <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td class="min-width"><p>{{ ++$i }}</p></td>
                            <td class="min-width"><p>{{ $permission->name }}</p></td>
                            <td class="min-width"><p>{{ $permission->guard_name }}</p></td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <div class="action">
                                        <a href="{{ route('permissions.show', $permission->id) }}">
                                            <button class="text-active">
                                                <i class="lni lni-eye"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @can('permission-edit')
                                    <div class="action">
                                        <a href="{{ route('permissions.edit', $permission->id) }}">
                                            <button class="text-info"><i class="lni lni-pencil"></i></button>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('permission-delete')
                                    <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}">
                                        @csrf
                                        <div class="action">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="text-danger"><i class="lni lni-trash-can"></i></button>
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
                  {{ $permissions->links() }} <!-- paginacion default -->
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