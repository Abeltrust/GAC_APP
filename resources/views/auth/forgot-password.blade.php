{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.guest')

@section('content')


<div class="row reg-sec">
    <div class="col-md-12 col-lg-6 reg-section-1">
        <div class="reg-section-content-image">
            <img src="{{asset('assets/home/logo-2.png')}}" alt="">
            <h2>Ikeja branch</h2>
        </div>

        <div>
            <ul class="list">
                <li class="list-item">
                    <div class="box-rounded-dot"></div>
                    Pay your bar dues
                </li>
                <li class="list-item">
                    <div class="box-rounded-dot"></div>
                    Membership sign up
                </li>
                <li class="list-item">
                    <div class="box-rounded-dot"></div>
                    FAQs
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 form-login">
        <h2 class="header-text">Forgot password</h2>
        <h6 class="welcome-text">A reset password link will be sent to your registered email.</h6>
        <div class="">

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                
                <button type="submit " class="btn btn-primary w-100 btn-py mt-4">  {{ __('Send reset link') }}</button>
            </form>

           
        </div>
    </div>
</div>
@endsection

