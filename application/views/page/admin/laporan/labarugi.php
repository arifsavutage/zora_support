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
                <form name="addreturn" method="post" action="<?= base_url('index.php/admin/report/invoice/print_labarugi') ?>" target="_blank">

                    <div class="form-row mb-4">

                        <div class="col">
                            <label for="tgl1">Periode</label>
                            <input type="text" class="form-control date1" name="tgl1" id="tgl1" />
                        </div>
                        <div class="col">
                            <label for="tgl2">Ke</label>
                            <input type="text" class="form-control date1" name="tgl2" id="tgl2" />
                        </div>
                    </div>

                    <a href="<?= site_url('admin/laporan/labarugi') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Cari</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>