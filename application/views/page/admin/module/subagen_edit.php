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
                    <input type="hidden" name="id" value="<?= $subagen->ID ?>">
                    <div class="form-group">
                        <label for="agenid">Agen</label>
                        <select class="form-control" id="agenid" name="agenid">
                            <option value="">Agen</option>
                            <?php foreach ($agen as $a) : ?>
                                <option <?= $a->ID == $subagen->AGEN_ID ? ' selected' : '' ?> value="<?= $a->ID ?>"><?= $a->AGEN_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('agenid') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="ktpsubagen">No. KTP</label>
                        <input type="text" disabled value="<?= $subagen->ID_CARD ?>" class="form-control" id="ktpsubagen" name="ktpsubagen" placeholder="no. KTP">
                        <small class="form-text text-danger"><?= form_error('ktpsubagen') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="namasubagen">Nama Sub Agen</label>
                        <input type="text" value="<?= $subagen->SUBAGEN_NAME ?>" class="form-control" id="namasubagen" name="namasubagen" placeholder="nama Lengkap">
                        <small class="form-text text-danger"><?= form_error('namasubagen') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="alamatsubagen">Alamat Sub Agen</label>
                        <textarea class="form-control" name="alamatsubagen" placeholder="alamat sub agen"><?= $subagen->SUBAGEN_ADDRESS ?></textarea>
                        <small class="form-text text-danger"><?= form_error('alamatsubagen') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="telpsubagen">No. Telp</label>
                        <input type="text" value="<?= $subagen->SUBAGEN_PHONE ?>" class="form-control" id="telpsubagen" name="telpsubagen" placeholder="No. Telp / HP">
                        <small class="form-text text-danger"><?= form_error('telpsubagen') ?></small>
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
                                    <option <?= $p->id == $area->city_id ? 'selected' : '' ?> value="<?= $p->id ?>"><?= $p->city_name . ' - ' . $p->type ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-danger"><?= form_error('kabkota') ?></small>
                        </div>
                        <div class="form-group col-md-3">
                            <select class="form-control" id="areasubagen" name="areasubagen">
                                <?php foreach ($areasubagen as $p) : ?>
                                    <option <?= $p->id == $subagen->AREA ? 'selected' : '' ?> value="<?= $p->id ?>"><?= $p->subdistrict_name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-danger"><?= form_error('areasubagen') ?></small>
                        </div>
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
                    <a href="<?= site_url('admin/master/subagen/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>