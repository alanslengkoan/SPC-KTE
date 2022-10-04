<script src="<?= assets_url() ?>admin/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/jszip.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/pdfmake.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/vfs_fonts.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/extensions/key-table/js/dataTables.keyTable.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
    let tabelDataDt = null;
    let harga = $('#inpharga');
    let jumlah = $('#inpjumlah');

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd-head', function(e) {
            e.preventDefault();
            $('#inpjumlah').attr('required', 'required');
            $('#inptotalakhir').attr('required', 'required');

            if ($('#form-add-upd-head').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save-head').attr('disabled', 'disabled');
                        $('#save-head').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        swal({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            button: response.button,
                        }).then((value) => {
                            window.location = '<?= distribusi_url() ?>pembelian/detail/' + btoa(response.id);
                        });
                        $('#save-head').removeAttr('disabled');
                        $('#save-head').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                })
            }
        });
    }();

    // untuk datatable
    var untukTabelTempporaryPembelian = function() {
        tabelDataDt = $('#tabel-temp-pembelian').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= distribusi_url() ?>pembelian/get_data_temp_dt',
            preDrawCallback: function(settings) {
                if (this.fnSettings().fnRecordsTotal() !== 0) {
                    $('#btn-simpan').html(`
                        <button type="submit" class="btn btn-primary btn-sm btn-block waves-effect waves-light" id="save-head"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                    `);
                };
            },
            footerCallback: function(row, data, start, end, display) {
                var countJumlah = 0;
                var total = 0;

                $(data).each(function(i) {
                    countJumlah += data[i].jumlah * 1;
                    total += data[i].total * 1;
                });

                // untuk form footer
                $('#inpjumlahstok').val(countJumlah);
                $('#inptotalakhir').val(autoSeparator(total));
            },
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Kode Barang',
                    data: 'kd_barang',
                    className: 'text-center',
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    className: 'text-center',
                },
                {
                    title: 'Satuan',
                    data: 'satuan',
                    className: 'text-center',
                },
                {
                    title: 'Jenis',
                    data: 'jenis',
                    className: 'text-center',
                },
                {
                    title: 'Jumlah',
                    data: 'jumlah',
                    className: 'text-center',
                },
                {
                    title: 'Harga',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return 'Rp. ' + autoSeparator(full.harga);
                    },
                },
                {
                    title: 'Total',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return 'Rp. ' + autoSeparator(full.total);
                    },
                },
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <div class="button-icon-btn button-icon-btn-cl">
                            <button type="button" id="btn-upd" data-id="` + full.id_t_penjualan + `" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>&nbsp;
                            <button type="button" id="btn-del" data-id="` + full.id_t_penjualan + `" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        </div>
                    `;
                    },
                },
            ],
        });
    }();

    // untuk reset form
    var untukResetForm = function() {
        $(document).on('click', '#btn-add', function() {
            $('#judul-add-upd').html('Tambah');
            $('#inpidtpenjualan').val('');
            $('#inpkdbarang').val('');
            $('#inpnama').val('');
            $('#inpsatuan').val('');
            $('#inpharga').val('0');
            $('#inpstokproduksi').val('0');
            $('#inpjumlah').val('0');
            $('#inptotal').val('0');
            $('#save').attr('disabled', false);
        });
    }();

    // untuk pilih bahan baku
    let untukPilihBahanBaku = function() {
        $(document).on('change', '#inpkdbarang', function() {
            var ini = $(this);

            $.ajax({
                type: "post",
                url: "<?= distribusi_url() ?>pembelian/search_barang",
                dataType: 'json',
                data: {
                    id: ini.val(),
                },
                success: function(response) {
                    let h = parseInt(harga.val().replace('.', ''));
                    let j = parseInt(jumlah.val());

                    hitungTotal(j, h);

                    $('#inpnama').val(response.nama);
                    $('#inpsatuan').val(response.satuan);
                    $('#inpstokproduksi').val(response.stok);
                    harga.val(autoSeparator(response.harga));

                    if (response.stok === 0) {
                        $('#save').attr('disabled', true);
                    } else {
                        $('#save').attr('disabled', false);
                    }
                }
            });
        });
    }();

    // untuk jumlah
    let untukJumlah = function() {
        $(document).on('keyup', '#inpjumlah', function() {
            var ini = $(this);

            if (ini.val() == "") {
                ini.val('0');
            } else if (ini.val() > 0) {
                ini.val(Number(ini.val()))
            }

            let h = parseInt(harga.val().replace('.', ''));
            let j = ini.val();

            hitungTotal(j, h);
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahDataTemporary = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#inpkdbarang').attr('required', 'required');
            $('#inpnama').attr('required', 'required');
            $('#inpharga').attr('required', 'required');
            $('#inpjumlah').attr('required', 'required');
            $('#inptotal').attr('required', 'required');

            if ($('#form-add-upd').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save').attr('disabled', 'disabled');
                        $('#save').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        swal({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            button: response.button,
                        }).then((value) => {
                            $('#modal-add-upd').modal('hide');
                            tabelDataDt.ajax.reload();
                        });
                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                })
            }
        });
    }();

    // untuk get id
    var untukGetIdData = function() {
        $(document).on('click', '#btn-upd', function() {
            var ini = $(this);

            $.ajax({
                type: "POST",
                url: "<?= distribusi_url() ?>pembelian/get_temp",
                dataType: 'json',
                data: {
                    id: ini.data('id')
                },
                beforeSend: function() {
                    $('#judul-add-upd').html('Ubah');
                    ini.attr('disabled', 'disabled');
                    ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                },
                success: function(response) {
                    $('#inpidtpenjualan').val(response.id_t_penjualan);
                    $('#inpkdbarang').val(response.kd_barang).trigger('change');
                    $('#inpjumlah').val(response.jumlah);
                    $('#inpharga').val(response.harga);

                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-pencil"></i>&nbsp;Ubah');
                }
            });
        });
    }();

    // untuk hapus data
    var untukHapusData = function() {
        $(document).on('click', '#btn-del', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin ingin menghapusnya?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= distribusi_url() ?>pembelian/process_del_temp",
                        dataType: 'json',
                        data: {
                            id: ini.data('id')
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                        },
                        success: function(data) {
                            swal({
                                title: data.title,
                                text: data.text,
                                icon: data.type,
                                button: data.button,
                            }).then((value) => {
                                location.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();

    // untuk menghitung total
    function hitungTotal(jumlah, harga) {
        let total = (jumlah * harga);

        $('#inptotal').val(autoSeparator(total));
    }
</script>