@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="title d-flex align-items-center flex-wrap mb-30">
            <h2 class="mr-40">Listado de máquinas</h2>
            @can('machine-create')
            <a href="{{ route('machines.create') }}" class="main-btn info-btn btn-hover btn-sm"><i class="lni lni-plus mr-5"></i> Nuevo</a>
            @endcan
            <a href="/user/machines/grid_view"><i class="hthtg lni lni-grid-alt"></i></a>
            <a href="/user/machines"><i style="margin-left: 23px;" class="hthtg lni lni-list"></i></a>
            <a href="{{route('machines.createPDF',['download'=>'pdf'])}}"><i style="margin-left: 23px;"class="hthtg lni lni-printer"></i></a>
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-4">
          <div class="right">
            {{-- <div class="table-search d-flex" style="margin-top: -35px;float: right;">
              <form>
                <input id="mysearch"text="text"  placeholder="Search...">
                <button id="search" >Search ajax</button>
              </form>
            </div> --}}
            <div class="table-search d-flex" style="margin-top: -35px;float: right;">
              <form action="{{ route('machines.search_gridview') }}" method="POST">
                @csrf
                <input style="background-color: #fff;" id="search" type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Buscar..">
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

    <div class="form-layout-wrapper">
      <div class="card-style activity-card mb-30">
        <div class="row">
          <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
            <div class="left col-md-9">
              <div id="legend3">
                <ul class="legend3 d-flex align-items-center mb-30">
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-enabled"></span>
                      <div class="text">
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Encendido" type="submit"><p class="text-sm text-dark">Encendido</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-attention"> </span>
                      <div class="text">
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Requiere Atención" type="submit"><p class="text-sm text-dark">Requiere Atención</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-error"> </span>
                      <div class="text">
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Error" type="submit"><p class="text-sm text-dark">Error</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-maintenance"></span>
                      <div class="text">
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Offline" type="submit"><p class="text-sm text-dark">Mantenimiento</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-offline"></span>
                      <div class="text">
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Offline" type="submit"><p class="text-sm text-dark">Offline</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-disabled"></span>
                      <div class="text">
                        <form action="{{ route('machines.search_gridview') }}" method="POST">
                          @csrf
                          <button class="btn-group-status" name="filter" value="Apagado" type="submit"><p class="text-sm text-dark">Apagado</p></button>
                        </form> 
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="right">
              @if ($filter != 'Todos' && $filter != null)
              <ul class="legend3 d-flex align-items-center mb-30">
                <li>
                  <div class="d-flex">
                    <div class="text">
                      <form action="{{ route('machines.search_gridview') }}" method="POST">
                        @csrf
                        <button class="btn-group-status" name="filter" value="Todos" type="submit"><p class="text-sm text-dark"><i class="lni lni-close"></i>&nbsp; Quitar Filtros</p></button>
                      </form> 
                    </div>
                  </div>
                </li>
              </ul>
              @endif
            </div>
          </div>

          <div id="post-data">
            {{-- @include('user::machines._partials.data') --}}
          </div>

          <div id="search-data">
            {{-- @include('user::machines._partials.data') --}}
          </div>
        </div>
        

        <div class="ajax-load" style="display:none">
          <div class="card-style-3 mb-30">
            <div class="card-content">
              <h4><a href="#0">Cargando Datos...</a></h4>
              <div class="ph-item">
                <div class="ph-col-12">
                  <div class="ph-picture"></div>
                  <div class="ph-row">
                    <div class="ph-col-6 big"></div>
                    <div class="ph-col-4 empty big"></div>
                    <div class="ph-col-2 big"></div>
                    <div class="ph-col-4"></div>
                    <div class="ph-col-8 empty"></div>
                    <div class="ph-col-6"></div>
                    <div class="ph-col-6 empty"></div>
                    <div class="ph-col-12"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- end row -->
    </div>
  </div>

  <script type="text/javascript">

    $('#search').on('click',function(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url:"{{ url('machines/search_gridview') }}",
            data:{'filter':$value}
        })
        .done(function(data){
	        if(data.html == ""){
	            $('.ajax-search').html("No more records found");
	            return;
	        }
	        $("#search-data").append(data.html);
	    });
    })

  </script>

  <script type="text/javascript">
    var page = 1;
    
    $(document).ready(function()
    {
        //loadMoreData(page);
        checkPage(page);
    });

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page);
        }
    });

    async function checkPage(){
      console.log('calling');
      await loadMoreData(page);
      page++;
      loadMoreData(page);
    }
  
    function loadMoreData(page){
      $.ajax({
        url: '?page=' + page,
        type: "get",
        beforeSend: function()
        {
          $('.ajax-load').show();
        }
      })
      .done(function(data){
        if(data.html == ""){
          $('.ajax-load').html("No se encontraron más registros");
          return;
        }
        $('.ajax-load').hide();
        $("#post-data").append(data.html);
      })
      .fail(function(jqXHR, ajaxOptions, thrownError){
        alert('server not responding...');
      });
    }

  </script>
</section>
@endsection