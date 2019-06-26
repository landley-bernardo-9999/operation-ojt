<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                <ul class="nav navbar-nav nav-bar-left">
                    @if(auth()->user()->privilege === 'admin')
                    <li><a href="/users/"><i class="fas fa-user-circle"></i>&nbspUsers</a></li>
                    @endif
                    @if(auth()->user()->privilege === 'leasingOfficer')
                    <li><a href="/rooms/"><i class="fas fa-home"></i>&nbspRooms</a></li>
                    <li><a href="/residents/"><i class="fas fa-users"></i>&nbspResidents</a></li>
                    <li><a href="/owners/"><i class="fas fa-user-tie"></i>&nbspOwners</a></li>
                    <li><a href="/violations/"><i class="fas fa-user-times"></i>&nbspViolations</a></li>
                    <li><a href="/repairs/"><i class="fas fa-hammer"></i>&nbspRepairs</a></li>
                    <li><a href="/personnels/"><i class="fas fa-user-lock"></i>&nbspPersonnels</a></li>
                    @endif
                </ul>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                             <li>
                                <a href="/users/{{ auth()->user()->user_id }}">My Account</a>
                            </li> 
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                           
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>