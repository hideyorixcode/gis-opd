<?= $this->extend('templateFront'); ?>
<?= $this->section('css'); ?>
<link href="<?= base_url('public/assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css"/>
<style>
    .controlx {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #searchInput {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 50%;
    }

    #searchInput:focus {
        border-color: #4d90fe;
    }
</style>
<?= $this->endSection(); ?><!-- end css -->
<?= $this->section('content'); ?>
<?php
$a = date("H");
if (($a >= 6) && ($a <= 11)) {
    $hello = "Selamat Pagi";
} else if (($a > 11) && ($a <= 15)) {
    $hello = " Selamat Siang";
} else if (($a > 15) && ($a <= 18)) {
    $hello = "Selamat Sore";
} else {
    $hello = "Selamat Malam";
}
$array_hr = array(1 => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
$hr = $array_hr[date('N')];
$tgl = date('j');
$array_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bln = $array_bln[date('n')];
$thn = date('Y');
$hari_ini = $hr . ", " . $tgl . " " . $bln . " " . $thn;
?>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?= ($hari_ini) ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= ucfirst($judul) ?></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <!-- end row-->

        <div class="row">
            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title mb-3">Filter Data</h4>
                    <form method="get" id="form" name="form">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">OPD</label>
                            <div class="col-7">
                                <select class="form-control" data-toggle="select2" id="id-unit"
                                        name="id-unit">
                                    <option value="">Seluruh OPD</option>
                                    <?php foreach ($dataOPD as $opd) : ?>
                                        <option value="<?= substr($opd['id_unker'], 0, 6) ?>" <?= substr($opd['id_unker'], 0, 6) == $getidunker ? 'selected' : ''; ?>><?= $opd['nama_unker'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-4 col-form-label">Tampilkan</label>
                            <div class="col-7">
                                <select class="form-control" data-toggle="select2" id="status-unit" name="status-unit">
                                    <option value="" <?= $getstatus == '' ? 'selected' : '' ?>>Seluruh Status
                                    </option>
                                    <option value="OPD" <?= $getstatus == 'OPD' ? 'selected' : '' ?>>OPD
                                    </option>
                                    <option value="UPTD" <?= $getstatus == 'UPTD' ? 'selected' : '' ?>>UPTD
                                    </option>
                                    <option value="CABDIN" <?= $getstatus == 'CABDIN' ? 'selected' : '' ?>>Cabang
                                        Dinas
                                    </option>
                                    <option value="GEDUNG" <?= $getstatus == 'GEDUNG' ? 'selected' : '' ?>>Gedung / Aset
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-8 offset-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        onclick="reload_table();">
                                    <i class="mdi mdi-refresh-circle"></i> Filter Data
                                </button>
                            </div>
                        </div>
                    </form>

                </div> <!-- end card-box -->
            </div> <!-- end col-->

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12 col-xl-6">
                        <div class="widget-rounded-circle card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                                        <i class="fe-clock font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="text-dark mt-1" id="clock"><span data-plugin="counterup"></span></h3>
                                        <p class="text-muted mb-1 text-truncate"><?= $hello ?></p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->

                    <div class="col-md-12 col-xl-6">
                        <div class="widget-rounded-circle card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-danger border-danger border shadow">
                                        <i class="mdi mdi-office-building font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="mt-1">
                                            <?php if ($mode) { ?>
                                                <span data-plugin="counterup"><?= $jumlahOPD ?></span>
                                            <?php } else { ?>
                                                <span><?= $jumlahOPD ?></span>
                                            <?php } ?>

                                        </h3>
                                        <p class="text-muted mb-1 text-truncate"><?= $mode; ?></p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->

                    <div class="col-md-12 col-xl-4">
                        <div class="widget-rounded-circle card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                                        <i class="mdi mdi-account-multiple-check font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="text-dark mt-1"><span
                                                    data-plugin="counterup"><?= $jumlahUPTD ?></span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total UPTD</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->

                    <div class="col-md-12 col-xl-4">
                        <div class="widget-rounded-circle card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                                        <i class="mdi mdi-account-check-outline font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="text-dark mt-1"><span
                                                    data-plugin="counterup"><?= $jumlahCABDIN ?></span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total Cabang Dinas</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->

                    <div class="col-md-12 col-xl-4">
                        <div class="widget-rounded-circle card-box">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-primary border-info border shadow">
                                        <i class="mdi mdi-home font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h3 class="text-dark mt-1"><span
                                                    data-plugin="counterup"><?= $jumlahGEDUNG ?></span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total Gedung/Aset</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div> <!-- end widget-rounded-circle-->
                    </div> <!-- end col-->


                </div>
            </div> <!-- end col-->

            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title mb-3">Maps Penyebaran</h4>

                    <div class="form-group mb-3">
                        <input id="searchInput" name="searchinput" class="controlx" type="text"
                               placeholder="Ketik sebuah lokasi...">
                        <div class="form-group" id="map" style="height: 600px;">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <?= $this->endSection(); ?><!-- end content -->
    <?= $this->section('modal'); ?>

    <?= $this->endSection(); ?>
    <!-- end modal -->
    <?= $this->section('js'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-dHEsi38G2HqgA_WogYqiAmuClpkdB8E&libraries=places&callback=initialize"
            async defer></script>
    <script src="<?= base_url('public/assets/libs/select2/js/select2.min.js') ?>"></script>
    <!-- third party js ends -->
    <script>
        $(document).ready(function () {
            tampilkanwaktu();
            setInterval('tampilkanwaktu()', 1000);
            initialize();
        });

        function tampilkanwaktu() {         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
            var waktu = new Date();            //membuat object date berdasarkan waktu saat
            var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
            var sm = waktu.getMinutes() + "";  //memunculkan nilai detik
            var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
            document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
        }

        $('[data-toggle="select2"]').select2();

        function initialize() {
            var noPoi = [
                {
                    featureType: "poi",
                    stylers: [
                        {visibility: "off"}
                    ]
                }
            ];
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -5.433416599999999, lng: 105.25733930000001},
                clickableIcons: false,
                // disableDefaultUI: true,
                zoom: 10
            });

            map.setOptions({styles: noPoi});


            var data =  <?php echo json_encode($dataMaps)?>;
            //console.log(data);
            $.each(data, function (k, v) {
                var pos = {
                    lat: parseFloat(v.latitude),
                    lng: parseFloat(v.longitude)
                };

                if (v.status == "UPTD") {
                    var has_string = $('*:contains("SAMSAT KELILING")').length;
                    // alert(has_string);
                    var str = v.nama_unker;
                    var n = str.search("SAMSAT KELILING");
                    if (n) {
                        url_icon = '<?=base_url('public/uploads/uptd.png')?>';

                    } else {
                        url_icon = '<?=base_url('public/uploads/car.png')?>';
                    }
                    urlText = '<?=base_url('info/uptd-cabdin/')?>/' + v.id_unker;
                } else if (v.status == "CABDIN") {
                    url_icon = '<?=base_url('public/uploads/cabdin.png')?>';
                    urlText = '<?=base_url('info/uptd-cabdin/')?>/' + v.id_unker;
                } else if (v.status == "GEDUNG") {
                    url_icon = '<?=base_url('public/uploads/gedung.png')?>';
                    urlText = '<?=base_url('info/uptd-cabdin/')?>/' + v.id_unker;
                } else {
                    url_icon = '<?=base_url('public/uploads/opd.png')?>';
                    urlText = '<?=base_url('info/opd/')?>/' + v.id_unker;
                }

                var contentString = '<h3>' + v.nama_unker + ' (' + v.status + ')</h3><br/><span>' + v.alamat + '</span>' +
                    '<p align="center"><br/><a href="' + urlText + '" class="link_detail btn btn-primary" target="_blank">Lihat Detail</a></p>';
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: v.nama_unker,
                    animation: google.maps.Animation.DROP
                });
                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });


                marker.setIcon(({
                    url: url_icon,
                    size: new google.maps.Size(100, 100),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));

                marker.setAnimation(google.maps.Animation.BOUNCE);
            });

            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29),
                title: 'Click to zoom',
            });

            autocomplete.addListener('place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setIcon(({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            });
        }

    </script>
    <?= $this->endSection(); ?>
