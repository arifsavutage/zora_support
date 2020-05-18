<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

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
                    <input type="hidden" id="judul-berkas" value="Kas Harian" />
                    <table class="table table-bordered" style="font-size: 12px;" id="export" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tgl</th>
                                <th>Keterangan</th>
                                <th>ID Trans</th>
                                <th>Kode</th>
                                <th>Kredit</th>
                                <th>Debet</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Tgl</th>
                                <th>Keterangan</th>
                                <th>ID Trans</th>
                                <th>Kode</th>
                                <th>Kredit</th>
                                <th>Debet</th>
                                <th>Saldo</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($rows as $row) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['TGL'])) ?></td>
                                    <td><?= $row['KETERANGAN'] ?></td>
                                    <td><?= $row['ID_TRANS'] ?></td>
                                    <td><?= $row['TRANS_TYPE'] ?></td>
                                    <td><?= number_format($row['KREDIT'], 0, ',', '.') ?></td>
                                    <td><?= number_format($row['DEBET'], 0, ',', '.') ?></td>
                                    <td><?= number_format($row['SALDO'], 0, ',', '.') ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>