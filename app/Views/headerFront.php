<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                   href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                   href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?= base_url('public/uploads/user.png') ?>" alt="user-image"
                         class="rounded-circle">
                    <span class="pro-user-name ml-1">
                                    Hai, <i class="mdi mdi-chevron-down"></i>
                                </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Selamat Datang !</h6>
                    </div>
                    <a href="<?= base_url('dashboard') ?>" class="dropdown-item notify-item">
                        <i class="fe-log-in"></i>
                        <span>Login</span>
                    </a>
                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="<?= base_url('public/assets/images/logo-sm.png') ?>" alt="" height="22">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                <span class="logo-lg">
                                <img src="<?= base_url('public/assets/images/logo-dark.png') ?>" alt="" height="20">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
            </a>

            <a href="#" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="<?= base_url('public/assets/images/logo-sm.png') ?>" alt="" height="22">
                            </span>
                <span class="logo-lg">
                                <img src="<?= base_url('public/assets/images/logo-light.png') ?>" alt="" height="20">
                            </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

            <li class="dropdown d-none d-xl-block">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"
                   role="button" aria-haspopup="false" aria-expanded="false">
                    <?= $judul_aplikasi; ?>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>