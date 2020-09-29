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
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <table id="hideyori-datatable" class="table dt-responsive w-100 ">
                            <thead>
                            <tr>
                                <th width="5%"></th>
                                <th width="15%">Waktu</th>
                                <th>Deskripsi</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>
                                    <input type="checkbox" id="check-all" data-toggle="tooltip" title="Check All"/>
                                </td>
                                <td colspan="2">
                                    <button class="btn btn-sm btn-danger" type="button" onclick="bulk_delete()"><i
                                                class="mdi mdi-trash-can"></i> Hapus Pilihan
                                    </button>
                                </td>
                                <td style="text-align:center;">
                                </td>
                            </tr>
                            </tfoot>
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
                "pageLength": 50,
                fixedHeader: true,
                responsive: true,
                "aLengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('dashboard/log/read/'); ?>",
                    "type": "POST",
                    data: function (d) {
                        d.<?= csrf_token() ?> = token;
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
                        "targets": [0, 3]
                    },
                    {
                        "orderable": false,
                        "targets": [0, 3]
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

    $('#hideyori_datatable').on('page.dt', function () {
        $("#check-all").prop('checked', false);
    });

    $("#check-all").click(function () {
        if ($(this).is(':checked')) {
            $(".data-check").prop('checked', $(this).prop('checked'));

            var rows = $('#hideyori_datatable').find('tbody tr');
            rows.addClass('selected');
        } else {

            $(".data-check").prop('checked', false);
            var rows = $('#hideyori_datatable').find('tbody tr');
            rows.removeClass('selected');
        }
    });

    $('#hideyori_datatable').on('click', '.data-check', function () {
        if ($(this).is(':checked')) {
            $(this).closest('tr').addClass('selected');
        } else {
            $(this).closest('tr').removeClass('selected');
        }
    });

    function bulk_delete() {

        var list_id = [];
        $(".data-check:checked").each(function () {
            list_id.push(this.value);
        });
        if (list_id.length > 0) {
            Swal.fire({
                title: 'Yakin akan menghapus : ' + list_id.length + ' data yg telah dipilih ?',
                text: "Cek kembali catatan anda sebelum dihapus",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        data: {id: list_id,<?= csrf_token() ?>:
                    token
                },
                    url: "<?= base_url('dashboard/log/bulk_delete')?>",
                        dataType
                :
                    "JSON",
                        success
                :

                    function (data) {
                        if (data.status) {
                            new_csrf_token = data.csrf_token;
                            token = new_csrf_token;
                            table.DataTable().ajax.reload(null, false);
                            Swal.fire(
                                {
                                    title: 'Berhasil Hapus ' + list_id.length + ' data',
                                    type: "success",
                                    showConfirmButton: false,
                                    timer: 1000,
                                }
                            );
                            $('#check-all').prop('checked', false); // Unchecks
                        } else {
                            Swal.fire({
                                title: 'Gagal Hapus ' + list_id.length + ' data',
                                type: "error",
                                showConfirmButton: false,
                                timer: 1000,
                            })
                        }
                    }

                ,
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                                title: "Data gagal dihapus",
                                type: "error",
                                showConfirmButton: false,
                                timer: 1000,
                            }
                        )
                    }
                })
                    ;
                }
            })
        } else {
            Swal.fire({
                    title: "Silahkan pilih data yang akan dihapus",
                    type: "warning",
                }
            )
        }
    }


</script>
<?= $this->endSection(); ?><!-- end js -->
