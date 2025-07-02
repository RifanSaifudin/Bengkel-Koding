<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">
    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>

                {{-- Sidebar ADMIN --}}
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dokter') }}" class="nav-link {{ request()->is('admin/dokter*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/pasien') }}" class="nav-link {{ request()->is('admin/pasien*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/poli') }}" class="nav-link {{ request()->is('admin/poli*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>Poli</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/obat') }}" class="nav-link {{ request()->is('admin/obat*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>Obat</p>
                        </a>
                    </li>

                {{-- Sidebar DOKTER --}}
                @elseif(auth()->check() && auth()->user()->role == 'dokter')
                    <li class="nav-item">
                        <a href="{{ url('dokter') }}" class="nav-link {{ request()->is('dokter') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dokter/periksa') }}" class="nav-link {{ request()->is('dokter/periksa*') ? 'active' : '' }}">
                            <i class="fas fa-stethoscope nav-icon"></i>
                            <p>Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dokter/obat') }}" class="nav-link {{ request()->is('dokter/obat*') ? 'active' : '' }}">
                            <i class="fas fa-pills nav-icon"></i>
                            <p>Obat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('dokter/jadwal') }}" class="nav-link {{ request()->is('dokter/jadwal*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p>Jadwal Periksa</p>
                        </a>
                    </li>

                {{-- Sidebar PASIEN --}}
                @elseif(auth()->check() && auth()->user()->role == 'pasien')
                    <li class="nav-item">
                        <a href="{{ url('pasien') }}" class="nav-link {{ request()->is('pasien') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('pasien/periksa') }}" class="nav-link {{ request()->is('pasien/periksa*') ? 'active' : '' }}">
                            <i class="fas fa-notes-medical nav-icon"></i>
                            <p>Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('pasien/riwayat') }}" class="nav-link {{ request()->is('pasien/riwayat*') ? 'active' : '' }}">
                            <i class="fas fa-history nav-icon"></i>
                            <p>Riwayat</p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>
