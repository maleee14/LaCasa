<div class="site-navbar mt-4">
    <div class="container py-1">
        <div class="row align-items-center">
            <div class="col-8 col-md-8 col-lg-4">
                <h1 class="mb-0"><a href="{{ url('/') }}" class="text-white h2 mb-0"><strong>La<span
                                class="text-success">Casa</span></strong></a></h1>
            </div>
            <div class="col-4 col-md-4 col-lg-8">
                <nav class="site-navigation text-right text-md-right" role="navigation">

                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                            class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a>
                    </div>

                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                        <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
                            <a href="{{ url('/home') }}">Home</a>
                        </li>
                        {{-- <li class="{{ Request::is('properties/buy') ? 'active' : '' }}"><a
                                href="{{ route('buy.property') }}">Buy</a></li>
                        <li class="{{ Request::is('properties/rent') ? 'active' : '' }}"><a
                                href="{{ route('rent.property') }}">Rent</a></li> --}}
                        <li class="has-children {{ Request::routeIs('display.property.hometype') ? 'active' : '' }}">
                            <a href="#">Properties</a>
                            <ul class="dropdown arrow-top">
                                @foreach ($homeTypes as $homeType)
                                    <li><a
                                            href="{{ route('display.property.hometype', $homeType->hometypes) }}">{{ $homeType->hometypes }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About</a>
                        </li>
                        <li class="{{ Request::is('contact') ? 'active' : '' }}"><a
                                href="{{ route('contact') }}">Contact</a></li>

                        @guest
                            @if (Route::has('login'))
                                <li class="{{ Request::is('login') ? 'active' : '' }}"><a
                                        href="{{ route('login') }}">Login</a></li>
                            @endif
                            @if (Route::has('register'))
                                <li class="{{ Request::is('register') ? 'active' : '' }}"><a
                                        href="{{ route('register') }}">Register</a></li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('users.favorites') }}">
                                        Favorite Properties
                                    </a>
                                    <a class="dropdown-item" href="{{ route('users.requests') }}">
                                        All Request
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
