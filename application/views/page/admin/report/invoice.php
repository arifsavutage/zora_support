<h4 class="card-title">
    <?php
    if ($detail['STATUS'] == 'belum') {
        $badge = '<span class="badge badge-danger float-right">Belum Lunas</span>';
    } else {
        $badge = '<span class="badge badge-success float-right">Lunas</span>';
    }
    ?>
    Invoice #<?= $detail['INVOICE'] ?>&nbsp;<?= $badge ?>
</h4>
<p class="card-text">
    <?php
    $type = $detail['SELLER_TYPE'];
    if ($type == 'agen') {
        $seller = $this->selling_model->getAgenName($detail['SELLER_ID']);
        $seller_name = ucwords($seller->SELLER_NAME);
        $seller_addr = ucwords($seller->SELLER_ADDRESS);
        $seller_hp   = $seller->SELLER_PHONE;
        //echo "ini agen";
    } else if ($type == 'apt') {
        $seller = $this->selling_model->getApotikName($detail['SELLER_ID']);
        $seller_name = ucwords($seller->SELLER_NAME);
        $seller_addr = ucwords($seller->SELLER_ADDRESS);
        $seller_hp   = $seller->SELLER_PHONE;
    } else {
        $seller = $this->selling_model->getSubAgenName($detail['SELLER_ID']);
        $seller_name = ucwords($seller->SELLER_NAME);
        $seller_addr = ucwords($seller->SELLER_ADDRESS);
        $seller_hp   = $seller->SELLER_PHONE;
        //echo "ini sub";
    }
    //echo $type;
    ?>
    <strong><?= $seller_name ?></strong>
    <br />
    <address>
        <?= $seller_addr ?>
        <br />
        Telp. <?= $seller_hp ?>
    </address>
</p>
<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Item</th>
            <th>Qty</th>
            <th>Harga Satuan</th>
            <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data = json_decode($detail['PRODUCT_DETAIL'], true);

        $total = 0;
        $no = 1;
        foreach ($data as $list) :
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $list['name']; ?></td>
                <td><?= $list['qty']; ?></td>
                <td><?= number_format($list['price'], 0, ',', '.'); ?></td>
                <td><?= number_format($list['subtotal'], 0, ',', '.'); ?></td>
            </tr>
        <?php
            $total += $list['subtotal'];
            $no++;
        endforeach;
        ?>
        <tr>
            <td colspan="4"><strong>Total</strong></td>
            <td><strong><?= number_format($total, 0, ',', '.'); ?></strong></td>
        </tr>
    </tbody>
</table>
<br />
<h6>Keterangan :</h6>
<p><?= $detail['KETERANGAN']; ?></p>