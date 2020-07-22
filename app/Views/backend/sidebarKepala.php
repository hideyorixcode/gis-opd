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


    <li class="<?= getSegment(2) == 'peminjam' ? 'active' : ''; ?>">
        <a href="<?= base_url('dashboard/peminjam'); ?>" title="Peminjam"
           data-filter-tags="ui components">
            <i class="far fa-users"></i>
            <span class="nav-link-text" data-i18n="nav.peminjam">Peminjam</span>
        </a>
    </li>

    <li class="<?= getSegment(2) == 'barang' ? 'active' : ''; ?>">
        <a href="<?= base_url('dashboard/barang'); ?>" title="Barang"
           data-filter-tags="ui components">
            <i class="far fa-shopping-cart"></i>
            <span class="nav-link-text" data-i18n="nav.barang">Barang</span>
        </a>
    </li>


    <li class="<?= getSegment(2) == 'transaksi' ? 'active' : ''; ?>">
        <a href="<?= base_url('dashboard/transaksi'); ?>" title="Transaksi"
           data-filter-tags="ui components">
            <i class="far fa-book"></i>
            <span class="nav-link-text" data-i18n="nav.transaksi">Transaksi</span>
        </a>
    </li>


</ul>