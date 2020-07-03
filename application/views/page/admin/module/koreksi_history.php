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
                <form name="addaccount" method="post" action="">
                    <div class="form-group">
                        <label for="idtrans">ID Transaksi</label>
                        <input type="text" class="form-control" id="idtrans" name="idtrans" placeholder="idtrans" value="<?= $detail['ID_TRANS']; ?>" readonly="true" required>
                        <small class="form-text text-danger"><?= form_error('idtrans') ?></small>
                        <small class="form-text">Id Trans = Invoice / no faktur / Id Pos Operasional</small>
                    </div>
                    <div class="form-group">
                        <label for="tgltrans">Tgl Transaksi</label>
                        <input type="text" class="form-control" id="tgltrans" name="tgltrans" placeholder="tgltrans" value="<?= date('d/m/Y', strtotime($detail['TGL'])); ?>" readonly="true" required>
                        <small class="form-text text-danger"><?= form_error('tgltrans') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="kredit">Nominal Kredit</label>
                        <input type="text" class="form-control" id="kredit" name="kredit" value="<?= $detail['KREDIT']; ?>" placeholder="kredit" required>
                        <small class="form-text text-danger"><?= form_error('kredit') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="debet">Nominal Debet</label>
                        <input type="text" value="<?= $detail['DEBET']; ?>" class="form-control" id="debet" name="debet" placeholder="debet" required>
                        <small class="form-text text-danger"><?= form_error('debet') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Tipe Transaksi</label>
                        <input type="text" value="<?= $detail['TRANS_TYPE']; ?>" class="form-control" id="jenis" name="jenis" placeholder="jenis" readonly="true" required>
                        <small class="form-text text-danger"><?= form_error('jenis') ?></small>
                    </div>

                    <!--<div class="form-group">
                        <label for="jenis">Status Koreksi</label>
                        <select class="form-control" required>
                            <option value="">: Pilih Status</option>
                            <option value="1">Catat sebagai dana Masuk / Keluar</option>
                            <option value="0">Hapus Transaksi</option>
                        </select>
                    </div>-->

                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <input type="text" value="" class="form-control" id="ket" name="ket" placeholder="Keterangan">
                        <small class="form-text text-danger"><?= form_error('ket') ?></small>
                    </div>

                    <a href="<?= site_url('admin/laporan/kas_harian') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-warning float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>