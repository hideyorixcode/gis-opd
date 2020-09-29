<?php
?>
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="gantijudul">Tambah Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <form novalidate id="form" name="form" method="post" enctype="multipart/form-data"
                      action="javascript:save();">
                    <input type="hidden" class="form-control" name="id" id="id">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_unker" name="nama_unker" required>
                        <div class="invalid-feedback" id="error_nama_unker"></div>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                        <div class="invalid-feedback" id="error_username"></div>
                    </div>

                    <div class="form-group">
                        <label id="lblpassword">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                        <div class="invalid-feedback" id="error_password"></div>
                    </div>

                    <div class="form-group">
                        <label id="lblkonfirmasi">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                        <div class="invalid-feedback" id="error_confirm_password"></div>
                    </div>


                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <div class="invalid-feedback" id="error_email"></div>
                    </div>

                    <div class="form-group">
                        <label>Aktif Akun</label>
                        <select class="form-control" id="active" name="active">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        <div class="invalid-feedback" id="error_active"></div>
                    </div>


                    <div class="form-group">
                        <label>Foto</label>
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="<?= base_url('public/uploads/user.png') ?>" class="img-thumbnail img-preview">
                            </div>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo" name="logo"
                                           onchange="previewImg()">
                                    <label class="custom-file-label" for="validatedCustomFile">Ganti Foto...</label>
                                    <div class="invalid-feedback" id="error_logo"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                    class="mdi mdi-content-save"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->