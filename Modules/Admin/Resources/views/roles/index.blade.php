@extends('admin::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Roles</h2>
              @can('role-sa-create')
                <a href="/admin/ACL/roles/create" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
              @endcan  
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-4">
            <div class="right">
              <div class="table-search d-flex" style="margin-top: -35px;float: right;">
                <form action="/admin/ACL/roles/search">
                  <input style="background-color: #fff;" id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar Rol..">
                  <button type="submit"><i class="lni lni-search-alt"></i></button>
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
                        <th><h6>Cliente</h6></th>
                        <th><h6>IdReferencia</h6></th>
                        <th><h6>Guard</h6></th>
                        <th><h6>Acciones</h6></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td class="min-width"><h6 class="text-sm">#{{ ++$i }}</h6></td>
                            <td class="min-width"><p>{{ $role->name }}</p></td>
                            @if ($role->customer_name == null)
                              <td class="min-width"><p>Sistema</p></td>
                            @else
                              <td class="min-width"><p>{{ $role->customer_name }}</p></td>
                            @endif
                            @if (strlen($role->customer_idReference) == 6)
                              <td class="min-width"><p>{{ $role->customer_idReference }}</p></td>
                            @else
                              <td class="min-width"><p>Sistema</p></td>
                            @endif
                            <td class="min-width"><p>{{ $role->guard_name }}</p></td>

                            <td class="text-right">
                                <div class="btn-group">
                                    <div class="action">
                                      <a href="/admin/ACL/roles/show/{{$role->id}}">
                                          <button class="text-active">
                                              <i class="lni lni-eye"></i>
                                          </button>
                                      </a>
                                    </div>
                                    @can('role-sa-edit')
                                    <div class="action">
                                        <a href="/admin/ACL/roles/edit/{{$role->id}}">
                                            <!--show icon edit only if not default role system and if not is a super user -->
                                            @if ($guard_name == 'admin')
                                              <button class="text-info">
                                                  <i class="lni lni-pencil"></i>
                                              </button>
                                            @endif  
                                        </a>
                                    </div>
                                    @endcan
                                    @can('role-sa-delete')
                                    <form method="POST" action="/admin/ACL/roles/delete/{{$role->id}}">
                                        @csrf
                                        <div class="action">
                                            <input name="_method" type="hidden" value="DELETE">
                                            @if (!$role->system_role)
                                              <button type="submit" class="text-danger">
                                                <i class="lni lni-trash-can"></i>
                                              </button>
                                            @endif
                                        </div>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  <!-- end table -->
                  @if (isset($search))
                    {!! $roles-> appends($search)->links() !!} <!-- appends envia variable en la paginacion-->
                  @else
                    {!! $roles-> links() !!}    
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