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
    let status_invoice = [
        [
            'warning',
            'Belum Cetak Invoice',
        ],
        [
            'success',
            'Telah Cetak Invoice'
        ]
    ];
    let status_approve = [
        [
            'warning',
            'Transaksi Belum Diapprove',
        ],
        [
            'success',
            'Transaksi Belah Diapprove'
        ]
    ];
    let status_pembayaran = [
        [
            'warning',
            'Belum Melakukan Pembayaran',
        ],
        [
            'success',
            'Telah Melakukan Pembayaran'
        ]
    ];

    // untuk datatable
    var untukTabelpenjualan = function() {
        tabelDataDt = $('#tabel-penjualan').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= distribusi_url() ?>penjualan/get_data_dt',
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
                    title: 'Konsumen',
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
                    title: 'Status Transaksi',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        let invoice = (full.status_invoice === null ? '0' : full.status_invoice);
                        let approve = (full.status_approve === null ? '0' : full.status_approve);
                        let pembayaran = (full.status_pembayaran === null ? '0' : full.status_pembayaran);

                        if (approve === '0') {
                            return `<label class="label label-` + status_approve[approve][0] + `">` + status_approve[approve][1] + `</label>`;
                        } else {
                            if (pembayaran === '0') {
                                return `<label class="label label-` + status_pembayaran[pembayaran][0] + `">` + status_pembayaran[pembayaran][1] + `</label>`;
                            } else {
                                if (invoice === '0') {
                                    return `<label class="label label-` + status_invoice[invoice][0] + `">` + status_invoice[invoice][1] + `</label>`;

                                } else {
                                    return `<label class="label label-` + status_invoice[invoice][0] + `">` + status_invoice[invoice][1] + `</label>`;

                                }
                            }
                        }
                    },
                },
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        var html = '';

                        if (full.status_approve === '1' && full.status_pembayaran === '1' && full.status_invoice === '1') {
                            html = `
                                <a href="<?= distribusi_url() ?>pembayaran/invoice/` + btoa(full.id_penjualan) + `" target="_blank" class="btn btn-primary btn-sm waves-effect"><i class="fa fa-dollar"></i>&nbsp;Invoice</a>&nbsp;
                                <a href="<?= distribusi_url() ?>penjualan/detail/` + btoa(full.id_penjualan) + `" target="_blank" class="btn btn-info btn-sm waves-effect"><i class="fa fa-info"></i>&nbsp;Detail</a>
                            `;
                        } else if (full.status_approve === '1' && full.status_pembayaran === '0' && full.status_invoice === '0') {
                            html = `
                                <a href="<?= distribusi_url() ?>pembayaran/add/` + btoa(full.id_penjualan) + `" target="_blank" class="btn btn-primary btn-sm waves-effect"><i class="fa fa-dollar"></i>&nbsp;Pembayaran</a>&nbsp;
                                <a href="<?= distribusi_url() ?>penjualan/detail/` + btoa(full.id_penjualan) + `" target="_blank" class="btn btn-info btn-sm waves-effect"><i class="fa fa-info"></i>&nbsp;Detail</a>
                            `;
                        } else {
                            html = `
                                <a href="<?= distribusi_url() ?>penjualan/detail/` + btoa(full.id_penjualan) + `" target="_blank" class="btn btn-info btn-sm waves-effect"><i class="fa fa-info"></i>&nbsp;Detail</a>
                            `;
                        }

                        return `<div class="button-icon-btn button-icon-btn-cl">` + html + `</div>`;
                    },
                },
            ],
        });
    }();
</script>