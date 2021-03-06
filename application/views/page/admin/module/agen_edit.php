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
                <form name="addagen" method="post" action="" enctype="multipart/form-data">
                <small class="form-text text-danger"><?= isset($errors) ? $errors : '' ?></small>
                    <input type="hidden" name="id" value="<?= $agen->ID ?>">
                    <div class="form-group">
                        <label for="ktpagen">No. KTP</label>
                        <input readonly type="text" value="<?= $agen->ID_CARD ?>" class="form-control" id="ktpagen" name="ktpagen" placeholder="no. KTP">
                        <small class="form-text text-danger"><?= form_error('ktpagen') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="namaagen">Nama Agen</label>
                        <input type="text" value="<?= $agen->AGEN_NAME ?>" class="form-control" id="namaagen" name="namaagen" placeholder="nama Lengkap">
                        <small class="form-text text-danger"><?= form_error('namaagen') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="alamatagen">Alamat Agen</label>
                        <textarea class="form-control" name="alamatagen" placeholder="alamat agen"><?= $agen->AGEN_ADDRESS ?></textarea>
                        <small class="form-text text-danger"><?= form_error('alamatagen') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="telpagen">No. Telp</label>
                        <input type="text" value="<?= $agen->AGEN_PHONE ?>" class="form-control" id="telpagen" name="telpagen" placeholder="No. Telp / HP">
                        <small class="form-text text-danger"><?= form_error('telpagen') ?></small>
                    </div>
                    <div class="form-group mb-1">
                        <label>Area</label>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <select class="form-control" id="provinsi" name="provinsi">
                                <option value="">Provinsi</option>
                                <?php foreach ($provinsi as $p) : ?>
                                    <option <?= $p->id == $area->province_id ? 'selected' : '' ?> value="<?= $p->id ?>"><?= $p->province_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <select class="form-control" id="kabkota" name="kabkota">
                                <?php foreach ($kabkota as $p) : ?>
                                    <option <?= $p->id == $area->id ? 'selected' : '' ?> value="<?= $p->id ?>"><?= $p->city_name.' - '. $p->type ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-danger"><?= form_error('kabkota') ?></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="marketingid">Marketing</label>
                        <select class="form-control" id="marketingid" name="marketingid">
                            <option value="">Marketing</option>
                            <?php foreach ($marketing as $m) : ?>
                                <option <?= $m->ID == $agen->MARKETING_ID ? ' selected' : '' ?> value="<?= $m->ID ?>"><?= $m->MARKETING_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('marketingid') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="fotoprofile">Foto Profile</label>
                        <input type="file" accept="image/jpeg" class="form-control" id="fotoprofile" name="fotoprofile">
                        <small class="form-text text-danger"><?= form_error('fotoprofile') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="fotoktp">Scan KTP</label>
                        <input type="file" accept="image/jpeg" class="form-control" id="fotoktp" name="fotoktp">
                        <small class="form-text text-danger"><?= form_error('fotoktp') ?></small>
                    </div>
                    <a href="<?= site_url('admin/master/agen/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>