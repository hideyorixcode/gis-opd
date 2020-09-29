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
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard/uptd-cabdin') ?>">UPTD /
                                    CABDIN</a></li>
                            <li class="breadcrumb-item active"><?= ucfirst($judul) ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= ucfirst($judul) ?></h4>
                    <br/>
                    <a class="btn btn-info btn-xs waves-effect mb-2 waves-light"
                       href="javascript:window.print()"><i class="mdi mdi-printer"></i> Cetak</a>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12 col-xl-12">
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

                    <img src="<?= $data['logo'] ? base_url('public/uploads/' . $data['logo']) : base_url('public/uploads/user.png') ?>"
                         class="rounded-circle avatar-lg img-thumbnail"
                         alt="profile-image">

                    <h4 class="mb-0"><?= $data['singkatan_unker']; ?></h4>
                    <p class="text-muted">@<?= $data['username']; ?></p>


                    <div class="text-left mt-3">
                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted mb-2 font-17">Nama <?= $data['status'] ?></p>
                            </div>
                            <div class="col-1">
                                <p class="text-muted mb-2 font-17">:</p>
                            </div>
                            <div class="col-8">
                                <p class="text-muted mb-2 font-17"><span
                                            class="ml-2"><strong><?= $data['nama_unker'] . ' (' . $nama_opd . ')'; ?></strong></span>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted mb-2 font-17">NIP Pejabat</p>
                            </div>
                            <div class="col-1">
                                <p class="text-muted mb-2 font-17">:</p>
                            </div>
                            <div class="col-8">
                                <p class="text-muted mb-2 font-17"><span
                                            class="ml-2"><strong><?= $data['nip_pejabat']; ?></strong></span>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted mb-2 font-17">Nama Pejabat</p>
                            </div>
                            <div class="col-1">
                                <p class="text-muted mb-2 font-17">:</p>
                            </div>
                            <div class="col-8">
                                <p class="text-muted mb-2 font-17"><span
                                            class="ml-2"><strong><?= $data['nama_pejabat']; ?></strong></span>
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
                                            class="ml-2"><strong><?= $data['no_telepon']; ?></strong></span>
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
                                            class="ml-2"><strong><?= $data['alamat']; ?></strong></span>
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
                                            class="ml-2"><strong><?= $data['email']; ?></strong></span>
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
                                            class="ml-2"><strong><?= $data['website']; ?></strong></span>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <p class="text-muted mb-2 font-17">Akun</p>
                            </div>
                            <div class="col-1">
                                <p class="text-muted mb-2 font-17">:</p>
                            </div>
                            <div class="col-8">
                                <?php
                                $akunnya = $data['active'] == 1 ? 'success' : 'danger';
                                ?>
                                <p class="text-<?= $akunnya ?> mb-2 font-17"><span
                                            class="ml-2"><strong><?= $data['active'] == 1 ? '<i class="fa fa-check-square"></i> Aktif' : '<i class="fa fa-times"></i> Non Aktif' ?></strong></span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div> <!-- end card-box -->

            </div> <!-- end col-->
            <?php if ($data['latitude']) {
                ?>
                <div class="col-lg-12 col-xl-12">
                    <div class="card-box">
                        <div class="clearfix">
                            <div class="float-left">
                                <p class="text-muted mb-2 font-17">MAPS</p>
                            </div>
                        </div>
                        <div class="form-group" id="map" style="height: 400px;">
                        </div>
                    </div>
                </div>
                <!-- end row-->
            <?php } ?>

        </div> <!-- container -->

    </div> <!-- content -->
    <?= $this->endSection(); ?><!-- end content -->

    <?= $this->section('modal'); ?>
    <?= $this->endSection(); ?><!-- end modal -->

    <?= $this->section('js'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-dHEsi38G2HqgA_WogYqiAmuClpkdB8E&libraries=places&callback=initMap"
            async defer></script>
    <script>
        $(document).ready(function () {
        });

        function initMap() {
            var lat_awal, lng_awal;
            lat_awal = <?=$data['latitude']?>;
            lng_awal = <?=$data['longitude']?>;
            var defaultCenter = {
                lat: lat_awal * 1,
                lng: lng_awal * 1
            };


            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: defaultCenter
            });

            var marker = new google.maps.Marker({
                position: defaultCenter,
                map: map,
                title: 'Click to zoom',
            });
            var infowindow = new google.maps.InfoWindow({
                content: '<h3>' + '<?=$data['nama_unker']?>' + '</h3><br/><span>' + '<?=$data['alamat']?>' + '</span>'
            });

            infowindow.open(map, marker);
        }

    </script>
    <?= $this->endSection(); ?><!-- end js -->
