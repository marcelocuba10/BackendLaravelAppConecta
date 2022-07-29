@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="title d-flex align-items-center flex-wrap mb-30">
                    <h2 class="mr-40">Listado de Posts</h2>
                    </div>
                </div>
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
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-wrapper table-responsive">
                        <div class="col-md-12" id="post-data">
                            {{-- @include('user::posts.data') --}}
                        </div>
                        <div id="post" class="mt-5">

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

{{-- <script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script> --}}

<script type="text/javascript">
	var page = 1;

    // $(document).on('click','#search',function(){
    //     filter = $(this).val();
    // });

    // if(document.getElementById("search").value.length == 0)
    // {
    //     filter = "";
    // }

    // var input = document.getElementById("search");
    // input.addEventListener("keypress", function(event) {

    //   if (event.key === "Enter" && filter == "") {
    //         alert('esta vacio');
    //         exit();
    //     }else{
    //       search(filter);
    //     }

    // });

    $(document).ready(function()
    {  
      // if(document.getElementById("search").value.length == 0){
      //   filter = "";
      // }

      // $(document).on("click", "#filter", function(){
      //   status=$(this).val();
      //   loadMoreData(page,status)
      // });

      // if (filter == "") {
      //   loadMoreData(page);
      //   //checkPage(page);
      // }

      loadMoreData(page,status);
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
	            type: "post",
              data: {
                status: status,
                "_token": "{{ csrf_token() }}",
              },
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

  // function loadFilter(page,status){
  //     // alert(status);
  //     // exit();

  //     $.ajax({
  //       url:"{{ route('posts.search') }}",
  //       type: 'POST',
  //       datatype: 'html',
  //       data: {status: status,"_token": "{{ csrf_token() }}",},
  //       // beforeSend: function()
	//       //       {
	//       //           $('.ajax-load').show();
	//       //       },
  //       success: function(data){
  //         $('.ajax-load').hide();
  //         $('.msg').html("teste no muestra datos pero funciona");
  //         alert(data.success);
  //     }})

  //     .done(function(data){
  //       if(data.html == ""){
  //         $('.ajax-load').html("No se encontraron más registros");
  //         return;
  //       }
  //       $('.ajax-load').hide();
  //       $('.msg').html("teste no muestra datos pero funciona");
  //       $("#post-data").append(data.html);
  //     })
  //     .fail(function(jqXHR, ajaxOptions, thrownError){
  //       alert('server not responding...');
  //     });
  //   }

</script>

@endsection