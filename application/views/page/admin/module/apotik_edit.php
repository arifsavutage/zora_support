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
                <form name="editApotik" method="post">
                    <small class="form-text text-danger"><?= isset($errors) ? $errors : '' ?></small>
                    <input type="hidden" name="id" value="<?= $apotik->ID ?>">
                    <div class="form-group">
                        <label for="marketingid">Marketing</label>
                        <select class="form-control" id="marketingid" name="marketingid">
                            <option value="">Marketing</option>
                            <?php foreach ($marketing as $m) : ?>
                                <option <?= $m->ID == $apotik->MARKETING_ID ? ' selected' : '' ?> value="<?= $m->ID ?>"><?= $m->MARKETING_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('marketingid') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="namaapotik">Nama Apotik</label>
                        <input type="text" value="<?= $apotik->APOTIK_NAME ?>" class="form-control" id="namaapotik" name="namaapotik" placeholder="Nama Apotik">
                        <small class="form-text text-danger"><?= form_error('namaapotik') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="dokterpraktek">Dokter Praktek</label>
                        <input type="text" value="<?= $apotik->DOKTER_PRAKTEK ?>" class="form-control" id="dokterpraktek" name="dokterpraktek" placeholder="Dokter Praktek">
                        <small class="form-text text-danger"><?= form_error('dokterpraktek') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="apoteker">Apoteker</label>
                        <input type="text" value="<?= $apotik->APOTEKER_NAME ?>" class="form-control" id="apoteker" name="apoteker" placeholder="Apoteker">
                        <small class="form-text text-danger"><?= form_error('apoteker') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="alamatapotik">Alamat Apotik</label>
                        <textarea class="form-control" name="alamatapotik" placeholder="Alamat Apotik"><?= $apotik->APOTIK_ADDRESS ?></textarea>
                        <small class="form-text text-danger"><?= form_error('alamatapotik') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="telp">No. Telp</label>
                        <input type="text" value="<?= $apotik->APOTIK_PHONE ?>" class="form-control" id="telp" name="telp" placeholder="No. Telp">
                        <small class="form-text text-danger"><?= form_error('telp') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="hp">No. HP</label>
                        <input type="text" value="<?= $apotik->APOTIK_MOBILE ?>" class="form-control" id="hp" name="hp" placeholder="No. HP">
                        <small class="form-text text-danger"><?= form_error('hp') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" value="<?= $apotik->APOTIK_EMAIL ?>" class="form-control" id="email" name="email" placeholder="Email">
                        <small class="form-text text-danger"><?= form_error('email') ?></small>
                    </div>
                    <a href="<?= site_url('admin/master/apotik/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>