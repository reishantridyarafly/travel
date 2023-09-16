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
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i
                        class="uil uil-estate me-2"></i>Dashboard</a></li>
            @if (Auth::user()->hasRole('admin'))
                <li class="{{ Request::is('packages*') ? 'active' : '' }}"><a href="{{ route('packages.index') }}"><i
                            class="uil uil-package me-2"></i>Paket</a></li>

                <li class="{{ Request::is('booking*') ? 'active' : '' }}"><a href="{{ route('booking.index') }}"><i
                            class="uil uil-receipt me-2"></i>Booking</a></li>
                <li class="{{ Request::is('customers*') ? 'active' : '' }}"><a href="{{ route('customers.index') }}"><i
                            class="uil uil-users-alt me-2"></i>Pelanggan</a></li>
            @endif

            <li class="{{ Request::is('ratings*') ? 'active' : '' }}"><a href="{{ route('ratings.index') }}"><i
                        class="uil uil-star me-2"></i>Rating</a></li>
            @if (Auth::user()->hasRole('admin'))
                <li class="{{ Request::is('payments*') ? 'active' : '' }}"><a href="{{ route('payments.index') }}"><i
                            class="uil uil-credit-card me-2"></i>Payment</a></li>
            @endif
            <li class="{{ Request::is('reports') ? 'active' : '' }}"><a href="{{ route('reports') }}"><i
                        class="uil uil-folder me-2"></i>Laporan</a></li>
            <li
                class="sidebar-dropdown {{ Request::is('profile*') || Request::is('change-password*') ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="uil uil-user me-2"></i>Akun</a>
                <div class="sidebar-submenu"
                    {{ Request::is('profile*') || Request::is('change-password*') ? 'style=display:block;' : '' }}>
                    <ul>
                        <li class="{{ Request::is('profile*') ? 'active' : '' }}"><a
                                href="{{ route('profile.index') }}">Profil</a></li>
                        <li class="{{ Request::is('change-password*') ? 'active' : '' }}"><a
                                href="{{ route('change-password.index') }}">Ganti Kata Sandi</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
<!-- sidebar-wrapper  -->
