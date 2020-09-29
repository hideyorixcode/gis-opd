<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<?= $this->endSection(); ?><!-- end css -->

<?= $this->section('content'); ?>
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Beranda </a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('dashboard/pengguna') ?>">Data Pengguna </a></li>
        <li class="breadcrumb-item active">Form Pengguna</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user-plus'></i><?= ucfirst($judul) ?>
        </h1>
        <div class="subheader-block">
            <a href="<?= base_url('dashboard/pengguna') ?>" class="btn btn-danger btn-sm"
               title="Kembali"><i class="fal fa-backward"></i> Kembali <span
                        class="hidden-xs-down">Ke Pengguna</span></a>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-2" class="panel">
                <div class="panel-hdr bg-primary-700 bg-success-gradient">
                    <h2 style="color:white">
                        Tambah <span class="fw-300"><i>Pengguna</i></span>
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
                <div class="panel-container show">
                    <div class="panel-content">

                        <form id="form" name="form" method="post" enctype="multipart/form-data"
                              action="<?= base_url('dashboard/pengguna/create') ?>">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control  <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>"
                                                   id="nama" name="nama" placeholder="Nama Lengkap"
                                                   value="<?= old('nama') ?>" autofocus>
                                            <span class="invalid-feedback"
                                                  id="error_nama"><?= $validation->getError('nama'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control  <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                                   id="email" name="email" placeholder="Email Valid"
                                                   value="<?= old('email') ?>">
                                            <span class="invalid-feedback"
                                                  id="error_email"><?= $validation->getError('email'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nomor
                                            Handhpone</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control  <?= ($validation->hasError('no_hp')) ? 'is-invalid' : '' ?>"
                                                   onkeypress="return check_int(event)" maxlength="14"
                                                   id="no_hp" name="no_hp" placeholder="No HP Aktif"
                                                   value="<?= old('no_hp') ?>">
                                            <span class="invalid-feedback"
                                                  id="error_no_hp"><?= $validation->getError('no_hp'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control  <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                                                   id="username" name="username" placeholder="Username untuk login"
                                                   value="<?= old('username') ?>">
                                            <span class="invalid-feedback"
                                                  id="error_username"><?= $validation->getError('username'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Kata Sandi</label>
                                        <div class="col-sm-9">
                                            <input type="password"
                                                   class="form-control  <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                                                   id="password" name="password" placeholder="Password"
                                                   value="<?= old('password') ?>">
                                            <span class="invalid-feedback"
                                                  id="error_password"><?= $validation->getError('password'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Konfirmasi Kata
                                            Sandi</label>
                                        <div class="col-sm-9">
                                            <input type="password"
                                                   class="form-control  <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : '' ?>"
                                                   id="confirm_password" name="confirm_password"
                                                   placeholder="Konfirmasi Password"
                                                   value="<?= old('confirm_password') ?>">
                                            <span class="invalid-feedback"
                                                  id="error_confirm_password"><?= $validation->getError('confirm_password'); ?></span>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Level</label>
                                        <div class="col-sm-9">
                                            <select name="level" id="level"
                                                    class="form-control <?= ($validation->hasError('level')) ? 'is-invalid' : '' ?>">
                                                <option value="admin" <?= old('level') == 'admin' ? 'selected' : '' ?>>
                                                    Admin
                                                </option>
                                                <option value="kepala" <?= old('level') == 'kepala' ? 'selected' : '' ?>>
                                                    Kepala Lab
                                                </option>
                                                <option value="petugas" <?= old('level') == 'petugas' ? 'selected' : '' ?>>
                                                    Petugas Lab
                                                </option>
                                            </select>
                                            <span class="invalid-feedback"
                                                  id="error_level"><?= $validation->getError('level'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select name="active" id="active"
                                                    class="form-control <?= ($validation->hasError('active')) ? 'is-invalid' : '' ?>">
                                                <option value="1" <?= old('active') == '1' ? 'selected' : '' ?>>Aktif
                                                </option>
                                                <option value="0" <?= old('active') == '0' ? 'selected' : '' ?>>Tidak
                                                    Aktif
                                                </option>
                                            </select>
                                            <span class="invalid-feedback"
                                                  id="error_level"><?= $validation->getError('active'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Foto</label>
                                        <div class="col-sm-9">
                                            <input name="avatar" id="avatar" type="file" class="form-control"
                                                   accept=".jpg, .jpeg, .png, .gif">
                                            <span style="width: 100%;margin-top: 0.25rem;font-size: 80%;color: #fd3995;"
                                                  id="error_avatar"><?= $validation->getError('avatar'); ?></span>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div
                                    class="panel-content mt-5 border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">

                                <button class="btn btn-primary ml-auto" type="submit" id="btnsave" name="btnsave"><i
                                            class="fas fa-save"></i> SIMPAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
        return (charCode >= 46 && charCode <= 57 || charCode == 8 || charCode == 40 || charCode == 41 || charCode == 43);
    }
</script>
<?= $this->endSection(); ?><!-- end js -->
