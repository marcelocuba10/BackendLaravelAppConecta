@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="title d-flex align-items-center flex-wrap mb-30">
            <h2 class="mr-40">Listado Máquinas Pool</h2>
            <a style="margin-left: 17px;" href="/user/machines/grid_view_api"><i class="hthtg lni lni-grid-alt"></i></a>
            <a style="margin-left: 17px;" href="/user/machines/list_api"><i class="hthtg lni lni-list"></i></a>
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-4">
          <div class="right">
            {{-- <div class="table-search d-flex" style="margin-top: -35px;float: right;">
              <form action="/#" method="POST">
                @csrf
                <input style="background-color: #fff;" id="search" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar cliente..">
              </form>   
            </div> --}}
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
                        {{-- <form action="/user/machines/filter_gridview_api" method="POST"> --}}
                          @csrf
                          <button class="btn-group-status" id="filter" name="filter" value="active" type="submit"><p class="text-sm text-dark">Activo</p></button>
                        {{-- </form>  --}}
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color bg-card-offline"></span>
                      <div class="text">
                        {{-- <form action="/user/machines/filter_gridview_api" method="POST"> --}}
                          @csrf
                          <button class="btn-group-status" id="filter" name="filter" value="inactive" type="submit"><p class="text-sm text-dark">Inactivo</p></button>
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
                      <form action="/user/machines/search_gridview_api" method="POST">
                        @csrf
                        <button class="btn-group-status" name="search" id="search" value="" type="submit"><p class="text-sm text-dark"><i class="lni lni-close"></i>&nbsp; Quitar Filtros</p></button>
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
    var search;
    var filter;
    var status="all";

    // capture characters from input
    //search = document.getElementById("search").value;

    //teste search
    // $('#search').on('keyup', function(){
    //   var keyword = $('#search').val();
    //   //alert(keyword);
    //   //search();
    // });

    //disable scroll if set filter or search not marked
    // if(search.length == 0 || filter == ""){

    // }

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page,status);
        }
    });
    
    // on load page
    $(document).ready(function(){  
      checkPage(page,status);
      // $(document).on("click", "#filter", function(){
      //   filter = $(this).val();
      //   alert('init loadFilter');
      //   loadFilter();
      //   loadMoreData(page,status)
      // });

      // if(search.length == 0  && filter == null){
      //   //loadMoreData(page);
      //   checkPage(page,status);
      // }
    });

    async function checkPage(){
      await loadMoreData(page,status);
      page++;
      loadMoreData(page,status);
    }
  
    function loadMoreData(page,status){
      $.ajax({
        url: '?page=' + page,
        type: "get",
        data: {
          status: status,
          "_token": "{{ csrf_token() }}",
        },
        beforeSend: function()
        {
          $('.ajax-load').show();
        }
      })
      .done(function(data){
        //alert(data.html);
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

    function loadFilter(page,filter){
      $.ajax({
        //url: "{{ route('machines.search_gridview_api') }}" + "?page=" + page,
        url: '?page=' + page,
        // type: "get",
        type: "POST",
        dataType: 'html',
        contentType:'application/x-www-form-urlencoded',
        //headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
          status: status,
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