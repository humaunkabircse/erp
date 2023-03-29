<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-offcanvas"><i class="fa-solid fa-bars"></i></button>
                <!-- <div class="user-account"> -->
                <div class="loginuser">
                <!-- <img src="{{asset('backend')}}/assets/images/user.png" class="rounded-circle user-photo" alt="User Profile Picture"> -->
                <div class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-left account navaccount">
                        <li>@if(auth()->user()->name) <strong>{{auth()->user()->name}}</strong> @endif</li>
                        <li><a href="professors-profile.html"><i class="fa-solid fa-user"></i>My Profile</a></li>
                        <li><a href="javascript:void(0);"><i class="fa-solid fa-gear"></i>Settings</a></li>
                        <li class="logout">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i>Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>  
                </div>
            </div>         
        </div>

        <div class="navbar-brand">
            <a href="{{route('home')}}"><img src="{{asset('backend')}}/assets/images/logo.png" alt=""></a>
        </div>   
    </div>
</nav>