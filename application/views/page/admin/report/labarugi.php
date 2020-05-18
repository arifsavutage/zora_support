<h4 class="card-title text-center">Laporan Laba Rugi</h4>
<ol>
    <li>
        <h5>Pembelian</h5>
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Detail Item</th>
                <th>Qty</th>
                <th>Hrg. Beli (satuan)</th>
                <th>Subtotal</th>
            </tr>
            <?php
            $n = 1;
            $total_purchase = 0;
            foreach ($purchase as $row1) :
            ?>
                <tr>
                    <td><?= $n ?></td>
                    <td><?= $row1['PRODUCT_NAME'] ?></td>
                    <td><?= $row1['QTY'] ?></td>
                    <td><span class="float-right"><?= number_format($row1['PURCHASE_PRICE'], 0, ',', '.') ?></span></td>
                    <td><span class="float-right"><?= number_format($row1['SUBTOTAL'], 0, ',', '.') ?></span></td>
                </tr>
            <?php
                $total_purchase += $row1['SUBTOTAL'];
                $n++;
            endforeach;
            ?>
            <tr>
                <td colspan="4"><strong> Total </strong></td>
                <td><strong><span class="float-right"><?= number_format($total_purchase, 0, ',', '.') ?></span></strong></td>
            </tr>
        </table>

    </li>
    <li>
        <h5>Penjualan</h5>
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Nama Item</th>
                <th>Subtotal</th>
            </tr>
            <?php
            $n = 1;
            $i = 1;

            $total  = 0;
            foreach ($selling as $row3) :
            ?>
                <tr>
                    <td><?= $n ?></td>
                    <td>
                        <?php
                        $details =  json_decode($row3['PRODUCT_DETAIL'], true);
                        $total_sell = 0;
                        foreach ($details as $items) {
                            echo $items['name'] . "<br/>";
                            echo $items['qty'] . " x @ " . number_format($items['price'], 0, ',', '.') . "<br/>";
                            echo number_format($items['subtotal'], 0, ',', '.') . "<br/><hr/>";
                            $total_sell += $items['subtotal'];

                            $i++;
                        }
                        ?>
                    </td>
                    <td><?= number_format($total_sell, 0, ',', '.') ?></td>
                </tr>
            <?php
                $total += $total_sell;
                $n++;
            endforeach;
            ?>
            <tr>
                <td colspan="2"><strong> Total </strong></td>
                <td><strong><span class="float-right"><?= number_format($total, 0, ',', '.') ?></span></strong></td>
            </tr>
        </table>
    </li>
    <li>
        <h5>Biaya Operasional</h5>
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Nama Item</th>
                <th>Keterangan</th>
                <th>Nominal</th>
            </tr>
            <?php
            $n = 1;
            $total_ops = 0;
            foreach ($operasional as $row2) :
            ?>
                <tr>
                    <td><?= $n ?></td>
                    <td><?= $row2['POS_NAME'] ?></td>
                    <td><?= $row2['KETERANGAN'] ?></td>
                    <td><span class="float-right"><?= number_format($row2['KREDIT'], 0, ',', '.') ?></span></td>
                </tr>
            <?php
                $total_ops += $row2['KREDIT'];
                $n++;
            endforeach;
            ?>
            <tr>
                <td colspan="3"><strong> Total </strong></td>
                <td><strong><span class="float-right"><?= number_format($total_ops, 0, ',', '.') ?></span></strong></td>
            </tr>
        </table>
    </li>
</ol>

<?php
$pengeluaran = $total_ops + $total_purchase;
$laba   = $total - $pengeluaran;
?>

<ul>
    <li style="list-style: none;">
        <table class="table table-border">
            <tr>
                <td widd="30%">Total Penjualan</td>
                <td><span class="float-right"><?= number_format($total, 0, ',', '.') ?></span></td>
            </tr>
            <tr>
                <td>Total Pengeluaran</td>
                <td><span class="float-right"><?= number_format($pengeluaran, 0, ',', '.') ?></span></td>
            </tr>
            <tr>
                <td>Keuntungan</td>
                <td><span class="float-right"><?= number_format($laba, 0, ',', '.') ?></span></td>
            </tr>
        </table>
    </li>
</ul>