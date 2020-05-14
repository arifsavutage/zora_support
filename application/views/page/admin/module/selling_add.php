<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalagen">
                            Agen
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalagen" tabindex="-1" role="dialog" aria-labelledby="modalagenLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalagenLabel">Daftar Agen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered" id="examples">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Agen</th>
                                                    <th>Type</th>
                                                    <th><i class="fa fa-cog"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($agen as $agn) :
                                                ?>
                                                    <tr>
                                                        <td><?= $agn->ID ?></td>
                                                        <td><?= $agn->AGEN_NAME ?></td>
                                                        <td>agen</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-danger select">Pilih</button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#subagen">
                            Sub Agen
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="subagen" tabindex="-1" role="dialog" aria-labelledby="subagenLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="subagenLabel">Daftar Subagen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered" id="exampless">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Subagen</th>
                                                    <th>Type</th>
                                                    <th><i class="fa fa-cog"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($subagen as $subagn) :
                                                ?>
                                                    <tr>
                                                        <td><?= $subagn->ID ?></td>
                                                        <td><?= $subagn->SUBAGEN_NAME ?></td>
                                                        <td>sub</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-danger select">Pilih</button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col-md-2">
                        <label for="idproduk">ID</label>
                        <input type="text" class="form-control" name="idproduk" id="idproduk" value="" readonly="true" />
                    </div>
                    <div class="col-md-3">
                        <label for="item">Item</label>
                        <input type="text" class="form-control" name="item" id="item" value="" readonly="true" />
                    </div>
                    <div class="col-md-3">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" value="" readonly="true" />
                    </div>
                    <div class="col-md-1">
                        <label for="qty">Qty</label>
                        <input type="number" class="form-control" id="qty" name="qty" value="1" placeholder="qty">
                    </div>
                    <div class="col-md-1">
                        <br />
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success btn-block mt-2" data-toggle="modal" data-target="#search">
                            <i class="fas fa-search"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="searchLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="searchLabel">Pilih Produk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered" id="examplesss">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Produk</th>
                                                    <th>Harga</th>
                                                    <th>Stock</th>
                                                    <th><i class="fa fa-cog"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($products as $item) {
                                                    echo "
                                                        <tr>
                                                            <td>$item->ID</td>
                                                            <td>$item->PRODUCT_NAME</td>
                                                            <td>$item->SELL_PRICE</td>
                                                            <td>$item->STOCK</td>
                                                            <td><button class='btn btn-danger btn-sm select-item'>pilih</button></td>
                                                        </tr>
                                                        ";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <br />
                        <button class="btn btn-danger btn-block mt-2 add_cart"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </div>

                <form name="addsell" method="post" action="<?= base_url('index.php/sell/checkout') ?>">

                    <div class="form-row">
                        <div class="col">
                            <label for="idpembeli">ID Pembeli</label>
                            <input type="text" class="form-control" value="" name="idpembeli" id="idpembeli" readonly="true" required="required" />
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="namapembeli">Nama Pembeli</label>
                            <input type="text" class="form-control" value="" name="namapembeli" id="namapembeli" readonly="true" />
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="sellertype">Status</label>
                            <input type="text" class="form-control" value="" name="sellertype" id="sellertype" readonly="true" />
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>
                    <hr />

                    <?php
                    if ($this->session->flashdata('info')) {
                        echo $this->session->flashdata('info');
                        echo "<br/>";
                    }
                    ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Sub. Total</th>
                                <th><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody id="detail_cart">
                        </tbody>
                    </table>

                    <div class="form-row mb-4">
                        <div class="col-md-4">
                            <label for="metode">Metode Byr.</label>
                            <select class="form-control" name="metode" id="metode">
                                <option value="">Pilih</option>
                                <option value="tunai">Tunai</option>
                                <option value="kredit">Kredit</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="jmlcicilan">Jml. Cicilan</label>
                            <input class="form-control" type="text" name="jmlcicilan" id="jmlcicilan" placeholder="x bulan" value="" />
                        </div>
                        <div class="col-md-4">
                            <label for="tglbeli">Tgl. Transaksi</label>
                            <input class="form-control" type="text" name="tglbeli" id="tglbeli" value="<?= date('d/m/Y'); ?>" readonly="true" />
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="col-md-12">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>
                    </div>

                    <a href="<?= site_url('admin/master/selling/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>