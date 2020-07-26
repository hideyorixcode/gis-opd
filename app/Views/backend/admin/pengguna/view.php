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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dahboard</a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= ucfirst($judul) ?></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-8">
                            <form method="get" id="formCari" name="formCari" action="javascript:getSearchData();"
                                  style="width: 100%">
                                <div class="form-group">
                                    <label class="sr-only">Cari...</label>
                                    <input type="search" class="form-control" id="teks" name="teks"
                                           placeholder="Cari dan tekan enter...">
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-3 mt-lg-0">
                                <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light"
                                   onclick="add()"><i class="mdi mdi-plus-circle mr-1"></i> Tambah Pengguna</a>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                </div> <!-- end card-box -->
            </div><!-- end col-->
        </div>
        <!-- end row -->
        <?= $this->include('backend/loaderData'); ?>
        <div id="getViewData">
            <?= $this->include('backend/admin/pengguna/tampilData'); ?>
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->
<?= $this->endSection(); ?><!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->include('backend/admin/pengguna/modal'); ?>
<?= $this->endSection(); ?><!-- end modal -->

<?= $this->section('js'); ?>
<script>
    var mode = 'tampil';
    var token = "<?= csrf_hash() ?>";
    var base_url = '<?= base_url();?>';

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('id').split('page_link=')[1];
        if (mode == 'tampil') {
            getViewData(page);
        } else {
            getSearchData(page);
        }
    });


    function getViewData(page) {
        $(".loaderData").show();
        var urlData = '<?=base_url('dashboard/pengguna/getViewData?page_link=')?>';
        $.ajax({
            url: urlData + page,
            success: function (data) {
                $('#getViewData').html(data);
                $(".loaderData").hide();
                mode = 'tampil';
            }
        });
    }

    function getSearchData(page = 1) {
        $(".loaderData").show();
        var teks = $("#teks").val();
        if (teks == '') {
            var urlData = '<?=base_url('dashboard/pengguna/getSearchData?page_link=')?>';
            mode = 'tampil';
        } else {
            var urlData = '<?=base_url('dashboard/pengguna/getSearchData?teks=')?>' + teks + '&page_link=';
            mode = 'cari';
        }
        $.ajax({
            url: urlData + page,
            // data:{teks:teks},
            success: function (data) {
                $('#getViewData').html(data);
                $(".loaderData").hide();
            }
        });
    }

    $(document).ready(function () {

        $(".loaderData").hide();
    });

    function delete_id(id) {
        var data_token = {<?= csrf_token() ?>:
        token
    }

        Swal.fire({
            title: 'Apakah anda ingin menghapus data ini',
            text: "Data yang anda hapus, tidak akan kembali",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('dashboard/pengguna/delete')?>/" + id,
                    type: "GET",
                    data: data_token,
                    dataType: "JSON",
                    success: function (data) {
                        new_csrf_token = data.csrf_token;
                        token = new_csrf_token;
                        getViewData(1);
                        Swal.fire(
                            {
                                title: "Data berhasil dihapus",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1000,
                            }
                        )
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                                title: "Data gagal dihapus",
                                type: "error",
                                showConfirmButton: false,
                                timer: 1000,
                            }
                        )
                    }
                });
            }
        })
    }

    function add() {
        $('#modal_form').modal({
            backdrop: 'static',
            keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.invalid-feedback').empty(); // clear error string
        $('#modal_form').appendTo("body");
        $('#modal_form').modal('show'); // show bootstrap modal
        $('#lblpassword').text('Password \n');
        $('#lblkonfirmasi').text('Konfirmasi Password\n');
        $('#lblpassword').attr("placeholder", "ketik password");
        $('#lblkonfirmasi').attr("placeholder", "ketik konfirmasi password");
        $('#gantijudul').text('TAMBAH PENGGUNA'); // Set Title to Bootstrap modal title
        $('#btnsave').html('<i class="fal fa-save"></i> Simpan');
    }

    function edit(id) {
        $('#modal_form').modal({
            backdrop: 'static',
            keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
        save_method = 'edit';
        $('#form')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.invalid-feedback').empty(); // clear error string
        //Ajax Load data from ajax
        $.ajax({
            url: "<?= base_url('dashboard/pengguna/edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                $('[name="id"]').val(id);
                $('[name="nama_unker"]').val(data.nama_unker);
                $('[name="email"]').val(data.email);
                $('[name="username"]').val(data.username);
                $('[name="active"]').val(data.active);
                $('#lblpassword').text('Password (Jika Merubah Password) \n');
                $('#lblkonfirmasi').text('Konfirmasi Password (Jika Merubah Password) \n');
                $('#lblpassword').attr("placeholder", "ketik password jika ingin dirubah");
                $('#lblkonfirmasi').attr("placeholder", "ketik konfirmasi password jika ingin dirubah");

                if (data.logo) {
                    const logoPreview = document.querySelector('.img-preview');
                    logoPreview.src = base_url + '/public/uploads/' + data.logo;
                }

                $('#gantijudul').text('UBAH DATA PENGGUNA'); // Set Title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            }
        });
    }

    function save() {
        var url;
        if (save_method == 'add') {
            url = "<?= base_url('dashboard/pengguna/create')?>";
        } else {
            url = "<?= base_url('dashboard/pengguna/update')?>";
        }
        var formData = new FormData($('#form')[0]);
        formData.append('<?= csrf_token() ?>', token);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                new_csrf_token = data.csrf_token;
                // alert(new_csrf_token);
                token = new_csrf_token;
                if (data.status_ajax) //if success close modal and reload ajax table
                {
                    if (save_method == 'add') {

                        $('#modal_form').modal('hide');
                        getViewData(1);
                        Swal.fire(
                            {
                                title: "Berhasil Input Data",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1000,
                            }
                        );
                    } else {
                        $('#modal_form').modal('hide');
                        getViewData(1);
                        Swal.fire(
                            {
                                title: "Berhasil Ubah Data",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1000,
                            }
                        );
                    }
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid'); //select parent twice to
                        $('#' + data.komponen_error[i] + '').text(data.error_string[i]);
                        $('[name="' + data.inputerror[i] + '"]').focus();
                    }
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            }
        });
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

</script>
<?= $this->endSection(); ?>
