<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form name="addpurchasing" method="post" action="">

                    <div class="form-row">
                        <div class="col">
                            <label for="suplierid">Suplier</label>
                            <select class="form-control" id="suplierid" name="suplierid">
                                <option value="">Pilih</option>
                                <!--<?php foreach ($kategori as $a) : ?>
                                <option value="<?= $a->ID ?>"><?= $a->CATEGORY_NAME ?></option>
                            <?php endforeach; ?>-->
                            </select>
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="productid">Produk</label>
                            <select class="form-control" id="productid" name="productid">
                                <option value="">Pilih</option>
                            </select>
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="qty">Qty</label>
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="qty">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="hargabeli">Harga Beli</label>
                            <input type="text" class="form-control" id="hargabeli" name="hargabeli" placeholder="harga beli per item">
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="tglpo">Tgl PO</label>
                            <input type="text" class="form-control" id="tglpo" name="tglpo" placeholder="tgl po">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="tglkirim">Tgl Kirim</label>
                            <input type="text" class="form-control" id="tglkirim" name="tglkirim" placeholder="tgl kirim">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="tglsampai">Tgl Sampai</label>
                            <input type="text" class="form-control" id="tglsampai" name="tglsampai" placeholder="tgl sampai">
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>

                    <a href="<?= site_url('admin/master/purchasing/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>