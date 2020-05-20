<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-6 offset-md-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo "<br/>";
                    echo $this->session->flashdata('info');
                }
                #echo $this->db->last_query();
                ?>
                <form name="editoperasional" method="post" action="">
                    <input type="hidden" name="id" value="<?= $detail['ID'] ?>" />
                    <div class="form-group">
                        <label for="rekening">Jenis Biaya</label>
                        <select name="rekening" class="form-control">
                            <option value="">Pilih</option>
                            <?php
                            foreach ($rek as $row) {
                                echo "<option value='" . $row['ID'] . "' ";
                                if ($row['ID'] == $detail['ID_TRANS']) echo "selected";
                                echo ">$row[POS_NAME]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal" value="<?= $detail['KREDIT'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $detail['KETERANGAN'] ?>">
                        <input type="hidden" name="tipe" value="operasional" />
                    </div>

                    <a href="<?= site_url() ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>