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
                <form name="bayarcicilan" method="post" action="">
                    <div class="form-row">
                        <div class="col">
                            <label for="idcicilan">ID Transaksi</label>
                            <input type="text" class="form-control" id="idcicilan" name="idcicilan" placeholder="idcicilan" value="<?= $detail['ID']; ?>" readonly="true" required>
                            <small class="form-text text-danger"><?= form_error('idcicilan') ?></small>
                            <small class="form-text">Id cicilan</small>
                        </div>
                        <div class="col">
                            <label for="invoice">Invoice</label>
                            <input type="text" class="form-control" id="invoice" name="invoice" placeholder="invoice" value="<?= $detail['INVOICE']; ?>" readonly="true" required>
                            <small class="form-text text-danger"><?= form_error('invoice') ?></small>
                            <small class="form-text">Invoice</small>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="tgljauhtempo">Tgl Jatuh Tempo</label>
                        <input type="text" class="form-control" id="tgljauhtempo" name="tgljauhtempo" placeholder="tgljauhtempo" value="<?= date('d/m/Y', strtotime($detail['JATUH_TEMPO'])); ?>" readonly="true" required>
                        <small class="form-text text-danger"><?= form_error('tgljauhtempo') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="tglbyr">Tgl Bayar</label>
                        <input type="text" class="form-control date1" id="tglbyr" name="tglbyr" placeholder="tglbyr" value="<?= date('d/m/Y'); ?>" readonly="true" required>
                        <small class="form-text text-danger"><?= form_error('tglbyr') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="kredit">Nominal</label>
                        <input type="text" class="form-control" id="kredit" name="kredit" value="<?= $detail['TAGIHAN']; ?>" placeholder="kredit" required>
                        <small class="form-text text-danger"><?= form_error('kredit') ?></small>
                    </div>

                    <a href="<?= site_url('admin/master/selling/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-warning float-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>