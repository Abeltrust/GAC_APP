<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('NBA/public/assets/home/logo.png')}}" class="logo" alt="">
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

                <li class="nav-item">
                    <a href="" class="nav-link">Executives</a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">Blog</a>
                </li>
                
                    <a href=""  class="nav-link">About us</a>
                </li>
                @guest
                    

                    
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

                    
                        <li class="nav-item">
                                <a href="{{route('settings')}}" class="nav-link {{'settings'== request()->path()?'active':''}} ">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary px-4" href=""
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            >
                            {{ __('Sign out') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                   
                @endguest
            </ul>
        </div>
    </div>
</nav>
