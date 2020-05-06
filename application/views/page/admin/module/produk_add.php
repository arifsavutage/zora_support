<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form name="addproduct" method="post" action="">
                    <div class="form-group">
                        <label for="kategoriid">Kategori</label>
                        <select class="form-control" id="kategoriid" name="kategoriid">
                            <option value="">Kategori</option>
                            <?php foreach ($kategori as $a) : ?>
                                <option value="<?= $a->ID ?>"><?= $a->CATEGORY_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('kategoriid') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="productname">Nama Produk</label>
                        <input type="text" class="form-control" id="productname" name="productname" placeholder="nama produk">
                        <small class="form-text text-danger"><?= form_error('productname') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="sellprice">Harga Jual</label>
                        <input type="text" class="form-control" id="sellprice" name="sellprice" placeholder="harga jual">
                        <small class="form-text text-danger"><?= form_error('sellprice') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock" placeholder="stock">
                        <small class="form-text text-danger"><?= form_error('stock') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="stocklimit">Stock Limit</label>
                        <input type="text" class="form-control" id="stocklimit" name="stocklimit" placeholder="stock limit">
                        <small class="form-text text-danger"><?= form_error('stocklimit') ?></small>
                    </div>
                    <a href="<?= site_url('admin/master/produk/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>