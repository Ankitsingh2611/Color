@extends('layout')
@section('content')

{{-- @php
   echo "<pre>"; print_r($country); echo "</pre>";
@endphp --}}
<!-- Page Header End -->
<div class="container-xxl py-5 page-header position-relative mb-5">
  <div class="container py-5">
      <h1 class="display-2 text-white animated slideInDown mb-4">Registration</h1>
      <nav aria-label="breadcrumb animated slideInDown">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Account</a></li>
              <li class="breadcrumb-item text-white active" aria-current="page">Registration</li>
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
                      <form action="{{ route('post.registration') }}" method="post" enctype="multipart/form-data">
                        @csrf
                          <div class="row g-3">
                              <div class="col-sm-6">
                                  <div class="form-floating">
                                      <input type="text" name="first_name" class="form-control border-0" value="{{ old('first_name') }}" placeholder="Your First Name">
                                      <label>Your First Name</label>
                                  </div>
                                  @if ($errors->has('first_name'))
                                     <div class="alert alert-danger">{{ $errors->first('first_name') }}</div>
                                  @endif
                              </div>
                              <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" name="last_name" class="form-control border-0" placeholder="Your Last Name">
                                    <label>Your Last Name</label>
                                </div>
                                @if ($errors->has('last_name'))
                                <div class="alert alert-danger">{{ $errors->first('last_name') }}</div>
                             @endif
                            </div>
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
                                <div class="form-floating">
                                    <input type="password" name="confirm_password" class="form-control border-0" id="confirm_password" placeholder="Confirm Password">
                                    <label for="confirm_password">Confirm Password</label>
                                </div>
                                @if ($errors->has('confirm_password'))
                                <div class="alert alert-danger">{{ $errors->first('confirm_password') }}</div>
                             @endif
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="mobile" class="form-control border-0" id="mobile" maxlength="10" onkeydown="return (!((event.keyCode>=65 && event.keyCode<=95)) && event.keyCode!=32)" placeholder="Enter Your Mobile">
                                    <label for="mobile">Mobile</label>
                                </div>
                                @if ($errors->has('mobile'))
                                <div class="alert alert-danger">{{ $errors->first('mobile') }}</div>
                             @endif
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="radio" name="gender" value="male" id="gender" > Male
                                    <input type="radio" name="gender" value="female" id="gender" > Female
                                    <label for="gender">Gender</label>
                                </div>
                                @if ($errors->has('gender'))
                                <div class="alert alert-danger">{{ $errors->first('gender') }}</div>
                             @endif
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="date" name="dob" class="form-control border-0" id="dob" placeholder="Date Of Birth">
                                    <label for="dob">Date Of Birth</label>
                                </div>
                                @if ($errors->has('dob'))
                                <div class="alert alert-danger">{{ $errors->first('dob') }}</div>
                             @endif
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="file" name="photo" class="form-control border-0" id="photo" placeholder="Photo">
                                    <label for="photo">Photo</label>
                                </div>
                                @if ($errors->has('photo'))
                                <div class="alert alert-danger">{{ $errors->first('photo') }}</div>
                             @endif
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                   <select id="countries" name="countries" class="form-control border-0">
                                    <option value="0">Select Country</option>
                                    @foreach ($country as $data )
                                    <option value="{{ $data->country_id }}">{{ $data->country_name }}</option>
                                    @endforeach
                                   </select>
                                     <label for="">Country</label>
                                </div>
                                @if ($errors->has('countries'))
                                <div class="alert alert-danger">{{ $errors->first('countries') }}</div>
                             @endif
                            </div>
                           <div class="col-12">
                                <div class="form-floating">
                                   <select id="states" name="states" class="form-control border-0">
                                    <option>Select State</option>
                                   </select>
                                    <label for="">State</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                   <select id="cities" name="cities" class="form-control border-0">
                                    <option>Select City</option>
                                   </select>
                                    <label for="">City</label>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="pincode" class="form-control border-0" id="pincode" placeholder="Pincode" maxlength="6" >
                                    <label for="pincode">Pincode</label>
                                </div>
                                @if ($errors->has('pincode'))
                                <div class="alert alert-danger">{{ $errors->first('pincode') }}</div>
                             @endif
                            </div>


                              <div class="col-12">
                                  <div class="form-floating">
                                      <textarea name="address" class="form-control border-0" placeholder="Enter Your Address" id="address" style="height: 100px"></textarea>
                                      <label for="address">Address</label>
                                  </div>
                                  @if ($errors->has('address'))
                                  <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                               @endif
                              </div>
                              <div class="col-12">
                                <div class="form-floating">
                              <div class="col-sm-6">
                               <div class="captcha"><span>{!! captcha_img() !!}</span></div>
                                <span id="captchaRefresh">Refresh</span>
                              </div>
                              <div class="col-sm-6">
                                <input type="text" name="captcha" class="form-control border-0" id="captcha" placeholder="Enter Captcha">
                               </div>
                                  <label for="captcha">Captcha</label>
                                </div>
                                @if ($errors->has('captcha'))
                                <div class="alert alert-danger">{{ $errors->first('captcha') }}</div>
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

<script>
    $(document).ready(function() {
        //alert('Ankit');
        $('#countries').on('change',function() {
            //alert('Country Selected');
            var countryid = this.value;
            //alert(countryid);
            $('#states').html('');
            $.ajax({
                url:"{{ url('get-states') }}",
                type:"post",
                data:{
                    country_id:countryid,
                    _token:'{{ csrf_token() }}'
                },
                dataType:'json',
                success:function (result) {
            $('#states').html('<option value="0">Select State</option>');
                    $.each(result.state, function(key,value){
                        $('#states').append('<option value="'+ value.state_id +'">'+ value.state_name +'</option>')
                    });
                }
            })
        });

        $('#states').on('change',function() {
            //alert('Country Selected');
            var stateid = this.value;
            //alert(countryid);
            $('#cities').html('');
            $.ajax({
                url:"{{ url('get-cities') }}",
                type:"post",
                data:{
                    state_id:stateid,
                    _token:'{{ csrf_token() }}'
                },
                dataType:'json',
                success:function (resultcities) {
                    $('#cities').html('<option value="0">Select City</option>');
                    $.each(resultcities.cities, function(key,value){
                        $('#cities').append('<option value="'+ value.city_id +'">'+ value.city_name +'</option>')
                    });
                }
            })
        });
        $('#captchaRefresh').on('click', function(){
           // alert('ankit');
           $.ajax({
                url:"{{ url('get-new-captcha') }}",
                type:"get",
                data:{
                    _token:'{{ csrf_token() }}'
                },
                dataType:'json',
                success:function (result) {
                  //  alert('result back');
                    $('.captcha span').html(result.captcha);
                }
             });
        });

    });
</script>

@endsection

