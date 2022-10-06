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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2">Basis</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <table class="table table-striped table-bordered nowrap" id="tabel-basis" style="width: 100%;">
                            <thead>
                                <tr align="center">
                                    <th>Image</th>
                                    <th>r</th>
                                    <th>g</th>
                                    <th>b</th>
                                    <th>Label</th>
                                    <th>Euclidian Distance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $key => $value) { ?>
                                    <tr align="center">
                                        <td><img src="<?= upload_url('gambar') ?><?= $basis[$key]['image'] ?>" width="100" heigth="100" /></td>
                                        <td><?= $basis[$key]['r'] ?></td>
                                        <td><?= $basis[$key]['g'] ?></td>
                                        <td><?= $basis[$key]['b'] ?></td>
                                        <td><?= $basis[$key]['nama'] ?></td>
                                        <td><?= $value ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2">Rangking</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <table class="table table-striped table-bordered nowrap" id="tabel-rangking" style="width: 100%;">
                            <thead>
                                <tr align="center">
                                    <th>Image</th>
                                    <th>r</th>
                                    <th>g</th>
                                    <th>b</th>
                                    <th>Label</th>
                                    <th>Euclidian Distance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sort as $key => $value) { ?>
                                    <tr align="center">
                                        <td><img src="<?= upload_url('gambar') ?><?= $basis[$key]['image'] ?>" width="100" heigth="100" /></td>
                                        <td><?= $basis[$key]['r'] ?></td>
                                        <td><?= $basis[$key]['g'] ?></td>
                                        <td><?= $basis[$key]['b'] ?></td>
                                        <td><?= $basis[$key]['nama'] ?></td>
                                        <td><?= $value ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2">Hasil</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <table class="table table-striped table-bordered nowrap" id="tabel-hasil" style="width: 100%;">
                            <thead>
                                <tr align="center">
                                    <th>Image</th>
                                    <th>r</th>
                                    <th>g</th>
                                    <th>b</th>
                                    <th>Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td><img src="<?= upload_url('gambar') ?><?= $konsultasi['image'] ?>" width="100" heigth="100" /></td>
                                    <td><?= $konsultasi['r'] ?></td>
                                    <td><?= $konsultasi['g'] ?></td>
                                    <td><?= $konsultasi['b'] ?></td>
                                    <td><?= $basis[array_key_first($sort)]['nama'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->