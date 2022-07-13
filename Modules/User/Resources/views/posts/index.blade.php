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
                            @include('user::posts.data')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ajax-load text-center" style="display:none">
                    <p><img src="{{asset('img/loader.gif')}}"/>loading more data</p>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">

    $('#search').click(function(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url:"{{ url('posts/search') }}",
            data:{'filter':$value}
        })
        .done(function(data){
	        if(data.html == ""){
	            $('.ajax-load').html("No more records found");
	            return;
	        }
	        $('.ajax-load').hide();
	        $("#post-data").append(data.html);
	    });
    })

</script>

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script type="text/javascript">
	var page = 1;
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