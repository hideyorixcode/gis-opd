<?= $this->extend('backend/template'); ?>

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
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Form Ubah Data UPTD / CABDIN</h4>
                    <p class="text-muted font-14 m-b-20">
                        Silahkan lengkapi data berikut ini, tanda <span class="text-danger">*</span> wajib diisi
                    </p>

                    <form id="form" name="form" method="post" enctype="multipart/form-data"
                          action="<?= base_url('dashboard/uptd-cabdin/update') ?>">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-8">
                                <?php
                                if (old('selectOPD')) {
                                    $setOPD = old('selectOPD');
                                } else {
                                    $setOPD = substr($data['id_unker'], 0, 6) . '0000';
                                }
                                ?>
                                <div class="form-group mb-3">
                                    <label>Pilih OPD <span class="text-danger">*</span></label>
                                    <select class="form-control" data-toggle="select2" id="selectOPD" name="selectOPD">
                                        <?php foreach ($dataOPD as $opd) : ?>
                                            <option value="<?= $opd['id_unker'] ?>" <?= $opd['id_unker'] == $setOPD ? 'selected' : ''; ?>><?= $opd['nama_unker'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('selectOPD'); ?>
                                    </div>
                                </div>

                                <input type="hidden" id="id" name="id" value="<?= $id; ?>">
                                <?php
                                if (old('statusSelect')) {
                                    $setStatus = old('statusSelect');
                                } else {
                                    $setStatus = $data['status'];
                                }
                                ?>
                                <div class="form-group mb-3">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="statusSelect" id="statusSelect"
                                            class="form-control <?= ($validation->hasError('statusSelect')) ? 'is-invalid' : '' ?>">
                                        <option value="UPTD" <?= $setStatus == 'UPTD' ? 'selected' : '' ?>>UPTD
                                        </option>
                                        <option value="CABDIN" <?= $setStatus == 'CABDIN' ? 'selected' : '' ?>>Cabang
                                            Dinas
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('statusSelect'); ?>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label id="label_nama">Nama UPTD / CABDIN <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('nama_unker')) ? 'is-invalid' : '' ?>"
                                           id="nama_unker" name="nama_unker" placeholder="Nama uptd" required
                                           autofocus
                                           value="<?= old('nama_unker') ? old('nama_unker') : $data['nama_unker'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_unker'); ?>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label id="label_singkatan">Singkatan UPTD / CABDIN</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('singkatan_unker')) ? 'is-invalid' : '' ?>"
                                           id="singkatan_unker" name="singkatan_unker"
                                           placeholder="Singkatan/Alias uptd"
                                           value="<?= old('singkatan_unker') ? old('singkatan_unker') : $data['singkatan_unker'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('singkatan_unker'); ?>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>NIP Pejabat</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('nip_pejabat')) ? 'is-invalid' : '' ?>"
                                           id="nip_pejabat" name="nip_pejabat" placeholder="Ex : 19681203 198803 1 00"
                                           data-toggle="input-mask" data-mask-format="00000000 000000 0 00"
                                           value="<?= old('nip_pejabat') ? old('nip_pejabat') : $data['nip_pejabat'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nip_pejabat'); ?>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Pejabat</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('nama_pejabat')) ? 'is-invalid' : '' ?>"
                                           id="nama_pejabat" name="nama_pejabat" placeholder="Ex : ARIS PADILA, S.E."
                                           value="<?= old('nama_pejabat') ? old('nama_pejabat') : $data['nama_pejabat'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_pejabat'); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label>Latitude</label>
                                            <input type="text"
                                                   class="form-control <?= ($validation->hasError('latitude')) ? 'is-invalid' : '' ?>"
                                                   id="latitude" name="latitude"
                                                   placeholder="Automatis ketika anda menandai lokasi"
                                                   value="<?= old('latitude') ? old('latitude') : $data['latitude'] ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('latitude'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label>Longitude</label>
                                            <input type="text"
                                                   class="form-control <?= ($validation->hasError('longitude')) ? 'is-invalid' : '' ?>"
                                                   id="longitude" name="longitude"
                                                   placeholder="Automatis ketika anda menandai lokasi"
                                                   value="<?= old('longitude') ? old('longitude') : $data['longitude'] ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('longitude'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <input id="searchInput" name="searchinput" class="controlx" type="text"
                                           placeholder="Ketik sebuah lokasi...">
                                    <div class="form-group" id="map" style="height: 400px;">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Alamat</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>"
                                           id="alamat" name="alamat"
                                           placeholder="automatis jika anda mencari lokasi berdasarkan pencarian maps"
                                           value="<?= old('alamat') ? old('alamat') : $data['alamat'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                </div>


                            </div>

                            <div class="col-lg-4">

                                <div class="form-group mb-3">
                                    <label id="label_id">ID UPTD / CABDIN <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="hidden" id="inputIDOPD_" name="inputIDOPD_" value="">
                                            <span class="input-group-text" id="inputIDOPD">ID</span>
                                        </div>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('id_unker_mix')) ? 'is-invalid' : '' ?>"
                                               id="id_unker" name="id_unker" placeholder="ID unik untuk UPTD / CABDIN"
                                               aria-describedby="inputGroupPrepend" required
                                               onkeypress="return check_int(event)"
                                               maxlength="4"
                                               value="<?= old('id_unker') ? old('id_unker') : substr($data['id_unker'], -4); ?>">
                                        <input type="hidden" id="id_unker_mix" name="id_unker_mix">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_unker_mix'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>No Telepon</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : '' ?>"
                                           id="no_telepon" name="no_telepon" placeholder="Ex : 072176532xxx"
                                           value="<?= old('no_telepon') ? old('no_telepon') : $data['no_telepon'] ?>"
                                           onkeypress="return check_int(event)"
                                           maxlength="14">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_telepon'); ?>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email"
                                           class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                           id="email" name="email" placeholder="Ex : info@lampungprov.go.id"
                                           value="<?= old('email') ? old('email') : $data['email'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Website</label>
                                    <input type="text"
                                           class="form-control <?= ($validation->hasError('website')) ? 'is-invalid' : '' ?>"
                                           id="website" name="website" placeholder="Ex : https://lampungprov.go.id"
                                           value="<?= old('website') ? old('website') : $data['website'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('website'); ?>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Logo</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="<?= $data['logo'] ? base_url('public/uploads/' . $data['logo']) : base_url('public/uploads/user.png') ?>"
                                                 class="img-thumbnail img-preview">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="logo" name="logo"
                                                       onchange="previewImg()">
                                                <label class="custom-file-label" for="validatedCustomFile">Pilih
                                                    Logo...</label>
                                                <div class="invalid-feedback"><?= $validation->getError('logo'); ?></div>
                                            </div>
                                            <?php if ($data['logo']) { ?>
                                                <input type="checkbox" name="remove_logo" id="remove_logo"
                                                       value="<?= $data['logo'] ?>">
                                                hapus logo
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 text-right">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="mdi mdi-content-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div> <!-- end card-box -->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div>
<?= $this->endSection(); ?><!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?><!-- end modal -->

<?= $this->section('js'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-dHEsi38G2HqgA_WogYqiAmuClpkdB8E&libraries=places&callback=initMap"
        async defer></script>
<script src="<?= base_url('public/assets/libs/jquery-mask-plugin/jquery.mask.min.js') ?>"></script>
<script>
    $(document).ready(function () {

    });

    $("input").change(function () {
        $(this).closest('.form-group').find('input.form-control').removeClass('is-invalid');
        $(this).closest('.form-group').find('span.invalid-feedback').text('');
    });
    $("select").change(function () {
        $(this).closest('.form-group').find('div.input-group').removeClass('is-invalid');
        $(this).closest('.form-group').find('span.invalid-feedback').text('');
    });

    function check_int(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        return (charCode >= 46 && charCode <= 57 || charCode == 8 || charCode == 32 || charCode == 40 || charCode == 41 || charCode == 43);
    }

    function previewImg() {
        const logo = document.querySelector('#logo');
        const logoLabel = document.querySelector('.custom-file-label');
        const logoPreview = document.querySelector('.img-preview');

        logoLabel.textContent = logo.files[0].name;

        const fileLogo = new FileReader();
        fileLogo.readAsDataURL(logo.files[0]);

        fileLogo.onload = function (e) {
            logoPreview.src = e.target.result;
        }
    }

    function initMap() {
        <?php
        if ($data['latitude']) {
            $lat_awal = $data['latitude'];
        } else {
            $lat_awal = -5.4412265;
        }

        if ($data['longitude']) {
            $lng_awal = $data['longitude'];
        } else {
            $lng_awal = 105.2582919;
        }
        ?>
        var lat_awal = <?= old('latitude') ? old('latitude') : $data['latitude'] ?>;
        var lng_awal = <?= old('longitude') ? old('longitude') : $data['longitude'] ?>;
        var defaultCenter = {
            lat: lat_awal * 1,
            lng: lng_awal * 1
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: defaultCenter
        });
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);


        /*var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            title: 'Click to zoom',

        });*/
        var marker = new google.maps.Marker({
            position: defaultCenter,
            map: map,
            title: 'Click to zoom',
            animation: google.maps.Animation.DROP,
            draggable: true
        });

        marker.setAnimation(google.maps.Animation.BOUNCE);
        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);
        marker.addListener("click", toggleBounce);

        var infowindow = new google.maps.InfoWindow();

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
            // marker.setIcon(({
            //     url: place.icon,
            //     size: new google.maps.Size(71, 71),
            //     origin: new google.maps.Point(0, 0),
            //     anchor: new google.maps.Point(17, 34),
            //     scaledSize: new google.maps.Size(35, 35)
            // }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            marker.setDraggable(true);


            marker.setAnimation(google.maps.Animation.BOUNCE);
            marker.addListener('drag', handleEvent);
            marker.addListener('dragend', handleEvent);
            marker.addListener("click", toggleBounce);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            //Location details
            // document.getElementById("myText").value = "Johnny Bravo";
            $('[name="alamat"]').val(place.formatted_address);
            $('[name="latitude"]').val(place.geometry.location.lat());
            $('[name="longitude"]').val(place.geometry.location.lng());
        });

        function handleEvent(event) {


            $('[name="latitude"]').val(event.latLng.lat());
            $('[name="longitude"]').val(event.latLng.lng());
            $('[name="searchinput"]').val("");
            // var geocoder = new google.maps.Geocoder;
            // geocoder.geocode({'location': event.latlng}, function(results, status) {
            //     if (status === 'OK') {
            //         if (results[0]) {
            //             rs = results[0].formatted_address;
            //         } else {
            //             rs = 'No results found';
            //         }
            //     } else {
            //         rs = 'Geocoder failed due to: ' + status;
            //     }
            // });
            $('[name="alamat"]').val(event.latLng.formatted_address);
            // $('[name="alamat"]').val(rs);
            infowindow.setContent('<h4>Tandai Manual Lokasi</h4>');
            infowindow.open(map, marker);

        }

        function toggleBounce() {
            if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
    }

    $(document).ready(function () {
        $('[data-toggle="input-mask"]').each(function (a, e) {
            var t = $(e).data("maskFormat"), n = $(e).data("reverse");
            null != n ? $(e).mask(t, {reverse: n}) : $(e).mask(t)
        })
    });
