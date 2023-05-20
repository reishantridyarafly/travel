<!-- sidebar-wrapper -->
<nav id="sidebar" class="sidebar-wrapper sidebar-dark">
    <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">
        <div class="sidebar-brand">
            <a href="">
                <img src="{{ asset('backend') }}/images/logo-dark.png" height="24" class="logo-light-mode" alt="">
                <img src="{{ asset('backend') }}/images/logo-light.png" height="24" class="logo-dark-mode" alt="">
                <span class="sidebar-colored">
                    <img src="{{ asset('backend') }}/images/logo-light.png" height="24" alt="">
                </span>
            </a>
        </div>

        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}"><i class="uil uil-estate me-2"></i>Dashboard</a></li>
            <li><a href="{{ route('packages.index') }}"><i class="uil uil-package me-2"></i>Paket</a></li>
            <li><a href=""><i class="uil uil-receipt me-2"></i>Booking</a></li>
            <li><a href=""><i class="uil uil-transaction me-2"></i>Transaksi</a></li>
            <li><a href="{{ route('customers.index') }}"><i class="uil uil-users-alt me-2"></i>Pelanggan</a></li>
            <li><a href=""><i class="uil uil-folder me-2"></i>Laporan</a></li>
            <li><a href="{{ route('payments.index') }}"><i class="uil uil-credit-card me-2"></i>Payment</a></li>
            <li class="sidebar-dropdown">
                <a href="javascript:void(0)"><i class="uil uil-user me-2"></i>Akun</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{ route('profile.index') }}">Profil</a></li>
                        <li><a href="{{ route('change-password.index') }}">Ganti Kata Sandi</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
<!-- sidebar-wrapper  -->
