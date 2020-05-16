<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?= site_url('admin/master/return/add'); ?>" class="btn btn-primary btn-sm mb-2">
            Tambah Retur
        </a>
        <?php
        if ($this->session->flashdata('info')) {
            echo "<br/>";
            echo $this->session->flashdata('info');
        }
        #echo $this->db->last_query();
        ?>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="font-size: 12px;" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Invoice</th>
                                <th>Tgl. Retur</th>
                                <th>Qty</th>
                                <th>Keterangan</th>
                                <th>Di Ganti</th>
                                <th>Tgl. Ganti</th>
                                <th><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($returns as $item) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $item['INVOICE'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($item['TGL_RETUR'])) ?></td>
                                    <td><?= $item['QTY'] ?></td>
                                    <td><?= $item['KETERANGAN'] ?></td>
                                    <td><?= $item['STATUS'] ?></td>
                                    <td>
                                        <?php
                                        if ($item['TGL_GANTI'] == '0000-00-00') {
                                            echo "00/00/0000";
                                        } else {
                                            echo date('d/m/Y', strtotime($item['TGL_GANTI']));
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#returdetail<?= $no ?>">
                                            detail
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="returdetail<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="returdetailLabel<?= $no ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form name="updateretur" method="post" action="<?= base_url('index.php/admin/master/return/edit'); ?>">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="returdetailLabel<?= $no ?>">Detail Retur</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-row">
                                                                <div class="col-md-5">
                                                                    <label for="invoice">Invoice</label>
                                                                    <input type="text" class="form-control" id="invoice" name="invoice" value="<?= $item['INVOICE'] ?>">
                                                                    <input type="hidden" name="id" value="<?= $item['ID'] ?>" />
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <label for="tgl_retur">Tgl. Retur</label>
                                                                    <input type="text" class="form-control date1" id="tgl_retur" name="tgl_retur" value="<?= $item['TGL_RETUR'] ?>">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="qty">Qty</label>
                                                                    <input type="text" class="form-control" id="qty" name="qty" value="<?= $item['QTY'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea name="keterangan" class="form-control"><?= $item['KETERANGAN'] ?></textarea>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-5">
                                                                    <label for="status">Status</label>
                                                                    <select name="status" class="form-control">
                                                                        <option value="">Pilih</option>
                                                                        <option value="sudah" <?php if ($item['STATUS'] == 'sudah') echo 'selected'; ?>>Sudah Diganti</option>
                                                                        <option value="belum" <?php if ($item['STATUS'] == 'belum') echo 'selected'; ?>>Belum Diganti</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <label for="tgl_ganti">Tgl. Retur</label>
                                                                    <input type="text" class="form-control date1" id="tgl_ganti" name="tgl_ganti" value="<?= $item['TGL_GANTI'] ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Invoice</th>
                                <th>Tgl. Retur</th>
                                <th>Qty</th>
                                <th>Keterangan</th>
                                <th>Di Ganti</th>
                                <th>Tgl. Ganti</th>
                                <th><i class="fa fa-cog"></i></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>