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

<script>
    let tabelDataDt = null;

    // untuk datatable
    var untukTabelBarang = function() {
        tabelDataDt = $('#tabel-barang').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>laporan/get_data_barang_dt',
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-info',
                    text: '<i class="fa fa-copy"></i>&nbsp;Copy',
                    title: function() {
                        return 'Sistem Informasi Supply Chain';
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel-o"></i>&nbsp;Excel',
                    title: function() {
                        return 'Sistem Informasi Supply Chain';
                    }
                },
                {
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf-o"></i>&nbsp;Pdf',
                    action: function(e, dt, node, config) {
                        window.open('<?= admin_url() ?>laporan/barang_pdf');
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-file-o"></i>&nbsp;CSV',
                    title: function() {
                        return 'Sistem Informasi Supply Chain';
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa fa-print"></i>&nbsp;Print',
                    autoPrint: false,
                    title: function() {
                        return 'Sistem Informasi Supply Chain';
                    },
                }
            ],
            initComplete: function() {
                $('button.dt-button').hide();
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
                    title: 'Harga',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return 'Rp. ' + autoSeparator(full.harga);
                    },
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
                    title: 'Stok',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        var stok = (parseInt(full.stok_in) - parseInt(full.stok_out));
                        return (isNaN(stok)) ? 0 : stok;
                    },
                },
            ],
        });
    }();
</script>