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
                <form>
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
                                <label class="col-sm-2 col-form-label">No. Transaksi *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpnotransaksi" id="inpnotransaksi" placeholder="Masukkan kode barang" value="<?= $pembelian->no_transaksi ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Supplier *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpnotransaksi" id="inpnotransaksi" placeholder="Masukkan kode barang" value="<?= $pembelian->nama ?>" readonly="readonly" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="w-75 p-2">Detail Transaksi <?= $title ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <table class="table table-striped table-bordered nowrap" id="tabel-pembelian-detail">
                            </table>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpjumlahstok" id="inpjumlahstok" value="0" placeholder="0" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total Akhir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inptotalakhir" id="inptotalakhir" value="0" placeholder="0" readonly="readonly" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->