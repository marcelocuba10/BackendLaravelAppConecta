@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Relatorio de Funcionarios</h2>
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-4">
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>

      <!-- ========== title-wrapper end ========== -->

      <div class="invoice-wrapper">
        <div class="row">
          <div class="col-12">
            <div class="invoice-card card-style mb-30">
              <div class="invoice-header">
                <div class="invoice-for">
                  <form action="#">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="input-style-1">
                          <label>Funcionario</label>
                          <form action="/user/reports/customers/search">
                            <input disabled class="bg-gray" style="background-color: #fff;" id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar funcionario..">
                          </form>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="input-style-1">
                          <label>Desde</label>
                            <input type="date" name="date" id="date" value="{{ $schedule->date ?? old('date') }}" readonly class="bg-gray">  
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="input-style-1">
                          <label>Hasta</label>
                            <input type="date" name="date" id="date" value="{{ $schedule->date ?? old('date') }}" readonly class="bg-gray">  
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="input-style-1">
                          <label>Acciones</label>
                          <a href="#" class="btn btn-lg warning-btn rounded-md btn-hover disabled" role="button" aria-disabled="true"><i class="lni lni-search"></i></a>
                          <a href="{{route('reports.users',['download'=>'pdf'])}}" class="btn btn-lg success-btn rounded-md btn-hover" target="_blank"><i class="lni lni-printer"></i></a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="table-responsive">
                <table class="invoice-table table">
                  <thead>
                    <tr>
                      <th class="sm">
                        <h6 class="text-sm text-medium"></h6>
                      </th>
                      <th class="lg">
                        <h6 class="text-sm text-medium">Nombre</h6>
                      </th>
                      <th class="lg">
                        <h6 class="text-sm text-medium">Apellidos</h6>
                      </th>
                      <th class="md">
                        <h6 class="text-sm text-medium">Teléfono</h6>
                      </th>
                      <th class="md">
                        <h6 class="text-sm text-medium">Email</h6>
                      </th>
                      <th class="lg">
                        <h6 class="text-sm text-medium">Doc Identidad</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="text-sm"><h6 class="text-sm">#{{ ++$i }}</h6></td>
                        <td class="text-sm"><p>{{ $user->name }}</p></td>
                        <td class="text-sm"><p>{{ $user->last_name }}</p></td>
                        <td class="text-sm"><p><i class="lni lni-phone mr-10"></i>{{ $user->phone }}</p></td>
                        <td class="text-sm"><p>{{ $user->email }}</p></td>
                        <td class="text-sm"><p>{{ $user->ci }}</p></td>
                    </tr>
                    @endforeach
                  <!-- end table row -->
                </tbody>
                </table>
                @if (isset($filter))
                {{-- {{ $machines->appends(['sort' =>$filter])->links() }}  --}}
                {{-- {!! $machines->appends(Request::except('page'))->render() !!} --}}
                  {!! $users-> appends($filter)->links() !!} <!-- appends envia variable en la paginacion-->
                @else
                  {!! $users-> links() !!}    
                @endif
              </div>
            </div>
            <!-- End Card -->
          </div>
          <!-- ENd Col -->
        </div>
        <!-- End Row -->
      </div>

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