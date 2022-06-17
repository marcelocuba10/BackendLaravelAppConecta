
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="/tema/img/profile_small.jpg"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">@if(Auth::check()) {{Auth::user()->username}} @endif</span>
                        <span class="text-muted text-xs block">                            
                            @if (Auth::guard('web')->check())
                                {{ Auth::guard('web')->user()->getRoleNames()[0] }}
                            @endif<b class="caret"></b></span>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="{{ route('users_.show.profile', Auth::user()->id) }}">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Contacts</a></li>
                            <li><a class="dropdown-item" href="#">Mailbox</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/user/logout/">Logout</a></li>
                        </ul>
                    </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="#">
                <a href="/user/dashboard"><i class="fa fa-line-chart" aria-hidden="true"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="#">
                <a href="/user/users"><i class="fa fa-user" aria-hidden="true"></i>Clientes<span class="nav-label"></span></a>
            </li>
            <li class="#">
                <a href="/user/grounds"><i class="fa fa-cubes" aria-hidden="true"></i>Canchas<span class="nav-label"></span></a>
            </li>
            <li class="#">
                <a href="/user/bookings"><i class="fa fa-bookmark" aria-hidden="true"></i> <span class="nav-label">Reservas</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-university" aria-hidden="true"></i> <span class="nav-label">Movimientos</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">Entrada</a></li>
                    <li><a href="#">Salida</a></li>
                </ul>
            </li>
            <li class="#">
                <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="nav-label">Informes</span></a>
            </li>
            <li class="#">
                <a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> <span class="nav-label">FAQ</span></a>
            </li>
            <li class="#">
                <a href="#"><i class="fa fa-life-ring" aria-hidden="true"></i> <span class="nav-label">Support</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span class="nav-label">Configuraciones</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">General Settings</a></li>
                    @can('user-list')
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
                    <li><a href="{{ route('users_.show.profile', Auth::user()->id) }}">Mi Cuenta</a></li>
                </ul>
            </li>
            <li>
                @auth
                    <a href="/user/logout/"><i class="fa fa-sign-out"></i> Logout</a>
                @endauth
            </li>
        </ul>

    </div>
</nav>
 