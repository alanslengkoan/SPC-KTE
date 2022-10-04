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
                <a href="<?= supplier_url() ?>">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Data</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'bahan_baku' ? 'active' : '') ?>">
                <a href="<?= supplier_url() ?>bahan_baku">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Bahan Baku</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Riwayat Stok</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'masuk' ? 'active' : '') ?>">
                <a href="<?= supplier_url() ?>masuk">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Masuk</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'keluar' ? 'active' : '') ?>">
                <a href="<?= supplier_url() ?>keluar">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Keluar</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Transaksi</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'pemesanan' ? 'active' : '') ?>">
                <a href="<?= supplier_url() ?>pemesanan">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Pemesanan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'pembayaran' ? 'active' : '') ?>">
                <a href="<?= supplier_url() ?>pembayaran">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Pembayaran</span>
                </a>
            </li>
        </ul>
        <!-- end:: menu sidebar -->
    </div>
</nav>