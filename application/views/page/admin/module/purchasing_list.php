<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?= site_url('admin/master/purchasing/add'); ?>" class="btn btn-primary btn-sm mb-2">
            Buat PO
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
                    <table class="table table-bordered" style="font-size: 12px;" id="export" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Faktur</th>
                                <th>Suplier</th>
                                <th>Produk.</th>
                                <th>Qty.</th>
                                <th>Hrg. Beli</th>
                                <th>Tgl. PO</th>
                                <th>Tgl. Kirim</th>
                                <th>Tgl. Datang</th>
                                <th><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($purchase as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['NOFAKTUR'] ?></td>
                                    <td><?= $row['SUPLIER_NAME'] ?></td>
                                    <td><?= $row['PRODUCT_NAME'] ?></td>
                                    <td><?= $row['QTY'] ?></td>
                                    <td><?= number_format($row['PURCHASE_PRICE'], 0, ',', '.') ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['PURCHASE_DATE'])) ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['DELIVERY_DATE'])) ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['ARRIVAL_DATE'])) ?></td>
                                    <td>
                                        <a href="<?= base_url("index.php/admin/master/purchasing/edit/$row[NOFAKTUR]") ?>" class="btn btn-sm btn-warning">edit</a>
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
                                <th>No. Faktur</th>
                                <th>Suplier</th>
                                <th>Produk.</th>
                                <th>Qty.</th>
                                <th>Hrg. Beli</th>
                                <th>Tgl. PO</th>
                                <th>Tgl. Kirim</th>
                                <th>Tgl. Datang</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>