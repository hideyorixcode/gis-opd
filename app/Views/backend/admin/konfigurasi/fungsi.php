
<script>
    var token = "<?= csrf_hash() ?>";
    var table;
    var base_url = '<?= base_url();?>';
    $(document).ready(function () {
        // initialize datatable
        table = $('#hideyori_datatable').dataTable(
            {
                "processing": true,
                "serverSide": true,
                "pageLength": 10,
                fixedHeader: true,
                responsive: true,
                "aLengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('dashboard/konfigurasi/read'); ?>",
                    "type": "POST",
                    data: function (d) {
                        d.<?= csrf_token() ?> = token;
                    }
                },
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                    },
                    {
                        "className": "dt-center",
                        "targets": [0, 2]
                    },
                    {
                        "orderable": false,
                        "targets": [0, 2]
                    },
                ],
                language: {
                    "searchPlaceholder": "Cari...",
                    "sSearch": "",
                    "info": "Menampilkan Halaman ke _PAGE_ dari _PAGES_",
                    "lengthMenu": "_MENU_ Data/Halaman",
                    "sEmptyTable": "Tidak ada data di database",
                    processing: '<i class="fal fa-spinner fa-spin"></i> memuat data<span class="sr-only">Loading...</span>',
                },
                "drawCallback": function (settings) {
                    console.log(settings.json);
                },
            });
        table.on('xhr.dt', function (e, settings, json, xhr) {
            token = json.<?= csrf_token() ?>;
        });
        //$("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
    });


    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }

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
                    $('#komponen div').html('<label class="label-control"> ' + data.label + ' Saat ini :</label><img src="<?php echo base_url()?>/public/img/' + data.content + '" width="100px" height="100px"><br/><label id="hanya_label class="label-control">Ubah ' + data.label + '</label><div><input name="content" type="file" accept=".jpg, .jpeg, .png, .gif"></div>'); //
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
