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
                <div class="row">
                    <div class="col-lg-12">
                        <!-- begin:: tab header -->
                        <div class="tab-header card">
                            <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#logo" role="tab" aria-selected="true">Logo</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profil" role="tab" aria-selected="false">Profil</a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                        </div>
                        <!-- end:: tab header -->
                        <!-- begin:: tab content -->
                        <div class="tab-content">
                            <!-- begin:: logo -->
                            <div class="tab-pane active show" id="logo" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Foto</h5>
                                    </div>
                                    <div class="card-block">
                                        <form id="form-logo" action="<?= admin_url() ?>pengaturan/upd_foto/<?= (empty($data->id_pengaturan) ? null : $data->id_pengaturan) ?>" method="POST">
                                            <div class="row">
                                                <div class="col-lg-6 align-self-center">
                                                    <input type="file" name="inplogo" id="inplogo">
                                                </div>
                                                <div class="col-lg-6">
                                                    <img src="<?= (empty($data->logo)) ? "//placehold.co/150" : upload_url('gambar') . '' . $data->logo ?>" class="img-fluid mx-auto d-block" id="lihat-gambar" alt="Profil" width="200" />
                                                    <br>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="save-logo"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: logo -->
                            <!-- begin:: profil -->
                            <div class="tab-pane" id="profil" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Profil</h5>
                                    </div>
                                    <div class="card-block">
                                        <form id="form-profil" action="<?= admin_url() ?>pengaturan/upd_profil/<?= (empty($data->id_pengaturan) ? null : $data->id_pengaturan) ?>" method="POST">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nama *</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inpnama" id="inpnama" value="<?= (empty($data->nama) ? null : $data->nama) ?>" placeholder="Masukkan nama" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">E-mail *</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="inpemail" id="inpemail" value="<?= (empty($data->email) ? null : $data->email) ?>" placeholder="Masukkan email" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Alamat *</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="inpalamat" id="inpalamat" placeholder="Masukkan alamat"><?= (empty($data->alamat) ? null : $data->alamat) ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Telepon *</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inptelepon" id="inptelepon" value="<?= (empty($data->telepon) ? null : $data->telepon) ?>" placeholder="Masukkan telepon" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Facebook</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inplinkfacebook" id="inplinkfacebook" value="<?= (empty($data->facebook) ? null : $data->facebook) ?>" placeholder="Masukkan link facebook" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Instagram</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inplinkinstagram" id="inplinkinstagram" value="<?= (empty($data->instagram) ? null : $data->instagram) ?>" placeholder="Masukkan link instagram" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Twitter</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inplinktwitter" id="inplinktwitter" value="<?= (empty($data->twitter) ? null : $data->twitter) ?>" placeholder="Masukkan link twitter" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Youtube</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inplinkyoutube" id="inplinkyoutube" value="<?= (empty($data->youtube) ? null : $data->youtube) ?>" placeholder="Masukkan link youtube" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="save-profil"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: profil -->
                        </div>
                        <!-- end:: tab content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->