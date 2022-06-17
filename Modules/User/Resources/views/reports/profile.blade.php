@extends('user::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <div class="titlemb-30">
                    <h2>Profile</h2>
                  </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                  <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="/user/dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                          Profile
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
                <div class="col-xxl-9 col-lg-8">
                  <div class="profile-wrapper mb-30">
                    <div class="profile-cover">
                      <img src="/assets/images/profile/profile-cover.jpg" alt="cover-image">
                      <div class="update-image">
                        <input type="file">
                        <label for=""><i class="lni lni-camera"></i> Edit Cover Photo</label>
                      </div>
                    </div>
                    <div class="d-md-flex">
                      <div class="profile-photo">
                        <div class="image">
                          <img src="/assets/images/profile/profile-image.png" alt="profile">
                          <div class="update-image">
                            <input type="file">
                            <label for=""><i class="lni lni-camera"></i></label>
                          </div>
                        </div>
                        <div class="profile-meta pt-25">
                          <h5 class="text-bold mb-10">{{ $user->name }}</h5>
                          <p class="text-sm">Founder, Abc Company</p>
                        </div>
                      </div>
                      <div class="profiles-activities w-100 pt-30">
                        <ul class="d-flex align-items-center">
                          <li class="mr-30">
                            <p><strong>234</strong> Posts</p>
                          </li>
                          <li class="mr-30">
                            <p><strong>34K</strong> Followers</p>
                          </li>
                          <li class="mr-30">
                            <p><strong>4K</strong> Following</p>
                          </li>
                          <li class="ms-auto">
                            <a href="{{ route('users_.edit.profile', $user->id) }}" class="main-btn btn-sm primary-btn btn-hover mb-20">
                              <i class="lni lni-plus mr-10"></i>
                              Update Information
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="profile-info">
                      <form action="#">
                        <div class="row">
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>First Name</label>
                              <input type="text" placeholder="{{ $user->name }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Last Name</label>
                              <input type="text" placeholder="{{ $user->last_name }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Address</label>
                              <input type="text" placeholder="{{ $user->address }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-6">
                            <div class="input-style-1">
                              <label>Phone Number</label>
                              <input type="text" placeholder="{{ $user->phone }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-6">
                            <div class="input-style-1">
                              <label>Cedula Identidad</label>
                              <input type="text" placeholder="{{ $user->ci }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-6">
                            <div class="input-style-1">
                              <label>Country</label>
                              <input type="text" placeholder="{{ $user->country }}" readonly>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-6">
                            <div class="input-style-1">
                              <label>Zip Code</label>
                              <input type="text" placeholder="{{ $user->zip_code }}" readonly>
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
                    <div class="
                        title
                        mb-20
                        d-flex
                        justify-content-between
                        align-items-center">
                      <h6>Two-Step Authentication</h6>
                    </div>
                    <div class="chat-list-wrapper">

                    </div>
                  </div>
                </div>
                <!-- end col -->
            </div>
        </div>
    </section>

@endsection