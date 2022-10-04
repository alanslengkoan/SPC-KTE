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
                <form id="form-add-upd" action="<?= distribusi_url() ?>pembayaran/process_save" method="POST">
                    <!-- begin:: id -->
                    <input type="hidden" name="inpidpenjualan" id="inpidpenjualan" value="<?= $penjualan->id_penjualan ?>" readonly="readonly" />
                    <input type="hidden" name="inpidpengiriman" id="inpidpengiriman" value="<?= $penjualan->id_pengiriman ?>" readonly="readonly" />
                    <!-- end:: id -->

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="w-75 p-2">Transaksi <?= $title ?></h5>
                                </div>
                                <div class="col-lg-6 text-right">
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No. Transaksi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpnotransaksi" id="inpnotransaksi" placeholder="" value="<?= $penjualan->no_transaksi ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Transaksi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpjenistransaksi" id="inpjenistransaksi" placeholder="" value="Penjualan" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Supplier</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $penjualan->nama ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jumlah Stok</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $penjualan->jumlah_stok ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ongkos Kirim</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= create_separator(250000) ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sub Total</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= create_separator($total_akhir) ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total Akhir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= create_separator($total_akhir + 250000) ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total Bayar&nbsp;*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inptotalbayar" id="inptotalbayar" value="<?= create_separator($total_akhir + 250000) ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Bukti Bayar&nbsp;*</label>
                                <div class="col-sm-10">
                                    <input type="file" name="inpbuktibayar" id="inpbuktibayar" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="pay"><i class="fa fa-credit-card"></i>&nbsp;Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->