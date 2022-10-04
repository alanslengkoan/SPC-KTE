<!-- begin:: breadcumb -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h4 class="m-b-10"><?= $title ?></h4>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="feather icon-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#!">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end:: breadcumb -->

<!-- begin:: content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="row invoice-contact">
                        <div class="col-md-8">
                            <div class="invoice-box row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive invoice-table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td><img src="<?= assets_url() ?>admin/images/invoice.png" class="m-b-10" alt=""></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Resco Riski Abadi
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1065 Mandan Road, Columbia MO, Missouri. (123)-65202
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="mailto:resco.riskiabadi@gmail.com" target="_top">resco.riskiabadi@gmail.com</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>+62 852-4266-8993</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" target="_blank">www.demo.com</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row invoive-info">
                            <div class="col-md-4 col-xs-12 invoice-client-info">
                                <h6>Informasi Distribusi :</h6>
                                <h6 class="m-0"><?= $penjualan->nama ?></h6>
                                <p class="m-0 m-t-10"><?= $penjualan->alamat ?></p>
                                <p class="m-0"><?= $penjualan->telepon ?></p>
                                <p><?= $penjualan->email ?></p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6>Informasi Penjualan :</h6>
                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Tgl Transaksi :</th>
                                            <td><?= tgl_indo($penjualan->tgl_penjualan) ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. Transaksi :</th>
                                            <td>
                                                <?= $penjualan->no_transaksi ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6>Informasi Invoice :</h6>
                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Tgl Invoice :</th>
                                            <td><?= tgl_indo($penjualan->tgl_invoice) ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. Invoice :</th>
                                            <td>
                                                <?= $penjualan->no_invoice ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Bayar :</th>
                                            <td>
                                                <?= rupiah($penjualan->total_bayar) ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered nowrap" id="tabel-penjualan-detail" style="width: 100%;">
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody>
                                        <tr>
                                            <th>Jumlah :</th>
                                            <td id="inpjumlahstok">0</td>
                                        </tr>
                                        <tr class="text-info">
                                            <td>
                                                <hr />
                                                <h5 class="text-primary">Total Akhir :</h5>
                                            </td>
                                            <td>
                                                <hr />
                                                <h5 class="text-primary" id="inptotalakhir">0</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Note :</h6>
                                <p>Invoice telah terbit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->