{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.guest')
@section('content')

<div class="row reg-sec">
    <div class="col-md-12 col-lg-6 reg-section-1">
        <div class="reg-section-content-image">
            <img src="{{asset('/assets/home/logo-2.png')}}" alt="">
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
        <h2 class="header-text">Sign in</h2>
        <h6 class="welcome-text">Welcome back!</h6>
        <div class="">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email / Phone / SCN</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" placeholder="name@mail.com" >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="at least 8 characters">
                    @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="d-flex justify-content-between">

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" requied>
                        <label class="form-check-label my-1" for="exampleCheck1">Remember me</label>
                    </div>

                    <div>
                        <a href="{{route('password.request')}}" class="link-a-item">Forgot Password?</a>
                    </div>
                </div>
                <button type="submit " class="btn btn-primary w-100 btn-py">Submit</button>
            </form>

            <span class="d-flex justify-content-center py-4">Don't have account? <a href="{{route('register')}}" class="link-a-item ms-1"> Sign Up</a> </span>
        </div>
    </div>
</div>

@endsection
@section('footer')
 @include('layouts.app-footer')
@endsection
