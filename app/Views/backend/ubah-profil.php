<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<?= $this->endSection(); ?><!-- end css -->

<?= $this->section('content'); ?>
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Beranda </a></li>
        <li class="breadcrumb-item active">Ubah Profil</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user'></i> Ubah Profil
        </h1>
        <div class="subheader-block">
            <a href="<?= base_url('dashboard/profil') ?>" class="btn btn-danger btn-sm"
               title="Kembali"><i class="fal fa-backward"></i> Kembali <span
                        class="hidden-xs-down">Ke Profil</span></a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-2" class="panel">
                <div class="panel-hdr bg-primary-700 bg-success-gradient">
                    <h2 style="color:white">
                        Ubah <span class="fw-300"><i>Profil</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10"
                                data-original-title="Close"></button>
                    </div>
                </div>

                <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times-square"></i></span>
                        </button>
                        <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>
                    </div>

                <?php } ?>

                <?php if (!empty(session()->getFlashdata('gagal_avatar'))) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times-square"></i></span>
                        </button>
                        <strong>Gagal!</strong> <?= session()->getFlashdata('gagal_avatar'); ?>
                    </div>

                <?php } ?>

                <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times-square"></i></span>
                        </button>
                        <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>
                    </div>

                <?php } ?>
                <div class="panel-container show">
                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                        <img src="<?= base_url('public/uploads/' . $sesi_avatar) ?>"
                             style="height: 100px" class="rounded-circle shadow-2 img-thumbnail"
                             alt="">

                    </div>
                    <form id="form" name="form" method="post" enctype="multipart/form-data"
                          action="<?= base_url('dashboard/update-profil') ?>">
                        <div class="panel-content p-0">
                            <?= csrf_field() ?>
                            <div class="panel-content">
                                <div class="form-row">
                                    <input type="hidden" class="form-control" name="id"
                                           id="id"
                                           value="<?= ($sesi_id); ?>">


                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text"
                                               class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>"
                                               id="nama" name="nama"
                                               value="<?= old('nama') ? old('nama') : $sesi_nama ?>">
                                        <span class="invalid-feedback"
                                              id="error_nama"><?= $validation->getError('nama'); ?></span>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            </div>
                                            <input type="text"
                                                   class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                                                   name="username" id="username"
                                                   required
                                                   value="<?= old('username') ? old('username') : $sesi_username ?>">
                                            <span class="invalid-feedback"
                                                  id="error_username"><?= $validation->getError('username'); ?></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Email</label>
                                        <input type="email"
                                               class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                               id="email" name="email" required
                                               value="<?= old('email') ? old('email') : $sesi_email ?>">
                                        <span class="invalid-feedback"
                                              id="error_email"><?= $validation->getError('email'); ?></span>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">No Telepon</label>
                                        <input type="text" name="no_hp" id="no_hp"
                                               class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : '' ?>"
                                               onkeypress="return check_int(event)" maxlength="14"
                                               value="<?= old('no_hp') ? old('no_hp') : $sesi_no_hp ?>">
                                        <span class="invalid-feedback"
                                              id="error_no_hp"><?= $validation->getError('no_hp'); ?></span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <?php if ($sesi_level == 'guru' || $sesi_level == 'siswa') { ?>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label"><?= $sesi_level == 'guru' ? 'NIP' : 'NIS' ?></label>
                                            <input type="text"
                                                   class="form-control  <?= ($validation->hasError('nomor_identitas')) ? 'is-invalid' : '' ?>"
                                                   onkeypress="return check_int(event)" maxlength="35"
                                                   id="nomor_identitas" name="nomor_identitas"
                                                   value="<?= old('nomor_identitas') ? old('nomor_identitas') : $sesi_nomor ?>">
                                            <span class="invalid-feedback"
                                                  id="error_nomor_identitas"><?= $validation->getError('nomor_identitas'); ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-6 mb-6">
                                        <label for="Foto" id="label-Foto" class="form-control-label"><?php
                                            echo
                                            ($sesi_avatar) ? ' Ubah Avatar' : 'Unggah Avatar'; ?></label>
                                        <input type="file" id="avatar" name="avatar"
                                               accept=".jpg, .jpeg, .png, .gif">
                                        <?php
                                        if ($sesi_avatar) {
                                            ?>
                                            <div class="checkbox mt-2">
                                                <input type="checkbox" id="remove_avatar" name="remove_avatar"
                                                       value="<?= $sesi_avatar; ?>"/>
                                                Hapus Avatar Ketika Disimpan
                                            </div>
                                        <?php }
                                        ?>
                                        <span style="width: 100%;margin-top: 0.25rem;font-size: 80%;color: #fd3995;"
                                              id="error_avatar"><?= $validation->getError('avatar'); ?></span>
                                    </div>
                                </div>


                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <button class="btn btn-primary ml-auto" type="submit" id="btnsave" name="btnsave"><i
                                                class="fal fa-save"></i> Perbarui Profil
                                    </button>
                                </div>


                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</main>
<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
<?= $this->endSection(); ?><!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?><!-- end modal -->

<?= $this->section('js'); ?>

<script>
    $(document).ready(function () {
        $("input").change(function () {
            $(this).closest('.form-group').find('input.form-control').removeClass('is-invalid');
            $(this).closest('.form-group').find('span.invalid-feedback').text('');
        });

        $("select").change(function () {
            $(this).closest('.form-group').find('div.input-group').removeClass('is-invalid');
            $(this).closest('.form-group').find('span.invalid-feedback').text('');
        });
    });

    function check_int(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        return (charCode >= 46 && charCode <= 57 || charCode == 8 || charCode == 32 || charCode == 40 || charCode == 41 || charCode == 43);
    }
</script>
<?= $this->endSection(); ?><!-- end js -->
