@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="title d-flex align-items-center flex-wrap mb-30">
            <h2 class="mr-40">Listado Máquinas Pool</h2>
            <div class="off-mobile">
              <a style="margin-left: 17px;" href="/user/machines/grid_view_api"><i class="hthtg lni lni-grid-alt"></i></a>
              <a style="margin-left: 17px;" href="/user/machines/list_api"><i class="hthtg lni lni-list"></i></a>
            </div>

            <div class="on-mobile">
              <div class="button-group-m">
                <a href="/user/machines/grid_view_api" title="Vista modo cuadricula" class="active">Vista Cuadrícula</a>
                <a href="/user/machines/list_api" title="Vista modo lista">Vista Lista</a>
              </div>
            </div>
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-4">
          <div class="right">
            <div class="table-search d-flex st-input-search">
              <form>
                <input style="background-color: #fff;" type="text" name="search" id="search" value="{{ $search ?? '' }}" placeholder="Buscar cliente..">
                <button id="myBtnSearch"><i class="lni lni-search-alt"></i></button>
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
                <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-enabled"></span>
                      <div class="text">
                        {{-- <form action="/user/machines/filter_gridview_api" method="POST"> --}}
                          @csrf
                          <button class="btn-group-status" name="filter" value="active" type="submit"><p class="text-sm text-dark">Activo</p></button>
                        {{-- </form>  --}}
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-disabled"></span>
                      <div class="text">
                        {{-- <form action="/user/machines/filter_gridview_api" method="POST"> --}}
                          @csrf
                          <button class="btn-group-status" name="filter" value="inactive" type="submit"><p class="text-sm text-dark">Inactivo</p></button>
                        {{-- </form>  --}}
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="right">
              @if (isset($filter))
              <ul class="legend3 d-flex align-items-center mb-30">
                <li>
                  <div class="d-flex">
                    <div class="text">
                      {{-- <form action="/user/machines/search_gridview_api" method="POST">
                        @csrf
                        <button class="btn-group-status" name="search" id="search" value="" type="submit"><p class="text-sm text-dark"><i class="lni lni-close"></i>&nbsp; Quitar Filtros</p></button>
                      </form>  --}}
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

          {{-- @if ($filter)
            <div id="post-data">
              @include('user::machines._partials.data')
            </div>
          @endif --}}
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
    var page = 1;

    // On load page
    $(document).ready(function(){  
      // when starting, it captures the value, to input search
      var search = document.getElementById("search").value;
      //getFirstTwoRows(page);

      if(search.length == 0 ){
        //loadMoreData(page);
        getFirstTwoRows(page);

        $(window).scroll(function() {
          if($(window).scrollTop() + $(window).height() >= $(document).height()) {
              page++;
              loadMoreData(page);
          }
        });
      }else{
        searchInput(page);
        $(window).scroll(function() {
          if($(window).scrollTop() + $(window).height() >= $(document).height()) {
              page++;
              searchInput(page);
          }
        });
      }
    });

    $("#search").keyup(function(event) {
      //if press key Enter in input
      if (event.keyCode === 13) {
        searchInput(page);
      }
    });

    async function getFirstTwoRows(){
      await loadMoreData(page);
      page++;
      loadMoreData(page);
    }
  
    function loadMoreData(page){
      $.ajax({
        url: '?page=' + page,
        type: "get",
        data: {
          "_token": "{{ csrf_token() }}",
        },
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

  function searchInput(page){
    $.ajax({
        url: '?page=' + page,
        type: "get",
        data: {
          search: search.value,
          "_token": "{{ csrf_token() }}",
        },
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