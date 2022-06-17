@extends('user::layouts.adminLTE.app')
@section('content')

    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                  <div class="col-md-6">
                    <div class="title mb-30">
                      <h2>Form Elements</h2>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                      <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="#0">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item"><a href="#0">Pages</a></li>
                          <li class="breadcrumb-item active" aria-current="page">
                            Clients
                          </li>
                        </ol>
                      </nav>
                    </div>
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->
              </div>
              <div class="form-layout-wrapper">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="card-style mb-30">
                      <h6 class="mb-25">Shipping Address</h6>
                      <form action="#">
                        <div class="row">
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>First Name</label>
                              <input type="text" placeholder="John">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Last Name</label>
                              <input type="text" placeholder="Doe">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Phone Number</label>
                              <input type="text" placeholder="617-802-1898">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Address</label>
                              <input type="text" placeholder="4971  Green Avenue, Hayward, California">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>City</label>
                              <input type="text" placeholder="Hayward">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-sm-6">
                            <div class="select-style-1">
                              <label>State</label>
                              <div class="select-position">
                                <select class="light-bg">
                                  <option value="">Select State</option>
                                  <option value="">California</option>
                                  <option value="">New York</option>
                                  <option value="">Alaska</option>
                                </select>
                              </div>
                            </div>
                            <!-- end select -->
                          </div>
                          <!-- end col -->
                          <div class="col-sm-6">
                            <div class="input-style-1">
                              <label>Zip Code</label>
                              <input type="text" placeholder="00611">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="
                                form-check
                                checkbox-style checkbox-success
                                mb-30
                              ">
                              <input class="form-check-input" type="checkbox" value="" id="checkbox-agree">
                              <label class="form-check-label" for="checkbox-agree">
                                I Agree to term and condition</label>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="
                                button-group
                                d-flex
                                justify-content-center
                                flex-wrap
                              ">
                              <button class="main-btn primary-btn btn-hover m-2">
                                Save Address
                              </button>
                              <button class="main-btn danger-btn-outline m-2">
                                Cancel
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- end row -->
                      </form>
                    </div>
                    <!-- end card -->
                    <div class="card-style mb-30">
                      <h6 class="mb-15">Sign up Form</h6>
                      <p class="text-sm mb-25">
                        Start creating the best possible user experience for you
                        customers.
                      </p>
                      <form action="#">
                        <div class="row">
                          <div class="col-12">
                            <div class="input-style-1">
                              <label> Name</label>
                              <input type="text" placeholder="Name">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Email</label>
                              <input type="email" placeholder="Email">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Password</label>
                              <input type="password" placeholder="Password">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="form-check checkbox-style mb-30">
                              <input class="form-check-input" type="checkbox" value="" id="checkbox-not-robot">
                              <label class="form-check-label" for="checkbox-not-robot">
                                I am not a Robot</label>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="
                                button-group
                                d-flex
                                justify-content-center
                                flex-wrap
                              ">
                              <button class="
                                  main-btn
                                  primary-btn
                                  btn-hover
                                  w-100
                                  text-center
                                ">
                                Sign Up
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- end row -->
                      </form>
                    </div>
                    <!-- end card -->
                    <div class="card-style mb-30">
                      <h6 class="mb-25">Time and Date</h6>
                      <div class="input-style-1">
                        <label>Date</label>
                        <input type="date">
                      </div>
                      <!-- end input -->
                      <div class="input-style-2">
                        <input type="date">
                        <span class="icon"><i class="lni lni-chevron-down"></i></span>
                      </div>
                      <!-- end input -->
                      <div class="input-style-2">
                        <input type="time">
                      </div>
                      <!-- end input -->
                    </div>
                    <!-- end card -->
                  </div>
                  <!-- end col -->
    
                  <div class="col-lg-6">
                    <div class="card-style mb-30">
                      <h6 class="mb-25">Contact Us</h6>
                      <form action="#">
                        <div class="row">
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Name</label>
                              <input type="text" placeholder="Name" class="bg-transparent">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Email</label>
                              <input type="email" placeholder="Email" class="bg-transparent">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="select-style-1">
                              <label>Subject</label>
                              <div class="select-position">
                                <select>
                                  <option value="">Select Subject</option>
                                  <option value="">Maintenances</option>
                                  <option value="">Web Services</option>
                                  <option value="">Graphic Services</option>
                                </select>
                              </div>
                            </div>
                            <!-- end select -->
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Date</label>
                              <input type="date">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Message</label>
                              <textarea placeholder="Type here..." rows="5" class="bg-transparent"></textarea>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <button class="main-btn primary-btn btn-hover">
                              Submit Form
                            </button>
                          </div>
                        </div>
                        <!-- end row -->
                      </form>
                    </div>
                    <!-- end card -->
    
                    <div class="card-style mb-30">
                      <h6 class="mb-15">Sign In Form</h6>
                      <p class="text-sm mb-25">
                        Start creating the best possible user experience for you
                        customers.
                      </p>
                      <form action="#">
                        <div class="row">
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Email</label>
                              <input type="email" placeholder="Email">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="input-style-1">
                              <label>Password</label>
                              <input type="password" placeholder="Password">
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-xxl-6 col-lg-12 col-md-6">
                            <div class="form-check checkbox-style mb-30">
                              <input class="form-check-input" type="checkbox" value="" id="checkbox-remember">
                              <label class="form-check-label" for="checkbox-remember">
                                Remember me next time</label>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-xxl-6 col-lg-12 col-md-6">
                            <div class="
                                text-start text-md-end text-lg-start text-xxl-end
                                mb-30
                              ">
                              <a href="#0">Forgot Password?</a>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-12">
                            <div class="
                                button-group
                                d-flex
                                justify-content-center
                                flex-wrap
                              ">
                              <button class="
                                  main-btn
                                  primary-btn
                                  btn-hover
                                  w-100
                                  text-center
                                ">
                                Sign In
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- end row -->
                      </form>
                    </div>
                    <!-- end card -->
                    <div class="card-style mb-30">
                      <h6 class="mb-25">Selects</h6>
                      <div class="select-style-1">
                        <label>Category</label>
                        <div class="select-position">
                          <select>
                            <option value="">Select category</option>
                            <option value="">Category one</option>
                            <option value="">Category two</option>
                            <option value="">Category three</option>
                          </select>
                        </div>
                      </div>
                      <!-- end select -->
                      <div class="select-style-2">
                        <div class="select-position">
                          <select>
                            <option value="">Select category</option>
                            <option value="">Category one</option>
                            <option value="">Category two</option>
                            <option value="">Category three</option>
                          </select>
                        </div>
                      </div>
                      <!-- end select -->
                    </div>
                    <!-- end card -->
                    <div class="card-style mb-30">
                      <h6 class="mb-25">Checkbox</h6>
                      <div class="form-check checkbox-style mb-20">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox-1">
                        <label class="form-check-label" for="checkbox-1">
                          Default Checkbox</label>
                      </div>
                      <!-- end checkbox -->
                      <div class="form-check checkbox-style mb-20">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox-2" disabled="">
                        <label class="form-check-label" for="checkbox-2">
                          Disabled Checkbox</label>
                      </div>
                      <!-- end checkbox -->
                      <div class="form-check checkbox-style checkbox-success mb-20">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox-3">
                        <label class="form-check-label" for="checkbox-3">
                          Success Checkbox</label>
                      </div>
                      <!-- end checkbox -->
                      <div class="form-check checkbox-style checkbox-warning mb-20">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox-4">
                        <label class="form-check-label" for="checkbox-4">
                          Warning Checkbox</label>
                      </div>
                      <!-- end checkbox -->
                      <div class="form-check checkbox-style checkbox-danger mb-20">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox-5">
                        <label class="form-check-label" for="checkbox-5">
                          Danger Checkbox</label>
                      </div>
                      <!-- end checkbox -->
                    </div>
                    <!-- end card -->
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->
              </div>
        </div>
    </section>
@endsection