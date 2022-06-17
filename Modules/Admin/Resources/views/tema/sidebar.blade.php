
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="/tema/img/profile_small.jpg"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">@if (Auth::check()) {{ Auth::user()->username }} @endif</span>
                        <span class="text-muted text-xs block">                            
                            @if (Auth::guard('admin')->check())
                                {{ Auth::guard('admin')->user()->getRoleNames()[0] }}
                            @endif<b class="caret"></b></span>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="{{ route('users.show.profile', Auth::user()->id) }}">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Contacts</a></li>
                            <li><a class="dropdown-item" href="#">Mailbox</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/admin/logout/">Logout</a></li>
                        </ul>
                    </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="#">
                <a href="/admin/dashboard"><i class="fa fa-line-chart" aria-hidden="true"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            @can('super_user-list')
            <li class="#">
                <a href="{{ route('partners.index') }}"><i class="fa fa-users" aria-hidden="true"></i> <span class="nav-label">Clientes</span></a>
            </li>
            @endcan
            <li class="#">
                <a href="#"><i class="fa fa-clone" aria-hidden="true"></i> <span class="nav-label">Usuarios</span></a>
            </li>
            <li class="#">
                <a href="#"><i class="fa fa-circle-o-notch" aria-hidden="true"></i> <span class="nav-label">Canchas</span></a>
            </li>
            <li class="#">
                <a href="#"><i class="fa fa-arrow-left" aria-hidden="true"></i> <span class="nav-label">Reservas</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-university" aria-hidden="true"></i> <span class="nav-label">Movimientos</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">Entrada</a></li>
                    <li><a href="#">Salida</a></li>
                </ul>
            </li>
            <li class="#">
                <a href="#"><i class="fa fa-sitemap" aria-hidden="true"></i> <span class="nav-label">Pagos</span></a>
            </li>
            <li class="#">
                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="nav-label">Reports</span></a>
            </li>
            <li class="#">
                <a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> <span class="nav-label">FAQ</span></a>
            </li>
            <li class="#">
                <a href="#"><i class="fa fa-life-ring" aria-hidden="true"></i> <span class="nav-label">Support</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span class="nav-label">Settings</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    @can('super_user-list')
                    <li class="#">
                        <a href="{{ route('users.index') }}"><span class="nav-label">Users</span></a>
                    </li>
                    @endcan
                    @can('role-list')
                    <li>
                        <a href="#"><span class="nav-label">ACL</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @can('role-list')
                            <li><a href="{{ route('roles.index') }}">Roles</a></li>
                            @endcan
                            @can('permission-list')
                            <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    <li><a href="#">General Settings</a></li>
                    <li><a href="{{ route('users.show.profile', Auth::user()->id) }}">My Profile</a></li>
                </ul>
            </li>
            <li>
                @auth
                    <a href="/admin/logout/"><i class="fa fa-sign-out"></i> Logout</a>
                @endauth
            </li>
        </ul>

    </div>
</nav>
 