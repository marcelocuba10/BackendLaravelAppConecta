@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Permisos</h2>
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-4">
            <div class="right">
              <div class="table-search d-flex st-input-search">
                <form action="/user/ACL/permissions/search">
                  <input style="background-color: #fff;" id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar Permiso..">
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
                        <th><h6>Guard</h6></th>
                        <th><h6>Acciones</h6></th>
                      </tr>
                      <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td class="text-sm"><h6 class="text-sm">#{{ ++$i }}</h6></td>
                            <td class="min-width"><p>{{ $permission->name }}</p></td>
                            <td class="min-width"><p>{{ $permission->guard_name }}</p></td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <div class="action">
                                        <a href="#">
                                            <button class="more-btn ml-10 dropdown-toggle">
                                                <i class="lni lni-more-alt"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      <!-- end table row -->
                    </tbody>
                  </table>
                  <!-- end table -->
                  @if (isset($search))
                    {!! $permissions-> appends($search)->links() !!} <!-- appends envia variable en la paginacion-->
                  @else
                    {!! $permissions-> links() !!}    
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