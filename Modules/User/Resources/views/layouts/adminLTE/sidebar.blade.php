  <!-- ======== sidebar-nav start =========== -->
  <aside class="sidebar-nav-wrapper style-2">
    <div class="navbar-logo">
      <a href="/">
        <img src="/img/logo-300x90.png" alt="logo" width="175px" height="58px"/>
      </a>
    </div>
    <nav class="sidebar-nav">
      <ul>
        <li class="nav-item {{ (request()->is('user/dashboard')) ? 'active' : '' }}">
          <a href="/user/dashboard">
            <span class="icon">
              <svg width="22" height="22" viewBox="0 0 22 22">
                <path d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z" />
              </svg>
            </span>
            <span class="text">Dashboard</span>
          </a>
        </li>
        @can('schedule-list')
        <li class="nav-item {{ (request()->is('user/schedules')) ? 'active' : '' }}">
          <a href="/user/schedules">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M15,13H16.5V15.82L18.94,17.23L18.19,18.53L15,16.69V13M19,8H5V19H9.67C9.24,18.09 9,17.07 9,16A7,7 0 0,1 16,9C17.07,9 18.09,9.24 19,9.67V8M5,21C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3H6V1H8V3H16V1H18V3H19A2,2 0 0,1 21,5V11.1C22.24,12.36 23,14.09 23,16A7,7 0 0,1 16,23C14.09,23 12.36,22.24 11.1,21H5M16,11.15A4.85,4.85 0 0,0 11.15,16C11.15,18.68 13.32,20.85 16,20.85A4.85,4.85 0 0,0 20.85,16C20.85,13.32 18.68,11.15 16,11.15Z" />
              </svg>
            </span>
            <span class="text">Horarios</span>
          </a>
        </li>
        @endcan
        @can('notification-list')
        <li class="nav-item {{ (request()->is('user/notifications')) ? 'active' : '' }}">
          <a href="/user/notifications">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12,23A1,1 0 0,1 11,22V19H7A2,2 0 0,1 5,17V7C5,5.89 5.9,5 7,5H21A2,2 0 0,1 23,7V17A2,2 0 0,1 21,19H16.9L13.2,22.71C13,22.9 12.75,23 12.5,23V23H12M13,17V20.08L16.08,17H21V7H7V17H13M3,15H1V3A2,2 0 0,1 3,1H19V3H3V15Z" />
              </svg>
            </span>
            <span class="text">Avisos</span>
          </a>
        </li>
        @endcan
        @can('machine-list')
        <li class="nav-item {{ (request()->is('user/machines/grid_view')) || (request()->is('user/machines/list')) ? 'active' : '' }}">
          <a href="/user/machines/grid_view">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8,2H16A2,2 0 0,1 18,4V20A2,2 0 0,1 16,22H8A2,2 0 0,1 6,20V4A2,2 0 0,1 8,2M8,4V6H16V4H8M16,8H8V10H16V8M16,18H14V20H16V18Z" />
              </svg>
            </span>
            <span class="text">Máquinas</span>
          </a>
        </li>
        <li class="nav-item {{ (request()->is('user/machines/grid_view_api')) || (request()->is('user/machines/list_api')) ? 'active' : '' }}">
          <a href="/user/machines/grid_view_api">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8,2H16A2,2 0 0,1 18,4V20A2,2 0 0,1 16,22H8A2,2 0 0,1 6,20V4A2,2 0 0,1 8,2M8,4V6H16V4H8M16,8H8V10H16V8M16,18H14V20H16V18Z" />
              </svg>
            </span>
            <span class="text">Máquinas via API</span>
          </a>
        </li>
        {{-- <li class="nav-item {{ (request()->is('user/posts/grid_view')) ? 'active' : '' }}">
          <a href="/user/posts">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8,2H16A2,2 0 0,1 18,4V20A2,2 0 0,1 16,22H8A2,2 0 0,1 6,20V4A2,2 0 0,1 8,2M8,4V6H16V4H8M16,8H8V10H16V8M16,18H14V20H16V18Z" />
              </svg>
            </span>
            <span class="text">teste</span>
          </a>
        </li> --}}
        @endcan
        @can('customer-list')
        <li class="nav-item {{ (request()->is('user/customers')) ? 'active' : '' }}">
          <a href="/user/customers">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12,5A3.5,3.5 0 0,0 8.5,8.5A3.5,3.5 0 0,0 12,12A3.5,3.5 0 0,0 15.5,8.5A3.5,3.5 0 0,0 12,5M12,7A1.5,1.5 0 0,1 13.5,8.5A1.5,1.5 0 0,1 12,10A1.5,1.5 0 0,1 10.5,8.5A1.5,1.5 0 0,1 12,7M5.5,8A2.5,2.5 0 0,0 3,10.5C3,11.44 3.53,12.25 4.29,12.68C4.65,12.88 5.06,13 5.5,13C5.94,13 6.35,12.88 6.71,12.68C7.08,12.47 7.39,12.17 7.62,11.81C6.89,10.86 6.5,9.7 6.5,8.5C6.5,8.41 6.5,8.31 6.5,8.22C6.2,8.08 5.86,8 5.5,8M18.5,8C18.14,8 17.8,8.08 17.5,8.22C17.5,8.31 17.5,8.41 17.5,8.5C17.5,9.7 17.11,10.86 16.38,11.81C16.5,12 16.63,12.15 16.78,12.3C16.94,12.45 17.1,12.58 17.29,12.68C17.65,12.88 18.06,13 18.5,13C18.94,13 19.35,12.88 19.71,12.68C20.47,12.25 21,11.44 21,10.5A2.5,2.5 0 0,0 18.5,8M12,14C9.66,14 5,15.17 5,17.5V19H19V17.5C19,15.17 14.34,14 12,14M4.71,14.55C2.78,14.78 0,15.76 0,17.5V19H3V17.07C3,16.06 3.69,15.22 4.71,14.55M19.29,14.55C20.31,15.22 21,16.06 21,17.07V19H24V17.5C24,15.76 21.22,14.78 19.29,14.55M12,16C13.53,16 15.24,16.5 16.23,17H7.77C8.76,16.5 10.47,16 12,16Z" />
              </svg>
            </span>
            <span class="text">Clientes</span>
          </a>
        </li>
        @endcan
        @can('report-list')
        <li class="nav-item nav-item-has-children">
          <a aria-expanded="false" class="collapsed" id="ddlink_1" href="#" onclick="toggle('ddmenu_1', 'ddlink_1')">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19,3H14.82C14.25,1.44 12.53,0.64 11,1.2C10.14,1.5 9.5,2.16 9.18,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M12,3A1,1 0 0,1 13,4A1,1 0 0,1 12,5A1,1 0 0,1 11,4A1,1 0 0,1 12,3M7,7H17V5H19V19H5V5H7V7M17,11H7V9H17V11M15,15H7V13H15V15Z" />
              </svg>
            </span>
            <span class="text">Relatorios</span>
          </a>
          <ul id="ddmenu_1" class="dropdown-nav" style="{{ (request()->is('user/reports/*')) ? '' : 'display:none' }}">
            <li >
              <a href="/user/reports/customers" class="{{ (request()->is('user/reports/customers')) ? 'active' : '' }}">Clientes</a>
            </li>
            {{-- <li >
              <a href="/user/reports/machines" class="{{ (request()->is('user/reports/machines')) ? 'active' : '' }}">Maquinas</a>
            </li> --}}
            <li >
              <a href="/user/reports/users" class="{{ (request()->is('user/reports/users')) ? 'active' : '' }}">Usuarios</a>
            </li>
            <li >
              <a href="/user/reports/schedules" class="{{ (request()->is('user/reports/schedules')) ? 'active' : '' }}">Horarios</a>
            </li>
          </ul>
        </li>
        @endcan
        <li class="nav-item nav-item-has-children">
          <a aria-expanded="false" class="collapsed" id="ddlink_2" href="#" onclick="toggle('ddmenu_2', 'ddlink_2')">
            <span class="icon">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.21,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z" />
              </svg>
            </span>
            <span class="text">Ajustes</span>
          </a>
          <ul id="ddmenu_2" class="dropdown-nav" style="{{ (request()->is('user/users')) || (request()->is('user/ACL/*')) ? '' : 'display:none'}}">
            @can('user-list')
            <li>
              <a href="/user/users" class="{{ (request()->is('user/users')) ? 'active' : '' }}">
                <span class="text">Usuarios</span>
              </a>
            </li>
            @endcan
            @can('role-list')
            <li>
              <a href="/user/ACL/roles" class="{{ (request()->is('user/ACL/roles')) ? 'active' : '' }}"><span class="text">Roles</span></a>
            </li>
            @endcan
          </ul>
        </li>
      </ul>
    </nav>
  </aside>
  <div class="overlay"></div>  
  <!-- ======== sidebar-nav end =========== -->

  <script type="text/javascript">
    function toggle(ddmenu_1, ddlink_1) {
      var n = document.getElementById(ddmenu_1);
      if (n.style.display != 'none'){
        n.style.display = 'none';
        document.getElementById(ddlink_1).setAttribute('aria-expanded', 'false');
      }else{
        n.style.display = '';
        document.getElementById(ddlink_1).setAttribute('aria-expanded', 'true');
      }
    }
  </script>