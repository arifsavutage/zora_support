<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php if (isset($page_title)) echo $page_title; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?= site_url('admin/master/marketing/add'); ?>" class="btn btn-primary btn-sm mb-2">
            Tambah Marketing
        </a>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($card_name)) echo $card_name; ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0" style="font-size:12px;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. KTP</th>
                                <th>Nama Marketing</th>
                                <th>Alamat Marketing</th>
                                <th>No. Telp</th>
                                <th>Tanggal Join</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>No. KTP</th>
                                <th>Nama Marketing</th>
                                <th>Alamat Marketing</th>
                                <th>No. Telp</th>
                                <th>Tanggal Join</th>
                                <th><i class="fas fa-cog"></i></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no = 1;
                            foreach ($marketing as $m) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $m->ID_CARD ?></td>
                                    <td><?= $m->MARKETING_NAME ?></td>
                                    <td><?= $m->MARKETING_ADDRESS ?></td>
                                    <td><?= $m->MARKETING_PHONE ?></td>
                                    <td><?= date('d/m/Y', strtotime($m->JOIN_DATE)) ?></td>
                                    <td>
                                        <a title="Edit" href="<?= site_url('admin/master/marketing/edit/') . $m->ID ?>" class='btn btn-warning btn-sm mr-1'>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a title="Detail" href="#" class='btn btn-info btn-sm mr-1' data-toggle="modal" data-target="#marketingDetail" data-id="<?= $m->ID ?>">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a title="Hapus" href="<?= site_url('admin/master/marketing/del/') . $m->ID ?>" class='btn btn-danger btn-sm mr-1' onclick="return confirm('Anda yakin akan menghapus data ini ?\nJika anda menghapus data ini, pastikan anda mengubah data agen yang terkait dengan marketing ini.')">
                                            <i class="fas fa-trash"></i>
                                        </a>
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

<!-- The Modal -->
<div class="modal" id="marketingDetail">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Marketing Detail</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="text-center">
                    <img width="200" class="fotoprofile img-fluid img-thumbnail rounded-circle"  alt="Foto Profile" title="Foto Profile"/>
                    <br />
                    <h3 class="nama card-title"></h3>
                    <h6 class="noktp badge"></h6>
                    <hr>
                    <div style="font-size: 18px;color:darkgrey;">
                        Total transaksi <span class="badge badge-primary">10.000 K</span> 
                    </div>
                </div>
                <ul class="list-group mt-4">
                    <li class="list-group-item disabled">
                        <i class="far fa-calendar"></i>
                        <span>Join date :</span>
                        <span class="join"></span>
                    </li>
                    <li class="list-group-item disabled ">
                        <i class="fas fa-mobile-alt"></i>
                        <span>No. Telp :</span>
                        <span class="notelp"></span>
                    </li>
                    <li class="list-group-item disabled">
                        <i class="fas fa-map-marker"></i> 
                        <span>Alamat :</span>
                        <span class="alamat"></span>
                    </li>
                </ul>
                <ul class="list-group mt-4">
                    <li class="list-group-item disabled">
                        <img class="ktp rounded mx-auto d-block" width="400" src="" title="Scan KTP" alt="Scan KTP">
                    </li>
                </ul>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>