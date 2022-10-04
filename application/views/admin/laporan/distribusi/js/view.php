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
    var untukTabelDistribusi = function() {
        tabelDataDt = $('#tabel-distribusi').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>laporan/get_data_distribusi_dt',
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-info',
                    text: '<i class="fa fa-copy"></i>&nbsp;Copy'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel-o"></i>&nbsp;Excel'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf-o"></i>&nbsp;Pdf'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-file-o"></i>&nbsp;CSV'
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa fa-print"></i>&nbsp;Print'
                }
            ],
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Kode Distribusi',
                    data: 'kd_distribusi',
                    className: 'text-center',
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    className: 'text-center',
                },
                {
                    title: 'E-Mail',
                    data: 'email',
                    className: 'text-center',
                },
                {
                    title: 'Telepon',
                    data: 'telepon',
                    className: 'text-center',
                },
                {
                    title: 'NPWP',
                    data: 'npwp',
                    className: 'text-center',
                },
            ],
        });
    }();
</script>