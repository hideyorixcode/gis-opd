<div class="row">
<?php
if ($data_pengguna) {
    $no = 1;
    foreach ($data_pengguna as $key => $value) : ?>
        <div class="col-lg-4">
            <div class="text-center card-box">
                <div class="pt-2 pb-2">
                    <img src="<?= $value['logo'] ? base_url('public/uploads/' . $value['logo']) : base_url('public/uploads/user.png') ?>"
                         class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">
                    <h4 class="mt-3"><a href="#" class="text-dark"><?= $value['nama_unker'] ?></a></h4>
                    <p class="text-muted">@<?= $value['username'] ?> <span></p>
                    <?php if ($usernamebawaan != $value['username']) {
                        ?>
                        <a href="javascript:void(0);" onclick="edit('<?= encodeHash($value['id']) ?>')"
                           class="btn btn-success btn-sm waves-effect waves-light">Ubah</a>
                        <a href="javascript:void(0);" onclick="delete_id('<?= encodeHash($value['id']) ?>')"
                           class="btn btn-danger btn-sm waves-effect">Hapus</a>
                    <?php } ?>
                </div> <!-- end .padding -->
            </div> <!-- end card-box-->
        </div> <!-- end col -->
        <?php $no++;
    endforeach;
} else {
    ?>

    <div class="row">
        <div class="col-12">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
                <div class="d-flex align-items-center">
                    <div class="alert-icon width-2">
                        <span class="fa fa-info-circle color-primary-400" style="font-size: 22px;"></span>
                    </div>
                    <div class="flex-1">
                        <?= $pesan_kosong; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
    <div class="col-12">
        <div class="col-xl-12 d-flex justify-content-center m-2">
            <?= $pager->links('link', 'default_full') ?>
        </div>
    </div>
</div>
<!-- end row -->