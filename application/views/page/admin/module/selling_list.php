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
                                    <td><?= "<strong>#" . $row['INVOICE'] . "</strong>" ?></td>
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
                                        <a href="<?= base_url('index.php/admin/report/invoice/print_invoice/') . $row['INVOICE'] ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file"></i> invoice</a>

                                        <?php
                                        if ($row['METODE_BAYAR'] == 'kredit') :
                                        ?>
                                            <!--<a href="#" class="btn btn-sm btn-info" title="detail cicilan">...</a>-->
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#angsuran<?= $no ?>">
                                                ...
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="angsuran<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="angsuranLabel<?= $no ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="angsuranLabel<?= $no ?>">Tabel Angsuran Invoice #<?= $row['INVOICE'] ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Jatuh Tempo</th>
                                                                        <th>Tagihan</th>
                                                                        <th>Tgl. Bayar</th>
                                                                        <th>Nominal</th>
                                                                        <th><i class="fa fa-cog"></i></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $angs_data = $this->installment_model->getByInvoice($row['INVOICE']);
                                                                    $no = 1;
                                                                    foreach ($angs_data as $angs) :
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $no ?></td>
                                                                            <td><?= date('d/m/Y', strtotime($angs['JATUH_TEMPO'])) ?></td>
                                                                            <td><?= number_format($angs['TAGIHAN'], 0, ',', '.') ?></td>
                                                                            <td>
                                                                                <?php
                                                                                if ($angs['TGL_BAYAR'] == '0000-00-00') {
                                                                                    echo '00/00/000';
                                                                                } else {
                                                                                    echo date('d/m/Y', strtotime($angs['TGL_BAYAR']));
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            <td><?= number_format($angs['NOMINAL'], 0, ',', '.') ?></td>
                                                                            <td>
                                                                                <a href="<?= base_url('index.php/installment/bayar_cicilan/') . $angs['INVOICE'] . "/" . $angs['ID'] ?>" class="btn btn-info btn-sm <?php if ($angs['NOMINAL'] > 0) echo "disabled"; ?>">bayar</a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                        $no++;
                                                                    endforeach;
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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