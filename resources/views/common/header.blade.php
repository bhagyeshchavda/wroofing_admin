<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li> 
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" target="_blank" href="{{ route('home') }}">
                {{-- {{ __('Logout') }} --}}
                <i class="fas fa-external-link-alt"></i> 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
        <li class="nav-item dropdown">
            <div class="dropdown">
                
                <a href="" class="dropdown-toggle text-nowrap" data-toggle="dropdown" aria-expanded="false" data-offset="5,15">
                    @if(Auth::user()->profile_image != '')
                    <img style="margin: 4px; border-radius: 50%;" class="dropdown-toggle-avatar" src="{{ asset(Auth::user()->profile_image) }}" alt="User avatar" width="30" height="30">
                    @else
                    <img style="margin: 4px; border-radius: 50%;" class="dropdown-toggle-avatar" src="{{ asset('user_images/avatar.png') }}" alt="User avatar" width="30" height="30">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                    <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="dropdown-icon fa fa-user"></i> Profile </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();" data-turbolinks="false" class="dropdown-item auth-logout"><i class="dropdown-icon fa fa-sign-out"></i> Logout </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                        @csrf
                    </form>
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->