<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Zora <sup>support</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url(); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php if (in_array($this->session->userdata['role'], ['superadmin'])) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('index.php/admin/master/suplier/list'); ?>"><i class="fas fa-fw fa-industry"></i><span>Master Suplier</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= in_array($this->uri->segment(3), array("marketing", "agen", "subagen", "apotik")) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#masterseller" aria-expanded="true" aria-controls="masterseller">
                <i class="fas fa-fw fa-users"></i>
                <span>Master Seller</span>
            </a>
            <div id="masterseller" class="collapse <?= in_array($this->uri->segment(3), array("marketing", "agen", "subagen", "apotik")) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $this->uri->segment(3) == 'marketing' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/marketing/list'); ?>">Data Marketing</a>
                    <a class="collapse-item <?= $this->uri->segment(3) == 'agen' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/agen/list'); ?>">Data Agen</a>
                    <a class="collapse-item <?= $this->uri->segment(3) == 'subagen' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/subagen/list'); ?>">Data Subagen</a>
                    <a class="collapse-item <?= $this->uri->segment(3) == 'apotik' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/apotik/list'); ?>">Data Apotik</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= in_array($this->uri->segment(3), array("kategori", "produk")) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#masterproduct" aria-expanded="true" aria-controls="masterproduct">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Master Produk</span>
            </a>
            <div id="masterproduct" class="collapse <?= in_array($this->uri->segment(3), array("kategori", "produk")) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $this->uri->segment(3) == 'kategori' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/kategori/list'); ?>">Produk Kategori</a>
                    <a class="collapse-item <?= $this->uri->segment(3) == 'produk' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/produk/list'); ?>">Produk Item</a>
                </div>
            </div>
        </li>
    <?php endif; ?>
    <?php if (in_array($this->session->userdata['role'], ['superadmin', 'operator'])) : ?>
        <li class="nav-item">
            <a class="nav-link <?= in_array($this->uri->segment(3), array("purchasing", "selling", "return", "operasional")) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#mastertransaksi" aria-expanded="true" aria-controls="mastertransaksi">
                <i class="fas fa-fw fa-store"></i>
                <span>Master Transaksi</span>
            </a>
            <div id="mastertransaksi" class="collapse <?= in_array($this->uri->segment(3), array("purchasing", "selling", "return", "operasional")) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $this->uri->segment(3) == 'purchasing' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/purchasing/list'); ?>">Pemesanan</a>
                    <a class="collapse-item <?= $this->uri->segment(3) == 'selling' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/selling/list'); ?>">Penjualan</a>
                    <!--<a class="collapse-item" href="">Konfirmasi Pembayaran</a>-->
                    <a class="collapse-item <?= $this->uri->segment(3) == 'return' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/return/list'); ?>">Retur Barang</a>
                    <a class="collapse-item <?= $this->uri->segment(3) == 'operasional' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/master/operasional/list'); ?>">Operasional</a>
                </div>
            </div>
        </li>
    <?php endif; ?>
    <?php if (in_array($this->session->userdata['role'], ['superadmin'])) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('index.php/admin/master/rekening/list'); ?>"><i class="fas fa-fw fa-cash-register"></i><span>Master Biaya</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= in_array($this->uri->segment(3), array("kas_harian", "labarugi")) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#masterlaporan" aria-expanded="true" aria-controls="masterlaporan">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>Master Laporan</span>
            </a>
            <div id="masterlaporan" class="collapse <?= in_array($this->uri->segment(3), array("kas_harian", "labarugi")) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $this->uri->segment(3) == 'kas_harian' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/laporan/kas_harian'); ?>">Laporan Kas</a>
                    <!--<a class="collapse-item <?= $this->uri->segment(3) == 'perform' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/laporan/perform'); ?>">Performa</a>-->
                    <a class="collapse-item <?= $this->uri->segment(3) == 'labarugi' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/laporan/labarugi'); ?>">Laba Rugi</a>

                    <!--
                <a class="collapse-item <?= $this->uri->segment(3) == 'l_selling' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/laporan/l_selling'); ?>">Laporan Pembelian</a>
                <a class="collapse-item <?= $this->uri->segment(3) == 'l_purchase' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/laporan/l_purchase'); ?>">Laporan Penjualan</a>
                <a class="collapse-item <?= $this->uri->segment(3) == 'l_retur' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/laporan/l_retur'); ?>">Laporan Retur Barang</a>
                <a class="collapse-item <?= $this->uri->segment(3) == 'l_cost' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/laporan/l_cost'); ?>">Laporan Biaya</a>-->
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(3) == 'useraccount' ? 'active' : '' ?>" href="<?= base_url('index.php/admin/user/account/list'); ?>"><i class="fas fa-fw fa-user-cog"></i><span>Master User</span></a>
        </li>
    <?php endif; ?>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-fw fa-sign-out-alt"></i><span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->