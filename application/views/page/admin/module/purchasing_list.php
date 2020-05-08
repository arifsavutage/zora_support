<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?= site_url('admin/master/purchasing/add'); ?>" class="btn btn-primary btn-sm mb-2">
            Buat PO
        </a>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Faktur</th>
                                <th>Suplier</th>
                                <th>Produk.</th>
                                <th>Qty.</th>
                                <th>Tgl. PO</th>
                                <th>Tgl. Kirim</th>
                                <th>Tgl. Datang</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <th>No.</th>
                            <th>No. Faktur</th>
                            <th>Suplier</th>
                            <th>Produk.</th>
                            <th>Qty.</th>
                            <th>Tgl. PO</th>
                            <th>Tgl. Kirim</th>
                            <th>Tgl. Datang</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>