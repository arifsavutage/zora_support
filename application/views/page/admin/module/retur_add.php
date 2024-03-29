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
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="addreturn" method="post" action="">

                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="invoice">Invoice</label>
                            <input type="text" class="form-control" name="invoice" id="invoice" />
                        </div>
                        <div class="col-md-8">
                            <label for="items">Item</label>
                            <select name="item" class="form-control">
                                <option value="">: Pilih Item</option>
                                <?php
                                foreach ($items as $item) :
                                    echo '<option value="' . $item->ID . '">' . $item->PRODUCT_NAME . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="qty">Qty</label>
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="qty">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="col">
                            <label for="kondisi">Kondisi Barang</label>
                            <select name="kondisi" class="form-control">
                                <option value="">: Pilih Konsisi</option>
                                <option value="bagus">Kondisi Bagus</option>
                                <option value="rusak">Konsisi Rusak</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="tglretur">Tgl. Retur</label>
                            <input type="text" class="form-control date1" name="tglretur" id="tglretur" />
                        </div>
                    </div>

                    <div class="form-row mt-2 mb-4">
                        <div class="col">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>
                    </div>

                    <a href="<?= site_url('admin/master/return/list') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>