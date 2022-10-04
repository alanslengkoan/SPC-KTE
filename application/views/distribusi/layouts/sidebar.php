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
                <a href="<?= distribusi_url() ?>">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Data</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'barang' ? 'active' : '') ?>">
                <a href="<?= distribusi_url() ?>barang">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Barang</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Riwayat Stok</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'masuk' ? 'active' : '') ?>">
                <a href="<?= distribusi_url() ?>masuk">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Masuk</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'keluar' ? 'active' : '') ?>">
                <a href="<?= distribusi_url() ?>keluar">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Keluar</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Transaksi</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'pembelian' ? 'active' : '') ?>">
                <a href="<?= distribusi_url() ?>pembelian">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Pembelian</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'pembayaran' ? 'active' : '') ?>">
                <a href="<?= distribusi_url() ?>pembayaran">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Pembayaran</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'pengiriman' ? 'active' : '') ?>">
                <a href="<?= distribusi_url() ?>pengiriman">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Pengiriman</span>
                </a>
            </li>
        </ul>
        <!-- end:: menu sidebar -->
    </div>
</nav>