</script>
<script src="<?= base_url('public/assets/libs/select2/js/select2.min.js') ?>"></script>
<script>
    nampilin_id_opd();
    changeText();
    $('[data-toggle="select2"]').select2();
    $('select[name="selectOPD"]').on('change', function () {
        nampilin_id_opd();
    });
    $('select[name="statusSelect"]').on('change', function () {
        changeText();
    });

    function changeText() {
        var selectStatus = $('[name="statusSelect"] option:selected').text();
        $('#label_nama').html('Nama ' + selectStatus + '<span class="text-danger">*</span>');
        $('#label_id').html('ID ' + selectStatus + '<span class="text-danger">*</span>');
        $('#label_singkatan').html('Singkatan ' + selectStatus + '<span class="text-danger">*</span>');
        $("#nama_unker").attr("placeholder", 'Nama ' + selectStatus);
        $("#id_unker").attr("placeholder", 'ID Unik ' + selectStatus);
        $("#singkatan_unker").attr("placeholder", 'Singkatan ' + selectStatus);
        $('.page-title').text('Form Tambah ' + selectStatus);
        $('.header-title').text('Form Tambah ' + selectStatus);
    }

    $('#id_unker').on('change', function () {
        $('#id_unker_mix').val($('#inputIDOPD_').val() + '' + $('#id_unker').val());
    });

    function nampilin_id_opd() {
        selectOPD = $("#selectOPD").val();
        $('#inputIDOPD').text(selectOPD.substring(0, 6));
        $('#inputIDOPD_').val(selectOPD.substring(0, 6));
        $('#id_unker_mix').val(selectOPD.substring(0, 6) + '' + $('#id_unker').val());
    }
</script>
<?= $this->endSection(); ?><!-- end js -->