@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="title d-flex align-items-center flex-wrap mb-30">
              <h2 class="mr-40">Relatorio de Clientes</h2>
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
                      <div class="col-xxl-3">
                        <div class="input-style-1">
                          <label>City</label>
                          <input type="text" placeholder="City">
                        </div>
                      </div>
                      <div class="col-xxl-3">
                        <div class="input-style-1">
                          <label>Zip Code</label>
                          <input type="text" placeholder="Zip Code">
                        </div>
                      </div>
                      <div class="col-xxl-3">
                        <div class="select-style-1">
                          <label>Country</label>
                          <div class="select-position">
                            <select class="light-bg">
                              <option value="">Select category</option>
                              <option value="">USA</option>
                              <option value="">UK</option>
                              <option value="">Canada</option>
                              <option value="">India</option>
                              <option value="">Bangladesh</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-xxl-3">
                        <div class="invoice-action">
                          <ul class="d-flex flex-wrap align-items-center justify-content-center">
                            <li class="m-2">
                              <a href="#0" class="main-btn primary-btn-outline btn-hover">
                                Download Invoice
                              </a>
                            </li>
                            <li class="m-2">
                              <a href="#0" class="main-btn primary-btn btn-hover">
                                <i class="lni lni-search"></i>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="invoice-date">
                  <p><span>Date Issued:</span> 20/02/2024</p>
                  <p><span>Date Due:</span> 20/02/2028</p>
                  <p><span>Order ID:</span> #5467</p>
                </div>
              </div>

              <div class="table-responsive">
                <table class="invoice-table table">
                  <thead>
                    <tr>
                      <th class="service">
                        <h6 class="text-sm text-medium">#</h6>
                      </th>
                      <th class="desc">
                        <h6 class="text-sm text-medium">Nombre</h6>
                      </th>
                      <th class="qty">
                        <h6 class="text-sm text-medium">Teléfono</h6>
                      </th>
                      <th class="amount">
                        <h6 class="text-sm text-medium">Máquinas</h6>
                      </th>
                      <th class="amount">
                        <h6 class="text-sm text-medium">Dirección</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td class="text-sm"><p>{{ ++$i }}</p></td>
                        <td class="text-sm"><p>{{ $customer->name }}</p></td>
                        <td class="text-sm"><p>{{ $customer->phone }}</p></td>
                        <td class="text-sm"><p>{{ $customer->total_machines }}</p></td>
                        <td class="text-sm"><p>{{ $customer->address }}</p></td>
                    </tr>
                    @endforeach
                  <!-- end table row -->
                </tbody>
                </table>
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