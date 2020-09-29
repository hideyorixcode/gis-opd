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
                        <table id="hideyori-datatable" class="table dt-responsive w-100">
                            <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">LIST KONFIGURASI</th>
                                <th width="15%"></th>
                                <th width="5%"></th>
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
<?= $this->include('backend/admin/konfigurasi/modal'); ?>
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
                "pageLength": -1,
                fixedHeader: true,
                responsive: true,
                "aLengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('dashboard/konfigurasi/read/'); ?>",
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
                        "targets": [0, 2, 3]
                    },
                    {
                        "orderable": false,
                        "targets": [0, 2, 3]
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
        table.DataTable().ajax.reload(null, false);
    }


    //URUS TEXTFIELD DLL
    $("input").change(function () {
        $(this).closest('.form-group').find('input.form-control').removeClass('is-invalid');
        $(this).closest('.form-group').find('span.invalid-feedback').text('');
    });

    $("select").change(function () {
        $(this).closest('.form-group').find('div.input-group').removeClass('is-invalid');
        $(this).closest('.form-group').find('span.invalid-feedback').text('');
    });


    function edit(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.invalid-feedback').empty(); // clear error string
        //Ajax Load data from ajax
        $.ajax({
            url: "<?= base_url('dashboard/konfigurasi/edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                $('[name="id"]').val(id);
                $('[name="key"]').val(data.key);
                $('#hanya_label').hide();
                $('#gantijudul').text(data.label); // Set title to Bootstrap modal title
                $('#modal_form').modal({
                    backdrop: 'static',
                    keyboard: false  // to prevent closing with Esc button (if you want this too)
                });
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                var tipe = data.tipe;
                if (tipe == "textarea" || tipe == "textfield" || tipe == "editor") {
                    $('#komponen div').html('<textarea class="form-control" rows="3" name="content" id="content">' + data.content + '</textarea>');
                } else if (tipe == "email") {
                    $('#komponen div').html('<input type="email" class="form-control" name="content" id="content" value="' + data.content + '">');
                } else if (tipe == "logo") {
                    $('#komponen div').html('<label class="label-control"> ' + data.label + ' Saat ini :</label><img src="<?php echo base_url()?>/public/uploads/' + data.content + '" width="100px" height="100px"><br/><label id="hanya_label class="label-control">Ubah ' + data.label + '</label><div><input name="content" type="file" accept=".jpg, .jpeg, .png, .gif"></div>'); //
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
            }
        });
    }

    function save() {
        var url;

        url = "<?php echo base_url('dashboard/konfigurasi/update')?>";
        // ajax adding data to database
        var formData = new FormData($('#form')[0]);
        formData.append('<?= csrf_token() ?>', token);

        $.ajax({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                new_csrf_token = data.csrf_token;
                // alert(new_csrf_token);
                token = new_csrf_token;
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    table.DataTable().ajax.reload(null, false);
                    Swal.fire(
                        {
                            title: "Berhasil Menyimpan Konfigurasi",
                            type: "success",
                            showConfirmButton: false,
                            timer: 1000,
                        }
                    );
                    location.reload();

                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid'); //select parent twice to
                        $('#' + data.komponen_error[i] + '').text(data.error_string[i]);
                        $('[name="' + data.inputerror[i] + '"]').focus();
                    }
                }
                //$('#btnsave').html('Tambah <i class="mdi-content-send right"></i>');
                $('#btnsave').html('<i class="fal fa-save"></i> Simpan');
                $('#btnsave').attr('disabled', false); //set button enable
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.status);
                $('#btnsave').html('<i class="fal fa-save"></i> Simpan');
                $('#btnsave').attr('disabled', false); //set button enable
            }
        });
    }

</script>
<?= $this->endSection(); ?><!-- end js -->
