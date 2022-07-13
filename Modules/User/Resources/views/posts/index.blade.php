@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title d-flex align-items-center flex-wrap mb-30">
                    <h2 class="mr-40">Listado de Posts</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-search d-flex" style="margin-top: -35px;float: right;">
                        <form action="{{ route('posts.search') }}" method="POST">
                          @csrf
                          <input style="background-color: #fff;" id="search" type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Buscar...">
                          <button type="submit"><i class="lni lni-search-alt"></i></button>
                        </form>    
                      </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-wrapper table-responsive">
                        <div class="col-md-12" id="post-data">
                            {{-- @include('user::posts.data') --}}
                        </div>
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
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">

    // $(document).on('keyup','#search',function(){
    //     var query = $(this).val();
    //     search(query);
    // });

    // $('#search').click(function(){
    //     $value=$(this).val();
    //     $.ajax({
    //         type : 'get',
    //         url:"{{ route('posts.search') }}",
    //         data:{'filter':$value}
    //     })
    //     .done(function(data){
	//         if(data.html == ""){
	//             $('.ajax-load').html("No more records found");
	//             return;
	//         }
	//         $('.ajax-load').hide();
	//         $("#post-data").append(data.html);
	//     });
    // })

</script>

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script type="text/javascript">
	var page = 1;
    var filter;

    $(document).on('click','#search',function(){
        filter = $(this).val();
    });

    if(document.getElementById("search").value.length == 0)
    {
        filter = "";
    }

    var input = document.getElementById("search");
    input.addEventListener("keypress", function(event) {

      if (event.key === "Enter" && filter == "") {
            alert('esta vacio');
            exit();
        }else{
          search(filter);
        }

    });

    $(document).ready(function()
    {  
      if(document.getElementById("search").value.length == 0){
        filter = "";
      }

      if (filter == "") {
        loadMoreData(page);
        //checkPage(page);
      }
    });

	$(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
	        page++;
	        loadMoreData(page);
	    }
	});

	function loadMoreData(page){
	  $.ajax(
	        {
	            url: '?page=' + page,
	            type: "get",
	            beforeSend: function()
	            {
	                $('.ajax-load').show();
	            }
	        })
	        .done(function(data)
	        {
	            if(data.html == ""){
	                $('.ajax-load').html("No more records found");
	                return;
	            }
	            $('.ajax-load').hide();
	            $("#post-data").append(data.html);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('server not responding...');
	        });
	}
</script>

@endsection