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
                <form name="addmarketing" method="post" action="">
                    <input type="hidden" name="id" value="<?= $marketing->ID ?>">
                    <div class="form-group">
                        <label for="ktpmarketing">No. KTP</label>
                        <input type="text" value="<?= $marketing->ID_CARD ?>" class="form-control" id="ktpmarketing" name="ktpmarketing" placeholder="no. KTP" disabled>
                        <small class="form-text text-danger"><?= form_error('ktpmarketing') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="marketingname">Nama Marketing</label>
                        <input type="text" value="<?= $marketing->MARKETING_NAME ?>" class="form-control" id="marketingname" name="marketingname" placeholder="nama Lengkap">
                        <small class="form-text text-danger"><?= form_error('marketingname') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="alamatmarketing">Alamat Marketing</label>
                        <textarea class="form-control" name="alamatmarketing" placeholder="alamat marketing"><?= $marketing->MARKETING_ADDRESS ?></textarea>
                        <small class="form-text text-danger"><?= form_error('alamatmarketing') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="telpmarketing">No. Telp</label>
                        <input type="text" value="<?= $marketing->MARKETING_PHONE ?>" class="form-control" id="telpmarketing" name="telpmarketing" placeholder="No. Telp / HP">
                        <small class="form-text text-danger"><?= form_error('telpmarketing') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="fotoprofile">Foto Profile</label>
                        <input type="file" class="form-control" id="fotoprofile" name="fotoprofile">
                        <small class="form-text text-danger"><?= form_error('fotoprofile') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="fotoktp">Scan KTP</label>
                        <input type="file" class="form-control" id="fotoktp" name="fotoktp">
                        <small class="form-text text-danger"><?= form_error('fotoktp') ?></small>
                    </div>
                    <a href="<?= site_url('admin/master/marketing/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>