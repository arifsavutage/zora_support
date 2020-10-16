<h3 class="card-title text-center">Laporan Laba Rugi</h3>
<h6 class="text-center" style="margin-top: none;padding-bottom:15px;border-bottom:0.1em solid red;"><?= $periode ?></h6>

<ol type="A">
    <li>
        <strong>Pendapatan</strong>
        <ul style="list-style:none;">
            <li>
                Penjualan
                <?php
                $n = 1;
                $i = 1;

                $total  = 0;
                foreach ($selling as $row3) :
                    $details =  json_decode($row3['PRODUCT_DETAIL'], true);
                    $total_sell = 0;
                    foreach ($details as $items) {
                        //echo $items['name'] . "<br/>";
                        //echo $items['qty'] . " x @ " . number_format($items['price'], 0, ',', '.') . "<br/>";
                        //echo number_format($items['subtotal'], 0, ',', '.') . "<br/><hr/>";
                        $total_sell += $items['subtotal'];

                        $i++;
                    }
                    $total += $total_sell;
                    $n++;
                endforeach;
                ?>
                <span class="float-right"><?= number_format($total, 0, ',', '.') ?></span>

                <?php
                $n = 1;
                foreach ($korgroup as $rwkorgrp) :
                    $total_koreksi = 0;
                    echo "<li>" . ucwords(strtolower($rwkorgrp['POS_NAME'])) . "";
                    echo "<ul style='list-style:none;'>";
                    foreach ($koreksi as $rowkoreksi) :
                        if ($rwkorgrp['ID_TRANS'] == $rowkoreksi['ID_TRANS'])
                            echo "<li><span class='font-italic' style='font-size:13px;'>" . ucwords(strtolower($rowkoreksi['KETERANGAN'])) . "</span>
                    <span class='float-right'>" . number_format($rowkoreksi['DEBET'], 0, ',', '.') . "</span>
                    </li>";
                        $total_koreksi += $rowkoreksi['DEBET'];
                        $n++;
                    endforeach;
                    echo "</ul>";
                    echo "</li>";
                endforeach;
                //$total_bb   = $total_ops + $total_purchase;
                //$labarugi   = $total - $total_bb;
                ?>
            </li>
        </ul>
        <!--
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
        -->
    </li>
    <!--<li>
        <h5>Modal</h5>
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

    </li>-->
    <li>
        <strong>Biaya & Beban</strong>
        <ul style="list-style:none;">
            <li>
                Pemesanan Barang (Modal)
                <?php
                $n = 1;
                $total_purchase = 0;
                foreach ($purchase as $row1) :
                    $total_purchase += $row1['SUBTOTAL'];
                    $n++;
                endforeach;
                ?>
                <span class="float-right"><?= number_format($total_purchase, 0, ',', '.') ?></span>
            </li>
            <?php
            $n = 1;
            foreach ($opgroup as $rwopgrp) :
                $total_ops = 0;
                echo "<li>" . ucwords(strtolower($rwopgrp['POS_NAME'])) . "";
                echo "<ul style='list-style:none;'>";
                foreach ($operasional as $row2) :
                    if ($rwopgrp['ID_TRANS'] == $row2['ID_TRANS'])
                        echo "<li><span class='font-italic' style='font-size:13px;'>" . ucwords(strtolower($row2['KETERANGAN'])) . "</span>
                    <span class='float-right'>" . number_format($row2['KREDIT'], 0, ',', '.') . "</span>
                    </li>";
                    $total_ops += $row2['KREDIT'];
                    $n++;
                endforeach;
                echo "</ul>";
                echo "</li>";
            endforeach;
            $total_bb   = $total_ops + $total_purchase;
            $labarugi   = ($total + $total_koreksi) - $total_bb;
            ?>

            <li>
                <strong>Total Biaya & Beban</strong>
                <span class="float-right"><strong><?= number_format($total_bb, 0, ',', '.') ?></strong></span>
            </li>
        </ul>
        <!--<table class="table table-bordered">
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
        </table>-->
    </li>
    <li>
        <strong>Laba / Rugi</strong>
        <span class="float-right"><strong><?= number_format($labarugi, 0, ',', '.') ?></strong></span>
    </li>
</ol>