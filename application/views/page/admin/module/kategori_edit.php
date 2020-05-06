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
                <form name="addsubagen" method="post" action="">
                    <input type="hidden" name="id" value="<?= $kategori->ID ?>">
                    <div class="form-group">
                        <label for="kategoriname">Nama Kategori</label>
                        <input type="text" value="<?= $kategori->CATEGORY_NAME ?>" class="form-control" id="kategoriname" name="kategoriname" placeholder="nama kategori">
                        <small class="form-text text-danger"><?= form_error('kategoriname') ?></small>
                    </div>
                    <a href="<?= site_url('admin/master/kategori/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>