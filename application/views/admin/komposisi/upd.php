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
                <form id="form-add-upd-head" action="<?= admin_url() ?>komposisi/process_save" method="POST">
                    <!-- begin:: id -->
                    <input type="hidden" name="inpidkomposisi" id="inpidkomposisi" value="<?= $komposisi->id_komposisi ?>" />
                    <!-- end:: id -->

                    <!-- begin:: form 1 -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="w-75 p-2"> <?= $title ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Barang *</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="inpkdbarang" id="inpkdbarang">
                                        <option value="">- Pilih Barang -</option>
                                        <?php foreach ($barang->result() as $key => $row) { ?>
                                            <option value="<?= $row->kd_barang ?>" <?= ($komposisi->kd_barang === $row->kd_barang ? 'selected' : '') ?>><?= $row->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Stok Produksi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpstokbarang" id="inpstokbarang" value="<?= $komposisi->stok_barang ?>" placeholder="Masukkan jumlah produksi" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: form 1 -->
                    <!-- begin:: table -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="w-75 p-2">Detail <?= $title ?></h5>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="button" id="btn-add" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <table class="table table-striped table-bordered nowrap" id="tabel-komposisi-detail" style="width: 100%;"></table>
                            <hr>
                            <div id="btn-simpan"></div>
                        </div>
                    </div>
                    <!-- end:: table -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->

<!-- begin:: modal tambah & ubah -->
<div class="modal fade" id="modal-add-upd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $title ?></h4>
            </div>
            <form id="form-add-upd" action="<?= admin_url() ?>komposisi/process_save_det" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="inpidkomposisi" value="<?= $komposisi->id_komposisi ?>" />
                <input type="hidden" name="inpidkomposisidetail" id="inpidkomposisidetail" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bahan Baku *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpkdbahanbaku" id="inpkdbahanbaku">
                                <option value="">- Pilih Barang -</option>
                                <?php foreach ($bahan_baku->result() as $key => $row) { ?>
                                    <option value="<?= $row->kd_bahan_baku ?>">(<?= $row->kd_bahan_baku ?>) - <?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Stok Bahan Baku *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpstokbahanbaku" id="inpstokbahanbaku" placeholder="Masukkan jumlah stok yang dibutuhkan" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm waves-effect" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="save"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end:: modal tambah & ubah -->