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
                <form name="editsuplier" method="post" action="">
                    <input type="hidden" name="id" value="<?= $suplier->ID ?>">
                    <div class="form-group">
                        <label for="supliername">Nama Supier</label>
                        <input type="text" value="<?= $suplier->SUPLIER_NAME ?>" class="form-control" id="supliername" name="supliername" placeholder="nama suplier">
                        <small class="form-text text-danger"><?= form_error('supliername') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="suplieraddress">Alamat Suplier</label>
                        <textarea class="form-control" name="suplieraddress" placeholder="alamat suplier"><?= $suplier->SUPLIER_ADDRESS ?></textarea>
                        <small class="form-text text-danger"><?= form_error('suplieraddress') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="suplierphone">No. Telp</label>
                        <input type="text" value="<?= $suplier->SUPLIER_PHONE ?>" class="form-control" id="suplierphone" name="suplierphone" placeholder="No. Telp">
                        <small class="form-text text-danger"><?= form_error('suplierphone') ?></small>
                    </div>
                    <a href="<?= site_url('admin/master/suplier/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>