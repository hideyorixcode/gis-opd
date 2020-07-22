<?php
$uri = current_url(true);
$urlnya = (string)$uri;  // http://example.com
?>
<ul id="js-nav-menu" class="nav-menu">
    <li class="nav-title">Navigasi</li>

    <li class="<?= getSegment(2) == '' ? 'active' : ''; ?>">
        <a href="<?= base_url('dashboard'); ?>" title="Dashboard"
           data-filter-tags="ui components">
            <i class="far fa-home"></i>
            <span class="nav-link-text" data-i18n="nav.dashboard">Dashboard</span>
        </a>
    </li>

    <li class="<?= getSegment(2) == 'pengguna' ? 'active open' : ''; ?>">
        <a href="#" title="Pengguna"
           data-filter-tags="ui components">
            <i class="far fa-user"></i>
            <span class="nav-link-text" data-i18n="nav.pengguna">Pengguna</span>
        </a>
        <ul>
            <li class="<?= getSegment(3) == '' ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/pengguna'); ?>" title="Data Pengguna"
                   data-filter-tags="data pengguna">
                    <span class="nav-link-text" data-i18n="nav.data">All Pengguna</span>
                </a>
            </li>
            <li class="<?= $urlnya == base_url('dashboard/pengguna/form') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/pengguna/form'); ?>" title="Form Pengguna"
                   data-filter-tags="form pengguna">
                    <span class="nav-link-text" data-i18n="nav.form">Add Pengguna</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="<?= getSegment(2) == 'peminjam' ? 'active open' : ''; ?>">
        <a href="#" title="Peminjam"
           data-filter-tags="ui components">
            <i class="far fa-users"></i>
            <span class="nav-link-text" data-i18n="nav.pengguna">Peminjam</span>
        </a>
        <ul>
            <li class="<?= $urlnya == base_url('dashboard/peminjam') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/peminjam'); ?>" title="Data Peminjam"
                   data-filter-tags="data peminjam">
                    <span class="nav-link-text" data-i18n="nav.data">All Peminjam</span>
                </a>
            </li>
            <li class="<?= $urlnya == base_url('dashboard/peminjam/form') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/peminjam/form'); ?>" title="Form Peminjam"
                   data-filter-tags="form pengguna">
                    <span class="nav-link-text" data-i18n="nav.form">Add Peminjam</span>
                </a>
            </li>
        </ul>
    </li>


    <li class="<?= getSegment(2) == 'lab' ? 'active open' : ''; ?>">
        <a href="#" title="lab"
           data-filter-tags="ui components">
            <i class="far fa-building"></i>
            <span class="nav-link-text" data-i18n="nav.lab">Lab</span>
        </a>
        <ul>
            <li class="<?= $urlnya == base_url('dashboard/lab') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/lab'); ?>" title="Data lab"
                   data-filter-tags="data lab">
                    <span class="nav-link-text" data-i18n="nav.data">All lab</span>
                </a>
            </li>
            <li class="<?= $urlnya == base_url('dashboard/lab/form') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/lab/form'); ?>" title="Form lab"
                   data-filter-tags="form pengguna">
                    <span class="nav-link-text" data-i18n="nav.form">Add lab</span>
                </a>
            </li>
        </ul>
    </li>


    <li class="<?= getSegment(2) == 'kategori' ? 'active open' : ''; ?>">
        <a href="#" title="kategori"
           data-filter-tags="ui components">
            <i class="far fa-tag"></i>
            <span class="nav-link-text" data-i18n="nav.pengguna">Kategori</span>
        </a>
        <ul>
            <li class="<?= $urlnya == base_url('dashboard/kategori') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/kategori'); ?>" title="Data kategori"
                   data-filter-tags="data kategori">
                    <span class="nav-link-text" data-i18n="nav.data">All kategori</span>
                </a>
            </li>
            <li class="<?= $urlnya == base_url('dashboard/kategori/form') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/kategori/form'); ?>" title="Form kategori"
                   data-filter-tags="form pengguna">
                    <span class="nav-link-text" data-i18n="nav.form">Add kategori</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="<?= getSegment(2) == 'barang' ? 'active open' : ''; ?>">
        <a href="#" title="barang"
           data-filter-tags="ui components">
            <i class="far fa-shopping-cart"></i>
            <span class="nav-link-text" data-i18n="nav.barang">Barang</span>
        </a>
        <ul>
            <li class="<?= $urlnya == base_url('dashboard/barang') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/barang'); ?>" title="Data barang"
                   data-filter-tags="data barang">
                    <span class="nav-link-text" data-i18n="nav.data">All barang</span>
                </a>
            </li>

            <li class="<?= $urlnya == base_url('dashboard/barang/form') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/barang/form'); ?>" title="Form barang"
                   data-filter-tags="form pengguna">
                    <span class="nav-link-text" data-i18n="nav.form">Add barang</span>
                </a>
            </li>
        </ul>
    </li>


    <li class="<?= getSegment(2) == 'transaksi' ? 'active open' : ''; ?>">
        <a href="#" title="transaksi"
           data-filter-tags="ui components">
            <i class="far fa-book"></i>
            <span class="nav-link-text" data-i18n="nav.transaksi">Transaksi</span>
        </a>
        <ul>
            <li class="<?= $urlnya == base_url('dashboard/transaksi') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/transaksi'); ?>" title="Data Transaksi"
                   data-filter-tags="data transaksi">
                    <span class="nav-link-text" data-i18n="nav.data">All Transaksi</span>
                </a>
            </li>

            <li class="<?= $urlnya == base_url('dashboard/transaksi/peminjaman') ? 'active' : ''; ?>">
                <a href="<?= base_url('dashboard/transaksi/peminjaman'); ?>" title="Form Transaksi Peminjaman"
                   data-filter-tags="form peminjaman">
                    <span class="nav-link-text" data-i18n="nav.form">Add Peminjaman</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="<?= getSegment(2) == 'log' ? 'active' : ''; ?>">
        <a href="<?= base_url('dashboard/log'); ?>" title="Log Aktivitas"
           data-filter-tags="ui components">
            <i class="far fa-history"></i>
            <span class="nav-link-text" data-i18n="nav.log">Log Aktivitas</span>
        </a>
    </li>

    <li class="<?= getSegment(2) == 'konfigurasi' ? 'active' : ''; ?>">
        <a href="<?= base_url('dashboard/konfigurasi'); ?>" title="Konfigurasi Aplikasi"
           data-filter-tags="ui components">
            <i class="far fa-code"></i>
            <span class="nav-link-text" data-i18n="nav.konfigurasi">Konfigurasi</span>
        </a>
    </li>


</ul>