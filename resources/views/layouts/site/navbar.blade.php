<header class="header">
    <a href="/" class="navbar-logo w-full block py-5" style="width: 185px;position:absolute">
        <img style="margin-top: -12px;margin-left: 20px;" src="/img/conectacode.png" alt="logo" class="w-full header-logo" />
    </a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="#contact">Contact</a></li>
        <li>
            @guest
            <a href="/user/login">
                Iniciar Sesión
            </a>
            {{-- <a href="#">
                Registrar Cuenta
            </a> --}}
            @endguest
        </li>
        <li>
            @auth
            <a href="/user/dashboard">
                {{auth()->user()->name}}
            </a>
            @endauth
        </li>
        <li>
            @auth
            <a href="/user/logout">
                Cerrar Sesión
            </a>
            @endauth
        </li>
    </ul>
</header>