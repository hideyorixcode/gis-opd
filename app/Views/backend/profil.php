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
                            <li class="breadcrumb-item"><a href="<?=base_url('dashboard')?>">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?=ucfirst($judul)?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?=ucfirst($judul)?></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card-box text-center">
                    <img src="<?=base_url('public/assets/images/users/user-1.jpg')?>" class="rounded-circle avatar-lg img-thumbnail"
                         alt="profile-image">

                    <h4 class="mb-0"><?=$sesi_singkatan_unker?></h4>
                    <p class="text-muted">@<?=$sesi_username?></p>

                    <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Ubah Profil</button>
                    <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Ubah Password</button>

                    <div class="text-left mt-3">
                        <p class="text-muted mb-2 font-13"><strong>Nama <?=$sesi_status?> :</strong> <span class="ml-2"><?=$sesi_nama_unker?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Telepon :</strong><span class="ml-2"><?=$sesi_no_telepon?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 "><?=$sesi_email?></span></p>
                        <p class="text-muted mb-1 font-13"><strong>Website :</strong> <span class="ml-2"><?=$sesi_website?></span></p>
                    </div>
                </div> <!-- end card-box -->

                <div class="card-box">
                    <h4 class="header-title mb-3">Maps</h4>

                </div> <!-- end card-box-->

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
