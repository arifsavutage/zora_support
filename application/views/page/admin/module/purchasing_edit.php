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
                <form name="editpurchasing" method="post" action="" onsubmit="return beware()">

                    <input type="hidden" name="nofaktur" value="<?= $detail['NOFAKTUR'] ?>" />
                    <div class="form-row">
                        <div class="col">
                            <label for="suplier">Suplier</label>
                            <select class="form-control" id="suplier" name="suplier">
                                <option value="">Pilih</option>
                                <?php foreach ($suplier as $row) : ?>
                                    <option value="<?= $row->ID ?>" <?php
                                                                    if ($row->ID == $detail['supID']) echo "selected='selected'";
                                                                    ?>><?= $row->SUPLIER_NAME ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="product">Produk</label>
                            <select class="form-control" id="product" name="product">
                                <option value="">Pilih</option>
                                <?php foreach ($produk as $p) : ?>
                                    <option value="<?= $p->ID ?>" <?php
                                                                    if ($p->ID == $detail['productID']) echo "selected='selected'";
                                                                    ?>><?= $p->PRODUCT_NAME ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="qty">Qty</label>
                            <input type="text" class="form-control" id="qty" name="qty" value="<?= $detail['QTY'] ?>" placeholder="qty">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="hargabeli">Harga Beli</label>
                            <input type="text" class="form-control" id="hargabeli" name="hargabeli" value="<?= $detail['PURCHASE_PRICE'] ?>" placeholder="harga beli per item">
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="tglpo">Tgl PO</label>
                            <input type="text" class="form-control date1" id="tglpo" name="tglpo" value="<?= $detail['PURCHASE_DATE'] ?>" placeholder="tgl po" readonly="true">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="tglkirim">Tgl Kirim</label>
                            <input type="text" class="form-control date1" id="tglkirim" name="tglkirim" value="<?= $detail['DELIVERY_DATE'] ?>" placeholder="tgl kirim" readonly="true">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="tglsampai">Tgl Sampai</label>
                            <input type="text" class="form-control date1" id="tglsampai" name="tglsampai" value="<?= $detail['ARRIVAL_DATE'] ?>" placeholder="tgl sampai" readonly="true">
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>

                    <a href="<?= site_url('admin/master/purchasing/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-warning float-right">Save changes</button>
                </form>

                <script>
                    function beware() {
                        var x = confirm("Yakin akan dirubah?,\nPerubahan data akan brpengaruh pada sebagian atau keseluruhan data ..");

                        if (x == true) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>
</div>