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


    <li class="<?= getSegment(2) == 'barang' ? 'active' : ''; ?>">
        <a href="<?= base_url('dashboard/barang'); ?>" title="Barang"
           data-filter-tags="ui components">
            <i class="far fa-shopping-cart"></i>
            <span class="nav-link-text" data-i18n="nav.barang">Barang</span>
        </a>
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


</ul>