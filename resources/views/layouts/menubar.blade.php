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
                <a class="navbar-brand" href="#" oncontextmenu="return false">
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
                    <li><a href="{{ route('login') }}" oncontextmenu="return false">Login</a></li>
                    <li><a href="{{ route('register') }}" oncontextmenu="return false">Register</a></li>
                @else
                <ul class="nav navbar-nav nav-bar-left">
                    @if(auth()->user()->privilege === 'admin')
                    <li><a href="/users/create" oncontextmenu="return false"><i class="fas fa-user-plus"></i>&nbspRegister</a></li>
                    <li><a href="/users/" oncontextmenu="return false"><i class="fas fa-user-circle"></i>&nbspUsers</a></li>
                    @endif
                    @if(auth()->user()->privilege === 'owner')
                    <li><a href="/dashboard" oncontextmenu="return false"><i class="fas fa-chalkboard"></i>&nbspDashboard</a></li>
                    <li><a href="/payments" oncontextmenu="return false"><i class="fas fa-hand-holding-usd"></i>&nbspRemittances</a></li>
                    <li><a href="/owners/{{auth()->user()->user_owner_id}}" oncontextmenu="return false"><i class="far fa-id-card"></i>&nbspProfile</a></li>
                    @endif
                    @if(auth()->user()->privilege === 'leasingOfficer'  )
                    <li><a href="/home" oncontextmenu="return false"><i class="fas fa-chalkboard"></i>&nbspDashboard</a></li>
                    <li><a href="/rooms" oncontextmenu="return false"><i class="fas fa-home"></i>&nbspRooms</a></li>
                    <li><a href="/residents" oncontextmenu="return false"><i class="fas fa-users"></i>&nbspResidents</a></li>
                    <li><a href="/owners" oncontextmenu="return false"><i class="fas fa-user-tie"></i>&nbspOwners</a></li>
                    @endif

                    @if( auth()->user()->privilege === 'leasingManager' )
                    <li><a href="/dashboard" oncontextmenu="return false"><i class="fas fa-chalkboard"></i>&nbspDashboard</a></li>
                    <li><a href="/rooms" oncontextmenu="return false"><i class="fas fa-home"></i>&nbspRooms</a></li>
                    <li><a href="/residents" oncontextmenu="return false"><i class="fas fa-users"></i>&nbspResidents</a></li>
                    <li><a href="/owners" oncontextmenu="return false"><i class="fas fa-user-tie"></i>&nbspOwners</a></li>
                    @endif

                    @if( auth()->user()->privilege === 'treasury' )
                    <li><a href="/dashboard" oncontextmenu="return false"><i class="fas fa-chalkboard"></i>&nbspDashboard</a></li>
                    <li><a href="/payments" oncontextmenu="return false"><i class="fas fa-search"></i>&nbspSearch</a></li>
                    @endif
                </ul>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" oncontextmenu="return false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                             <li>
                                <a href="/users/{{ auth()->user()->user_id }}" oncontextmenu="return false">My Account</a>
                            </li> 
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();" oncontextmenu="return false">
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