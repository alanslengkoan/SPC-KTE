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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>

<script>
    let tabelDataDt = null;

    // untuk datatable
    var untukTabelMasuk = function() {
        tabelDataDt = $('#tabel-masuk').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>masuk/get_data_dt',
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
                    title: 'Jenis Transaksi',
                    data: 'jenis_transaksi',
                    className: 'text-center',
                },
                {
                    title: 'Nama Barang',
                    data: 'nama',
                    className: 'text-center',
                },
                {
                    title: 'Jenis Barang',
                    data: 'jenis',
                    className: 'text-center',
                },
                {
                    title: 'Satuan Barang',
                    data: 'satuan',
                    className: 'text-center',
                },
                {
                    title: 'Harga Barang',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return 'Rp. ' + autoSeparator(full.harga);
                    },
                },
                {
                    title: 'Tanggal Pembelian',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return moment(full.tgl_pembelian).format('D MMMM YYYY');
                    },
                },
                {
                    title: 'Jumlah',
                    data: 'jumlah',
                    className: 'text-center',
                },
            ],
        });
    }();
</script>