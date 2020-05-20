<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?= site_url('admin/master/subagen/add'); ?>" class="btn btn-primary btn-sm mb-2">
            Tambah Sub Agen
        </a>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered nowrap" id="example" width="100%" cellspacing="0" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Agen</th>
                                <th>No. KTP</th>
                                <th>Nama Sub Agen</th>
                                <th>Alamat Sub Agen</th>
                                <th>No. Telp</th>
                                <th>Area</th>
                                <!--
                                <th>Foto Profile</th>
                                <th>Scan KTP</th>
                                -->
                                <th>Tanggal Join</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Agen</th>
                                <th>No. KTP</th>
                                <th>Nama Sub Agen</th>
                                <th>Alamat Sub Agen</th>
                                <th>No. Telp</th>
                                <th>Area</th>
                                <!--
                                <th>Foto Profile</th>
                                <th>Scan KTP</th>
                                -->
                                <th>Tanggal Join</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no = 1;
                            foreach ($subagen as $sa) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $sa->AGEN_NAME ?></td>
                                    <td><?= $sa->ID_CARD ?></td>
                                    <td><?= $sa->SUBAGEN_NAME ?></td>
                                    <td><?= $sa->SUBAGEN_ADDRESS ?></td>
                                    <td><?= $sa->SUBAGEN_PHONE ?></td>
                                    <td><?= $sa->subdistrict_name ?></td>
                                    <!--
                                    <td><img width="100" src="<?= base_url('uploads/') ?><?= $sa->PHOTO != null ? $sa->PHOTO : '0.png' ?>" /></td>
                                    <td><img width="100" src="<?= base_url('uploads/') ?><?= $sa->SCAN_ID_CARD != null ? $sa->SCAN_ID_CARD : '0.png' ?>" /></td>
                            -->
                                    <td><?= date('d/m/Y', strtotime($sa->JOIN_DATE)) ?></td>
                                    <td>
                                        <a title="Edit" href="<?= site_url('admin/master/subagen/edit/') . $sa->ID ?>" class='btn btn-warning btn-sm mr-1'><i class="fas fa-edit"></i></a>
                                        <a title="Hapus" href="<?= site_url('admin/master/subagen/del/') . $sa->ID ?>" class='btn btn-danger btn-sm mr-1' onclick="return confirm('Anda yakin akan menghapus data ini ?')"><i class="fas fa-trash"></i></a>
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