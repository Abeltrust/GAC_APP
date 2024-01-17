<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('assets/images/logo.png')}}" class="logo" alt="">
            {{-- {{ config('app.name', 'Laravel') }} --}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a href="" class="nav-link">Executives</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a href=""  class="nav-link">About us</a>
                    </li>
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn btn-primary-outline px-4" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                        </li>
                    @endif
                    {{-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-primary-outline px-4" href="{{ route('register') }}">{{ __('Sign in') }}</a>
                        </li>
                    @endif --}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>