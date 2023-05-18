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
            <li class="list-inline-item mb-0">
                <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <div class="login-btn-primary"><span class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="settings" class="fea icon-sm"></i></span></div>
                    <div class="login-btn-light"><span class="btn btn-icon btn-pills btn-light"><i data-feather="settings" class="fea icon-sm"></i></span></div>
                </a>
            </li>

            <li class="list-inline-item ps-1 mb-0">
                <a href="https://1.envato.market/landrick" target="_blank">
                    <div class="login-btn-primary"><span class="btn btn-icon btn-pills btn-primary"><i data-feather="shopping-cart" class="fea icon-sm"></i></span></div>
                    <div class="login-btn-light"><span class="btn btn-icon btn-pills btn-light"><i data-feather="shopping-cart" class="fea icon-sm"></i></span></div>
                </a>
            </li>
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
