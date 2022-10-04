<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <!-- begin:: profil sidebar -->
        <div class="">
            <div class="main-menu-header">
                <img class="img-menu-user img-radius" src="<?= (get_users_detail($this->session->userdata('id'))->foto !== null ? upload_url('gambar') . '' . get_users_detail($this->session->userdata('id'))->foto : "//placehold.co/150") ?>" alt="User-Profile-Image">
                <div class="user-details">
                    <p id="more-details"><?= get_users_detail($this->session->userdata('id'))->nama ?></p>
                </div>
            </div>
        </div>
        <!-- end:: profil sidebar -->
        <!-- begin:: menu sidebar -->
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === null ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Master</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'jenis' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>jenis">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Jenis</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'satuan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>satuan">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Satuan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'supplier' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>supplier">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Supplier</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'distribusi' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>distribusi">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Distribusi</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'barang' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>barang">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Barang</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'bahan_baku' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>bahan_baku">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Bahan Baku</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Produksi</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'komposisi' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>komposisi">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Komposisi</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'stok_barang' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>stok_barang">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Barang</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'stok_bahan_baku' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>stok_bahan_baku">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Bahan Baku</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Transaksi</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'pembelian' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>pembelian">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Pembelian</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'penjualan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>penjualan">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Penjualan</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Riwayat Transaksi</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'masuk' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>masuk">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Barang Masuk</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'keluar' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>keluar">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Barang Keluar</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Laporan</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(3) === 'barang' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/barang">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Barang</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'supplier' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/supplier">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Supplier</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'distribusi' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/distribusi">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Distribusi</span>
                </a>
            </li>
        </ul>
        <!-- end:: menu sidebar -->
    </div>
</nav>