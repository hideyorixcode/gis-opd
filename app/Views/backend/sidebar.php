<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="<?= base_url('public/assets/images/users/user-1.jpg') ?>" alt="user-img" title="Mat Helme"
                 class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                   data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?=base_url('dashboard')?>">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title mt-2">INSTANSI</li>

                <li>
                    <a href="<?= base_url('dashboard/opd') ?>">
                        <i class="mdi mdi-office-building"></i>
                        <span> Data OPD </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('dashboard/opd/form') ?>">
                        <i class="mdi mdi-plus-box"></i>
                        <span> Tambah OPD </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('dashboard/uptd-cabdin') ?>">
                        <i class="mdi mdi-account-multiple-check"></i>
                        <span> Data UPTD/CABDIN </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('dashboard/uptd-cabdin/form') ?>">
                        <i class="mdi mdi-plus-circle"></i>
                        <span> Tambah UPTD/CABDIN</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('dashboard/rekap') ?>">
                        <i class="mdi mdi-account-search"></i>
                        <span> Rekap Seluruh </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('dashboard/pengguna') ?>">
                        <i class="mdi mdi-account-cowboy-hat"></i>
                        <span> Data Pengguna </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('dashboard/log') ?>">
                        <i class="mdi mdi-history"></i>
                        <span> Log Aktivitas </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('dashboard/konfigurasi') ?>">
                        <i class="mdi mdi-google-chrome"></i>
                        <span> Konfigurasi </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>