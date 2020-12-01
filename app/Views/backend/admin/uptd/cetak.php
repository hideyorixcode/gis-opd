<?= $this->extend('backend/template'); ?>

<?= $this->section('css'); ?>
<!-- third party css -->
<link href="<?= base_url('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet"
      type="text/css"/>
<link href="<?= base_url('public/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>"
      rel="stylesheet" type="text/css"/>
<link href="<?= base_url('public/assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>"
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
                    <br/>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">OPD</label>
                            <div class="col-7">
                                <input type="hidden" class="form-control" name="id_unker_opd" id="id_unker_opd"
                                       readonly value="<?= ($id_unker_opd); ?>">
                                <input type="text" class="form-control" name="nama_unker" id="nama_unker"
                                       readonly value="<?= ($unker_opd); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-4 col-form-label">Status</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="statusPost" id="statusPost"
                                       readonly value="<?= ($statusPost); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-4 col-form-label">Kabupaten/Kota</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="kabupaten_kota" id="kabupaten_kota"
                                       readonly value="<?= ($kabupaten_kota); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <a href="javascript:window.print()"
                                           class="btn btn-primary waves-effect waves-light d-print-none"><i
                                                    class="mdi mdi-printer mr-1"></i> Print</a>
                                    </div>
                                    <div id="buttons_cetak" class="col-9"></div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <table id="hideyori-datatable" class="table dt-responsive w-100">
                            <thead>
                            <tr>
                                <th class="all">#</th>
                                <th class="all">Nama UPTD / CABDIN / GEDUNG</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>OPD</th>
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
<script src="<?= base_url('public/assets/libs/select2/js/select2.min.js') ?>"></script>
<script src="<?= base_url('public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('public/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('public/assets/libs/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('public/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<!-- third party js ends -->
<script>
    $('[data-toggle="select2"]').select2();
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
                "ordering": false,
                "searching": false,
                "lengthChange": false,
                "paging": false,
                "info": false,
                "pageLength": -1,
                // "aLengthMenu": [
                //     [10, 25, 50, 100, -1],
                //     [10, 25, 50, 100, "Semua"]
                // ],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('dashboard/uptd-cabdin/read-cetak/'); ?>",
                    "type": "POST",
                    data: function (d) {
                        d.<?= csrf_token() ?> = token;
                        d.statusPost = $('#statusPost').val();
                        d.id_unker_opd = $('#id_unker_opd').val();
                        d.kabupaten_kota = $('#kabupaten_kota').val();
                        // d.verifikasi = $('#verifikasi').val();
                        // d.id_lab = $('#id_lab').val();
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
                        "targets": [0, 5]
                    },
                    // {
                    //     "orderable": false,
                    //     "targets": [0, 9, 10]
                    // },
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
                "initComplete": function (settings, json) {
                    window.print();
                },
            });
        table.on('xhr.dt', function (e, settings, json, xhr) {
            token = json.<?= csrf_token() ?>;
        });

        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [
                {
                    extend: 'excel',
                    text: 'Ekspor Excel',
                    title: 'UPTD_CABDIN_GEDUNG <?=$unker_opd;?>',
                },
                {
                    extend: 'pdf',
                    text: 'Ekspor PDF',
                    title: 'UPTD_CABDIN_GEDUNG <?=$unker_opd;?>',
                }
            ]
        }).container().appendTo($('#buttons_cetak'));
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, true);
    }


</script>
<?= $this->endSection(); ?><!-- end js -->
