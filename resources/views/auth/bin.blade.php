{{-- 
<script>
    $(function() {  
        $('#year').yearpicker();
    });
</script>

@section('content')

<div class="row reg-sec">
    <div class="col-md-12 col-lg-12 form-register mx-auto">
        <div class="d-flex justify-content-center ">
            <div class="reg-section-content-image">
                <img src="{{asset('NBA/public/assets/home/logo-2.png')}}" alt="">
                <h2>Ikeja branch</h2>
            </div>
        </div>
        <h2 class="header-text mt-5 mb-4">Register</h2>
        <div class="">

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">


                    <div class="mb-3 col-md-6">
                        <label for="title" class="form-label">Select your title</label>
                        <select name="title" id="title" class="form-control" required>
                            <option disabled selected>select your title</option>
                            <option value="Mr">Mr</option>
                            <option value="Ms">Ms</option>
                             <option value="Mrs">Mrs</option>
                            <option value="Dr">Dr</option>
                            <option value="Prof">Prof</option>
                            <option value="Justice">Justice</option>
                        </select>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="role" class="form-label">Select your role</label>
                        <select name="role" id="role"  class="form-control" required>
                            <option  disabled selected>select your role</option>
                            <option value="Lawyer" >Lawyer</option>
                            <option value="Bencher">Bencher</option>
                            <option value="SAN" >SAN</option>
                            
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="firstname"  class="form-label">First name</label>
                        <input type="text" id="firstname" class="form-control" value="{{ old('firstname') }}" name="firstname" required>
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="lastname"  class="form-label">Last name</label>
                        <input type="text" id="lastname" class="form-control" value="{{ old('lastname') }}" name="lastname" required>
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="middlename" class="form-label">Middle name (optional)</label>
                        <input type="text" class="form-control" id="middlename"  value="{{ old('middlename') }}" name="middlename" >
                        @error('middlename')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email"  class="form-label">Email address</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@mail.com" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="year" class="form-label">Year of Call To Bar</label>
                        <input type="text"  id="year" class="form-control" name="year" value="{{ old('year') }}" placeholder="Select year" required>
                        @error('year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="scn" class="form-label">SCN enrolment number</label>
                        <input type="text" id="scn" class="form-control" value="{{ old('scn') }}" name="scn" required>
                        @error('scn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    

                    <div class="mb-3 col-md-6">
                        <label for="phonenumber" class="form-label">Phone number</label>
                        <input type="text"  class="form-control" id="phonenumber" value="{{ old('phonenumber') }}" name="phonenumber" required>
                        @error('phonenumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender"  id="gender" class="form-control" required>
                            <option value="" disabled selected>select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="organisation"  class="form-label">Organization name</label>
                        <input type="text"  class="form-control" value="{{ old('organisation') }}" name="organization" id="organisation">
                        @error('organisation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control"  value="{{ old('address') }}" name="address" id="address">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                   
                    <div class="mb-3 col-md-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"  id="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="at least 8 characters" required>
                        @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="password-confirm"  class="form-label">Retype Password</label>
                        <input type="password" id="password_confirmation"  name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="at least 8 characters" required>
                        @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input " id="exampleCheck1" >
                        <label class="form-check-label my-1" for="exampleCheck1">I agree to the terms and conditions of Ikeja NBA</label>
                    </div>

                  
                </div>
                <button type="submit" class="btn btn-primary w-100 btn-py">Sign Up</button>
            </form>

            <span class="d-flex justify-content-center py-4">Aleady have account? <a href="{{route('login')}}" class="link-a-item ms-1"> Sign in</a> </span>
            {{-- <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection --}}
