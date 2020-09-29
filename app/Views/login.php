<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Log In | <?= $nama_app; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('public/assets/images/favicon.ico') ?>">

    <!-- App css -->
    <link href="<?= base_url('public/assets/css/bootstrap-material.min.css') ?>" rel="stylesheet" type="text/css"
          id="bs-default-stylesheet"/>
    <link href="<?= base_url('public/assets/css/app-material.min.css') ?>" rel="stylesheet" type="text/css"
          id="app-default-stylesheet"/>

    <link href="<?= base_url('public/assets/css/bootstrap-material-dark.min.css') ?>" rel="stylesheet" type="text/css"
          id="bs-dark-stylesheet"
          disabled/>
    <link href="<?= base_url('public/assets/css/app-material-dark.min.css') ?>" rel="stylesheet" type="text/css"
          id="app-dark-stylesheet"
          disabled/>

    <!-- icons -->
    <link href="<?= base_url('public/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css"/>

</head>

<body class="authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="<?= base_url('public/assets/images/logo-dark.png') ?>" alt=""
                                                     height="22">
                                            </span>
                                </a>

                                <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="<?= base_url('public/assets/images/logo-light.png') ?>" alt=""
                                                     height="22">
                                            </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">Gunakan Username OPD masing-masing untuk login</p>
                        </div>

                        <form action="<?= base_url('syslog/cek_login') ?>" method="post" id="form" name="form"
                              enctype="multipart/form-data">
                            <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>
                                </div>
                            <?php } ?>
                            <?= csrf_field() ?>
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" type="text" id="username" name="username" required=""
                                       placeholder="USERNAME" autofocus value="<?= old('username') ?>">
                                <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                                           placeholder="PASSWORD" value="<?= old('password') ?>" required>
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Log In</button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt">
    <script>document.write(new Date().getFullYear())</script> &copy; <?= $judul_aplikasi; ?> by <a href="#" class="text-white-50"><?= $author; ?></a>
</footer>

<!-- Vendor js -->
<script src="<?= base_url('public/assets/js/vendor.min.js') ?>"></script>

<!-- App js -->
<script src="<?= base_url('public/assets/js/app.min.js') ?>"></script>

</body>
</html>