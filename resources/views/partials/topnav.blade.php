<form class="form-inline mr-auto" action="">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
<ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Welcome, {{ Auth::user()->name }}</div>
            <a href="#" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile Settings
            </a>
            <div class="dropdown-divider"></div>
            <form class="d-inline dropdown-item has-icon" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-sm text-danger d-inline-block" type="submit"><i
                        class="fas fa-sign-out-alt align-middle">Logout</i>
                </button>
            </form>
        </div>
    </li>
</ul>
