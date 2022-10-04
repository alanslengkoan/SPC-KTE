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

    // untuk datatable
    var untukTabelPemesanan = function() {
        tabelDataDt = $('#tabel-pemesanan').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= supplier_url() ?>pemesanan/get_data_dt',
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'No. Transaksi',
                    data: 'no_transaksi',
                    className: 'text-center',
                },
                {
                    title: 'Supplier',
                    data: 'nama',
                    className: 'text-center',
                },
                {
                    title: 'Jumlah Stok',
                    data: 'jumlah_stok',
                    className: 'text-center',
                },
                {
                    title: 'Total Akhir',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return 'Rp. ' + autoSeparator(full.total_akhir);
                    },
                },
                {
                    title: 'Status',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        var html = '';

                        if (full.status_approve === '0' || full.status_approve === null) {
                            html = `<button type="button" id="btn-approve" data-id="` + btoa(full.id_pembelian) + `" data-status="` + full.status_approve + `" class="btn btn-primary btn-sm waves-effect"><i class="fa fa-check"></i>&nbsp;Approve</button>`;
                        } else {
                            if (full.status_pembayaran === '0' || full.status_pembayaran === null) {
                                html = `<label class="label label-warning">Belum Melakukan Pembayaran</label>`;
                            } else {
                                if (full.status_invoice === '0' || full.status_invoice === null) {
                                    html = `<button type="button" id="btn-invoice" data-id_pembelian="` + btoa(full.id_pembelian) + `" data-id_pembayaran="` + full.id_pembayaran + `" data-no_transaksi="` + full.no_transaksi + `" data-status="` + full.status_invoice + `" class="btn btn-success btn-sm waves-effect"><i class="fa fa-dollar"></i>&nbsp;Invoice</button>`;
                                } else {
                                    html = `<label class="label label-success">Transaksi Selesai</label>`;
                                }
                            }
                        }

                        return `<div class="button-icon-btn button-icon-btn-cl">` + html + `</div>`;
                    },
                },
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return `<div class="button-icon-btn button-icon-btn-cl">
                                    <a href="<?= supplier_url() ?>pemesanan/detail/` + btoa(full.id_pembelian) + `" class="btn btn-info btn-sm waves-effect"><i class="fa fa-info"></i>&nbsp;Detail</a>
                                </div>`;
                    },
                },
            ],
        });
    }();

    // untuk approve
    var untukApprove = function() {
        $(document).on('click', '#btn-approve', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin ingin mengapprove transaksi tersebut?",
                text: "Data yang telah diaksi tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= supplier_url() ?>pemesanan/process_approve",
                        dataType: 'json',
                        data: {
                            id: ini.data('id'),
                            status: ini.data('status')
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
                                tabelDataDt.ajax.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();

    // untuk invoice
    var untukInvoice = function() {
        $(document).on('click', '#btn-invoice', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin ingin transaksi tersebut telah melakukan pembayaran?",
                text: "Data yang telah diaksi tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= supplier_url() ?>pemesanan/process_invoice",
                        dataType: 'json',
                        data: {
                            id_pembelian: ini.data('id_pembelian'),
                            id_pembayaran: ini.data('id_pembayaran'),
                            no_transaksi: ini.data('no_transaksi'),
                            status: ini.data('status')
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
                                tabelDataDt.ajax.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();
</script>