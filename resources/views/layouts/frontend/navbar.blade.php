<!-- Navbar Start -->
<header id="topnav" class="defaultscroll sticky">
    <div class="container">
        <!-- Logo container-->
        <a class="logo" href="index.html">
            <span class="logo-light-mode">
                <img src="{{ asset('frontend') }}/images/logo-dark.png" class="l-dark" height="24" alt="">
                <img src="{{ asset('frontend') }}/images/logo-light.png" class="l-light" height="24" alt="">
            </span>
            <img src="{{ asset('frontend') }}/images/logo-light.png" height="24" class="logo-dark-mode" alt="">
        </a>

        <!-- End Logo container-->
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
            <li class="list-inline-item ps-1 mb-0">
                <div class="dropdown">
                    <button type="button" class="login-btn-primary btn btn-icon btn-pills btn-soft-primary btn dropdown-toggle p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="search" class="fea icon-sm"></i>
                    </button>
                    <button type="button" class="login-btn-light btn btn-icon btn-pills btn-light btn dropdown-toggle p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="search" class="fea icon-sm"></i>
                    </button>
                    <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 p-0" style="width: 300px;">
                        <div class="search-bar">
                            <div id="itemSearch" class="menu-search mb-0">
                                <form action="" method="get" id="searchItemform" class="searchform">
                                    <input type="text" class="form-control border rounded" name="key" id="searchItem" placeholder="Search...">
                                    <input type="submit" id="searchItemsubmit" value="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

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
                                <a class="dropdown-item text-dark" href=""><i class="uil uil-user align-middle me-1"></i> Akun Anda</a>
                                <a class="dropdown-item text-dark" href=""><i class="uil uil-money-bill align-middle me-1"></i> Riwayat Pembayaran</a>
                                <a class="dropdown-item text-dark" href=""><i class="uil uil-clipboard-notes align-middle me-1"></i> Riwayat Pesanan</a>
                                <a class="dropdown-item text-dark" href=""><i class="uil uil-key-skeleton align-middle me-1"></i> Ganti Kata Sandi</a>
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
                <li><a href="" class="sub-menu-item">Beranda</a></li>
                <li><a href="" class="sub-menu-item">Tentang</a></li>
                <li><a href="" class="sub-menu-item">Booking</a></li>
                <li><a href="" class="sub-menu-item">SQA</a></li>
            </ul><!--end navigation menu-->
        </div><!--end navigation-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->
