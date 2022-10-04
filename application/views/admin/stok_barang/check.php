<div class="form-group row">
    <label class="col-sm-2 col-form-label">Stok Produksi</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="inpstokbarang" id="inpstokbarang" readonly="readonly" value="<?= $barang->stok_barang ?? 0 ?>" />
    </div>
</div>
<hr>
<div class="row">
    <?php foreach ($check->result() as $key => $value) { ?>
        <div class="col-lg-6">
            <div class="form-group row">
                <label class="col-sm-6 col-form-label"><?= $value->nama ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" readonly="readonly" value="<?= $value->stok_bahan_baku ?>" />
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <label class="col-sm-6 col-form-label">Stok Tersedia</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" readonly="readonly" value="<?= $value->stok_tersedia ?>" />
                </div>
            </div>
        </div>
    <?php } ?>
</div>