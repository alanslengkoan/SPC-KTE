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
        tabelDataDt = $('#tabel-pembayaran').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= supplier_url() ?>pembayaran/get_data_dt',
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'No. Invoice',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return full.no_invoice ?? 'Belum Cetak Invoice!';
                    },
                },
                {
                    title: 'No. Transaksi',
                    data: 'no_transaksi',
                    className: 'text-center',
                },
                {
                    title: 'Jenis Transaksi',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return capitalize(full.jenis_transaksi);
                    },
                },
                {
                    title: 'Total Bayar',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return 'Rp. ' + autoSeparator(full.total_bayar);
                    },
                },
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        if (full.status_invoice === '1') {
                            return `<div class="button-icon-btn button-icon-btn-cl">
                                        <a href="<?= supplier_url() ?>pembayaran/invoice/` + btoa(full.id_pembelian) + `" target="_blank" class="btn btn-primary btn-sm waves-effect"><i class="fa fa-dollar"></i>&nbsp;Invoice</a>
                                    </div>`;
                        } else {
                            return `-`;
                        }
                    },
                },
            ],
        });
    }();
</script>