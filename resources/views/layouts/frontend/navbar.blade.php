<!-- Navbar Start -->
<header id="topnav" class="defaultscroll sticky">
    <div class="container">
        <!-- Logo container-->
        <a class="logo" href="index.html">
            <img src="{{ asset('default') }}/logo.png" height="44" class="logo-light-mode" alt="logo">
            <img src="{{ asset('default') }}/logo.png" height="44" class="logo-dark-mode" alt="logo">
        </a>
        <!-- Logo End -->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <!--Login button Start-->
        <ul class="buy-button list-inline mb-0">
            @guest
                @if (Route::has('login'))
                <li class="list-inline-item mb-0">
                    <a href="{{ route('login') }}" class="login-btn-primary btn btn-primary">Masuk</a>
                    <a href="{{ route('login') }}" class="login-btn-light btn btn-light">Masuk</a>
                </li>
                @endif
            @else
                <li class="list-inline-item mb-0">
                    <div class="dropdown dropdown-primary">
                        <button type="button" class="login-btn-primary btn btn-icon btn-pills btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="user" class="icons"></i></button>
                        <button type="button" class="login-btn-light btn btn-icon btn-pills btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="user" class="icons"></i></button>
                        <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 py-3" style="width: 200px;">
                            @if (Auth::user()->hasRole('admin'))
                                <a class="dropdown-item text-dark" href="{{ route('dashboard') }}"><i class="uil uil-estate align-middle me-1"></i> Dashboard</a>
                            @else
                                <a class="dropdown-item text-dark" href="{{ route('account.index') }}"><i class="uil uil-user align-middle me-1"></i> Akun Anda</a>
                                <a class="dropdown-item text-dark" href="{{ route('histories') }}"><i class="uil uil-clipboard-notes align-middle me-1"></i> Riwayat Booking</a>
                                <a class="dropdown-item text-dark" href="{{ route('changepassword.index') }}"><i class="uil uil-key-skeleton align-middle me-1"></i> Ganti Kata Sandi</a>
                            @endif
                            <div class="dropdown-divider my-3 border-top"></div>
                            <a class="dropdown-item text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="uil uil-sign-out-alt align-middle me-1"></i> Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            @endguest
        </ul>
        <!--Login button End-->

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu nav-light">
                <li><a href="{{ route('/') }}" class="sub-menu-item {{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="#about" class="sub-menu-item {{ Request::is('#about') ? 'active' : '' }}">Tentang</a></li>
                <li><a href="#package" class="sub-menu-item {{ Request::is('#package') ? 'active' : '' }}">Paket</a></li>
                <li><a href="{{ route('booking') }}" class="sub-menu-item {{ Request::is('booking') ? 'active' : '' }}">Booking</a></li>
            </ul><!--end navigation menu-->
        </div><!--end navigation-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->
