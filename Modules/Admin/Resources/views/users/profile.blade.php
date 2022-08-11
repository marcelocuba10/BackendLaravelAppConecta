@extends('admin::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <div class="titlemb-30">
                    <h2>Perfil</h2>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                  <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
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
                <div class="col-xxl-9 col-lg-8">
                  <div class="profile-wrapper mb-30">
                    <div class="profile-cover">
                      <img src="/assets/images/profile/profile-cover-2.png" alt="cover-image">
                    </div>
                    <div class="d-md-flex">
                      <div class="profile-photo">
                        <div class="image">
                          <img src="/assets/images/profile/profile-2.png" alt="profile">
                          <div class="update-image">
                            <input>
                            <label for=""><i class="lni lni-camera"></i></label>
                          </div>
                        </div>
                        <div class="profile-meta pt-25">
                          <h5 class="text-bold mb-10">{{ $user->name }}</h5>
                          <p class="text-sm">Rol - {{$userRole}}</p>
                        </div>
                      </div>
                      <div class="profiles-activities w-100 pt-30">
                        <ul class="d-flex align-items-center">
                          <li class="mr-30"></li>
                          <li class="mr-30"></li>
                          <li class="ms-auto">
                            <a href="/admin/users/edit/profile/{{$user->id}}" class="main-btn btn-sm primary-btn btn-hover mb-20">
                              <i class="lni lni-pencil-alt mr-10"></i>Actualizar Perfil
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="profile-info">
                      <form action="#">
                        <div class="row">
                          <div class="col-6">
                            <div class="input-style-1">
                              <label>Nombre</label>
                              <input type="text" placeholder="{{ $user->name }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-6">
                            <div class="input-style-1">
                              <label>Apellidos</label>
                              <input type="text" placeholder="{{ $user->last_name }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Dirección</label>
                              <input type="text" placeholder="{{ $user->address }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-6">
                            <div class="input-style-1">
                              <label>Teléfono</label>
                              <input type="text" placeholder="{{ $user->phone }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-6">
                            <div class="input-style-1">
                              <label>Doc Identidad</label>
                              <input type="text" placeholder="{{ $user->ci }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                        </div>
                        <!-- end row -->
                      </form>
                    </div>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-xxl-3 col-lg-4">
                  <div class="card-style chat-list-card">
                    <div class="title mb-20 d-flex justify-content-between align-items-center">
                      <h6>Mensajes</h6>
                      <div class="more-btn-wrapper">
                        <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="lni lni-more-alt"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                          <li class="dropdown-item">
                            <a href="#0" class="text-gray">Mark as Read</a>
                          </li>
                          <li class="dropdown-item">
                            <a href="#0" class="text-gray">Reply</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <form action="#">
                      <div class="input-style-3">
                        <input type="text" placeholder="Search....">
                        <span class="icon">
                          <i class="lni lni-search-alt"></i>
                        </span>
                      </div>
                    </form>
                    <!-- end search form -->
                    <div class="chat-list-wrapper">
                      <a href="#0" class="chat-list d-block">
                        <div class="chat-list-item">
                          <div class="image">
                            <img src="https://demo.plainadmin.com/assets/images/lead/lead-6.png" alt="">
                            <span class="status"></span>
                          </div>
                          <div class="content">
                            <div class="title">
                              <h6 class="text-sm text-medium">Jacob Jones</h6>
                              <div class="d-flex align-items-center">
                                <span>20m</span>
                                <button><i class="lni lni-star"></i></button>
                              </div>
                            </div>
                            <p class="text-sm">I cam across your profile and...</p>
                          </div>
                        </div>
                      </a>
                      <!-- end chat-list -->
                      <a href="#0" class="chat-list d-block">
                        <div class="chat-list-item">
                          <div class="image">
                            <img src="https://demo.plainadmin.com/assets/images/lead/lead-6.png" alt="">
                            <span class="status"></span>
                          </div>
                          <div class="content">
                            <div class="title">
                              <h6 class="text-sm text-medium">Ronald Richards</h6>
                              <div class="d-flex align-items-center">
                                <span>25m</span>
                                <button><i class="lni lni-star"></i></button>
                              </div>
                            </div>
                            <p class="text-sm">I like your confidence 💪</p>
                          </div>
                        </div>
                      </a>
                      <!-- end chat-list -->
                      <a href="#0" class="chat-list d-block">
                        <div class="chat-list-item">
                          <div class="image">
                            <img src="https://demo.plainadmin.com/assets/images/lead/lead-6.png" alt="">
                            <span class="status"></span>
                          </div>
                          <div class="content">
                            <div class="title">
                              <h6 class="text-sm text-medium">Esther Howard</h6>
                              <div class="d-flex align-items-center">
                                <span>30m</span>
                                <button><i class="lni lni-star"></i></button>
                              </div>
                            </div>
                            <p class="text-sm">Can you share your offer?</p>
                          </div>
                        </div>
                      </a>
                      <!-- end chat-list -->
                      <a href="#0" class="chat-list d-block">
                        <div class="chat-list-item">
                          <div class="image">
                            <img src="https://demo.plainadmin.com/assets/images/lead/lead-6.png" alt="">
                            <span class="status"></span>
                          </div>
                          <div class="content">
                            <div class="title">
                              <h6 class="text-sm text-medium">Cody Fisher</h6>
                              <div class="d-flex align-items-center">
                                <span>32m</span>
                                <button><i class="lni lni-star"></i></button>
                              </div>
                            </div>
                            <p class="text-sm">When you available for talk?</p>
                          </div>
                        </div>
                      </a>
                      <!-- end chat-list -->
                    </div>
                  </div>
                </div>
                <!-- end col -->
            </div>
        </div>
    </section>

@endsection