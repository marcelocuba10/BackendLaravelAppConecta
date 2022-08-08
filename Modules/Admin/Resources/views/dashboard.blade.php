@extends('admin::layouts.adminLTE.app')
@section('content')

<section class="section">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="title mb-30">
              <h2>ConectaCode Dashboard Administrativo</h2>
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-6">
            <div class="breadcrumb-wrapper mb-30">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Conectacode
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- ========== title-wrapper end ========== -->
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30">
            <div class="icon purple">
              <i class="lni lni-users"></i>
            </div>
            <div class="content">
              <h6 class="mb-10">Total Clientes</h6>
              <h3 class="text-bold mb-10">34</h3>
            </div>
          </div>
          <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30">
            <div class="icon success">
              <i class="lni lni-graph"></i>
            </div>
            <div class="content">
              <h6 class="mb-10">Total Máquinas Locales</h6>
              <h3 class="text-bold mb-10">66</h3>
            </div>
          </div>
          <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30">
            <div class="icon primary">
              <i class="lni lni-credit-cards"></i>
            </div>
            <div class="content">
              <h6 class="mb-10">Total Máquinas de btc.com</h6>
              <h3 class="text-bold mb-10">$24,567</h3>
            </div>
          </div>
          <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30">
            <div class="icon orange">
              <i class="lni lni-user"></i>
            </div>
            <div class="content">
              <h6 class="mb-10">Total Usuarios</h6>
              @php
                use Modules\Admin\Entities\SuperUser;
                $cant_users = SuperUser::count(); 
              @endphp
              <h3 class="text-bold mb-10">{{$cant_users}}</h3>
            </div>
          </div>
          <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
      <div class="row">
        <div class="col-lg-6 col-xl-12 col-xxl-6">
          <div class="card-style calendar-card mb-30">
            <div id="calendar-mini"></div>
          </div>
        </div>
        <!-- End Col -->
        <div class="col-md-6 col-lg-3 col-xl-6 col-xxl-3">
          <div class="card-style mb-30">
            <div class="title d-flex flex-wrap align-items-center justify-content-between mb-10">
              <div class="left">
                <h6 class="text-medium mb-2">Sell Order</h6>
              </div>
              <div class="right mb-2">
                <div class="more-btn-wrapper mb-10">
                  <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="lni lni-more-alt"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                    <li class="dropdown-item">
                      <a href="#0" class="text-gray">Add All</a>
                    </li>
                    <li class="dropdown-item">
                      <a href="#0" class="text-gray">Remove All</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- End Title -->

            <div class="select-style-1 mb-2">
              <div class="select-position select-sm">
                <select class="radius-30">
                  <option value="">Bitcion</option>
                  <option value="">Ethereum</option>
                  <option value="">Litecion</option>
                </select>
              </div>
            </div>
            <!-- end select -->

            <div class="table-responsive">
              <table class="table sell-order-table">
                <thead>
                  <tr>
                    <th>
                      <h6 class="text-sm fw-500">Price</h6>
                    </th>
                    <th>
                      <h6 class="text-sm fw-500">Amount</h6>
                    </th>
                    <th class="text-end">
                      <h6 class="text-sm fw-500">Total</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- End Col -->
        <div class="col-md-6 col-lg-3 col-xl-6 col-xxl-3">
          <div class="card-style mb-30">
            <div class="title d-flex flex-wrap align-items-center justify-content-between mb-10">
              <div class="left">
                <h6 class="text-medium mb-2">Buy Order</h6>
              </div>
              <div class="right mb-2">
                <div class="more-btn-wrapper mb-10">
                  <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="lni lni-more-alt"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                    <li class="dropdown-item">
                      <a href="#0" class="text-gray">Add All</a>
                    </li>
                    <li class="dropdown-item">
                      <a href="#0" class="text-gray">Remove All</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- End Title -->

            <div class="select-style-1 mb-2">
              <div class="select-position select-sm">
                <select class="radius-30">
                  <option value="">Bitcion</option>
                  <option value="">Ethereum</option>
                  <option value="">Litecion</option>
                </select>
              </div>
            </div>
            <!-- end select -->

            <div class="table-responsive">
              <table class="table sell-order-table">
                <thead>
                  <tr>
                    <th>
                      <h6 class="text-sm fw-500">Price</h6>
                    </th>
                    <th>
                      <h6 class="text-sm fw-500">Amount</h6>
                    </th>
                    <th class="text-end">
                      <h6 class="text-sm fw-500">Total</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="text-sm fw-500 text-gray">65.8</p>
                    </td>
                    <td>
                      <p class="text-sm fw-500 text-gray">17.10</p>
                    </td>
                    <td class="text-end">
                      <p class="text-sm fw-500 text-gray">$251,77</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- End Row -->

    </div>
    <!-- end container -->
</section>
@endsection