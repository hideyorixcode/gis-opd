<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<?= $this->endSection(); ?><!-- end css -->

<?= $this->section('content'); ?>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?= ucfirst($judul) ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= ucfirst($judul) ?></h4>
                    <br/>
                    <a class="btn btn-info btn-xs waves-effect mb-2 waves-light"
                       href="javascript:window.print()"><i class="mdi mdi-printer"></i> Cetak</a>
                    <a class="btn btn-success btn-xs waves-effect mb-2 waves-light"
                       href="<?= base_url('dashboard/ubah-profil') ?>"><i class="mdi mdi-account-edit"></i> Ubah Profil</a>
                    <a class="btn btn-danger btn-xs waves-effect mb-2 waves-light"
                       href="<?= base_url('dashboard/ubah-password') ?>"><i class="mdi mdi-key-link"></i> Ubah Password</a>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>
                    </div>
                <?php } ?>
                <div class="card-box text-center">
                    <!-- Logo & title -->
                    <div class="clearfix">
                        <div class="float-left">
                            <div class="auth-logo">
                                <div class="logo logo-dark">
                                                    <span class="logo-lg">
                                                        <img src="<?= base_url('public/assets/images/logo-dark.png') ?>"
                                                             alt="" height="22">
                                                    </span>
                                </div>

                                <div class="logo logo-light">
                                                    <span class="logo-lg">
                                                        <img src="?= base_url('public/assets/images/logo-light.png') ?>"
                                                             alt="" height="22">
                                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <img src="<?= base_url('public/uploads/' . $sesi_logo) ?>"
                         class="rounded-circle avatar-lg img-thumbnail"
                         alt="profile-image">

                    <h4 class="mb-0"><?= $sesi_singkatan_unker ?></h4>
                    <p class="text-muted">@<?= $sesi_username ?></p>


                    <div class="text-left mt-3">
                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted mb-2 font-17">Nama</p>
                            </div>
                            <div class="col-1">
                                <p class="text-muted mb-2 font-17">:</p>
                            </div>
                            <div class="col-8">
                                <p class="text-muted mb-2 font-17"><span
                                            class="ml-2"><strong><?= $sesi_nama_unker ?></strong></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted mb-2 font-17">Telepon</p>
                            </div>
                            <div class="col-1">
                                <p class="text-muted mb-2 font-17">:</p>
                            </div>
                            <div class="col-8">
                                <p class="text-muted mb-2 font-17"><span
                                            class="ml-2"><strong><?= $sesi_no_telepon ?></strong></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted mb-2 font-17">Alamat</p>
                            </div>
                            <div class="col-1">
                                <p class="text-muted mb-2 font-17">:</p>
                            </div>
                            <div class="col-8">
                                <p class="text-muted mb-2 font-17"><span
                                            class="ml-2"><strong><?= $sesi_alamat ?></strong></span>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted mb-2 font-17">Email</p>
                            </div>
                            <div class="col-1">
                                <p class="text-muted mb-2 font-17">:</p>
                            </div>
                            <div class="col-8">
                                <p class="text-muted mb-2 font-17"><span
                                            class="ml-2"><strong><?= $sesi_email ?></strong></span>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted mb-2 font-17">Website</p>
                            </div>
                            <div class="col-1">
                                <p class="text-muted mb-2 font-17">:</p>
                            </div>
                            <div class="col-8">
                                <p class="text-muted mb-2 font-17"><span
                                            class="ml-2"><strong><?= $sesi_website ?></strong></span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div> <!-- end card-box -->

            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->
<?= $this->endSection(); ?><!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?><!-- end modal -->

<?= $this->section('js'); ?>

<script>
    $(document).ready(function () {
    });
</script>
<?= $this->endSection(); ?><!-- end js -->
