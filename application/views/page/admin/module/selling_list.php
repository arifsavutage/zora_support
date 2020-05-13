<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?= site_url('admin/master/selling/add'); ?>" class="btn btn-primary btn-sm mb-2">
            Tambah Penjualan
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
                                <th>Tgl. Belanja</th>
                                <th>Invoice</th>
                                <th>Pembeli</th>
                                <th>Total</th>
                                <th>Metode Bayar</th>
                                <th>Cicilan</th>
                                <th>Status</th>
                                <th><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penjualan as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['TGL_BELI'])) ?></td>
                                    <td><?= $row['INVOICE'] ?></td>
                                    <td>
                                        <?php
                                        $type = $row['SELLER_TYPE'];
                                        if ($type == 'agen') {
                                            $seller = $this->selling_model->getAgenName($row['SELLER_ID']);
                                            echo ucwords($seller->SELLER_NAME);
                                            //echo "ini agen";
                                        } else {
                                            $seller = $this->selling_model->getSubAgenName($row['SELLER_ID']);
                                            echo ucwords($seller->SELLER_NAME);
                                            //echo "ini sub";
                                        }
                                        //echo $type;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $detail = json_decode($row['PRODUCT_DETAIL'], true);
                                        //print_r(var_dump($detail));
                                        $total = 0;
                                        foreach ($detail as $item) {
                                            $total += $item['subtotal'];
                                        }

                                        echo number_format($total, 0, ',', '.');
                                        ?>
                                    </td>
                                    <td><?= $row['METODE_BAYAR'] ?></td>
                                    <td><?= $row['JML_CICILAN'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['STATUS'] == 'lunas') {
                                            echo "<span class='badge badge-secondary'>" . ucwords($row['STATUS']) . "</span>";
                                        } else {
                                            echo "<span class='badge badge-danger'>" . ucwords($row['STATUS']) . "</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-file"></i> invoice</a>
                                        <?php
                                        if ($row['METODE_BAYAR'] == 'kredit') :
                                        ?>
                                            <a href="#" class="btn btn-sm btn-info" title="detail cicilan">...</a>
                                        <?php
                                        endif;
                                        ?>
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
                                <th>Tgl. Belanja</th>
                                <th>Invoice</th>
                                <th>Pembeli</th>
                                <th>Total</th>
                                <th>Metode Bayar</th>
                                <th>Cicilan</th>
                                <th>Status</th>
                                <th><i class="fa fa-cog"></i></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>