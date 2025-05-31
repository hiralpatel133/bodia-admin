<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link text-center">
      @php
          $settings = \App\Models\SiteSetting::first();
      @endphp
      <div class="d-flex justify-content-center py-2">
          <img src="{{ $settings && $settings->site_logo ? asset('storage/' . $settings->site_logo) : asset('dist/img/AdminLTELogo.png') }}" 
               alt="{{ $settings->site_name ?? 'Admin' }}" 
               style="width: auto; height: 40px;">
      </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.email-templates.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.email-templates.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Common Modules
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                  <p>Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.email-templates.index') }}" class="nav-link {{ request()->routeIs('admin.email-templates.*') ? 'active' : '' }}">
                  <p>Email Templates</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Manage Users</p>
            </a>
          </li>
          <li class="nav-item">
            <form id="frm_sidebar_logout" class="d-none" method="POST" action="{{ route('dashboard.logout') }}">
              @csrf
              <button type="submit">Logout</button>
            </form>
            <a href="javascript:void(0);" class="nav-link" onclick="document.getElementById('frm_sidebar_logout').submit();">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>Logout</p>
            </a>
          </li>          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>