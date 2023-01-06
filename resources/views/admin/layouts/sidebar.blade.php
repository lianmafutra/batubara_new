<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/logo_kota.png') }}" alt="{{ Setting::getName('app_name') }}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ Setting::getValue('app_short_name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-compact"
                data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>@php $i = 1; @endphp
                @canany(['read user', 'read role', 'read permission'])
                    <li class="nav-header ml-2">App</li>
                @endcanany
                @can('read user')
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                            <i class="fas fa-user nav-icon"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endcan
                @can('read role')
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}"
                            class="nav-link {{ request()->routeIs('role.index') ? 'active' : '' }}">
                            <i class="fas fa-user-cog nav-icon"></i>
                            <p>Role</p>
                        </a>
                    </li>
                @endcan
                @can('read permission')
                    <li class="nav-item">
                        <a href="{{ route('permission.index') }}"
                            class="nav-link {{ request()->routeIs('permission.index') ? 'active' : '' }}">
                            <i class="fas fa-unlock nav-icon"></i>
                            <p>Permission</p>
                        </a>
                    </li>
                @endcan
                @can('read setting')
                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}"
                            class="nav-link {{ request()->routeIs('setting.index') ? 'active' : '' }}">
                            <i class="fas fa-cog nav-icon"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                @endcan
                @can('master user')
                    <li class="nav-item">
                        <a href=""
                            class="nav-link {{ request()->routeIs('master-user*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p> Master User </p>
                        </a>
                    </li>
                @endcan
                @can('profile menu')
                    <li class="nav-item">
                        <a href="{{ route('profile.index') }}"
                            class="nav-link {{ request()->routeIs('profil*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                @endcan
               
                <li class="nav-header ml-2">Manajemen DO</li>
                @can('pengajuan verifikasi index')
                    <li class="nav-item menu-is-opening {{ request()->is('admin/kendaraan*') ? 'menu-open' : '' }} ">
                        <a href="" class="nav-link {{ request()->is('admin/kendaraan*') ? 'active' : '' }}">
                           <i class="fas fa-truck nav-icon"></i>
                            <p>Data Kendaraan</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('mobil.index') }}"
                                    class="nav-link {{ request()->routeIs('mobil*') ? 'active' : '' }}">
                                    <i class="fas fa-car nav-icon"></i>
                                    <p>Mobil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href=""
                                    class="nav-link {{ request()->routeIs('supir*') ? 'active' : '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Supir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                  <a href="" class="nav-link">
                     <i class="fas fa-warehouse nav-icon"></i>
                      <p>Master Transportir</p>
                  </a>
              </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                     <i class="fas fa-road nav-icon"></i>
                        <p>Master Tujuan</p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link">
                     <i class="fas fa-list-ul nav-icon"></i>
                      <p>Master Harga</p>
                  </a>
              </li>
              <li class="nav-header ml-2">Transaksi DO</li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                     <i class="fas fa-shopping-cart nav-icon"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                     <i class="fas fa-hand-holding-usd nav-icon"></i>
                        <p>Pencairan</p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link">
                     <i class="fas fa-file-alt nav-icon"></i>
                      <p>Laporan</p>
                  </a>
              </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
