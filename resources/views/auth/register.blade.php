{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}"  enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layouts.guest')


<link rel="stylesheet" href="{{asset('assets/css/yearpicker.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('assets/js/yearpicker.js')}}" async></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js" defer></script>


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    
                    <div class="text-center mt-3 mb-3"><h3>{{ __('Register') }}</h3></div>

                    <!-- Navigation Bar with Section Tracker -->
                   

                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                            <h5>Personal Information</h5>
                            <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="email" class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <label for="phoneNumber">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" value="{{ old('phoneNumber') }}" id="phoneNumber" name="phoneNumber">
                                        @error('phoneNumber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="gender">Gender <span class="text-danger">*</span></label>
                                        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                             <option value="" selected disabled>Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="row mb-3">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="maritalStatus">Marital Status <span class="text-danger">*</span></label>
                                        <select class="form-control form-control @error('maritalStatus') is-invalid @enderror" id="maritalStatus" name="maritalStatus">
                                            <option value="" selected disabled>Select marital status</option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                            <option value="divorced">Divorced</option>
                                            <option value="widowed">Widowed</option>
                                        </select>
                                        @error('maritalStatus')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                            <label for="userImage">Upload Image<span class="text-danger">*</span> <span><strong>(not larger than 3mb) </strong></strong></span></label>
                                            <input type="file" class="form-control @error('userImage') is-invalid @enderror" id="userImage" value="{{ old('userImage') }}" name="userImage">
                                            @error('userImage')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                           @enderror
                                    </div>
                                </div>

                              
                            <h5>Work Information</h5>
                            <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <label for="staffId">Staff ID <span class="text-danger">*</span></label>
                                        <input type="text"  class="form-control @error('staffId') is-invalid @enderror" id="staffId" value="{{ old('staffId') }}" name="staffId">
                                        @error('staffId')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="Department">Department <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('Department') is-invalid @enderror" id="Department" value="{{ old('Department') }}" name="Department">
                                        @error('Department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- <div class="form-group col-md-12 mb-2">
                                            <label for="monthlyDeduction">Amount to be Deducted Monthly <span class="text-danger">*</span> <span>minimum 2,000</span></label>
                                            <input type="number" class="form-control @error('monthlyDeduction') is-invalid @enderror" id="monthlyDeduction" min="2000" value="{{ old('monthlyDeduction') }}" name="monthlyDeduction">
                                            @error('monthlyDeduction')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                           @enderror
                                    </div> -->
                                </div>
                             
                            <h5>Next Of Kin Information</h5>
                            <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <label for="nextOfKinFullName">Next of Kin's Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nextOfKinFullName') is-invalid @enderror" id="nextOfKinFullName" value="{{ old('nextOfKinFullName') }}" name="nextOfKinFullName">
                                        @error('nextOfKinFullName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="nextOfKinPhoneNumber">Next of Kin's Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('nextOfKinPhoneNumber') is-invalid @enderror" value="{{ old('nextOfKinPhoneNumber') }}" id="nextOfKinPhoneNumber" name="nextOfKinPhoneNumber">
                                        @error('nextOfKinPhoneNumber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="nextOfKinAddress">Next of Kin's Address <span class="text-danger">*</span></label>
                                            <textarea type="text" class="form-control @error('nextOfKinAddress') is-invalid @enderror" id="nextOfKinAddress" value="{{ old('nextOfKinAddress') }}" name="nextOfKinAddress"></textarea>
                                            @error('nextOfKinAddress')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                               </div>

                            <h5>Password</h5>
                            <hr>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                 </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                   <div class=" col-md-6 ">
                                     <div class="form-check">
                                        <input class="form-check-input" requiered type="checkbox" name="agree" >
                                        <label class="form-check-label my-1" for="agree">
                                            {{ __('I agree to terms and conditions.') }}
                                        </label>
                                     </div>
                                  </div>
                                    <div class="col-md-6">
                                        Have an account?   <a class="link-a-item" href="{{ route('login') }}">{{ __('Login Here...') }}</a>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn btn-primary mb-3 w-100">Register</button>
                                    </div>
                                </div>
                                
                             </form>
                         </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
