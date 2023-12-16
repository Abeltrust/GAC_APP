<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top">
    <div class="container d-flex justify-content-between align-items-center" ">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('NBA/public/assets/home/logo.png')}}" class="logo" alt="">
            {{-- {{ config('app.name', 'Laravel') }} --}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav  ms-auto d-block d-md-flex justify-content-between  align-items-center">
               
            {{-- <span class="d-flex justify-content-between  align-items-center"> --}}
                
              
            {{-- </span> --}}

        
                @guest
                    

                    {{-- <li class="nav-item">
                        <a href=""  class="nav-link">Membership area</a>
                    </li> --}}

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
                        @if(auth()->user()->role )
                           
                        @if (auth()->user()->role ==='admin')
                            
                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link {{'dashboard'== request()->path() ? 'active' : ''}}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('members')}}" class="nav-link {{'members'== request()->path()?'active':''}}">Members</a>
                        </li>
                            <li class="nav-item">
                                <a href="{{route('messages')}}" class="nav-link {{'messages'== request()->path()?'active':''}}">Messages</a>
                            </li>
                            <li class="nav-item">
                            <a href="{{route('payments')}}" class="nav-link {{'payments'== request()->path()?'active':''}}">Payments</a>
                        </li>
        
                        <li class="nav-item">
                            <a href="{{route('settings')}}" class="nav-link {{'settings'== request()->path()?'active':''}} ">Settings</a>
                        </li>

                       {{-- <li class="nav-item">
                            <a href="{{route('notification')}}"  class="nav-link {{'notification'== request()->path()?'active':''}}">Notification</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile')}}"  class="nav-link {{'profile'== request()->path()?'active':''}}">Membership area</a>
                        </li>--}}

                        <div class="dropdown d-inline-block " >
                            <button type="button" class="btn header-item border rounded pb-1 menu-size"  id="page-header-user-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    >
                                <span class="d-flex justify-content-between align-items-left" key="t-henry"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <span>
                                        <strong>{{ Auth::user()->name }} </strong> <br/>
                                        {{ Auth::user()-> role }}
                                    </span>
                                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block dropdown-toggle my-3 ml-8"></i>
                                </span>
                            </button>
                                <div class="dropdown-menu dropdown-menu-end menu-size" >
                                    {{-- <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @endif
    

                               
                        @if(auth()->user()->role ==='user')
                        <li class="nav-item">
                            <a href="{{route('notification')}}"  class="nav-link {{'notification'== request()->path()?'active':''}}">Notification</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile')}}"  class="nav-link {{'profile'== request()->path()?'active':''}}">Profile</a>
                        </li>
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
                        @endif

            
            
                        
                        
                        </li>
                    @elseif (auth()->user()->role=='admin')
                            <li class="nav-item">
                                <a href="{{route('dashboard')}}" class="nav-link {{'dashboard'== request()->path() ? 'active' : ''}}">Dashboard</a>
                            </li>
            
                            <li class="nav-item">
                                <a href="{{route('members')}}" class="nav-link {{'members'== request()->path()?'active':''}}">Members</a>
                            </li>
                                <li class="nav-item">
                                    <a href="{{route('messages')}}" class="nav-link {{'messages'== request()->path()?'active':''}}">Messages</a>
                                </li>
            
                            <li class="nav-item">
                                <a href="{{route('payments')}}" class="nav-link {{'payments'== request()->path()?'active':''}}">Payments</a>
                            </li>
            
                            <li class="nav-item">
                                <a href="{{route('settings')}}" class="nav-link {{'settings'== request()->path()?'active':''}} ">Settings</a>
                            </li>

                        <div class="dropdown d-inline-block " >
                        <button type="button" class="btn header-item border rounded pb-1 menu-size"  id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                >
                            <span class="d-flex justify-content-between align-items-left" key="t-henry"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <span>
                                    <strong>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }} </strong> <br/>
                                    {{ Auth::user()-> role }}
                                </span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block dropdown-toggle my-3 ml-8"></i>
                            </span>
                        </button>
                            <div class="dropdown-menu dropdown-menu-end menu-size" >
                                {{-- <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else

                    <li class="nav-item">
                        <a href="{{route('notification')}}"  class="nav-link {{'notification'== request()->path()?'active':''}}">Notification</a>
                    </li>
                        <li class="nav-item">
                            <a href="{{route('profile')}}"  class="nav-link {{'profile'== request()->path()?'active':''}}">Membership area</a>
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

                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
<hr class="mt-0 mb-0" style="border-color: green; height: 1px;">