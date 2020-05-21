<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?= site_url('admin/master/agen/add'); ?>" class="btn btn-primary btn-sm mb-2">
            Tambah Agen
        </a>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. KTP</th>
                                <th>Nama Agen</th>
                                <th>Alamat Agen</th>
                                <th>No. Telp</th>
                                <th>Area</th>
                                <th>Marketing</th>
                                <th>Tanggal Join</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>No. KTP</th>
                                <th>Nama Agen</th>
                                <th>Alamat Agen</th>
                                <th>No. Telp</th>
                                <th>Area</th>
                                <th>Marketing</th>
                                <th>Tanggal Join</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no = 1;
                            foreach ($agen as $a) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $a->ID_CARD ?></td>
                                    <td><?= $a->AGEN_NAME ?></td>
                                    <td><?= $a->AGEN_ADDRESS ?></td>
                                    <td><?= $a->AGEN_PHONE ?></td>
                                    <td><?= $a->city_name ?></td>
                                    <td><?= $a->MARKETING_NAME ?></td>
                                    <td><?= date('d/m/Y', strtotime($a->JOIN_DATE)) ?></td>
                                    <td>
                                        <a title="Edit" href="<?= site_url('admin/master/agen/edit/') . $a->ID ?>" class='btn btn-warning btn-sm mr-1'><i class="fas fa-edit"></i></a>
                                        <a title="Hapus" href="<?= site_url('admin/master/agen/del/') . $a->ID ?>" class='btn btn-danger btn-sm mr-1' onclick="return confirm('Anda yakin akan menghapus data ini ?\nJika anda menghapus data ini pastikan anda segera mengubah sub agen terkait.')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>