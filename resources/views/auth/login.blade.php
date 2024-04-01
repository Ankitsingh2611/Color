@extends('layout')
@section('content')

{{-- @php
   echo "<pre>"; print_r($country); echo "</pre>";
@endphp --}}
<!-- Page Header End -->
<div class="container-xxl py-5 page-header position-relative mb-5">
  <div class="container py-5">
      <h1 class="display-2 text-white animated slideInDown mb-4">Login</h1>
      <nav aria-label="breadcrumb animated slideInDown">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Account</a></li>
              <li class="breadcrumb-item text-white active" aria-current="page">Login</li>
          </ol>
      </nav>
  </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-xxl py-5">
  <div class="container">

      <div class="bg-light rounded">
          <div class="row g-0">
              <div class="col-lg-8 offset-2 wow fadeIn" data-wow-delay="0.1s">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                  <div class="h-100 d-flex flex-column justify-content-center p-5">
                      <form action="{{ route('post.login') }}" method="post">
                        @csrf
                        <div class="row g-3">
                              <div class="col-sm-12">
                                  <div class="form-floating">
                                      <input type="email" name="email" class="form-control border-0" id="email" placeholder="Your Email">
                                      <label>Your Email</label>
                                  </div>
                                  @if ($errors->has('email'))
                                  <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                               @endif
                              </div>
                              <div class="col-12">
                                  <div class="form-floating">
                                      <input type="password" name="password" class="form-control border-0" id="password" placeholder="Password">
                                      <label for="password">Password</label>
                                  </div>
                                  @if ($errors->has('password'))
                                  <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                               @endif
                              </div>
                              <div class="col-12">
                                  <input type="submit" name="submit" class="btn btn-primary w-100 py-3" value="Submit" />
                              </div>
                          </div>
                      </form>
                  </div>
              </div>

          </div>
      </div>
  </div>
</div>
<!-- Contact End -->


@endsection

