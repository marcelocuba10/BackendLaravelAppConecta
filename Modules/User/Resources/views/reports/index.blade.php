@extends('user::layouts.adminLTE.app')
@section('content')

<section class="table-components">
  <div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="title d-flex align-items-center flex-wrap mb-30">
            <h2 class="mr-40">Relatorios</h2> 
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-4">
          <div class="right">
            <div class="table-search d-flex" style="margin-top: -35px;float: right;">
              <form action="#">
                <input style="background-color: #fff;" type="text" placeholder="Search...">
                <button><i class="lni lni-search-alt"></i></button>
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
        
      </div>
      <!-- end row -->
    </div>
    <!-- ========== tables-wrapper end ========== -->
  </div>
  <!-- end container -->
</section>

@endsection