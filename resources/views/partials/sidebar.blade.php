<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->is('/') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/') }}"><i
                    class="fas fa-columns"></i> <span>Dashboard</span></a></li>
        <li class="{{ request()->is('table') ? 'active' : '' }}"><a href="{{ url('table') }}"><i
                    class="fas fa-table"></i> <span>Tables</span></a></li>
        <li class="menu-header">Users</li>
        <li><a class="nav-link" href="{{ route('admin.user.index') }}"><i class="fas fa-users"></i>
                <span>Users</span></a></li>
        <li class="menu-header">Books</li>
        <li><a class="nav-link" href="{{ route('book.index') }}"><i class="fas fa-book"></i>
                <span>Book</span></a></li>
        <li class="menu-header">Transactions</li>
        <li><a class="nav-link" href="{{ route('transaction.index') }}"><i class="fas fa-hand-holding-usd"></i>
                <span>Transactions</span></a></li>
    </ul>
</aside>
