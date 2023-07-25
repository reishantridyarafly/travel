<!-- sidebar-wrapper -->
<nav id="sidebar" class="sidebar-wrapper sidebar-dark">
    <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">
        <div class="sidebar-brand">
            <a class="text-center">CV LANGKUY</a>
        </div>

        @php
            $currentUrl = Request::url();
        @endphp

        <ul class="sidebar-menu">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="uil uil-estate me-2"></i>Dashboard</a></li>
            @if (Auth::user()->hasRole('admin'))
            <li class="{{ Request::is('packages*') ? 'active' : '' }}"><a href="{{ route('packages.index') }}"><i class="uil uil-package me-2"></i>Paket</a></li>
            @endif
            <li class="sidebar-dropdown {{ Request::is('booking*') ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="uil uil-receipt me-2"></i>Booking</a>
                <div class="sidebar-submenu" {{ Request::is('booking*') ? 'style=display:block;' : '' }}>
                    <ul>
                        <li class="{{ Request::is('booking_pending*') ? 'active' : '' }}"><a href="{{ route('booking_pending') }}">Booking Pending</a></li>
                        <li class="{{ Request::is('booking_success*') ? 'active' : '' }}"><a href="{{ route('booking_success') }}">Booking Sukses</a></li>
                        <li class="{{ Request::is('booking_failed*') ? 'active' : '' }}"><a href="{{ route('booking_failed') }}">Booking Gagal</a></li>
                    </ul>
                </div>
            </li>
            <li class="{{ Request::is('customers*') ? 'active' : '' }}"><a href="{{ route('customers.index') }}"><i class="uil uil-users-alt me-2"></i>Pelanggan</a></li>
            @if (Auth::user()->hasRole('admin'))
            <li class="sidebar-dropdown {{ Request::is('ratings*') ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="uil uil-star me-2"></i>Rating</a>
                <div class="sidebar-submenu" {{ Request::is('ratings*') ? 'style=display:block;' : '' }}>
                    <ul>
                        <li class="{{ Request::is('ratings/question1*') ? 'active' : '' }}"><a href="{{ route('ratings.question1') }}">Ketersediaan fasilitas dan informasi yang diberikan</a></li>
                        <li class="{{ Request::is('ratings/question2*') ? 'active' : '' }}"><a href="{{ route('ratings.question2') }}">Penampilan Crew Langkuy yang bersih dan rapih</a></li>
                        <li class="{{ Request::is('ratings/question3*') ? 'active' : '' }}"><a href="{{ route('ratings.question3') }}">Perlengkapan dalam memudahkan pelayanan</a></li>
                        <li class="{{ Request::is('ratings/question4*') ? 'active' : '' }}"><a href="{{ route('ratings.question4') }}">Kemudahan prosedur dalam memberikan pelayanan</a></li>
                        <li class="{{ Request::is('ratings/question5*') ? 'active' : '' }}"><a href="{{ route('ratings.question5') }}">Kemudahan memberikan informasi kepada pelanggan</a></li>
                        <li class="{{ Request::is('ratings/question6*') ? 'active' : '' }}"><a href="{{ route('ratings.question6') }}">Crew Langkuy bekerja dengan baik dan memebuhi kebutuhan pelanggan</a></li>
                        <li class="{{ Request::is('ratings/question7*') ? 'active' : '' }}"><a href="{{ route('ratings.question7') }}">Ketepatan waku dan kedisplinan Crew Langkuy</a></li>
                        <li class="{{ Request::is('ratings/question8*') ? 'active' : '' }}"><a href="{{ route('ratings.question8') }}">Rasa tanggungjawab atas pekerjaan Crew Langkuy</a></li>
                        <li class="{{ Request::is('ratings/question9*') ? 'active' : '' }}"><a href="{{ route('ratings.question9') }}">Kesediaan Crew Langkuy untuk membantu pelanggan</a></li>
                        <li class="{{ Request::is('ratings/question10*') ? 'active' : '' }}"><a href="{{ route('ratings.question10') }}">Kesopanan keramahan serta komunikasi yang baik dalam memberikan pelayanan</a></li>
                        <li class="{{ Request::is('ratings/question11*') ? 'active' : '' }}"><a href="{{ route('ratings.question11') }}">Kejaminan fasilitas yang diberikan</a></li>
                        <li class="{{ Request::is('ratings/question12*') ? 'active' : '' }}"><a href="{{ route('ratings.question12') }}">Crew Langkuy memiliki pengetahuan luas tentang destinasi wisata</a></li>
                        <li class="{{ Request::is('ratings/question13*') ? 'active' : '' }}"><a href="{{ route('ratings.question13') }}">Keramahan Crew Langkuy terhadap pelanggan</a></li>
                        <li class="{{ Request::is('ratings/question14*') ? 'active' : '' }}"><a href="{{ route('ratings.question14') }}">Ketersediaan waktu Crew Langkuy dalam mendengan keluhan pelanggan</a></li>
                        <li class="{{ Request::is('ratings/question15*') ? 'active' : '' }}"><a href="{{ route('ratings.question15') }}">Crew Langkuy dapat berkomunikasi dengan baik</a></li>
                    </ul>
                </div>
            </li>
            <li class="{{ Request::is('payments*') ? 'active' : '' }}"><a href="{{ route('payments.index') }}"><i class="uil uil-credit-card me-2"></i>Payment</a></li>
            @endif
            <li class="{{ Request::is('reports') ? 'active' : '' }}"><a href="{{ route('reports') }}"><i class="uil uil-folder me-2"></i>Laporan</a></li>
            <li class="sidebar-dropdown {{ Request::is('akun*') ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="uil uil-user me-2"></i>Akun</a>
                <div class="sidebar-submenu" {{ Request::is('akun*') ? 'style=display:block;' : '' }}>
                    <ul>
                        <li class="{{ Request::is('akun/profile*') ? 'active' : '' }}"><a href="{{ route('profile.index') }}">Profil</a></li>
                        <li class="{{ Request::is('akun/change-password*') ? 'active' : '' }}"><a href="{{ route('change-password.index') }}">Ganti Kata Sandi</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
<!-- sidebar-wrapper  -->
