<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Login -  <?= $nama_app; ?>
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="<?= base_url('public/css/vendors.bundle.css') ?>">
    <link rel="stylesheet" media="screen, print" href="<?= base_url('public/css/app.bundle.css') ?>">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/img/favicon/favicon.ico') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/img/favicon/favicon.ico') ?>">
    <link rel="mask-icon" href="<?= base_url('public/img/favicon/safari-pinned-tab.svg') ?>" color="#5bbad5">
    <!-- Optional: page related CSS-->
    <link rel="stylesheet" media="screen, print" href="<?= base_url('public/css/fa-brands.css') ?>">
    <link rel="stylesheet" media="screen, print" href="<?= base_url('public/css/themes/cust-theme-4.css') ?>">
</head>

<body>
<div class="page-wrapper">
    <div class="page-inner bg-brand-gradient">
        <div class="page-content-wrapper bg-transparent m-0">
            <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                <div class="d-flex align-items-center container p-0">
                    <div
                            class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                        <a href="javascript:void(0)"
                           class="page-logo-link press-scale-down d-flex align-items-center">
                            <img src="<?= base_url('public/img/' . $logo_web) ?>" alt="SmartAdmin WebApp"
                                 aria-roledescription="logo" style="width: 28px; height: 28px">
                            <span class="page-logo-text mr-1"><?= $nama_app; ?></span>
                        </a>
                    </div>

                </div>
            </div>
            <div class="flex-1"
                 style="background: url(<?= base_url('public/img/svg/pattern-3.svg') ?>) no-repeat center bottom fixed; background-size: cover;">
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    <div class="row">
                        <div class="col col-md-6 col-lg-7 hidden-sm-down">
                            <h2 class="fs-xxl fw-500 mt-4 text-white">
                                <?= $judul_aplikasi; ?>
                                <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                    <?= $deskripsi_web; ?>
                                </small>
                            </h2>

                            <div class="d-sm-flex flex-column align-items-center justify-content-center d-md-block">
                                <div class="px-0 py-1 mt-5 text-white fs-nano opacity-50">
                                    Social Media
                                </div>
                                <div class="d-flex flex-row opacity-70">
                                    <a href="#" class="mr-2 fs-xxl text-white">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                    <a href="#" class="mr-2 fs-xxl text-white">
                                        <i class="fab fa-twitter-square"></i>
                                    </a>
                                    <a href="#" class="mr-2 fs-xxl text-white">
                                        <i class="fab fa-google-plus-square"></i>
                                    </a>
                                    <a href="#" class="mr-2 fs-xxl text-white">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                            <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                                Secure login
                            </h1>
                            <div class="card p-4 rounded-plus bg-faded">
                                <form action="<?= base_url('syslog/cek_login') ?>" method="post" id="form" name="form"
                                      enctype="multipart/form-data">
                                    <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times-square"></i></span>
                                            </button>
                                            <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>
                                        </div>

                                    <?php } ?>
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" id="username" name="username"
                                               class="form-control form-control-lg <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                                               placeholder="USERNAME" autofocus value="<?= old('username') ?>" required>
                                        <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                                        <div class="help-block">Username akun anda</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password"
                                               class="form-control form-control-lg <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                                               placeholder="PASSWORD" value="<?= old('password') ?>" required>
                                        <div class=" invalid-feedback"><?= $validation->getError('password'); ?></div>
                                        <div class="help-block">Kata Sandi akun anda</div>
                                    </div>

                                    <div class="row no-gutters">

                                        <div class="col-lg-12 pl-lg-1 my-2">
                                            <button id="js-login-btn" type="submit"
                                                    class="btn btn-primary btn-block btn-lg"><i
                                                        class="fal fa-sign-in"></i> LOGIN
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                        <?= date('Y') ?> © <?= $judul_aplikasi; ?> by&nbsp;<a href='#'
                                                                              class='text-white opacity-40 fw-500'
                                                                              title='BeRes'
                                                                              target='_blank'><?= $author; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('public/js/vendors.bundle.js') ?>"></script>
<script src="<?= base_url('public/js/app.bundle.js') ?>"></script>
</body>

</html>