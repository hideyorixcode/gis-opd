<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<!-- third party css -->
<link href="<?= base_url('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet"
      type="text/css"/>
<link href="<?= base_url('public/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>"
      rel="stylesheet" type="text/css"/>
<!-- third party css end -->
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
                            <li class="breadcrumb-item active"><?= ucfirst($judul) ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= ucfirst($judul) ?></h4>
                    <!--                    <br/>-->
                    <!--                    <div class="text-right mb-4">-->
                    <!--                        <a class="btn btn-primary waves-effect waves-light text-white"-->
                    <!--                           href="--><? //= base_url('dashboard/opd/form') ?><!--">-->
                    <!--                            <i class="mdi mdi-plus-box-multiple"></i> Tambah OPD-->
                    <!--                        </a>-->
                    <!--                    </div>-->
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="cetak" name="cetak" method="get" action="<?= base_url('dashboard/opd/cetak') ?>"
                              target="_blank">
                            <div class="form-group row">
                                <label class="col-4 col-form-label">Kabupaten/Kota</label>
                                <div class="col-7">
                                    <select class="form-control" data-toggle="select2" id="kabupaten_kota"
                                            name="kabupaten_kota">
                                        <option value="all">Seluruh Kab/Kota</option>
                                        <option value="">Alamat Kosong</option>
                                        <option value="kota bandar lampung">Kota Bandar Lampung</option>
                                        <option value="kota metro">Kota Metro</option>
                                        <option value="kabupaten lampung barat">Kab. Lampung Barat</option>
                                        <option value="kabupaten lampung selatan">Kab. Lampung Selatan</option>
                                        <option value="kabupaten lampung tengah">Kab. Lampung Tengah</option>
                                        <option value="kabupaten lampung timur">Kab. Lampung Timur</option>
                                        <option value="kabupaten lampung utara">Kab. Lampung Utara</option>
                                        <option value="kabupaten mesuji">Kab. Mesuji</option>
                                        <option value="kabupaten pesawaran">Kab. Pesawaran</option>
                                        <option value="kabupaten pesisir barat">Kab. Pesisir Barat</option>
                                        <option value="kabupaten pringsewu">Kab. Pringsewu</option>
                                        <option value="kabupaten tanggamus">Kab. Tanggamus</option>
                                        <option value="kabupaten tulang bawang">Kab. Tulang Bawang</option>
                                        <option value="kabupaten tulang bawang barat">Kab. Tulang Bawang Barat</option>
                                        <option value="kabupaten way kanan">Kab. Way Kanan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-8 offset-4">
                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                            onclick="reload_table();">
                                        <i class="mdi mdi-refresh-circle"></i> Filter Data
                                    </button>
                                    <button type="submit" class="btn btn-secondary waves-effect waves-light">
                                        <i class="mdi mdi-printer"></i> Cetak
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>
                    </div>
                <?php } ?>
                <div class="card">

                    <div class="card-body">
                        <table id="hideyori-datatable" class="table dt-responsive w-100">
                            <thead>
                            <tr>
                                <th class="all">#</th>
                                <th class="all">Nama OPD</th>
                                <th class="none">Username</th>
                                <th>Nama Pejabat</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th class="none">Email</th>
                                <th class="none">Website</th>
                                <th class="none">Options</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->
<?= $this->endSection(); ?><!-- end content -->

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?><!-- end modal -->

<?= $this->section('js'); ?>
<!-- third party js -->
<script src="<?= base_url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('public/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>

<!-- third party js ends -->
<script>
    var token = "<?= csrf_hash() ?>";
    var table;
    var base_url = '<?= base_url();?>';
    $(document).ready(function () {

        // initialize datatable
        table = $('#hideyori-datatable').dataTable(
            {
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                fixedHeader: true,
                responsive: true,
                "aLengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('dashboard/opd/read/'); ?>",
                    "type": "POST",
                    data: function (d) {
                        d.<?= csrf_token() ?> = token;
                        d.kabupaten_kota = $('#kabupaten_kota').val();
                    }
                },
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        className: 'control',
                    },
                    {
                        "className": "dt-center",
                        "targets": [0, 8, 9]
                    },
                    {
                        "orderable": false,
                        "targets": [0, 8, 9]
                    },
                ],
                language: {
                    "searchPlaceholder": "Cari...",
                    "sSearch": "",
                    "info": "Menampilkan Halaman ke _PAGE_ dari _PAGES_",
                    "lengthMenu": "_MENU_ Data/Halaman",
                    "sEmptyTable": "tidak ada data",
                    processing: '<i class="fa fa-spinner fa-spin"></i> memuat data<span class="sr-only">Loading...</span>',
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                "drawCallback": function (settings) {
                    console.log(settings.json);
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
            });
        table.on('xhr.dt', function (e, settings, json, xhr) {
            token = json.<?= csrf_token() ?>;
        });
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, true);
    }

    function delete_opd(id) {
        var data_token = {
            <?= csrf_token() ?>:
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
                    url: "<?= base_url('dashboard/opd/delete/'); ?>/" + id,
                    type: "GET",
                    data: data_token,
                    dataType: "JSON",
                    success: function (data) {
                        new_csrf_token = data.csrf_token;
                        token = new_csrf_token;
                        table.DataTable().ajax.reload(null, false);
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


</script>
<?= $this->endSection(); ?><!-- end js -->
